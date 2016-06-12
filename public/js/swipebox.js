/**
 * Lightbox script
 * Created by : Dezodev
 */

(function ( $ ) {
  
    'use strict';
    
    $('article a > img').each(function(){
        
        var file = $(this).parent('a').attr('href'),
            ext = file.substring(file.lastIndexOf('.') + 1);


        if(ext ==="gif" || ext === "jpg" ||  ext === "png"|| ext === "bmp"){
            $(this).parent('a').addClass('swipebox');
        }

    });
    
	$( '.swipebox' ).swipebox( {
		hideBarsDelay : 5000, // delay before hiding bars on desktop
		beforeOpen: function() {}, // called before opening
		afterOpen: null, // called after opening
		afterClose: function() {}, // called after closing
		loopAtEnd: true // true will return to the first image after the last image is reached
	} );

}( jQuery ) );