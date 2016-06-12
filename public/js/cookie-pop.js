/**
 * Cookie pop
 * Create by : Dezodev
 */

(function ( $ ) {
  
    'use strict';

    if ( 'set' !== Cookies( 'cookie-pop' ) ) {

        $('body').prepend(
            '<div class="cookie-pop">' + dezo_cookie_pop_text.message + '<button id="accept-cookie">' + dezo_cookie_pop_text.button + '</button> <a href="/cookies/">' + dezo_cookie_pop_text.more + '</a></div>'

        );

        $( '#accept-cookie' ).click(function () {

            Cookies( 'cookie-pop', 'set' );
            $( '.cookie-pop' ).remove();

        });
  
    }

}( jQuery ) );