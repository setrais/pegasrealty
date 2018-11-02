// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// released under the MIT license

(function($) {
    
  function maybeCall(thing, ctx) {
    return (typeof thing == 'function') ? (thing.call(ctx)) : thing;
  };
    
  function Tipsy(element, options) {
    this.$element = $(element);
    this.options = options;
    this.enabled = true;
    this.fixTitle();
  };
    
  Tipsy.prototype = {
    show: function() {
      var content,title;
      content=this.getContent();
      content=this.setDefaults(content);
      
      //<div class="tipsy-inner">
      //  <div class="tipsy-tl"></div><div class="tipsy-tr"></div>
      //  <div class="tipsy-c"></div>
      //  <div class="tipsy-fl"></div><div class="tipsy-fr"></div>
      //</div>
      
      if (content && this.enabled) {
        var $tip = this.tip();
       
        $tip.find('.tipsy-tr').html(content.tr);
        $tip.find('.tipsy-tl').html(content.tl);
        $tip.find('.tipsy-c').html(content.c);
        $tip.find('.tipsy-fr').html(content.fr);
        $tip.find('.tipsy-fl').html(content.fl);
        
        $tip[0].className = 'tipsy'; // reset classname in case of dynamic gravity
        $tip.remove().css({
          top: 0, 
          left: 0, 
          visibility: 'hidden', 
          display: 'block'
        }).prependTo(document.body);
                
        var pos = $.extend({}, this.$element.offset(), {
          width: this.$element[0].offsetWidth,
          height: this.$element[0].offsetHeight
        });

        var $arrow=$tip.find('.tipsy-arrow');

        var actualWidth = $tip[0].offsetWidth,
        actualHeight = $tip[0].offsetHeight,
        gravity;
        
        if(this.options.gravity==false)
          gravity = $.fn.tipsy.autoLR.call(this.$element[0]);
        else
          gravity = this.options.gravity
        
        $arrow.attr('src', this.options.path+ 'tipsy-arrow-' + gravity+'.png');

        //tp - tip position, ap - arrow position
        var tp,ap;
        switch (gravity.charAt(0)) {
          case 'l':
            tp = {
              top: pos.top + pos.height / 2 - actualHeight / 2, 
              left: pos.left - actualWidth - this.options.offset-$arrow.width() +9
            };
            ap = {
              top: actualHeight / 2 - $arrow[0].offsetHeight / 2, 
              left: actualWidth-2  //hardcode :( 
            };
            break;
          case 'r':
            tp = {
              top: pos.top + pos.height / 2 - actualHeight / 2,
              left: pos.left + pos.width + this.options.offset +17
            };
            ap = {
              top: actualHeight / 2 - $arrow[0].offsetHeight / 2, 
              left: -23
            };
            break;
        }

        $tip.css(tp).addClass('tipsy-' + gravity);
        $arrow.css(ap);

        if (this.options.className) {
          $tip.addClass(maybeCall(this.options.className, this.$element[0]));
        }
                
        if (this.options.fade) {
          $tip.stop().css({
            opacity: 0, 
            display: 'block', 
            visibility: 'visible'
          }).animate({
            opacity: this.options.opacity
          });
        } else {
          $tip.css({
            visibility: 'visible', 
            opacity: this.options.opacity
          });
        }
      }
    },
        
    hide: function() {
      if (this.options.fade) {
        this.tip().stop().fadeOut(function() {
          $(this).remove();
        });
      } else {
        this.tip().remove();
      }
    },
        
    fixTitle: function() {
      var $e = this.$element;
      if ($e.attr('title') || typeof($e.attr('original-title')) != 'string') {
        $e.attr('original-title', $e.attr('title') || '').removeAttr('title');
      }
    },
    getContent: function() {
      var content, $e = this.$element, o = this.options;
      this.fixTitle();
      var title= this.getTitle();

      if (typeof o.content == 'function') {
        $.extend(o,title);
        content = o.content.call(o);
      }else{
        content=o.content;
      }
      
      return content || o.fallback;
    },
    getTitle: function() {
      var properties, tmp,obj={}, $e = this.$element, o = this.options
      d=$.fn.tipsy.defaults;
      this.fixTitle();

      tmp= $e.attr('original-title');
      properties=tmp.split(',');
      
      $.each(properties,function(k,v){
        v=$.trim(v);
        var pair=v.split(':');

        pair[0]=$.trim(pair[0]);

        if(typeof d.content[pair[0]] != 'undefined')
        {
          if(typeof obj.defaults == 'undefined')
            obj.defaults={};
          
          obj['defaults'][pair[0]]=$.trim(pair[1]);
        }else{
          obj[pair[0]]=$.trim(pair[1]);
        }
      });
      return obj;// || o.fallback
    },
    tip: function() {
      if (!this.$tip) {
        this.$tip = $('<div class="tipsy"></div>').html('<img class="tipsy-arrow" src="'+this.options.path+'tipsy-arrow-l.png" alt=""/><div class="tipsy-inner"><div class="tipsy-tl"></div><div class="tipsy-tr"></div><div class="cls"></div><div class="tipsy-c"></div><div class="tipsy-fl"></div><div class="tipsy-fr"></div><div class="cls"></div></div>');
      }
      return this.$tip;
    },
    setDefaults: function(obj){
      var d= $.fn.tipsy.defaults.content;
      $.each(d,function(k,v){
        if(typeof obj[k]=='undefined' )
          obj[k]=v;
      });
     
     return obj;
    },    
    validate: function() {
      if (!this.$element[0].parentNode) {
        this.hide();
        this.$element = null;
        this.options = null;
      }
    },
    
    /* New properties */
    inPop: false,
    delayCursor: 150,
    delayPop: 60,
    timeout:null,
    /* End properties */
    
    enable: function() {
      this.enabled = true;
    },
    disable: function() {
      this.enabled = false;
    },
    toggleEnabled: function() {
      this.enabled = !this.enabled;
    }
  };
    
  $.fn.tipsy = function(options) {
    if (options === true) {
      return this.data('tipsy');
    } else if (typeof options == 'string') {
      var tipsy = this.data('tipsy');
      if (tipsy) tipsy[options]();
      return this;
    }
        
    options = $.extend({}, $.fn.tipsy.defaults, options);
        
    function get(ele) {
      var tipsy = $.data(ele, 'tipsy');
      if (!tipsy) {
        tipsy = new Tipsy(ele, $.fn.tipsy.elementOptions(ele, options));
        $.data(ele, 'tipsy', tipsy);
      }
      return tipsy;
    }
  
    function move() {
    	  var tipsy = get(this);
          clearTimeout(tipsy.timeout);
    	  tipsy.timeout=setTimeout( function() {	  
	    	   tipsy.hoverState = 'in';
	    	   //$('.tipsy').hide();
	    	   if (options.delayIn == 0) {
	    	    	          
	    	      if ( options.isOut ) {
	    	        	
    	          	  tipsy.show();
   	       	          $('.tipsy').mouseleave( function(e) {
	    		    	    tipsy.hide();
	    		    	    tipsy.inPop=false;
   		    	      })
	    		    	        
   		    	      $('.tipsy').mouseenter( function(e) {
   		    	        	tipsy.inPop=true;
   		    	      })

	    	      }
	    	   } else {
	    	      tipsy.fixTitle();
	    	      setTimeout(function() {
	    	        if (tipsy.hoverState == 'in') tipsy.show();
	    	      }, options.delayIn);
	    	   }
    	},tipsy.delayCursor);
    }
    
    function enter() {
      var tipsy = get(this);
      tipsy.hoverState = 'in';
      //$('.tipsy').hide();
      if (options.delayIn == 0) {
    	          
        if ( options.isOut ) {
        	
            	  tipsy.show();
       	          $('.tipsy').mouseleave( function(e) {
	    	        	tipsy.hide();
	    	        	tipsy.inPop=false;
	    	      })
	    	        
	    	      $('.tipsy').mouseenter( function(e) {
	    	        	tipsy.inPop=true;
	    	      })
        }
      } else {
        tipsy.fixTitle();
        setTimeout(function() {
          if (tipsy.hoverState == 'in') tipsy.show();
        }, options.delayIn);
      }
    };
        
    function leave() {
      var tipsy = get(this);
      tipsy.hoverState = 'out';          
      
	  if ( options.delayOut == 0 ) {
		  if ( options.isOut ){
			  setTimeout(function() {
		    	if ( !tipsy.inPop ) { 
		    	 	tipsy.hide();
		    	}	
			  }, tipsy.delayPop );
		  }else{
			  tipsy.hide();
		  }
		  clearTimeout(tipsy.timeout);
	  } else {
	        setTimeout(function() {
	          if (tipsy.hoverState == 'out') tipsy.hide();
	        }, options.delayOut);
	  }
      
    };
          
    if (!options.live) this.each(function() {
      get(this);
    });
        
    if (options.trigger != 'manual') {
      var binder   = options.live ? 'live' : 'bind',
      eventIn   = options.trigger == 'hover' ? 'mouseenter' : 'focus',
      eventOut  = options.trigger == 'hover' ? 'mouseleave' : 'blur';
      eventMove = options.trigger == 'hover' ? 'mousemove'  : 'focus';
      
      if ( options.isOut ) {
    	  this[binder](eventOut, leave);
    	  this[binder](eventMove, move);
      }else{
    	  this[binder](eventIn, enter); 
    	  this[binder](eventOut, leave);
      }
    }
        
    return this;
        
  };
    
  $.fn.tipsy.defaults = {
    className: null,
    title: 'title',
    delayIn: 0,
    delayOut: 1500,
    fade: false,
    fallback: '',
    gravity: false,
    html: true,
    live: false,
    isOut: false,
    offset: 0,
    opacity:1,
    content: {
      tl:'',
      tr:'This is pop up content',
      c:'<p><br/><br/><br/></p>',
      fl:'<a href="#">Duplicate task</a>',
      fr:'<a href="#" class="edit-item-contacts inline-block btn-share bt-common">Share this</a>'
    },
    path:'/assets/jquery-plugins/tipsy/',
    trigger: 'hover'
  };
    
  // Overwrite this method to provide options on a per-element basis.
  // For example, you could store the gravity in a 'tipsy-gravity' attribute:
  // return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
  // (remember - do not modify 'options' in place!)
  $.fn.tipsy.elementOptions = function(ele, options) {
    return $.metadata ? $.extend({}, options, $(ele).metadata()) : options;
  };
    
  $.fn.tipsy.autoLR = function() {
    return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'l' : 'r';
  };

    
})(jQuery);
