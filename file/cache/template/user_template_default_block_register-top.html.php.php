<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: register-top.html.php 4480 2012-07-06 08:03:22Z Raymond_Benc $
 */
 
 

?>
		<div id="header_user_register">
			<div class="holder">
				<div id="header_user_register_holder">					
					<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.register'); ?>"><?php echo Phpfox::getPhrase('user.sign_up'); ?></a> 					
					<div>
<?php echo Phpfox::getPhrase('user.ssitetitle_helps_you_connect_and_share_with_the_people_in_your_life', array('sSiteTitle' => $this->_aVars['sSiteTitle'])); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
