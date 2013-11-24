<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Block_Profile extends Phpfox_Component
{
	public function process()
	{				
		$aUser = (PHPFOX_IS_AJAX ? Phpfox::getService('user')->get(Phpfox::getUserId(), true) : $this->getParam('aUser'));
		
		if (!Phpfox::getService('user.privacy')->hasAccess($aUser['user_id'], 'userinfo.display_on_profile'))
		{
			return false;
		}
		
		if (PHPFOX_IS_AJAX)
		{
			$this->template()->assign(array(
				'aUser' => $aUser,
			));
		}

		
		$iEmpCount = Phpfox::getLib('database')->select('COUNT(`id`)')
				->from(Phpfox::getT('employment'))
				->where('`user_id` = "'.$aUser['user_id'].'"')
				->execute('getField');
				
		$iEduCount = Phpfox::getLib('database')->select('COUNT(`id`)')
				->from(Phpfox::getT('education'))
				->where('`user_id` = "'.$aUser['user_id'].'"')
				->execute('getField');
				
		if ($iEmpCount > 0 || $iEduCount > 0)
		{
			list($iCnt,$aEmployments) = Phpfox::getService('userinfo.employment')->getUserEmployments($aUser['user_id'],1,Phpfox::getParam('userinfo.profile_count'));
			list($iCnt,$aEducations) = Phpfox::getService('userinfo.education')->getUserEducations($aUser['user_id'],1,Phpfox::getParam('userinfo.profile_count'));
		}
		else 
		{
			return false;
		}
		
		$sEditLink = '';
		if ($aUser['user_id'] == Phpfox::getUserId())
		{
			$sEditLink = '<div class="js_edit_header_bar">';
			$sEditLink .= '<span id="js_user_employment" style="display:none;"><img src="' . $this->template()->getStyle('image', 'ajax/small.gif') . '" alt="" class="v_middle" /></span>';
			$sEditLink .= '<a href="#" onclick="window.location.href = \''.$this->url()->makeUrl('userinfo.manage').'\'" id="js_user__employment_link">';
			$sEditLink .= '<img src="' . $this->template()->getStyle('image', 'misc/page_white_edit.png') . '" alt="" class="v_middle" />';
			$sEditLink .= '</a>';			
			$sEditLink .= '</div>';
		}		

		if (!PHPFOX_IS_AJAX)
		{
			$this->template()->assign(array(	
					'aUser' => $aUser,
					'sHeader' => $sEditLink . Phpfox::getPhrase('userinfo.work_and_education'),	
					'sEditLink' => $sEditLink,
					'iEmpCount' => $iEmpCount,
					'iEduCount' => $iEduCount,
					'aEmployments' => $aEmployments,
					'aEducations' => $aEducations,
					'aEmFields' => Phpfox::getService('userinfo.employment')->getFields(),
					'aEdFields' => Phpfox::getService('userinfo.education')->getFields(),
					'sEmpUrl' => $this->url()->makeUrl('userinfo.employment'),
					'sEduUrl' => $this->url()->makeUrl('userinfo.education'),
					'sUserUrl' => $this->url()->makeUrl('userinfo.view'),
					'iCnt' => $iCnt,
					'bIsAdmin' => Phpfox::isAdmin(),
					'sEmpIcon' => Phpfox::getLib('template')->getStyle('image', 'employer.png', 'userinfo'),
					'sEduIcon' => Phpfox::getLib('template')->getStyle('image', 'education.png', 'userinfo')
				)
			);
			return 'block';
		}
	}
	
}

?>