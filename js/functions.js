/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	
	button = $(".secondary-toggle");
	menu = $(".secondary");
	button.on( 'click.twentyfifteen', function() {
		menu.css({opacity: "0"});
		menu.animate({opacity: "1"},1000);
		console.log('bonjour');
		});
} )( jQuery );
