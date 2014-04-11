<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Education extends Phpfox_Service
{	
	public function getEducations($aVals, $aUrls, $iPage, $iLimit)
	{
		$aCond = array();
		$aFieldNames = $this->getFieldNames();
		$oParseInput = Phpfox::getLib('parse.input');	
		
		if (count($aUrls) > 0)
		{
			if (array_key_exists('class-year',$aUrls) && is_numeric($aUrls['class-year']))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '(b.`class_year` = '. $aUrls['class-year'] .')';
			}
			
			if (array_key_exists('is-present',$aUrls))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'b.`is_present` = 1';
			}
			
			if (array_key_exists('attended-for',$aUrls))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`attended_for` = '.$aUrls['attended-for'];
			}
			
			if (array_key_exists('user',$aUrls))
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`user_id` = ' . $aUrls['user'];
			}
			
			foreach($aUrls as $sKey => $sUrl)
			{
				if ($sKey != 'class-year' && $sKey != 'is-present' && $sKey != 'attended-for')
				{
					if (array_key_exists($sKey,$aFieldNames))
					{
						if (Phpfox::getParam('userinfo.edu_search_type') == 'Strict')
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
			if ($aVals['class_year'] > 0)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . '(b.`class_year` = '. $aVals['class_year'] .')';
			}
			
			if (isset($aVals['is_present']) && $aVals['is_present'] == 1)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'b.`is_present` = 1';
			}
			
			if ($aVals['attended_for'] > 0)
			{
				$aCond[] = (count($aCond) > 0 ? 'AND ' : '') . 'a.`attended_for` = ' . $aVals['attended_for'];
			}
			
			foreach($aVals as $sKey => $sVal)
			{
				if ($sKey != 'class_year' && $sKey != 'is_present' && $sKey != 'attended_for')
				{
					if (array_key_exists($sKey,$aFieldNames))
					{
						if ($sVal != '')
						{
							if (Phpfox::getParam('userinfo.edu_search_type') == 'Strict')
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
				->from(Phpfox::getT('education'),'a')
				->join(Phpfox::getT('education_dates'),'b', 'b.`education_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where($aCond)
				->execute('getField');
			
		$iOffset = Phpfox::getLib('pager')->getOffset($iPage, $iLimit, $iCnt);
		
		$aEducations = $this->database()->select('a.*, b.`class_year`, b.`is_present`, c.`full_name`,c.`user_name`, c.`user_image`,c.`server_id`')
				->from(Phpfox::getT('education'),'a')
				->join(Phpfox::getT('education_dates'),'b', 'b.`education_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where($aCond)
				->order('b.`is_present` DESC, b.`class_year` DESC')
				->limit($iOffset.','.$iLimit)
				->execute('getRows');
				
		foreach($aEducations as $aKey => $aEducation)
		{
			foreach($aEducation as $sSubKey => $sEduItem)
			{
				if ($sSubKey != 'month_from' && $sSubKey != 'year_from' && $sSubKey != 'month_to' && $sSubKey != 'year_to' && $sSubKey != 'is_present' && $sSubKey != 'full_name' && $sSubKey != 'user_name' && $sSubKey != 'user_image' && $sSubKey != 'server_id' && $sSubKey != 'id' && $sSubKey != 'user_id' && $sSubKey != 'time'  && $sSubKey != 'date')
				{
					$iType = $this->database()->select('`type`')
											->from(Phpfox::getT('education_order'))
											->where('`name` = "'.$sSubKey.'"')
											->execute('getField');
											
					if ($iType == 1)
					{						
						if ($sEduItem != '')
						{
							$aPieces = explode(',',$sEduItem);
							$aEducations[$aKey][$sSubKey] = $aPieces;
						}
						
						else 
						{
							$aEducations[$aKey][$sSubKey] = '';
						}
					}
				}
			}
			
			$aEducations[$aKey]['image'] = Phpfox::getLib('image.helper')->display(array(
							'server_id' => $aEducation['server_id'],
							'title' => $aEducation['full_name'],
							'path' => 'core.url_user',
							'file' => $aEducation['user_image'],
							'suffix' => '_75',
							'max_width' => 75,
							'max_height' => 75
			));
		} 
				
		return array($iCnt,$aEducations);
	}
	
	public function getUserEducations($iUserId, $iPage, $iLimit, $iEduId = 0)
	{
		$iCnt = $this->database()->select('COUNT(`id`)')
				->from(Phpfox::getT('education'))
				->where('`user_id` = '. (int) $iUserId . ($iEduId > 0 ? ' AND id= '. $iEduId : ''))
				->execute('getField');
			
		$iOffset = Phpfox::getLib('pager')->getOffset($iPage, $iLimit, $iCnt);
		
		$aEducations = $this->database()->select('a.*, b.`class_year`, b.`is_present`, c.`full_name`')
				->from(Phpfox::getT('education'),'a')
				->join(Phpfox::getT('education_dates'),'b', 'b.`education_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where('a.`user_id` = '. (int) $iUserId . ($iEduId > 0 ? ' AND a.id= '. $iEduId : ''))
				->order('b.`is_present` DESC, b.`class_year` DESC')
				->limit($iOffset.','.$iLimit)
				->execute('getRows');
				
		foreach($aEducations as $aKey => $aEducation)
		{
			foreach($aEducation as $sSubKey => $sEduItem)
			{
				if ($sSubKey != 'month_from' && $sSubKey != 'year_from' && $sSubKey != 'month_to' && $sSubKey != 'year_to' && $sSubKey != 'is_present' && $sSubKey != 'full_name' && $sSubKey != 'user_name' && $sSubKey != 'user_image' && $sSubKey != 'server_id' && $sSubKey != 'id' && $sSubKey != 'user_id' && $sSubKey != 'time'  && $sSubKey != 'date')
				{
					$iType = $this->database()->select('`type`')
											->from(Phpfox::getT('education_order'))
											->where('`name` = "'.$sSubKey.'"')
											->execute('getField');
											
					if ($iType == 1)
					{						
						if ($sEduItem != '')
						{
							$aPieces = explode(',',$sEduItem);
							$aEducations[$aKey][$sSubKey] = $aPieces;
						}
						
						else 
						{
							$aEducations[$aKey][$sSubKey] = '';
						}
					}
				}
			}
		}
				
		return array($iCnt,$aEducations);
	}
	
	public function getEducationForEdit($iEduId)
	{
		$aEducation = $this->database()->select('a.*, b.`class_year`, b.`is_present`, c.`full_name`, c.`user_id`')
				->from(Phpfox::getT('education'),'a')
				->join(Phpfox::getT('education_dates'),'b', 'b.`education_id` = a.`id`')
				->join(Phpfox::getT('user'),'c','a.`user_id` = c.`user_id`')
				->where('a.`id` = '. (int) $iEduId)
				->execute('getRow');
		
		if ($aEducation['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
		{
			return $aEducation;
		}
		
		return false;
		
	}
	
	public function getProfileEducation($aUser)
	{
		if ($aEducation = $this->database()->select('a.`institution`, b.`is_present`')
				->from(Phpfox::getT('education'),'a')
				->join(Phpfox::getT('education_dates'),'b', 'b.`education_id` = a.`id`')
				->where('a.`user_id` = ' .(int) $aUser['user_id'])
				->order('b.`is_present` DESC, b.`class_year` DESC')
				->execute('getRow'))
		{
			return $aEducation;		
		}
		
		return false;
	}
	
	public function getFields($bIsSort = false)
	{
		$aFieldsData = $this->database()->getRows('SHOW COLUMNS FROM `'.Phpfox::getT('education').'`');
		$aFields = array();
		
		foreach ($aFieldsData as $aKey => $aField) 
		{
			if ($aField['Field'] == 'id' || $aField['Field'] == 'time' || $aField['Field'] == 'user_id')
			{
				unset($aFieldsData[$aKey]['Field']);
				continue;
			}
			
			$aFieldDetails = $this->database()->select('`id`,`type`,`required`,`searchable`,`position`')
													->from(Phpfox::getT('education_order'))
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
     
    list($nStart, $nEnd) = Phpfox::getService('userinfo.education')->getPos($iPage,$iFrameSize,$iPagesCount,$iPage);    
    
    if ($iPage != 1)
    {
    	$aPageParams['page'] = $nStart;
    	$aInfo['firstUrl'] = $oUrl->makeUrl('userinfo.education',$aPageParams);
    	
    	$aPageParams['page'] = ($iPage -1);
      $aInfo['prevUrl'] = $oUrl->makeUrl('userinfo.education',$aPageParams);     	
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
      	$aInfo['urls'][$oUrl->makeUrl('userinfo.education',$aPageParams)] = $i;
      }
    }
    
    if ($iPagesCount != $iPage)
    {  
    	$aPageParams['page'] = ($iPage + 1);     		   
      $aInfo['nextUrl'] = $oUrl->makeUrl('userinfo.education',$aPageParams);
      
			$aPageParams['page'] = $nEnd;     		
      $aInfo['lastUrl'] = $oUrl->makeUrl('userinfo.education',$aPageParams);    		
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
		$aFieldsData = $this->database()->getRows('SHOW COLUMNS FROM `'.Phpfox::getT('education').'`');
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
		
		if (array_key_exists('class-year',$aParams))
		{
			$aUrl['class-year'] = $aParams['class-year'];
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
	
}

?>
