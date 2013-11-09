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
 
class contactimporter_Component_Controller_Admincp_providers extends Phpfox_Component
{
	public function process()
	{	
		
		$aTypes = array(
			'email' => 'Email',
			'social' => 'Social',
			'All'	 =>'All'
		);
		$aActive = array(
					'enable' => 'Enabled',
					'disable' => 'Disabled',
					'All'	 =>'All'
				);
		$aFilters = array(
			'name' => array(
				'type' => 'input:text',
				'search' => "name LIKE '%[VALUE]%'"
			),	
			'title' => array(
				'type' => 'input:text',
				'search' => "title LIKE '%[VALUE]%'"
			),						
			'type' => array(
				'type' => 'select',
				'options' => $aTypes,
				'default' => 'All',
				'search' =>"type LIKE '%[VALUE]%'"
			),
			'active' => array(
				'type' => 'select',
				'options' => $aActive,
				'default' => 'All',
				'search' =>"active LIKE '%[VALUE]%'"
				
			)
			
		);

		$oSearch = Phpfox::getLib('search')->set(array(
				'type' => 'contactimporter_providers',
				'filters' => $aFilters,
				'search' => 'search'
			)
		);
		if ( $this->request()->get('search-id'))
			$this->template()->assign(array('default'=>'no'));
		else
			$this->template()->assign(array('default'=>'yes'));
		$providers = Phpfox::getService('contactimporter')->getProviders($oSearch->getConditions());
		$this->template()
			->setHeader('cache', array(
				'quick_edit.js' => 'static_script',
				'jquery.tablednd_0_5.js' => 'module_contactimporter',
				'orderprovider.js'=>'module_contactimporter',
				'contactimporter.js'=>'module_contactimporter',
			)				
		);		
		$core_url = Phpfox::getParam('core.path');
		$this->template()->assign(array('core_url'=>$core_url));						
		$this->template()->assign(array('providers'=>$providers));
		$this->template()->setBreadCrumb('Providers', $this->url()->makeUrl('admincp.contactimporter.providers'));
	}
} 
?>