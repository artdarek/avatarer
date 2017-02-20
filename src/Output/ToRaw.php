<?php 

namespace Artdarek\Avatarer\Output;

class ToRaw implements OutputInterface {

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @param  array $attributes
	 * @return string
	 */
	public function generate($url, array $attributes = []) 
	{
        // return
    	return $url;
	}

}