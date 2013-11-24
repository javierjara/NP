<?php

defined('PHPFOX') or exit('NO DICE!'); 
 
class Userinfo_Component_Controller_View extends Phpfox_Component
{
	public function process()
	{
		if(!$iUserId = $this->request()->getInt('user'))
		{
			$this->url()->send('');
		}
		
		$aUser = Phpfox::getService('user')->get($iUserId, true);
		
		$bIsAllowed = true;
		
		if (!Phpfox::getService('user.privacy')->hasAccess($aUser['user_id'], 'userinfo.display_on_profile'))
		{
			$bIsAllowed = false;
		}
		
		list($iCnt,$aEmployments) = Phpfox::getService('userinfo.employment')->getUserEmployments($aUser['user_id'],1,99);
		list($iCnt,$aEducations) = Phpfox::getService('userinfo.education')->getUserEducations($aUser['user_id'],1,99);
		
		$this->template()->setTitle(Phpfox::getPhrase('userinfo.work_and_education'))
			->setBreadcrumb($aUser['full_name'],	$this->url()->makeUrl($aUser['user_name'].'.info'))			
			->setBreadcrumb(Phpfox::getPhrase('userinfo.work_and_education_user', array('uname' => $aUser['full_name'])),			$this->url()->makeUrl('userinfo.view', array('user' => $aUser['user_id'])), true)		
			->assign(array(
				'bIsAllowed' => $bIsAllowed,
				'aEmployments' => $aEmployments,
				'aEducations' => $aEducations,
				'aUser' => $aUser,
				'sUserLink' => $this->url()->makeUrl($aUser['user_name'].'.info'),
				'aEmFields' => Phpfox::getService('userinfo.employment')->getFields(),
				'aEdFields' => Phpfox::getService('userinfo.education')->getFields(),
				'sEmpUrl' => $this->url()->makeUrl('userinfo.employment'),
				'sEduUrl' => $this->url()->makeUrl('userinfo.education'),
				'sEmpIcon' => Phpfox::getLib('template')->getStyle('image', 'employer.png', 'userinfo'),
				'sEduIcon' => Phpfox::getLib('template')->getStyle('image', 'education.png', 'userinfo')
			))		
			->setHeader(array(
					'userinfo.js' => 'module_userinfo',
				));
	}
}
 
?>