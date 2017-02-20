<?php 

namespace Artdarek\Avatarer\Output;

class ToArray implements OutputInterface {

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @param  array $attributes
	 * @return array
	 */
	public function generate($url) 
	{
		$output = parse_url($url);

        // return
    	return $output;
	}

}