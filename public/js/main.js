!function(t){var e={};function n(s){if(e[s])return e[s].exports;var i=e[s]={i:s,l:!1,exports:{}};return t[s].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=t,n.c=e,n.d=function(t,e,s){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:s})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(n.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(s,i,function(e){return t[e]}.bind(null,i));return s},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=0)}({0:function(t,e,n){n(1),n(7),t.exports=n(12)},1:function(t,e){function n(t){return(n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function s(t,e,n){var s;if(n){var i=new Date;i.setTime(i.getTime()+24*n*60*60*1e3),s="; expires="+i.toGMTString()}else s="";document.cookie=t+"="+e+s+"; path=/"}function i(){setTimeout((function(){clearTimeout(l),function t(e){if(c)return!1;void 0!==o[e]?(jQuery("#arcontactus").contactUs("showPromptTyping"),l=setTimeout((function(){if(c)return!1;jQuery("#arcontactus").contactUs("showPrompt",{content:o[e]}),e++,l=setTimeout((function(){if(c)return!1;t(e)}),p)}),u)):(r&&jQuery("#arcontactus").contactUs("hidePrompt"),a&&t(0))}(0)}),d)}!function(t){t.fn.jSideMenu=function(e){var n=t.extend({jSidePosition:"position-left",jSideSticky:!0,jSideSkin:"default-skin",jSideTransition:400},e);return this.each((function(){var e,s,i,o,a,r;s=t(this),e=t(".menu-container, .menu-head"),o=t(window).height(),i=t(".menu-head").height(),dHeading=t(".dropdown-heading"),menuTrigger=t(".menu-trigger"),a=t("<i></i>"),r=t("<div>"),t(s).css({height:o-i}),1==n.jSideSticky?t(".menubar").addClass("sticky"):t(".menubar").removeClass("sticky"),t(".menubar").addClass(n.jSideSkin),t(e).addClass(n.jSideSkin).addClass(n.jSidePosition),t(e).hasClass("position-left")?t(".menu-trigger").addClass("left").removeClass("right"):t(".menu-trigger").removeClass("left").addClass("right"),t(a).addClass("material-icons d-arrow").html("keyboard_arrow_down").appendTo(dHeading),t(r).addClass("dim-overlay").appendTo("body"),t(dHeading).click((function(){t(this).parent().find("ul").slideToggle(n.jSideTransition),t(this).find(".d-arrow").toggleClass("d-down")})),t(menuTrigger).click((function(){t(e).toggleClass("open"),t(r).show(n.jSideTransition),t(".menu-body").removeClass("visibility")})),t(window).click((function(s){t(s.target).closest(".menu-trigger").length||t(s.target).closest(e).length||(t(e).removeClass("open"),t(e).hasClass("open")||t(r).hide(n.jSideTransition),t(".menu-body").addClass("visibility"))}))}))}}(jQuery),$((function(){$(".menu-container").jSideMenu({jSidePosition:"position-left",jSideSticky:!0,jSideSkin:"default-skin"})})),function(t){function e(n,s){this._initialized=!1,this.settings=null,this.options=t.extend({},e.Defaults,s),this.$element=t(n),this.init(),this.x=0,this.y=0,this._interval,this._menuOpened=!1,this._callbackOpened=!1,this.countdown=null}e.Defaults={align:"right",countdown:0,drag:!1,buttonText:"Theo dõi",buttonSize:"large",menuSize:"normal",items:[],iconsAnimationSpeed:1200,theme:"#ff8d00",buttonIcon:'<svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-825 -308)"><g id="Vector"><use xlink:href="#path0_fill0123" transform="translate(825 308)" fill="#FFFFFF"/></g></g><defs><path id="path0_fill0123" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"/></defs></svg>',closeIcon:'<svg width="12" height="13" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-4087 108)"><g id="Vector"><use xlink:href="#path0_fill" transform="translate(4087 -108)" fill="currentColor"></use></g></g><defs><path id="path0_fill" d="M 14 1.41L 12.59 0L 7 5.59L 1.41 0L 0 1.41L 5.59 7L 0 12.59L 1.41 14L 7 8.41L 12.59 14L 14 12.59L 8.41 7L 14 1.41Z"></path></defs></svg>'},e.prototype.init=function(){this.destroy(),this.settings=t.extend({},this.options),this.$element.addClass("arcontactus-widget").addClass("arcontactus-message"),"left"===this.settings.align?this.$element.addClass("left"):this.$element.addClass("right"),this.settings.items.length?(this._initCallbackBlock(),this._initMessengersBlock(),this._initMessageButton(),this._initPrompt(),this._initEvents(),this.startAnimation(),this.$element.addClass("active")):console.info("jquery.contactus:no items"),this._initialized=!0,this.$element.trigger("arcontactus.init")},e.prototype.destroy=function(){if(!this._initialized)return!1;this.$element.html(""),this._initialized=!1,this.$element.trigger("arcontactus.destroy")},e.prototype._initCallbackBlock=function(){},e.prototype._initMessengersBlock=function(){var e=t("<div>",{class:"messangers-block"});"normal"!==this.settings.menuSize&&"large"!==this.settings.menuSize||e.addClass("lg"),"small"===this.settings.menuSize&&e.addClass("sm"),this._appendMessengerIcons(e),this.$element.append(e)},e.prototype._appendMessengerIcons=function(e){t.each(this.settings.items,(function(n){if("callback"==this.href)var s=t("<div>",{class:"messanger call-back "+(this.class?this.class:"")});else if(s=t("<a>",{class:"messanger "+(this.class?this.class:""),id:this.id?this.id:null,href:this.href,target:this.target?this.target:"_blank"}),this.onClick){var i=this;s.on("click",(function(t){i.onClick(t)}))}var o=t("<span>",{style:this.color?"background-color:"+this.color:null});o.append(this.icon),s.append(o),s.append("<p>"+this.title+"</p>"),e.append(s)}))},e.prototype._initMessageButton=function(){var e=this,n=t("<div>",{class:"arcontactus-message-button",style:this._backgroundStyle()});"large"===this.settings.buttonSize&&this.$element.addClass("lg"),"medium"===this.settings.buttonSize&&this.$element.addClass("md"),"small"===this.settings.buttonSize&&this.$element.addClass("sm");var s=t("<div>",{class:"static"});s.append(this.settings.buttonIcon),!1!==this.settings.buttonText?s.append("<p>"+this.settings.buttonText+"</p>"):n.addClass("no-text");var i=t("<div>",{class:"callback-state",style:e._colorStyle()});i.append(this.settings.callbackStateIcon);var o=t("<div>",{class:"icons hide"}),a=t("<div>",{class:"icons-line"});t.each(this.settings.items,(function(n){var s=t("<span>",{style:e._colorStyle()});s.append(this.icon),a.append(s)})),o.append(a);var r=t("<div>",{class:"arcontactus-close"});r.append(this.settings.closeIcon);var c=t("<div>",{class:"pulsation",style:e._backgroundStyle()}),l=t("<div>",{class:"pulsation",style:e._backgroundStyle()});n.append(s).append(i).append(o).append(r).append(c).append(l),this.$element.append(n)},e.prototype._initPrompt=function(){var e=t("<div>",{class:"arcontactus-prompt"}),n=t("<div>",{class:"arcontactus-prompt-close",style:this._colorStyle()});n.append(this.settings.closeIcon);var s=t("<div>",{class:"arcontactus-prompt-inner"});e.append(n).append(s),this.$element.append(e)},e.prototype._initEvents=function(){var e=this.$element,n=this;e.find(".arcontactus-message-button").on("mousedown",(function(t){n.x=t.pageX,n.y=t.pageY})).on("mouseup",(function(t){t.pageX===n.x&&t.pageY===n.y&&(n.toggleMenu(),t.preventDefault())})),this.settings.drag&&(e.draggable(),e.get(0).addEventListener("touchmove",(function(t){var n=t.targetTouches[0];e.get(0).style.left=n.pageX-25+"px",e.get(0).style.top=n.pageY-25+"px",t.preventDefault()}),!1)),t(document).on("click",(function(t){n.closeMenu()})),e.on("click",(function(t){t.stopPropagation()})),e.find(".call-back").on("click",(function(){n.openCallbackPopup()})),e.find(".callback-countdown-block-close").on("click",(function(){null!=n.countdown&&(clearInterval(n.countdown),n.countdown=null),n.closeCallbackPopup()})),e.find(".arcontactus-prompt-close").on("click",(function(){n.hidePrompt()}))},e.prototype.show=function(){this.$element.addClass("active"),this.$element.trigger("arcontactus.show")},e.prototype.hide=function(){this.$element.removeClass("active"),this.$element.trigger("arcontactus.hide")},e.prototype.openMenu=function(){var t=this.$element;t.find(".messangers-block").hasClass("show-messageners-block")||(this.stopAnimation(),t.find(".messangers-block, .arcontactus-close").addClass("show-messageners-block"),t.find(".icons, .static").addClass("hide"),t.find(".pulsation").addClass("stop"),this._menuOpened=!0,this.$element.trigger("arcontactus.openMenu"))},e.prototype.closeMenu=function(){var t=this.$element;t.find(".messangers-block").hasClass("show-messageners-block")&&(t.find(".messangers-block, .arcontactus-close").removeClass("show-messageners-block"),t.find(".icons, .static").removeClass("hide"),t.find(".pulsation").removeClass("stop"),this.startAnimation(),this._menuOpened=!1,this.$element.trigger("arcontactus.closeMenu"))},e.prototype.toggleMenu=function(){var t=this.$element;if(this.hidePrompt(),t.find(".callback-countdown-block").hasClass("display-flex"))return!1;t.find(".messangers-block").hasClass("show-messageners-block")?this.closeMenu():this.openMenu(),this.$element.trigger("arcontactus.toggleMenu")},e.prototype.openCallbackPopup=function(){var t=this.$element;t.addClass("opened"),this.closeMenu(),this.stopAnimation(),t.find(".icons, .static").addClass("hide"),t.find(".pulsation").addClass("stop"),t.find(".callback-countdown-block").addClass("display-flex"),this._callbackOpened=!0,this.$element.trigger("arcontactus.openCallbackPopup")},e.prototype.closeCallbackPopup=function(){var t=this.$element;t.removeClass("opened"),t.find(".messangers-block").removeClass("show-messageners-block"),t.find(".arcontactus-close").removeClass("show-messageners-block"),t.find(".icons, .static").removeClass("hide"),this.startAnimation(),this._callbackOpened=!1,this.$element.trigger("arcontactus.closeCallbackPopup")},e.prototype.startAnimation=function(){var t=this.$element,e=t.find(".icons-line"),n=t.find(".static"),s=t.find(".icons-line>span:first-child").width()+40;if("large"===this.settings.buttonSize)var i=2,o=0;"medium"===this.settings.buttonSize&&(i=4,o=-2),"small"===this.settings.buttonSize&&(i=4,o=-2);var a=t.find(".icons-line>span").length,r=0;if(this.stopAnimation(),0===this.settings.iconsAnimationSpeed)return!1;this._interval=setInterval((function(){0===r&&(e.parent().removeClass("hide"),n.addClass("hide"));var t="translate("+-(s*r+i)+"px, "+o+"px)";e.css({"-webkit-transform":t,"-ms-transform":t,transform:t}),++r>a&&(r>a+1&&(r=0),e.parent().addClass("hide"),n.removeClass("hide"),t="translate("+-i+"px, "+o+"px)",e.css({"-webkit-transform":t,"-ms-transform":t,transform:t}))}),this.settings.iconsAnimationSpeed)},e.prototype.stopAnimation=function(){clearInterval(this._interval);var t=this.$element,e=t.find(".icons-line"),n=t.find(".static");e.parent().addClass("hide"),n.removeClass("hide");var s="translate(-2px, 0px)";e.css({"-webkit-transform":s,"-ms-transform":s,transform:s})},e.prototype.showPrompt=function(t){var e=this.$element.find(".arcontactus-prompt");t&&t.content&&e.find(".arcontactus-prompt-inner").html(t.content),e.addClass("active"),this.$element.trigger("arcontactus.showPrompt")},e.prototype.hidePrompt=function(){this.$element.find(".arcontactus-prompt").removeClass("active"),this.$element.trigger("arcontactus.hidePrompt")},e.prototype.showPromptTyping=function(){this.$element.find(".arcontactus-prompt").find(".arcontactus-prompt-inner").html(""),this._insertPromptTyping(),this.showPrompt({}),this.$element.trigger("arcontactus.showPromptTyping")},e.prototype._insertPromptTyping=function(){var e=this.$element.find(".arcontactus-prompt-inner"),n=t("<div>",{class:"arcontactus-prompt-typing"}),s=t("<div>");n.append(s),n.append(s.clone()),n.append(s.clone()),e.append(n)},e.prototype.hidePromptTyping=function(){this.$element.find(".arcontactus-prompt").removeClass("active"),this.$element.trigger("arcontactus.hidePromptTyping")},e.prototype._backgroundStyle=function(){return"background-color: "+this.settings.theme},e.prototype._colorStyle=function(){return"color: "+this.settings.theme},t.fn.contactUs=function(s){var i=Array.prototype.slice.call(arguments,1);return this.each((function(){var o=t(this),a=o.data("ar.contactus");a||(a=new e(this,"object"==n(s)&&s),o.data("ar.contactus",a)),"string"==typeof s&&"_"!==s.charAt(0)&&a[s].apply(a,i)}))},t.fn.contactUs.Constructor=e}(jQuery);var o=["Xin chào"],a=!1,r=!1,c=!1,l=null,d=2e3,u=2e3,p=4e3,h=0,m=[];window.addEventListener("load",(function(){var t;t="arcu-closed",h=document.cookie.length>0&&(c_start=document.cookie.indexOf(t+"="),-1!=c_start)?(c_start=c_start+t.length+1,c_end=document.cookie.indexOf(";",c_start),-1==c_end&&(c_end=document.cookie.length),unescape(document.cookie.substring(c_start,c_end))):0,jQuery("#arcontactus").on("arcontactus.init",(function(){if(h)return!1;i()})),jQuery("#arcontactus").on("arcontactus.openMenu",(function(){clearTimeout(l),c=!0,jQuery("#contact").contactUs("hidePrompt"),s("arcu-closed",1,30)})),jQuery("#arcontactus").on("arcontactus.hidePrompt",(function(){clearTimeout(l),c=!0,s("arcu-closed",1,30)}));var e={id:"msg-item-1",class:"msg-item-sms",title:"Youtube",icon:'<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="50px" height="50px"><path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z"/></svg>',href:"https://www.youtube.com/channel/UC72J4ahElUrxR-GK4G_Kiag",color:"#ff0000"};m.push(e);e={id:"msg-item-2",class:"msg-item-sms",title:"Facebook",icon:'<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="50px" height="50px">    <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"/></svg>',href:"https://www.facebook.com/vietnamtoquoctoiyeu",color:"#0d88f0"};m.push(e),jQuery("#arcontactus").contactUs({items:m})})),window.onscroll=function(){window.pageYOffset>=f?g.classList.add("menu-desktop-stiky"):g.classList.remove("menu-desktop-stiky")};var g=document.getElementById("menu-bg-color"),f=g.offsetTop},12:function(t,e){},7:function(t,e){}});