(function($) {
	'use strict';
	var a = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    var trueMobile = a.any();
    if (null == trueMobile) {
        if(lotek_obj.disable_animation != '1'){
			new WOW().init();
		}
    }
    if (trueMobile) {
    	if(lotek_obj.disable_mobile_animation != '1'){
			new WOW().init();
		}
    }
	//console.log(lotek_obj.disable_animation);
	
	
	
	/*
	Smooth scroll
	=========================== */
	// $('ul.navbar-nav.navbar-scroll li a, .btn-scroll').smoothScroll({beforeScroll: function() {
		
	// }});
	
	$('ul.navbar-nav li a[href^="#"], .btn-scroll, .logo a[href^="#"]').smoothScroll();
	
	$('.navbar-toggle').click(function(){
		$(".collapse").slideToggle();
		return false; 
	});
		
	$('.navbar-nav li a').click(function(){
		$(".collapse").slideToggle("normal");
	});
		
	/*
	Hover image
	=========================== */		
	$(".image-caption").css({'opacity':'0','filter':'alpha(opacity=0)'});
	$('.image-wrapper').hover(
		function() {
			$(this).find('.image-caption').stop().fadeTo(800, 1);
			$(".zoom", this).stop().animate({top:'38%'},{queue:false,duration:300});
			$(".image-title", this).stop().animate({bottom:'40%'},{queue:false,duration:500});
		},
		function() {
			$(this).find('.image-caption').stop().fadeTo(800, 0);
			$(".zoom", this).stop().animate({top:'-38%'},{queue:false,duration:300});
			$(".image-title", this).stop().animate({bottom:'-40%'},{queue:false,duration:500});
		});
	
	/*
	Team
	=========================== */	
	$(".team-profile").css({'opacity':'0','filter':'alpha(opacity=0)'});
	$('.team-box').hover(function(){
		$(this).find('.team-profile').stop().fadeTo(900, 1);
		$(".team",this).stop().css({'z-index':'20'});
	}, function() {
		$(this).find('.team-profile').stop().fadeTo(900, 0);
		$(".team",this).stop().css({'z-index':'20'});
	});		

		/*
	Tooltips
	=========================== */
	$('.tooltips').tooltip({
		 selector: "a[data-tooltips='tooltip']"
	})

	// Responsive video
	//$(".video-container").fitVids();

	$(".video-container").fitVids({ customSelector: "iframe[src^='https://w.soundcloud.com'], iframe[src^='http://myviiids.com']"});

	
})(jQuery);

jQuery(function($) {
	'use strict';
	// Do our DOM lookups beforehand
	var nav_container = $("header");
	var nav = $(".navbar");

	// nav_container.waypoint(function() {
	//   alert('You have scrolled to a thing.');
	// });

	nav_container.waypoint({
		handler: function(direction) {
			nav.toggleClass('sticky-nav', direction=='down');
			
			if (direction == 'down') nav_container.css({ 'height':nav.outerHeight() });
			else nav_container.css({ 'height':'auto' });
		},
		offset: 60
	});
	var sections = $("section");
	var navigation_links = $(".nav a");
	
	sections.waypoint({
		handler: function(direction) {
		
			var active_section;
			active_section = $(this);
			if (direction === "up") {
				active_section = active_section.prevAll('section');
				// console.log(active_section[0]);
				active_section = $(active_section[0]);
				// console.log(active_section);
			}
			var active_link = $('.nav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("selected");
			active_link.addClass("selected");

		},
		offset: 60
	})
});



(function($) {
	'use strict';
  // 	$('.flexslider').flexslider({
  //   	animation: "slide",
		// slideshow: false, 
  // 	});
	$('.flexslider').each(function(index){
		var testi_slider = $(this);
	  	var testi_slider_ss = testi_slider.data('ss') ? testi_slider.data('ss') : 0;
	  	testi_slider.flexslider({
	    	animation: "slide",
			slideshow: testi_slider_ss, 
			slideshowSpeed: 7000,
			animationSpeed: 600,
			smoothHeight:true
	  	});
	});

  	
})(jQuery);

(function($){
	'use strict';
	$("a[data-pretty^='prettyPhoto']").prettyPhoto();
				
	$(".video:first a[data-pretty^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'pp_default',slideshow:3000, autoplay_slideshow: false});
	$(".video:gt(0) a[data-pretty^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
})(jQuery);


jQuery(document).ready(function($){
//////////////////////////////////////////////////////////////////////////////////////////////////////////////						   

	$(".stylechanger li a").click(function() { 
		$("#lotekskin-css").attr("href",$(this).attr('rel'));
		return false;
	});
	
	
	$(".openpanel").click(function(){$(".demo-panel").toggle("slow");$(this).toggleClass("active");return false});	
});
