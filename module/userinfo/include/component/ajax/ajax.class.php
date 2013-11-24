<?php

defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Component_Ajax_Ajax extends Phpfox_Ajax
{

	public function delete()
	{
		Phpfox::isUser(true);
		
		$iType = $this->get('type');
		
		if (is_numeric($this->get('id')))
		{
			if($iType == 1)
			{
				if (Phpfox::getService('userinfo.process.employment')->deleteEmployment($this->get('id'), false))
				{
					$this->slideUp('#js_employment_' . $this->get('id').'_data');
					$this->slideUp('#js_employment_' . $this->get('id').'_space');
				}
			}
			elseif ($iType == 2)
			{
				if (Phpfox::getService('userinfo.process.education')->deleteEducation($this->get('id'), false))
				{
					$this->slideUp('#js_education_' . $this->get('id').'_data');
					$this->slideUp('#js_education_' . $this->get('id').'_space');
				}
			}
		}
		else
		{
			return false;
		}
		
	}
	
	public function edit()
	{
		Phpfox::isUser(true);
		
		$iType = $this->get('type');
		
		if (is_numeric($this->get('id')))
		{
			if($iType == 1)
			{
				$iId = $this->get('id');
				Phpfox::getBlock('userinfo.emedit', array('id' => $iId));
			}
			elseif ($iType == 2)
			{
				$iId = $this->get('id');
				Phpfox::getBlock('userinfo.ededit', array('id' => $iId));
			}
		}
		else
		{
			return false;
		}
		
		if($iType == 1)
		{
			$this->hide('#js_employment_'.$iId.'_data')
			->html('#js_employment_'.$iId.'_form', $this->getContent(false))
			->show('#js_employment_'.$iId.'_form')
			->focus('#employer'.$iId);
		}
		elseif ($iType == 2)
		{
			$this->hide('#js_education_'.$iId.'_data')
			->html('#js_education_'.$iId.'_form', $this->getContent(false))
			->show('#js_education_'.$iId.'_form')
			->focus('#institution'.$iId);
		}
	
	}
	
	public function update()
	{
		Phpfox::isUser(true);
		
		$iType = $this->get('type');
		
		$aVals = $this->get('val');
		if (is_numeric($this->get('id')))
		{
			$iId = $this->get('id');
		}
		else 
		{
			return false;
		}

		if($iType == 1)
		{
			if(!Phpfox::getService('userinfo.process.employment')->updateEmployment($aVals, $iId))
			{
				return false;
			}
			else
			{
				Phpfox::getBlock('userinfo.ementry', array('id' => $iId));
				
				$this->hide('#js_employment_'.$iId.'_form')
				->html('#js_employment_'.$iId.'_data', $this->getContent(false))
				->show('#js_employment_'.$iId.'_data');
			}
		}
		elseif($iType == 2)
		{
			if(!Phpfox::getService('userinfo.process.education')->updateEducation($aVals, $iId))
			{
				return false;
			}
			else
			{
				Phpfox::getBlock('userinfo.edentry', array('id' => $iId));
				
				$this->hide('#js_education_'.$iId.'_form')
				->html('#js_education_'.$iId.'_data', $this->getContent(false))
				->show('#js_education_'.$iId.'_data');
			}
		}
	}
	
	public function add()
	{
		Phpfox::isUser(true);
		
		$iType = $this->get('type');
		
		if($this->get('val'))
		{
			$aVals = $this->get('val');
		}
		else
		{
			return false;
		}
		
		if($iType == 1)
		{
			if(!Phpfox::getService('userinfo.process.employment')->addEmployment($aVals))
			{
				$this->hide('#js_employment_submit');
				return false;
			}
			else
			{
				$this->call('window.location.href = \'' . Phpfox::getLib('url')->makeUrl('userinfo.manage') . '\'');
			}
		}
		else if ($iType == 2)
		{
			if(!Phpfox::getService('userinfo.process.education')->addEducation($aVals))
			{
				$this->hide('#js_education_submit');
				return false;
			}
			else
			{
				$this->call('window.location.href = \'' . Phpfox::getLib('url')->makeUrl('userinfo.manage') . '\'');
			}
		}

		
	}
	
}

?>