<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: messenger.html.php 4717 2012-09-21 11:39:07Z Raymond_Benc $
 */
 
 

?>
<div id="js_footer_im_holder" class="im_holder js_footer_holder">
	<div class="im_header" id="js_main_chat_header">
<?php echo Phpfox::getPhrase('im.chat'); ?>
	</div>
	<div style="overflow:auto; height:355px;" id="js_im_friend_list">
<?php Phpfox::getBlock('im.list', array()); ?>
	</div>
</div>
