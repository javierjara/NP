<?php

defined('PHPFOX') or exit('NO DICE!'); 
 
class Userinfo_Component_Controller_Manage extends Phpfox_Component
{
	public function process()
	{
		if (!Phpfox::getUserId())
		{
			$this->url()->send('login');
		}
		
		list($iCnt,$aEmployments) = Phpfox::getService('userinfo.employment')->getUserEmployments(Phpfox::getUserId(),1,99);
		list($iCnt,$aEducations) = Phpfox::getService('userinfo.education')->getUserEducations(Phpfox::getUserId(),1,99);
		
		$this->template()->setTitle(Phpfox::getPhrase('userinfo.work_and_education'))
			->setBreadcrumb(Phpfox::getPhrase('userinfo.work_and_education'),			$this->url()->makeUrl('userinfo.manage'))			
			->assign(array(
				'aEmployments' => $aEmployments,
				'aEducations' => $aEducations,
				'aEmFields' => Phpfox::getService('userinfo.employment')->getFields(),
				'aEdFields' => Phpfox::getService('userinfo.education')->getFields(),
				'aUser' => Phpfox::getService('user')->get(Phpfox::getUserId(), true),
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