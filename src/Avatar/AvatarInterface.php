<?php 

namespace Artdarek\Avatarer\Avatar;

interface AvatarInterface {

	/**
	 * Set user id
	 *
	 * @param mixed $id
	 * @return Self
	 */
	public function user($id);
	
	/**
	 * Set size of avatar
	 *
	 * @param  int $width
	 * @param  int $height
	 * @return Self
	 */
	public function size($width = null, $height = null);

	/**
	 * Set additional options
	 *
	 * @param  array $options
	 * @return Self
	 */
	public function options( array $options = [] );

	/**
	 * Get created avatar
	 * 
	 * @return string
	 */
	public function get();

}