<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox_Component
 * @version 		$Id: mobile.class.php 6062 2013-06-15 14:18:13Z Raymond_Benc $
 */
class Profile_Component_Block_Mobile extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		if (!defined('PHPFOX_IS_USER_PROFILE'))
		{
			return false;
		}
		
		$aUser = $this->getParam('aUser');

		$aUserInfo = array(
			'title' => $aUser['full_name'],
			'path' => 'core.url_user',
			'file' => $aUser['user_image'],
			'suffix' => '_50_square',
			'max_width' => 75,
			'max_height' => 75,
			'no_default' => (Phpfox::getUserId() == $aUser['user_id'] ? false : true),
			'thickbox' => true,
        	'class' => 'profile_user_image'
		);			
		
		$sImage = Phpfox::getLib('image.helper')->display(array_merge(array('user' => Phpfox::getService('user')->getUserFields(true, $aUser)), $aUserInfo));

		$bIsInfo = false;
		if((isset($aUser['landing_page']) && ($aUser['landing_page'] == 'info') && Phpfox::getLib('request')->get('req2') != 'wall')
			|| (Phpfox::getLib('request')->get('req2') == 'info' )
		)
		{
			$bIsInfo = true;
		}

		$this->template()->assign(array(
				'sProfileImage' => $sImage,
				'bIsInfo' => $bIsInfo,
				'bCanPoke' => Phpfox::isModule('poke') && Phpfox::getService('poke')->canSendPoke($aUser['user_id'])
			)
		);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('profile.component_block_mobile_clean')) ? eval($sPlugin) : false);
	}
}

?>