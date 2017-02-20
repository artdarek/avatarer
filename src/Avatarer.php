<?php 

namespace Artdarek\Avatarer;

class Avatarer {

	private $_driver = 'Gravatar';
	private $_avatarer;

	/** 
	 * Return avatarer driver instance
	 *
	 * @param  string $driver
	 * @return Driver
	 */
	public function make( $driver )
	{
		$this->setDriver( $driver );
		$this->createDriverInstance();

	    // return
    	return $this->_avatarer;
	}

	/**
	 * Set Driver name
	 * @param [type] $driver [description]
	 */
	public function setDriver( $driver ) 
	{
		$this->_driver = $driver;
	}

	/**
	 * Create avatarer driver instance
	 * @param  string $name 
	 * @return Driver
	 */
	public function createDriverInstance() 
	{
		$driverClass = __NAMESPACE__ . '\\Avatar\\Network\\'.$this->_driver;
		$this->_avatarer = new $driverClass;
	}


}