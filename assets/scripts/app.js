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

// Images Loaded
//@prepros-prepend vendor/imagesloaded.pkgd.js

// Isotope
//@prepros-prepend vendor/isotope.pkgd.js

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
    _app.isotope_filtering = function() {

        if( document.querySelector('.isotope-filter-loadmore') ) {
            
            $('.isotope-filter-loadmore').imagesLoaded(function() {
                                
                var $container = '';
                var filters = {};
                
                $(function() {
                    $container = $('.isotope-filter-loadmore .filter-grid');
                
                    $container.isotope({
                        itemSelector: '.filter-grid article',
                        layoutMode: 'fitRows',
                    });
                    

                    // do stuff when checkbox change
                    $('#options').on('change', function(jQEvent) {
                        var $checkbox = $(jQEvent.target);
                        manageCheckbox($checkbox);
                
                        var comboFilter = getComboFilter(filters);
                
                        $container.isotope({ filter: comboFilter });
                        // Since the Isotope arrangement might change after filtering,
                        // it's better to handle the 'arrangeComplete' event here
                        $container.one('arrangeComplete', function(event, filteredItems) {
                            console.log('arrangeComplete after filter with ' + filteredItems.length + ' items');
                            
                            //console.log(filteredItems);
                            
                            const filterButtons = document.querySelectorAll('#options input');
                            const postsShown = filteredItems;
                            let activeTerms = [];
                            
                            postsShown.forEach(function (postShown) {
                                if(postShown) {
                                    const post = Object.values(postShown);
                                    const terms = post[0].getAttribute('data-terms');
                                    activeTerms.push(terms.split(' '));
                                }
                            });
                            
                            // Flatten the array of arrays into a single array
                            activeTerms = activeTerms.flat();

                            filterButtons.forEach(function (btn) {
                                const btnTerms = btn.getAttribute('data-taxonomy-terms').split(' ');
                            
                                const hasMatchingTerm = btnTerms.some(term => activeTerms.includes(term));
                                const wrapper = btn.parentElement.parentElement;
                                console.log( wrapper);
                                if (!hasMatchingTerm) {
                                    if (!wrapper.classList.contains('top-level')) {
                                        wrapper.classList.add('hide-btn');
                                    }
                                } else {
                                    wrapper.classList.remove('hide-btn');
                                }
                            });
                            
                        });
                        loadMore(initShow);
                    });
                    
                    
                    
                    
                    //****************************
                    // Isotope Load more button
                    //****************************
                    var initShow = 12; // number of items loaded on init & onclick load more button
                    var counter = initShow; // counter for load more button
                    var iso = $container.data('isotope'); // get Isotope instance
                    
                      loadMore(initShow); //execute function onload
                    
                      function loadMore(toShow) {
                        $container.find(".hidden").removeClass("hidden");
                    
                        var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
                          return item.element;
                        });
                        $(hiddenElems).addClass('hidden');
                        $container.isotope('layout');
                        
                        console.log( hiddenElems.length );
                    
                        // Hide/show load more button based on remaining hidden items
                        if ( hiddenElems.length == 0) {
                            $("#load-more").hide();
                        } else {
                            $("#load-more").show();
                        }
                    }
                    
                    // when load more button clicked
                    $("#load-more").click(function() {
                        if ($('#options input').is(':checked')) {
                            // when filter button clicked, set initial value for counter
                            counter = initShow;
                        } else {
                            counter += initShow;
                        }
                        loadMore(counter);
                    });
                    
                
    
                });


                function getComboFilter( filters ) {
                    var i = 0;
                    var comboFilters = [];
                    var message = [];
                    
                    for ( var prop in filters ) {
                        message.push( filters[ prop ].join(' ') );
                        var filterGroup = filters[ prop ];
                        // skip to next filter group if it doesn't have any values
                        if ( !filterGroup.length ) {
                            continue;
                        }
                        if ( i === 0 ) {
                            // copy to new array
                            comboFilters = filterGroup.slice(0);
                        } else {
                            var filterSelectors = [];
                            // copy to fresh array
                            var groupCombo = comboFilters.slice(0); // [ A, B ]
                            // merge filter Groups
                            for (var k=0, len3 = filterGroup.length; k < len3; k++) {
                                for (var j=0, len2 = groupCombo.length; j < len2; j++) {
                                    filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
                                }
                            }
                            // apply filter selectors to combo filters for next group
                            comboFilters = filterSelectors;
                        }
                        i++;
                    }
                    
                    var comboFilter = comboFilters.join(', ');
                        return comboFilter;
                }
                    
                function manageCheckbox( $checkbox ) {
                    var checkbox = $checkbox[0];
                    
                    var group = $checkbox.parents('.option-set').attr('data-group');
                    // create array for filter group, if not there yet
                    var filterGroup = filters[ group ];
                    if ( !filterGroup ) {
                        filterGroup = filters[ group ] = [];
                    }
                    
                    var isAll = $checkbox.hasClass('all');
                    // reset filter group if the all box was checked
                    if ( isAll ) {
                        delete filters[ group ];
                        if ( !checkbox.checked ) {
                            checkbox.checked = 'checked';
                        }
                    }
                    // index of
                    var index = $.inArray( checkbox.value, filterGroup );
                    
                    if ( checkbox.checked ) {
                        var selector = isAll ? 'input' : 'input.all';
                        $checkbox.siblings( selector ).removeAttr('checked');
                        
                        
                        if ( !isAll && index === -1 ) {
                            // add filter to group
                            filters[ group ].push( checkbox.value );
                        }
                    
                    } else if ( !isAll ) {
                        // remove filter from group
                        filters[ group ].splice( index, 1 );
                        // if unchecked the last box, check the all
                        if ( !$checkbox.siblings('[checked]').length ) {
                            $checkbox.siblings('input.all').attr('checked', 'checked');
                        }
                    }
                }

            });
        }
    }
    
    _app.alm_filtering = function() {
        if( document.querySelector('.alm-filter-nav') ) {
            
            window.almOnLoad = function(alm){
                const almFilteredGrid = document.querySelector('.alm-filtered-grid');
                if(almFilteredGrid.classList.contains('init') ) {
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
                 
                // Only allow faceting when filtered and NOT on initial page load.
                const almFilteredGrid = document.querySelector('.teachers-staff');
                almFilteredGrid.classList.remove('unfiltered');
             
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
                if( !almFilteredGrid.classList.contains('unfiltered') ) {
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
                        console.log(hasMatchingTerm);
                        if (!hasMatchingTerm) {
                            const wrapper = btn.parentElement;
                            if (!wrapper.classList.contains('top-level')) {
                                wrapper.style.display = 'none';
                            }
                        } else {
                            btn.parentElement.style.display = 'block';
                        }
                    });
                }
                
            };
            
            window.almFilterComplete = function(){

            }
            
            
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
            const pagination = slider.querySelector('.swiper-pagination');
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
                        el: pagination,
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
                        el: pagination,
                        clickable: true,
                    },
                    spaceBetween: 0,
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
        
        // const imageContentSliders = document.querySelectorAll('.ics-slider');
        // imageContentSliders.forEach(function (slider) {
        //     const pagination = slider.querySelector('.swiper-pagination');
        //     const swiper = new Swiper(slider, {
        //         pagination: {
        //             el: ".swiper-pagination",
        //             clickable: true,
        //         },
        //         slidesPerView: 1,
        //         slidesPerGroup: 1,
        //         spaceBetween: 25,
        //     });
        // });
        
    } 
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.display_on_load();
        _app.fade_function();
        
        // Custom Functions
        _app.isotope_filtering();
        //_app.alm_filtering();
        _app.mobile_takover_nav();
        _app.sliders();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);