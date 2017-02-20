<?php 

namespace Artdarek\Avatarer\Output;

class ToObject implements OutputInterface {

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @param  array $attributes
	 * @return array
	 */
	public function generate($url) 
	{
		$output = (object) parse_url($url);

        // return
    	return $output;
	}

}