(function( $ ) {
	'use strict';

	$(document).ready(function() {
		$(".dezo-tools-wrap .nav-tab").click(function(event){
			event.preventDefault();     
			$(".tab-content").addClass('ui-tabs-hide');
			var tabname = $(this).attr('href');
			$(tabname).removeClass('ui-tabs-hide');
			$(".nav-tab").removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
		});
	});

})( jQuery );
