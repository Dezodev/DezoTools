# out: ../js/dezotools-lightbox.js, compress: true, sourceMap: true

console.log('-- HLLWRD');
jQuery(document).ready ($) =>
    ## Select <a> with image link
    $('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').attr('rel', 'lightbox');

    $('a[rel="lightbox"]').simpleLightbox({
        alertError: false,
    });