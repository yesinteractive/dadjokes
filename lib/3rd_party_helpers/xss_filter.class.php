<?php
/**
* xss_filter
* https://github.com/JBlond/PHP-XSS-Filter
* version: 232bbb570e36c5d31391210fdb3011e729a98637
* @author mario.brandt
* @copyright Copyright (c) 2013 - 2017
* @access public
*
* Altered for FSL by Yes Interactive
 */
class xss_filter {

	/**
	* @var bool $allow_http_value
	* @access private
	*/
	private $allow_http_value = false;

	/**
	* @var string $input
	* @access private
	*/
	private $input;
	/**
	* @var array $preg_patterns
	* @access private
	*/
	private $preg_patterns = array(
		// Fix &entity\n
		'!(&#0+[0-9]+)!' => '$1;',
		'/(&#*\w+)[\x00-\x20]+;/u' => '$1;>',
		'/(&#x*[0-9A-F]+);*/iu' => '$1;',
		//any attribute starting with "on" or xml name space
		'#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu' => '$1>',
		//javascript: and VB script: protocols
		'#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu' => '$1=$2nojavascript...',
		'#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu' => '$1=$2novbscript...',
		'#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u' => '$1=$2nomozbinding...',
		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		'#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i' => '$1>',
		'#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu' => '$1>',
		// namespace elements
		'#</*\w+:\w[^>]*+>#i' => '',
		//unwanted tags
		'#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i' => ''
	);

	/**
	 * @var array
	 */
	private $normal_patterns = array(
		'\'' => '&apos;',
		'"' => '&quot;',
		'&' => '&amp;',
		'<' => '&lt;',
		'>' => '&gt;',
		//possible SQL injection remove from string with there is no '
		'SELECT * FROM' => '',
		'SELECT(' => '',
		'SLEEP(' => '',
		'AND (' => '',
		' AND' => '',
		'(CASE' => ''
	);

	/**
	* xss_filter::filter_it()
	*
	* @access public
	* @param string $input
	* @return string
	*/
	public function filter_it($input){
		$this->input = html_entity_decode($input, ENT_NOQUOTES, 'UTF-8');
		$this->normal_replace();
		$this->do_grep();
		return $this->input;
	}

	/**
	* xss_filter::allow_http()
	*
	* @access public
	*/
	public function allow_http(){
		$this->allow_http_value = true;
	}

	/**
	* xss_filter::disallow_http()
	*
	* @access public
	*/
	public function disallow_http(){
		$this->allow_http_value = false;
	}

	/**
	* xss_filter::remove_get_parameters()
	*
	* @access public
	* @param $url string
	* @return string
	*/
	public function remove_get_parameters($url){
		return preg_replace('/\?.*/', '', $url);
	}

	/**
	* xss_filter::normal_replace()
	*
	* @access private
	*/
	private function normal_replace(){
		$this->input = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $this->input);
		if($this->allow_http_value === false){
			$this->input = str_replace(array('&', '%', 'script', 'http', 'localhost'), array('', '', '', '', ''), $this->input);
		}
		else
		{
			$this->input = str_replace(array('&', '%', 'script', 'localhost', '../'), array('', '', '', '', ''), $this->input);
		}
		foreach($this->normal_patterns as $pattern => $replacement){
			$this->input = str_replace($pattern,$replacement,$this->input);
		}
	}

	/**
	* xss_filter::do_grep()
	*
	* @access private
	*/
	private function do_grep(){
		foreach($this->preg_patterns as $pattern => $replacement){
			$this->input = preg_replace($pattern,$replacement,$this->input);
		}
	}
}
