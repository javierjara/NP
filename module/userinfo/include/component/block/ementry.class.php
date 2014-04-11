<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Ementry extends Phpfox_Component 
{

	public function process()
	{
		$iEditId = $this->request()->get('id');
		
		list($iCnt,$aEmployments) = Phpfox::getService('userinfo.employment')->getUserEmployments(Phpfox::getUserId(),1,1, $iEditId);
		
		$aEmployment = $aEmployments[0];
		
		$this->template()->assign('aEmployment', $aEmployment);
	
	  $aFields = Phpfox::getService('userinfo.employment')->getFields();
		
		$this->template()
			->assign(array(
				'aFields' => $aFields,
				'aMonths' => Phpfox::getService('userinfo.employment')->getMonths(),
				'aYears' => Phpfox::getService('userinfo.employment')->getYears(),
				'sEmpUrl' => $this->url()->makeUrl('userinfo.employment'),
			));
	}
}
?>