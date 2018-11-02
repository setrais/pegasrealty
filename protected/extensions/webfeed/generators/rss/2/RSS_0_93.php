<?php
/**
 * RSS_0_93 class file
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
 * Copyright and disclaimer of the RSS 0.93 specification:
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
 * RSS_0_93 implements the RSS 0.93 (Really Simple Sindication) specification as
 * explained {here @see http://backend.userland.com/rss093}
 * This implementation is here for historical purposes, since this specification
 * has been superseded since long ago. The 0.93 specification is in the road to
 * 2.0, and 0.91 is still used, so we need it.
 *
 * @author MetaYii
 * @link http://backend.userland.com/rss093
 */
class RSS_0_93 extends RSS_0_92 implements IFeedGenerator
{
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
      $this->items[] = new EFeedChannelItemRSS093($title, $link, $description);
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
      $xml->writeAttribute('version', '0.93');

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
         if ($item->pubDate !== 0) $xml->writeElement('pubDate', CTimestamp::formatDate('r', $item->pubDate));
         if ($item->expirationDate !== 0) $xml->writeElement('expirationDate', CTimestamp::formatDate('r', $item->expirationDate));
         if (!is_null($item->source)) {
            $xml->startElement('source');
            $xml->writeAttribute('url', $item->source->url);
            $xml->text($item->source->source);
            $xml->endElement();
         }
         if (!is_null($item->enclosure) && is_array($item->enclosure)) {
            foreach ($item->enclosure as $enclosure) {
               $xml->startElement('enclosure');
               $xml->writeAttribute('url', $enclosure->url);
               $xml->writeAttribute('length', $enclosure->length);
               $xml->writeAttribute('type', $enclosure->type);
               $xml->endElement();
            }
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
 * EFeedChannelItemRSS093 implements the specification of a RSS 0.93 item element
 *
 * @author MetaYii
 */
class EFeedChannelItemRSS093 extends EFeedChannelItemRSS092 implements Iterator
{
   //***************************************************************************
   // Item definition
   //***************************************************************************

   // Optional

   /**
    * In RSS 0.93 there can be multiple enclosures in an Item
    *
    * @var array
    */
   protected $enclosure = array();

   /**
    * Its value is a timestamp, indicating when the item will become available.
    *
    * @var integer
    */
   protected $pubDate = 0;

   /**
    * Its value is a timestamp, indicating when the item is no longer available.
    *
    * @var integer
    */
   protected $expirationDate = 0;

   //***************************************************************************
   // Iterator implementation
   //***************************************************************************

   /**
    * The array pointer
    *
    * @var integer
    */
   protected $position = 0;

   /**
    * Go to the beginning of the array of items
    */
   public function rewind()
   {
      $this->position = 0;
   }

   /**
    * Returns the current item
    *
    * @return object
    */
   public function current()
   {
      return $this->channel->enclosure[$this->position];
   }

   /**
    * Returns the array pointer
    *
    * @return integer
    */
   public function key()
   {
      return $this->position;
   }

   /**
    * Moves the pointer one place forward
    */
   public function next()
   {
      ++$this->position;
   }

   /**
    * Whetever the item pointed by the array pointer exists
    *
    * @return boolean
    */
   public function valid()
   {
      return isset($this->channel->enclosure[$this->position]);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets pubDate
    *
    * @param integer $value 
    */
   public function setPubDate($value=0)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'pubDate must be an integer'));
      $this->pubDate = $value;
   }

   /**
    * Gets pubDate
    *
    * @return integer
    */
   public function getPubDate()
   {
      return $this->pubDate;
   }

   /**
    * Sets expirationDate
    *
    * @param integer $value
    */
   public function setExpirationDate($value=0)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'expirationDate must be an integer'));
      $this->expirationDate = $value;
   }

   /**
    * Gets expirationDate
    *
    * @return integer
    */
   public function getExpirationDate()
   {
      return $this->expirationDate;
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Adss enclosures
    *
    * @param string $url
    * @param integer $length
    * @param string $type
    */
   public function addEnclosure($url, $length, $type)
   {
      $this->enclosure[] = new EFeedChannelItemEnclosureRSS093($url, $length, $type);
   }
}

/**
 * @author MetaYii
 */
class EFeedChannelItemEnclosureRSS093 extends EFeedChannelItemEnclosureRSS092
{
}