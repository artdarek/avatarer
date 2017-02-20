<?php 

namespace Artdarek\Avatarer\Output;

class ToHtml implements OutputInterface {

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @param  array $attributes
	 * @return string
	 */
	public function generate($url, array $attributes = []) 
	{
		// make html code
        $html = '<img src="' . $url . '"';
        foreach ( $attributes as $key => $val ) {
            $html .= ' ' . $key . '="' . $val . '"';
        }
        $html .= ' />';

        // return
    	return $html;
	}

}