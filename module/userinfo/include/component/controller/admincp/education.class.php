<?php
 
class Userinfo_Component_Controller_Admincp_Education extends Phpfox_Component
{
	public function process()
	{	
		$oTpl = $this->template();
		$oReq = $this->request();
		
		$aValidation = array(
			'name' => Phpfox::getPhrase('userinfo.provide_name'),
		);		
		
		$oValidator = Phpfox::getLib('validator')->set(array('sFormName' => 'empform', 'aParams' => $aValidation));	
		
		if ($aVals = $oReq->getArray('val'))
		{			
			if ($oValidator->isValid($aVals))
			{
				if (Phpfox::getService('userinfo.admin.education')->addField($aVals))
				{
					$this->url()->send('admincp.userinfo.education', null, Phpfox::getPhrase('userinfo.field_successfully_added'));
				}
			}
		}
		
		if ($aDeleteIds = $oReq->getArray('id'))
		{
			if (Phpfox::getService('userinfo.admin.education')->deleteSelected($aDeleteIds))
			{
				$this->url()->send('admincp.userinfo.education', null, Phpfox::getPhrase('userinfo.fields_successfully_deleted'));
			}
		}
		
				if($oReq->get('fldup'))
		{
			if (Phpfox::getService('userinfo.admin.education')->moveFieldUp($oReq->getInt('field_id')))
			{
				$this->url()->send('admincp.userinfo.education', null, Phpfox::getPhrase('userinfo.fields_successfully_reordered'));
			}
		}
		 
		if($oReq->get('flddown'))
		{
			if (Phpfox::getService('userinfo.admin.education')->moveFieldDown($oReq->getInt('field_id')))
			{
				$this->url()->send('admincp.userinfo.education', null, Phpfox::getPhrase('userinfo.fields_successfully_reordered'));
			}
		}
		
		if($this->request()->getArray('req') || $this->request()->getArray('search'))
		{
			if ($aReqs = $this->request()->getArray('req'))
			{
				Phpfox::getService('userinfo.admin.education')->updateFields($aReqs, 1);
			}
			
			if ($aSearches = $this->request()->getArray('search'))
			{
				Phpfox::getService('userinfo.admin.education')->updateFields($aSearches, 2);
			}
			
			$this->url()->send('admincp.userinfo.education', null, Phpfox::getPhrase('userinfo.fields_modified'));
		}
		
		$oTpl->setTitle(Phpfox::getPhrase('userinfo.manage_education_fields'))
				->setBreadcrumb(Phpfox::getPhrase('userinfo.manage_education_fields'))
				->assign(array(
					'aFields' => Phpfox::getService('userinfo.education')->getFields(true),
					'sCreateJs' => $oValidator->createJS(),
					'sGetJsForm' => $oValidator->getJsForm(false),
				))
				->setHeader(array(
					'quick_edit.js' => 'static_script',						
				));	
	}
}
 
?>