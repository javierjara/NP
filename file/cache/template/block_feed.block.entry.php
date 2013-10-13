<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: entry.html.php 5840 2013-05-09 06:14:35Z Raymond_Benc $
 */
 
 

?>
<div class="row_feed_loop js_parent_feed_entry <?php if (isset ( $this->_aVars['aFeed']['feed_mini'] )): ?> row_mini <?php else:  if (isset ( $this->_aVars['bChildFeed'] )): ?> row1<?php else:  if (isset ( $this->_aPhpfoxVars['iteration']['iFeed'] )):  if (is_int ( $this->_aPhpfoxVars['iteration']['iFeed'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['iFeed'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif;  else: ?>row1<?php endif;  endif;  endif; ?> js_user_feed" id="js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php if (! Phpfox ::isMobile() && ( ( defined ( 'PHPFOX_FEED_CAN_DELETE' ) ) || ( Phpfox ::getUserParam('feed.can_delete_own_feed') && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('feed.can_delete_other_feeds'))): ?>
		<div class="feed_delete_link"><a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('feed.delete', 'id=<?php echo $this->_aVars['aFeed']['feed_id'];  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&amp;module=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>', 'GET'); return false;"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.delete_this_feed'); ?></span></a></div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_1')) ? eval($sPlugin) : false); ?>
	<div class="activity_feed_image">	
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['is_custom_app'] ) && $this->_aVars['aFeed']['is_custom_app'] && ( ( isset ( $this->_aVars['aFeed']['view_id'] ) && $this->_aVars['aFeed']['view_id'] == 7 ) || ( isset ( $this->_aVars['aFeed']['gender'] ) && $this->_aVars['aFeed']['gender'] < 1 ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => 0,'path' => 'app.url_image','file' => $this->_aVars['aFeed']['app_image_path'],'suffix' => '_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['user_name'] ) && ! empty ( $this->_aVars['aFeed']['user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['parent_user_name'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => $this->_aVars['aFeed']['parent_user_name'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aFeed'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'href' => '')); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
	</div><!-- // .activity_feed_image -->
	
	<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.content');						
						?>
	
<?php (($sPlugin = Phpfox_Plugin::get('feed.template_block_entry_3')) ? eval($sPlugin) : false); ?>
</div><!-- // #js_item_feed_<?php echo $this->_aVars['aFeed']['feed_id']; ?> -->
