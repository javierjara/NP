<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Ededit extends Phpfox_Component 
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
			if (($aEducation = Phpfox::getService('userinfo.education')->getEducationForEdit($iEditId)))
			{
				$this->template()->assign('aEducation', $aEducation);
			}
		}
	  
	  $aEdFields = Phpfox::getService('userinfo.education')->getFields();	
		
		$this->template()
			->assign(array(
				'aEdFields' => $aEdFields,
				'aYears' => Phpfox::getService('userinfo.education')->getYears(),
				'sUpgradeLink' => $this->url()->makeUrl('subscribe'),
			));
	}
}
?>