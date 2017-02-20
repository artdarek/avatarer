<?php 

namespace Artdarek\Avatarer\Output;

interface OutputInterface {

	/**
	 * Generate output
	 * 
	 * @param  string $url
	 * @param  array $attributes
	 * @return mixed
	 */
	public function generate($url, array $attributes = []);

}