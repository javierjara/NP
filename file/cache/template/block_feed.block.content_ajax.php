<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:40 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 6181 2013-06-27 17:28:12Z Raymond_Benc $
 */
 
 

?>	
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
	<div class="activity_feed_content">							
<?php endif; ?>
	<div class="activity_feed_content_text<?php if (isset ( $this->_aVars['aFeed']['comment_type_id'] ) && $this->_aVars['aFeed']['comment_type_id'] == 'poll'): ?> js_parent_module_feed_<?php echo $this->_aVars['aFeed']['comment_type_id'];  endif; ?>">
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! Phpfox ::getService('profile')->timeline()): ?>
			<div class="activity_feed_content_info">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['user_name'], ((empty($this->_aVars['aFeed']['user_name']) && isset($this->_aVars['aFeed']['profile_page_id'])) ? $this->_aVars['aFeed']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aFeed']['user_id'], $this->_aVars['aFeed']['full_name']), 50, '...') . '</a></span>';  if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?> <?php echo Phpfox::getPhrase('feed.shared');  else:  if (isset ( $this->_aVars['aFeed']['parent_user'] )): ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/arrow.png','class' => 'v_middle')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aFeed']['parent_user']['parent_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aFeed']['parent_user']['parent_user_name'], ((empty($this->_aVars['aFeed']['parent_user']['parent_user_name']) && isset($this->_aVars['aFeed']['parent_user']['parent_profile_page_id'])) ? $this->_aVars['aFeed']['parent_user']['parent_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aFeed']['parent_user']['parent_user_id'], $this->_aVars['aFeed']['parent_user']['parent_full_name']), 50, '...') . '</a></span>'; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_info'] )): ?> <?php echo $this->_aVars['aFeed']['feed_info'];  endif;  endif; ?>
			</div>
<?php endif; ?>

<?php if (! empty ( $this->_aVars['aFeed']['feed_mini_content'] )): ?>
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="<?php echo $this->_aVars['aFeed']['feed_icon']; ?>" alt="" class="v_middle" /> <?php echo $this->_aVars['aFeed']['feed_mini_content']; ?> 
				</div>
				<div class="activity_feed_content_status_right">
					<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.link');						
						?>
				</div>
				<div class="clear"></div>
			</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_status'] ) && ( ! empty ( $this->_aVars['aFeed']['feed_status'] ) || $this->_aVars['aFeed']['feed_status'] == '0' )): ?>
			<div class="activity_feed_content_status">
<?php echo Phpfox::getLib('parse.output')->maxLine(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_status']), 200, 'feed.view_more', true), 55)); ?>
<?php if (Phpfox ::getParam('feed.enable_check_in') && Phpfox ::getParam('core.google_api_key') != '' && isset ( $this->_aVars['aFeed']['location_name'] )): ?>
					<span class="js_location_name_hover" <?php if (isset ( $this->_aVars['aFeed']['location_latlng'] ) && isset ( $this->_aVars['aFeed']['location_latlng']['latitude'] )): ?>onmouseover="$Core.Feed.showHoverMap('<?php echo $this->_aVars['aFeed']['location_latlng']['latitude']; ?>','<?php echo $this->_aVars['aFeed']['location_latlng']['longitude']; ?>', this);"<?php endif; ?>> - <a href="http://maps.google.com/maps?daddr=<?php echo $this->_aVars['aFeed']['location_latlng']['latitude']; ?>,<?php echo $this->_aVars['aFeed']['location_latlng']['longitude']; ?>" target="_blank"><?php echo Phpfox::getPhrase('feed.at_location', array('location' => $this->_aVars['aFeed']['location_name'])); ?></a>
					</span> 
<?php endif; ?>
			</div>
<?php endif; ?>
		
		<div class="activity_feed_content_link">				
<?php if ($this->_aVars['aFeed']['type_id'] == 'friend' && isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFriends']): ?>
<?php echo $this->_aVars['aFriends']['feed_image']; ?>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['aFeed']['feed_image']; ?>
<?php else: ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
			<div class="activity_feed_content_image"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="width:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (is_array ( $this->_aVars['aFeed']['feed_image'] )): ?>
					<ul class="activity_feed_multiple_image">
<?php if (count((array)$this->_aVars['aFeed']['feed_image'])):  foreach ((array) $this->_aVars['aFeed']['feed_image'] as $this->_aVars['sFeedImage']): ?>
							<li><?php echo $this->_aVars['sFeedImage']; ?></li>
<?php endforeach; endif; ?>
					</ul>
					<div class="clear"></div>
<?php else: ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>"<?php if (! isset ( $this->_aVars['aFeed']['no_target_blank'] )): ?> target="_blank"<?php endif; ?> class="<?php if (isset ( $this->_aVars['aFeed']['custom_css'] )): ?> <?php echo $this->_aVars['aFeed']['custom_css']; ?> <?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?>play_link <?php endif; ?> no_ajax_link<?php endif; ?>"<?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )): ?> onclick="<?php echo $this->_aVars['aFeed']['feed_image_onclick']; ?>"<?php endif;  if (! empty ( $this->_aVars['aFeed']['custom_rel'] )): ?> rel="<?php echo $this->_aVars['aFeed']['custom_rel']; ?>"<?php endif;  if (isset ( $this->_aVars['aFeed']['custom_js'] )): ?> <?php echo $this->_aVars['aFeed']['custom_js']; ?> <?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php if (! empty ( $this->_aVars['aFeed']['feed_image_onclick'] )):  if (! isset ( $this->_aVars['aFeed']['feed_image_onclick_no_image'] )): ?><span class="play_link_img"><?php echo Phpfox::getPhrase('feed.play'); ?></span><?php endif;  endif;  echo $this->_aVars['aFeed']['feed_image']; ?></a>						
<?php endif; ?>
			</div>
<?php endif; ?>
			<div class="<?php if (( ! empty ( $this->_aVars['aFeed']['feed_content'] ) || ! empty ( $this->_aVars['aFeed']['feed_custom_html'] ) ) && empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_no_image<?php endif;  if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?> activity_feed_content_float<?php endif; ?>"<?php if (isset ( $this->_aVars['aFeed']['feed_custom_width'] )): ?> style="margin-left:<?php echo $this->_aVars['aFeed']['feed_custom_width']; ?>;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title'] )): ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
						<span class="user_profile_link_span" id="js_user_name_link_<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_sub']); ?>">
<?php endif; ?>
					<a href="<?php if (isset ( $this->_aVars['aFeed']['feed_link_actual'] )):  echo $this->_aVars['aFeed']['feed_link_actual'];  else:  echo $this->_aVars['aFeed']['feed_link'];  endif; ?>" class="activity_feed_content_link_title"<?php if (isset ( $this->_aVars['aFeed']['feed_title_extra_link'] )): ?> target="_blank"<?php endif;  if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title']), 30); ?></a>
<?php if (isset ( $this->_aVars['aFeed']['feed_title_sub'] )): ?>
						</span>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_title_extra'] )): ?>
						<div class="activity_feed_content_link_title_link">
							<a href="<?php echo $this->_aVars['aFeed']['feed_title_extra_link']; ?>" target="_blank"<?php if (Phpfox ::getParam('core.no_follow_on_external_links')): ?> rel="nofollow"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['feed_title_extra']); ?></a>
						</div>
<?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_content'] )): ?>
					<div class="activity_feed_content_display">
<?php echo Phpfox::getLib('parse.output')->maxLine(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aFeed']['feed_content']), 200, '...'), 55)); ?>
					</div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_custom_html'] )): ?>
					<div class="activity_feed_content_display_custom">
<?php echo $this->_aVars['aFeed']['feed_custom_html']; ?>
					</div>
<?php endif; ?>
				
<?php if (! empty ( $this->_aVars['aFeed']['parent_module_id'] )): ?>
<?php Phpfox::getBlock('feed.mini', array('parent_feed_id' => $this->_aVars['aFeed']['parent_feed_id'],'parent_module_id' => $this->_aVars['aFeed']['parent_module_id'])); ?>
<?php endif; ?>
				
			</div>	
<?php if (! empty ( $this->_aVars['aFeed']['feed_image'] )): ?>
			<div class="clear"></div>
<?php endif; ?>
<?php endif; ?>
		</div>
	</div><!-- // .activity_feed_content_text -->

<?php if (Phpfox ::isMobile()): ?>
<div style="padding-bottom:10px; color:#808080;">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp'], 'feed.feed_display_time_stamp'); ?>
</div>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_view_comment'] )): ?>
<?php Phpfox::getBlock('feed.comment', array()); ?>
<?php else: ?>
		<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.comment');						
						?>
<?php endif; ?>

<?php if ($this->_aVars['aFeed']['type_id'] != 'friend'): ?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if ($this->_aVars['iTotalExtraFeedsToShow'] = count ( $this->_aVars['aFeed']['more_feed_rows'] )):  endif; ?>
			<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;"><?php echo Phpfox::getPhrase('feed.see_total_more_posts_from_full_name', array('total' => $this->_aVars['iTotalExtraFeedsToShow'],'full_name' => Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aFeed']['full_name'], 40, '...'))); ?></a>			
<?php endif; ?>
<?php endif;  if (! Phpfox ::getService('profile')->timeline()): ?>
	</div><!-- // .activity_feed_content -->
<?php endif; ?>


