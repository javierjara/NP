<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');
$sPathYNBase = PHPFOX_DIR.'module'.PHPFOX_DS.'younetcore'.PHPFOX_DS.'include'.PHPFOX_DS.'service'.PHPFOX_DS.'extras'.PHPFOX_DS.'ynbase.php';                                                                                                                                        

if(file_exists($sPathYNBase))
{
    if(!class_exists("ynbase"))
    {
        require_once($sPathYNBase);    
    }
}

class YouNetCore_Service_functions extends Phpfox_Service 
{
	/**
	 * Class constructor
	 */	
	public function __construct()
	{
		$this->_sTable = Phpfox::getT('younetcore');
		$this->_path = PHPFOX_DIR.'module'.PHPFOX_DS.'younetcore'.PHPFOX_DS.'include'.PHPFOX_DS.'service'.PHPFOX_DS.'extras'.PHPFOX_DS;
        $this->_oClass = null;
	}	
	
	public function add($aVals)
	{
		
	}
	public function oClass()
    {
        return $this->_oClass;
    }
	public function call($sMethod)
	{
		$aParts = explode('.',$sMethod);
		if(count($aParts) <= 0)
		{
			return false;
		}
		$sFileName = $this->_path.$aParts[0].PHPFOX_DS.$aParts[1].".php";
		if(file_exists($sFileName))
		{
            
			$sClass = $aParts[1];
			if(!class_exists($sClass))
			{
                require_once($sFileName);
                
				$oClass = new $sClass;
                $this->_oClass =  $oClass;
                return $oClass;
			}
			return true;
		}
		return false;
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