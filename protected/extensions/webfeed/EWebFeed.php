<?php
/**
 * EWebFeed class file
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
 */

// RSS feeds (most people use this)
require_once(dirname(__FILE__).'/generators/rss/2/RSS_0_91.php');
require_once(dirname(__FILE__).'/generators/rss/2/RSS_0_92.php');
require_once(dirname(__FILE__).'/generators/rss/2/RSS_0_93.php');
require_once(dirname(__FILE__).'/generators/rss/2/RSS_2_0.php');

// ATOM feeds (also very popular)
require_once(dirname(__FILE__).'/generators/atom/Atom_1_0.php');

// RDF based feeds (few people use this)
require_once(dirname(__FILE__).'/generators/rss/1/RSS_1_0.php');

/**
 * EWebFeed is a Yii module which generates RSS and Atom web feeds.
 *
 * @author MetaYii
 */
class EWebFeed implements Iterator
{
   //***************************************************************************
   // Constants
   //***************************************************************************

   const RSS_0_91 = 0;
   const RSS_0_92 = 1;
   const RSS_0_93 = 2;
   const RSS_2_0  = 3;
   const ATOM_1_0 = 4;

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * The feed channel object
    *
    * @var object
    */
   private $channel = null;

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
      return $this->channel->items[$this->position];
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
      return isset($this->channel->items[$this->position]);
   }

   //***************************************************************************
   // Internal properties
   //***************************************************************************

   public static $specification;

   public static $validRSSSpecifications = array(
                                                 RSS_0_91=>'RSS_0_91',
                                                 RSS_0_92=>'RSS_0_92',
                                                 RSS_0_93=>'RSS_0_93',
                                                 RSS_2_0=>'RSS_2_0',
                                                 RSS_1_0=>'RSS_1_0',
                                                );

   public static $validAtomSpecifications = array(
                                                 ATOM_1_0=>'ATOM_1_0',
                                                 );

   public static $validDeprecatedSchemes = array('http', 'ftp');

   public static $validRDFSchemes = array('http', 'https', 'ftp', 'mailto');

   /**
    * @link http://www.iana.org/assignments/uri-schemes.html
    *
    * @var array
    */
   public static $validIANASchemes = array(
                                             'aaa',
                                             'aaas',
                                             'acap',
                                             'cap',
                                             'cid',
                                             'crid',
                                             'data',
                                             'dav',
                                             'dict',
                                             'dns',
                                             'fax',
                                             'file',
                                             'ftp',
                                             'go',
                                             'gopher',
                                             'h323',
                                             'http',
                                             'https',
                                             'iax',
                                             'icap',
                                             'im',
                                             'imap',
                                             'info',
                                             'ipp',
                                             'iris',
                                             'iris.beep',
                                             'iris.xpc',
                                             'iris.xpcs',
                                             'iris.lwz',
                                             'ldap',
                                             'mailto',
                                             'mid',
                                             'modem',
                                             'msrp',
                                             'msrps',
                                             'mtqp',
                                             'mupdate',
                                             'news',
                                             'nfs',
                                             'nntp',
                                             'opaquelocktoken',
                                             'pop',
                                             'pres',
                                             'rtsp',
                                             'service',
                                             'shttp',
                                             'sip',
                                             'sips',
                                             'snmp',
                                             'soap.beep',
                                             'soap.beeps',
                                             'tag',
                                             'tel',
                                             'telnet',
                                             'tftp',
                                             'thismessage',
                                             'tip',
                                             'tv',
                                             'urn',
                                             'vemmi',
                                             'xmlrpc.beep',
                                             'xmlrpc.beeps',
                                             'xmpp',
                                             'z39.50r',
                                             'z39.50s',
                                             'afs',
                                             'dtn',
                                             'mailserver',
                                             'pack',
                                             'tn3270',
                                             'prospero',
                                             'snews',
                                             'videotex',
                                             'wais',
                                            );

   //***************************************************************************
   // Constructor
   //***************************************************************************

   /**
    * Constructor. It takes an object implementing @see IFeedGenerator and
    * extending the @see EFeedChannel class. It uses the Strategy pattern.
    *
    * @param object $specification the specification class
    */
   public function __construct($channel)
   {
      if (!$channel instanceof IFeedGenerator)
         throw new CException(Yii::t('EWebFeed', 'Parameter must be a subclass of EWebFeedChannel and implement IFeedGenerator'));
      $this->channel = $channel;
      $class = get_class($this->channel);
      if (in_array($class, self::$validRSSSpecifications))
         self::$specification = self::$validRSSSpecifications[$class];
      elseif (in_array($class, self::$validAtomSpecifications))
         self::$specification = self::$validAtomSpecifications[$class];
   }

   //***************************************************************************
   // Utilities
   //***************************************************************************

   /**
    * Static method for validating the starting portion of URLs and LINKs
    *
    * @link http://tools.ietf.org/html/rfc3986
    *
    * @param string $url the url to validate
    * @param array $validProtocols array containing the valid protocols
    */
   public static function validateURI($uri)
   {
      if (self::$specification == 'RSS_2_0' || self::$specification == 'ATOM_1_0') {
         $validSchemes = self::$validIANASchemes;
      }
      elseif (self::$specification == 'RSS_1_0') {
         $validSchemes = self::$validRDFSchemes;
      }
      else {
         $validSchemes = self::$validDeprecatedSchemes;
      }

      $match = true;

      if (preg_match("/[^a-z0-9\?\#\[\]\@\!\&\'\(\)\*\+\,\;\=\.\-\_\~\%\:\/\$]/i", $uri) ||
          preg_match("/%[^0-9a-f]/i", $uri) ||
          preg_match("/%[0-9a-f](:?[^0-9a-f]|$)/i", $uri)) {
         $match = false;
      }

      if (!preg_match("/^([a-z0-9\+\.\-]+):(?:\/\/(?:((?:[a-z0-9\-\._\~!\$\&\'\(\)\*\+\,\;\=\:]|%[0-9A-F]{2})*)\@)?((?:[a-z0-9-\.\_\~\!\$\&\'\(\)\*\+\,\;\=]|%[0-9A-F]{2})*)(?::(\d*))?(\/(?:[a-z0-9\-\._\~\!\$\&\'\(\)\*\+\,\;\=\:\@\/]|%[0-9A-F]{2})*)?|(\/?(?:[a-z0-9\-\._\~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9A-F]{2})+(?:[a-z0-9\-\._\~\!\$\&\'\(\)\*\+\,\;\=\:\@\/]|%[0-9A-F]{2})*)?)(?:\?((?:[a-z0-9\-\._\~\!\$\&\'\(\)\*\+\,\;\=\:\/\?\@]|%[0-9A-F]{2})*))?(?:\#((?:[a-z0-9\-\._\~\!\$\&\'\(\)\*\+\,\;\=\:\/\?\@]|%[0-9A-F]{2})*))?$/i", $uri, $parts)) {
         $match = false;
      }

      $scheme = strtolower($parts[1]);
      $userinfo = $parts[2];
      $host = $parts[3];
      $port = intval($parts[4]);
      $authority = ((!empty($userinfo))?$userinfo.'@':'').$host.(!empty($port)?':'.$port:'');
      if (!empty($authority)) {
         $path = $parts[5];
         // RFC 2616
         if (!preg_match("!^/!", $path)) {
            $match = false;
         }
      }
      else {
         $path = $parts[6];
         // RFC 2616
         if (preg_match("!^//!", $path)) {
            $match = false;
         }
      }
      $query = $parts[7];
      $fragment = $parts[8];

      if (empty($scheme) || !preg_match("!^[a-z][a-z0-9\+\-\.]*$!", $scheme)) {
         $match = false;
      }

      if (!in_array($scheme, $validSchemes)) {
         $match = false;
      }

      if ($match === false) {
         throw new CException(Yii::t('EWebFeed', 'The URI "{uri}" is not valid.', array('{uri}'=>$uri)));
      }
      return $match;
   }

   //***************************************************************************
   // Magic methods
   //***************************************************************************

   /**
    * Magic method call
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $function
    * @param array $params
    */
   public function __call($function, $params)
   {
     if (method_exists($this->channel, $function)) {
        call_user_func_array(array($this->channel, $function), $params);
     }
   }

   /**
    * Magic setter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @param string $value
    */
   public function __set($name, $value)
   {
      $name = ucfirst($name);
      $func = "set{$name}";
      call_user_func(array($this->channel, $func), $value);
   }

   /**
    * Magic getter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @return mixed
    */
   public function __get($name)
   {
      return $this->channel->{$name};
   }
}

//******************************************************************************
// Base classes and interfaces
//******************************************************************************

/**
 * Interface for the feed generators
 *
 * @author MetaYii
 */
interface IFeedGenerator
{
   function generateXML();
   function dumpXML();
}

/**
 * Base class for a feed channel
 *
 * @author MetaYii
 */
class EFeedChannel 
{
   //***************************************************************************
   // Internal properties
   //***************************************************************************

   /**
    * Array of EWebFeedChannelItem objects
    *
    * @var array
    */
   protected $items = array();

   /**
    * The document charset
    *
    * @var string
    */
   public $charset = 'ISO-8859-1';

   /**
    * Are we generating ATOM or RSS?
    *
    * @var string
    */
   protected $type = '';

   //***************************************************************************
   // Setters and getters
   //***************************************************************************

   /**
    * Set the charset
    *
    * @param string $value
    */
   public function setCharset($value)
   {
      if (!is_string($value))
         throw new CException(Yii::t('EWebFeed', 'charset must be a string'));
      $this->charset = $value;
   }

   /**
    * Get the charset
    *
    * @return string
    */
   public function getCharset()
   {
      return $this->charset;
   }

   //***************************************************************************
   // Utilities
   //***************************************************************************

	/**
	 * Encodes special characters into HTML entities.
	 * The {@link CApplication::charset application charset} will be used for encoding.
	 * @param string data to be encoded
	 * @return string the encoded data
	 * @see http://www.php.net/manual/en/function.htmlspecialchars.php
	 */
	protected function encode($text)
	{
      return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset, false);
   }

   /**
    * Basic method to output the channel's XML to the browser.
    * You use this method inside an action, or write your own action if you
    * need to send specific headers.
    */
   public function dumpXML()
   {
      if (!headers_sent()) {
         header("Content-type: application/{$this->type}+xml; charset={$this->charset}");
         echo $this->generateXML();
         Yii::app()->end();
      }
   }

   //***************************************************************************
   // Magic methods
   //***************************************************************************

   /**
    * Magic setter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @param string $value
    */
   public function __set($name, $value)
   {
      $name = ucfirst($name);
      $func = "set{$name}";
      call_user_func(array($this, $func), $value);
   }

   /**
    * Magic getter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @return mixed
    */
   public function __get($name)
   {
      return $this->$name;
   }
}

/**
 * EFeedElement is a base class for all the types of channel sub-elements
 *
 * @author MetaYii
 */
class EFeedElement 
{
	/**
	 * Encodes special characters into HTML entities.
	 * The {@link CApplication::charset application charset} will be used for encoding.
	 * @param string data to be encoded
	 * @return string the encoded data
	 * @see http://www.php.net/manual/en/function.htmlspecialchars.php
	 */
	protected function encode($text)
	{
      return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset, false);
   }

   /**
    * Magic setter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @param string $value
    */
   public function __set($name, $value)
   {
      $name = ucfirst($name);
      $func = "set{$name}";
      call_user_func(array($this, $func), $value);
   }

   /**
    * Magic getter
    *
    * @see http://www.php.net/manual/en/language.oop5.magic.php
    *
    * @param string $name
    * @return mixed
    */
   public function __get($name)
   {
      return $this->{$name};
   }
}