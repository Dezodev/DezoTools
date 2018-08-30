<?php

class dezoTools_Minify
{
	public function __construct() {
		$val_html_minify = get_option('dezo-enable-html-minify');
        if ($val_html_minify === '1') $this->add_action('get_header', 'html_minify_start');
	}

	public function html_minify_start() {
		ob_start([&$this, 'run']);
	}

	// run minify html
	public function run($html) {
		// Remove all comment
		$html = $this->remove_comments($html);
		$html = $this->remove_whitespace($html);

		return '<!-- DezoTools - Minify HTML -->'.$html;
	}

	// Remove comment
	public function remove_comments($content = '') {
        return preg_replace('/<!--(.|\s)*?-->/', '', $content);
	}

	public function remove_whitespace($html = '') {
		//remove redundant (white-space) characters
		$replace = array(
		    //remove tabs before and after HTML tags
		    '/\>[^\S ]+/s'   => '>',
		    '/[^\S ]+\</s'   => '<',
		    //shorten multiple whitespace sequences; keep new-line characters because they matter in JS!!!
		    '/([\t ])+/s'  => ' ',
		    //remove leading and trailing spaces
		    '/^([\t ])+/m' => '',
		    '/([\t ])+$/m' => '',
		    // remove JS line comments (simple only); do NOT remove lines containing URL (e.g. 'src="http://server.com/"')!!!
		    '~//[a-zA-Z0-9 ]+$~m' => '',
		    //remove empty lines (sequence of line-end and white-space characters)
		    '/[\r\n]+([\t ]?[\r\n]+)+/s'  => "\n",
		    //remove empty lines (between HTML tags); cannot remove just any line-end characters because in inline JS they can matter!
		    '/\>[\r\n\t ]+\</s'    => '><',
		    //remove "empty" lines containing only JS's block end character; join with next line (e.g. "}\n}\n</script>" --> "}}</script>"
		    '/}[\r\n\t ]+/s'  => '}',
		    '/}[\r\n\t ]+,[\r\n\t ]+/s'  => '},',
		    //remove new-line after JS's function or condition start; join with next line
		    '/\)[\r\n\t ]?{[\r\n\t ]+/s'  => '){',
		    '/,[\r\n\t ]?{[\r\n\t ]+/s'  => ',{',
		    //remove new-line after JS's line end (only most obvious and safe cases)
		    '/\),[\r\n\t ]+/s'  => '),',
		    //remove quotes from HTML attributes that does not contain spaces; keep quotes around URLs!
		    '~([\r\n\t ])?([a-zA-Z0-9]+)="([a-zA-Z0-9_/\\-]+)"([\r\n\t ])?~s' => '$1$2=$3$4', //$1 and $4 insert first white-space character found before/after attribute
		);
		$html = preg_replace(array_keys($replace), array_values($replace), $html);

		return $html;
	}


	/*-- Helpers --*/

    /**
     * Helper method for register actions
     *
     * @return void
     */
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }
}
