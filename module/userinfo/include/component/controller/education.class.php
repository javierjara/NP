<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Controller_Education extends Phpfox_Component
{
	public function process()
	{		
		$aVals = $this->request()->getArray('val');
		$aSearch = $this->request()->getArray('search');
		
		if (isset($aSearch['reset']))
		{
			$this->url()->send('userinfo.education');
		}
		
		$aFieldNames = Phpfox::getService('userinfo.education')->getFieldNames();
		$aUrls = Phpfox::getService('userinfo.education')->getSearchParams($this->url()->getParams());
	
		$iPage = $this->request()->getInt('page',1);
		$iPageSize = Phpfox::getParam('userinfo.entries_per_page');

		list($iCnt,$aEducations) = Phpfox::getService('userinfo.education')->getEducations($aVals,$aUrls,$iPage,$iPageSize);
    
    $aPageParams = array();  
		
		if (!empty($aVals))
		{
			foreach($aFieldNames as $aKey => $aField)
			{
				$aSearch[$aField] = $aVals[$aField];
				if ($aVals[$aField] != '')
				{
					$aPageParams[$aKey] = urlencode($aVals[$aField]);
				}
			}
			
			$aSearch['class_year'] = $aVals['class_year'];
			if ($aVals['class_year'] > 0)
			{
				$aPageParams['class-year'] = $aVals['class-year'];
			}
			
			$aSearch['attended_for'] = $aVals['attended_for'];
			if ($aVals['attended_for'] > 0)
			{
				$aPageParams['attended-for'] = $aVals['attended_for'];
			}
			
			$aSearch['is_present'] = (isset($aVals['is_present']) ? 1 : 0);
			if (isset($aVals['is_present']))
			{
				$aPageParams['is-present'] = $aVals['is_present'];
			}
			
			$this->template()->assign('aSearch',$aSearch);
		}
		
		if (!empty($aUrls))
		{
			foreach($aFieldNames as $aKey => $aField)
			{
				if (isset($aUrls[$aField]))
				{
					$aSearch[$aField] = $aUrls[$aField];
					$aPageParams[$aKey] = urlencode($aUrls[$aField]);
				}
				else
				{
					$aSearch[$aField] = '';
				}
			}
			
			$aSearch['class_year'] = (isset($aUrls['class-year']) ? $aUrls['class-year'] : 0);	
			if (isset($aUrls['class-year']))
			{
				$aPageParams['class-year'] = $aUrls['class-year'];
			}
			
			$aSearch['attended_for'] = (isset($aUrls['attended-for']) ? $aUrls['attended-for'] : 0);	
			if (isset($aUrls['attended-for']))
			{
				$aPageParams['attended-for'] = $aUrls['attended-for'];
			}

			$aSearch['is_present'] = (isset($aUrls['is-present']) ? 1 : 0);
			if (isset($aUrls['is-present']))
			{
				$aPageParams['is-present'] = $aUrls['is-present'];
			}
			
			$this->template()->assign('aSearch',$aSearch);
		}
		
		$aCustomPager = Phpfox::getService('userinfo.education')->getPager($iCnt,$iPage,$iPageSize,$aPageParams);
		
		$this->template()->setTitle(Phpfox::getPhrase('userinfo.education'))
					->setBreadcrumb(Phpfox::getPhrase('userinfo.education'),			$this->url()->makeUrl('userinfo.education'))
					->setBreadcrumb(Phpfox::getPhrase('userinfo.browse_education'),$this->url()->makeUrl('userinfo.education'),true)
					->assign(array(
					'aPager' => $aCustomPager,
					'aEducations' => $aEducations,
					'iCnt' => $iCnt,
					'iLogId' => Phpfox::getUserId(),
					'aEdFields' => Phpfox::getService('userinfo.education')->getFields(),
					'sEduUrl' => $this->url()->makeUrl('userinfo.education'),
					'aYears' => Phpfox::getService('userinfo.education')->getYears(),
					'bIsAdmin' => Phpfox::isAdmin(),
				))
				->setHeader(array(
					'userinfo.js' => 'module_userinfo',
					'pager.css' => 'style_css'	
				));	
	}
}

?>