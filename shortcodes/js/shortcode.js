/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-mq-setclasses !*/
!function(e,n,t){function o(e,n){return typeof e===n}function a(){var e,n,t,a,s,i,r;for(var l in d)if(d.hasOwnProperty(l)){if(e=[],n=d[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(a=o(n.fn,"function")?n.fn():n.fn,s=0;s<e.length;s++)i=e[s],r=i.split("."),1===r.length?Modernizr[r[0]]=a:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=a),f.push((a?"":"no-")+r.join("-"))}}function s(e){var n=u.className,t=Modernizr._config.classPrefix||"";if(p&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),p?u.className.baseVal=n:u.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):p?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function r(){var e=n.body;return e||(e=i(p?"svg":"body"),e.fake=!0),e}function l(e,t,o,a){var s,l,f,d,c="modernizr",p=i("div"),m=r();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=a?a[o]:c+(o+1),p.appendChild(f);return s=i("style"),s.type="text/css",s.id="s"+c,(m.fake?m:p).appendChild(s),m.appendChild(p),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(n.createTextNode(e)),p.id=c,m.fake&&(m.style.background="",m.style.overflow="hidden",d=u.style.overflow,u.style.overflow="hidden",u.appendChild(m)),l=t(p,e),m.fake?(m.parentNode.removeChild(m),u.style.overflow=d,u.offsetHeight):p.parentNode.removeChild(p),!!l}var f=[],d=[],c={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){d.push({name:e,fn:n,options:t})},addAsyncTest:function(e){d.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=c,Modernizr=new Modernizr;var u=n.documentElement,p="svg"===u.nodeName.toLowerCase(),m=function(){var n=e.matchMedia||e.msMatchMedia;return n?function(e){var t=n(e);return t&&t.matches||!1}:function(n){var t=!1;return l("@media "+n+" { #modernizr { position: absolute; } }",function(n){t="absolute"==(e.getComputedStyle?e.getComputedStyle(n,null):n.currentStyle).position}),t}}();c.mq=m,a(),s(f),delete c.addTest,delete c.addAsyncTest;for(var h=0;h<Modernizr._q.length;h++)Modernizr._q[h]();e.Modernizr=Modernizr}(window,document);

/*!
Waypoints - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!function(){"use strict";function t(o){if(!o)throw new Error("No options passed to Waypoint constructor");if(!o.element)throw new Error("No element option passed to Waypoint constructor");if(!o.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+e,this.options=t.Adapter.extend({},t.defaults,o),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=o.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),i[this.key]=this,e+=1}var e=0,i={};t.prototype.queueTrigger=function(t){this.group.queueTrigger(this,t)},t.prototype.trigger=function(t){this.enabled&&this.callback&&this.callback.apply(this,t)},t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete i[this.key]},t.prototype.disable=function(){return this.enabled=!1,this},t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this},t.prototype.next=function(){return this.group.next(this)},t.prototype.previous=function(){return this.group.previous(this)},t.invokeAll=function(t){var e=[];for(var o in i)e.push(i[o]);for(var n=0,r=e.length;r>n;n++)e[n][t]()},t.destroyAll=function(){t.invokeAll("destroy")},t.disableAll=function(){t.invokeAll("disable")},t.enableAll=function(){t.Context.refreshAll();for(var e in i)i[e].enabled=!0;return this},t.refreshAll=function(){t.Context.refreshAll()},t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight},t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function t(t){window.setTimeout(t,1e3/60)}function e(t){this.element=t,this.Adapter=n.Adapter,this.adapter=new this.Adapter(t),this.key="waypoint-context-"+i,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},t.waypointContextKey=this.key,o[t.waypointContextKey]=this,i+=1,n.windowContext||(n.windowContext=!0,n.windowContext=new e(window)),this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}var i=0,o={},n=window.Waypoint,r=window.onload;e.prototype.add=function(t){var e=t.options.horizontal?"horizontal":"vertical";this.waypoints[e][t.key]=t,this.refresh()},e.prototype.checkEmpty=function(){var t=this.Adapter.isEmptyObject(this.waypoints.horizontal),e=this.Adapter.isEmptyObject(this.waypoints.vertical),i=this.element==this.element.window;t&&e&&!i&&(this.adapter.off(".waypoints"),delete o[this.key])},e.prototype.createThrottledResizeHandler=function(){function t(){e.handleResize(),e.didResize=!1}var e=this;this.adapter.on("resize.waypoints",function(){e.didResize||(e.didResize=!0,n.requestAnimationFrame(t))})},e.prototype.createThrottledScrollHandler=function(){function t(){e.handleScroll(),e.didScroll=!1}var e=this;this.adapter.on("scroll.waypoints",function(){(!e.didScroll||n.isTouch)&&(e.didScroll=!0,n.requestAnimationFrame(t))})},e.prototype.handleResize=function(){n.Context.refreshAll()},e.prototype.handleScroll=function(){var t={},e={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in e){var o=e[i],n=o.newScroll>o.oldScroll,r=n?o.forward:o.backward;for(var s in this.waypoints[i]){var a=this.waypoints[i][s];if(null!==a.triggerPoint){var l=o.oldScroll<a.triggerPoint,h=o.newScroll>=a.triggerPoint,p=l&&h,u=!l&&!h;(p||u)&&(a.queueTrigger(r),t[a.group.id]=a.group)}}}for(var c in t)t[c].flushTriggers();this.oldScroll={x:e.horizontal.newScroll,y:e.vertical.newScroll}},e.prototype.innerHeight=function(){return this.element==this.element.window?n.viewportHeight():this.adapter.innerHeight()},e.prototype.remove=function(t){delete this.waypoints[t.axis][t.key],this.checkEmpty()},e.prototype.innerWidth=function(){return this.element==this.element.window?n.viewportWidth():this.adapter.innerWidth()},e.prototype.destroy=function(){var t=[];for(var e in this.waypoints)for(var i in this.waypoints[e])t.push(this.waypoints[e][i]);for(var o=0,n=t.length;n>o;o++)t[o].destroy()},e.prototype.refresh=function(){var t,e=this.element==this.element.window,i=e?void 0:this.adapter.offset(),o={};this.handleScroll(),t={horizontal:{contextOffset:e?0:i.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:i.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};for(var r in t){var s=t[r];for(var a in this.waypoints[r]){var l,h,p,u,c,d=this.waypoints[r][a],f=d.options.offset,w=d.triggerPoint,y=0,g=null==w;d.element!==d.element.window&&(y=d.adapter.offset()[s.offsetProp]),"function"==typeof f?f=f.apply(d):"string"==typeof f&&(f=parseFloat(f),d.options.offset.indexOf("%")>-1&&(f=Math.ceil(s.contextDimension*f/100))),l=s.contextScroll-s.contextOffset,d.triggerPoint=Math.floor(y+l-f),h=w<s.oldScroll,p=d.triggerPoint>=s.oldScroll,u=h&&p,c=!h&&!p,!g&&u?(d.queueTrigger(s.backward),o[d.group.id]=d.group):!g&&c?(d.queueTrigger(s.forward),o[d.group.id]=d.group):g&&s.oldScroll>=d.triggerPoint&&(d.queueTrigger(s.forward),o[d.group.id]=d.group)}}return n.requestAnimationFrame(function(){for(var t in o)o[t].flushTriggers()}),this},e.findOrCreateByElement=function(t){return e.findByElement(t)||new e(t)},e.refreshAll=function(){for(var t in o)o[t].refresh()},e.findByElement=function(t){return o[t.waypointContextKey]},window.onload=function(){r&&r(),e.refreshAll()},n.requestAnimationFrame=function(e){var i=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||t;i.call(window,e)},n.Context=e}(),function(){"use strict";function t(t,e){return t.triggerPoint-e.triggerPoint}function e(t,e){return e.triggerPoint-t.triggerPoint}function i(t){this.name=t.name,this.axis=t.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),o[this.axis][this.name]=this}var o={vertical:{},horizontal:{}},n=window.Waypoint;i.prototype.add=function(t){this.waypoints.push(t)},i.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}},i.prototype.flushTriggers=function(){for(var i in this.triggerQueues){var o=this.triggerQueues[i],n="up"===i||"left"===i;o.sort(n?e:t);for(var r=0,s=o.length;s>r;r+=1){var a=o[r];(a.options.continuous||r===o.length-1)&&a.trigger([i])}}this.clearTriggerQueues()},i.prototype.next=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints),o=i===this.waypoints.length-1;return o?null:this.waypoints[i+1]},i.prototype.previous=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints);return i?this.waypoints[i-1]:null},i.prototype.queueTrigger=function(t,e){this.triggerQueues[e].push(t)},i.prototype.remove=function(t){var e=n.Adapter.inArray(t,this.waypoints);e>-1&&this.waypoints.splice(e,1)},i.prototype.first=function(){return this.waypoints[0]},i.prototype.last=function(){return this.waypoints[this.waypoints.length-1]},i.findOrCreate=function(t){return o[t.axis][t.name]||new i(t)},n.Group=i}(),function(){"use strict";function t(t){this.$element=e(t)}var e=window.jQuery,i=window.Waypoint;e.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,i){t.prototype[i]=function(){var t=Array.prototype.slice.call(arguments);return this.$element[i].apply(this.$element,t)}}),e.each(["extend","inArray","isEmptyObject"],function(i,o){t[o]=e[o]}),i.adapters.push({name:"jquery",Adapter:t}),i.Adapter=t}(),function(){"use strict";function t(t){return function(){var i=[],o=arguments[0];return (typeof arguments[0] === "function")&&(o=t.extend({},arguments[1]),o.handler=arguments[0]),this.each(function(){var n=t.extend({},o,{element:this});"string"==typeof n.context&&(n.context=t(this).closest(n.context)[0]),i.push(new e(n))}),i}}var e=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=t(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=t(window.Zepto))}();

// responsi scroller plugin to change css while scrolling
jQuery.fn.responsi_scroller = function( options ) {
    var settings = jQuery.extend({
    	type: 'opacity',
    	offset: 0,
    	end_offset: ''
    }, options );

	var divs = jQuery(this);

	divs.each(function() {
		var offset, height, end_offset;
		var current_element = this;

		jQuery(window).on('scroll', function() {
			offset = jQuery(current_element).offset().top;
			if(jQuery('body').hasClass('admin-bar')) {
				offset = jQuery(current_element).offset().top - jQuery('#wpadminbar').outerHeight();
			}
			if(settings.offset > 0) {
				offset = jQuery(current_element).offset().top - settings.offset;
			}
			height = jQuery(current_element).outerHeight();

			end_offset = offset + height;
			if(settings.end_offset) {
				end_offset = jQuery(settings.end_offset).offset().top;
			}

        	var st = jQuery(this).scrollTop();

			if(st >= offset && st <= end_offset) {
				var diff = end_offset - st;
				var diff_percentage = (diff / height) * 100;

				if(settings.type == 'opacity') {
					var opacity = (diff_percentage / 100) * 1;
					jQuery(current_element).css({
						'opacity': opacity
					});
				} else if(settings.type == 'blur') {
					var diff_percentage = 100 - diff_percentage;
					var blur = 'blur(' + ((diff_percentage / 100) * 50) + 'px)';
					jQuery(current_element).css({
						'-webkit-filter': blur,
						'-ms-filter': blur,
						'-o-filter': blur,
						'-moz-filter': blur,
						'filter': blur
					});
				} else if(settings.type == 'fading_blur') {
					var opacity = (diff_percentage / 100) * 1;
					var diff_percentage = 100 - diff_percentage;
					var blur = 'blur(' + ((diff_percentage / 100) * 50) + 'px)';
					jQuery(current_element).css({
						'-webkit-filter': blur,
						'-ms-filter': blur,
						'-o-filter': blur,
						'-moz-filter': blur,
						'filter': blur,
						'opacity': opacity
					});
				}
			}

			if( st < offset ) {
				if(settings.type == 'opacity') {
					jQuery(current_element).css({
						'opacity': 1
					});
				} else if(settings.type == 'blur') {
					blur = 'blur(0px)';
					jQuery(current_element).css({
						'-webkit-filter': blur,
						'-ms-filter': blur,
						'-o-filter': blur,
						'-moz-filter': blur,
						'filter': blur
					});
				} else if(settings.type == 'fading_blur') {
					blur = 'blur(0px)';
					jQuery(current_element).css({
						'opacity': 1,
						'-webkit-filter': blur,
						'-ms-filter': blur,
						'-o-filter': blur,
						'-moz-filter': blur,
						'filter': blur
					});
				}
			}
		});
	});
};

// max height for columns and content boxes
jQuery.fn.equalHeights = function( min_height, max_height ) {
	if( Modernizr.mq( 'only screen and (min-width: 800px)' ) || Modernizr.mq( 'only screen and (min-device-width: 768px) and (max-device-width: 1366px) and (orientation: portrait)' ) ) {
		var tallest = ( min_height ) ? min_height : 0;

		this.each(function() {
			jQuery( this ).css( 'min-height', '0' );
			jQuery( this ).css('height', 'auto' );

			if(jQuery( this ).outerHeight() > tallest) {
				tallest = jQuery( this ).outerHeight();
			}
		});

		if( ( max_height ) && tallest > max_height) {
			tallest = max_height;
		}
		return this.each(function() {
			jQuery( this ).css( 'min-height', tallest ).css( 'overflow', 'auto' );
		});
	} else {
		return this.each(function() {
			jQuery( this ).css( 'min-height', '' ).css( 'overflow', 'auto' );
		});
	}
};

(function( $ ) {

	jQuery('body').addClass('do-animate');

	jQuery(document).on('mouseover','.responsi-flip-box', function() {
		jQuery(this).addClass('hover');
	});

	jQuery(document).on('mouseout','.responsi-flip-box', function() {
		jQuery(this).removeClass('hover');
	});

	if(Modernizr.mq('only screen and (max-width: 800px)')) {
		 jQuery('.fullwidth-faded').each(function() {
		 	var bkgd_img = jQuery(this).css('background-image');
		 	jQuery(this).parent().css('background-image', bkgd_img);
		 	jQuery(this).remove();
		 });
	}
	// Fading and blur effect for new fade="" param on full width boxes
	jQuery('.fullwidth-faded').responsi_scroller({type: 'opacity'});
	jQuery( '.responsi-fullwidth.equal-height-columns' ).each( function() {
		jQuery( this ).find( '.responsi-column .responsi-column-wrapper' ).equalHeights();
	});

	// Waypoint
	jQuery.fn.init_waypoint = function() {
		if( jQuery().waypoint ) {
			// CSS Animations
			jQuery('.responsi-animated').waypoint( function() {

				jQuery(this.element).css('visibility', 'visible');

				// this code is executed for each appeared element
				var animation_type = jQuery(this.element).data('animationtype');
				var animation_duration = jQuery(this.element).data('animationduration');

				jQuery(this.element).addClass('animated-	'+animation_type);

				if(animation_duration) {
					jQuery(this.element).css('-moz-animation-duration', animation_duration+'s');
					jQuery(this.element).css('-webkit-animation-duration', animation_duration+'s');
					jQuery(this.element).css('-ms-animation-duration', animation_duration+'s');
					jQuery(this.element).css('-o-animation-duration', animation_duration+'s');
					jQuery(this.element).css('animation-duration', animation_duration+'s');
				}
			},{ triggerOnce: true, offset: 'bottom-in-view' });
		}
	}

	// Initialize Waypoint
	//jQuery.fn.waypoints( 'viewportHeight' );
	Waypoint.viewportHeight()
	setTimeout( function() {
		jQuery(window).init_waypoint();
	}, 300 );

	// set flip boxes equal front/back height
	jQuery.fn.responsi_calc_flip_boxes_height = function() {
		var flip_box = jQuery( this );
		var outer_height, height, top_margin = 0;

		flip_box.find( '.flip-box-front' ).css( 'min-height', '' );
		flip_box.find( '.flip-box-back' ).css( 'min-height', '' );
		flip_box.find( '.flip-box-front-inner' ).css( 'margin-top', '' );
		flip_box.find( '.flip-box-back-inner' ).css( 'margin-top', '' );
		flip_box.css( 'min-height', '' );

		setTimeout( function() {
			if( flip_box.find( '.flip-box-front' ).outerHeight() > flip_box.find( '.flip-box-back' ).outerHeight() ) {
				height = flip_box.find( '.flip-box-front' ).height();
				outer_height = flip_box.find( '.flip-box-front' ).outerHeight();
				top_margin = ( height - flip_box.find( '.flip-box-back-inner' ).outerHeight() ) / 2;

				flip_box.find( '.flip-box-back' ).css( 'min-height', outer_height );
				flip_box.css( 'min-height', outer_height );
				flip_box.find( '.flip-box-back-inner' ).css( 'margin-top', top_margin );
			} else {
				height = flip_box.find( '.flip-box-back' ).height();
				outer_height = flip_box.find( '.flip-box-back' ).outerHeight();
				top_margin = ( height - flip_box.find( '.flip-box-front-inner' ).outerHeight() ) / 2;

				flip_box.find( '.flip-box-front' ).css( 'min-height', outer_height );
				flip_box.css( 'min-height', outer_height );
				flip_box.find( '.flip-box-front-inner' ).css( 'margin-top', top_margin );
			}

		}, 100 );
	};
	// set flip boxes equal front/back height
	jQuery.fn.responsi_fix_unordered_height = function() {
		//jQuery( this ).find('.listicon').css('position','absolute');
		if(jQuery(this).find('.listicon').width() > 0 ){
			jQuery( this ).find('span.listcontent').not('.icon-fixed').css('padding-left',jQuery(this).find('.listicon').outerWidth(true)).css('min-height',jQuery(this).find('.listicon').outerHeight(true)).animate({ opacity: 1 }, 1000, function() {
				jQuery( this ).addClass('icon-fixed');
			});
		}
	};
	jQuery(window).on( 'load', function() { // start window_load_1
		jQuery( '.shortcode-unorderedlisticon ul li' ).each( function() {
			jQuery( this ).responsi_fix_unordered_height();
		});
		// Flip Boxes
		jQuery( '.flip-box-inner-wrapper' ).each( function() {
			jQuery( this ).responsi_calc_flip_boxes_height();
		});
	});

	// Initialize Bootstrap Tabs
	// Initialize vertical tabs content container height
	if( jQuery( '.vertical-tabs' ).length ) {
		jQuery( '.vertical-tabs .tab-content .tab-pane' ).each( function() {
			if( jQuery ( this ).parents( '.vertical-tabs' ).hasClass( 'clean' ) ) {
				jQuery ( this ).css( 'min-height', jQuery( '.vertical-tabs .nav-tabs' ).outerHeight() - 10 );
			} else {
				jQuery ( this ).css( 'min-height', jQuery( '.vertical-tabs .nav-tabs' ).outerHeight() );
			}
			if( jQuery ( this ).parents( '.vertical-tabs' ).find( '.nav-tabs' ).outerHeight() == jQuery ( this ).outerHeight() ){
				jQuery ( this ).addClass('vertical-tabs-square');
			}else{
				jQuery ( this ).removeClass('vertical-tabs-square');
			}
			jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find( '.responsi-column-wrapper' ).css('min-height','auto');
		});
	}

	jQuery('click.bs.collapse.data-api, [data-toggle=collapse]').each(function() {
	  	var parent = jQuery(this).attr('data-parent');
		if(jQuery(this).parents('.panel-group').length == 0) {
			var random = Math.floor((Math.random() * 10) + 1);
			var single_panel = jQuery(this).parents('.responsi-panel');
			jQuery(this).attr('data-parent', 'accordian-' + random);
			jQuery(single_panel).wrap('<div class="shortcode-accordian responsi-accordian responsi-single-accordian"><div class="panel-group" id="accordion-' + random + '"></div></div>');
		}
	});

	if(Modernizr.mq('only screen and (max-width: 800px)')) {
		jQuery('.tabs-vertical').addClass('tabs-horizontal').removeClass('tabs-vertical');
	}

	// Toggles
	jQuery( '.responsi-accordian .panel-title a' ).on( 'click', function () {
		var clicked_toggle = jQuery( this );
		var toggle_content_to_activate = jQuery( jQuery( this ).data( 'target' ) ).find( '.panel-body' );

		// To make premium sliders work in tabs
		jQuery(window).trigger('resize');

		if( clicked_toggle.hasClass( 'active' ) ) {
			clicked_toggle.parents( '.responsi-accordian ').find( '.panel-title a' ).removeClass( 'active' );
			jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find( '.responsi-column-wrapper' ).css('min-height','auto');
		} else {
			clicked_toggle.parents( '.responsi-accordian ').find( '.panel-title a' ).removeClass( 'active' );
			clicked_toggle.addClass( 'active' );
			jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find( '.responsi-column-wrapper' ).css('min-height','auto');
		}
	});


	//Fix Icon Shortcode in Tabs
	jQuery(window).on( 'transitionend', function() {
		setTimeout(function(){
			jQuery( '.tab-pane.active .shortcode-unorderedlisticon ul li' ).each( function() {
				jQuery( this ).responsi_fix_unordered_height();
			});
		}, 200);
		jQuery( '.panel-collapse .shortcode-unorderedlisticon ul li' ).each( function() {
			jQuery( this ).responsi_fix_unordered_height();
		});
	});
	
	jQuery( window ).on( 'resize lazyload', function() {

		jQuery( '.responsi-fullwidth.equal-height-columns' ).each( function() {
			jQuery( this ).find( '.responsi-layout-column .responsi-column-wrapper' ).equalHeights();
		});

		jQuery( '.flip-box-inner-wrapper' ).each( function() {
			jQuery( this ).responsi_calc_flip_boxes_height();
		});
		if( jQuery( '.vertical-tabs' ).length ) {
			jQuery( '.vertical-tabs .tab-content .tab-pane' ).css( 'min-height', jQuery( '.vertical-tabs .nav-tabs' ).outerHeight() );
			jQuery( '.vertical-tabs .tab-content .tab-pane' ).each( function() {
			if( jQuery ( this ).parents( '.vertical-tabs' ).find( '.nav-tabs' ).outerHeight() == jQuery ( this ).outerHeight() ){
					jQuery ( this ).addClass('vertical-tabs-square');
				}else{
					jQuery ( this ).removeClass('vertical-tabs-square');
				}
			});
		}
		if(Modernizr.mq('only screen and (max-width: 800px)')) {
			jQuery('.tabs-vertical').addClass('tabs-original-vertical');
			jQuery('.tabs-vertical').addClass('tabs-horizontal').removeClass('tabs-vertical');
		} else {
			jQuery('.tabs-original-vertical').removeClass('tabs-horizontal').addClass('tabs-vertical');
		}
	});

})(jQuery);