<?php
 
class Userinfo_Component_Controller_Admincp_Index extends Phpfox_Component
{
	public function process()
	{	
		$oDatabase = Phpfox::getLib('database');
		
		$iUserTotal = $oDatabase->select('COUNT(DISTINCT(`user_id`))')
    		->from(Phpfox::getT('employment'))
        ->execute('getField');
		
		$iEmpTotal = $oDatabase->select('COUNT(`id`)')
    		->from(Phpfox::getT('employment'))
        ->execute('getField');
        
    $iEdUserTotal = $oDatabase->select('COUNT(DISTINCT(`user_id`))')
    		->from(Phpfox::getT('education'))
        ->execute('getField');
		
		$iEdTotal = $oDatabase->select('COUNT(`id`)')
    		->from(Phpfox::getT('education'))
        ->execute('getField');
		
		$this->template()->setTitle(Phpfox::getPhrase('userinfo.statistics'))
				->setBreadcrumb(Phpfox::getPhrase('userinfo.statistics'))
				->assign(array(
					'iUserTotal' 		=> $iUserTotal,
					'iEmpTotal' 		=> $iEmpTotal,
					'iEdUserTotal' 		=> $iEdUserTotal,
					'iEdTotal' 		=> $iEdTotal,
				));
	}
}
 
?>