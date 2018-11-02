<?php
/**
 * RSS_1_0 class file
 *
 * @author MetaYii
 * @version 1.0
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008 MetaYii
 * @license
 *
 * Copyright © 2008 by MetaYii. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * - Neither the name of MetaYii nor the names of its contributors may
 *   be used to endorse or promote products derived from this software without
 *   specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * -----------------------------------------------------------------------------
 *
 * About the RSS 1.0 specification:
 * 
 * "Copyright © 2000 by the Authors.
 *
 * Permission to use, copy, modify and distribute the RDF Site Summary 1.0
 * Specification and its accompanying documentation for any purpose and without
 * fee is hereby granted in perpetuity, provided that the above copyright notice
 * and this paragraph appear in all copies. The copyright holders make no
 * representation about the suitability of the specification for any purpose. It
 * is provided "as is" without expressed or implied warranty.
 *
 * This copyright applies to the RDF Site Summary 1.0 Specification and
 * accompanying documentation and does not extend to the RSS format itself."
 */

/**
 * RSS_1_0 implements the RDF Site Summary 1.0 specification. RDF Site Summary
 * (RSS) is a lightweight multipurpose extensible metadata description and
 * syndication format. RSS is an XML application, conforming to the W3C's RDF
 * Specification. RSS is extensible via XML-namespace and/or RDF based
 * modularization.
 *
 * Quick notes:
 * RSS 1.0 was derived from the RSS 0.9 format created by Netscape(tm), but did
 * not comply with W3C's final specification for RDF. We could have implemented
 * RSS 0.9, but that one is no longer used, the license is not clear, it's way 
 * too limited and it's not valid RDF, so better implement RSS 1.0 directly ;-)
 *
 * @link http://web.resource.org/rss/1.0/spec
 *
 * @author MetaYii
 */
class RSS_1_0 extends EFeedChannel implements IFeedGenerator
{
   //***************************************************************************
   // Channel elements
   //***************************************************************************

   /**
    * The {resource} URL of the channel element's rdf:about attribute must be
    * unique with respect to any other rdf:about attributes in the RSS document
    * and is a URI which identifies the channel. Most commonly, this is either
    * the URL of the homepage being described or a URL where the RSS file can be
    * found.
    *
    * @var string
    */
   protected $resource = '';

   /**
    * A descriptive title for the channel.
    *
    * @var string
    */
   protected $title = '';
   
   /**
    * A brief description of the channel's content, function, source, etc. 
    *
    * @var string
    */
   protected $description = '';

   /**
    * The URL to which an HTML rendering of the channel title will link,
    * commonly the parent site's home or news page.
    *
    * @var string
    */
   protected $link = '';

   /**
    * Establishes an RDF association between the optional image element
    * and this particular RSS channel. The rdf:resource's {image_uri} must be
    * the same as the image element's rdf:about {image_uri}.
    *
    * An image to be associated with an HTML rendering of the channel. This
    * image should be of a format supported by the majority of Web browsers.
    * While the later 0.91 specification allowed for a width of 1-144 and height
    * of 1-400, convention (and the 0.9 specification) dictate 88x31.
    *
    * @var EFeedChannelImageRSS10
    */
   protected $image = null;

   /**
    * Establishes an RDF association between the optional textinput element and 
    * this particular RSS channel. The {textinput_uri} rdf:resource must be the 
    * same as the textinput element's rdf:about {textinput_uri}.
    *
    * The textinput element affords a method for submitting form data to an
    * arbitrary URL -- usually located at the parent website. The form processor
    * at the receiving end only is assumed to handle the HTTP GET method.
    *
    * The field is typically used as a search box or subscription form -- among
    * others. While this is of some use when RSS documents are rendered as
    * channels (see MNN) and accompanied by human readable title and
    * description, the ambiguity in automatic determination of meaning of this
    * overloaded element renders it otherwise not particularly useful. RSS 1.0
    * therefore suggests either deprecation or augmentation with some form of
    * resource discovery of this element in future versions while maintaining it
    * for backward compatiblity with RSS 0.9.
    *
    * {textinput_uri} must be unique with respect to any other rdf:about
    * attributes in the RSS document and is a URI which identifies the
    * textinput. {textinput_uri} should be identical to the value of the <link>
    * sub-element of the <textinput> element, if possible.
    *
    * @var EFeedChannelTextInputRSS10
    */
   protected $textinput = null;

   //***************************************************************************
   // Feed definition
   //***************************************************************************

   /**
    * We are generating RDF Site Sumary feeds
    * @link http://www.ietf.org/rfc/rfc3870.txt
    *
    * @var string
    */
   protected $type = 'rdf';

   /**
    * The document charset
    *
    * @var string
    */
   public $charset = 'UTF-8';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param <type string the resource
    */
   public function setResource($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'resource must be a non-empty string'));
      EWebFeed::validateURI($value);
      $this->resource = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getResource()
   {
      return $this->resource;
   }

   /**
    * Setter
    *
    * @param string $value the title
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'title must be a string'));
      $this->title = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Setter
    *
    * @param string $value the link
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'link must be a string'));
      $this->link = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getLink()
   {
      return $this->link;
   }

   /**
    * Setter
    *
    * @param string $value the description
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'description must be a string'));
      $this->description = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getDescription()
   {
      return $this->description;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $title the title
    * @param string $link the link
    * @param string $description the description
    */
   public function __construct($title, $link='', $description='')
   {
      $this->setTitle($title);
      $this->setLink($link);
      $this->setDescription($description);
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Adds a image element
    *
    * @param string $url
    * @param string $title
    * @param string $link
    */
   public function addImage($url, $title='', $link='')
   {
      $this->image = new EFeedChannelImageRSS10($url, $title, $link);
   }

   /**
    * Adds a textinput element
    *
    * @param string $uri
    * @param string $title
    * @param string $description
    * @param string $name
    * @param string $link
    */
   public function addTextInput($uri, $title, $description, $name, $link='')
   {
      $this->textinput = new EFeedChannelTextInputRSS10($uri, $title, $description, $name, $link='');
   }

   /**
    * Adds an item
    *
    * @param <type> $uri
    * @param <type> $title
    * @param <type> $description
    * @param <type> $link
    */
   public function addItem($uri, $title, $description='', $link='')
   {
      $this->items[] = new EFeedChannelItemRSS10($uri, $title, $description, $link);
   }

   //***************************************************************************

   /**
    * Generates the XML for the channel
    *
    * @return string XML
    */
   public function generateXML()
   {
      $xml = new xmlWriter();
      $xml->openMemory();
      $xml->setIndent(true);

      $xml->startDocument('1.0', $this->charset);

      $xml->startElement('rdf:RDF');
      $xml->writeAttribute('xmlns:rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
      $xml->writeAttribute('xmlns', 'http://purl.org/rss/1.0/');

      $xml->startElement('channel');
      $xml->writeAttribute('rdf:about', $this->resource);

      $xml->writeElement('title', $this->title);
      $xml->writeElement('link', $this->link);
      $xml->writeElement('description', $this->description);

      if (!is_null($this->image)) {
         $xml->startElement('image');
         $xml->writeAttribute('rdf:resource', $this->image->url);
         $xml->endElement();
      }

      if (!is_null($this->textinput)) {
         $xml->startElement('textinput');
         $xml->writeAttribute('rdf:resource', $this->textinput->uri);
         $xml->endElement();
      }

      if (empty($this->items))
         throw new CException(Yii::t('EWebFeed', 'At least one item must exist'));
      $xml->startElement('items');
      $xml->startElement('rdf:Seq');
      foreach ($this->items as $item) {
         $xml->startElement('rdf:li');
         $xml->writeAttribute('resource', $item->uri);
         $xml->endElement();
      }
      $xml->endElement();
      $xml->endElement();

      $xml->endElement();

      if (!is_null($this->image)) {
         $xml->startElement('image');
         $xml->writeAttribute('rdf:about', $this->image->url);
         $xml->writeElement('title', $this->image->title);
         $xml->writeElement('link', $this->image->link);
         $xml->writeElement('url', $this->image->url);
         $xml->endElement();
      }

      if (!is_null($this->textinput)) {
         $xml->startElement('textinput');
         $xml->writeAttribute('rdf:about', $this->textinput->uri);
         $xml->writeElement('title', $this->textinput->title);
         $xml->writeElement('description', $this->textinput->description);
         $xml->writeElement('name', $this->textinput->name);
         $xml->writeElement('link', $this->textinput->link);
         $xml->endElement();
      }

      foreach ($this->items as $item) {
         $xml->startElement('item');
         $xml->writeAttribute('rdf:about', $item->uri);
         $xml->writeElement('title', $item->title);
         $xml->writeElement('link', $item->link);
         if ($item->description !== '') $xml->writeElement('description', $item->description);
         $xml->endElement();
      }
      
      $xml->endElement();
      $xml->endDocument();

      return $xml->flush();
   }
}

/**
 * EFeedChannelItemRSS10 implements the specification of a RSS 1.0 item element
 *
 * While commonly a news headline, with RSS 1.0's modular extensibility, this
 * can be just about anything: discussion posting, job listing, software patch
 * -- any object with a URI. There may be a minimum of one item per RSS
 * document. While RSS 1.0 does not enforce an upper limit, for backward
 * compatibility with RSS 0.9 and 0.91, a maximum of fifteen items is
 * recommended.
 *
 * {item_uri} must be unique with respect to any other rdf:about attributes in
 * the RSS document and is a URI which identifies the item. {item_uri} should be
 * identical to the value of the <link> sub-element of the <item> element, if
 * possible.
 */
class EFeedChannelItemRSS10 extends EFeedElement
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   /**
    * {item_uri} must be unique with respect to any other rdf:about attributes 
    * in the RSS document and is a URI which identifies the item. {item_uri} 
    * should be identical to the value of the <link>  sub-element of the <item> 
    * element, if possible. 
    *
    * @var string
    */
   protected $uri = '';

   /**
    * Item title
    *
    * @var string
    */
   protected $title = '';

   /**
    * Item link
    *
    * @var string
    */
   protected $link = '';

   /**
    * Item description
    *
    * @var string
    */
   protected $description = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Sets the item's title and URI. Optionally sets the description. If you
    * want, you to set a link different to the URI, however this is NOT
    * recommended, so leave the link parameter unset or as an empty string ''
    *
    * @param string $title
    * @param string $link
    */
   public function __construct($uri, $title, $description='', $link='')
   {
      $this->setUri($uri);
      $this->setTitle($title);
      if ($description !== '')
         $this->setDescription($description);
      if ($link === '')
         $this->setLink($uri);
      else
         $this->setLink($link);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the URI
    *
    * @param string $value
    */
   public function setUri($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'uri must be a string'));
      EWebFeed::validateUri($value);
      $this->uri = $value;
   }

   /**
    * Gers the link
    *
    * @return string
    */
   public function getUri()
   {
      return $this->uri;
   }

   /**
    * Sets the title
    *
    * @param string $value
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'title must be a string'));
      $this->title = $value;
   }

   /**
    * Gets the title
    *
    * @return string
    */
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'link must be a string'));
      EWebFeed::validateUri($value);
      $this->link = $value;
   }

   /**
    * Gers the link
    *
    * @return string
    */
   public function getLink()
   {
      return $this->link;
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'desription must be a string'));
      $this->description = $value;
   }

   public function getDescription()
   {
      return $this->description;
   }
}

/**
 * EFeedChannelImageRSS10 implements the specification of a RSS 1.0 image element
 */
class EFeedChannelImageRSS10 extends EFeedElement
{
   //***************************************************************************
   // Image definition
   //***************************************************************************

   /**
    * The alternative text ("alt" attribute) associated with the channel's image
    * tag when rendered as HTML.
    *
    * @var string
    */
   protected $title = '';

   /**
    * The URL of the image to used in the "src" attribute of the channel's image
    * tag when rendered as HTML.
    *
    * @var string
    */
   protected $url = '';

   /**
    * The URL to which an HTML rendering of the channel image will link. This,
    * as with the channel's title link, is commonly the parent site's home or
    * news page.
    *
    * @var string
    */
   protected $link = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Sets the image's title, url and link
    *
    * @param string $title
    * @param string $url
    * @param string $link
    */
   public function __construct($url, $title, $link)
   {
      $this->setUrl($url);
      $this->setTitle($title);
      $this->setLink($link);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Set the title
    *
    * @param string $value
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'title must be a string'));
      $this->title = $value;
   }

   /**
    * Gets the title
    *
    * @return string
    */
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Sets the URL
    *
    * @param string $value
    */
   public function setUrl($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'url must be a string'));
      EWebFeed::validateURI($value);
      $this->url = $value;
   }

   /**
    * Gets the URL
    *
    * @return string
    */
   public function getUrl()
   {
      return $this->url;
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $value;
   }

   /**
    * Gets the link
    *
    * @return string
    */
   public function getLink()
   {
      return $this->link;
   }
}

/**
 * EFeedChannelTextInputRSS10 implements the specification of a RSS 1.0
 * textinput element
 */
class EFeedChannelTextInputRSS10 extends EFeedElement
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   /**
    * {textinput_uri} must be unique with respect to any other rdf:about 
    * attributes in the RSS document and is a URI which identifies the
    * textinput. {textinput_uri} should be identical to the value of the <link> 
    * sub-element of the <textinput> element, if possible. 
    *
    * @var string
    */
   protected $uri = '';

   /**
    * A descriptive title for the textinput field. For example: "Subscribe"
    *
    * @var string
    */
   protected $title = '';

   /**
    * A brief description of the textinput field's purpose. For example:
    * "Subscribe to our newsletter for..." or "Search our site's archive of..."
    *
    * @var string
    */
   protected $description = '';

   /**
    *  The text input field's (variable) name.
    *
    * @var string
    */
   protected $name = '';

   /**
    * The URL to which a textinput submission will be directed (using GET).
    *
    * @var string
    */
   protected $link = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Sets the title, description, name and link for the text input
    *
    * @param string $title
    * @param string $description
    * @param string $name
    * @param string $link
    */
   public function __construct($uri, $title, $description, $name, $link='')
   {
      $this->setUri($uri);
      $this->setTitle($title);
      $this->setDescription($description);
      $this->setName($name);
      if ($link !== '')
         $this->setLink($link);
      else
         $this->setLink($uri);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the uri
    *
    * @param string $value
    */
   public function setUri($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'uri must be a non-empty string'));
      EWebFeed::validateURI($value);
      $this->uri = $value;
   }

   /**
    * Gets the uri
    *
    * @return string
    */
   public function getUri()
   {
      return $this->uri;
   }

   /**
    * Sets the title
    *
    * @param string $value
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'title must be a string'));
      $this->title = $value;
   }

   /**
    * Gets the title
    *
    * @return string
    */
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'description a string'));
      $this->description = $value;
   }

   /**
    * Gets the description
    *
    * @return string
    */
   public function getDescription()
   {
      return $this->description;
   }

   /**
    * Sets the name
    *
    * @param string $value
    */
   public function setName($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'name must be a string'));
      $this->name = $value;
   }

   /**
    * Gets the name
    *
    * @return string
    */
   public function getName()
   {
      return $this->name;
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $value;
   }

   /**
    * Gets the link
    *
    * @return string
    */
   public function getLink()
   {
      return $this->link;
   }
}