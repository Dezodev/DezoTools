/**
 * Dezo-tools admin script
 */

jQuery(function($){
	$(window).load(function(){
		$(document).ready(function () {

			$(".dezo-tools-wrap .nav-tab").click(function(event){
				event.preventDefault();
				$(".tab-content").addClass('ui-tabs-hide');
				var tabname = $(this).attr('href');
				$(tabname).removeClass('ui-tabs-hide');
				$(".nav-tab").removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');
			});

			$('#dezo_tools_maintenance_end_date').datetimepicker({
			  format:'d/m/Y H:i'
			});
		});
	});
});
