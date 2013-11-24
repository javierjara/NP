<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Process_Employment extends Phpfox_Service
{	
	public function addEmployment($aVals)
	{
		if (!$this->_verifyAdd($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		$aFields = Phpfox::getService('userinfo.employment')->getFields();
		
		$aSql['user_id'] = Phpfox::getUserId();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['name'] != 'date')
			{
				$aSql[$aField['name']] = $oParseInput->clean($aVals[$aField['name']]);
			}
		}

		$iId = $this->database()->insert(Phpfox::getT('employment'), $aSql);
		
		if (!$iId)
		{
			return false;
		}
		
		$aSql = array(
			'employment_id' => $iId,
			'month_from' => $aVals['month_from'],
			'year_from' => $aVals['year_from'],
			'month_to' => $aVals['month_to'],
			'year_to' => $aVals['year_to'],
			'is_present' => (isset($aVals['is_present']) ? 1 : 0)
		);
		
		$iDateId = $this->database()->insert(Phpfox::getT('employment_dates'), $aSql);
		
		if(Phpfox::isModule('feed'))
		{
			$iCheck = $this->database()->select('time_stamp')
					->from(Phpfox::getT('feed'))
					->where('user_id = '. Phpfox::getUserId(). ' AND type_id = "userinfo_employeradd"')
					->execute('getField');
					
			if($iCheck)
			{
				$iFeedTime = Phpfox::getParam('userinfo.feed_time') * 3600;
			
				if((time() - $iFeedTime) > $iCheck)
				{
					Phpfox::getService('feed.process')->add('userinfo_employeradd', $iId, '', Phpfox::getUserId());
				}
			}
			else
			{
				Phpfox::getService('feed.process')->add('userinfo_employeradd', $iId, '', Phpfox::getUserId());
			}
		}
		
		return true;		
	}
	
	public function updateEmployment($aVals,$iEditId)
	{
		if (!$this->_verifyAdd($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		$aFields = Phpfox::getService('userinfo.employment')->getFields();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['name'] != 'date')
			{
				$aSql[$aField['name']] = $oParseInput->clean($aVals[$aField['name']]);
			}
		}

		$iId = $this->database()->update(Phpfox::getT('employment'), $aSql, '`id` = '. (int) $iEditId);
		
		$aSql = array(
			'month_from' => $aVals['month_from'],
			'year_from' => $aVals['year_from'],
			'month_to' => $aVals['month_to'],
			'year_to' => $aVals['year_to'],
			'is_present' => (isset($aVals['is_present']) ? 1 : 0)
		);
		
		$iId = $this->database()->update(Phpfox::getT('employment_dates'), $aSql, '`employment_id` = '. (int) $iEditId);
		
		if($iId)
		{
			if(Phpfox::isModule('feed'))
			{
				$iCheck = $this->database()->select('time_stamp')
						->from(Phpfox::getT('feed'))
						->where('user_id = '. Phpfox::getUserId(). ' AND type_id = "userinfo_employeredit"')
						->execute('getField');
						
				if($iCheck)
				{
					$iFeedTime = Phpfox::getParam('userinfo.feed_time') * 3600;
				
					if((time() - $iFeedTime) > $iCheck)
					{
						Phpfox::getService('feed.process')->add('userinfo_employeredit', $iId, '', Phpfox::getUserId());
					}
				}
				else
				{
					Phpfox::getService('feed.process')->add('userinfo_employeredit', $iId, '', Phpfox::getUserId());
				}
			}
		}
		
		return true;		
	}
	
	private function _verifyAdd($aVals)
	{
		$bIsValid = true;
		$aFields = Phpfox::getService('userinfo.employment')->getFields();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['type'] == 1 && strlen($aVals[$aField['name']]) > 128)
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.user_field_too_long',array('field' => $aField['ucname'])));
			}
			
			if ($aField['type'] != 0 && ($aField['required'] == 1 && strlen($aVals[$aField['name']]) == 0))
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.provide_field', array('field' => $aField['ucname'])));
			}
		}
		
		if (isset($aVals['is_present']) && $aVals['is_present'] == 1)
		{
			if ((!is_numeric($aVals['month_from']) || $aVals['month_from'] == 0) || (!is_numeric($aVals['year_from']) || $aVals['year_from'] == 0))
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.error_from'));
			}
		}
		else 
		{
			if ((!is_numeric($aVals['month_from']) || $aVals['month_from'] == 0) || (!is_numeric($aVals['year_from']) || $aVals['year_from'] == 0) || (!is_numeric($aVals['month_to']) || $aVals['month_to'] == 0) || (!is_numeric($aVals['year_to']) || $aVals['year_to'] == 0))
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.error_from_to'));
			}
			
			if ($aVals['year_from'] > $aVals['year_to'])
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.date_not_before'));
			}
			
			else if ($aVals['year_from'] == $aVals['year_to'])
			{
				if ($aVals['month_from'] > $aVals['month_to'])
				{
					$bIsValid = false;
					Phpfox_Error::set(Phpfox::getPhrase('userinfo.date_not_before'));
				}
			}
		}
		
		if (!$bIsValid)
		{
			return false;
		}
		
		return true;
	}
	
	public function deleteEmployment($iDeleteId)
	{
		$aEmployment = Phpfox::getService('userinfo.employment')->getEmploymentForEdit($iDeleteId);
		
		if ($aEmployment['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
		{
			$this->database()->delete(Phpfox::getT('employment'),'`id` = '. (int) $iDeleteId);
			$this->database()->delete(Phpfox::getT('employment_dates'),'`employment_id` = '. (int) $iDeleteId);
			
			return true;
		}
		
		return false;
	}
}

?>
