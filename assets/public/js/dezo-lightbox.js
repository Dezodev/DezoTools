/**
* @Author: Deniz Yilmaz <deniz>
* @Date:   24-10-2016-14:07
* @Email:  dezodev@gmail.com
* @Last modified by:   deniz
* @Last modified time: 25-10-2016-16:06
* @License: GPLv3
*/


/**
 * Lightbox script
 * Created by : Dezodev
 */

 jQuery(function($){
 	$(window).load(function(){
 		$(document).ready(function () {
            
            $('#content a[href]:has(img)').filter(function() {
                return /(jpg|gif|png|jpeg)$/.test($(this).attr('href'));
            }).addClass('dezo-lightbox').attr('rel','dezo-gallery');

            $(".dezo-lightbox").fancybox({
                openEffect	: 'elastic',
        	    closeEffect	: 'elastic',
                helpers : {
            		title : {
            			type : 'over'
            		}
            	}
            });

		});
	});
});
