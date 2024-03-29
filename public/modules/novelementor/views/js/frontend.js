(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var ElementsHandler;

ElementsHandler = function( $ ) {
	this.runReadyTrigger = function( $scope ) {
		var elementType = $scope.data( 'element_type' );

		if ( ! elementType ) {
			return;
		}

		elementorFrontend.hooks.doAction( 'frontend/element_ready/global', $scope, $ );

		var isWidgetType = ( -1 === [ 'section', 'column' ].indexOf( elementType ) );
		if ( isWidgetType ) {
			elementorFrontend.hooks.doAction( 'frontend/element_ready/widget', $scope, $ );
		}

		elementorFrontend.hooks.doAction( 'frontend/element_ready/' + elementType, $scope, $ );
	};
};

module.exports = ElementsHandler;

},{}],2:[function(require,module,exports){
/* global elementorFrontendConfig */
( function( $ ) {
	var EventManager = require( '../utils/hooks' ),
		ElementsHandler = require( 'elementor-frontend/elements-handler' ),
		Utils = require( 'elementor-frontend/utils' );

	var ElementorFrontend = function() {
		var self = this,
			scopeWindow = window;

		var addGlobalHandlers = function() {
			self.hooks.addAction( 'frontend/element_ready/global', require( 'elementor-frontend/handlers/global' ) );
			self.hooks.addAction( 'frontend/element_ready/widget', require( 'elementor-frontend/handlers/widget' ) );
		};

		var addElementsHandlers = function() {
			$.each( self.handlers, function( elementName, funcCallback ) {
				self.hooks.addAction( 'frontend/element_ready/' + elementName, funcCallback );
			} );
		};

		var runElementsHandlers = function() {
			var $elements;

			if ( self.isEditMode() ) {
				// Elements outside from the Preview
				$elements = self.getScopeWindow().jQuery( '.elementor-element', '.elementor:not(#elementor)' );
			} else {
				$elements = $( '.elementor-element' );
			}

			$elements.each( function() {
				self.elementsHandler.runReadyTrigger( $( this ) );
			} );
		};

		this.handlers = {
			'section': require( 'elementor-frontend/handlers/section' ),
			'accordion.default': require( 'elementor-frontend/handlers/accordion' ),
			'alert.default': require( 'elementor-frontend/handlers/alert' ),
			'counter.default': require( 'elementor-frontend/handlers/counter' ),
			'progress.default': require( 'elementor-frontend/handlers/progress' ),
			'tabs.default': require( 'elementor-frontend/handlers/tabs' ),
			'toggle.default': require( 'elementor-frontend/handlers/toggle' ),
			'video.default': require( 'elementor-frontend/handlers/video' ),
			'image-carousel.default': require( 'elementor-frontend/handlers/image-carousel' ),
			'trustedshops-reviews.default': require( 'elementor-frontend/handlers/image-carousel' ),
			'product-carousel.default': require( 'elementor-frontend/handlers/image-carousel' ),
			'menu-anchor.default': require( 'elementor-frontend/handlers/menu-anchor' ),
			'flip-box.default': require( 'elementor-frontend/handlers/flip-box' ),
			'nov-nivo-slider.default': require( 'elementor-frontend/handlers/nov-nivo-slider' ),
                        'nov-product-list.default': require( 'elementor-frontend/handlers/nov-product-list' ),
                        'nov-product-list-2.default': require( 'elementor-frontend/handlers/nov-product-list-2' ),
                        'nov-blog-list.default': require( 'elementor-frontend/handlers/nov-blog-list' ),
                        'nov-product-tabs.default': require( 'elementor-frontend/handlers/nov-product-tabs' ),
                        'nov-product-tabs-category.default': require( 'elementor-frontend/handlers/nov-product-tabs-category' ),
                        'nov-image-gallery.default': require( 'elementor-frontend/handlers/nov-image-gallery' ),
                        'nov-manufacture.default': require( 'elementor-frontend/handlers/nov-manufacture' ),
                        'nov-product-deal.default': require( 'elementor-frontend/handlers/nov-product-deal' ),
                        'nov-testimonials.default': require( 'elementor-frontend/handlers/nov-testimonials' ),
                        'nov-slider-text.default': require( 'elementor-frontend/handlers/nov-slider-text' ),
                        'nov-lookbook.default': require( 'elementor-frontend/handlers/nov-lookbook' ),
                        'nov-banner-product.default': require( 'elementor-frontend/handlers/nov-banner-product' ),
                        'nov-product-top-trending.default': require( 'elementor-frontend/handlers/nov-product-top-trending' ),
                        'nov-banner-slider.default': require( 'elementor-frontend/handlers/nov-banner-slider' ),
		};

		this.config = elementorFrontendConfig;

		this.getScopeWindow = function() {
			return scopeWindow;
		};

		this.setScopeWindow = function( window ) {
			scopeWindow = window;
		};

		this.isEditMode = function() {
			return self.config.isEditMode;
		};

		this.hooks = new EventManager();
		this.elementsHandler = new ElementsHandler( $ );
		this.utils = new Utils( $ );

		this.init = function() {
			addGlobalHandlers();

			addElementsHandlers();

			self.utils.insertYTApi();

			runElementsHandlers();
		};

		// Based on underscore function
		this.throttle = function( func, wait ) {
			var timeout,
				context,
				args,
				result,
				previous = 0;

			var later = function() {
				previous = Date.now();
				timeout = null;
				result = func.apply( context, args );

				if ( ! timeout ) {
					context = args = null;
				}
			};

			return function() {
				var now = Date.now(),
					remaining = wait - ( now - previous );

				context = this;
				args = arguments;

				if ( remaining <= 0 || remaining > wait ) {
					if ( timeout ) {
						clearTimeout( timeout );
						timeout = null;
					}

					previous = now;
					result = func.apply( context, args );

					if ( ! timeout ) {
						context = args = null;
					}
				} else if ( ! timeout ) {
					timeout = setTimeout( later, remaining );
				}

				return result;
			};
		};
	};

	window.elementorFrontend = new ElementorFrontend();
} )( jQuery );

jQuery( function() {
	if ( ! elementorFrontend.isEditMode() ) {
		elementorFrontend.init();
	}
} );

},{
	"elementor-frontend/elements-handler":1,
	"elementor-frontend/handlers/accordion":3,
	"elementor-frontend/handlers/alert":4,
	"elementor-frontend/handlers/counter":5,
	"elementor-frontend/handlers/global":6,
	"elementor-frontend/handlers/image-carousel":7,
	"elementor-frontend/handlers/menu-anchor":8,
	"elementor-frontend/handlers/progress":9,
	"elementor-frontend/handlers/section":10,
	"elementor-frontend/handlers/tabs":11,
	"elementor-frontend/handlers/toggle":12,
	"elementor-frontend/handlers/video":13,
	"elementor-frontend/handlers/widget":14,
	"elementor-frontend/handlers/flip-box":15,
	"elementor-frontend/utils":16,
	"../utils/hooks":17,
        "elementor-frontend/handlers/nov-nivo-slider":18,
        "elementor-frontend/handlers/nov-slider-text":19,
        "elementor-frontend/handlers/nov-product-list":20,
        "elementor-frontend/handlers/nov-product-tabs":21,
        "elementor-frontend/handlers/nov-blog-list":22,
        "elementor-frontend/handlers/nov-product-tabs-category":23,
        "elementor-frontend/handlers/nov-image-gallery":24,
        "elementor-frontend/handlers/nov-manufacture":25,
        "elementor-frontend/handlers/nov-product-deal":26,
        "elementor-frontend/handlers/nov-testimonials":27,
        "elementor-frontend/handlers/nov-lookbook":28,
        "elementor-frontend/handlers/nov-banner-product":29,
        "elementor-frontend/handlers/nov-product-top-trending":30,
        "elementor-frontend/handlers/nov-banner-slider":31,
        "elementor-frontend/handlers/nov-product-list-2":32,
        
}],3:[function(require,module,exports){
var activateSection = function( sectionIndex, $accordionTitles ) {
	var $activeTitle = $accordionTitles.filter( '.active' ),
		$requestedTitle = $accordionTitles.filter( '[data-section="' + sectionIndex + '"]' ),
		isRequestedActive = $requestedTitle.hasClass( 'active' );

	$activeTitle
		.removeClass( 'active' )
		.next()
		.slideUp();

	if ( ! isRequestedActive ) {
		$requestedTitle
			.addClass( 'active' )
			.next()
			.slideDown();
	}
};

module.exports = function( $scoop, $ ) {
	var defaultActiveSection = $scoop.find( '.elementor-accordion' ).data( 'active-section' ),
		$accordionTitles = $scoop.find( '.elementor-accordion-title' );

	if ( ! defaultActiveSection ) {
		defaultActiveSection = 1;
	}

	activateSection( defaultActiveSection, $accordionTitles );

	$accordionTitles.on( 'click', function() {
		activateSection( this.dataset.section, $accordionTitles );
	} );
};

},{}],4:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	$scoop.find( '.elementor-alert-dismiss' ).on( 'click', function() {
		$( this ).parent().fadeOut();
	} );
};

},{}],5:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	$scoop.find( '.elementor-counter-number' ).waypoint( function() {
		var $number = $( this );

		$number.numerator( {
			duration: $number.data( 'duration' )
		} );
	}, { offset: '90%' } );
};

},{}],6:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	if ( elementorFrontend.isEditMode() ) {
		return;
	}

	var animation = $scoop.data( 'animation' );

	if ( ! animation ) {
		return;
	}

	$scoop.addClass( 'elementor-invisible' ).removeClass( animation );

	$scoop.waypoint( function() {
		$scoop.removeClass( 'elementor-invisible' ).addClass( animation );
	}, { offset: '90%' } );
};

},{}],7:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	var $carousel = $scoop.find( '.elementor-image-carousel' );
	if ( ! $carousel.length ) {
		return;
	}

	var savedOptions = $carousel.data( 'slider_options' ),
		tabletSlides = 1 === savedOptions.slidesToShow ? 1 : 2,
		defaultOptions = {
			respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
			responsive: [
				{
					breakpoint: 769,
					settings: {
						slidesToShow: savedOptions.slidesToShowTablet,
						slidesToScroll: tabletSlides
					}
				},
				{
					breakpoint: 481,
					settings: {
						slidesToShow: savedOptions.slidesToShowMobile,
						slidesToScroll: 1
					}
				}
			]
		},

		slickOptions = $.extend( {}, defaultOptions, $carousel.data( 'slider_options' ) );

	$carousel.slick( slickOptions );
};

},{}],8:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	if ( elementorFrontend.isEditMode() ) {
		return;
	}

	var $anchor = $scoop.find( '.elementor-menu-anchor' ),
		anchorID = $anchor.attr( 'id' ),
		$anchorLinks = $( 'a[href*="#' + anchorID + '"]' ),
		$scrollable = $( 'html, body' ),
		adminBarHeight = $( '#wpadminbar' ).height();

	$anchorLinks.on( 'click', function( event ) {
		var isSamePathname = ( location.pathname === this.pathname ),
			isSameHostname = ( location.hostname === this.hostname );

		if ( ! isSameHostname || ! isSamePathname ) {
			return;
		}

		event.preventDefault();

		$scrollable.animate( {
			scrollTop: $anchor.offset().top - adminBarHeight
		}, 1000 );
	} );
};

},{}],9:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	var interval = 80;

	$scoop.find( '.elementor-progress-bar' ).waypoint( function() {
		var $progressbar = $( this ),
			max = parseInt( $progressbar.data( 'max' ), 10 ),
			$inner = $progressbar.next(),
			$innerTextWrap = $inner.find( '.elementor-progress-text' ),
			$percent = $inner.find( '.elementor-progress-percentage' ),
			innerText = $inner.data( 'inner' ) ? $inner.data( 'inner' ) : '';

		$progressbar.css( 'width', max + '%' );
		$inner.css( 'width', max + '%' );
		$innerTextWrap.html( innerText + '' );
		$percent.html(  max + '%' );

	}, { offset: '90%' } );
};

},{}],10:[function(require,module,exports){
var BackgroundVideo = function( $backgroundVideoContainer, $ ) {
	var player,
		elements = {},
		isYTVideo = false;

	var calcVideosSize = function() {
		var containerWidth = $backgroundVideoContainer.outerWidth(),
			containerHeight = $backgroundVideoContainer.outerHeight(),
			aspectRatioSetting = '16:9', //TEMP
			aspectRatioArray = aspectRatioSetting.split( ':' ),
			aspectRatio = aspectRatioArray[ 0 ] / aspectRatioArray[ 1 ],
			ratioWidth = containerWidth / aspectRatio,
			ratioHeight = containerHeight * aspectRatio,
			isWidthFixed = containerWidth / containerHeight > aspectRatio;

		return {
			width: isWidthFixed ? containerWidth : ratioHeight,
			height: isWidthFixed ? ratioWidth : containerHeight
		};
	};

	var changeVideoSize = function() {
		var $video = isYTVideo ? $( player.getIframe() ) : elements.$backgroundVideo,
			size = calcVideosSize();

		$video.width( size.width ).height( size.height );
	};

	var prepareYTVideo = function( YT, videoID ) {
		player = new YT.Player( elements.$backgroundVideo[ 0 ], {
			videoId: videoID,
			events: {
				onReady: function() {
					player.mute();

					changeVideoSize();

					player.playVideo();
				},
				onStateChange: function( event ) {
					if ( event.data === YT.PlayerState.ENDED ) {
						player.seekTo( 0 );
					}
				}
			},
			playerVars: {
				controls: 0,
				showinfo: 0
			}
		} );

		$( elementorFrontend.getScopeWindow() ).on( 'resize', changeVideoSize );
	};

	var initElements = function() {
		elements.$backgroundVideo = $backgroundVideoContainer.children( '.elementor-background-video' );
	};

	var run = function() {
		var videoID = elements.$backgroundVideo.data( 'video-id' );

		if ( videoID ) {
			isYTVideo = true;

			elementorFrontend.utils.onYoutubeApiReady( function( YT ) {
				setTimeout( function() {
					prepareYTVideo( YT, videoID );
				}, 1 );
			} );
		} else {
			elements.$backgroundVideo.one( 'canplay', changeVideoSize );
		}
	};

	var init = function() {
		initElements();
		run();
	};
	init();
};

var StretchedSection = function( $section, $ ) {
	var elements = {},
		settings = {};

	var stretchSection = function() {
		// Clear any previously existing css associated with this script
		    var direction = (settings.is_rtl || $section.parents('body').hasClass('lang-rtl')) ? 'right' : 'left';
			resetCss = {
                            width: 'auto'
			};

		resetCss[ direction ] = 0;

		$section.css( resetCss );

		if ( ! $section.hasClass( 'elementor-section-stretched' ) ) {
			return;
		}
                if ($( elements.scopeWindow.document ).find('.sidebar-left').hasClass('eleven')) {
			if (elements.$scopeWindow.width() > 1024) {
				var containerWidth = elements.$scopeWindow.width() - $(elements.scopeWindow.document).find('.sidebar-left').outerWidth(),
                                sectionWidth = $section.outerWidth();
                                if ( settings.is_rtl || $section.parents('body').hasClass('lang-rtl')) {
                                    sectionOffset = $section.offset().left;
                                }
                                else {
                                    sectionOffset = $section.offset().left - $(elements.scopeWindow.document).find('.sidebar-left').outerWidth();
                                }
                                correctOffset = sectionOffset;
                 
			}
			else {
				var containerWidth = elements.$scopeWindow.width(),
                                sectionWidth = $section.outerWidth(),
                                sectionOffset = $section.offset().left,
                                correctOffset = sectionOffset;
			}
		}
		else {
			var containerWidth = elements.$scopeWindow.width(),
                        sectionWidth = $section.outerWidth(),
                        sectionOffset = $section.offset().left,
                        correctOffset = sectionOffset;
		}
		if ( elements.$sectionContainer.length ) {
			var containerOffset = elements.$sectionContainer.offset().left;

			containerWidth = elements.$sectionContainer.outerWidth();

			if ( sectionOffset > containerOffset ) {
				correctOffset = sectionOffset - containerOffset;
			} else {
				correctOffset = 0;
			}
		}

                if ( settings.is_rtl || $section.parents('body').hasClass('lang-rtl')) {
                    correctOffset = containerWidth - ( sectionWidth + correctOffset );
                }

		resetCss.width = containerWidth + 'px';
                
		resetCss[ direction ] = -correctOffset + 'px';

		$section.css( resetCss );
	};

	var initSettings = function() {
		settings.sectionContainerSelector = elementorFrontend.config.stretchedSectionContainer;
		settings.is_rtl = elementorFrontend.config.is_rtl;
	};

	var initElements = function() {
		elements.scopeWindow = elementorFrontend.getScopeWindow();
		elements.$scopeWindow = $( elements.scopeWindow );
		elements.$sectionContainer = $( elements.scopeWindow.document ).find( settings.sectionContainerSelector );
	};

	var bindEvents = function() {
		elements.$scopeWindow.on( 'resize', stretchSection );
	};

	var init = function() {
		initSettings();
		initElements();
		bindEvents();
		stretchSection();
	};

	init();
};

module.exports = function( $scoop, $ ) {
	new StretchedSection( $scoop, $ );

	var $backgroundVideoContainer = $scoop.find( '.elementor-background-video-container' );

	if ( $backgroundVideoContainer ) {
		new BackgroundVideo( $backgroundVideoContainer, $ );
	}
};

},{}],11:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	var defaultActiveTab = $scoop.find( '.elementor-tabs' ).data( 'active-tab' ),
		$tabsTitles = $scoop.find( '.elementor-tab-title' ),
		$tabs = $scoop.find( '.elementor-tab-content' ),
		$active,
		$content;

	if ( ! defaultActiveTab ) {
		defaultActiveTab = 1;
	}

	var activateTab = function( tabIndex ) {
		if ( $active ) {
			$active.removeClass( 'active' );

			$content.hide();
		}

		$active = $tabsTitles.filter( '[data-tab="' + tabIndex + '"]' );

		$active.addClass( 'active' );

		$content = $tabs.filter( '[data-tab="' + tabIndex + '"]' );

		$content.show();
	};

	activateTab( defaultActiveTab );

	$tabsTitles.on( 'click', function() {
		activateTab( this.dataset.tab );
	} );
};

},{}],12:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	var $toggleTitles = $scoop.find( '.elementor-toggle-title' );

	$toggleTitles.on( 'click', function() {
		var $active = $( this ),
			$content = $active.next();

		if ( $active.hasClass( 'active' ) ) {
			$active.removeClass( 'active' );
			$content.slideUp();
		} else {
			$active.addClass( 'active' );
			$content.slideDown();
		}
	} );
};

},{}],13:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	var $imageOverlay = $scoop.find( '.elementor-custom-embed-image-overlay' ),
		$videoFrame = $scoop.find( 'iframe' );

	if ( ! $imageOverlay.length ) {
		return;
	}

	$imageOverlay.on( 'click', function() {
		$imageOverlay.remove();
		var newSourceUrl = $videoFrame[0].src;
		// Remove old autoplay if exists
		newSourceUrl = newSourceUrl.replace( '&autoplay=0', '' );

		$videoFrame[0].src = newSourceUrl + '&autoplay=1';
	} );
};

},{}],14:[function(require,module,exports){
module.exports = function( $scoop, $ ) {
	if ( ! elementorFrontend.isEditMode() ) {
		return;
	}

	if ( $scoop.hasClass( 'elementor-widget-edit-disabled' ) ) {
		return;
	}

	$scoop.find( '.elementor-element' ).each( function() {
		elementorFrontend.elementsHandler.runReadyTrigger( $( this ) );
	} );
};

},{}],15:[function(require,module,exports){
var $style,
	aTabs = '.elementor-control-section_a, .elementor-control-section_style_a, .elementor-control-section_flip_box, .elementor-tabs-controls [data-tab]',
	bTabs = '.elementor-control-section_b, .elementor-control-section_style_b, .elementor-control-section_style_button';

function clearStyle() {
	$style.html('#elementor .elementor-flip-box-back { transition: none; }');

	setTimeout(function() { $style.html('') }, 100);
}
function backStyle() {
	var wrapper = '#elementor-element-' + elementor.panel.currentView.content.currentView.model.id;

	$style.html(
		wrapper + ' .elementor-flip-box-front { display: none; }\n' +
		wrapper + ' .elementor-flip-box-back { transition: none; transform: none; opacity: 1; }'
	);
}

module.exports = function( $scoop, $ ) {
	if (!elementorFrontend.isEditMode()) return;

	if ($style) return elementor.panel.$el.find('.elementor-control.elementor-open:first').prev(bTabs).length || clearStyle();
//	$style = $('<style id="ce-flip-box-edit-back">').appendTo(elementor.$previewContents.find('head'));
//
//	elementor.panel.$el
//		.on('mouseup.ce-flip-clear', aTabs, function(e) { 1 === e.which && clearStyle() })
//		.on('mouseup.ce-flip-back', bTabs, function(e) { 1 === e.which && backStyle() })
//	;
};

},{}],16:[function(require,module,exports){
var Utils;

Utils = function( $ ) {
	var self = this;

	this.onYoutubeApiReady = function( callback ) {
		if ( window.YT && YT.loaded ) {
			callback( YT );
		} else {
			// If not ready check again by timeout..
			setTimeout( function() {
				self.onYoutubeApiReady( callback );
			}, 350 );
		}
	};

	this.insertYTApi = function() {
		$( 'script:first' ).before(  $( '<script>', { src: 'https://www.youtube.com/iframe_api' } ) );
	};
};

module.exports = Utils;

},{}],17:[function(require,module,exports){
'use strict';

/**
 * Handles managing all events for whatever you plug it into. Priorities for hooks are based on lowest to highest in
 * that, lowest priority hooks are fired first.
 */
var EventManager = function() {
	var slice = Array.prototype.slice,
		MethodsAvailable;

	/**
	 * Contains the hooks that get registered with this EventManager. The array for storage utilizes a "flat"
	 * object literal such that looking up the hook utilizes the native object literal hash.
	 */
	var STORAGE = {
		actions: {},
		filters: {}
	};

	/**
	 * Removes the specified hook by resetting the value of it.
	 *
	 * @param type Type of hook, either 'actions' or 'filters'
	 * @param hook The hook (namespace.identifier) to remove
	 *
	 * @private
	 */
	function _removeHook( type, hook, callback, context ) {
		var handlers, handler, i;

		if ( ! STORAGE[ type ][ hook ] ) {
			return;
		}
		if ( ! callback ) {
			STORAGE[ type ][ hook ] = [];
		} else {
			handlers = STORAGE[ type ][ hook ];
			if ( ! context ) {
				for ( i = handlers.length; i--; ) {
					if ( handlers[ i ].callback === callback ) {
						handlers.splice( i, 1 );
					}
				}
			} else {
				for ( i = handlers.length; i--; ) {
					handler = handlers[ i ];
					if ( handler.callback === callback && handler.context === context ) {
						handlers.splice( i, 1 );
					}
				}
			}
		}
	}

	/**
	 * Use an insert sort for keeping our hooks organized based on priority. This function is ridiculously faster
	 * than bubble sort, etc: http://jsperf.com/javascript-sort
	 *
	 * @param hooks The custom array containing all of the appropriate hooks to perform an insert sort on.
	 * @private
	 */
	function _hookInsertSort( hooks ) {
		var tmpHook, j, prevHook;
		for ( var i = 1, len = hooks.length; i < len; i++ ) {
			tmpHook = hooks[ i ];
			j = i;
			while ( ( prevHook = hooks[ j - 1 ] ) && prevHook.priority > tmpHook.priority ) {
				hooks[ j ] = hooks[ j - 1 ];
				--j;
			}
			hooks[ j ] = tmpHook;
		}

		return hooks;
	}

	/**
	 * Adds the hook to the appropriate storage container
	 *
	 * @param type 'actions' or 'filters'
	 * @param hook The hook (namespace.identifier) to add to our event manager
	 * @param callback The function that will be called when the hook is executed.
	 * @param priority The priority of this hook. Must be an integer.
	 * @param [context] A value to be used for this
	 * @private
	 */
	function _addHook( type, hook, callback, priority, context ) {
		var hookObject = {
			callback: callback,
			priority: priority,
			context: context
		};

		// Utilize 'prop itself' : http://jsperf.com/hasownproperty-vs-in-vs-undefined/19
		var hooks = STORAGE[ type ][ hook ];
		if ( hooks ) {
			hooks.push( hookObject );
			hooks = _hookInsertSort( hooks );
		} else {
			hooks = [ hookObject ];
		}

		STORAGE[ type ][ hook ] = hooks;
	}

	/**
	 * Runs the specified hook. If it is an action, the value is not modified but if it is a filter, it is.
	 *
	 * @param type 'actions' or 'filters'
	 * @param hook The hook ( namespace.identifier ) to be ran.
	 * @param args Arguments to pass to the action/filter. If it's a filter, args is actually a single parameter.
	 * @private
	 */
	function _runHook( type, hook, args ) {
		var handlers = STORAGE[ type ][ hook ], i, len;

		if ( ! handlers ) {
			return ( 'filters' === type ) ? args[ 0 ] : false;
		}

		len = handlers.length;
		if ( 'filters' === type ) {
			for ( i = 0; i < len; i++ ) {
				args[ 0 ] = handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		} else {
			for ( i = 0; i < len; i++ ) {
				handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		}

		return ( 'filters' === type ) ? args[ 0 ] : true;
	}

	/**
	 * Adds an action to the event manager.
	 *
	 * @param action Must contain namespace.identifier
	 * @param callback Must be a valid callback function before this action is added
	 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
	 * @param [context] Supply a value to be used for this
	 */
	function addAction( action, callback, priority, context ) {
		if ( 'string' === typeof action && 'function' === typeof callback ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'actions', action, callback, priority, context );
		}

		return MethodsAvailable;
	}

	/**
	 * Performs an action if it exists. You can pass as many arguments as you want to this function; the only rule is
	 * that the first argument must always be the action.
	 */
	function doAction( /* action, arg1, arg2, ... */ ) {
		var args = slice.call( arguments );
		var action = args.shift();

		if ( 'string' === typeof action ) {
			_runHook( 'actions', action, args );
		}

		return MethodsAvailable;
	}

	/**
	 * Removes the specified action if it contains a namespace.identifier & exists.
	 *
	 * @param action The action to remove
	 * @param [callback] Callback function to remove
	 */
	function removeAction( action, callback ) {
		if ( 'string' === typeof action ) {
			_removeHook( 'actions', action, callback );
		}

		return MethodsAvailable;
	}

	/**
	 * Adds a filter to the event manager.
	 *
	 * @param filter Must contain namespace.identifier
	 * @param callback Must be a valid callback function before this action is added
	 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
	 * @param [context] Supply a value to be used for this
	 */
	function addFilter( filter, callback, priority, context ) {
		if ( 'string' === typeof filter && 'function' === typeof callback ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'filters', filter, callback, priority, context );
		}

		return MethodsAvailable;
	}

	/**
	 * Performs a filter if it exists. You should only ever pass 1 argument to be filtered. The only rule is that
	 * the first argument must always be the filter.
	 */
	function applyFilters( /* filter, filtered arg, arg2, ... */ ) {
		var args = slice.call( arguments );
		var filter = args.shift();

		if ( 'string' === typeof filter ) {
			return _runHook( 'filters', filter, args );
		}

		return MethodsAvailable;
	}

	/**
	 * Removes the specified filter if it contains a namespace.identifier & exists.
	 *
	 * @param filter The action to remove
	 * @param [callback] Callback function to remove
	 */
	function removeFilter( filter, callback ) {
		if ( 'string' === typeof filter ) {
			_removeHook( 'filters', filter, callback );
		}

		return MethodsAvailable;
	}

	/**
	 * Maintain a reference to the object scope so our public methods never get confusing.
	 */
	MethodsAvailable = {
		removeFilter: removeFilter,
		applyFilters: applyFilters,
		addFilter: addFilter,
		removeAction: removeAction,
		doAction: doAction,
		addAction: addAction
	};

	// return all of the publicly available methods
	return MethodsAvailable;
};

module.exports = EventManager;

},{}],18:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $vinoslider = $scoop.find( '#nov-slider' );
        var $nivoSlider2 = $scoop.find( '.nivoSlider' );
        if ( ! $vinoslider.length ) {
            return;
        }
        var effect = $vinoslider.data('effect');
        var slices = $vinoslider.data('slices');
        var animSpeed = $vinoslider.data('animspeed');
        var pauseTime = $vinoslider.data('pausetime');
        var startSlide = $vinoslider.data('startslide');
        var directionNav = $vinoslider.data('directionnav');
        var controlNav = $vinoslider.data('controlnav');
        var controlNavThumbs = $vinoslider.data('controlnavthumbs');
        var pauseOnHover = $vinoslider.data('pauseonhover');
        var manualAdvance = $vinoslider.data('manualadvance');
        var randomStart = $vinoslider.data('randomstart');
        $nivoSlider2.nivoSlider({
            effect: effect, // Specify sets like: 'fold,fade,sliceDown'
            slices: slices, // For slice animations
            boxCols: 12, // For box animations
            boxRows: 6, // For box animations
            animSpeed: animSpeed, // Slide transition speed
            pauseTime: pauseTime, // How long each slide will show
            startSlide: startSlide, // Set starting Slide (0 index)
            directionNav: directionNav, // Next & Prev navigation
            controlNav: controlNav, // 1,2,3... navigation
            controlNavThumbs: controlNavThumbs, // Use thumbnails for Control Nav
            pauseOnHover: pauseOnHover, // Stop animation while hovering
            manualAdvance: manualAdvance, // Force manual transitions
            prevText: '<i class="zmdi zmdi-long-arrow-left" aria-hidden="true"></i>', // Prev directionNav text
            nextText: '<i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i>', // Next directionNav text
            randomStart: randomStart, // Start on a random slide
            beforeChange: function () {
            }, // Triggers before a slide transition
            afterChange: function () {

            }, // Triggers after a slide transition
            slideshowEnd: function () {

            }, // Triggers after all slides have been shown
            lastSlide: function () {

            }, // Triggers when last slide is shown
            afterLoad: function () {
                //$(".nov_preload").hide();
                $scoop.find(".nov_preload").hide();
            } // Triggers when slider has loaded
        });

    }
    

},{}],19:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov_banner-text .slider-text' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('lg') ? $el.data('lg') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        $el.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: false,
            arrows: nav,
            autoplay: autoplay,
            speed: 300,
            infinite: true,
            autoplaySpeed: 5000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
        });
    });
    }
   
    
},{}],20:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov-product_list .nov-productslick' );
        $el.each(function (index) {
        var width = window.innerWidth || document.body.clientWidth;
        if ($('body').hasClass('lang-rtl')) {
            rtl = true;
            $(this).attr('dir', 'rtl');
        } else {
            rtl = false;
        }
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var rows_mobile = $el.data('rows_mobile') ? $el.data('rows_mobile') : 1;
        var items = $el.data('lg') ? $el.data('lg') : 3;
        if (items > 4)
            var items2 = items - 1;
        else
            var items2 = items;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        if (rows == 1) {
        $el.slick({
            nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            slidesToShow: items,
            slidesToScroll: 1,
            rows: rows,
            arrows: nav,
            dots: dots,
            infinite: true,
            fade: false,
            adaptiveHeight: true,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1920,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                }
            ]
        });
           } else {
               $el.slick({
                nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
                prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
                rtl: rtl,
                dots: dots,
                arrows: nav,
                infinite: false,
                speed: 300,
                slidesToShow: items,
                slidesToScroll: 1,
                respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
                responsive: [
                    {
                        breakpoint: 1920,
                        settings: {
                            slidesToShow: items,
                            slidesToScroll: items,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: items,
                            slidesToScroll: items,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: items_tablet,
                            slidesToScroll: items_tablet,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: items_mobile,
                            slidesToScroll: items_mobile,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: items_mobile,
                            slidesToScroll: items_mobile,
                        }
                    }
                ]
            });
           }
    });
    }
   
  },{}],21:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
    var $el = $scoop.find( '.nov-producttabs .product_list' );
     if (!$el.length) {
             return;
     }
    $el.each(function (index) {
        var self = $(this);
        if ($('body').hasClass('lang-rtl')){
            rtl = true;
            self.attr('dir', 'rtl');
        }else {
            rtl = false; }
        var nav = self.data('arrows') ? self.data('arrows') : false;
        var dots = self.data('dots') ? self.data('dots') : false;
        var autoplay = self.data('autoplay') ? self.data('autoplay') : false;
        var items = self.data('lg') ? self.data('lg') : 3;
        var items_tablet = self.data('md') ? self.data('md') : 2;
        var items_mobile = self.data('xs') ? self.data('xs') : 1;
        var rows = self.data('rows') ? self.data('rows') : 1;
        var rows_mobile = self.data('rows_mobile') ? self.data('rows_mobile') : 1;
        if(rows == 1){
            self.slick({
            nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            slidesToShow: items,
            slidesToScroll: 1,
            rows: rows,
            arrows: nav,
            dots: dots,
            infinite: true,
            fade: false,
            adaptiveHeight: true,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1920,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                }
            ]
        });
           } else {
               self.slick({
                nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
                prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
                rtl: rtl,
                dots: dots,
                arrows: nav,
                infinite: false,
                speed: 300,
                slidesToShow: items,
                slidesToScroll: 1,
                respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
                responsive: [
                    {
                        breakpoint: 1920,
                        settings: {
                            slidesToShow: items,
                            slidesToScroll: items
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: items,
                            slidesToScroll: items
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: items_tablet,
                            slidesToScroll: items_tablet
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: items_mobile,
                            slidesToScroll: items_mobile
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: items_mobile,
                            slidesToScroll: items_mobile
                        }
                    }
                ]
            });
           }
        $('.block_nav .nav-tabs li:first-child').find('.nav-link').addClass('active');
        $('.block_content .tab-content .tab-pane:first-child').addClass('active in');
        var $tabsTitles = $scoop.find( '.nav-item a' ),
        $tabs = $scoop.find( '.tab-content' );
        $tabsTitles.on( 'click', function() {
        $tabsTitles.removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('href');
        $tabs.find('>div').removeClass('active in');
        $tabs.find(id).addClass('active in');
        });
    
    });
    }
    
},{}],22:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov-blogslick-owl' );

        $el.each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var items = $el.data('lg') ? $el.data('lg') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        $el.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: dots,
            arrows: nav,
            slidesPerRow:rows,
            autoplay: autoplay,
            speed: 300,
            infinite: true,
            autoplaySpeed: 3000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
            ]
        });
    });
    }
   
},{}],23:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.product-tabs .nov-productslick' );
        $el.each(function (index) {
            var self = $(this);
            var width = window.innerWidth || document.body.clientWidth;
            if ($('body').hasClass('lang-rtl')) {
                rtl = true;
                self.attr('dir', 'rtl');
            } else {
                rtl = false;
            }
            var nav = self.data('arrows') ? self.data('arrows') : false;
            var dots = self.data('dots') ? self.data('dots') : false;
            var autoplay = self.data('autoplay') ? self.data('autoplay') : false;
            var rows = self.data('rows') ? self.data('rows') : 1;
            var rows_mobile = self.data('rows_mobile') ? self.data('rows_mobile') : 2;
            var items = self.data('lg') ? self.data('lg') : 3;
            if(items > 4)
                var items2 = items - 1;
            else
            var items2 = items;
            var items_tablet = self.data('md') ? self.data('md') : 2;
            var items_mobile = self.data('xs') ? self.data('xs') : 1;
            self.on('init reInit afterChange', function(event, slick, currentSlide) {
                const items = $(this).data('lg');
                page = Math.ceil(((currentSlide || 0) + 1) / items),
                numPages = Math.ceil(slick.slideCount / items);
                self.parents('.tab-pane').find('.current_nav').text(page);
                self.parents('.tab-pane').find('.total_nav').text(numPages);
            });
            if(rows == 1){
            self.slick({
                nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
                prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
                rtl: rtl,
                dots: false,
                arrows: nav,
                slidesPerRow:rows,
                infinite: false,
                speed: 300,
                autoplay: autoplay,
                autoplaySpeed: 3000,
                slidesToShow: items,
                slidesToScroll:items,
                respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
                responsive: [
                {
                    breakpoint: 1920,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                        rows: rows,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                        rows: rows_mobile,
                    }
                }
                ]
            });
            } else{
                    self.slick({
                    nextArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
                    prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
                    rtl: rtl,
                    dots: false,
                    arrows: nav,
                    infinite: false,
                    speed: 300,
                    autoplay: autoplay,
                    autoplaySpeed: 3000,
                    slidesToShow: items,
                    slidesToScroll:items,
                    respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: items2,
                                slidesToScroll: items2,
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: items_tablet,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 720,
                            settings: {
                                slidesToShow: items_mobile,
                                slidesToScroll: 1,
                            }
                        },
                    ]
                }); 
            }
            self.parents('.tab-pane').find('.custom_prev').click(function(){ 
                self.slick('slickPrev');
            } );
            self.parents('.tab-pane').find('.custom_next').click(function(e){
                self.slick('slickNext');
            } );

            $('.block_nav .nav-tabs li:first-child').find('.nav-link').addClass('active');
            $('.block_content .tab-content .tab-pane:first-child').addClass('active in');
            var $tabsTitles = $scoop.find( '.nav-item a' ),
            $tabs = $scoop.find( '.tab-content' );
            $tabsTitles.on( 'click', function() {
            $tabsTitles.removeClass('active');
            $(this).addClass('active');
            var id = $(this).attr('href');
            $tabs.find('>div').removeClass('active in');
            $tabs.find(id).addClass('active in');
        });
        
    });
    }

},{}],24:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov_image_gallery .gallery' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
      
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var items = $el.data('lg') ? $el.data('lg') : 3;
        if(items > 5)
            var items2 = items - 2;
        else
        var items2 = items;
    
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        $el.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: dots,
            arrows: nav,
            slidesPerRow:rows,
            autoplay: autoplay,
            infinite: false,
            speed: 300,
            autoplaySpeed: 3000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items2,
                        slidesToScroll: items2,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
            ]
        });
    });
    }
    
},{}],25:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov-manufacturelist .nov-manufactureslick' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;

        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        $el.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: false,
            arrows: false,
            autoplay: autoplay,
            infinite: true,
            speed: 300,
            boolean: true,
            autoplaySpeed: 3000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
            ]
        });
    });
    }
    
},{}],26:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov-productdeals .product_list' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        var self = $(this);
        if ($('body').hasClass('lang-rtl')) {
            rtl = true;
            self.attr('dir', 'rtl');
        } else {
            rtl = false;
        }
        var nav = self.data('arrows') ? $el.data('arrows') : false;
        var dots = self.data('dots') ? $el.data('dots') : false;
        var rows = self.data('rows') ? $el.data('rows') : 1;
        var autoplay = self.data('autoplay') ? $el.data('autoplay') : false;
        var items = self.data('xl') ? $el.data('xl') : 3;
        var items_tablet = self.data('md') ? $el.data('md') : 2;
        var items_mobile = self.data('xs') ? $el.data('xs') : 1;
        self.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: dots,
            arrows: nav,
            slidesPerRow:rows,
            autoplay: autoplay,
            infinite: false,
            speed: 300,
            autoplaySpeed: 3000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
            ]
        });
    });
    }
      
},{}],27:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
    var $el = $scoop.find( '.nov-testimonial .nov-testimonialslick' );
     if (!$el.length) {
             return;
     }
    $el.each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var autoplay = $el.data('autoplay');
        var autoplayTimeout = $el.data('autoplayTimeout');
        var nav = $el.data('arrows');
        var dots = $el.data('dots');
        var loop = $el.data('loop') ? $el.data('loop') : false;
        var items = $el.data('lg') ? $el.data('lg') : 2;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        var center = $el.data('center') ? $el.data('center') : false;
        var start = $el.data('start') ? $el.data('start') : 0;
        $el.slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-long-arrow-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: dots,
            arrows: nav,
            autoplay: autoplay,
            infinite: false,
            speed: 300,
            autoplaySpeed: 3000,
            slidesToShow: items,
            slidesToScroll: 1,
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
            ]
        });
    });
    }

},{}],28:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find('.slide-lookbook');
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false; 
       function t(e) {
           var t = e.item.index;
           $(".number-lookbook").removeClass("active"),
           $('.number-lookbook[data-position="' + t + '"]').addClass("active")
       }
       $el.owlCarousel({
           nav: !1,
           dots: !1,
           items: 1,
           margin: 0,
           stagePadding: 0,
           animateIn: "fadeInDown",
           lazyLoad: !0,
           rtl: rtl,
           mouseDrag: !0,
           touchDrag: !0,
           onDragged: t,
           responsive: {
               0: {
                   items: 1,
                   loop: !0,
                   margin: 10
               },
               576: {
                   items: 1,
                   loop: !1,
                   margin: 10
               },
               768: {
                   items: 1,
                   loop: !1
               }
           }
       }),
       $(".number-lookbook").click((function() {
           var e = $(this).data("position");
           $(".nov-content-lookbook .number-lookbook").removeClass("active"),
           $('.nov-content-lookbook .number-lookbook[data-position="' + e + '"]').addClass("active"),
           $(".slide-lookbook").trigger("to.owl.carousel", e)
       }
       ))
    }

   
},{}],29:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov_banner-product .banner-left' );
        var $al = $scoop.find( '.nov_banner-product .banner-right' );
        var $xl = $scoop.find( '.nov_banner-product .text-content' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        var self = $(this);
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;

        $el.slick({
            nextArrow: '<div class="slickNext"><i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-long-arrow-left" aria-hidden="true"></i></div>',
            dots: false,
            arrows: false,
            autoplay: autoplay,
            infinite: true,
            speed: 1500,
            fade: false,
            vertical: true,
            autoplaytimeout: 5000,
            slidesToShow: items,
            slidesToScroll: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
            asNavFor:".nov_banner-product .banner-right",
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
        });
        $al.slick({

            dots: false,
            arrows: false,
            autoplay: autoplay,
            infinite: true,
            speed: 1500,
            fade: false,
            vertical: true,
            autoplaySpeed: 5000,
            slidesToShow: items,
            slidesToScroll: 1,
            asNavFor:".nov_banner-product .banner-left",
        });
        $xl.slick({
            nextArrow: '<div class="slickNext"><i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-long-arrow-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: false,
            arrows: false,
            autoplay: autoplay,
            infinite: true,
            speed: 1500,
            fade: true,
            slidesToShow: items,
            slidesToScroll: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
            cssEase: 'linear',
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
        });
    });
    }

},{}],30:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.nov-product-trending .product_list' );
        var $al = $scoop.find( '.nov-product-trending-img' );
        if (!$el.length) {
                return;
        }
        $el.each(function (index) {
        var self = $(this);
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        self.on('init reInit afterChange', function(event, slick, currentSlide) {
            const items = $(this).data('lg');
            page = Math.ceil(((currentSlide || 0) + 1) / items),
            self.parents('.nov-product-trending').find('.current_nav').text(page);
        });
        $el.slick({
            nextArrow: '<div class="slickNext"><i class="zmdi zmdi-long-arrow-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickPrev"><i class="zmdi zmdi-long-arrow-left" aria-hidden="true"></i></div>',
            dots: false,
            arrows: false,
            slidesPerRow:rows,
            autoplay: autoplay,
            infinite: true,
            speed: 2000,
            fade: false,
            vertical: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
            asNavFor:".nov-product-trending-img",
            respondTo: elementorFrontend.isEditMode() ? 'min' : 'window',
        });
        $al.slick({
    
            dots: dots,
            arrows: dots,
            slidesPerRow:rows,
            autoplay: autoplay,
            infinite: true,
            speed: 2000,
            fade: false,
            vertical: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
            appendDots: $('.slick-slider-dots2'),
            asNavFor:".nov-product-trending .product_list",
    });
    });
    }

},{}],31:[function(require,module,exports){
    module.exports = function( $scoop, $ ) { 
    var $el = $scoop.find( '.nov_banner-slider .banner-slider-img' );
    $el.each(function (index) {  
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        var swiper = new Swiper('.banner-slider-img', {
        slidesPerView: items,
        spaceBetween: 30,
        grabCursor: true,
            breakpoints: {
              // when window width is >= 320px
              320: {
                slidesPerView: items_mobile,
                spaceBetween: 0,
              },
              // when window width is >= 480px
              480: {
                slidesPerView: items_mobile,
                spaceBetween: 10,
              },
              // when window width is >= 640px
              640: {
                slidesPerView: items_tablet,
                 spaceBetween: 10,
              },
              992: {
                slidesPerView: items_tablet,
              }
            },
        navigation: {
            nextEl: ".swiper-next",
            prevEl: ".swiper-prev",
        },
      });
      });
    }

},{}],32:[function(require,module,exports){
    module.exports = function( $scoop, $ ) {
        var $el = $scoop.find( '.swiper-container1' );
        var $ex = $scoop.find( '.swiper-container2' );
        $el.each(function (index) {
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        var swiper = new Swiper('.swiper-container1', {
            slidesPerView: "auto",
            spaceBetween: 10,
            grabCursor: true,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            scrollbar: {
              el: ".swiper-scrollbar",
              hide: true,
            },
            });
        });
        $ex.each(function (index) {
        var nav = $el.data('arrows') ? $el.data('arrows') : false;
        var dots = $el.data('dots') ? $el.data('dots') : false;
        var rows = $el.data('rows') ? $el.data('rows') : 1;
        var autoplay = $el.data('autoplay') ? $el.data('autoplay') : false;
        var items = $el.data('xl') ? $el.data('xl') : 3;
        var items_tablet = $el.data('md') ? $el.data('md') : 2;
        var items_mobile = $el.data('xs') ? $el.data('xs') : 1;
        var swiper = new Swiper('.swiper-container2', {
        slidesPerView: items,
        spaceBetween: 10,
        breakpoints: {
          // when window width is >= 320px
          320: {
            slidesPerView: items_mobile,
          },
          // when window width is >= 480px
          480: {
            slidesPerView: items_mobile,
          },
          // when window width is >= 640px
          767: {
            slidesPerView: items_tablet,
          },
          992: {
            slidesPerView: items,
          }
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        scrollbar: {
          el: ".swiper-scrollbar",
          hide: true,
        },
        });
        });
    }
   
},{}]},{},[2]);
