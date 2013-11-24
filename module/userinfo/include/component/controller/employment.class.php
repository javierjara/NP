<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Controller_Employment extends Phpfox_Component
{
	public function process()
	{		
		$aVals = $this->request()->getArray('val');
		$aSearch = $this->request()->getArray('search');
		
		if (isset($aSearch['reset']))
		{
			$this->url()->send('userinfo.employment');
		}
		
		$aFieldNames = Phpfox::getService('userinfo.employment')->getFieldNames();
		$aUrls = Phpfox::getService('userinfo.employment')->getSearchParams($this->url()->getParams());
	
		$iPage = $this->request()->getInt('page',1);
		$iPageSize = Phpfox::getParam('userinfo.entries_per_page');

		list($iCnt,$aEmployments) = Phpfox::getService('userinfo.employment')->getEmployments($aVals,$aUrls,$iPage,$iPageSize);
    
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
			
			$aSearch['month_from'] = $aVals['month_from'];
			if ($aVals['month_from'] > 0)
			{
				$aPageParams['month-from'] = $aVals['month_from'];
			}
			
			$aSearch['year_from'] = $aVals['year_from'];
			if ($aVals['year_from'] > 0)
			{
				$aPageParams['year-from'] = $aVals['year_from'];
			}
			
			$aSearch['month_to'] = $aVals['month_to'];
			if ($aVals['month_to'] > 0)
			{
				$aPageParams['month-to'] = $aVals['month_to'];
			}
			
			$aSearch['year_to'] = $aVals['year_to'];
			if ($aVals['year_to'] > 0)
			{
				$aPageParams['year-to'] = $aVals['year_to'];
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
			
			$aSearch['month_from'] = (isset($aUrls['month-from']) ? $aUrls['month-from'] : 0);	
			if (isset($aUrls['month-from']))
			{
				$aPageParams['month-from'] = $aUrls['month-from'];
			}
			
			$aSearch['year_from'] = (isset($aUrls['year-from']) ? $aUrls['year-from'] : 0);
			if (isset($aUrls['year-from']))
			{
				$aPageParams['year-from'] = $aUrls['year-from'];
			}
			
			$aSearch['month_to'] = (isset($aUrls['month-to']) ? $aUrls['month-to'] : 0);
			if (isset($aUrls['month-to']))
			{
				$aPageParams['month-to'] = $aUrls['month-to'];
			}
			
			$aSearch['year_to'] = (isset($aUrls['year-to']) ? $aUrls['year-to'] : 0);
			if (isset($aUrls['year-to']))
			{
				$aPageParams['year-to'] = $aUrls['year-to'];
			}
			
			$aSearch['is_present'] = (isset($aUrls['is-present']) ? 1 : 0);
			if (isset($aUrls['is-present']))
			{
				$aPageParams['is-present'] = $aUrls['is-present'];
			}
			
			$this->template()->assign('aSearch',$aSearch);
		}
		
		$aCustomPager = Phpfox::getService('userinfo.employment')->getPager($iCnt,$iPage,$iPageSize,$aPageParams);
		
		$this->template()->setTitle(Phpfox::getPhrase('userinfo.employment'))
					->setBreadcrumb(Phpfox::getPhrase('userinfo.employment'),			$this->url()->makeUrl('info'))
				->setBreadcrumb(Phpfox::getPhrase('userinfo.browse_employment'),$this->url()->makeUrl('info'),true)
					->assign(array(
					'aPager' => $aCustomPager,
					'aEmployments' => $aEmployments,
					'iCnt' => $iCnt,
					'iLogId' => Phpfox::getUserId(),
					'aFields' => Phpfox::getService('userinfo.employment')->getFields(),
					'sEmpUrl' => $this->url()->makeUrl('userinfo.employment'),
					'aMonths' => Phpfox::getService('userinfo.employment')->getMonths(),
					'aYears' => Phpfox::getService('userinfo.employment')->getYears(),
					'bIsAdmin' => Phpfox::isAdmin(),
				))
				->setHeader(array(
					'userinfo.js' => 'module_userinfo',
					'pager.css' => 'style_css'	
				));		
	}
}

?>