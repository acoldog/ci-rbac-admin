/*
 * HoverImageEnlarge.js 1.1
 * Written by Jack O'Connor http://jackocnr.com
 * Copyright 2011, Bit Circus http://bitcircus.co.uk
 * Released under the WTFPL license 
 * http://sam.zoy.org/wtfpl/
 */

(function($) {
	
	
	// LOCAL METHOD: shrink the given image
	var shrinkImage = function(i) {
		//console.log("shrinkImage");
		var profilePic = i.children("img");
		// grab original box styles
		var originalWidth = i.data("originalWidth");
		var originalHeight = i.data("originalHeight");
		i.stop().animate({width: originalWidth, height: originalHeight}, function() {
			i.removeClass("enlarged");
			i.css({position:'relative'});
		});
		// grab original img styles
		var originalTop = profilePic.data("originalTop");
		var originalLeft = profilePic.data("originalLeft");
		profilePic.stop().animate({top: originalTop, left: originalLeft});
	};
	
	
	// list of methods you can call to interact with this plugin
	var methods = {
		
		/*****************
		 * INITIALISATION
		 *****************/ 
		init: function(is_set_absolute) {
			
			//console.log("init");
			// check if browser is android/apple etc
			var isMobile = ((navigator.userAgent.match(/iPhone/i))
					|| (navigator.userAgent.match(/iPod/i))
					|| (navigator.userAgent.match(/iPad/i))
					|| (navigator.userAgent.match(/Android/i)));
			
			// for use in nested functions / event listeners
			var images = $(this);
			var imgBoxes = images.parent();
			
			// first save the original CSS values for use later on
			imgBoxes.each(function() {
				// box width/height values
				var boxWidth = $(this).css("width");
				var boxHeight = $(this).css("height");

				$(this).data("originalWidth", boxWidth);
				$(this).data("originalHeight", boxHeight);
				// img top/left values
				var profilePic = $(this).children("img");
				var imgTop = profilePic.css("top");
				var imgLeft = profilePic.css("left");
				profilePic.data("originalTop", imgTop);
				profilePic.data("originalLeft", imgLeft);
				//console.log("storing box width="+boxWidth+", height="+boxHeight+", img top="+imgTop+", left="+imgLeft);
				
				//保存每张图的真实大小		acol
				var _that_img = $(this).find('.profile-pic');
				_that_img.attr({'originW':_that_img.width(), 'originH':_that_img.height()}).css({width:'50px', height:'50px'});
				
			});
			
			// enlarge the given image
			function enlargeImage(i) {
				var profilePic = i.children("img");

				//限制图片原图大小			acol
				var _limit_width = 300;
				if (profilePic.width() > _limit_width) {
					profilePic.height( profilePic.height() * (_limit_width/profilePic.width()) );
					profilePic.width(_limit_width);
				}
				// grow the viewer box to the full image size
				var imgWidth = profilePic.width();
				var imgHeight = profilePic.height();
				//console.log("width="+imgWidth+", height="+imgHeight);
				if (typeof is_set_absolute != 'undefined') {
					i.css({position:'absolute'});
				}
				i.addClass("enlarged").stop().animate({width: imgWidth, height: imgHeight});
				// remove negative offsets
				profilePic.stop().animate({top: 0, left: 0});
			}
			
			// set different event handlers depending on browser
			if (isMobile) {
				// set click event
				imgBoxes.click(function() {
					if ($(this).hasClass("enlarged")) shrinkImage($(this));
					else {
						// shrink others
						imgBoxes.filter(".enlarged").each(function() {
							shrinkImage($(this));
						});
						enlargeImage($(this));
					}
				});
			}
			else {
				// set hover events
				imgBoxes.hover(function() {
					if (!$(this).hasClass("enlarged")) {
						//还原真实大小，准备好做动画
						var _that_img = $(this).find('.profile-pic');
						_that_img.css({top: '-64px', left: '-72px', width:_that_img.attr('originW'), height:_that_img.attr('originH')});
						enlargeImage($(this));
					} 
				},
				function() {
					if ($(this).hasClass("enlarged")) {
						//限制图片大小，以便缩略时显示全图
						var _that_img = $(this).find('.profile-pic');
						_that_img.css({width:50, height:50});
						shrinkImage($(this));
					} 
				});
			}
			
			// maintain jQuery chainability
			return $(this);
		},
		
		/*************
		 * SHRINK ALL
		 *************/
		shrink: function() {
			
			//console.log("shrink");
			var images = $(this);
			var imgBoxes = images.parent();
			
			imgBoxes.filter(".enlarged").each(function() {
				shrinkImage($(this));
			});
			
			// maintain jQuery chainability
			return $(this);
			
		}
		
	};
	
	
	// the actual plugin function
	$.fn.hoverImageEnlarge = function(method) {
		// Method calling logic
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.hoverImageEnlarge');
		}
	};
	
	
})(jQuery);