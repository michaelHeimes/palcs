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
      
         var $isotopeFilterLoadMore = document.querySelector('.isotope-filter-loadmore');
    
        if( $isotopeFilterLoadMore ) {
           
             // Function to set equal heights for each row
             const setEqualRowHeights = function() {
                 var rows = $('.filter-grid').children(); // Assuming each row is a direct child of .filter-grid
                 var maxRowHeight = 0;
             
                 rows.each(function() {
                     var rowHeight = $(this).height();
                     maxRowHeight = Math.max(maxRowHeight, rowHeight);
                 });
             
                 rows.css('height', maxRowHeight + 'px');
             }
            
            $('.isotope-filter-loadmore').imagesLoaded(function() {
                
               const $container = $('.isotope-filter-loadmore .filter-grid');
               var $postsPer = $isotopeFilterLoadMore.getAttribute('data-postsper');
                                
                $($container).isotope({
                    itemSelector: '.filter-grid article',
                    layoutMode: 'fitRows',
               });
                
               $container.addClass('init');
               
               
               

               

                
               $container.on( 'layoutComplete', function( event, filteredItems ) {
                  console.log('arrangeComplete after filter with ' + filteredItems.length + ' items');
                  
                  
                  



                  
                  
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
                       if (!hasMatchingTerm) {
                           if (!wrapper.classList.contains('top-level')) {
                              wrapper.classList.add('hide-btn');
                              //$(wrapper).hide(100);
                           }
                       } else {
                           wrapper.classList.remove('hide-btn');
                           //$(wrapper).show(100);
                       }
                   });
                  
                  if(filteredItems.length == 0){
                        $(".no-items").fadeIn(200);
                  } else {
                        $(".no-items").fadeOut(200);
                  }
                  
               });
                
                
                
               var filters = {};
               var comboFilter = "";
               $('#options').on( 'change', function( event ) {
                  $(".no-items").fadeOut(0);
                  var checkbox = event.target;
                  var $checkbox = $( checkbox );
                  var group = $checkbox.parents('.filter-group').attr('data-group');
                    
                  $('#options .filter-group').each(function(){
                     const $checks = $(this).find('input');
                        
                     if( $(this).find('input:checked').length ) {
                        $(this).addClass('active');
                     } else {
                        $(this).removeClass('active');
                     }
                        
                  });
                  
                  
                  // Initialize an empty array to store input values
                   var queryParams = [];
                  
                   // Iterate over each checked input within #options
                   $('#options input:checked').each(function() {
                       // Get the name and value of each checked input
                       var name = $(this).attr('name');
                       var value = $(this).val();
                  
                       // Construct query parameter string and push to array
                       queryParams.push(encodeURIComponent(name) + '=' + encodeURIComponent(value));
                   });
                  
                   // Construct the full query string by joining all query parameters with '&'
                   var queryString = queryParams.join('&');
                  
                   // Update the URL with the new query string
                   window.history.replaceState({}, '', window.location.pathname + '?' + queryString);
                   
                   
                
                  // create array for filter group, if not there yet
                  var filterGroup = filters[ group ];
                  if ( !filterGroup ) {
                     filterGroup = filters[ group ] = [];
                  }
                  // add/remove filter
                  if ( checkbox.checked ) {
                     // add filter
                     filterGroup.push( checkbox.value );
                  } else {
                     // remove filter
                  var index = filterGroup.indexOf( checkbox.value );
                     filterGroup.splice( index, 1 );
                  }
                
                  var comboFilter = getComboFilter();
                  $container.isotope({ 
                     filter: comboFilter,
                     itemSelector: '.filter-grid article',
                     layoutMode: 'fitRows',
                  });
                    
                });
                
                
                
               //Click matching button if query string match
               // Parse the query string
                var queryString = window.location.search.substring(1);
                var queryParams = queryString.split('&');
                var params = {};
                queryParams.forEach(function(param) {
                    var pair = param.split('=');
                    var name = pair[0];
                    var value = decodeURIComponent(pair[1]);
               
                    // If the parameter name is already in the params object, push the value to an array
                    if (params[name]) {
                        if (!Array.isArray(params[name])) {
                            params[name] = [params[name]];
                        }
                        params[name].push(value);
                    } else {
                        params[name] = value;
                    }
                });
               
                // Check inputs based on query parameters
                for (var key in params) {
                    var values = params[key];
                    if (Array.isArray(values)) {
                        // If the value is an array, iterate over each value and check the corresponding inputs
                        values.forEach(function(value) {
                            checkInput(key, value);
                        });
                    } else {
                        // If the value is not an array, check the corresponding input
                        checkInput(key, values);
                    }
                }
               
                function checkInput(name, value) {
                    var $inputs = $('#options').find('input[name="' + name + '"][value="' + value + '"]');
                    if ($inputs.length > 0) {
                        //$inputs.prop('checked', true);
                        $inputs.click();
                    }
                }
                
                
                
                
               function getComboFilter() {
                    var combo = [];
                    for ( var prop in filters ) {
                        var group = filters[ prop ];
                        if ( !group.length ) {
                        // no filters in group, carry on
                            continue;
                        }
                        // add first group
                        if ( !combo.length ) {
                            combo = group.slice(0);
                            continue;
                        }
                        // add additional groups
                        var nextCombo = [];
                        // split group into combo: [ A, B ] & [ 1, 2 ] => [ A1, A2, B1, B2 ]
                        for ( var i=0; i < combo.length; i++ ) {
                            for ( var j=0; j < group.length; j++ ) {
                                var item = combo[i] + group[j];
                                nextCombo.push( item );
                            }
                        }
                        combo = nextCombo;
                    }
                    var comboFilter = combo.join(', ');
                        return comboFilter;
                }
    
                
                //****************************
                  // Isotope Load more button
                  //****************************
                  var initShow = $postsPer; //number of items loaded on init & onclick load more button
                  var counter = initShow; //counter for load more button
                  var iso = $container.data('isotope'); // get Isotope instance
                
                  loadMore(initShow); //execute function onload
                
                  function loadMore(toShow) {
                    $container.find(".hidden").removeClass("hidden");
                    
                    setEqualRowHeights();
                
                    var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
                      return item.element;
                    });
                    $(hiddenElems).addClass('hidden');
                    $container.isotope('layout');
                
                    //when no more to load, hide show more button
                    if (hiddenElems.length == 0) {
                      jQuery("#load-more").hide();
                    } else {
                      jQuery("#load-more").show();
                    };
                
                  }
                                
                  //when load more button clicked
                  $("#load-more").click(function() {
                    if ($('#filters').data('clicked')) {
                      //when filter button clicked, set initial value for counter
                      counter = initShow;
                      $('#filters').data('clicked', false);
                    } else {
                      counter = counter;
                    };
                
                    counter = counter + initShow;
                
                    loadMore(counter);
                  });
                
                  //when filter button clicked
                  $('#options').on( 'change', function( event ) {
                      loadMore(initShow);
                  });
                  
            });
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
        _app.mobile_takover_nav();
        _app.sliders();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);