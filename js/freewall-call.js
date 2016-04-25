(function($){
	$(document).ready(function() {
		// fire freewall first
		var wall = new freewall("#container");
		wall.reset({
			gutterY: 20,
			gutterX: 20,
			animate: 0,
			keepOrder: 1,
		})
		wall.fitWidth();
		
		// then animate all div
		$( "#container" ).css({
			opacity: "0",
			left: "+100",
			visibility: "visible"});
		$( "#container" ).animate({
			opacity: "1",
			left: "0",
		  }, 1000, function() {
			// Animation complete -> reset freewall and add onResize Option
			
				$("#container").each(function() {
					var wall = new freewall(this);
					wall.reset({
						gutterY: 20,
						gutterX: 20,
						keepOrder: 1,
						animate: 0,
						onBlockResize: function () {
							$( "#container" ).css("opacity",0);
						},
						onResize: function() {
							data = $('#container').attr('data-min-width');
							old_data = $('#container').attr('previous-data-min-width');
							if (!old_data || old_data != data)  {
								$('#container').attr('previous-data-min-width',data);
								old_data = data;
								$( "#container" ).css("opacity",0);
								
							}
							this.fitWidth();
							
							
							
						},
						onComplete: function() {
							$( "#container" ).animate({opacity: "1"});
						}
					})
					//wall.fitWidth();
				});
				//$(window).trigger("resize");
			
			});
	});
})( jQuery );