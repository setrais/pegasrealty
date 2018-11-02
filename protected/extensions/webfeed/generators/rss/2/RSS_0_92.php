<?php
/**
 * RSS_0_92 class file
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
 * Copyright and disclaimer of the RSS 0.92 specification:
 *
 * "© Copyright 1997-2000 UserLand Software. All Rights Reserved.
 *
 * This document and translations of it may be copied and furnished to others,
 * and derivative works that comment on or otherwise explain it or assist in its
 * implementation may be prepared, copied, published and distributed, in whole
 * or in part, without restriction of any kind, provided that the above
 * copyright notice and these paragraphs are included on all such copies and
 * derivative works.
 *
 * This document may not be modified in any way, such as by removing the
 * copyright notice or references to UserLand or other organizations. Further,
 * while these copyright restrictions apply to the written RSS specification,
 * no claim of ownership is made by UserLand to the format it describes. Any
 * party may, for commercial or non-commercial purposes, implement this protocol
 * without royalty or license fee to UserLand. The limited permissions granted
 * herein are perpetual and will not be revoked by UserLand or its successors or
 * assigns.
 *
 * This document and the information contained herein is provided on an "AS IS"
 * basis and USERLAND DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING
 * BUT NOT LIMITED TO ANY WARRANTY THAT THE USE OF THE INFORMATION HEREIN WILL
 * NOT INFRINGE ANY RIGHTS OR ANY IMPLIED WARRANTIES OF MERCHANTABILITY OR
 * FITNESS FOR A PARTICULAR PURPOSE."
 */

/**
 * RSS_0_92 implements the RSS 0.92 (Really Simple Sindication) specification as
 * explained {here @see http://backend.userland.com/rss092}
 * This implementation is here for historical purposes, since this specification
 * has been superseded since long ago. The 0.92 specification is in the road to
 * 2.0, and 0.91 is still used, so we need it.
 *
 * @author MetaYii
 * @link http://backend.userland.com/rss092
 */
class RSS_0_92 extends RSS_0_91 implements IFeedGenerator
{
   //***************************************************************************
   // Channel definition
   //***************************************************************************

   /**
    * In 0.92 it is optional
    *
    * @var string
    */
   protected $language = '';
   
   /**
    * <cloud> is a new optional sub-element of <channel>. It specifies a Web 
    * service that supports the rssCloud interface which can be implemented in 
    * HTTP-POST, XML-RPC or SOAP 1.1.
    * Its purpose is to allow processes to register with a cloud to be notified 
    * of updates to the channel. 
    *
    * @var object
    */
   protected $cloud = null;

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($title, $description, $link, $language='')
   {
      parent::__construct($title, $description, $link, $language);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the title
    *
    * @param string $value
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Title must be a string'));
      $this->title = $this->encode($value);
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Description must be a string'));
      $this->description = $this->encode($value);
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode($value);
   }

   /**
    * Sets the copyright
    *
    * @param string $value
    */
   public function setCopyright($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Copyright must be a string'));
      $this->copyright = $this->encode($value);
   }

   /**
    * Set managingEditor
    *
    * @param string $value
    */
   public function setManagingEditor($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'managingEditor must be a string'));
         $this->managingEditor = $this->encode($value);
   }

   /**
    * Sets the webMaster
    *
    * @param string $value
    */
   public function setWebMaster($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'webMaster must be a string'));
      $this->webMaster = $this->encode($value);
   }

   /**
    * Sets the rating
    *
    * @param string $value
    */
   public function setRating($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Rating must be a string'));
      $this->rating = $this->encode($value);
   }

   /**
    * Sets docs
    *
    * @param string $value
    */
   public function setDocs($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'docs must be a string'));
      $this->docs = $this->encode($value);
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Adds an item to the item array
    *
    * @param string $title the title
    * @param string $link the link
    */
   public function addItem($title='', $link='', $description='')
   {
      $this->items[] = new EFeedChannelItemRSS092($title, $link, $description);
   }

   /**
    * Sets the channel image
    *
    * @param string $title the title
    * @param string $url the url
    * @param <stringtype> $link the link
    */
   public function addImage($title, $url, $link, $description='', $width=88, $height=31)
   {
      $this->image = new EFeedChannelImageRSS092($title, $url, $link, $description, $width, $height);
   }

   /**
    * Sets the channel text input
    *
    * @param string $title the title
    * @param string $description the description
    * @param string $name the name
    * @param string $link the link
    */
   public function addTextInput($title, $description, $name, $link)
   {
      $this->textInput = new EFeedChannelTextInputRSS092($title, $description, $name, $link);
   }

   /**
    * Sets the channel cloud
    *
    * @param string $domain
    * @param integer $port
    * @param string $path
    * @param string $registerProcedure
    * @param string $protocol
    */
   public function addCloud($domain, $port, $path, $registerProcedure, $protocol)
   {
      $this->cloud = new EFeedChannelCloudRSS092($domain, $port, $path, $registerProcedure, $protocol);
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

      $xml->startElement('rss');
      $xml->writeAttribute('version', '0.92');

      $xml->startElement('channel');

      $xml->writeElement('title', $this->title);
      $xml->writeElement('description', $this->description);
      $xml->writeElement('link', $this->link);
      if ($this->language !== '') $xml->writeElement('language', $this->language);
      if ($this->copyright !== '') $xml->writeElement('copyright', $this->copyright) ;
      if ($this->managingEditor !== '') $xml->writeElement('managingEditor', $this->managingEditor);
      if ($this->webMaster !== '') $xml->writeElement('webMaster', $this->webMaster);
      if ($this->rating !== '') $xml->writeElement('rating', $this->rating);
      if ($this->pubDate !== 0) $xml->writeElement('pubDate', CTimestamp::formatDate('r', $this->pubDate));
      if ($this->lastBuildDate !== 0) $xml->writeElement('lastBuildDate', CTimestamp::formatDate('r', $this->lastBuildDate));
      if ($this->docs !== '') $xml->writeElement('docs', $this->docs);

      if (!is_null($this->image)) {
         $xml->startElement('image');
         $xml->writeElement('title', $this->image->title);
         $xml->writeElement('url', $this->image->url);
         $xml->writeElement('link', $this->image->link);
         $xml->writeElement('description', $this->image->description);
         $xml->writeElement('width', $this->image->width);
         $xml->writeElement('height', $this->image->height);
         $xml->endElement();
      }

      if (!is_null($this->textInput)) {
         $xml->startElement('textInput');
         $xml->writeElement('title', $this->textInput->title);
         $xml->writeElement('description', $this->textInput->description);
         $xml->writeElement('name', $this->textInput->name);
         $xml->writeElement('link', $this->textInput->link);
         $xml->endElement();
      }

      if (!empty($this->skipDays)) {
         $xml->startElement('skipDays');
         foreach ($this->skipDays as $day)
            $xml->writeElement('day', $day);
         $xml->endElement();
      }

      if (!empty($this->skipHours)) {
         $xml->startElement('skipHours');
         foreach ($this->skipHours as $hour)
            $xml->writeElemnt('hour', $hour);
         $xml->endElement();
      }

      if (!is_null($this->cloud)) {
         $xml->startElement('cloud');
         $xml->writeAttribute('domain', $this->cloud->domain);
         $xml->writeAttribute('port', $this->cloud->port);
         $xml->writeAttribute('path', $this->cloud->path);
         $xml->writeAttribute('registerProcedure', $this->cloud->registerProcedure);
         $xml->writeAttribute('protocol', $this->cloud->protocol);
         $xml->endElement();
      }

      foreach ($this->items as $item) {
         $xml->startElement('item');
         if ($item->title !== '') $xml->writeElement('title', $item->title);
         if ($item->link !== '') $xml->writeElement('link', $item->link);
         if ($item->description !== '') $xml->writeElement('description', $item->description);
         if (!is_null($item->source)) {
            $xml->startElement('source');
            $xml->writeAttribute('url', $item->source->url);
            $xml->text($item->source->source);
            $xml->endElement();
         }
         if (!is_null($item->enclosure)) {
            $xml->startElement('enclosure');
            $xml->writeAttribute('url', $item->enclosure->url);
            $xml->writeAttribute('length', $item->enclosure->length);
            $xml->writeAttribute('type', $item->enclosure->type);
            $xml->endElement();
         }
         if (!is_null($item->category)) {
            $xml->startElement('category');
            if ($item->category->domain !== '') {
               $xml->writeAttribute('domain', $item->category->domain);
            }
            $xml->text($item->category->category);
            $xml->endElement();
         }
         $xml->endElement();
      }

      $xml->endElement();
      $xml->endElement();
      $xml->endDocument();

      return $xml->outputMemory();
   }
}

/**
 * EFeedChannelImageRSS092 implements the specification of a RSS 0.92
 * image element
 *
 * @author MetaYii
 */
class EFeedChannelImageRSS092 extends EFeedChannelImageRSS091
{
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
         throw new CException(Yii::t('EWebFeed', 'Title must be a string'));
      $this->title = $this->encode($value);
   }

   /**
    * Sets the URL
    *
    * @param string $value
    */
   public function setUrl($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'URL must be a string'));
      EWebFeed::validateURI($value);
      $this->url = $this->encode($value);
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode($value);
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'desciption must be a string'));
      $this->description = $this->encode($value);
   }
}

/**
 * EFeedChannelTextInputRSS092 implements the specification of a RSS 0.92
 * textinput element
 *
 * @author MetaYii
 */
class EFeedChannelTextInputRSS092 extends EFeedChannelTextInputRSS091
{
   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the title
    *
    * @param string $value
    */
   public function setTitle($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Title must be a string'));
      $this->title = $this->encode($value);
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Description must be a string'));
      $this->description = $this->encode($value);
   }

   /**
    * Sets the name
    *
    * @param string $value
    */
   public function setName($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Name must be a string'));
      $this->name = $this->encode($value);
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode($value);
   }
}

/**
 * EFeedChannelCloudRSS092 implements the cloud sub-element of a channel, as 
 * specified {here @link http://www.thetwowayweb.com/soapmeetsrss}
 *
 * @author MetaYii
 */
class EFeedChannelCloudRSS092 extends EFeedElement
{
   //***************************************************************************
   // Cloud definition
   //***************************************************************************

   /**
    * The domain name or IP address of the cloud
    *
    * @var string
    */
   protected $domain = '';

   /**
    * The TCP port that the cloud is running on
    *
    * @var integer
    */
   protected $port = 80;

   /**
    * The location of its responder
    *
    * @var string
    */
   protected $path = '';

   /**
    * The name of the procedure to call to request notification
    *
    * @var string
    */
   protected $registerProcedure = '';

   /**
    * xml-rpc, soap or http-post (case-sensitive), indicating which protocol is
    * to be used.
    *
    * @var string
    */
   protected $protocol = '';

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * Valid protocols for the protocol attribute
    *
    * @var array
    */
   protected $validProtocols = array('xml-rpc', 'soap', 'http-post');

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $domain
    * @param integer $port
    * @param string $path
    * @param string $registerProcedure
    * @param string $protocol
    */
   public function __construct($domain, $port, $path, $registerProcedure, $protocol)
   {
      $this->setDomain($domain);
      $this->setPort($port);
      $this->setPath($path);
      $this->setRegisterProcedure($registerProcedure);
      $this->setProtocol($protocol);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the domain
    *
    * @param string $value
    */
   public function setDomain($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'domain must be a non-empty string'));
      $this->domain = $this->encode($value);
   }

   /**
    * Gets the domain
    *
    * @return string
    */
   public function getDomain()
   {
      return $this->domain;
   }

   /**
    * Sets the port
    *
    * @param integer $value
    */
   public function setPort($value)
   {
      if (!is_int($value) || $value<0 || $value>65535)
         throw new CException(Yii::t('EWebFeed', 'port must be a valid TCP port number, integer'));
      $this->port = $value;
   }

   /**
    * Gets the port
    *
    * @return integer
    */
   public function getPort()
   {
      return $this->port;
   }

   /**
    * Sets the path
    *
    * @param string $value
    */
   public function setPath($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'path must be a string'));
      $this->path = $this->encode($value);
   }

   /**
    * Gets the path
    *
    * @return string
    */
   public function getPath()
   {
      return $this->path;
   }

   /**
    * Sets the registerProcedure
    *
    * @param string $value
    */
   public function setRegisterProcedure($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'registerProcedure must be a non-empty string'));
      $this->registerProcedure = $this->encode($value);
   }

   /**
    * Gets the registerProcedure
    *
    * @return string
    */
   public function getRegisterProcedure()
   {
      return $this->registerProcedure;
   }

   /**
    * Sets the protocol
    *
    * @param string $value
    */
   public function setProtocol($value)
   {
      if (!in_array($value, $this->validProtocols))
         throw new CException(Yii::t('EWebFeed', 'protocol must be one of: {proto} (case-sensitive)', array('{proto}'=>implode(', ', $this->validProtocols))));
      $this->protocol = $value;
   }

   /**
    * Gets the protocol
    *
    * @return string
    */
   public function getProtocol()
   {
      return $this->protocol;
   }
}

/**
 * EFeedChannelItemRSS092 implements the specification of a RSS 0.92 item
 * element
 *
 * @author MetaYii
 */
class EFeedChannelItemRSS092 extends EFeedChannelItemRSS091
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   // Inherits the elements from EFeedChannelItemRSS091 plus these ones optional:

   /**
    * <source> is a new optional sub-element of <item>.
    * Its value is the name of the RSS channel that the item came from, derived
    * from its <title>. It has one required attribute, url, which links to the
    * XMLization of the source.
    * The purpose of this element is to propogate credit for links, to publicize
    * the sources of news items.
    *
    * @var EFeedChannelItemSourceRSS092
    */
   protected $source = null;

   /**
    * <enclosure> is a new optional sub-element of <item>.
    * It has three required attributes. url says where the enclosure is located,
    * length says how big it is in bytes, and type says what its type is, a
    * standard MIME type. The url must be an http url.
    *
    * @var object
    */
   protected $enclosure = null;

   /**
    * <category> is a new optional sub-element of <item>.
    * It has one optional attribute, domain, a string that identifies a
    * categorization taxonomy.
    * The value of the element is a forward-slash-separated string that
    * identifies a hierarchic location in the indicated taxonomy. Processors may
    * establish conventions for the interpretation of categories.
    *
    * @var object
    */
   protected $category = null;

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($title='', $link='', $description='')
   {
      $this->setTitle($title);
      $this->setLink($link);
      $this->setDescription($description);
      if (!is_null($source)) $this->source = $source;
      if (!is_null($enclosure)) $this->enclosure = $enclosure;
      if (!is_null($category)) $this->category = $category;
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the title
    *
    * @param string $value
    */
   public function setTitle($value='')
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Title must be a string'));
      $this->title = $this->encode($value);
   }

   /**
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value='')
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be a string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode($value);
   }

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value='')
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'descrption must be a string'));
      $this->description = $this->encode($value);
   }

   /**
    * Sets the source
    *
    * @param string $source
    * @param string $url
    */
   public function addSource($source, $url)
   {
      $this->source = new EFeedChannelItemSourceRSS092($source, $url);
   }

   /**
    * Gets the source
    *
    * @return EFeedChannelItemSourceRSS092
    */
   public function getSource()
   {
      return $this->source;
   }

   /**
    * Sets the enclosure
    *
    * @param string $url
    * @param integer $length
    * @param string $type
    */
   public function addEnclosure($url, $length, $type)
   {
      $this->enclosure = new EFeedChannelItemEnclosureRSS092($url, $length, $type);
   }

   /**
    * Gets the enclosure
    *
    * @return EFeedChannelItemEnclosureRSS092
    */
   public function getEnclosure()
   {
      return $this->enclosure;
   }

   /**
    * Sets the category
    *
    * @param string $category
    * @param string $domain
    */
   public function addCategory($category, $domain)
   {
      $this->category = new EFeedChannelItemCategoryRSS092($category, $domain);
   }

   /**
    * Gets the category
    *
    * @return EFeedChannelItemCategoryRSS092
    */
   public function getCategory()
   {
      return $this->category;
   }
}

/**
 * EFeedChannelItemSourceRSS092 implements the souce sub-elemen of item in
 * the RSS 0.92 specification
 *
 * @author MetaYii
 */
class EFeedChannelItemSourceRSS092 extends EFeedElement
{
   //***************************************************************************
   // Source definition
   //***************************************************************************

   /**
    * Its value is the name of the RSS channel that the item came from, derived
    * from its <title>
    *
    * @var string
    */
   protected $source = '';

   /**
    * It has one required attribute, url, which links to the XMLization of the
    * source.
    *
    * @var
    */
   protected $url = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($source, $url)
   {
      $this->setSource($source);
      $this->setUrl($url);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the source
    *
    * @param string $value
    */
   public function setSource($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'source must be a non-empty string'));
      $this->source = $this->encode($value);
   }

   /**
    * Gets te text
    *
    * @return string
    */
   public function getSource()
   {
      return $this->source;
   }

   /**
    * Sets the url
    *
    * @param string $value
    */
   public function setUrl($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'url must be a non-empty string'));
      $this->url = $this->encode($value);
   }

   /**
    * Gets the url
    *
    * @return string
    */
   public function getUrl()
   {
      return $this->url;
   }
}

/**
 * EFeedChannelItemEnclosureRSS092 implements the enclusure sub-element of an
 * item, according to the RSS 0.92 specification
 *
 * @author MetaYii
 */
class EFeedChannelItemEnclosureRSS092 extends EFeedElement
{
   //***************************************************************************
   // Enclosure definition
   //***************************************************************************

   /**
    * Says where the enclosure is located
    *
    * @var string
    */
   protected $url = '';

   /**
    * Says how big it is in bytes
    *
    * @var integer
    */
   protected $length = '';

   /**
    * Says what its type is, a standard MIME type
    *
    * @var string
    */
   protected $type = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    * Sets the url, length and type attributes
    *
    * @param string $url
    * @param string $length
    * @param string $type
    */
   public function __construct($url, $length, $type)
   {
      $this->setUrl($url);
      $this->setLength($length);
      $this->setType($type);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the url
    *
    * @param string $value
    */
   public function setUrl($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'url must be a non-empty string'));
      $this->url = $this->encode($value);
   }

   /**
    * Gets the url
    *
    * @return string
    */
   public function getUrl()
   {
      return $this->url;
   }

   /**
    * Sets the length
    *
    * @param integer $value
    */
   public function setLength($value)
   {
      if (!is_int($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'length must be an integer'));
      $this->length = $value;
   }

   /**
    * Gets the length
    *
    * @return integer
    */
   public function getLength()
   {
      return $this->length;
   }

   /**
    * Sets the type
    *
    * @param string $value
    */
   public function setType($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'type must be a non-empty string'));
      $this->type = $value;
   }

   /**
    * Gets the type
    *
    * @return string
    */
   public function getType()
   {
      return $this->type;
   }
}

/**
 * EFeedChannelItemCategoryRSS092 implements the category sub-element of an item
 * according to the RSS 0.92 specification
 *
 * @author MetaYii
 */
class EFeedChannelItemCategoryRSS092 extends EFeedElement
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   /**
    * The value of the element is a forward-slash-separated string that
    * identifies a hierarchic location in the indicated taxonomy. Processors may
    * establish conventions for the interpretation of categories.
    *
    * @var string
    */
   protected $category = '';

   /**
    * Optional attribute, domain, a string that identifies a categorization
    * taxonomy
    *
    * @var string
    */
   protected $domain = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @var string $category
    * @var string $domain
    */
   public function __construct($category, $domain='')
   {
      $this->setCategory($category);
      $this->setDomain($domain);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the category
    *
    * @param string $value
    */
   public function setCategory($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException('EWebFeed', 'category must be a non-empty string');
      $this->category = $this->encode($value);
   }

   /**
    * Gets the category
    *
    * @return string
    */
   public function getCategory()
   {
      return $this->category;
   }

   /**
    * Sets the domain
    *
    * @param string $value
    */
   public function setDomain($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'domain must be a string'));
      $this->domain = $this->encode($value);
   }

   /**
    * Gets the domain
    *
    * @return string
    */
   public function getDomain()
   {
      return $this->domain;
   }
}