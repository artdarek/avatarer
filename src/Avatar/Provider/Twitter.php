<?php 

namespace Artdarek\Avatarer\Avatar\Provider;

use \Artdarek\Avatarer\Avatar\AvatarInterface;
use \Artdarek\Avatarer\Avatar\AvatarAbstract;

class Twitter extends AvatarAbstract implements AvatarInterface {

	/**
	 * Options
	 * 
	 * @var array
	 */
	protected $_options = [
		'size' => null, // desired size of avatar [ mini | normal | bigger | original ]
	];

	/**
	 * Avatar base url
	 *
	 * @return string
	 */
	protected function endpoint()
	{
		$endpoint = 'https://twitter.com/'.strtolower( trim( $this->_id ) ).'/profile_image';
		return $endpoint;
	}

	/**
	 * Make avatar url
	 *
	 * @return Self
	 */
	protected function make()
	{
	    // size
	    $params['size'] = ($this->_options['size'] !== null) ? $this->_options['size'] : $this->_size_mapper();

	    // remove array elements with empty value
		$params = array_diff($params, ['']);

		// create avatar url
	    $url = $this->endpoint();
	    $url .= '?';
		$url .= http_build_query($params);

	    // save created avatar url
	    $this->_url = $url;

	    // return url
    	return $this;
	}

	/**
	 * [_size_mapper description]
	 * @return [type] [description]
	 */
	private function _size_mapper() {
		// size map
	    $sizesMap = ['mini' => 24, 'normal' => 48, 'bigger' => 96, 'original' => 128];
	    $mappedSize = 'mini';
	    foreach($sizesMap as $k=>$v) {
			if ($this->_size['width'] >= $v) { 
				$mappedSize = $k; 
			} 
	    }
	    return $mappedSize;
	}

}