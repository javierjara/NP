<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: chat.html.php 4156 2012-05-08 14:12:50Z Miguel_Espinoza $
 */
 
 

?>
<script type="text/javascript">var bChatImIsClicked = false;</script>
<div class="im_holder js_footer_holder js_im_room_holder" id="js_chat_room_<?php echo $this->_aVars['aChat']['parent_id']; ?>">
	<div class="im_header" onclick="if (bChatImIsClicked === false) { minimizeChat(<?php echo $this->_aVars['aChat']['parent_id']; ?>); }">
		<div class="im_in_chat_menu">
			<div class="im_in_chat_menu_holder">
				<a href="#" onclick="bChatImIsClicked = true; $(this).parents('.im_header').find('.im_in_chat_menu_bar:first').slideToggle('fast', function(){ bChatImIsClicked = false; }); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/im_option.png','class' => 'v_middle')); ?></a>
				<a href="#" onclick="closeChat(<?php echo $this->_aVars['aChat']['parent_id']; ?>); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/im_close.png','class' => 'v_middle')); ?></a>
				<div class="clear"></div>
			</div>
		</div>		
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aChat']['full_name']), 15, '...'); ?>
		<div class="im_in_chat_menu_bar">		
			<a class="first" href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('im.report_this_user', array('phpfox_squote' => true)); ?>', $.ajaxBox('report.add', 'height=210&width=400&type=user&id=<?php echo $this->_aVars['aChat']['user_id']; ?>')); return false;"><?php echo Phpfox::getPhrase('im.report_this_user'); ?></a>
			<a href="#" onclick="return $Core.im.block('<?php echo $this->_aVars['aChat']['parent_id']; ?>');"><?php echo Phpfox::getPhrase('im.block_this_user'); ?></a>						
			<a href="#" onclick="var e = arguments[0] || window.event; $Core.im.clearConversation('<?php echo $this->_aVars['aChat']['parent_id']; ?>'); e.cancelBubble = true; e.stopPropagation(); return false;"><?php echo Phpfox::getPhrase('im.clear_this_conversation'); ?></a>
		</div>		
	</div>
	<div id="js_im_content">
		<div id="js_im_messages_<?php echo $this->_aVars['aChat']['parent_id']; ?>" style="padding:4px;">
<?php Phpfox::getBlock('im.message', array()); ?>
		</div>
	</div>
	<div class="im_text_form">		
		<div class="im_text_form_img"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/im_chat_textarea.png')); ?></div>
		<form method="post" action="#" id="js_im_temp_form">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="val[parent_id]" value="<?php echo $this->_aVars['aChat']['parent_id']; ?>" /></div>
			<textarea cols="20" rows="4" name="val[text]" id="js_im_text" onkeyup="$Core.im.onKeyUp(event);"></textarea>			
		
</form>

	</div>	
</div>
