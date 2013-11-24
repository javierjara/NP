<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Edsearch extends Phpfox_Component 
{
	public function process()
	{		
	
		$this->template()->assign(array(
				'sHeader' => Phpfox::getPhrase('userinfo.search_filter')
			)
		);		
		
		return 'block';
	}
}

?>