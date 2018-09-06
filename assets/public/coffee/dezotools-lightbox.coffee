# out: ../js/dezotools-lightbox.js, compress: true, sourceMap: true

jQuery(document).ready ($) =>
    ## Select <a> with image link
    $('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').attr('data-rel', 'lightcase:mainCollection');

    $('a[data-rel^=lightcase]').lightcase({
        transition: 'scrollHorizontal',
    });