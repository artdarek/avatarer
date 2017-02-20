<?php 

namespace Artdarek\Avatarer\Avatar\Network;

use \Artdarek\Avatarer\Avatar\AvatarInterface;
use \Artdarek\Avatarer\Avatar\AvatarAbstract;

class Facebook extends AvatarAbstract implements AvatarInterface {

	/**
	 * Options
	 * 
	 * @var array
	 */
	protected $_options = [
		'type' => 'square', // Type of avatar [ small, normal, album, large, square ]
	];

	/**
	 * Get base url
	 *
	 * @return string
	 */
	protected function endpoint()
	{
		$endpoint = 'https://graph.facebook.com/'.$this->_id.'/picture/';
		return $endpoint;
	}

	/**
	 * Make avatar url
	 *
	 * @return Self
	 */
	protected function make()
	{
	    // width
	    $params['width'] = ($this->_size['width'] !== null) ? $this->_size['width'] : '';
	    // height
	    $params['height'] = ($this->_size['height'] !== null) ? $this->_size['height'] : '';
	    // type
	    $params['type'] = ($this->_options['type'] !== null) ? $this->_options['type'] : '';

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


}