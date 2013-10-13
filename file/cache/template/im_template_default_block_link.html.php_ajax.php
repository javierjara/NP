<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:25 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: link.html.php 2835 2011-08-16 11:26:13Z Miguel_Espinoza $
 */

?>
<li class="js_cache_im_room js_cache_im_list<?php if (isset ( $this->_aVars['bIsNewRoom'] )): ?> js_is_new_room<?php endif; ?>" id="js_cache_im_room_<?php echo $this->_aVars['aRoom']['parent_id']; ?>">		
	<div id="js_messages_<?php echo $this->_aVars['aRoom']['parent_id']; ?>" class="js_messages"></div>
	<div id="js_link_<?php echo $this->_aVars['aRoom']['parent_id']; ?>" class="js_im_link">		
		<span title="<?php echo Phpfox::getPhrase('im.close'); ?>" class="im_delete_button"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/im_close.png','class' => 'v_middle')); ?></span>
		<a href="#" onclick="clickOnLink(<?php echo $this->_aVars['aRoom']['parent_id']; ?>); return false;">
			<span class="im_ajax_button"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => "ajax_add_gif")); ?></span>			
<?php if ($this->_aVars['aRoom']['is_logged_in'] == 0): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => 'user_is_offline','class' => 'v_middle bullet_red')); ?>
<?php else: ?>
<?php if ($this->_aVars['aRoom']['im_status'] == '1'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_yellow.png','class' => 'v_middle')); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => 'user_is_online','class' => 'v_middle bullet_green')); ?>
<?php endif; ?>
<?php endif; ?>
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aRoom']['full_name']), 15, '...'); ?>
		</a>
	</div>
</li>
