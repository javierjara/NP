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
class Contactimporter_Component_Block_Statistics extends Phpfox_Component
{    
	public function process()
	{		
		$max_invitation = $this->getParam('max_invitation');
		if (!$max_invitation)
		{
			$max_invitation = Phpfox::getService('contactimporter')->getMaxInvitation();
		}		
		$aStatistics = Phpfox::getService('contactimporter')->getStatistics();
		$iTotal = 0;
		if ($aStatistics)
		{
			$iTotal =$aStatistics['socials'] + $aStatistics['emails']; 
		}
		$this->template()->assign(array(
			'sHeader' => Phpfox::getPhrase('contactimporter.statistics'),
			'sDeleteBlock' => 'dashboard',
			'Ynscontactimporter.css' => 'module_contactimporter',
			'jquery.min.js' => 'module_contactimporter',
			'contactimporter.js' => 'module_contactimporter',
			'statistics' => $aStatistics ,
			'total_invitation' => $iTotal,
			'max_invitation' => $max_invitation
		));
		return 'block';
	}
}
?>