<?php 

namespace Artdarek\Avatarer\Driver;

class Facebook extends Driver {

	/**
	 * Type of avatar
	 * defaults to small [ large, small, big ]
	 *
	 * @var string
	 */
	protected $_type = 'small';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() { }

	/**
	 * Set size of avatar
	 * defaults to 80px [ 1 - 2048 ]
	 *
	 * @param  int $type
	 * @return Self $this
	 */
	public function type( $type = 'small' )
	{
		$this->_type = $type;
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
			if ( isset($params['secured']) ) $this->_secured = $params['secured'];
		}
		else
		{
			// if string was given assume that it is user id
			if ($params != null ) $this->_id = $params;
		}

		// create avatar url
	    $url = $this->getBaseUrl();
	    $url .= "?width=".$this->_size."&type=".$this->_type;

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
		$url = $this->getProtocol().'//graph.facebook.com/'.$this->_id.'/picture/';
		return $url;
	}


}