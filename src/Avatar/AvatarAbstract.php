<?php 

namespace Artdarek\Avatarer\Avatar;

use \Artdarek\Avatarer\Output\OutputInterface;

abstract class AvatarAbstract {

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
		$this->_size = ['width' => $width, 'height'=> $height];
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
		return $this;
	}

	/**
	 * Get created avatar
	 *
	 * @return string
	 */
	public function get(OutputInterface $output = null)
	{
		// make avatar url
		$this->make();

		// generate output
		if ($output !== null) $url = $output->generate($this->_url);
		else $url = $this->_url;

		// return avatar
		return $url;
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