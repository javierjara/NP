<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: message.html.php 3344 2011-10-24 14:21:16Z Miguel_Espinoza $
 */
 
 

?>
<div class="js_im_latest_message">
<?php if (count((array)$this->_aVars['aMessages'])):  $this->_aPhpfoxVars['iteration']['messages'] = 0;  foreach ((array) $this->_aVars['aMessages'] as $this->_aVars['aMessage']):  $this->_aPhpfoxVars['iteration']['messages']++; ?>

		<?php
						Phpfox::getLib('template')->getBuiltFile('im.block.text');						
						?>			
<?php endforeach; endif; ?>
	<div id="js_latest_message"></div>		
<?php if (! $this->_aVars['bLoggedIn']): ?>
	<div class="error_message">
<?php echo Phpfox::getPhrase('im.member_is_offline'); ?>
	</div>
<?php endif; ?>
</div>
