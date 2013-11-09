<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class YouNetCore_Service_Process extends Phpfox_Service 
{
	/**
	 * Class constructor
	 */	
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('younetcore');
	}	
	
	public function add($aVals)
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