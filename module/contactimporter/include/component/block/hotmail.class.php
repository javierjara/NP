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
class Contactimporter_Component_Block_Hotmail extends Phpfox_Component
{
	public function process()
	{		
		$this->template()->assign(array(
			'core_path'=>phpfox::getParam('core.path'),
			'tokenName' => Phpfox::getTokenName().'[security_token]',
			'sSecurityToken'=>Phpfox::getService('log.session')->getToken(),
		));
	}
}
?>