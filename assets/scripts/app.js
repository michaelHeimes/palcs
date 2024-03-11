/**
 * Required
 */
 
 //@prepros-prepend vendor/foundation/js/plugins/foundation.core.js

/**
 * Optional Plugins
 * Remove * to enable any plugins you want to use
 */
 
 // What Input
 //@*prepros-prepend vendor/whatinput.js
 
 // Foundation Utilities
 // https://get.foundation/sites/docs/javascript-utilities.html
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.box.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.imageLoader.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.keyboard.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.mediaQuery.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.motion.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.nest.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.timer.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.touch.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.triggers.min.js


// JS Form Validation
//@*prepros-prepend vendor/foundation/js/plugins/foundation.abide.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

// Menu enhancements
//@prepros-prepend vendor/foundation/js/plugins/foundation.drilldown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdownMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveToggle.js

// Equalize heights
//@*prepros-prepend vendor/foundation/js/plugins/foundation.equalizer.js

// Responsive Images
//@prepros-prepend vendor/foundation/js/plugins/foundation.interchange.js

// Navigation Widget
//@*prepros-prepend vendor/foundation/js/plugins/foundation.magellan.js

// Offcanvas Naviagtion Option
//@prepros-prepend vendor/foundation/js/plugins/foundation.offcanvas.js

// Carousel (don't ever use)
//@*prepros-prepend vendor/foundation/js/plugins/foundation.orbit.js

// Modals
//@prepros-prepend vendor/foundation/js/plugins/foundation.reveal.js

// Form UI element
//@*prepros-prepend vendor/foundation/js/plugins/foundation.slider.js

// Anchor Link Scrolling
//@prepros-prepend vendor/foundation/js/plugins/foundation.smoothScroll.js

// Sticky Elements
//@prepros-prepend vendor/foundation/js/plugins/foundation.sticky.js

// Tabs UI
//@prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// On/Off UI Switching
//@*prepros-prepend vendor/foundation/js/plugins/foundation.toggler.js

// Tooltips
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tooltip.js

// What Input
//@prepros-prepend vendor/what-input.js

// Swiper
//@prepros-prepend vendor/swiper-bundle.js

// DOM Ready
(function($) {
	'use strict';
    
    var _app = window._app || {};
    
    _app.foundation_init = function() {
        $(document).foundation();
    }
        
    _app.emptyParentLinks = function() {
            
        $('.menu li a[href="#"]').click(function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });	
        
    };
    
    _app.display_on_load = function() {
        $('.display-on-load').css('visibility', 'visible');
    }
    
    _app.fade_function = function() {
        //Fade Function
        function fadeIn(element, duration) {
            let opacity = 0;
            element.style.display = 'block';
        
            const interval = 10;
            const step = 1 / (duration / interval);
        
            function updateOpacity() {
                if (opacity < 1) {
                    opacity += step;
                    element.style.opacity = opacity;
                    setTimeout(updateOpacity, interval);
                }
            }
        
            updateOpacity();
        }
        
        function fadeOut(element, duration) {
            let opacity = 1;
        
            const interval = 10;
            const step = 1 / (duration / interval);
        
            function updateOpacity() {
                if (opacity > 0) {
                    opacity -= step;
                    element.style.opacity = opacity;
                    setTimeout(function () {
                        updateOpacity();
                        if (opacity <= 0) {
                            element.style.display = 'none';
                        }
                    }, interval);
                }
            }
            updateOpacity();
        }
    }
    
    // Custom Functions
    
    _app.alm_filtering = function() {
        if( document.querySelector('.alm-filter-nav') ) {
            
            window.almOnLoad = function(alm){
                const almFilteredGrid = document.querySelector('.alm-filtered-grid');
                if(almFilteredGrid.classList.contains('init') ) {
                    const allbtn = document.querySelector('.alm-filter-nav button.all');
                    allbtn.click();
                    almFilteredGrid.classList.remove('init');
                }  
            };
            
            
            /**
             * Filter button click event.
             *
             * @param {*} event
             */
             function filterClick(event) {
                 event.preventDefault();
             
                 // Exit if button active.
                 if (this.classList.contains('active')) {
                     return;
                 }
             
                 // Get .active element.
                 var activeEl = document.querySelector('.alm-filter-nav button.active');
                 if (activeEl) {
                     activeEl.classList.remove('active');
                 }
             
                 // Add active class.
                 this.classList.add('active');
             
                 // Set filter params
                 var transition = 'fade';
                 var speed = 250;
                 //var data = this.dataset;
                 
                 var data = {
                     taxonomy: this.dataset.taxonomy,
                     taxonomyTerms: this.dataset.taxonomyTerms
                 };

             
                 // Call core Ajax Load More `filter` function.
                 // @see https://connekthq.com/plugins/ajax-load-more/docs/public-functions/#filter
                 ajaxloadmore.filter(transition, speed, data);
             
                 // Update URL with data attributes
                 updateUrl(data);
             }
             
             
            /**
             * Update URL with data attributes.
             *
             * @param {*} data
             */
            function updateUrl(data) {
                // Construct the URL with the parameters.
                var baseUrl = window.location.href.split('?')[0];
                var newUrl = baseUrl + '?';
                
                // Filter out empty values and append to the URL
                for (var key in data) {
                    if (data[key]) {
                        newUrl += key + '=' + encodeURIComponent(data[key]) + '&';
                    }
                }
                
                // Remove the trailing '&' if present
                newUrl = newUrl.replace(/&$/, '');
                
                // Update the browser's location without reloading the page.
                window.history.pushState({}, '', newUrl);
            }
            
            // function updateUrl(data) {
            //     // Construct the URL with the parameters.
            //     var baseUrl = window.location.href.split('?')[0];
            //     var newUrl = '';
            //     
            //     // Filter out empty values and append to the URL
            //     for (var key in data) {
            //         if (data[key]) {
            //             newUrl = baseUrl + '?';newUrl = baseUrl + '?';
            //             newUrl += key + '=' + encodeURIComponent(data[key]) + '&';
            //         }
            //     }
            //     
            //     // Remove the trailing '&' if present
            //     newUrl = newUrl.replace(/&$/, '');
            //     
            //     // Update the browser's location without reloading the page.
            //     window.history.pushState({}, '', newUrl);
            // }
             
             
             
            window.almComplete = function (alm) {
                const almFilteredGrid = document.querySelector('.teachers-staff');
                const filterButtons = document.querySelectorAll('.alm-filter-nav button:not(.all)');
                const postsShown = document.querySelectorAll('.ajax-load-more-wrap article');
                let activeTerms = [];
            
                postsShown.forEach(function (postShown) {
                    const terms = postShown.getAttribute('data-terms');
                    activeTerms.push(terms.split(' '));
                });
            
                // Flatten the array of arrays into a single array
                activeTerms = activeTerms.flat();
            
                filterButtons.forEach(function (btn) {
                    const btnTerms = btn.getAttribute('data-taxonomy-terms').split(' ');
            
                    const hasMatchingTerm = btnTerms.some(term => activeTerms.includes(term));
            
                    if (!hasMatchingTerm) {
                        const wrapper = btn.parentElement;
                        if (!wrapper.classList.contains('top-level')) {
                            wrapper.style.display = 'none';
                        }
                    } else {
                        btn.parentElement.style.display = 'block';
                    }
                });
            };
            
            
            // Get all filter buttons for filtering.
            var filter_buttons = document.querySelectorAll('.alm-filter-nav button');
            if (filter_buttons) {
                // Set initial active item.
                filter_buttons[0].classList.add('active');
             
                // Loop buttons.
                [].forEach.call(filter_buttons, function (button) {
                    // Add button click event.
                    button.addEventListener('click', filterClick);
                });
            }
            
        
        }
        
    }
    
    
    _app.mobile_takover_nav = function() {
        const toggles = document.querySelectorAll('.menu-toggle');
        
        toggles.forEach(function (toggle){
            toggle.addEventListener('click', function (event) {
                event.preventDefault();
                
                
                
            });
        });
        
        // $(document).on('click', 'a.menu-toggle', function(){
        //     
        //     if ( $(this).hasClass('clicked') ) {
        //         $(this).removeClass('clicked');
        //         $('#off-canvas').fadeOut(200);
        //     
        //     } else {
        //     
        //         $(this).addClass('clicked');
        //         $('#off-canvas').fadeIn(200);
        //     
        //     }
        //     
        // });
    }
    
    _app.sliders = function() {
        
        const imagePaginationSliders = document.querySelectorAll('.img-pagination-slider');
        let autoPlayDelay = '';
        let crossFade = false;
        imagePaginationSliders.forEach(function (slider) {
            autoPlayDelay = slider.getAttribute('data-autoplaydelay');
            crossFade = slider.getAttribute('data-crossfade');
            if(autoPlayDelay) {
                const swiper = new Swiper(slider, {
                    effect: "fade",
                    crossFade: true,
                    fadeEffect: { crossFade: crossFade },
                    autoplay: {
                        delay: autoPlayDelay,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    spaceBetween: 50,
                });
            } else {
                const swiper = new Swiper(slider, {
                    effect: "fade",
                    crossFade: true,
                    fadeEffect: { crossFade: crossFade },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    spaceBetween: 50,
                });
            }            
        });
        
        const groupedTwoColThreeRows = document.querySelectorAll('.grouped-2-col-3-row');
        groupedTwoColThreeRows.forEach(function (slider) {
            const swiper = new Swiper(slider, {
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 25,
                breakpoints: {
                    1440: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                    },
                },
            });
        });
    } 
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.display_on_load();
        _app.fade_function();
        
        // Custom Functions
        _app.alm_filtering();
        _app.mobile_takover_nav();
        _app.sliders();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);