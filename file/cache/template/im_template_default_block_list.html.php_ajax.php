<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: list.html.php 5538 2013-03-25 13:20:22Z Miguel_Espinoza $
 */
 
 

 if (count ( $this->_aVars['aFriends'] )):  if ($this->_aVars['bDisplayUl']):  echo '
<script type="text/javascript">
	function showLoader()
	{
		$(\'#js_im_user_list\').html($.ajaxProcess(oTranslations[\'core.loading\'], \'large\'));
	}

	$Behavior.im_block_keypress = function()
	{
		if ($.browser.mozilla)
		{
			$(\'#js_im_find_friend_value\').keypress(imCheckForEnter);
		} 
		else 
		{
			$(\'#js_im_find_friend_value\').keydown(imCheckForEnter);
		}
	};	

	function imCheckForEnter(event)
	{
		if (event.keyCode == 13) 
		{
			showLoader(); 
			
			$.ajaxCall(\'im.searchFriends\', \'find=\' + $(\'#js_im_find_friend_value\').val());   
		
			return false;	
		}
	}
	
	function letsHaveAChat(iId)
	{
		if (!$(\'#js_chat_with_\' + iId).hasClass(\'we_have_already_clicked\'))
		{
			$(\'#js_chat_with_\' + iId).addClass(\'we_have_already_clicked\');
			
			$.ajaxCall(\'im.chat\', \'user_id=\' + iId + $Core.im.getChatOrder());   
		}
		
		return false;
	}	
</script>
'; ?>

<div id="js_im_user_list">
<?php endif;  if (count((array)$this->_aVars['aFriends'])):  $this->_aPhpfoxVars['iteration']['friends'] = 0;  foreach ((array) $this->_aVars['aFriends'] as $this->_aVars['aFriend']):  $this->_aPhpfoxVars['iteration']['friends']++; ?>

<a id="js_chat_with_<?php echo $this->_aVars['aFriend']['user_id']; ?>" class="im_user_list <?php if ($this->_aPhpfoxVars['iteration']['friends'] == 1): ?>first<?php endif; ?>" href="#" onclick="return letsHaveAChat('<?php echo $this->_aVars['aFriend']['user_id']; ?>');">
	<div class="im_user_list_status">
<?php if ($this->_aVars['aFriend']['im_status'] == '1'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_yellow.png','class' => 'v_middle')); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','class' => 'v_middle')); ?>
<?php endif; ?>
	</div>
	<div class="im_user_list_name">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFriend']['full_name']), 20, '...'); ?>
	</div>	
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFriend'],'suffix' => '_50_square','no_link' => true,'class' => 'v_middle','no_online_status' => 'true','max_width' => 28,'max_height' => 28)); ?>
</a>	
<?php endforeach; endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  if ($this->_aVars['bDisplayUl']): ?>
</div>
<?php endif;  else: ?>
<div class="extra_info p_4">
<?php echo Phpfox::getPhrase('im.no_friends_online'); ?>
</div>
<?php endif; ?>

<div id="js_friend_input_search">	
	<div class="im_in_chat_menu_bar im_in_chat_menu_bar_on">
		<a href="#" class="first" onclick="return $Core.im.goOffline();"><?php echo Phpfox::getPhrase('im.go_offline'); ?></a>
		<a href="#" id="im_a_toggle_sound" onclick="return $Core.im.toggleSound();"><?php echo Phpfox::getPhrase('im.play_sound_on_new_message'); ?>:						
				<span id="im_a_toggle_sound_yes" <?php if (! Phpfox ::getUserBy('im_beep')): ?>style="display:none;"<?php endif; ?>><?php echo Phpfox::getPhrase('user.yes'); ?></span>
				<span id="im_a_toggle_sound_no" <?php if (Phpfox ::getUserBy('im_beep')): ?>style="display:none;"<?php endif; ?>><?php echo Phpfox::getPhrase('user.no'); ?></span>				
		</a>
		<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.privacy'); ?>view_blocked"><?php echo Phpfox::getPhrase('im.edit_block_list'); ?></a>
	</div>		
	<div class="im_main_search_bar">
		<div id="js_im_toggle_main_option">
			<a href="#" onclick="$(this).parents('#js_friend_input_search').find('.im_in_chat_menu_bar_on:first').slideToggle('fast'); return false;">Options</a>		
		</div>		
		<input type="text" name="find" onkeyup="stopForSearch();" id="js_im_find_friend_value" value="<?php echo Phpfox::getPhrase('im.find_your_friends'); ?>" size="20" 
				onfocus="if (this.value == '<?php echo Phpfox::getPhrase('im.find_your_friends', array('phpfox_squote' => true)); ?>'){this.value = '';}" 
				onblur="if (this.value == '') this.value = '<?php echo Phpfox::getPhrase('im.find_your_friends', array('phpfox_squote' => true)); ?>';" />		
	</div>
</div>
