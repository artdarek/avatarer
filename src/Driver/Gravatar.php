<?php 

namespace Artdarek\Avatarer\Driver;

class Gravatar extends Driver {

	/**
	 * Default imageset to use
	 * Url to your default avatar image or [ 404 | mm | identicon | monsterid | wavatar ]
	 * defaults to 'mm'
	 *
	 * @var string
	 */
	protected $_defaultImage = 'mm';

	/**
	 * Ratings
	 * Maximum rating (inclusive) [ g | pg | r | x ]
	 *
	 * @var string
	 */
	protected $_rating = 'g';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() { }

	/**
	 * Set rating of avatar
	 * Maximum rating (inclusive) [ g | pg | r | x ]
	 *
	 * @param  string $size
	 * @return Self $this
	 */
	public function rating( $rating = 'g')
	{
		$this->_rating = $rating;
		$this->_url = $this->make()->url();
		return $this;
	}

	/**
	 * Set defaut avatar image
	 * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 *
	 * @param  string $size
	 * @return Self $this
	 */
	public function defaultImage( $defaultImage = 'mm')
	{
		$this->_defaultImage = $defaultImage;
		$this->_url = $this->make()->url();
		return $this;
	}

	/**
	 * Make avatar url
	 * You can pass just user id as a string to this method than
	 * avatar will be generated with default settings
	 * or also u can pass more parameters as array (id|size|default|rating)
	 *
	 * @param  string|array $params
	 * @return Self $this
	 */
	public function make( $params = null )
	{
		// check if array has been passed
		if (is_array($params))
		{
			if ( isset($params['id']) ) $this->_id = $params['id'];
			if ( isset($params['size']) ) $this->_size = $params['size'];
			if ( isset($params['defaultImage']) ) $this->_defaultImage = $params['defaultImage'];
			if ( isset($params['rating']) ) $this->_rating = $params['rating'];
			if ( isset($params['secured']) ) $this->_secured = $params['secured'];
		}
		else
		{
			// if string was given assume that it is id
			if ($params != null ) $this->_id = $params;
		}

		// create avatar url
	    $url = $this->getBaseUrl();
	    $url .= md5( strtolower( trim( $this->_id ) ) );
	    $url .= "?s=".$this->_size."&d=".$this->_defaultImage."&r=".$this->_rating;

	    // save created avatar url
	    $this->_url = $url;

	    // return url
    	return $this;
	}

	/**
	 * Get base url
	 *
	 * @return string $url
	 */
	public function getBaseUrl()
	{
		$url = $this->getProtocol().'//www.gravatar.com/avatar/';
		return $url;
	}


}