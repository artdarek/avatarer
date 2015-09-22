<?php 

namespace Artdarek\Avatarer\Driver;

abstract class Driver {

	/**
	 * User id
	 *
	 * @var string
	 */
	protected $_id = '';

	/**
	 * Size of avatar in pixels
	 * defaults to 80px [ 1 - 2048 ]
	 *
	 * @var string
	 */
	protected $_size = 80;

	/**
	 * Secured (https)
	 * If not set - autodetect
	 *
	 * @var boolean
	 */
	protected $_secured;

	/**
	 * Generated avatar url is saved in this variable
	 *
	 * @var string
	 */
	protected $_url = '';

	/**
	 * Set user id
	 *
	 * @param  string $id
	 * @return Self $this
	 */
	public function user( $id )
	{
		$this->_id = $id;
		$this->_url = $this->make()->url();
		return $this;
	}
	
	/**
	 * Set size of avatar
	 * defaults to 80px [ 1 - 2048 ]
	 *
	 * @param  int $size
	 * @return Self $this
	 */
	public function size( $size = 80 )
	{
		$this->_size = $size;
		$this->_url = $this->make()->url();
		return $this;
	}

	/**
	 * Set https
	 *
	 * @param  boolean
	 * @return Self $this
	 */
	public function secured( $isSecured = false )
	{
		$this->_secured = $isSecured;
		$this->_url = $this->make()->url();
		return $this;
	}

	/**
	 * Get protocol
	 *
	 * @return string $url
	 */
	public function getProtocol()
	{
		if ($this->_secured === true) $protocol = 'https:';
		elseif ($this->_secured === false) $protocol = 'http:';
		else $protocol = '';
		return $protocol;
	}

	/**
	 * Get created avatar url as a string
	 *
	 * @return string $avatar
	 */
	public function url()
	{
		// get created avatar
		$url = $this->_url;

		// return avatar
		return $url;
	}

	/**
	 * Get html tag <img> with generated avatar
	 *
	 * @param array $attributes html attributes to add to generated code
	 * @return string $html
	 */
	public function html( $attributes = array() )
	{
		// make avatar url first
		$url = $this->_url;;

		// make html code
        $html = '<img src="' . $url . '"';

        foreach ( $attributes as $key => $val ) {
            $html .= ' ' . $key . '="' . $val . '"';
        }

        $html .= ' />';

        // return
    	return $html;
	}

}