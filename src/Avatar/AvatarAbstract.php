<?php 

namespace Artdarek\Avatarer\Avatar;

abstract class AvatarAbstract implements AvatarInterface {

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
	 * @var int
	 */
	protected $_size = [
		'width' => null,
		'height' => null,
	];

	/**
	 * Generated avatar url is saved in this variable
	 *
	 * @var string
	 */
	protected $_url = '';

	/**
	 * Options
	 * 
	 * @var array
	 */
	protected $_options = [];

	/**
	 * Set user id
	 *
	 * @param  string $id
	 * @return Self
	 */
	public function user( $id )
	{
		$this->_id = $id;
		$this->make();
		return $this;
	}
	
	/**
	 * Set size of avatar [ 1 - 2048 ]
	 *
	 * @param  int $size
	 * @return Self
	 */
	public function size($width = 200, $height = null)
	{
		$this->_size['width'] = $width;
		$this->_size['height'] = $height;
		$this->make();		
		return $this;
	}

	/**
	 * Set additional options
	 *
	 * @param  array $options
	 * @return Self
	 */
	public function options( array $options = [] )
	{
		$this->_options = array_merge($this->_options,$options);
		$this->make();
		return $this;
	}

	/**
	 * Get created avatar
	 *
	 * @return string
	 */
	public function get()
	{
		// return avatar
		return $this->_url;
	}

	/**
	 * Make avatar url
	 * 
	 * @return Self
	 */
	abstract protected function make();

	/**
	 * Avatar base url
	 *
	 * @return string
	 */
	abstract protected function endpoint();
	
}