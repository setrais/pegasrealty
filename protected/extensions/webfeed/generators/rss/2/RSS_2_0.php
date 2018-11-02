<?php
/**
 * RSS_2_0 class file
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
 * About the RSS 2.0 specification:
 * 
 * "RSS 2.0 is offered by the Berkman Center for Internet & Society at Harvard
 * Law School under the terms of the Attribution/Share Alike Creative Commons
 * license. The author of this document is Dave Winer, founder of UserLand
 * software, and fellow at Berkman Center."
 *
 * The Attribution/Share Alike Creative Commons License can be found {here:
 * @link http://creativecommons.org/licenses/by-sa/1.0/}
 */

/**
 * RSS_2_0 implements the RSS 2.0 (Really Simple Sindication) specification as
 * explained {here @see http://cyber.law.harvard.edu/rss/rss.html}
 * 
 * @author MetaYii
 * @link http://cyber.law.harvard.edu/rss/rss.html
 */
class RSS_2_0 extends RSS_0_93 implements IFeedGenerator
{
   //***************************************************************************
   // Channel definition
   //***************************************************************************

   // Inherits all elements from RSS 0.93 plus these:

   // Optional

   /**
    * Specify one or more categories that the channel belongs to.
    *
    * @var array
    */
   public $categories = array();

   /**
    * A string indicating the program used to generate the channel
    *
    * @var string
    */
   protected $generator = 'Yii Framework';

   /**
    * Stands for time to live. It's a number of minutes that indicates how
    * long a channel can be cached before refreshing from the source
    *
    * @var integer
    */
   protected $ttl = 0;

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($title, $description, $link, $language='')
   {
      parent::__construct($title, $description, $link, $language);
      $this->generator = 'Yii framework ver. '.Yii::getVersion();
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the TTL
    *
    * @param integer $value
    */
   public function setTtl($value)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'ttl must be an integer'));
      $this->ttl = $value;
   }

   /**
    * Gets the TTL
    *
    * @return integer
    */
   public function getTtl()
   {
      return $this->ttl;
   }

   /**
    * Sets the generator
    *
    * @param string $value
    */
   public function setGenerator($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'generator must be a string'));
      $this->generator = $this->encode($value);
   }

   /**
    * Gets the generator
    *
    * @return string
    */
   public function getGenerator()
   {
      return $this->generator;
   }

   //***************************************************************************
   // Public functions
   //***************************************************************************

   /**
    * Adds an item to the item array
    *
    * @param string $title the title
    * @param string $link the link
    */
   public function addItem($title='', $link='', $description='')
   {
      $this->items[] = new EFeedChannelItemRSS20($title, $link, $description);
   }

   /**
    * Adds a category to the collection
    *
    * @param string $category
    * @param string $domain
    */
   public function addCategory($category, $domain='')
   {
      $this->categories[] = new EFeedChannelCategoryRSS20($category, $domain);
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
      $xml->writeAttribute('version', '2.0');

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
      if ($this->generator !== '') $xml->writeElement('generator', $this->generator);
      if ($this->ttl !== 0) $xml->writeElement('ttl', $this->ttl);

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

      if (is_array($this->categories) && !empty($this->categories)) {
         foreach ($this->categories as $category) {
            $xml->startElement('category');
            if ($category->domain !== '') {
               $xml->writeAttribute('domain', $category->domain);
            }
            $xml->text($category->category);
            $xml->endElement();
         }
      }

      foreach ($this->items as $item) {
         $xml->startElement('item');
         if ($item->title !== '') $xml->writeElement('title', $item->title);
         if ($item->link !== '') $xml->writeElement('link', $item->link);
         if ($item->description !== '') {
            $xml->startElement('description');
            $xml->writeCdata($item->description);
            $xml->endElement();
         }
         if ($item->pubDate !== 0) $xml->writeElement('pubDate', CTimestamp::formatDate('r', $item->pubDate));
         if ($item->author !== '') $xml->writeElement('author', $item->author);
         if ($item->comments !== '') $xml->writeElement('comments', $item->comments);
         if ($item->guid !== '') {
            $xml->startElement('guid');
            $permaLink = $item->guidIsPermaLink ? 'true' : 'false';
            $xml->writeAttribute('isPermaLink', $permaLink);
            $xml->text($item->guid);
            $xml->endElement();
         }
         if (!is_null($item->source)) {
            $xml->startElement('source');
            $xml->writeAttribute('url', $item->source->url);
            $xml->text($item->source->source);
            $xml->endElement();
         }
         if (is_array($item->enclosure)) {
            foreach ($item->enclosure as $enclosure) {
               $xml->startElement('enclosure');
               $xml->writeAttribute('url', $enclosure->url);
               $xml->writeAttribute('length', $enclosure->length);
               $xml->writeAttribute('type', $enclosure->type);
               $xml->endElement();
            }
         }
         if (is_array($item->category)) {            
            foreach ($item->category as $cat) {
               $xml->startElement('category');
               if ($cat->domain !== '') {
                  $xml->writeAttribute('domain', $cat->domain);
               }
               $xml->text($cat->category);
               $xml->endElement();
            }
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
 * Class representing a category of a channel
 *
 * @author MetaYii
 */
class EFeedChannelCategoryRSS20 extends EFeedElement
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

/**
 * EFeedChannelItemRSS20 implements the specification of a RSS 0.93 item element
 *
 * @author MetaYii
 */
class EFeedChannelItemRSS20 extends EFeedChannelItemRSS093
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   // Inherits all elements from RSS 0.93 plus these:

   // Optional

   /**
    * Email address of the author of the item.
    *
    * @var string
    */
   protected $author = '';

   /**
    * URL of a page for comments relating to the item.
    *
    * @var string
    */
   protected $comments = '';

   /**
    * A string that uniquely identifies the item.
    *
    * @var string
    */
   protected $guid = '';

   /**
    * A boolean which indicates if the guid is a permalink.
    *
    * @var boolean
    */
   protected $guidIsPermaLink = true;

   /**
    * It has one optional attribute, domain, a string that identifies a
    * categorization taxonomy.
    * The value of the element is a forward-slash-separated string that
    * identifies a hierarchic location in the indicated taxonomy. Processors may
    * establish conventions for the interpretation of categories.
    *
    * You may include as many category elements as you need to, for different
    * domains, and to have an item cross-referenced in different parts of the
    * same domain.
    *
    * @var object
    */
   protected $category = array();

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($title='', $link='', $description='', $guid='', $guidIsPermaLink=true)
   {
      parent::__construct($title, $link, $description);
      $this->setGuid($guid);
      $this->setGuidIsPermaLink($guidIsPermaLink);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the author
    *
    * @param string $value
    */
   public function setAuthor($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'author must be a string'));
      $this->author = $value;
   }

   /**
    * Gets the author
    *
    * @return string
    */
   public function getAuthor()
   {
      return $this->author;
   }

   /**
    * Sets the comments
    *
    * @param string $value
    */
   public function setComments($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'comments must be string'));
      $this->comments = $value;
   }

   /**
    * Gets the comments
    *
    * @return string
    */
   public function getComments()
   {
      return $this->comments;
   }

   /**
    * Sets the guid
    *
    * @param string $value
    */
   public function setGuid($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'guid must be a string'));
      $this->guid = $value;
   }

   /**
    * Gets the guid
    *
    * @return string
    */
   public function getGuid()
   {
      return $this->guid;
   }

   /**
    * Sets guidIsPermaLink
    *
    * @param boolean $value
    */
   public function setGuidIsPermaLink($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('EWebFeed', 'value must be boolean'));
      $this->guidIsPermaLink = $value;
   }

   /**
    * Gets guidIsPermaLink
    *
    * @return boolean
    */
   public function getGuidIsPermaLink()
   {
      return $this->guidIsPermaLink;
   }

   /**
    * Sets the description. In RSS 2.0 there can be HTML inside the item
    * description.
    * See {@link http://cyber.law.harvard.edu/rss/encodingDescriptions.html}
    *
    * @param string $value
    */
   public function setDescription($value)
   {
      $this->description = $value;
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Sets the category
    *
    * @param string $category
    * @param string $domain
    */
   public function addCategory($category, $domain)
   {
      $this->category[] = new EFeedChannelItemCategoryRSS20($category, $domain);
   }
}

/**
 * EFeedChannelItemCategoryRSS20 implements the category element of the RSS 2.0
 * specification (basically the same as RSS 0.92 :) )
 *
 * @author MetaYii
 */
class EFeedChannelItemCategoryRSS20 extends EFeedChannelItemCategoryRSS092
{
}