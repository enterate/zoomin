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
			console.log(active_section);
			if (direction === "up") active_section = active_section.prev();

			var active_link = $('.nav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("selected");
			active_link.addClass("selected");

		},
		offset: '60'
	})
});