<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

function dezo_get_const()
{
    return (object) [
        'name' => 'Dezo tools',
        'shortname' => 'dezo_tools',
        'dashname' => 'dezo-tools',
        'version' => '0.1.0',
        'dir' => trailingslashit(plugin_dir_path(dirname(__FILE__))),
        'uri' => trailingslashit(plugin_dir_url(dirname(__FILE__))),
        'dir_includes' => trailingslashit(plugin_dir_path(dirname(__FILE__))).trailingslashit('includes'),
        'dir_assets' => trailingslashit(plugin_dir_path(dirname(__FILE__))).trailingslashit('assets')
    ];
}
