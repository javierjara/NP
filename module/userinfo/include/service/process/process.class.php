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
		
		$aFields = Phpfox::getService('education')->getFields();
		
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
		
		Phpfox::getService('feed.process')->add('education', $iId, serialize(array('institution' => $oParseInput->clean($aVals['institution']))), Phpfox::getUserId());
		
		return true;		
	}
	
	public function updateEducation($aVals,$iEditId)
	{
		if (!$this->_verifyAdd($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		$aFields = Phpfox::getService('education')->getFields();
		
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
		
		return true;		
	}
	
	private function _verifyAdd($aVals)
	{
		$bIsValid = true;
		$aFields = Phpfox::getService('education')->getFields();
		
		foreach($aFields as $aKey => $aField)
		{
			if ($aField['type'] == 1 && strlen($aVals[$aField['name']]) > 128)
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.user_field_too_long',array('field' => $aField['ucname'])));
			}
		}
		
		if (!(isset($aVals['is_present']) && $aVals['is_present'] == 1))
		{
			if (!is_numeric($aVals['class_year']) || $aVals['class_year'] == 0)
			{
				$bIsValid = false;
				Phpfox_Error::set(Phpfox::getPhrase('userinfo.error_from'));
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
}

?>
