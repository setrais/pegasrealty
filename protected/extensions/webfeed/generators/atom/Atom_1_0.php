<?php
/**
 * Atom_1_0 class file
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
 * The RFC 4287 is Copyright (C) The Internet Society (2005).
 */

/**
 * Atom_1_0 implements the RFC 4287, which defines the Atom Syndication Format.
 *
 * We don't inherit from Atom_0_3 since the implementation of Atom 0.3 is
 * heavily discouraged, so we didn't even implement it :-)
 *
 * @link http://tools.ietf.org/html/rfc4287
 * @link http://www.atomenabled.org/developers/syndication/
 *
 * @author MetaYii
 */
class Atom_1_0 extends EFeedChannel implements IFeedGenerator
{
   //***************************************************************************
   // Properties
   //***************************************************************************

   /**
    * Link to the feed. This is required, but not a property of the feed itself,
    * but a link which will be included.
    *
    * @link http://www.atomenabled.org/developers/syndication/#requiredFeedElements
    *
    * @var <type>
    */
   protected $feedURI = '';

   //***************************************************************************
   // Channel elements
   //***************************************************************************

   // Required

   /**
    * Identifies the feed using a universally unique and permanent URI. If you
    * have a long-term, renewable lease on your Internet domain name, then you
    * can feel free to use your website's address. You can see these pages for
    * helpful tips on making good IDs:
    *
    * @link http://diveintomark.org/archives/2004/05/28/howto-atom-id
    * @link http://www.taguri.org/
    * @link http://www.faqs.org/rfcs/rfc4151.html    
    *
    * @var string
    */
   protected $id = '';

   /**
    * Contains a human readable title for the feed. Often the same as the title
    * of the associated website. This value should not be blank.
    *
    * @var EFeedTextAtom10
    */
   protected $title = null;

   /**
    * Indicates the last time the feed was modified in a significant way. This
    * is a timestamp as returned by time()
    *
    * @var integer
    */
   protected $updated = 0;

   // Recommended

   /**
    * Names one author of the feed. A feed may have multiple author elements. A
    * feed must contain at least one author element unless all of the entry
    * elements contain at least one author element.
    *
    * @var array of EFeedPersonAtom10
    */
   protected $authors = array();

   /**
    * Identifies a related Web page. The type of relation is defined by the rel
    * attribute. A feed is limited to one alternate per type and hreflang. A
    * feed should contain a link back to the feed itself.
    *
    * @var array of EFeedLinkAtom10
    */
   protected $links = array();

   // Optional

   /**
    * Specifies a category that the feed belongs to. A feed may have multiple
    * category elements.
    *
    * @var array of EFeedCategoryAtom10
    */
   protected $categories = array();

   /**
    * Names one contributor to the feed. An feed may have multiple contributor
    * elements.
    *
    * @var array of EFeedPersonAtom10
    */
   protected $contributors = array();

   /**
    * Identifies the software used to generate the feed, for debugging and other
    * purposes. Both the uri and version attributes are optional.
    *
    * @var EFeedChannelGeneratorAtom10
    */
   protected $generator = null;

   /**
    * Identifies a small image which provides iconic visual identification for
    * the feed. Icons should be square.
    *
    * @var string
    */
   protected $icon = '';

   /**
    * Identifies a larger image which provides visual identification for the
    * feed. Images should be twice as wide as they are tall.
    *
    * @var string
    */
   protected $logo = '';

   /**
    * Conveys information about rights, e.g. copyrights, held in and over the
    * feed.
    *
    * @var EFeedTextAtom10
    */
   protected $rights = null;

   /**
    * Contains a human-readable description or subtitle for the feed.
    *
    * @var EFeedTextAtom10
    */
   protected $subtitle = null;

   //***************************************************************************
   // Feed definition
   //***************************************************************************

   /**
    * We are generating Atom feeds
    *
    * @var string
    */
   protected $type = 'atom';

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
    * @param string $value 
    */
   public function setFeedURI($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'value must be a string'));
      EWebFeed::validateURI($value);
      $this->feedURI = $value;
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getFeedURI()
   {
      return $this->feedURI;
   }

   /**
    * Sets the ID
    *
    * @param string $value the id
    */
   public function setId($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'id must be a string'));
      EWebFeed::validateURI($value);
      $this->id = $value;
   }

   /**
    * Gets the ID
    *
    * @return string
    */
   public function getId()
   {
      return $this->id;
   }

   /**
    * Sets the updated
    *
    * @param integer $value the updated
    */
   public function setUpdated($value)
   {
      if (!is_integer($value))
         throw new CException(Yii::t('EWebFeed', 'updated must be an integer'));
      $this->updated = $value;
   }

   /**
    * Gets the updated
    *
    * @return integer
    */
   public function getUpdated()
   {
      return $this->updated;
   }

   /**
    * Sets the icon
    *
    * @param string $value
    */
   public function setIcon($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'icon must be a string'));
      $this->icon = $value;
   }

   /**
    * Gets the icon
    *
    * @return string
    */
   public function getIcon()
   {
      return $this->icon;
   }

   /**
    * Sets the logo
    *
    * @param string $value
    */
   public function setLogo($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'logo must be a string'));
      $this->logo = $value;
   }

   /**
    * Gets the logo
    *
    * @return string
    */
   public function getLogo()
   {
      return $this->logo;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($id, $title=null, $updated=0, $feedURI='')
   {
      $this->setId($id);
      if ($feedURI !== '')
         $this->setFeedURI($feedURI);
      if ($updated !== 0)
         $this->setUpdated($updated);
      if ($title != null)
         $this->addTitle($title);
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Adds the title.
    *
    * @param string $title the title
    * @param string $type the type
    */
   public function addTitle($title, $type='text')
   {
      if (!is_string($title) || empty($title))
         throw new CException(Yii::t('EWebFeed', 'title must be a non-blank string'));
      $this->title = new EFeedTextAtom10($title, $type);
   }

   /**
    * Adds an author
    *
    * @param string $name the name
    * @param string $uri the URI
    * @param string $email the email
    */
   public function addAuthor($name, $uri='', $email='')
   {
      $this->authors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the link
    *
    * @param string $href
    * @param string $rel
    * @param string $type
    * @param string $hreflang
    * @param string $title
    * @param integer $length
    */
   public function addLink($href, $rel='', $type='', $hreflang='', $title='', $length=0)
   {
      foreach ($this->links as $link) {
         if (($link->hreflang == $hreflang) && ($link->type == $type) && (($link->rel == 'alternate') && ($rel == 'alternate')))
            throw new CException(Yii::t('EWebFeed', 'A feed is limited to one "alternate" rel per {type} and {hreflang}', array('{type}'=>$type, '{hreflang}'=>$hreflang)));
      }
      $this->links[] = new EFeedLinkAtom10($href, $rel, $type, $hreflang, $title, $length);
   }

   /**
    * Adds a category
    *
    * @param string $term
    * @param string $scheme
    * @param string $label
    */
   public function addCategory($term, $scheme='', $label='')
   {
      $this->categories[] = new EFeedCategoryAtom10($term, $scheme, $label);
   }

   /**
    * Adds an contributor
    *
    * @param string $name the name
    * @param string $uri the URI
    * @param string $email the email
    */
   public function addContributor($name, $uri='', $email='')
   {
      $this->contributors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the generator information
    *
    * @param string $generator
    * @param string $version
    * @param string $uri 
    */
   public function addGenerator($generator, $version='', $uri='')
   {
      $this->generator = new EFeedChannelGeneratorAtom10($generator, $version, $uri);
   }

   /**
    * Adds the rights string
    *
    * @param string $text
    * @param string $type
    */
   public function addRights($text, $type='text')
   {
      $this->rights = new EFeedTextAtom10($text, $type);
   }

   /**
    * Adds a subtitle
    *
    * @param string $text
    * @param string $type 
    */
   public function addSubtitle($text, $type='text')
   {
      $this->subtitle = new EFeedTextAtom10($text, $type);
   }

   /**
    * Adds an entry
    *
    * @param string $id
    * @param integer $updated
    * @param string $title
    * @param string $content
    */
   public function addEntry($id, $updated, $title=null, $content=null)
   {
      $this->items[] = new EFeedChannelEntryAtom10($id, $updated, $title, $content);
   }

   //***************************************************************************

   /**
    * Generates the XML for the channel
    *
    * @return string XML
    */
   public function generateXML()
   {
      $contentOk = false;

      $xml = new xmlWriter();
      $xml->openMemory();
      $xml->setIndent(true);

      $xml->startDocument('1.0', $this->charset);

      $xml->startElement('feed');
      $xml->writeAttribute('xmlns', 'http://www.w3.org/2005/Atom');

      $xml->writeElement('id', $this->id);

      if (is_null($this->title))
         throw new CException(Yii::t('EWebFeed', 'A title is required'));
      $xml->startElement('title');
      $xml->writeAttribute('type', $this->title->type);
      if ($this->title->language !== '') $xml->writeAttribute('xml:lang', $this->title->language);
      switch ($this->title->type) {
         case 'text':
            $xml->text($this->title->text);
            break;
         case 'html':
            $xml->writeCdata($this->title->text);
            break;
         case 'xhtml':
            $xml->startElement('div');
            $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
            $xml->writeRaw($this->title->text);
            $xml->endElement();
            break;
      }
      $xml->endElement();

      if ($this->updated === 0)
         throw new CException(Yii::t('EwebFeed', 'Updated time must be set'));
      $xml->writeElement('updated', date(DATE_ATOM, $this->updated));

      foreach ($this->authors as $author) {
         $xml->startElement('author');
         if ($author->base !== '') $xml->writeAttribute('xml:base', $author->base);
         $xml->startElement('name');
         if ($author->language !== '') $xml->writeAttribute('xml:lang', $author->language);
         $xml->writeRaw($author->name);
         $xml->endElement();
         if ($author->uri !== '') $xml->writeElement('uri', $author->uri);
         if ($author->email !== '') $xml->writeElement('email', $author->email);
         $xml->endElement();
      }

      if ($this->feedURI !== '') {
         $xml->startElement('link');
         $xml->writeAttribute('href', $this->feedURI);
         $xml->writeAttribute('rel', 'self');
         $xml->endElement();
      }

      foreach ($this->links as $link) {
         $xml->startElement('link');
         if ($link->base !== '') $xml->writeAttribute('xml:base', $link->base);
         $xml->writeAttribute('href', $link->href);
         if ($link->rel !== '') $xml->writeAttribute('rel', $link->rel);
         if ($link->type !== '') $xml->writeAttribute('type', $link->type);
         if ($link->hreflang !== '') $xml->writeAttribute('hreflang', $link->hreflang);
         if ($link->title !== '') $xml->writeAttribute('title', $link->title);
         if ($link->length !== 0) $xml->writeAttribute('length', $link->length);
         $xml->endElement();
      }

      foreach ($this->categories as $category) {
         $xml->startElement('category');
         if ($category->base !== '') $xml->writeAttribute('xml:base', $category->base);
         $xml->writeAttribute('term', $category->term);
         if (!empty($category->scheme)) $xml->writeAttribute('scheme', $category->scheme);
         if (!empty($category->label)) $xml->writeAttribute('label', $category->label);
         $xml->endElement();
      }

      foreach ($this->contributors as $contributor) {
         $xml->startElement('contributor');
         if ($contributor->base !== '') $xml->writeAttribute('xml:base', $contributor->base);
         $xml->startElement('name');
         if ($contributor->language !== '') $xml->writeAttribute('xml:lang', $contributor->language);
         $xml->writeRaw($contributor->name);
         $xml->endElement();
         if ($contributor->uri !== '') $xml->writeElement('uri', $contributor->uri);
         if ($contributor->email !== '') $xml->writeElement('email', $contributor->email);
         $xml->endElement();
      }

      if (!is_null($this->generator)) {
         $xml->startElement('generator');
         if ($this->generator->base !== '') $xml->writeAttribute('xml:base', $this->generator->base);
         if (!$this->generator->uri !== '') $xml->writeAttribute('uri', $this->generator->uri);
         if (!$this->generator->version !== '') $xml->writeAttribute('version', $this->generator->version);
         $xml->writeRaw($this->generator->generator);
         $xml->endElement();
      }

      if ($this->icon !== '') $xml->writeElement('icon', $this->icon);

      if ($this->logo !== '') $xml->writeElement('logo', $this->logo);

      if (!is_null($this->rights)) {
         $xml->startElement('rights');
         $xml->writeAttribute('type', $this->rights->type);
         if ($this->rights->language !== '') $xml->writeAttribute('xml:lang', $this->rights->language);
         switch ($this->rights->type) {
            case 'text':
               $xml->text($this->rights->text);
               break;
            case 'html':
               $xml->writeCdata($this->rights->text);
               break;
            case 'xhtml':
               $xml->startElement('div');
               $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
               $xml->writeRaw($this->rights->text);
               $xml->endElement();
               break;
         }
         $xml->endElement();
      }

      if (!is_null($this->subtitle)) {
         $xml->startElement('subtitle');
         $xml->writeAttribute('type', $this->subtitle->type);
         if ($this->subtitle->language !== '') $xml->writeAttribute('xml:lang', $this->subtitle->language);
         switch ($this->subtitle->type) {
            case 'text':
               $xml->text($this->subtitle->text);
               break;
            case 'html':
               $xml->writeCdata($this->subtitle->text);
               break;
            case 'xhtml':
               $xml->startElement('div');
               $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
               $xml->writeRaw($this->subtitle->text);
               $xml->endElement();
               break;
         }
         $xml->endElement();
      }
      
      foreach ($this->items as $entry) {
         $xml->startElement('entry');

         $xml->writeElement('id', $entry->id);

         if (is_null($entry->title))
            throw new CException(Yii::t('EWebFeed', 'A title is required'));
         $xml->startElement('title');
         $xml->writeAttribute('type', $entry->title->type);
         if ($entry->title->language !== '') $xml->writeAttribute('xml:lang', $entry->title->language);
         switch ($entry->title->type) {
            case 'text':
               $xml->text($entry->title->text);
               break;
            case 'html':
               $xml->writeCdata($entry->title->text);
               break;
            case 'xhtml':
               $xml->startElement('div');
               $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
               $xml->writeRaw($entry->title->text);
               $xml->endElement();
               break;
         }
         $xml->endElement();

         $xml->writeElement('updated', date(DATE_ATOM, $this->updated));

         if (empty($entry->authors) && empty($this->authors))
            throw new CException(Yii::t('EWebFeed', 'Missing entry element: author'));
         foreach ($entry->authors as $author) {
            $xml->startElement('author');
            if ($author->base !== '') $xml->writeAttribute('xml:base', $author->base);
            $xml->startElement('name');
            if ($author->language !== '') $xml->writeAttribute('xml:lang', $author->language);
            $xml->writeRaw($author->name);
            $xml->endElement();
            if ($author->uri !== '') $xml->writeElement('uri', $author->uri);
            if ($author->email !== '') $xml->writeElement('email', $author->email);
            $xml->endElement();
         }

         if (!is_null($entry->content)) {
            $contentOk = true;
            $xml->startElement('content');
            if ($entry->content->base !== '') $xml->writeAttribute('xml:base', $entry->content->base);
            if (!empty($entry->content->src)) $xml->writeAttribute('src', $entry->content->src);
            $xml->writeAttribute('type', $entry->content->type);
            if ($entry->content->language !== '') $xml->writeAttribute('xml:lang', $entry->content->language);
            switch ($entry->content->type) {
               case 'text':
                  $xml->text($entry->content->text);
                  break;
               case 'html':
                  $xml->writeCdata($entry->content->text);
                  break;
               case 'xhtml':
                  $xml->startElement('div');
                  $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                  $xml->writeRaw($entry->content->text);
                  $xml->endElement();
                  break;
            }
            $xml->endElement();
         }

         foreach ($entry->links as $link) {
            if ($link->rel == 'alternate') $contentOk = true;
            $xml->startElement('link');
            if ($link->base !== '') $xml->writeAttribute('xml:base', $link->base);
            $xml->writeAttribute('href', $link->href);
            if ($link->rel !== '') $xml->writeAttribute('rel', $link->rel);
            if ($link->type !== '') $xml->writeAttribute('type', $link->type);
            if ($link->hreflang !== '') $xml->writeAttribute('hreflang', $link->hreflang);
            if ($link->title !== '') $xml->writeAttribute('title', $link->title);
            if ($link->length !== 0) $xml->writeAttribute('length', $link->length);
            $xml->endElement();
         }

         if (!is_null($entry->summary)) {
            $xml->startElement('summary');
            $xml->writeAttribute('type', $entry->subtitle->type);
            if ($entry->subtitle->language !== '') $xml->writeAttribute('xml:lang', $entry->subtitle->language);
            switch ($entry->subtitle->type) {
               case 'text':
                  $xml->text($entry->subtitle->text);
                  break;
               case 'html':
                  $xml->writeCdata($entry->subtitle->text);
                  break;
               case 'xhtml':
                  $xml->startElement('div');
                  $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                  $xml->writeRaw($entry->subtitle->text);
                  $xml->endElement();
                  break;
            }
            $xml->endElement();
         }

         foreach ($entry->categories as $category) {
            $xml->startElement('category');
            $xml->writeAttribute('term', $category->term);
            if ($category->scheme !== '') $xml->writeAttribute('scheme', $category->scheme);
            if ($category->scheme !== '') $xml->writeAttribute('label', $category->label);
            $xml->endElement();
         }

         foreach ($entry->contributors as $contributor) {
            $xml->startElement('contributor');
            if ($contributor->base !== '') $xml->writeAttribute('xml:base', $contributor->base);
            $xml->writeElement('name', $contributor->name);
            if ($contributor->uri !== '') $xml->writeElement('uri', $contributor->uri);
            if ($contributor->email !== '') $xml->writeElement('email', $contributor->email);
            $xml->endElement();
         }

         $xml->writeElement('published', date(DATE_ATOM, $entry->published));

         if (!is_null($entry->source)) {
            $xml->startElement('source');

            $xml->writeElement('id', $entry->source->id);

            if (!is_null($entry->source->title)) {
               $xml->startElement('title');
               $xml->writeAttribute('type', $entry->source->title->type);
               if ($entry->source->title->language !== '') $xml->writeAttribute('xml:lang', $entry->source->title->language);
               switch ($entry->source->title->type) {
                  case 'text':
                     $xml->text($entry->source->title->text);
                     break;
                  case 'html':
                     $xml->writeCdata($entry->source->title->text);
                     break;
                  case 'xhtml':
                     $xml->startElement('div');
                     $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                     $xml->writeRaw($entry->source->title->text);
                     $xml->endElement();
                     break;
               }
               $xml->endElement();
            }

            $xml->writeElement('updated', date(DATE_ATOM, $entry->source->updated));

            foreach ($entry->source->authors as $author) {
               $xml->startElement('author');
               if ($author->base !== '') $xml->writeAttribute('xml:base', $author->base);
               $xml->startElement('name');
               if ($author->language !== '') $xml->writeAttribute('xml:lang', $author->language);
               $xml->writeRaw($author->name);
               $xml->endElement();
               if ($author->uri !== '') $xml->writeElement('uri', $author->uri);
               if ($author->email !== '') $xml->writeElement('email', $author->email);
               $xml->endElement();
            }

            foreach ($entry->source->links as $link) {
               $xml->startElement('link');
               if ($link->base !== '') $xml->writeAttribute('xml:base', $link->base);
               $xml->writeAttribute('href', $link->href);
               if ($link->rel !== '') $xml->writeAttribute('rel', $link->rel);
               if ($link->type !== '') $xml->writeAttribute('type', $link->type);
               if ($link->hreflang !== '') $xml->writeAttribute('hreflang', $link->hreflang);
               if ($link->title !== '') $xml->writeAttribute('title', $link->title);
               if ($link->length !== 0) $xml->writeAttribute('length', $link->length);
               $xml->endElement();
            }

            foreach ($entry->source->categories as $category) {
               $xml->startElement('category');
               $xml->writeAttribute('term', $category->term);
               if (!empty($category->scheme)) $xml->writeAttribute('scheme', $category->scheme);
               if (!empty($category->label)) $xml->writeAttribute('label', $category->label);
               $xml->endElement();
            }

            foreach ($entry->source->contributors as $contributor) {
               $xml->startElement('contributor');
               if ($contributor->base !== '') $xml->writeAttribute('xml:base', $contributor->base);
               $xml->startElement('name');
               if ($contributor->language !== '') $xml->writeAttribute('xml:lang', $contributor->language);
               $xml->writeRaw($contributor->name);
               $xml->endElement();
               if ($contributor->uri !== '') $xml->writeElement('uri', $contributor->uri);
               if ($contributor->email !== '') $xml->writeElement('email', $contributor->email);
               $xml->endElement();
            }

            if (!is_null($entry->source->generator)) {
               $xml->startElement('generator');
               if ($entry->source->generator->base !== '') $xml->writeAttribute('xml:base', $entry->source->generator->base);
               if (!$entry->source->generator->uri !== '') $xml->writeAttribute('uri', $entry->source->generator->uri);
               if (!$entry->source->generator->version !== '') $xml->writeAttribute('version', $entry->source->generator->version);
               $xml->writeRaw($entry->source->generator->generator);
               $xml->endElement();
            }

            if ($entry->source->icon !== '') $xml->writeElement('icon', $entry->source->icon);

            if ($entry->source->logo !== '') $xml->writeElement('logo', $entry->source->logo);

            if (!is_null($entry->source->rights)) {
               $xml->startElement('rights');
               $xml->writeAttribute('type', $entry->source->rights->type);
               if ($entry->source->rights->language !== '') $xml->writeAttribute('xml:lang', $entry->source->rights->language);
               switch ($entry->source->rights->type) {
                  case 'text':
                     $xml->text($entry->source->rights->text);
                     break;
                  case 'html':
                     $xml->writeCdata($entry->source->rights->text);
                     break;
                  case 'xhtml':
                     $xml->startElement('div');
                     $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                     $xml->writeRaw($entry->source->rights->text);
                     $xml->endElement();
                     break;
               }
               $xml->endElement();
            }

            if (!is_null($entry->source->subtitle)) {
               $xml->startElement('subtitle');
               $xml->writeAttribute('type', $entry->source->subtitle->type);
               if ($entry->source->subtitle->language !== '') $xml->writeAttribute('xml:lang', $entry->source->subtitle->language);
               switch ($entry->source->subtitle->type) {
                  case 'text':
                     $xml->text($entry->source->subtitle->text);
                     break;
                  case 'html':
                     $xml->writeCdata($entry->source->subtitle->text);
                     break;
                  case 'xhtml':
                     $xml->startElement('div');
                     $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                     $xml->writeRaw($entry->source->subtitle->text);
                     $xml->endElement();
                     break;
               }
               $xml->endElement();
            }

            $xml->endElement();
         }

         if (!is_null($entry->rights)) {
            $xml->startElement('rights');
            $xml->writeAttribute('type', $entry->rights->type);
            if ($entry->source->rights->language !== '') $xml->writeAttribute('xml:lang', $entry->source->rights->language);
            switch ($entry->rights->type) {
               case 'text':
                  $xml->text($entry->rights->text);
                  break;
               case 'html':
                  $xml->writeCdata($entry->rights->text);
                  break;
               case 'xhtml':
                  $xml->startElement('div');
                  $xml->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
                  $xml->writeRaw($entry->rights->text);
                  $xml->endElement();
                  break;
            }
            $xml->endElement();
         }

         $xml->endElement();
      }

      $xml->endElement();      
      $xml->endDocument();

      if (!$contentOk)
         throw new CException(Yii::t('EWebFeed', 'Content or an alternate link must be provided.'));

      return $xml->flush();
   }
}

/**
 * Class representing an entry of a feed
 *
 * @author MetaYii
 */
class EFeedChannelEntryAtom10 extends EFeedElementAtom10
{
   //***************************************************************************
   // Entry definition
   //***************************************************************************

   // Required

   /**
    * Identifies the entry using a universally unique and permanent URI.
    * Suggestions on how to make a good id can be found here:
    *
    * @link http://diveintomark.org/archives/2004/05/28/howto-atom-id
    * @link http://www.taguri.org/
    * @link http://www.faqs.org/rfcs/rfc4151.html
    *
    * Two entries in a feed can have the same value for id if they represent the
    * same entry at different points in time.
    *
    * @var string an URI
    */
   protected $id = '';

   /**
    * Contains a human readable title for the entry. This value should not be
    * blank.
    *
    * @var EFeedTextAtom10
    */
   protected $title = null;

   /**
    * Indicates the last time the entry was modified in a significant way. This
    * value need not change after a typo is fixed, only after a substantial
    * modification. Generally, different entries in a feed will have different
    * updated timestamps. This must be an integer timestamp as the returned by
    * the time() PHP function.
    *
    * @var integer
    */
   protected $updated = 0;

   // Recommended

   /**
    * Names one author of the entry. An entry may have multiple authors. An
    * entry must contain at least one author element unless there is an author
    * element in the enclosing feed, or there is an author element in the
    * enclosed source element.
    *
    * @var array of EFeedPeopleAtom10
    */
   protected $authors = array();

   /**
    * Contains or links to the complete content of the entry. Content must be
    * provided if there is no alternate link, and should be provided if there is
    * no summary.
    *
    * @var array of EFeedEntryContentAtom10
    */
   protected $content = null;

   /**
    * Identifies a related Web page. The type of relation is defined by the rel
    * attribute. An entry is limited to one alternate per type and hreflang. An
    * entry must contain an alternate link if there is no content element.
    *
    * @var array of EFeedLinkAtom10
    */
   protected $links = array();

   /**
    * Conveys a short summary, abstract, or excerpt of the entry. Summary should
    * be provided if there either is no content provided for the entry, or that
    * content is not inline (i.e., contains a src attribute), or if the content
    * is encoded in base64.
    *
    * @var EFeedTextAtom10
    */
   protected $summary = null;

   // Optional

   /**
    * Specifies a category that the entry belongs to. A entry may have multiple
    * category elements.
    *
    * @var array of EFeedCategoryAtom10
    */
   protected $categories = array();

   /**
    * Names one contributor to the entry. An entry may have multiple contributor
    * elements.
    *
    * @var array of EFeedPersonAtom10
    */
   protected $contributors = array();

   /**
    * Contains the time of the initial creation or first availability of the
    * entry. This must be an integer timestamp as produced by the time() PHP
    * function.
    *
    * @var integer
    */
   protected $published = 0;

   /**
    * If an atom:entry is copied from one feed into another feed, then
    * the source atom:feed's metadata (all child elements of atom:feed
    * other than the atom:entry elements) MAY be preserved within the
    * copied entry by adding an atom:source child element, if it is not
    * already present in the entry, and including some or all of the
    * source feed's Metadata elements as the atom:source element's
    * children.
    *
    * Such metadata SHOULD be preserved if the source
    * atom:feed contains any of the child elements atom:author,
    * atom:contributor, atom:rights, or atom:category and those child
    * elements are not present in the source atom:entry.
    *
    * The atom:source element is designed to allow the aggregation of
    * entries from different feeds while retaining information about an
    * entry's source feed. For this reason, Atom Processors that are
    * performing such aggregation SHOULD include at least the required
    * feed-level Metadata elements (atom:id, atom:title, and
    * atom:updated) in the atom:source element.
    *
    * You need to setup the source object first, then you add the elements of
    * the source to your entry, for instance:
    *
    * $feed->entry[$i]->addSource();
    * $feed->entry[$i]->source->addTitle('Original title');
    * $feed->entry[$i]->source->setUpdated($originalTime);
    *
    * would add the time and title of the original entry to the ($i)th entry
    * of your feed.
    *
    * @var EFeedEntrySourceAtom10
    */
   protected $source = null;

   /**
    * Conveys information about rights, e.g. copyrights, held in and over the
    * entry.
    *
    * @var EFeedTextAtom10
    */
   protected $rights = null;

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the ID
    *
    * @param string $value the id
    */
   public function setId($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'id must be a string'));
      EWebFeed::validateURI($value);
      $this->id = $value;
   }

   /**
    * Gets the ID
    *
    * @return string
    */
   public function getId()
   {
      return $this->id;
   }

   /**
    * Sets the updated
    *
    * @param integer $value the updated
    */
   public function setUpdated($value)
   {
      if (!is_integer($value))
         throw new CException(Yii::t('EWebFeed', 'updated must be an integer'));
      $this->updated = $value;
   }

   /**
    * Gets the updated
    *
    * @return integer
    */
   public function getUpdated()
   {
      return $this->updated;
   }

   /**
    * Setter
    *
    * @param integer $value
    */
   public function setPublished($value)
   {
      if (!is_integer($value))
         throw new CException(Yii::t('EWebFeed', 'published must be an integer'));
      $this->published = $value;
   }

   /**
    * Getter
    *
    * @return integer
    */
   public function getPublished()
   {
      return $this->published;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($id, $updated, $title=null, $content=null, $author=null)
   {
      if (empty($title))
         throw new CException(Yii::t('EWebFeed', 'title must not be empty'));

      $this->setId($id);      
      $this->setUpdated($updated);
      
      if (is_string($title) && (strlen($title)>0)) {
         $this->addTitle($title);
      }
      
      if (is_string($content)) {
         $this->addContent($content);
      }

      if (is_string($author)) {
         $this->addAuthor($author);
      }
   }

   //***************************************************************************
   // Public methods
   //***************************************************************************

   /**
    * Adds the title
    *
    * @param string $title
    * @param string $type
    */
   public function addTitle($title, $type='text')
   {
      $this->title = new EFeedTextAtom10($title, $type);
   }

   /**
    * Adds an author
    *
    * @param string $name
    * @param string $uri
    * @param string $email
    */
   public function addAuthor($name, $uri='', $email='')
   {
      $this->authors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the content
    *
    * @param string $text
    * @param string $type
    * @param string $src
    */
   public function addContent($text, $type='text', $src='')
   {
      $this->content = new EFeedEntryContentAtom10($text, $type, $src);
   }

   /**
    * Adds a link
    *
    * @param string $href
    * @param string $rel
    * @param string $type
    * @param string $hreflang
    * @param string $title
    * @param integer $length
    */
   public function addLink($href, $rel='', $type='', $hreflang='', $title='', $length=0)
   {
      foreach ($this->links as $link) {
         if (($link->hreflang == $hreflang) && ($link->type == $type) && (($link->rel == 'alternate') && ($rel == 'alternate')))
            throw new CException(Yii::t('EWebFeed', 'An entry is limited to one "alternate" rel per {type} and {hreflang}', array('{type}'=>$type, '{hreflang}'=>$hreflang)));
      }
      $this->links[] = new EFeedLinkAtom10($href, $rel, $type, $hreflang, $title, $length);
   }

   /**
    * Adds the summary
    *
    * @param string $text
    * @param string $type
    */
   public function addSummary($text, $type='text')
   {
      $this->summary = new EFeedTextAtom10($text, $type);
   }

   /**
    * Adds a category
    *
    * @param string $term
    * @param string $scheme
    * @param string $label
    */
   public function addCategory($term, $scheme='', $label='')
   {
      $this->categories[] = new EFeedCategoryAtom10($term, $scheme, $label);
   }

   /**
    * Adds a contributor
    *
    * @param string $name
    * @param string $uri
    * @param string $email
    */
   public function addContributor($name, $uri='', $email='')
   {
      $this->contributors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the rights
    *
    * @param string $text
    * @param string $type
    */
   public function addRights($text, $type='text')
   {
      $this->rights = new EFeedTextAtom10($text, $type);
   }

   /**
    * Adds the source object
    */
   public function addSource($id, $title='', $updated=0)
   {
      if (is_null($this->source))
         $this->source = new EFeedEntrySourceAtom10($id, $title, $updated);
   }
}

/**
 * <title>, <summary>, <content>, and <rights> contain human-readable text,
 * usually in small quantities. The type attribute determines how this
 * information is encoded (default="text")
 *
 * @author MetaYii
 */
class EFeedTextAtom10 extends EFeedElementAtom10
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   // Required

   /**
    * The text
    *
    * @var string
    */
   protected $text = '';

   // Optional

   /**
    * Defines how the text will be encoded and rendered.
    * Valid values are: "text", "html", "xhtml"
    *
    * @var string
    */
   protected $type = 'text';

   //***************************************************************************
   // Local properties
   //***************************************************************************

   protected $validTypes = array('text', 'html', 'xhtml');

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the string text
    *
    * @param string $value the text
    */
   public function setText($value)
   {
      $this->text = strval($value);
   }

   /**
    * Gets the text
    *
    * @return string
    */
   public function getText()
   {
      return $this->text;
   }

   /**
    * Sets the type
    *
    * @param string $value the type
    */
   public function setType($value)
   {
      if (!in_array($value, $this->validTypes))
         throw new CException(Yii::t('EWebFeed', 'type must be one of: {valid}',
                           array('{valid}'=>implode(', ', $this->validTypes))));
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

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $text the text
    * @param string $type the type
    */
   public function __construct($text, $type='text')
   {
      $this->setType($type);
      $this->setText($text);
   }
}

/**
 * EFeedEntrySourceAtom10 represents a source sub-element of an entry
 * 
 * @author MetaYii
 */
class EFeedEntrySourceAtom10 extends EFeedElementAtom10
{
   /**
    * Identifies the feed using a universally unique and permanent URI. If you
    * have a long-term, renewable lease on your Internet domain name, then you
    * can feel free to use your website's address. You can see these pages for
    * helpful tips on making good IDs:
    *
    * @link http://diveintomark.org/archives/2004/05/28/howto-atom-id
    * @link http://www.taguri.org/
    * @link http://www.faqs.org/rfcs/rfc4151.html
    *
    * @var string
    */
   protected $id = '';

   /**
    * Contains a human readable title for the feed. Often the same as the title
    * of the associated website. This value should not be blank.
    *
    * @var EFeedTextAtom10
    */
   protected $title = null;

   /**
    * Indicates the last time the feed was modified in a significant way. This
    * is a timestamp as returned by time()
    *
    * @var integer
    */
   protected $updated = 0;

   // Recommended

   /**
    * Names one author of the feed. A feed may have multiple author elements. A
    * feed must contain at least one author element unless all of the entry
    * elements contain at least one author element.
    *
    * @var array of EFeedPersonAtom10
    */
   protected $authors = array();

   /**
    * Identifies a related Web page. The type of relation is defined by the rel
    * attribute. A feed is limited to one alternate per type and hreflang. A
    * feed should contain a link back to the feed itself.
    *
    * @var array of EFeedLinkAtom10
    */
   protected $links = array();

   // Optional

   /**
    * Specifies a category that the feed belongs to. A feed may have multiple
    * category elements.
    *
    * @var array of EFeedCategoryAtom10
    */
   protected $categories = array();

   /**
    * Names one contributor to the feed. An feed may have multiple contributor
    * elements.
    *
    * @var array of EFeedPersonAtom10
    */
   protected $contributors = array();

   /**
    * Identifies the software used to generate the feed, for debugging and other
    * purposes. Both the uri and version attributes are optional.
    *
    * @var EFeedChannelGeneratorAtom10
    */
   protected $generator = null;

   /**
    * Identifies a small image which provides iconic visual identification for
    * the feed. Icons should be square.
    *
    * @var string
    */
   protected $icon = '';

   /**
    * Identifies a larger image which provides visual identification for the
    * feed. Images should be twice as wide as they are tall.
    *
    * @var string
    */
   protected $logo = '';

   /**
    * Conveys information about rights, e.g. copyrights, held in and over the
    * feed.
    *
    * @var EFeedTextAtom10
    */
   protected $rights = null;

   /**
    * Contains a human-readable description or subtitle for the feed.
    *
    * @var EFeedTextAtom10
    */
   protected $subtitle = null;

   public function __construct($id, $title='', $updated=0)
   {
      $this->setId($id);
      $this->addTitle($title);
      $this->setUpdated($updated);
   }

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the ID
    *
    * @param string $value the id
    */
   public function setId($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'id must be a string'));
      EWebFeed::validateURI($value);
      $this->id = $value;
   }

   /**
    * Gets the ID
    *
    * @return string
    */
   public function getId()
   {
      return $this->id;
   }

   /**
    * Sets the updated
    *
    * @param integer $value the updated
    */
   public function setUpdated($value)
   {
      if (!is_integer($value))
         throw new CException(Yii::t('EWebFeed', 'updated must be an integer'));
      $this->updated = $value;
   }

   /**
    * Gets the updated
    *
    * @return integer
    */
   public function getUpdated()
   {
      return $this->updated;
   }

   /**
    * Sets the icon
    *
    * @param string $value
    */
   public function setIcon($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'icon must be a string'));
      $this->icon = $value;
   }

   /**
    * Gets the icon
    *
    * @return string
    */
   public function getIcon()
   {
      return $this->icon;
   }

   /**
    * Sets the logo
    *
    * @param string $value
    */
   public function setLogo($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'logo must be a string'));
      $this->logo = $value;
   }

   /**
    * Gets the logo
    *
    * @return string
    */
   public function getLogo()
   {
      return $this->logo;
   }

   /**
    * Adds the title.
    *
    * @param string $title the title
    * @param string $type the type
    */
   public function addTitle($title, $type='text')
   {
      if (!is_string($title) || empty($title))
         throw new CException(Yii::t('EWebFeed', 'title must be a non-blank string'));
      $this->title = new EFeedTextAtom10($title, $type);
   }

   /**
    * Adds an author
    *
    * @param string $name the name
    * @param string $uri the URI
    * @param string $email the email
    */
   public function addAuthor($name, $uri='', $email='')
   {
      $this->authors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the link
    *
    * @param string $href
    * @param string $rel
    * @param string $type
    * @param string $hreflang
    * @param string $title
    * @param integer $length
    */
   public function addLink($href, $rel='', $type='', $hreflang='', $title='', $length=0)
   {
      foreach ($this->links as $link) {
         if (($link->hreflang == $hreflang) && ($link->type == $type) && (($link->rel == 'alternate') && ($rel == 'alternate')))
            throw new CException(Yii::t('EWebFeed', 'A feed is limited to one "alternate" rel per {type} and {hreflang}', array('{type}'=>$type, '{hreflang}'=>$hreflang)));
      }
      $this->links[] = new EFeedLinkAtom10($href, $rel, $type, $hreflang, $title, $length);
   }

   /**
    * Adds a category
    *
    * @param string $term
    * @param string $scheme
    * @param string $label
    */
   public function addCategory($term, $scheme='', $label='')
   {
      $this->categories[] = new EFeedCategoryAtom10($term, $scheme, $label);
   }

   /**
    * Adds an contributor
    *
    * @param string $name the name
    * @param string $uri the URI
    * @param string $email the email
    */
   public function addContributor($name, $uri='', $email='')
   {
      $this->contributors[] = new EFeedPersonAtom10($name, $uri, $email);
   }

   /**
    * Adds the generator information
    *
    * @param string $generator
    * @param string $version
    * @param string $uri
    */
   public function addGenerator($generator, $version='', $uri='')
   {
      $this->generator = new EFeedChannelGeneratorAtom10($generator, $version, $uri);
   }

   /**
    * Adds the rights string
    *
    * @param string $text
    * @param string $type
    */
   public function addRights($text, $type='text')
   {
      $this->rights = new EFeedTextAtom10($text, $type);
   }

   /**
    * Adds a subtitle
    *
    * @param string $text
    * @param string $type
    */
   public function addSubtitle($text, $type='text')
   {
      $this->subtitle = new EFeedTextAtom10($text, $type);
   }
}

/**
 * EFeedEntryContentAtom10 represents a content element of an entry
 *
 * @author MetaYii
 */
class EFeedEntryContentAtom10 extends EFeedTextAtom10
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   // Inherits from EFeedTextAtom10, plus:

   // Optional

   /**
    * If the src attribute is present, it represents the URI of where the
    * content can be found. The type attribute, if present, is the media type
    * of the content.
    *
    * @var string an URI
    */
   private $src = '';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Setter
    *
    * @param string $value
    */
   public function setSrc($value='')
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'value must be a string'));
      if (!empty($value)) {
         EWebFeed::validateURI($value);
         $this->src = $value;
      }
   }

   /**
    * Getter
    *
    * @return string
    */
   public function getSrc()
   {
      return $this->src;
   }

   /**
    * Sets the string text
    *
    * @param string $value the text
    */
   public function setText($value)
   {
      $this->text = strval($value);
   }

   /**
    * Gets the text
    *
    * @return string
    */
   public function getText()
   {
      return $this->text;
   }

   /**
    * Sets the type
    *
    * @param string $value the type
    */
   public function setType($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'type must be a string'));
      $this->type = $value;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $text the text
    * @param string $type the type
    */
   public function __construct($text, $type='text', $src='')
   {
      $this->setType($type);
      $this->setText($text);
      $this->setSrc($src);
   }
}

/**
 * Identifies the software used to generate the feed, for debugging and other
 * purposes. Both the uri and version attributes are optional.
 *
 * @author MetaYii
 */
class EFeedChannelGeneratorAtom10 extends EFeedElementAtom10
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   /**
    * The name of the generator
    *
    * @var string
    */
   protected $generator = 'Yii Framework';

   /**
    * The version of the generator
    *
    * @var string
    */
   protected $version = '';

   /**
    * The URI of the generator web page.
    *
    * @var string
    */
   protected $uri = 'http://www.yiiframework.com/';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the generator
    *
    * @param string $value the generator's name
    */
   public function setGenerator($value)
   {
      $this->generator = $value;
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

   /**
    * Sets the version
    *
    * @param string $value the version
    */
   public function setVersion($value)
   {
      $this->version = $value;
   }

   /**
    * Gets the version
    *
    * @return string
    */
   public function getVersion()
   {
      return $this->version;
   }

   /**
    * Sets the URI
    *
    * @param string $value the URI
    */
   public function setUri($value)
   {
      EWebFeed::validateURI($value);
      $this->uri = $value;
   }

   /**
    * Gets the URI
    *
    * @return string
    */
   public function getUri()
   {
      return $this->uri;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $generator the generator
    * @param string $version the version
    * @param string $uri the URI
    */
   public function __construct($generator, $version='', $uri='')
   {
      $this->setGenerator($generator);
      if ($version !== '')
         $this->setVersion($version);
      if ($uri !== '')
         $this->setUri($uri);
   }
}

/**
 * <category> has one required attribute, term, and two optional attributes,
 * scheme and label.
 *
 * @author MetaYii
 */
class EFeedCategoryAtom10 extends EFeedElementAtom10
{
   //***************************************************************************
   // Element definition
   //***************************************************************************

   // Required

   /**
    * Identifies the category.
    *
    * @var string
    */
   protected $term = '';

   // Optional

   /**
    * Identifies the categorization scheme via a URI.
    *
    * @var string
    */
   protected $scheme = '';

   /**
    * Provides a human-readable label for display.
    *
    * @var string
    */
   protected $label = '';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   public function setTerm($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'term must be a non-empty string'));
      $this->term = $value;
   }

   public function getTerm()
   {
      return $this->term;
   }

   public function setScheme($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'scheme must be a string'));
      EWebFeed::validateURI($value);
      $this->scheme = $value;
   }

   public function getScheme()
   {
      return $this->scheme;
   }

   public function setLabel($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'label must be a string'));
      $this->label = $value;
   }

   public function getLabel()
   {
      return $this->label;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $term the term
    * @param string $scheme the schemeee
    * @param string $label the label
    */
   public function __construct($term, $scheme='', $label='')
   {
      $this->setTerm($term);
      if ($scheme !== '')
         $this->setScheme($scheme);
      if ($label !== '')
         $this->setLabel($label);
   }
}

/**
 * <link> is patterned after html's link element. It has one required attribute, 
 * href, and five optional attributes: rel, type, hreflang, title, and length.
 * 
 * @author MetaYii
 */
class EFeedLinkAtom10 extends EFeedElementAtom10
{
   /**
    * href is the URI of the referenced resource (typically a Web page)
    *
    * @var string the href
    */
   protected $href = '';

   /**
    * rel contains a single link relationship type. It can be a full URI (see
    * extensibility), or one of the following predefined values
    * (default=alternate):
    *
    * - alternate: an alternate representation of the entry or feed, for example
    *              a permalink to the html version of the entry, or the front
    *              page of the weblog.
    * - enclosure: a related resource which is potentially large in size and
    *              might require special handling, for example an audio or video
    *              recording.
    * - related: an document related to the entry or feed.
    * - self: the feed itself.
    * - via: the source of the information provided in the entry.
    *
    * @var string
    */
   protected $rel = 'alternate';

   /**
    * Indicates the media type of the resource.
    *
    * @var string
    */
   protected $type = '';

   /**
    * Indicates the language of the referenced resource.
    *
    * @var string
    */
   protected $hreflang = '';

   /**
    * Human readable information about the link, typically for display purposes.
    *
    * @var string
    */
   protected $title = '';

   /**
    * The length of the resource, in bytes.
    *
    * @var integer
    */
   protected $length = '';

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   private $validRels = array('alternate', 'enclosure', 'related', 'self', 'via');

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the href
    *
    * @param string $value the href
    */
   public function setHref($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'href must be a non-empty string')); 
      EWebFeed::validateURI($value);
      $this->href = $value;
   }

   /**
    * Gets the string
    *
    * @return string
    */
   public function getHref()
   {
      return $this->href;
   }

   /**
    * Sets the rel
    *
    * @param string $value the rel
    */
   public function setRel($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'rel must be a string'));
      if (!in_array($value, $this->validRels) && $value !== '')
         EWebFeed::validateURI($value);
      $this->rel = $value;
   }

   /**
    * Gets the rel
    *
    * @return string
    */
   public function getRel()
   {
      return $this->rel;
   }

   /**
    * Sets the type
    *
    * @param string $value the type
    */
   public function setType($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'type must be a string'));
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

   /**
    * Sets the hreflang
    *
    * @param string $value the hreflang
    */
   public function setHreflang($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'hreflang must be a string'));
      $this->hreflang = $value;
   }

   /**
    * Gets the hreflang
    *
    * @return string
    */
   public function getHreflang()
   {
      return $this->hreflang;
   }

   /**
    * Sets the title
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
    * Gets the title
    *
    * @return string
    */
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Sets the length
    *
    * @param integer $value the length
    */
   public function setLength($value)
   {
      if (!is_int($value))
         throw new CException(Yii::t('EWebFeed', 'length must integer'));
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

   //***************************************************************************
   // Constructor
   //***************************************************************************

   public function __construct($href, $rel='', $type='', $hreflang='', $title='', $length=0)
   {
      $this->setHref($href);
      $this->setRel($rel);
      $this->setType($type);
      $this->setHreflang($hreflang);
      $this->setTitle($title);
      $this->setLength($length);
   }
}

/**
 * <author> and <contributor> describe a person, corporation, or similar entity.
 * It has one required element, name, and two optional elements: uri, email.
 *
 * @author MetaYii
 */
class EFeedPersonAtom10 extends EFeedTextAtom10
{
   //***************************************************************************
   // Element attributes
   //***************************************************************************

   // Required

   /**
    * Conveys a human-readable name for the person.
    *
    * @var string
    */
   protected $name = '';

   // Optional

   /**
    * Contains a home page for the person.
    *
    * @var string
    */
   protected $uri = '';

   /**
    * Contains an email address for the person.
    *
    * @var string
    */
   protected $email = '';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Sets the name
    *
    * @param string $value the name
    */
   public function setName($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'name must be a non-empty string'));
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
    * Sets the URI
    *
    * @param string $value the URI
    */
   public function setUri($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'uri must be a string'));
      if (!empty($value))
         EWebFeed::validateURI($value);
      $this->uri = $value;
   }

   /**
    * Gets the URI
    *
    * @return string
    */
   public function getUri()
   {
      return $this->uri;
   }

   /**
    * Sets the email
    *
    * @param string $value the email
    */
   public function setEmail($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'email must be a string'));
      $this->email = $value;
   }

   /**
    * Gets the email
    *
    * @return string
    */
   public function getEmail()
   {
      return $this->email;
   }

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor
    *
    * @param string $name the name (required)
    * @param string $uri the URI
    * @param string $email the email
    */
   public function __construct($name, $uri='', $email='')
   {
      $this->setName($name);
      $this->setUri($uri);
      $this->setEmail($email);
   }
}

/**
 * EFeedElementAtom10 defines a Language-Sensitive base element which may have
 * xml:base and/or xml:lang attributes.
 *
 * @author MetaYii
 */
class EFeedElementAtom10 extends EFeedElement
{
   /**
    * Any element defined by this specification MAY have an xml:base
    * attribute [W3C.REC-xmlbase-20010627].  When xml:base is used in an
    * Atom Document, it serves the function described in section 5.1.1 of
    * [RFC3986], establishing the base URI (or IRI) for resolving any
    * relative references found within the effective scope of the xml:base
    * attribute.
    *
    * @var string
    */
   protected $base = '';

   /**
    * Any element defined by this specification MAY have an xml:lang
    * attribute, whose content indicates the natural language for the
    * element and its descendents.  The language context is only
    * significant for elements and attributes declared to be "Language-
    * Sensitive" by this specification.  Requirements regarding the content
    * and interpretation of xml:lang are specified in XML 1.0
    * [W3C.REC-xml-20040204], Section 2.12.
    *
    * @var string
    */
   protected $language = '';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   public function setBase($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'base must be a non-empty string'));
      EWebFeed::validateURI($value);
      $this->base = $value;
   }

   public function getBase()
   {
      return $this->base;
   }

   public function setLanguage($value)
   {
      if (!is_string($value) || empty($value))
         throw new CException(Yii::t('EWebFeed', 'language must be a non-empty string'));
      $this->language = $value;
   }

   public function getLanguage()
   {
      return $this->language;
   }
}