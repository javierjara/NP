<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Admin_Employment extends Phpfox_Service
{	
	public function addField($aVals)
	{
		if (!$this->_verifyField($aVals))
		{
			return false;
		}
		
		$oParseInput = Phpfox::getLib('parse.input');	
		
		if ($aVals['type'] == 1)
		{
			$oQuery = $this->database()->query('ALTER TABLE `'.Phpfox::getT('employment').'` ADD COLUMN `'.strtolower(str_replace(' ','_',$aVals['name'])).'` VARCHAR (256) NOT NULL default ""');
		}
		else if ($aVals['type'] == 2)
		{
			$oQuery = $this->database()->query('ALTER TABLE `'.Phpfox::getT('employment').'` ADD COLUMN `'.strtolower(str_replace(' ','_',$aVals['name'])).'` MEDIUMTEXT NOT NULL default ""');
		}
		
		if ($oQuery)
		{
			$iOldPos = $this->database()->select('`position`')
						->from(Phpfox::getT('employment_order'))
						->order('position DESC')
						->limit(1)
						->execute('getField');
						
			$iId =	$this->database()->insert(Phpfox::getT('employment_order'), array('name' => strtolower(str_replace(' ','_',Phpfox::getLib('parse.input')->clean($aVals['name'], 128))), 'type' => $aVals['type'], 'required' => (isset($aVals['required']) ? $aVals['required'] : 0), 'searchable' => (isset($aVals['searchable']) ? $aVals['searchable'] : 0), 'position' => ($iOldPos + 1)));
		
			$aLangs = $this->database()->select('`language_id`')
							->from(Phpfox::getT('language'))
							->execute('getRows');
							
			foreach($aLangs as $aKey => $sLang)
			{
				$oParseInput = Phpfox::getLib('parse.input');		
	
				$sText = $oParseInput->convert($aVals['name']);
					
				$this->database()->insert(Phpfox::getT('language_phrase'), array(
						'language_id' => $sLang['language_id'],
						'module_id' => 'userinfo',
						'product_id' => 'rael_userinfo',
						'version_id' => PhpFox::getId(),
						'var_name' => 'field_'.strtolower(str_replace(' ','_',$aVals['name'])),
						'text' => $sText,
						'text_default' => $sText,
						'added' => PHPFOX_TIME
					)
				);
			}
			
			$this->cache()->remove('locale', 'substr');
						
			return $iId;
		}
		
		return false;

	}
	
	public function moveFieldUp($iCatId)
	{
		$iCatPos = $this->database()->select('`position`')
				->from(Phpfox::getT('employment_order'))
				->where('id = '.$iCatId)
				->execute('getField');
		
		$aOtherCat = $this->database()->select('`id`,`position`')
				->from(Phpfox::getT('employment_order'))
				->where('`position` < '.$iCatPos)
				->order('`position` DESC')
				->limit(1)
				->execute('getRow');		
		
		$this->database()->update(Phpfox::getT('employment_order'), array('position' => $iCatPos), 'id = '.$aOtherCat['id']);
		$this->database()->update(Phpfox::getT('employment_order'), array('position' => $aOtherCat['position']), 'id = '.$iCatId);
		
		return true;
	}
	
	public function moveFieldDown($iCatId)
	{
		$iCatPos = $this->database()->select('`position`')
				->from(Phpfox::getT('employment_order'))
				->where('id = '.$iCatId)
				->execute('getField');
		
		$aOtherCat = $this->database()->select('`id`,`position`')
				->from(Phpfox::getT('employment_order'))
				->where('`position` > '.$iCatPos)
				->order('`position` ASC')
				->limit(1)
				->execute('getRow');		
		
		$this->database()->update(Phpfox::getT('employment_order'), array('position' => $iCatPos), 'id = '.$aOtherCat['id']);
		$this->database()->update(Phpfox::getT('employment_order'), array('position' => $aOtherCat['position']), 'id = '.$iCatId);
		
		return true;
	}	
	
	
	public function deleteSelected($aIds)
	{
		foreach ($aIds as $sId)
		{
			$aPieces = explode('|',$sId);
			$this->database()->delete(Phpfox::getT('employment_order'), 'id = ' . (int) $aPieces[0]);	
			$this->database()->query('ALTER TABLE `'.Phpfox::getT('employment').'` DROP COLUMN `'.$aPieces[1].'`');	
			$this->database()->delete(Phpfox::getT('language_phrase'), '`var_name` = "field_' . $aPieces[1].'"');		
		}
		return true;
	}	
	
	public function updateFields($aSelects, $iType)
	{
		if($iType == 1)
		{
			foreach ($aSelects as $iId => $aSelect)
			{
				$this->database()->update(Phpfox::getT('employment_order'), array('required' => (isset($aSelect['required']) ? '1' : '0')), 'id = ' . (int) $iId);
			}
		}
		elseif($iType == 2)
		{
			foreach ($aSelects as $iId => $aSelect)
			{
				$this->database()->update(Phpfox::getT('employment_order'), array('searchable' => (isset($aSelect['search']) ? '1' : '0')), 'id = ' . (int) $iId);
			}
		}
		
		return true;
	}
	
	public function _verifyField($aVals)
	{
		if (strlen($aVals['name']) > 128)
		{
			Phpfox_Error::set(Phpfox::getPhrase('userinfo.field_too_long'));
			return false;
		}
		
		return true;
	}
	
}

?>
