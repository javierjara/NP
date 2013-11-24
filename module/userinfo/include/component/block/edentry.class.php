<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Edentry extends Phpfox_Component 
{

	public function process()
	{
		$iEditId = $this->request()->get('id');
		
		list($iCnt,$aEducations) = Phpfox::getService('userinfo.education')->getUserEducations(Phpfox::getUserId(),1,1, $iEditId);
		
		$aEducation = $aEducations[0];
		
		$this->template()->assign('aEducation', $aEducation);
	
	  $aEdFields = Phpfox::getService('userinfo.education')->getFields();
		
		$this->template()
			->assign(array(
				'aEdFields' => $aEdFields,
				'aYears' => Phpfox::getService('userinfo.education')->getYears(),
				'sEmpUrl' => $this->url()->makeUrl('userinfo.education'),
			));
	}
}
?>