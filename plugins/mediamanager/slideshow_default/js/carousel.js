/*
*************************************************
jQuery Carousel Plugin

@created Dioscouri Design
@copyright 2011 http://www.dioscouri.com
*************************************************
*/

(function ($) {
    var defaults = {
        start: 0,
        autoPlay: 0,
        autoPlayInterval: 6000,
        showControls: 1,
        slideWidth: 960,
        slideHeight: 640,
        loop: 1,
        easing: 'swing',
        duration: 1000
    };
    
    jQuery.fn.carousel = function(o) {
        return this.each(function() {
            jQuery(this).data('carousel', new $c(this, o));
        });
    };
    
    jQuery.carousel = function ( element, options ) {
        this.e          = jQuery( element );
        this.options    = jQuery.extend( {}, defaults, options || {} );
        this.timer      = null;
        this.go();
    };
    
    var $c = jQuery.carousel;
        $c.fn = $c.prototype = {
        carousel: '0.1.0'
    };
    
    $c.fn.extend = $c.extend = jQuery.extend;
    
    $c.fn.extend({
        
        go: function() {
            // alert(jQuery(this).dump());
            this.currentPosition = this.options.start;
            this.slides = this.e.find('li.slide');
            this.numberOfSlides = this.slides.length;
            //alert(this.numberOfSlides);
            
            // Remove scrollbar in JS
            this.e.find('.container').css('overflow', 'hidden');

            // Wrap all .slides with #slides-wrapper div
            // and float left to display horizontally, readjust .slides width
            this.slides.wrapAll('<div class="slides-wrapper"></div>')
            .css({
              'float' : 'left',
              'width' : this.options.slideWidth,
              'height' : this.options.slideHeight
            });

            // Set #slides-wrapper width equal to total width of all slides
            this.e.find('.slides-wrapper').css('width', this.options.slideWidth * this.numberOfSlides);
            
            if (this.options.start != 0)
            {
                this.goToSlide();
            }

            if (this.options.showControls == 1)
            {
                // Insert left and right arrow controls in the DOM
                this.e
                  .append('<span class="control prev">Prev</span>')
                  .append('<span class="control next">Next</span>');
    
                // Hide left arrow control on first load
                this.manageControls();
    
                // Create event listeners for .controls clicks
                this.e.find('.prev').bind('click', jQuery.proxy(this.prevClick, this) );
                this.e.find('.next').bind('click', jQuery.proxy(this.nextClick, this) );
                this.e.find('.prev').bind('click', jQuery.proxy(this.stopAuto, this) );
                this.e.find('.next').bind('click', jQuery.proxy(this.stopAuto, this) );
            }
            
            if (this.options.autoPlay == 1)
            {
                this.startAuto();
            }
        },
        
        prevClick: function() {
            n = this.currentPosition - 1;
            if (this.isValidPosition(n))
            {
                this.currentPosition = n;
            } else if (this.options.loop == 1)
            {
                this.currentPosition = (this.numberOfSlides-1);
            }
            this.manageControls();
            this.pauseAuto();
            this.goToSlide();
        },
        
        nextClick: function() {
            n = this.currentPosition + 1;
            if (this.isValidPosition(n))
            {
                this.currentPosition = n;
            } else if (this.options.loop == 1)
            {
                this.currentPosition = 0;
            }
            this.manageControls();
            this.pauseAuto();
            this.goToSlide();
        },
        
        goToSlide: function() {
            if (this.currentPosition >= (this.numberOfSlides) && this.options.loop == 1) {
                this.currentPosition = 0;
                this.manageControls();
            }
            
            if (this.currentPosition < 0 && this.options.loop == 1) {
                this.currentPosition = (this.numberOfSlides-1);
                this.manageControls();
            }
            
            if (this.isValidPosition())
            {
                // Move slides-wrapper using margin-left
                this.e.find('.slides-wrapper').animate({ 'marginLeft' : this.options.slideWidth * (-this.currentPosition) }, this.options.duration, this.options.easing);
            }
            this.continueAuto();
        },
        
        isValidPosition: function(n) {
            if (n !== undefined) {
                if (n < 0 || n >= this.numberOfSlides)
                {
                    return false;
                }
                return true;
            }
            
            if (this.currentPosition < 0 || this.currentPosition >= this.numberOfSlides)
            {
                return false;
            }
            return true;
        },
        
        /**
         * Starts autoscrolling.
         *
         * @method auto
         * @return undefined
         * @param s {Number} Seconds to periodically autoscroll the content.
         */
        startAuto: function(s) {
            if (s !== undefined) {
                this.options.autoPlayInterval = s;
            }

            if (this.options.autoPlay == 0) {
                return this.stopAuto();
            }

            if (this.timer !== null) {
                return;
            }

            this.autoStopped = false;

            var self = this;
            this.timer = window.setTimeout(function() { self.nextClick(); }, this.options.autoPlayInterval);
        },

        /**
         * Stops autoscrolling.
         *
         * @method stopAuto
         * @return undefined
         */
        stopAuto: function() {
            this.pauseAuto();
            this.autoStopped = true;
        },

        /**
         * Pauses autoscrolling.
         *
         * @method pauseAuto
         * @return undefined
         */
        pauseAuto: function() {
            if (this.timer === null) {
                return;
            }

            window.clearTimeout(this.timer);
            this.timer = null;
        },
        
        /**
         * Continues autoscrolling.
         *
         * @method pauseAuto
         * @return undefined
         */
        continueAuto: function() {
            if (this.options.autoPlay == 0) {
                return this.stopAuto();
            }

            if (this.autoStopped === true) {
                return;
            }
            
            var self = this;
            this.timer = window.setTimeout(function() { self.nextClick(); }, this.options.autoPlayInterval);
        },
        
        /**
         * manageControls: Hides and shows controls depending on currentPosition
         */
        manageControls: function ()
        {
          if (this.options.loop != 1)
          {
              // Hide left arrow if position is first slide
              if (this.currentPosition <= 0) { 
                  this.e.find('.prev').addClass( "inactive" ); 
              } else {
                  this.e.find('.prev').removeClass( "inactive" ); 
              }
              
              // Hide right arrow if position is last slide
              if (this.currentPosition >= (this.numberOfSlides-1)) {
                  this.e.find('.next').addClass( "inactive" );
              } else {
                  this.e.find('.next').removeClass( "inactive" ); 
              }
          }
        }
    });
    
})(jQuery);