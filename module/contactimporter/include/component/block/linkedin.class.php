<?php
/*
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Development
 * @package          Module_Contactimporter
 * @version          2.06
 *
 */
defined('PHPFOX') or exit('NO DICE!');
?>
<?php
 if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'linkedin_2.1.0.class.php'))
{
    
    require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'linkedin_2.1.0.class.php');  
    
}
class Contactimporter_Component_Block_Linkedin extends Phpfox_Component
{	
	public function process()
	{

		$this->template()->assign(array('typeLinkedIn'=>linkedin_API::_GET_TYPE,'core_path'=>phpfox::getParam('core.path')));	 
		
	}
}

?>