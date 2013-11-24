<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Controller_Index extends Phpfox_Component
{
	public function process()
	{		
		$this->url()->send('userinfo.employment');
	}
}
?>