<?php

class dezoTools_Minify
{
	public function __construct() {
		$this->add_action('get_header', 'html_minify_start');
	}

	public function html_minify_start() {
		ob_start([&$this, 'run']);
	}

	// run minify html
	public function run($html) {
		// Remove all comment
		$html = $this->removeComments($html);

		return '<!-- DezoTools - Minify HTML -->'.$html;
	}

	// Remove content
	function removeComments($content = '') {
        return preg_replace('/<!--(.|\s)*?-->/', '', $content);
	}

	/*-- Plugin helpers --*/

    /**
     * Helper method for register actions
     *
     * @return void
     */
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }
}
