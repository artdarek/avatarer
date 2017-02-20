<?php 

namespace Artdarek\Avatarer\Output;

class ToJson implements OutputInterface {

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @param  array $attributes
	 * @return array
	 */
	public function generate($url) 
	{
		$output = json_encode ( parse_url($url) );

        // return
    	return $output;
	}

}