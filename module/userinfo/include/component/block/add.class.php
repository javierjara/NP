<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Add extends Phpfox_Component 
{

	public function process()
	{
		$bIsAllowed = true;
		
		if (!Phpfox::getUserParam('userinfo.allow_add'))
		{
			$bIsAllowed = false;
		}
		
		$this->template()
			->assign(array(
				'sHeader' => Phpfox::getPhrase('userinfo.add_details'),					
				'aEmFields' => Phpfox::getService('userinfo.employment')->getFields(),
				'aEdFields' => Phpfox::getService('userinfo.education')->getFields(),
				'aMonths' => Phpfox::getService('userinfo.employment')->getMonths(),
				'aYears' => Phpfox::getService('userinfo.employment')->getYears(),
				'bIsAllowed' => $bIsAllowed,
				'sUpgradeMessage' => Phpfox::getPhrase('userinfo.consider_upgrading', array('link' => Phpfox::getLib('url')->makeUrl('subscribe'))),
			));
			
		return 'block';
	}
}
?>