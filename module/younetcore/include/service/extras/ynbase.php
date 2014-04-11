<?php
defined('PHPFOX') or exit('NO DICE!');
class ynbase
{
	private $_info;
	public function __construct()
	{
		$this->_info = array(
			'version' =>'3.01',
			'include' =>'younetcore',
		);
	}
	public function getInfo($name = "")
	{
		if($name == "" || $name == null)
		{
			return $this->_info;

		}
		else
		{
			if(array_key_exists($name, $this->_info))
			{
				return $this->_info[$name];
			}
		}
		return false;
			
	}

}

