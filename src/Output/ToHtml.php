<?php 

namespace Artdarek\Avatarer\Output;

class ToHtml implements OutputInterface {

	/**
	 * [$_options description]
	 * @var array
	 */
	private $_options = [];

	/**
	 * [__constructor description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function __construct(array $options = []) {
		$this->_options = $options;
	}

	/**
	 * Generate output
	 *
	 * @param  string $url
	 * @return string
	 */
	public function generate($url) 
	{
		// make html code
        $html = '<img src="' . $url . '"';
        foreach ( $this->_options as $key => $val ) {
            $html .= ' ' . $key . '="' . $val . '"';
        }
        $html .= '>';

        // return
    	return $html;
	}

}