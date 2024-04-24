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

// Tabs UI
//@prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordion
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

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

// Offcanvas Navigation Option
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

// js-cookie
//@prepros-prepend vendor/js-cookie.js

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
                
                const $container = $('.isotope-filter-loadmore .filter-grid');
                var $postsPer = $isotopeFilterLoadMore.getAttribute('data-postsper');
                //console.log('posts per load:' + $postsPer);
                
               const facetingBtns = function(filteredItems) {
                    // console.log('Filtering Complete after filter with ' + filteredItems.length + ' items');
                    const filterButtons = document.querySelectorAll('#options input');
               
                    if (filterButtons.length > 0) {
                        const postsShown = filteredItems;
                        let activeTerms = [];
               
                        postsShown.forEach(function(postShown) {
                            if (postShown) {
                                const post = Object.values(postShown);
                                const terms = post[0].getAttribute('data-terms');
                                activeTerms.push(terms.split(' '));
                            }
                        });
               
                        // Flatten the array of arrays into a single array
                        activeTerms = activeTerms.flat();
               
                        filterButtons.forEach(function(btn) {
                           
                            var greatGrandparent = $(btn).parent().parent().parent();
                            var grandparent = $(btn).parent().parent();
                            const taxonomyGroup = $(grandparent).data('group');

                            const btnTerms = btn.getAttribute('data-taxonomy-terms').split(' ');
               
                            const hasMatchingTerm = btnTerms.some(term => activeTerms.includes(term));
                            const wrapper = btn.parentElement.parentElement;
                            var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);
                            if (!hasMatchingTerm) {
                                if (!wrapper.classList.contains('top-level')) {
                                    wrapper.classList.add('hide-btn');
                                }
                            } else {
                                if(!groupSiblings.hasClass('active')) {
                                    wrapper.classList.remove('hide-btn');
                                }
                            }
                        });
                    }
                };
               
                $($container).isotope({
                    itemSelector: '.filter-grid article',
                    layoutMode: 'fitRows',
                });
                let showVideos = false;
                let videoCookie = Cookies.get('video-access');                
                let gravityFormId = '';
                let formIntroCopy;
                let hiddenIsotopeContainer;
                let topBarHeight;
                let blockVideo;
                let moreVidsTab;
                const blockVideos = document.querySelectorAll('.block-videos');
                const allGravityForms = document.querySelectorAll('.block-videos .gform_wrapper');
                const allFormIntroCopies = document.querySelectorAll('.block-videos .form-intro-copy');

                if (blockVideos.length > 0) {
                    if( videoCookie == 'true' ) {
                        showVideos = true;
                    }
                                        
                    blockVideos.forEach(function (blockVideo) {
                        formIntroCopy = blockVideo.querySelector('.form-intro-copy');
                        const gravityForm = blockVideo.querySelector('.gform_wrapper form');
                        moreVidsTab = blockVideo.querySelector('.more-vids-tab');
                        if (gravityForm) {
                            gravityFormId = gravityForm.getAttribute('data-formid');
                            hiddenIsotopeContainer = blockVideo.querySelector('.isotope-filter-loadmore');
                            formIntroCopy = blockVideo.querySelector('.form-intro-copy');
                        }
                    });
                    
                    const showVideosFunction = function() {
                        formIntroCopy.style.display = 'none';
                        hiddenIsotopeContainer.style.height = 'auto';
                        hiddenIsotopeContainer.style.visibility = 'visible';
                        $container.isotope('layout');
                        hiddenIsotopeContainer.style.opacity = 1;
                    }
               
                    if (gravityFormId && hiddenIsotopeContainer && hiddenIsotopeContainer.classList.contains('loading')) {
                        $(document).on("gform_confirmation_loaded", function (e, formID) {
                            if (formID == gravityFormId) {
                                hiddenIsotopeContainer.classList.remove('loading');
                                showVideosFunction();
                                Cookies.set('video-access', 'true', { expires: 30 });
                                showVideos = true;
                                const topBarHeight = document.querySelector('.top-bar').offsetHeight;
                                const hiddenIsotopeContainerOffsetTop = hiddenIsotopeContainer.parentElement.offsetTop;
                                
                                setTimeout(function () {
                                    window.scrollTo({
                                      top: hiddenIsotopeContainerOffsetTop - topBarHeight - 60,
                                      behavior: 'smooth'
                                    });
                                }, 1000);
                            }
                        });
                    }
                    
                    if( showVideos === true && moreVidsTab ) {
                        moreVidsTab.addEventListener('click', function (event) {
                            event.preventDefault();
                            allGravityForms.forEach(function (gravityForm) {
                               gravityForm.style.display = 'none'; 
                            });
                            allFormIntroCopies.forEach(function (introCopy) {
                               introCopy.style.display = 'none'; 
                            });
                            setTimeout(function () {
                                showVideosFunction();
                            }, 10);
                        });
                    }

                }
               
               // Function to set equal heights for each row
               const setEqualRowHeights = function() {
                    const rows =$isotopeFilterLoadMore.querySelectorAll('.filter-grid.equal-heights > *'); // Assuming each row is a direct child of .filter-grid
                    let maxRowHeight = 0;
               
                    rows.forEach(function(row) {
                        const rowHeight = row.getBoundingClientRect().height;
                        maxRowHeight = Math.max(maxRowHeight, rowHeight);
                    });
               
                    rows.forEach(function(row) {
                        row.style.minHeight = maxRowHeight + 'px';
                    });
                    $container.isotope('layout');
               };
               // Attach the event listener to the window object
               window.addEventListener('resize', setEqualRowHeights);
                
               $container.addClass('init');

                var isAnimating = false;
                var filters = {};
                var comboFilter = "";
                $('#options input').on( 'click', function( event ) {
                    if (isAnimating) return; // Prevent clicks during transition
                    isAnimating = true; 
                    
                    var checkbox = event.target;
                    var $checkbox = $( checkbox );
                    //var group = $checkbox.parents('.option-set').attr('data-group');
                    


                    // Initialize an empty array to store input values
                    var queryParams = [];
                    
                    var greatGrandparent = $(this).parent().parent().parent();
                    var grandparent = $(this).parent().parent();
                    const taxonomyGroup = $(grandparent).data('group');
                    
                    var group = taxonomyGroup;
                    //console.log(group );
                    
                    if( $(grandparent).hasClass('active') ) {
                        $(grandparent).removeClass('active');
                        var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);
                        $(groupSiblings).each(function() {
                            $(this).removeClass('hide-btn');
                        });
                    } else {
                        $(grandparent).addClass('active');
                        var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);

                        $(groupSiblings).each(function() {
                            if(!$(this).hasClass('active')) {
                                $(this).addClass('hide-btn');
                            }
                        });
                    }

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
                   
                    // Reset the flag after the transition is complete
                    setTimeout(function() {
                        isAnimating = false;
                    }, 350);

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
                    $($container).isotope({
                        filter: comboFilter
                    }).promise().done(function() {
                        // Initialize Isotope and then call facetingBtns directly
                        $container.isotope('layout');
                        facetingBtns($container.data('isotope').filteredItems);

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
                  var initShow = parseInt($postsPer); //number of items loaded on init & onclick load more button
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
                      jQuery("#load-more").parent().hide();
                    } else {
                      jQuery("#load-more").parent().show();
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
                  
        }
    }
    
    _app.mobile_takover_nav = function() {
        const toggles = document.querySelectorAll('.menu-toggle');
        
        toggles.forEach(function (toggle){
            toggle.addEventListener('click', function (event) {
                event.preventDefault();
                
                
                
            });
        });

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
   } 
   
    _app.post_hover_cards = function() {
        window.addEventListener('load', adjustTextWrapPosition);
        window.addEventListener('resize', adjustTextWrapPosition);
        
        function adjustTextWrapPosition() {
            const hoverCards = document.querySelectorAll('.post-card.hover-card');
            hoverCards.forEach(function(card) {
                const contentWrap = card.querySelector('.content-wrap')
                var contentWrapHeight = contentWrap.offsetHeight;
                
                contentWrap.style.marginBottom = -contentWrapHeight + 'px';
                setTimeout( function() {
                card.classList.remove('loading'); 
                }, 1);
            });
        }
    }
    
   _app.accordions = function() {
      $(".accordion").on("down.zf.accordion", function(event) {
         var $openDrawer = $(this).find('.is-active');
         $('html,body').animate({scrollTop: $($openDrawer).offset().top - 120}, 500);
      }); 
   } 
   
   _app.ajax_search = function() {
      $('#search-form').submit(function(event) {
         event.preventDefault();
      
         var keyword = $('#search-input').val();
         
         // Clear previous search results
         $('#search-results').empty();
         
         // Show loading indicator
         $('#search-query').html('Searching...');
         
         $.ajax({
            url: ajax_search_params.ajax_url,
            type: 'GET',
            data: {
               action: 'custom_search',
               search: keyword
            },
            success: function(response) {
               $('#search-query').addClass('has-results');
               $('#search-query').html("Search results for ‘" + response.data.keyword + "’");
      
               var html = '<ul class="search-results-list no-bullet">';
      
               if (response.data.results.length > 0) {
                  response.data.results.forEach(function(result) {
                     html += '<li><h4 class="h3"><a href="' + result.url + '">' + result.title + '</a></h4></li>';
                  });
               } else {
                  html += '<li><h5>No results found.</h5></li>';
               }
      
               html += '</ul>';
      
               $('#search-results').append(html);
            },
            error: function(xhr, status, error) {
               console.error(error);
            }
         });
      });
   }
   
   _app.video_lazyload = function() {
    //     const youtubePlayers = document.querySelectorAll(".youtube-placeholder");
    //     
    //     if(youtubePlayers) {
    //         console.log("loaded");
    //         // Check if the YouTube iframe API script exists in the DOM
    //         var youtubeApiScript = document.querySelector('script[src="https://www.youtube.com/iframe_api"]');
    //         
    //         // If the script doesn't exist, dynamically create and append it to the DOM
    //         if (!youtubeApiScript) {
    //             youtubeApiScript = document.createElement('script');
    //             youtubeApiScript.src = 'https://www.youtube.com/iframe_api';
    //             document.body.appendChild(youtubeApiScript);
    //         }
    // 
    //        
    //         let observer = new IntersectionObserver(function(entries) {
    //         entries.forEach(function(entry) {
    //            if (entry.isIntersecting) {
    //                 var videoId = entry.target.dataset.videoId;
    //                 var params = {
    //                     controls: 1,
    //                     hd: 1,
    //                     autohide: 1
    //                 };
    //                 var player = new YT.Player(entry.target, {
    //                     height: '900',
    //                     width: '1600',
    //                     videoId: videoId + '?' + new URLSearchParams(params).toString()
    //                 });
    //            
    //                 observer.unobserve(entry.target);
    //            }
    //          });
    //        }, { threshold: 0.5 });
    //        
    //        youtubePlayers.forEach(function(player) {
    //          observer.observe(player);
    //        });
    //     }

        $(document).on('open.zf.reveal', '[data-reveal]', function() {
            if ($(this).hasClass('video-modal')) {
                let existingSrc = '';
                const src = $(this).find('[data-src-defer]').data('src-defer');
                const iframe = $(this).find('iframe');
                existingSrc = iframe.attr('src');
                if ( !existingSrc && src && iframe.length > 0) {
                    iframe.attr('src', src);
                }
            }
        });

   }
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.display_on_load();
        _app.fade_function();
        
        // Custom Functions
        _app.accordions();
        _app.isotope_filtering();
        _app.mobile_takover_nav();
        _app.sliders();
        _app.post_hover_cards();
        _app.ajax_search();
        _app.video_lazyload();
    }
    
    
    // initialize functions on load
    document.addEventListener("DOMContentLoaded", () => {
        _app.init();
    });
	
	
})(jQuery);