<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Emedit extends Phpfox_Component 
{

	public function process()
	{
		if (!Phpfox::getUserId())
		{
			$this->url()->send('login');
		}
	
		$aVals = $this->request()->getArray('val');
		
		if ($iEditId = $this->request()->get('id'))
		{
			if (($aEmployment = Phpfox::getService('userinfo.employment')->getEmploymentForEdit($iEditId)))
			{
				$this->template()->assign('aEmployment', $aEmployment);
			}
		}
	  
	  $aFields = Phpfox::getService('userinfo.employment')->getFields();	
		
		$this->template()
			->assign(array(
				'aFields' => $aFields,
				'aMonths' => Phpfox::getService('userinfo.employment')->getMonths(),
				'aYears' => Phpfox::getService('userinfo.employment')->getYears(),
				'sUpgradeLink' => $this->url()->makeUrl('subscribe'),
			));
	}
}
?>