<?php
/**
 * RSS_0_91 class file
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
 * Copyright and disclaimer of the RSS 0.91 specification:
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
 * RSS_0_91 implements the RSS 0.91 (Really Simple Sindication) specification as
 * explained {here @see http://backend.userland.com/rss091}
 * This implementation is here mostly for historical purposes, since this
 * specification has been superseded since long ago. However, it is still widely
 * used as of 2008, so we still need it, but it is recommended that you use
 * RSS 2.0 since it's the best and most complete RSS 2.x specification!!!
 *
 * @author MetaYii
 * @link http://backend.userland.com/rss091
 */
class RSS_0_91 extends EFeedChannel implements IFeedGenerator
{
   //***************************************************************************
   // Channel definition
   //***************************************************************************

   // Required

   /**
    * Channel title.
    * Mandatory.
    * 40 chars max.
    *
    * @var string
    */
   protected $title = '';

   /**
    * Channel description.
    * Mandatory.
    * 500 chars max.
    *
    * @var string
    */
   protected $description = '';

   /**
    * Channel title links to: (URL).
    * Mandatory.
    * 500 chars max.
    *
    * @var string
    */
   protected $link = '';

   /**
    * Optional image. The actual image must be 81x31 pixels.
    *
    * @var EFeedChannelImageeRSS09
    */
   protected $image = null;

   /**
    * Optional text input form
    *
    * @var EFeedChannelTextInputRSS09
    */
   protected $textInput = null;

   /**
    * Indicates the language your channel is written in. This allows aggregators
    * to group all Italian language sites, for example, on a single page. A list
    * of allowable values for this element is
    * {here @link http://backend.userland.com/stories/storyReader$16}
    * Mandatory
    *
    * @var string
    */
   protected $language = 'en';

   // Optional elements

   /**
    * Copyright notice for content in the channel. Maximum length is 100.
    *
    * @var string
    */
   protected $copyright = '';

   /**
    * The email address of the managing editor of the channel, the person to
    * contact for editorial inquiries. Maximum length is 100.
    *
    * @var string
    */
   protected $managingEditor = '';

   /**
    * The email address of the webmaster for the channel, the person to contact
    * if there are technical problems. Maximum length is 100.
    *
    * @var string
    */
   protected $webMaster = '';

   /**
    * The PICS rating for the channel. Maximum length is 500.
    *
    * @var string
    */
   protected $rating = '';

   /**
    * The publication date for the content in the channel. For example, the New
    * York Times publishes on a daily basis, the publication date flips once
    * every 24 hours. That's when the pubDate of the channel changes. This
    * should be an integer timestamp.
    *
    * @var integer
    */
   protected $pubDate = 0;

   /**
    * The date-time the last time the content of the channel changed. This must
    * be an integer timestamp
    *
    * @var integer
    */
   protected $lastBuildDate = 0;

   /**
    * A URL, points to the documentation for the format used in the RSS file.
    * It's probably a pointer to this page. It's for people who might stumble
    * across an RSS file on a Web server 25 years from now and wonder what it is.
    * Maximum length is 500.
    *
    * @var string
    */
   protected $docs = 'http://backend.userland.com/rss091';

   /**
    * Contains strings whose value are Monday, Tuesday, Wednesday, Thursday, Friday,
    * Saturday or Sunday. Aggregators may not read the channel during hours
    * listed in the skipDays element. (Most aggregators seem to ignore this
    * element.)
    *
    * @var array
    */
   protected $skipDays = array();

   /**
    * Contains up to 24 elements whose value is a number between 1 and 24,
    * representing a time in GMT, when aggregators, if they support the feature,
    * may not read the channel on days listed in the skipHours element. (Most
    * aggregators seem to ignore this element.)
    *
    * @var array
    */
   protected $skipHours = array();

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * Valid day names
    *
    * @var array
    */
   protected $validDays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

   /**
    * We are generating RSS, and so are the classes extending from us
    *
    * @var string
    */
   protected $type = 'rss';

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Sets the values for the channel properties
    *
    * @param string $title
    * @param string $description
    * @param string $link
    */
   public function __construct($title, $description, $link, $language='en')
   {
      $this->setTitle($title);
      $this->setDescription($description);
      $this->setLink($link);
      $this->setLanguage($language);
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
         throw new CException(Yii::t('EWebFeed', 'Title must be an up-to 40 chars string'));
      $this->title = $this->encode(substr($value, 0, 40));
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
         throw new CException(Yii::t('EWebFeed', 'Description must be an up-to 500 chars string'));
      $this->description = $this->encode(substr($value, 0, 500));
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
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be an up-to 500 chars string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode(substr($value, 0, 500));
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

   /**
    * Sets the language
    *
    * @param string $value
    */
   public function setLanguage($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Language must be one of this list: http://backend.userland.com/stories/storyReader$16'));
      $this->language = $value;
   }

   /**
    * Gets the language
    *
    * @return string
    */
   public function getLanguage()
   {
      return $this->language;
   }

   /**
    * Sets the copyright
    *
    * @param string $value
    */
   public function setCopyright($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Copyright must be an up-to 100 chars string'));
      $this->copyright = $this->encode(substr($value, 0, 100));
   }

   /**
    * Gets the copyright
    *
    * @return string
    */
   public function getCopyright()
   {
      return $this->copyright;
   }

   /**
    * Set managingEditor
    *
    * @param string $value
    */
   public function setManagingEditor($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'managingEditor must be an up-to 100 char string'));
         $this->managingEditor = $this->encode(substr($value, 0, 100));
   }

   /**
    * Get managingEditor
    *
    * @return string
    */
   public function getManagingEditor()
   {
      return $this->managingEditor;
   }

   /**
    * Sets the webMaster
    *
    * @param string $value
    */
   public function setWebMaster($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'webMaster must be an up-to 100 chars string'));
      $this->webMaster = $this->encode(substr($value, 0, 100));
   }

   /**
    * Gets the webMaster
    *
    * @return string
    */
   public function getWebMaster()
   {
      return $this->webMaster;
   }

   /**
    * Sets the rating
    *
    * @param string $value
    */
   public function setRating($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Rating must be an up-to 500 chars string'));
      $this->rating = $this->encode(substr($value, 0, 500));
   }

   /**
    * Gets the rating
    *
    * @return string
    */
   public function getRating()
   {
      return $this->rating;
   }

   /**
    * Sets the pubDate
    *
    * @param integer $value
    */
   public function setPubDate($value)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'pubDate must be an integer timestamp'));
         $this->pubDate = $value;
   }

   /**
    * Gets the pubDate
    *
    * @return integer
    */
   public function getPubDate()
   {
      return $this->pubDate;
   }

   /**
    * Sets the lastBuildDate
    *
    * @param integer $value
    */
   public function setLastBuildDate($value)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'lastBuildDate must be an integer timestamp'));
         $this->lastBuildDate = $value;
   }

   /**
    * Gets the lastBuildDate
    *
    * @return integer
    */
   public function getLastBuildDate()
   {
      return $this->lastBuildDate;
   }

   /**
    * Sets docs
    *
    * @param string $value
    */
   public function setDocs($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'docs must be an up-to 500 chars string'));
      $this->docs = substr($value, 0, 500);
   }

   /**
    * Get docs
    *
    * @return string
    */
   public function getDocs()
   {
      return $this->docs;
   }

   /**
    * Sets skipDays
    *
    * @param array $value
    */
   public function setSkipDays($value)
   {
      if (!is_array($value) || empty($value) || (count($value)>7))
         throw new CException(Yii::t('EWebFeed', 'skipDays must be an array with at least one element'));      
      foreach ($value as $v)
         if (!in_array($v, $this->validDays))
            throw new CException(Yii::t('yii', 'Must be one of {days}', array('{days}'=>implode(', ', $this->validDays))));
      $this->skipDays = $value;
   }

   /**
    * Gets skipDays
    *
    * @return array
    */
   public function getSkipDays()
   {
      return $this->skipDays;
   }

   /**
    * Sets skipHours
    *
    * @param array $value
    */
   public function setSkipHours($value)
   {
      if (!is_array($value) || empty($value) || (count($value)>24))
         throw new CException(Yii::t('EWebFeed', 'skipHours must be an array with integer elements between 1 and 24'));
      foreach ($value as $v)
         if (!is_int($v) || $v < 1 || $v > 24)
            throw new CException(Yii::t('EWebFeed', 'Must be an integer between 1 and 24'));
      $this->skipHours = $value;
   }

   /**
    * Gets skipHours
    *
    * @return array
    */
   public function getSkipHours()
   {
      return $this->skipHours;
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
   public function addItem($title, $link, $description='')
   {
      $count = count($this->items);
      if (($count+1) > 15)
         throw new CException(Yii::t('EWebFeed', 'In RSS 0.91 you can add up to 15 items only'));
      $this->items[] = new EFeedChannelItemRSS091($title, $link, $description);
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
      $this->image = new EFeedChannelImageRSS091($title, $url, $link, $description, $width, $height);
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
      $this->textInput = new EFeedChannelTextInputRSS091($title, $description, $name, $link);
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
      $xml->writeAttribute('version', '0.91');

      $xml->startElement('channel');

      $xml->writeElement('title', $this->title);
      $xml->writeElement('description', $this->description);
      $xml->writeElement('link', $this->link);
      $xml->writeElement('language', $this->language);

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
      else throw new CException(Yii::t('EWebFeed', 'An image element is required by the RSS 0.91 specification'));

      if ($this->copyright !== '') $xml->writeElement('copyright', $this->copyright) ; 
      if ($this->managingEditor !== '') $xml->writeElement('managingEditor', $this->managingEditor);
      if ($this->webMaster !== '') $xml->writeElement('webMaster', $this->webMaster);
      if ($this->rating !== '') $xml->writeElement('rating', $this->rating);
      if ($this->pubDate !== 0) $xml->writeElement('pubDate', CTimestamp::formatDate('r', $this->pubDate));
      if ($this->lastBuildDate !== 0) $xml->writeElement('lastBuildDate', CTimestamp::formatDate('r', $this->lastBuildDate));
      if ($this->docs !== '') $xml->writeElement('docs', $this->docs);

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

      foreach ($this->items as $item) {
         $xml->startElement('item');
         $xml->writeElement('title', $item->title);
         $xml->writeElement('link', $item->link);
         $xml->writeElement('description', $item->description);
         $xml->endElement();
      }

      $xml->endElement();
      $xml->endElement();
      $xml->endDocument();

      return $xml->outputMemory();
   }
}

/**
 * EFeedChannelItemRSS091 implements the specification of a RSS 0.91 item element
 *
 * @author MetaYii
 */
class EFeedChannelItemRSS091 extends EFeedElement
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   /**
    * Item title
    * Max. 100 chars
    *
    * @var string
    */
   protected $title = '';

   /**
    * Item link
    * Max. 500 chars
    *
    * @var string
    */
   protected $link = '';

   /**
    * The story synopsis. Maximum length is 500
    *
    * @var string
    */
   protected $description = '';

   //***************************************************************************
   // Constructor
   //***************************************************************************
   
   public function __construct($title, $link, $description='')
   {
      $this->setTitle($title);
      $this->setLink($link);
      $this->setDescription($description);
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
         throw new CException(Yii::t('EWebFeed', 'Title must be an up-to 40 chars string'));
      $this->title = $this->encode(substr($value, 0, 40));
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
         throw new CException(Yii::t('EWebFeed', 'Link must be an up-to 500 chars string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode(substr($value, 0, 500));
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
         throw new CException(Yii::t('EWebFeed', 'descrption must be an up-to 500 chars string'));
      $this->description = $this->encode(substr($value, 0, 500));
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
}

/**
 * EFeedChannelImageRSS091 implements the specification of a RSS 0.91
 * image element
 *
 * @author MetaYii
 */
class EFeedChannelImageRSS091 extends EFeedElement
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   /**
    * Image ALT text
    * Max. 40 chars
    *
    * @var string
    */
   protected $title = '';

   /**
    * Image location (URL)
    * Max. 500 chars
    *
    * @var string
    */
   protected $url = '';

   /**
    * Image links to: (URL)
    * Max. 500 chars
    *
    * @var string
    */
   protected $link = '';

   /**
    * Contains text that is included in the TITLE attribute of the link formed
    * around the image in the HTML rendering.
    *
    * @var string
    */
   protected $description = '';

   /**
    * Width of the image.
    * Max. 144
    *
    * @var integer
    */
   protected $width = 88;

   /**
    * Height of the image.
    * Max. 400
    *
    * @var <type>
    */
   protected $height = 31;

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($title, $url, $link, $description='', $width=88, $height=31)
   {
      $this->setTitle($title);
      $this->setUrl($url);
      $this->setLink($link);
      $this->setDescription($description);
      $this->setWidth($width);
      $this->setHeight($height);
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
         throw new CException(Yii::t('EWebFeed', 'Title must be an up-to 40 chars string'));
      $this->title = $this->encode(substr($value, 0, 40));
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
         throw new CException(Yii::t('EWebFeed', 'URL must be an up-to 500 chars string'));
      EWebFeed::validateURI($value);
      $this->url = $this->encode(substr($value, 0, 500));
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
         throw new CException(Yii::t('EWebFeed', 'Link must be an up-to 500 chars string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode(substr($value, 0, 500));
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

   /**
    * Sets the description
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'desciption must be an up-to 500 chars string'));
      $this->description = $this->encode(substr($value, 0, 500));
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
    * Sets the width
    *
    * @param integer $value
    */
   public function setWidth($value)
   {
      if (!is_int($value) || $value>144)
         throw new CException(Yii::t('EWebFeed', 'width must be an integer, maximun value of 144'));
      $this->width = $value;
   }

   /**
    * Gets the width
    *
    * @return integer
    */
   public function getWidth()
   {
      return $this->width;
   }

   /**
    * Sets the height
    *
    * @param integer $value
    */
   public function setHeight($value)
   {
      if (!is_int($value) || $value>400)
         throw new CException(Yii::t('EWebFeed', 'height must be an integer, maximun value of 400'));
      $this->height = $value;
   }

   /**
    * Gets the width
    *
    * @return integer
    */
   public function getHeight()
   {
      return $this->height;
   }
}

/**
 * EFeedChannelTextInputRSS091 implements the specification of a RSS 0.91
 * textinput element
 *
 * @author MetaYii
 */
class EFeedChannelTextInputRSS091 extends EFeedElement
{
   //***************************************************************************
   // Text input definition
   //***************************************************************************

   /**
    * Text input title
    * Max. 40 chars
    *
    * @var string
    */
   protected $title = '';

   /**
    * Text input title
    * Max. 100 chars
    *
    * @var string
    */
   protected $description = '';

   /**
    * Text input name
    * Max. 500 chars
    *
    * @var string
    */
   protected $name = '';

   /**
    * Text input links to: (URL)
    * Max. 500 chars
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
   public function __construct($title, $description, $name, $link)
   {
      $this->setTitle($title);
      $this->setDescription($description);
      $this->setName($name);
      $this->setLink($link);
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
         throw new CException(Yii::t('EWebFeed', 'Title must be an up-to 40 chars string'));
      $this->title = $this->encode(substr($value, 0, 40));
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
         throw new CException(Yii::t('EWebFeed', 'Description must be an up-to 100 chars string'));
      $this->description = $this->encode(substr($value, 0, 100));
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
    * Sets the link
    *
    * @param string $value
    */
   public function setLink($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Link must be an up-to 500 chars string'));
      EWebFeed::validateURI($value);
      $this->link = $this->encode(substr($value, 0, 500));
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

   /**
    * Sets the name. This is needed because the length changed to 20 chars   *
    * @param string $value
    */
   public function setName($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'Name must be an up-to 20 chars string'));
      $this->name = $this->encode(substr($value, 0, 20));
   }

   public function getName()
   {
      return $this->name;
   }
}