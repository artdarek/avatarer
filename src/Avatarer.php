<?php 

namespace Artdarek\Avatarer;

class Avatarer {

	/**
	 * Provider name
	 * @var string
	 */
	private $_provider;

	/**
	 * Avatarer instance
	 * @var \Artdarek\Avatarer\Avatar\AvatarInterface
	 */
	private $_avatarer;

	/** 
	 * Make avatarer provider instance
	 *
	 * @param  string $provider
	 * @return \Artdarek\Avatarer\Avatar\AvatarInterface
	 */
	public function make( $provider )
	{
		$this->setProvider( $provider );
		$this->createProviderInstance();

	    // return
    	return $this->_avatarer;
	}

	/**
	 * Set provider name
	 * 
	 * @param string $provider
	 */
	public function setProvider( $provider ) 
	{
		$this->_provider = $provider;
	}

	/**
	 * Create avatarer provider instance
	 * 
	 * @return \Artdarek\Avatarer\Avatar\AvatarInterface
	 */
	public function createProviderInstance() 
	{
		//$providerClass = __NAMESPACE__ . '\\Avatar\\Network\\'.$this->_provider;
		$this->_avatarer = new $this->_provider;
	}


}