<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Employment extends Phpfox_Service
{	
	public function getEmployments($aVals, $aUrls, $iPage, $iLimit)
	{
		$aCond = array();
		$aFieldNames = $this->getFieldNames();
		$oParseInput = Phpfox::getLib('parse.input');	
		
		if (count($aUrls) > 0)
		{
			if ((array_key_exists('month-from',$aUrls) && is_numeric($aUrls['month-from'])) && array_key_exists('year-from',$aUrls) && is_numeric($aUrls['year-from']))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '(b.`year_from` = '. $aUrls['year-from'] .' AND b.`month_from` >= '.$aUrls['month-from'].') OR (b.`year_from` > '. $aUrls['year-from'].')';
			}
			
			if ((array_key_exists('month-to',$aUrls) && is_numeric($aUrls['month-to'])) && array_key_exists('year-to',$aUrls) && is_numeric($aUrls['year-to']))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '((b.`year_to` = '. $aUrls['year-to'] .' AND b.`month_to` <= '.$aUrls['month-to'].') OR (b.`year_to` < '. $aUrls['year-to'].') AND b.`is_present` = 0)';
			}
			
			if (array_key_exists('is-present',$aUrls))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'b.`is_present` = 1';
			}
			
			if (array_key_exists('user',$aUrls))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`user_id` = ' . $aUrls['user'];
			}
			
			foreach($aUrls as $sKey => $sUrl)
			{
				if ($sKey != 'month-from' && $sKey != 'year-from' && $sKey != 'month-to' && $sKey != 'year-to' && $sKey != 'is-present')
				{
					if (array_key_exists($sKey,$aFieldNames))
					{
						if (Phpfox::getParam('userinfo.emp_search_type') == 'Strict')
						{
							$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`'.str_replace('-','_',$sKey).'` LIKE "%'.$oParseInput->clean($sUrl).'%"';
						}
						else
						{
							$sSql = (count($aCond) > 0 ? 'AND (' : '(');
	
							$aPieces = explode(' ',$sUrl);
	
							foreach ($aPieces as $iKey => $sPiece)
							{
								if ($sPiece != '')
								{
									$sSql .= ($iKey > 0 ? 'OR ' : '') . 'a.`'.str_replace('-','_',$sKey).'` LIKE "%'.$oParseInput->clean($sPiece).'%"';
								}
							}
							$sSql .= ')';
							
							$aCond[] = $sSql;
						}
					}
				}
			}
		}
		
		if (count($aVals) > 0)
		{
			if ($aVals['month_from'] > 0 || $aVals['year_from'] > 0)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '(b.`year_from` = '. ($aVals['year_from'] == 0 ? date('Y') : $aVals['year_from']) .' AND b.`month_from` >= '. ($aVals['month_from'] == 0 ? 01 : $aVals['month_from']) .') OR (b.`year_from` > '. ($aVals['year_from'] == 0 ? date('Y') : $aVals['year_from']).')';
			}
			
			if ($aVals['month_to'] > 0 || $aVals['year_to'] > 0)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '((b.`year_to` = '. ($aVals['year_to'] == 0 ? date('Y') : $aVals['year_to']) .' AND b.`month_to` <= '. ($aVals['month_to'] == 0 ? 12 : $aVals['month_to']) .') OR (b.`year_to` < '. ($aVals['year_to'] == 0 ? date('Y') : $aVals['year_to']).') AND b.`is_present` = 0)';
			}
			
			if (isset($aVals['is_present']) && $aVals['is_present'] == 1)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'b.`is_present` = 1';
			}
			
			foreach($aVals as $sKey => $sVal)
			{
				if ($sKey != 'month_from' && $sKey != 'year_from' && $sKey != 'month_to' && $sKey != 'year_to' && $sKey != 'is_present')
				{
					if (array_key_exists($sKey,$aFieldNames))
					{
						if ($sVal != '')
						{
							if (Phpfox::getParam('userinfo.emp_search_type') == 'Strict')
							{
								$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`'.str_replace('-','_',$sKey).'` LIKE "%'.$oParseInput->clean($sVal).'%"';
							}
							else
							{
								$sSql = (count($aCond) > 0 ? 'AND (' : '(');
	
								$aPieces = explode(' ',$sVal);
		
								foreach ($aPieces as $iKey => $sPiece)
								{
									if ($sPiece != '')
									{
										$sSql .= ($iKey > 0 ? 'OR ' : '') . 'a.`'.str_replace('-','_',$sKey).'` LIKE "%'.$oParseInput->clean($sPiece).'%"';
									}
								}
								$sSql .= ')';
								
								$aCond[] = $sSql;
							}	
						}
					}
				}
			}
		}
		
		$iCnt = $this->database()->select('COUNT(a.`id`)')
				->from(Phpfox::getT('employment'),'a')
				->join(Phpfox::getT('employment_dates'),'b', 'b.`employment_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where($aCond)
				->execute('getField');
			
		$iOffset = Phpfox::getLib('pager')->getOffset($iPage, $iLimit, $iCnt);
		
		$aEmployments = $this->database()->select('a.*, b.`month_from`, b.`year_from`, b.`month_to`, b.`year_to`, b.`is_present`, c.`full_name`,c.`user_name`, c.`user_image`,c.`server_id`')
				->from(Phpfox::getT('employment'),'a')
				->join(Phpfox::getT('employment_dates'),'b', 'b.`employment_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where($aCond)
				->order('b.`is_present` DESC, b.`year_to` DESC, b.`month_to` ASC, b.`year_from` DESC, b.`month_from` ASC')
				->limit($iOffset.','.$iLimit)
				->execute('getRows');
				
		foreach($aEmployments as $aKey => $aEmployment)
		{
			foreach($aEmployment as $sSubKey => $sEmployItem)
			{
				if ($sSubKey != 'month_from' && $sSubKey != 'year_from' && $sSubKey != 'month_to' && $sSubKey != 'year_to' && $sSubKey != 'is_present' && $sSubKey != 'full_name' && $sSubKey != 'user_name' && $sSubKey != 'user_image' && $sSubKey != 'server_id' && $sSubKey != 'id' && $sSubKey != 'user_id' && $sSubKey != 'time'  && $sSubKey != 'date')
				{
					$iType = $this->database()->select('`type`')
											->from(Phpfox::getT('employment_order'))
											->where('`name` = "'.$sSubKey.'"')
											->execute('getField');
											
					if ($iType == 1)
					{						
						if ($sEmployItem != '')
						{
							$aPieces = explode(',',$sEmployItem);
							$aEmployments[$aKey][$sSubKey] = $aPieces;
						}
						
						else 
						{
							$aEmployments[$aKey][$sSubKey] = '';
						}
					}
				}
			}
			
			$aEmployments[$aKey]['month_from_str'] = $this->getMonthByNum($aEmployment['month_from'],$this->getMonths());

			if ($aEmployment['month_to'] != 0)
			{
				$aEmployments[$aKey]['month_to_str'] = $this->getMonthByNum($aEmployment['month_to'],$this->getMonths());
			}
			
			$aEmployments[$aKey]['image'] = Phpfox::getLib('image.helper')->display(array(
							'server_id' => $aEmployment['server_id'],
							'title' => $aEmployment['full_name'],
							'path' => 'core.url_user',
							'file' => $aEmployment['user_image'],
							'suffix' => '_75',
							'max_width' => 75,
							'max_height' => 75
			));
		} 
				
		return array($iCnt,$aEmployments);
	}
	
	public function getUserEmployments($iUserId, $iPage, $iLimit, $iEmpId = 0)
	{
		$iCnt = $this->database()->select('COUNT(`id`)')
				->from(Phpfox::getT('employment'))
				->where('`user_id` = '. (int) $iUserId . ($iEmpId > 0 ? ' AND id= '. $iEmpId : ''))
				->execute('getField');
			
		$iOffset = Phpfox::getLib('pager')->getOffset($iPage, $iLimit, $iCnt);
		
		$aEmployments = $this->database()->select('a.*, b.`month_from`, b.`year_from`, b.`month_to`, b.`year_to`, b.`is_present`, c.`full_name`')
				->from(Phpfox::getT('employment'),'a')
				->join(Phpfox::getT('employment_dates'),'b', 'b.`employment_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where('a.`user_id` = '. (int) $iUserId . ($iEmpId > 0 ? ' AND a.id= '. $iEmpId : ''))
				->order('b.`is_present` DESC, b.`year_to` DESC, b.`month_to` ASC, b.`year_from` DESC, b.`month_from` ASC')
				->limit($iOffset.','.$iLimit)
				->execute('getRows');
				
		foreach($aEmployments as $aKey => $aEmployment)
		{
			foreach($aEmployment as $sSubKey => $sEmployItem)
			{
				if ($sSubKey != 'month_from' && $sSubKey != 'year_from' && $sSubKey != 'month_to' && $sSubKey != 'year_to' && $sSubKey != 'is_present' && $sSubKey != 'full_name' && $sSubKey != 'user_name' && $sSubKey != 'user_image' && $sSubKey != 'server_id' && $sSubKey != 'id' && $sSubKey != 'user_id' && $sSubKey != 'time'  && $sSubKey != 'date')
				{
					$iType = $this->database()->select('`type`')
											->from(Phpfox::getT('employment_order'))
											->where('`name` = "'.$sSubKey.'"')
											->execute('getField');
											
					if ($iType == 1)
					{						
						if ($sEmployItem != '')
						{
							$aPieces = explode(',',$sEmployItem);
							$aEmployments[$aKey][$sSubKey] = $aPieces;
						}
						
						else 
						{
							$aEmployments[$aKey][$sSubKey] = '';
						}
					}
				}
			}
			
			$aEmployments[$aKey]['month_from_str'] = $this->getMonthByNum($aEmployment['month_from'],$this->getMonths());

			if ($aEmployment['month_to'] != 0)
			{
				$aEmployments[$aKey]['month_to_str'] = $this->getMonthByNum($aEmployment['month_to'],$this->getMonths());
			}
		} 
				
		return array($iCnt,$aEmployments);
	}
	
	public function getEmploymentForEdit($iEmpId)
	{
		$aEmployment = $this->database()->select('a.*, b.`month_from`, b.`year_from`, b.`month_to`, b.`year_to`, b.`is_present`, c.`full_name`, c.`user_id`')
				->from(Phpfox::getT('employment'),'a')
				->join(Phpfox::getT('employment_dates'),'b', 'b.`employment_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where('a.`id` = '. (int) $iEmpId)
				->execute('getRow');
		
		if ($aEmployment['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
		{
			return $aEmployment;
		}
		
		return false;
		
	}

	
	public function getProfileEmployment($aUser)
	{
		if ($aEmployment = $this->database()->select('a.`employer`')
				->from(Phpfox::getT('employment'),'a')
				->join(Phpfox::getT('employment_dates'),'b', 'b.`employment_id` = a.`id`')
				->where('a.`user_id` = ' .(int) $aUser['user_id'] .' AND b.`is_present` = 1')
				->order('b.`is_present` DESC, b.`year_to` DESC, b.`month_to` ASC, b.`year_from` DESC, b.`month_from` ASC')
				->execute('getRow'))
		{
			return $aEmployment['employer'];		
		}
		
		return false;
	}
	
	public function getFields($bIsSort = false)
	{
		$aFieldsData = $this->database()->getRows('SHOW COLUMNS FROM `'.Phpfox::getT('employment').'`');
		$aFields = array();
		
		foreach ($aFieldsData as $aKey => $aField) 
		{
			if ($aField['Field'] == 'id' || $aField['Field'] == 'time' || $aField['Field'] == 'user_id')
			{
				unset($aFieldsData[$aKey]['Field']);
				continue;
			}
			
			$aFieldDetails = $this->database()->select('`id`,`type`,`required`,`searchable`,`position`')
													->from(Phpfox::getT('employment_order'))
													->where('`name` = "'.$aField['Field'].'"')
													->execute('getRow');
			
			$aFields[] = array(
				'id' => $aFieldDetails['id'],
				'name' => $aField['Field'],
				'rep_name' => Phpfox::getPhrase('userinfo.field_'.$aField['Field']),
				'ucname' => ucwords(str_replace('_',' ',$aField['Field'])),
				'url_name' => str_replace('_','-',$aField['Field']),
				'type' => $aFieldDetails['type'],
				'required' => $aFieldDetails['required'],
				'searchable' => $aFieldDetails['searchable'],
				'position' => $aFieldDetails['position'],
			);
		}

		uasort($aFields,'fieldsSort');
		
		if ($bIsSort)
		{
			foreach($aFields as $aKey => $aValue)
			{
				$aSortArray[] = $aFields[$aKey];
			}
			return $aSortArray;
		}
		else {
			return $aFields;
		}		
		
		return false;
	}
	
	public function getPager($iCnt,$iPage,$iPageSize,$aPageParams)
	{
		$oUrl = Phpfox::getLib('url');
		
		$iCnt = max(intval($iCnt), 0);
		$iPagesCount = ceil($iCnt / $iPageSize);
		$iPage = max(1, min($iPagesCount, intval($iPage)));
    $iFirstRow  = $iPageSize*($iPage-1);
    $iLastRow  = min($iFirstRow + $iPageSize, $iCnt);
    $iFrameSize  = 5;
    
    $aInfo = array(
        'totalPages' => $iPagesCount,
        'totalRows'  => $iCnt,
        'current'    => $iPage,
        'fromRow'    => $iFirstRow+1,
        'toRow'      => $iLastRow,
     ); 
     
    list($nStart, $nEnd) = Phpfox::getService('userinfo.employment')->getPos($iPage,$iFrameSize,$iPagesCount,$iPage);    
    
    if ($iPage != 1)
    {
    	$aPageParams['page'] = $nStart;
    	$aInfo['firstUrl'] = $oUrl->makeUrl('userinfo.employment',$aPageParams);
    	
    	$aPageParams['page'] = ($iPage -1);
      $aInfo['prevUrl'] = $oUrl->makeUrl('userinfo.employment',$aPageParams);     	
    }     
   
    for ($i = $nStart; $i <= $nEnd; $i++)
    {
      if ($iPage == $i)
      {
          $aInfo['urls'][''] = $i;
      }
      else
      { 
      	$aPageParams['page'] = $i;       	
      	$aInfo['urls'][$oUrl->makeUrl('userinfo.employment',$aPageParams)] = $i;
      }
    }
    
    if ($iPagesCount != $iPage)
    {  
    	$aPageParams['page'] = ($iPage + 1);     		   
      $aInfo['nextUrl'] = $oUrl->makeUrl('userinfo.employment',$aPageParams);
      
			$aPageParams['page'] = $nEnd;     		
      $aInfo['lastUrl'] = $oUrl->makeUrl('userinfo.employment',$aPageParams);    		
    }
    
    return $aInfo;  
	}
	
	private function getPos($iPage,$iFrameSize,$iPagesCount,$iPage)
  {
    $nStart = 1;
    if (($iPage - $iFrameSize/2) > 0)
    {
        if (($iPage + $iFrameSize/2) > $iPagesCount)
        {
            $nStart = (($iPagesCount - $iFrameSize)>0) ? ( $iPagesCount - $iFrameSize + 1) : 1;
        }
        else
        {
            $nStart = $iPage - floor($iFrameSize/2);
        }
    }

    $nEnd = (($nStart + $iFrameSize - 1) < $iPagesCount) ? ($nStart + $iFrameSize - 1) : $iPagesCount;
    
    return array($nStart, $nEnd);
  }    
	
	public function getFieldNames()
	{
		$aFieldsData = $this->database()->getRows('SHOW COLUMNS FROM `'.Phpfox::getT('employment').'`');
		$aFields = array();
		
		foreach ($aFieldsData as $aKey => $aField) 
		{
			if ($aField['Field'] != 'id' && $aField['Field'] != 'time' && $aField['Field'] != 'user_id' && $aField['Field'] != 'date')
			{
				$aFields[$aField['Field']] = $aField['Field'];
			}
		}
		
		return $aFields;
	}
	
	public function getSearchParams($aParams)
	{
		$aFields = $this->getFields();
		$aUrl = array();
		
		foreach($aFields as $iKey => $aField)
		{
			if (array_key_exists(str_replace('_','-',$aField['name']),$aParams))
			{
				$aUrl[str_replace('_','-',$aField['name'])] = urldecode(stripslashes($aParams[str_replace('_','-',$aField['name'])]));
			}
		}
		
		if (array_key_exists('month-from',$aParams))
		{
			$aUrl['month-from'] = $aParams['month-from'];
		}
		
		if (array_key_exists('year-from',$aParams))
		{
			$aUrl['year-from'] = $aParams['year-from'];
		}
		
		if (array_key_exists('month-to',$aParams))
		{
			$aUrl['month-to'] = $aParams['month-to'];
		}
		
		if (array_key_exists('year-to',$aParams))
		{
			$aUrl['year-to'] = $aParams['year-to'];
		}
		
		if (array_key_exists('is-present',$aParams))
		{
			$aUrl['is-present'] = $aParams['is-present'];
		}
		
		if (array_key_exists('user',$aParams))
		{
			$aUrl['user'] = $aParams['user'];
		}
		
		return $aUrl;
	}
	
		public function getYears() 
	{
		$aYears = array();
	  $iYear = date('Y');
	  $aYears[] = Phpfox::getPhrase('userinfo.year');
	  for ($i = $iYear; $i >= ($iYear - 70); $i--)
	  {
	      $aYears[$i] = $i;
	  }
	  
	  return $aYears;
	}
	
	public function getMonths() 
	{
		$aMonths = array(
	  	'0' => Phpfox::getPhrase('userinfo.month'),
	  	'01' => Phpfox::getPhrase('userinfo.jan'),
	  	'02' => Phpfox::getPhrase('userinfo.feb'),
	  	'03' => Phpfox::getPhrase('userinfo.mar'),
	  	'04' => Phpfox::getPhrase('userinfo.apr'),
	  	'05' => Phpfox::getPhrase('userinfo.may'),
	  	'06' => Phpfox::getPhrase('userinfo.jun'),
	  	'07' => Phpfox::getPhrase('userinfo.jul'),
	  	'08' => Phpfox::getPhrase('userinfo.aug'),
	  	'09' => Phpfox::getPhrase('userinfo.sep'),
	  	'10' => Phpfox::getPhrase('userinfo.oct'),
	  	'11' => Phpfox::getPhrase('userinfo.nov'),
	  	'12' => Phpfox::getPhrase('userinfo.dec'),
	  );
		
		return $aMonths;
	}
	
	public function getMonthByNum($iMonth,$aMonths)
	{
		return $aMonths[$iMonth];
	}

}

?>
