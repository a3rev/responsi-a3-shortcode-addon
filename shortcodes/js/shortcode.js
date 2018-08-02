/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */window.Modernizr=function(e,t,n){function A(e){f.cssText=e}function O(e,t){return A(p.join(e+";")+(t||""))}function M(e,t){return typeof e===t}function _(e,t){return!!~(""+e).indexOf(t)}function D(e,t){for(var r in e){var i=e[r];if(!_(i,"-")&&f[i]!==n)return t=="pfx"?i:!0}return!1}function P(e,t,r){for(var i in e){var s=t[e[i]];if(s!==n)return r===!1?e[i]:M(s,"function")?s.bind(r||t):s}return!1}function H(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),i=(e+" "+v.join(r+" ")+r).split(" ");if(M(t,"string")||M(t,"undefined"))return D(i,t);i=(e+" "+m.join(r+" ")+r).split(" ");return P(i,t,n)}function B(){i.input=function(n){for(var r=0,i=n.length;r<i;r++)w[n[r]]=n[r]in l;w.list&&(w.list=!!t.createElement("datalist")&&!!e.HTMLDataListElement);return w}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" "));i.inputtypes=function(e){for(var r=0,i,s,u,a=e.length;r<a;r++){l.setAttribute("type",s=e[r]);i=l.type!=="text";if(i){l.value=c;l.style.cssText="position:absolute;visibility:hidden;";if(/^range$/.test(s)&&l.style.WebkitAppearance!==n){o.appendChild(l);u=t.defaultView;i=u.getComputedStyle&&u.getComputedStyle(l,null).WebkitAppearance!=="textfield"&&l.offsetHeight!==0;o.removeChild(l)}else/^(search|tel)$/.test(s)||(/^(url|email)$/.test(s)?i=l.checkValidity&&l.checkValidity()===!1:i=l.value!=c)}b[e[r]]=!!i}return b}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var r="2.6.2",i={},s=!0,o=t.documentElement,u="modernizr",a=t.createElement(u),f=a.style,l=t.createElement("input"),c=":)",h={}.toString,p=" -webkit- -moz- -o- -ms- ".split(" "),d="Webkit Moz O ms",v=d.split(" "),m=d.toLowerCase().split(" "),g={svg:"http://www.w3.org/2000/svg"},y={},b={},w={},E=[],S=E.slice,x,T=function(e,n,r,i){var s,a,f,l,c=t.createElement("div"),h=t.body,p=h||t.createElement("body");if(parseInt(r,10))while(r--){f=t.createElement("div");f.id=i?i[r]:u+(r+1);c.appendChild(f)}s=["&#173;",'<style id="s',u,'">',e,"</style>"].join("");c.id=u;(h?c:p).innerHTML+=s;p.appendChild(c);if(!h){p.style.background="";p.style.overflow="hidden";l=o.style.overflow;o.style.overflow="hidden";o.appendChild(p)}a=n(c,e);if(!h){p.parentNode.removeChild(p);o.style.overflow=l}else c.parentNode.removeChild(c);return!!a},N=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t).matches;var r;T("@media "+t+" { #"+u+" { position: absolute; } }",function(t){r=(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle)["position"]=="absolute"});return r},C=function(){function r(r,i){i=i||t.createElement(e[r]||"div");r="on"+r;var s=r in i;if(!s){i.setAttribute||(i=t.createElement("div"));if(i.setAttribute&&i.removeAttribute){i.setAttribute(r,"");s=M(i[r],"function");M(i[r],"undefined")||(i[r]=n);i.removeAttribute(r)}}i=null;return s}var e={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return r}(),k={}.hasOwnProperty,L;!M(k,"undefined")&&!M(k.call,"undefined")?L=function(e,t){return k.call(e,t)}:L=function(e,t){return t in e&&M(e.constructor.prototype[t],"undefined")};Function.prototype.bind||(Function.prototype.bind=function(t){var n=this;if(typeof n!="function")throw new TypeError;var r=S.call(arguments,1),i=function(){if(this instanceof i){var e=function(){};e.prototype=n.prototype;var s=new e,o=n.apply(s,r.concat(S.call(arguments)));return Object(o)===o?o:s}return n.apply(t,r.concat(S.call(arguments)))};return i});y.flexbox=function(){return H("flexWrap")};y.canvas=function(){var e=t.createElement("canvas");return!!e.getContext&&!!e.getContext("2d")};y.canvastext=function(){return!!i.canvas&&!!M(t.createElement("canvas").getContext("2d").fillText,"function")};y.webgl=function(){return!!e.WebGLRenderingContext};y.touch=function(){var n;"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:T(["@media (",p.join("touch-enabled),("),u,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(e){n=e.offsetTop===9});return n};y.geolocation=function(){return"geolocation"in navigator};y.postmessage=function(){return!!e.postMessage};y.websqldatabase=function(){return!!e.openDatabase};y.indexedDB=function(){return!!H("indexedDB",e)};y.hashchange=function(){return C("hashchange",e)&&(t.documentMode===n||t.documentMode>7)};y.history=function(){return!!e.history&&!!history.pushState};y.draganddrop=function(){var e=t.createElement("div");return"draggable"in e||"ondragstart"in e&&"ondrop"in e};y.websockets=function(){return"WebSocket"in e||"MozWebSocket"in e};y.rgba=function(){A("background-color:rgba(150,255,150,.5)");return _(f.backgroundColor,"rgba")};y.hsla=function(){A("background-color:hsla(120,40%,100%,.5)");return _(f.backgroundColor,"rgba")||_(f.backgroundColor,"hsla")};y.multiplebgs=function(){A("background:url(https://),url(https://),red url(https://)");return/(url\s*\(.*?){3}/.test(f.background)};y.backgroundsize=function(){return H("backgroundSize")};y.borderimage=function(){return H("borderImage")};y.borderradius=function(){return H("borderRadius")};y.boxshadow=function(){return H("boxShadow")};y.textshadow=function(){return t.createElement("div").style.textShadow===""};y.opacity=function(){O("opacity:.55");return/^0.55$/.test(f.opacity)};y.cssanimations=function(){return H("animationName")};y.csscolumns=function(){return H("columnCount")};y.cssgradients=function(){var e="background-image:",t="gradient(linear,left top,right bottom,from(#9f9),to(white));",n="linear-gradient(left top,#9f9, white);";A((e+"-webkit- ".split(" ").join(t+e)+p.join(n+e)).slice(0,-e.length));return _(f.backgroundImage,"gradient")};y.cssreflections=function(){return H("boxReflect")};y.csstransforms=function(){return!!H("transform")};y.csstransforms3d=function(){var e=!!H("perspective");e&&"webkitPerspective"in o.style&&T("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(t,n){e=t.offsetLeft===9&&t.offsetHeight===3});return e};y.csstransitions=function(){return H("transition")};y.fontface=function(){var e;T('@font-face {font-family:"font";src:url("https://")}',function(n,r){var i=t.getElementById("smodernizr"),s=i.sheet||i.styleSheet,o=s?s.cssRules&&s.cssRules[0]?s.cssRules[0].cssText:s.cssText||"":"";e=/src/i.test(o)&&o.indexOf(r.split(" ")[0])===0});return e};y.generatedcontent=function(){var e;T(["#",u,"{font:0/0 a}#",u,':after{content:"',c,'";visibility:hidden;font:3px/1 a}'].join(""),function(t){e=t.offsetHeight>=3});return e};y.video=function(){var e=t.createElement("video"),n=!1;try{if(n=!!e.canPlayType){n=new Boolean(n);n.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,"");n.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,"");n.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}}catch(r){}return n};y.audio=function(){var e=t.createElement("audio"),n=!1;try{if(n=!!e.canPlayType){n=new Boolean(n);n.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,"");n.mp3=e.canPlayType("audio/mpeg;").replace(/^no$/,"");n.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,"");n.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,"")}}catch(r){}return n};y.localstorage=function(){try{localStorage.setItem(u,u);localStorage.removeItem(u);return!0}catch(e){return!1}};y.sessionstorage=function(){try{sessionStorage.setItem(u,u);sessionStorage.removeItem(u);return!0}catch(e){return!1}};y.webworkers=function(){return!!e.Worker};y.applicationcache=function(){return!!e.applicationCache};y.svg=function(){return!!t.createElementNS&&!!t.createElementNS(g.svg,"svg").createSVGRect};y.inlinesvg=function(){var e=t.createElement("div");e.innerHTML="<svg/>";return(e.firstChild&&e.firstChild.namespaceURI)==g.svg};y.smil=function(){return!!t.createElementNS&&/SVGAnimate/.test(h.call(t.createElementNS(g.svg,"animate")))};y.svgclippaths=function(){return!!t.createElementNS&&/SVGClipPath/.test(h.call(t.createElementNS(g.svg,"clipPath")))};for(var j in y)if(L(y,j)){x=j.toLowerCase();i[x]=y[j]();E.push((i[x]?"":"no-")+x)}i.input||B();i.addTest=function(e,t){if(typeof e=="object")for(var r in e)L(e,r)&&i.addTest(r,e[r]);else{e=e.toLowerCase();if(i[e]!==n)return i;t=typeof t=="function"?t():t;typeof s!="undefined"&&s&&(o.className+=" "+(t?"":"no-")+e);i[e]=t}return i};A("");a=l=null;i._version=r;i._prefixes=p;i._domPrefixes=m;i._cssomPrefixes=v;i.mq=N;i.hasEvent=C;i.testProp=function(e){return D([e])};i.testAllProps=H;i.testStyles=T;i.prefixed=function(e,t,n){return t?H(e,t,n):H(e,"pfx")};o.className=o.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(s?" js "+E.join(" "):"");return i}(this,this.document);(function(e,t,n){function r(e){return"[object Function]"==d.call(e)}function i(e){return"string"==typeof e}function s(){}function o(e){return!e||"loaded"==e||"complete"==e||"uninitialized"==e}function u(){var e=v.shift();m=1,e?e.t?h(function(){("c"==e.t?k.injectCss:k.injectJs)(e.s,0,e.a,e.x,e.e,1)},0):(e(),u()):m=0}function a(e,n,r,i,s,a,f){function l(t){if(!d&&o(c.readyState)&&(w.r=d=1,!m&&u(),c.onload=c.onreadystatechange=null,t)){"img"!=e&&h(function(){b.removeChild(c)},50);for(var r in T[n])T[n].hasOwnProperty(r)&&T[n][r].onload()}}var f=f||k.errorTimeout,c=t.createElement(e),d=0,g=0,w={t:r,s:n,e:s,a:a,x:f};1===T[n]&&(g=1,T[n]=[]),"object"==e?c.data=n:(c.src=n,c.type=e),c.width=c.height="0",c.onerror=c.onload=c.onreadystatechange=function(){l.call(this,g)},v.splice(i,0,w),"img"!=e&&(g||2===T[n]?(b.insertBefore(c,y?null:p),h(l,f)):T[n].push(c))}function f(e,t,n,r,s){return m=0,t=t||"j",i(e)?a("c"==t?E:w,e,t,this.i++,n,r,s):(v.splice(this.i++,0,e),1==v.length&&u()),this}function l(){var e=k;return e.loader={load:f,i:0},e}var c=t.documentElement,h=e.setTimeout,p=t.getElementsByTagName("script")[0],d={}.toString,v=[],m=0,g="MozAppearance"in c.style,y=g&&!!t.createRange().compareNode,b=y?c:p.parentNode,c=e.opera&&"[object Opera]"==d.call(e.opera),c=!!t.attachEvent&&!c,w=g?"object":c?"script":"img",E=c?"script":w,S=Array.isArray||function(e){return"[object Array]"==d.call(e)},x=[],T={},N={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}},C,k;k=function(e){function t(e){var e=e.split("!"),t=x.length,n=e.pop(),r=e.length,n={url:n,origUrl:n,prefixes:e},i,s,o;for(s=0;s<r;s++)o=e[s].split("="),(i=N[o.shift()])&&(n=i(n,o));for(s=0;s<t;s++)n=x[s](n);return n}function o(e,i,s,o,u){var a=t(e),f=a.autoCallback;a.url.split(".").pop().split("?").shift(),a.bypass||(i&&(i=r(i)?i:i[e]||i[o]||i[e.split("/").pop().split("?")[0]]),a.instead?a.instead(e,i,s,o,u):(T[a.url]?a.noexec=!0:T[a.url]=1,s.load(a.url,a.forceCSS||!a.forceJS&&"css"==a.url.split(".").pop().split("?").shift()?"c":n,a.noexec,a.attrs,a.timeout),(r(i)||r(f))&&s.load(function(){l(),i&&i(a.origUrl,u,o),f&&f(a.origUrl,u,o),T[a.url]=2})))}function u(e,t){function n(e,n){if(e){if(i(e))n||(f=function(){var e=[].slice.call(arguments);l.apply(this,e),c()}),o(e,f,t,0,u);else if(Object(e)===e)for(p in h=function(){var t=0,n;for(n in e)e.hasOwnProperty(n)&&t++;return t}(),e)e.hasOwnProperty(p)&&(!n&&!--h&&(r(f)?f=function(){var e=[].slice.call(arguments);l.apply(this,e),c()}:f[p]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),c()}}(l[p])),o(e[p],f,t,p,u))}else!n&&c()}var u=!!e.test,a=e.load||e.both,f=e.callback||s,l=f,c=e.complete||s,h,p;n(u?e.yep:e.nope,!!a),a&&n(a)}var a,f,c=this.yepnope.loader;if(i(e))o(e,0,c,0);else if(S(e))for(a=0;a<e.length;a++)f=e[a],i(f)?o(f,0,c,0):S(f)?k(f):Object(f)===f&&u(f,c);else Object(e)===e&&u(e,c)},k.addPrefix=function(e,t){N[e]=t},k.addFilter=function(e){x.push(e)},k.errorTimeout=1e4,null==t.readyState&&t.addEventListener&&(t.readyState="loading",t.addEventListener("DOMContentLoaded",C=function(){t.removeEventListener("DOMContentLoaded",C,0),t.readyState="complete"},0)),e.yepnope=l(),e.yepnope.executeStack=u,e.yepnope.injectJs=function(e,n,r,i,a,f){var l=t.createElement("script"),c,d,i=i||k.errorTimeout;l.src=e;for(d in r)l.setAttribute(d,r[d]);n=f?u:n||s,l.onreadystatechange=l.onload=function(){!c&&o(l.readyState)&&(c=1,n(),l.onload=l.onreadystatechange=null)},h(function(){c||(c=1,n(1))},i),a?l.onload():p.parentNode.insertBefore(l,p)},e.yepnope.injectCss=function(e,n,r,i,o,a){var i=t.createElement("link"),f,n=a?u:n||s;i.href=e,i.rel="stylesheet",i.type="text/css";for(f in r)i.setAttribute(f,r[f]);o||(p.parentNode.insertBefore(i,p),h(n,0))}})(this,document);Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
var cssua=function(n,l,p){var q=/\s*([\-\w ]+)[\s\/\:]([\d_]+\b(?:[\-\._\/]\w+)*)/,r=/([\w\-\.]+[\s\/][v]?[\d_]+\b(?:[\-\._\/]\w+)*)/g,s=/\b(?:(blackberry\w*|bb10)|(rim tablet os))(?:\/(\d+\.\d+(?:\.\w+)*))?/,t=/\bsilk-accelerated=true\b/,u=/\bfluidapp\b/,v=/(\bwindows\b|\bmacintosh\b|\blinux\b|\bunix\b)/,w=/(\bandroid\b|\bipad\b|\bipod\b|\bwindows phone\b|\bwpdesktop\b|\bxblwp7\b|\bzunewp7\b|\bwindows ce\b|\bblackberry\w*|\bbb10\b|\brim tablet os\b|\bmeego|\bwebos\b|\bpalm|\bsymbian|\bj2me\b|\bdocomo\b|\bpda\b|\bchtml\b|\bmidp\b|\bcldc\b|\w*?mobile\w*?|\w*?phone\w*?)/,
x=/(\bxbox\b|\bplaystation\b|\bnintendo\s+\w+)/,k={parse:function(b,d){var a={};d&&(a.standalone=d);b=(""+b).toLowerCase();if(!b)return a;for(var c,e,g=b.split(/[()]/),f=0,k=g.length;f<k;f++)if(f%2){var m=g[f].split(";");c=0;for(e=m.length;c<e;c++)if(q.exec(m[c])){var h=RegExp.$1.split(" ").join("_"),l=RegExp.$2;if(!a[h]||parseFloat(a[h])<parseFloat(l))a[h]=l}}else if(m=g[f].match(r))for(c=0,e=m.length;c<e;c++)h=m[c].split(/[\/\s]+/),h.length&&"mozilla"!==h[0]&&(a[h[0].split(" ").join("_")]=h.slice(1).join("-"));
w.exec(b)?(a.mobile=RegExp.$1,s.exec(b)&&(delete a[a.mobile],a.blackberry=a.version||RegExp.$3||RegExp.$2||RegExp.$1,RegExp.$1?a.mobile="blackberry":"0.0.1"===a.version&&(a.blackberry="7.1.0.0"))):v.exec(b)?a.desktop=RegExp.$1:x.exec(b)&&(a.game=RegExp.$1,c=a.game.split(" ").join("_"),a.version&&!a[c]&&(a[c]=a.version));a.intel_mac_os_x?(a.mac_os_x=a.intel_mac_os_x.split("_").join("."),delete a.intel_mac_os_x):a.cpu_iphone_os?(a.ios=a.cpu_iphone_os.split("_").join("."),delete a.cpu_iphone_os):a.cpu_os?
(a.ios=a.cpu_os.split("_").join("."),delete a.cpu_os):"iphone"!==a.mobile||a.ios||(a.ios="1");a.opera&&a.version?(a.opera=a.version,delete a.blackberry):t.exec(b)?a.silk_accelerated=!0:u.exec(b)&&(a.fluidapp=a.version);if(a.applewebkit)a.webkit=a.applewebkit,delete a.applewebkit,a.opr&&(a.opera=a.opr,delete a.opr,delete a.chrome),a.safari&&(a.chrome||a.crios||a.opera||a.silk||a.fluidapp||a.phantomjs||a.mobile&&!a.ios?delete a.safari:a.safari=a.version&&!a.rim_tablet_os?a.version:{419:"2.0.4",417:"2.0.3",
416:"2.0.2",412:"2.0",312:"1.3",125:"1.2",85:"1.0"}[parseInt(a.safari,10)]||a.safari);else if(a.msie||a.trident)if(a.opera||(a.ie=a.msie||a.rv),delete a.msie,a.windows_phone_os)a.windows_phone=a.windows_phone_os,delete a.windows_phone_os;else{if("wpdesktop"===a.mobile||"xblwp7"===a.mobile||"zunewp7"===a.mobile)a.mobile="windows desktop",a.windows_phone=9>+a.ie?"7.0":10>+a.ie?"7.5":"8.0",delete a.windows_nt}else if(a.gecko||a.firefox)a.gecko=a.rv;a.rv&&delete a.rv;a.version&&delete a.version;return a},
format:function(b){var d="",a;for(a in b)if(a&&b.hasOwnProperty(a)){var c=a,e=b[a],c=c.split(".").join("-"),g=" ua-"+c;if("string"===typeof e){for(var e=e.split(" ").join("_").split(".").join("-"),f=e.indexOf("-");0<f;)g+=" ua-"+c+"-"+e.substring(0,f),f=e.indexOf("-",f+1);g+=" ua-"+c+"-"+e}d+=g}return d},encode:function(b){var d="",a;for(a in b)a&&b.hasOwnProperty(a)&&(d&&(d+="\x26"),d+=encodeURIComponent(a)+"\x3d"+encodeURIComponent(b[a]));return d}};k.userAgent=k.ua=k.parse(l,p);l=k.format(k.ua)+
" js";n.className=n.className?n.className.replace(/\bno-js\b/g,"")+l:l.substr(1);return k}(document.documentElement,navigator.userAgent,navigator.standalone);


// Generated by CoffeeScript 1.6.2
/*
jQuery Waypoints - v2.0.3
Copyright (c) 2011-2013 Caleb Troughton
Dual licensed under the MIT license and GPL license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function() {
  var __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; },
	__slice = [].slice;

  (function(root, factory) {
	if (typeof define === 'function' && define.amd) {
	  return define('waypoints', ['jquery'], function($) {
		return factory($, root);
	  });
	} else {
	  return factory(root.jQuery, root);
	}
  })(this, function($, window) {
	var $w, Context, Waypoint, allWaypoints, contextCounter, contextKey, contexts, isTouch, jQMethods, methods, resizeEvent, scrollEvent, waypointCounter, waypointKey, wp, wps;

	$w = $(window);
	isTouch = __indexOf.call(window, 'ontouchstart') >= 0;
	allWaypoints = {
	  horizontal: {},
	  vertical: {}
	};
	contextCounter = 1;
	contexts = {};
	contextKey = 'waypoints-context-id';
	resizeEvent = 'resize.waypoints';
	scrollEvent = 'scroll.waypoints';
	waypointCounter = 1;
	waypointKey = 'waypoints-waypoint-ids';
	wp = 'waypoint';
	wps = 'waypoints';
	Context = (function() {
	  function Context($element) {
		var _this = this;

		this.$element = $element;
		this.element = $element[0];
		this.didResize = false;
		this.didScroll = false;
		this.id = 'context' + contextCounter++;
		this.oldScroll = {
		  x: $element.scrollLeft(),
		  y: $element.scrollTop()
		};
		this.waypoints = {
		  horizontal: {},
		  vertical: {}
		};
		$element.data(contextKey, this.id);
		contexts[this.id] = this;
		$element.bind(scrollEvent, function() {
		  var scrollHandler;

		  if (!(_this.didScroll || isTouch)) {
			_this.didScroll = true;
			scrollHandler = function() {
			  _this.doScroll();
			  return _this.didScroll = false;
			};
			return window.setTimeout(scrollHandler, $[wps].settings.scrollThrottle);
		  }
		});
		$element.bind(resizeEvent, function() {
		  var resizeHandler;

		  if (!_this.didResize) {
			_this.didResize = true;
			resizeHandler = function() {
			  $[wps]('refresh');
			  return _this.didResize = false;
			};
			return window.setTimeout(resizeHandler, $[wps].settings.resizeThrottle);
		  }
		});
	  }

	  Context.prototype.doScroll = function() {
		var axes,
		  _this = this;

		axes = {
		  horizontal: {
			newScroll: this.$element.scrollLeft(),
			oldScroll: this.oldScroll.x,
			forward: 'right',
			backward: 'left'
		  },
		  vertical: {
			newScroll: this.$element.scrollTop(),
			oldScroll: this.oldScroll.y,
			forward: 'down',
			backward: 'up'
		  }
		};
		if (isTouch && (!axes.vertical.oldScroll || !axes.vertical.newScroll)) {
		  $[wps]('refresh');
		}
		$.each(axes, function(aKey, axis) {
		  var direction, isForward, triggered;

		  triggered = [];
		  isForward = axis.newScroll > axis.oldScroll;
		  direction = isForward ? axis.forward : axis.backward;
		  $.each(_this.waypoints[aKey], function(wKey, waypoint) {
			var _ref, _ref1;

			if ((axis.oldScroll < (_ref = waypoint.offset) && _ref <= axis.newScroll)) {
			  return triggered.push(waypoint);
			} else if ((axis.newScroll < (_ref1 = waypoint.offset) && _ref1 <= axis.oldScroll)) {
			  return triggered.push(waypoint);
			}
		  });
		  triggered.sort(function(a, b) {
			return a.offset - b.offset;
		  });
		  if (!isForward) {
			triggered.reverse();
		  }
		  return $.each(triggered, function(i, waypoint) {
			if (waypoint.options.continuous || i === triggered.length - 1) {
			  return waypoint.trigger([direction]);
			}
		  });
		});
		return this.oldScroll = {
		  x: axes.horizontal.newScroll,
		  y: axes.vertical.newScroll
		};
	  };

	  Context.prototype.refresh = function() {
		var axes, cOffset, isWin,
		  _this = this;

		isWin = $.isWindow(this.element);
		cOffset = this.$element.offset();
		this.doScroll();
		axes = {
		  horizontal: {
			contextOffset: isWin ? 0 : cOffset.left,
			contextScroll: isWin ? 0 : this.oldScroll.x,
			contextDimension: this.$element.width(),
			oldScroll: this.oldScroll.x,
			forward: 'right',
			backward: 'left',
			offsetProp: 'left'
		  },
		  vertical: {
			contextOffset: isWin ? 0 : cOffset.top,
			contextScroll: isWin ? 0 : this.oldScroll.y,
			contextDimension: isWin ? $[wps]('viewportHeight') : this.$element.height(),
			oldScroll: this.oldScroll.y,
			forward: 'down',
			backward: 'up',
			offsetProp: 'top'
		  }
		};
		return $.each(axes, function(aKey, axis) {
		  return $.each(_this.waypoints[aKey], function(i, waypoint) {
			var adjustment, elementOffset, oldOffset, _ref, _ref1;

			adjustment = waypoint.options.offset;
			oldOffset = waypoint.offset;
			elementOffset = $.isWindow(waypoint.element) ? 0 : waypoint.$element.offset()[axis.offsetProp];
			if ($.isFunction(adjustment)) {
			  adjustment = adjustment.apply(waypoint.element);
			} else if (typeof adjustment === 'string') {
			  adjustment = parseFloat(adjustment);
			  if (waypoint.options.offset.indexOf('%') > -1) {
				adjustment = Math.ceil(axis.contextDimension * adjustment / 100);
			  }
			}
			waypoint.offset = elementOffset - axis.contextOffset + axis.contextScroll - adjustment;
			if ((waypoint.options.onlyOnScroll && (oldOffset != null)) || !waypoint.enabled) {
			  return;
			}
			if (oldOffset !== null && (oldOffset < (_ref = axis.oldScroll) && _ref <= waypoint.offset)) {
			  return waypoint.trigger([axis.backward]);
			} else if (oldOffset !== null && (oldOffset > (_ref1 = axis.oldScroll) && _ref1 >= waypoint.offset)) {
			  return waypoint.trigger([axis.forward]);
			} else if (oldOffset === null && axis.oldScroll >= waypoint.offset) {
			  return waypoint.trigger([axis.forward]);
			}
		  });
		});
	  };

	  Context.prototype.checkEmpty = function() {
		if ($.isEmptyObject(this.waypoints.horizontal) && $.isEmptyObject(this.waypoints.vertical)) {
		  this.$element.unbind([resizeEvent, scrollEvent].join(' '));
		  return delete contexts[this.id];
		}
	  };

	  return Context;

	})();
	Waypoint = (function() {
	  function Waypoint($element, context, options) {
		var idList, _ref;

		options = $.extend({}, $.fn[wp].defaults, options);
		if (options.offset === 'bottom-in-view') {
		  options.offset = function() {
			var contextHeight;

			contextHeight = $[wps]('viewportHeight');
			if (!$.isWindow(context.element)) {
			  contextHeight = context.$element.height();
			}
			return contextHeight - $(this).outerHeight();
		  };
		}
		this.$element = $element;
		this.element = $element[0];
		this.axis = options.horizontal ? 'horizontal' : 'vertical';
		this.callback = options.handler;
		this.context = context;
		this.enabled = options.enabled;
		this.id = 'waypoints' + waypointCounter++;
		this.offset = null;
		this.options = options;
		context.waypoints[this.axis][this.id] = this;
		allWaypoints[this.axis][this.id] = this;
		idList = (_ref = $element.data(waypointKey)) != null ? _ref : [];
		idList.push(this.id);
		$element.data(waypointKey, idList);
	  }

	  Waypoint.prototype.trigger = function(args) {
		if (!this.enabled) {
		  return;
		}
		if (this.callback != null) {
		  this.callback.apply(this.element, args);
		}
		if (this.options.triggerOnce) {
		  return this.destroy();
		}
	  };

	  Waypoint.prototype.disable = function() {
		return this.enabled = false;
	  };

	  Waypoint.prototype.enable = function() {
		this.context.refresh();
		return this.enabled = true;
	  };

	  Waypoint.prototype.destroy = function() {
		delete allWaypoints[this.axis][this.id];
		delete this.context.waypoints[this.axis][this.id];
		return this.context.checkEmpty();
	  };

	  Waypoint.getWaypointsByElement = function(element) {
		var all, ids;

		ids = $(element).data(waypointKey);
		if (!ids) {
		  return [];
		}
		all = $.extend({}, allWaypoints.horizontal, allWaypoints.vertical);
		return $.map(ids, function(id) {
		  return all[id];
		});
	  };

	  return Waypoint;

	})();
	methods = {
	  init: function(f, options) {
		var _ref;

		if (options == null) {
		  options = {};
		}
		if ((_ref = options.handler) == null) {
		  options.handler = f;
		}
		this.each(function() {
		  var $this, context, contextElement, _ref1;

		  $this = $(this);
		  contextElement = (_ref1 = options.context) != null ? _ref1 : $.fn[wp].defaults.context;
		  if (!$.isWindow(contextElement)) {
			contextElement = $this.closest(contextElement);
		  }
		  contextElement = $(contextElement);
		  context = contexts[contextElement.data(contextKey)];
		  if (!context) {
			context = new Context(contextElement);
		  }
		  return new Waypoint($this, context, options);
		});
		$[wps]('refresh');
		return this;
	  },
	  disable: function() {
		return methods._invoke(this, 'disable');
	  },
	  enable: function() {
		return methods._invoke(this, 'enable');
	  },
	  destroy: function() {
		return methods._invoke(this, 'destroy');
	  },
	  prev: function(axis, selector) {
		return methods._traverse.call(this, axis, selector, function(stack, index, waypoints) {
		  if (index > 0) {
			return stack.push(waypoints[index - 1]);
		  }
		});
	  },
	  next: function(axis, selector) {
		return methods._traverse.call(this, axis, selector, function(stack, index, waypoints) {
		  if (index < waypoints.length - 1) {
			return stack.push(waypoints[index + 1]);
		  }
		});
	  },
	  _traverse: function(axis, selector, push) {
		var stack, waypoints;

		if (axis == null) {
		  axis = 'vertical';
		}
		if (selector == null) {
		  selector = window;
		}
		waypoints = jQMethods.aggregate(selector);
		stack = [];
		this.each(function() {
		  var index;

		  index = $.inArray(this, waypoints[axis]);
		  return push(stack, index, waypoints[axis]);
		});
		return this.pushStack(stack);
	  },
	  _invoke: function($elements, method) {
		$elements.each(function() {
		  var waypoints;

		  waypoints = Waypoint.getWaypointsByElement(this);
		  return $.each(waypoints, function(i, waypoint) {
			waypoint[method]();
			return true;
		  });
		});
		return this;
	  }
	};
	$.fn[wp] = function() {
	  var args, method;

	  method = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
	  if (methods[method]) {
		return methods[method].apply(this, args);
	  } else if ($.isFunction(method)) {
		return methods.init.apply(this, arguments);
	  } else if ($.isPlainObject(method)) {
		return methods.init.apply(this, [null, method]);
	  } else if (!method) {
		return $.error("jQuery Waypoints needs a callback function or handler option.");
	  } else {
		return $.error("The " + method + " method does not exist in jQuery Waypoints.");
	  }
	};
	$.fn[wp].defaults = {
	  context: window,
	  continuous: true,
	  enabled: true,
	  horizontal: false,
	  offset: 0,
	  triggerOnce: false
	};
	jQMethods = {
	  refresh: function() {
		return $.each(contexts, function(i, context) {
		  return context.refresh();
		});
	  },
	  viewportHeight: function() {
		var _ref;

		return (_ref = window.innerHeight) != null ? _ref : $w.height();
	  },
	  aggregate: function(contextSelector) {
		var collection, waypoints, _ref;

		collection = allWaypoints;
		if (contextSelector) {
		  collection = (_ref = contexts[$(contextSelector).data(contextKey)]) != null ? _ref.waypoints : void 0;
		}
		if (!collection) {
		  return [];
		}
		waypoints = {
		  horizontal: [],
		  vertical: []
		};
		$.each(waypoints, function(axis, arr) {
		  $.each(collection[axis], function(key, waypoint) {
			return arr.push(waypoint);
		  });
		  arr.sort(function(a, b) {
			return a.offset - b.offset;
		  });
		  waypoints[axis] = $.map(arr, function(waypoint) {
			return waypoint.element;
		  });
		  return waypoints[axis] = $.unique(waypoints[axis]);
		});
		return waypoints;
	  },
	  above: function(contextSelector) {
		if (contextSelector == null) {
		  contextSelector = window;
		}
		return jQMethods._filter(contextSelector, 'vertical', function(context, waypoint) {
		  return waypoint.offset <= context.oldScroll.y;
		});
	  },
	  below: function(contextSelector) {
		if (contextSelector == null) {
		  contextSelector = window;
		}
		return jQMethods._filter(contextSelector, 'vertical', function(context, waypoint) {
		  return waypoint.offset > context.oldScroll.y;
		});
	  },
	  left: function(contextSelector) {
		if (contextSelector == null) {
		  contextSelector = window;
		}
		return jQMethods._filter(contextSelector, 'horizontal', function(context, waypoint) {
		  return waypoint.offset <= context.oldScroll.x;
		});
	  },
	  right: function(contextSelector) {
		if (contextSelector == null) {
		  contextSelector = window;
		}
		return jQMethods._filter(contextSelector, 'horizontal', function(context, waypoint) {
		  return waypoint.offset > context.oldScroll.x;
		});
	  },
	  enable: function() {
		return jQMethods._invoke('enable');
	  },
	  disable: function() {
		return jQMethods._invoke('disable');
	  },
	  destroy: function() {
		return jQMethods._invoke('destroy');
	  },
	  extendFn: function(methodName, f) {
		return methods[methodName] = f;
	  },
	  _invoke: function(method) {
		var waypoints;

		waypoints = $.extend({}, allWaypoints.vertical, allWaypoints.horizontal);
		return $.each(waypoints, function(key, waypoint) {
		  waypoint[method]();
		  return true;
		});
	  },
	  _filter: function(selector, axis, test) {
		var context, waypoints;

		context = contexts[$(selector).data(contextKey)];
		if (!context) {
		  return [];
		}
		waypoints = [];
		$.each(context.waypoints[axis], function(i, waypoint) {
		  if (test(context, waypoint)) {
			return waypoints.push(waypoint);
		  }
		});
		waypoints.sort(function(a, b) {
		  return a.offset - b.offset;
		});
		return $.map(waypoints, function(waypoint) {
		  return waypoint.element;
		});
	  }
	};
	$[wps] = function() {
	  var args, method;

	  method = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
	  if (jQMethods[method]) {
		return jQMethods[method].apply(null, args);
	  } else {
		return jQMethods.aggregate.call(null, method);
	  }
	};
	$[wps].settings = {
	  resizeThrottle: 100,
	  scrollThrottle: 30
	};
	return $w.on( 'load', function() {
	  return $[wps]('refresh');
	});
  });

}).call(this);

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
			jQuery('.responsi-animated').waypoint(function() {
				jQuery(this).css('visibility', 'visible');

				// this code is executed for each appeared element
				var animation_type = jQuery(this).data('animationtype');
				var animation_duration = jQuery(this).data('animationduration');

				jQuery(this).addClass('animated-	'+animation_type);

				if(animation_duration) {
					jQuery(this).css('-moz-animation-duration', animation_duration+'s');
					jQuery(this).css('-webkit-animation-duration', animation_duration+'s');
					jQuery(this).css('-ms-animation-duration', animation_duration+'s');
					jQuery(this).css('-o-animation-duration', animation_duration+'s');
					jQuery(this).css('animation-duration', animation_duration+'s');
				}
			},{ triggerOnce: true, offset: 'bottom-in-view' });
		}
	}

	// Initialize Waypoint
	jQuery.waypoints( 'viewportHeight' );
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
				if( cssua.ua.ie && cssua.ua.ie.substr(0, 1) == '8' ) {
					outer_height = flip_box.find( '.flip-box-front' ).height();
				} else {
					outer_height = flip_box.find( '.flip-box-front' ).outerHeight();
				}
				top_margin = ( height - flip_box.find( '.flip-box-back-inner' ).outerHeight() ) / 2;

				flip_box.find( '.flip-box-back' ).css( 'min-height', outer_height );
				flip_box.css( 'min-height', outer_height );
				flip_box.find( '.flip-box-back-inner' ).css( 'margin-top', top_margin );
			} else {
				height = flip_box.find( '.flip-box-back' ).height();
				if( cssua.ua.ie && cssua.ua.ie.substr(0, 1) == '8' ) {
					outer_height = flip_box.find( '.flip-box-back' ).height();
				} else {
					outer_height = flip_box.find( '.flip-box-back' ).outerHeight();
				}
				top_margin = ( height - flip_box.find( '.flip-box-front-inner' ).outerHeight() ) / 2;

				flip_box.find( '.flip-box-front' ).css( 'min-height', outer_height );
				flip_box.css( 'min-height', outer_height );
				flip_box.find( '.flip-box-front-inner' ).css( 'margin-top', top_margin );
			}

			if( cssua.ua.ie && cssua.ua.ie.substr(0, 1) == '8' ) {
				flip_box.find( '.flip-box-back' ).css( 'height', '100%' );
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