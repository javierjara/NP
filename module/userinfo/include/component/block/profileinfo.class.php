<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Profileinfo extends Phpfox_Component
{
	public function process()
	{					
		$aUser = (PHPFOX_IS_AJAX ? Phpfox::getService('user')->get(Phpfox::getUserId(), true) : $this->getParam('aUser'));
		
		if (!Phpfox::getService('user.privacy')->hasAccess($aUser['user_id'], 'userinfo.display_on_profile'))
		{
			return false;
		}
	
		$sEmployment = Phpfox::getService('userinfo.employment')->getProfileEmployment($aUser);
		$aEducation = Phpfox::getService('userinfo.education')->getProfileEducation($aUser);

		$this->template()->assign(array(	
					'sEmployment' => $sEmployment,
					'aEducation' => $aEducation,
				)
		);
		
	}
	
}

?>