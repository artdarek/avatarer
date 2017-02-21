<?php 

namespace Artdarek\Avatarer\Avatar\Provider;

use \Artdarek\Avatarer\Avatar\AvatarInterface;
use \Artdarek\Avatarer\Avatar\AvatarAbstract;

class Gravatar extends AvatarAbstract implements AvatarInterface {

	/**
	 * Options
	 * 
	 * @var array
	 */
	protected $_options = [
		'default' => 'mm', // Url to your default avatar image or [ 404 | mm | identicon | monsterid | wavatar | blank | retro ]
		'forceDefault' => null, // If for some reason you wanted to force the default image to always load [ y ]
		'ratings' => 'g', // Maximum rating (inclusive) [ g | pg | r | x ]
	];

	/**
	 * Avatar base url
	 *
	 * @return string
	 */
	protected function endpoint()
	{
		$endpoint = 'https://www.gravatar.com/avatar/'.md5( strtolower( trim( $this->_id ) ) );
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
	    $params['s'] = ($this->_size['width'] !== null) ? $this->_size['width'] : '';
	    
	    // ratings
	    $params['r'] = ($this->_options['ratings'] !== null) ? $this->_options['ratings'] : '';
	    // default
	    $params['d'] = ($this->_options['default'] !== null) ? $this->_options['default'] : '';
	    // default
	    $params['f'] = ($this->_options['forceDefault'] !== null) ? $this->_options['forceDefault'] : '';

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