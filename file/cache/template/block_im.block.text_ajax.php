<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: text.html.php 3296 2011-10-12 13:29:57Z Raymond_Benc $
 */
 
 

?>
<div class="im_text<?php if ($this->_aVars['aMessage']['user_id'] == Phpfox ::getUserId()): ?> im_text_actual_owner<?php endif;  if ($this->_aVars['aMessage']['last_owner'] == $this->_aVars['aMessage']['user_id']): ?> im_text_not_owner<?php endif;  if (isset ( $this->_aPhpfoxVars['iteration']['messages'] ) && $this->_aPhpfoxVars['iteration']['messages'] == 1 && ( ! isset ( $this->_aVars['bIsFirst'] ) || $this->_aVars['bIsFirst'] == true )): ?> im_text_first<?php endif;  if (isset ( $this->_aVars['aMessage']['is_today'] ) && ! $this->_aVars['aMessage']['is_today']): ?> extra_info<?php endif;  if (isset ( $this->_aVars['sClass'] ) && ! empty ( $this->_aVars['sClass'] )): ?> <?php echo $this->_aVars['sClass'];  endif; ?>">
	<div class="im_date">
<?php echo Phpfox::getTime(Phpfox::getParam('im.im_time_stamp'), $this->_aVars['aMessage']['time_stamp']); ?>
		
	</div>
<?php if ($this->_aVars['aMessage']['last_owner'] != $this->_aVars['aMessage']['user_id']): ?>
	<div class="im_chat_image<?php if ($this->_aVars['aMessage']['user_id'] == Phpfox ::getUserId()): ?> im_chat_image_owner<?php endif; ?>">	
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aMessage'],'suffix' => '_50_square','max_width' => 28,'max_height' => 28)); ?>
	</div>
<?php endif; ?>
	<div class="im_message <?php if ($this->_aVars['aMessage']['user_id'] == Phpfox ::getUserId()): ?> im_message_owner<?php endif;  if ($this->_aVars['aMessage']['last_owner'] != $this->_aVars['aMessage']['user_id']): ?> im_message_no_height<?php endif; ?>">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aMessage']['text']), 30); ?>
	</div>
</div>
