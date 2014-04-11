<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class YouNetCore_Service_verify extends Phpfox_Service 
{
	/**
	 * Class constructor
	 */	
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('younetcore_license');
		$this->_oService = phpfox::getService('younetcore.core');
	}	
	
	public function verified($aVals,$product_id ="")
	{
		if($product_id == "")
		{
			return false;
		}
		$status = 1;
		$aCheckProduct = $this->_oService->getYNProduct($product_id);
		if($aCheckProduct != false && count($aCheckProduct)>0)
		{
			$aCheckProduct['params'] = serialize($aVals);
			$aCheckProduct['is_active'] = $status;
			$this->_oService->updateYNProduct($aCheckProduct);
			$this->_oService->updateProduct($product_id,$status);
			$this->_oService->rmc();
		}
	 	
	}
	public function verifyModules()
	{
		
	}
	
	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('younetcore.service_process__call'))
		{
			return eval($sPlugin);
		}
		
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}

?>