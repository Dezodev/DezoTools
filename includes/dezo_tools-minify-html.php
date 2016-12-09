<?php
/* Minify HTML output
 * wp_loaded = fired once WP, all plugins, and the theme are fully loaded and instantiated.
 * template_redirect = fired before WordPress determines which template page to load.
 */

require_once dirname( __FILE__ ).'/dezo-tools-const.php';
$dezo_const = dezo_get_const();

function dezo_html_minify_start()
{
    ob_start('dezo_html_minyfy_finish');
}

$htmlMinify = $dezo_const->shortname.'_html_minify';
if(get_option( $htmlMinify )) add_action('get_header', 'dezo_html_minify_start');

function dezo_html_minyfy_finish($html)
{

    $arrSearch = array(
        '/\>[^\S ]+/s',                 //01 : Remove tabs before tags
        '/[^\S ]+\</s',                 //02 : Remove tabs after tags
        '/[^\S ]+\</s',                 //03 : Remove multiple spaces
        '/^([\t ])+/m',                 //04 : Remove leading and trailing spaces
        '/([\t ])+$/m',                 //05 : Remove leading and trailing spaces
        '~//[a-zA-Z0-9 ]+$~m',          //06 : Remove JS line comments
        '/[\r\n]+([\t ]?[\r\n]+)+/s',   //07 : Remove empty lines
        '/\>[\r\n\t ]+\</s',            //08 : Remove empty lines
        '/}[\r\n\t ]+/s',               //09 : Remove empty lines
        '/}[\r\n\t ]+,[\r\n\t ]+/s',    //10 : Remove empty lines
        '/\)[\r\n\t ]?{[\r\n\t ]+/s',   //11 : Remove new lines after JS function
        '/,[\r\n\t ]?{[\r\n\t ]+/s',    //12 : Remove new lines after JS function
        '/\),[\r\n\t ]+/s'              //13 : Remove new lines after JS line end
    );

    $arrReplace = array(
        '>',    //01
        '<',    //02
        ' ',    //03
        '',     //04
        '',     //05
        '',     //06
        "\n",   //07
        '><',   //08
        '}',    //09
        '},',   //10
        '){',   //11
        ',{',   //12
        '),',   //13
    );

    $html = preg_replace($arrSearch, $arrReplace, $html);

    return "<!-- Dezo-minify --> \r\n".$html;
}
