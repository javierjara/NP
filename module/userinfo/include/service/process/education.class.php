<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Process_Education extends Phpfox_Service
{	
	public function addEducation($aVals)
	{
		if (!$this->_verifyAdd($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		$aFields = Phpfox::getService('userinfo.education')->getFields();
		
		$aSql['user_id'] = Phpfox::getUserId();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['name'] != 'date')
			{
				$aSql[$aField['name']] = $oParseInput->clean($aVals[$aField['name']]);
			}
		}

		$iId = $this->database()->insert(Phpfox::getT('education'), $aSql);
		
		if (!$iId)
		{
			return false;
		}
		
		$aSql = array(
			'education_id' => $iId,
			'class_year' => $aVals['class_year'],
			'is_present' => (isset($aVals['is_present']) ? 1 : 0)
		);
		
		$iDateId = $this->database()->insert(Phpfox::getT('education_dates'), $aSql);
		
		if(Phpfox::isModule('feed'))
		{
			$iCheck = $this->database()->select('time_stamp')
					->from(Phpfox::getT('feed'))
					->where('user_id = '. Phpfox::getUserId(). ' AND type_id = "userinfo_educationadd"')
					->execute('getField');
					
			if($iCheck)
			{
				$iFeedTime = Phpfox::getParam('userinfo.feed_time') * 3600;
			
				if((time() - $iFeedTime) > $iCheck)
				{
					Phpfox::getService('feed.process')->add('userinfo_educationadd', $iId, '', Phpfox::getUserId());
				}
			}
			else
			{
				Phpfox::getService('feed.process')->add('userinfo_educationadd', $iId, '', Phpfox::getUserId());
			}
		}
		
		return true;		
	}
	
	public function updateEducation($aVals,$iEditId)
	{
		if (!$this->_verifyAdd($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		$aFields = Phpfox::getService('userinfo.education')->getFields();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['name'] != 'date')
			{
				$aSql[$aField['name']] = $oParseInput->clean($aVals[$aField['name']]);
			}
		}

		$iId = $this->database()->update(Phpfox::getT('education'), $aSql, '`id` = '. (int) $iEditId);
		
		$aSql = array(
			'class_year' => $aVals['class_year'],
			'is_present' => (isset($aVals['is_present']) ? 1 : 0)
		);
		
		$iId = $this->database()->update(Phpfox::getT('education_dates'), $aSql, '`education_id` = '. (int) $iEditId);
		
		if($iId)
		{
			if(Phpfox::isModule('feed'))
			{
				$iCheck = $this->database()->select('time_stamp')
						->from(Phpfox::getT('feed'))
						->where('user_id = '. Phpfox::getUserId(). ' AND type_id = "userinfo_educationedit"')
						->execute('getField');
						
				if($iCheck)
				{
					$iFeedTime = Phpfox::getParam('userinfo.feed_time') * 3600;
				
					if((time() - $iFeedTime) > $iCheck)
					{
						Phpfox::getService('feed.process')->add('userinfo_educationedit', $iId, '', Phpfox::getUserId());
					}
				}
				else
				{
					Phpfox::getService('feed.process')->add('userinfo_educationedit', $iId, '', Phpfox::getUserId());
				}
			}
		}
		
		return true;		
	}
	
	private function _verifyAdd($aVals)
	{
		$bIsValid = true;
		$aFields = Phpfox::getService('userinfo.education')->getFields();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['type'] == 1 && strlen($aVals[$aField['name']]) > 128)
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.user_field_too_long',array('field' => $aField['ucname'])));
			}
			
			if (($aField['type'] == 1 || $aField['type'] == 2) && ($aField['required'] == 1 && strlen($aVals[$aField['name']]) == 0))
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.provide_field',array('field' => $aField['ucname'])));
			}
		}
		
		if (!(isset($aVals['is_present']) && $aVals['is_present'] == 1))
		{
			if (!is_numeric($aVals['class_year']) || $aVals['class_year'] == 0)
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.error_class_year'));
			}
		}
		
		if ($aVals['attended_for'] == 0)
		{
			$bIsValid = false;
			Phpfox_Error::set(Phpfox::getPhrase('userinfo.error_attended_for'));
		}
		
		if (!$bIsValid)
		{
			return false;
		}
		
		return true;
	}
	
		
	public function deleteEducation($iDeleteId)
	{
		$aEducation = Phpfox::getService('userinfo.education')->getEducationForEdit($iDeleteId);
		
		if ($aEducation['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
		{
			$this->database()->delete(Phpfox::getT('education'),'`id` = '. (int) $iDeleteId);
			$this->database()->delete(Phpfox::getT('education_dates'),'`education_id` = '. (int) $iDeleteId);
			
			return true;
		}
		
		return false;
	}
}

?>
