<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: block.html.php 5476 2013-03-04 13:45:11Z Miguel_Espinoza $
 */
 
 

 if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>

<div class="block<?php if (( defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()) && ( ! isset ( $this->_aVars['bCanMove'] ) || ( isset ( $this->_aVars['bCanMove'] ) && $this->_aVars['bCanMove'] == true ) )): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode() && ( ( isset ( $this->_aVars['bCanMove'] ) && $this->_aVars['bCanMove'] ) || ! isset ( $this->_aVars['bCanMove'] ) )): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
<?php if (( ( isset ( $this->_aVars['bCanMove'] ) && $this->_aVars['bCanMove'] ) || ! isset ( $this->_aVars['bCanMove'] ) )): ?>
						<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
						$.ajaxCall('core.hideBlock', '<?php if (isset ( $this->_aVars['sCustomDesignId'] )): ?>custom_item_id=<?php echo $this->_aVars['sCustomDesignId']; ?>&amp;<?php endif; ?>sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
						</a>				
<?php endif; ?>
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
		</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 6569 2013-09-03 06:48:49Z Miguel_Espinoza $
 */
 
 

 if (! $this->_aVars['bIsHashTagPop'] && ! PHPFOX_IS_AJAX && ! empty ( $this->_aVars['sIsHashTagSearch'] )): ?>
	<h1>#<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['sIsHashTagSearchValue']); ?></h1>
<?php endif;  (($sPlugin = Phpfox_Plugin::get('feed.component_block_display_process_header')) ? eval($sPlugin) : false);  if (isset ( $this->_aVars['sActivityFeedHeader'] )): ?>
<?php if (! PHPFOX_IS_AJAX): ?>
		<div class="mb_feed_header">
<?php echo $this->_aVars['sActivityFeedHeader']; ?>
		</div>
<?php endif;  endif;  if (isset ( $this->_aVars['bForceFormOnly'] ) && $this->_aVars['bForceFormOnly']): ?>
	<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.form');						
						 else: ?>
<?php if (Phpfox ::getService('profile')->timeline()): ?>
		<div class="main_timeline <?php if (isset ( $this->_aVars['aUser']['page_user_id'] )): ?>content4 content_float<?php endif; ?>" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/timeline.png','return_url' => true)); ?>') repeat-y 50%;">
<?php endif; ?>

<?php if (Phpfox ::isUser() && ! PHPFOX_IS_AJAX && $this->_aVars['sCustomViewType'] === null): ?>
<?php if (( Phpfox ::getUserBy('profile_page_id') > 0 && defined ( 'PHPFOX_IS_USER_PROFILE' ) ) || ( isset ( $this->_aVars['aFeedCallback']['disable_share'] ) && $this->_aVars['aFeedCallback']['disable_share'] ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'feed.share_on_wall' ) ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getUserParam('profile.can_post_comment_on_profile') && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId())): ?>

<?php else: ?>
<?php if (! Phpfox ::getService('profile')->timeline()): ?>
				<div id="js_main_feed_holder">
					<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.form');						
						?>
				</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if (Phpfox ::isUser() && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! PHPFOX_IS_AJAX && ! defined ( 'PHPFOX_IS_PAGES_VIEW' )): ?>
		<div class="feed_sort_order">
			<a href="#" class="feed_sort_order_link"><?php echo Phpfox::getPhrase('feed.sort'); ?></a>
			<div class="feed_sort_holder">
				<ul>
					<li><a href="#"<?php if (! $this->_aVars['iFeedUserSortOrder']): ?> class="active"<?php endif; ?> rel="0"><?php echo Phpfox::getPhrase('feed.top_stories'); ?></a></li>
					<li><a href="#"<?php if ($this->_aVars['iFeedUserSortOrder']): ?> class="active"<?php endif; ?> rel="1"><?php echo Phpfox::getPhrase('feed.most_recent'); ?></a></li>
				</ul>
			</div>
		</div>
<?php endif; ?>
<?php if (Phpfox ::getParam('feed.refresh_activity_feed') > 0 && Phpfox ::getLib('module')->getFullControllerName() == 'core.index-member'): ?>
		<div id="activity_feed_updates_link_holder">
			<a href="#" id="activity_feed_updates_link_single" class="activity_feed_updates_link" onclick="return $Core.loadMoreFeeds();"><?php echo Phpfox::getPhrase('feed.1_new_update'); ?></a>
			<a href="#" id="activity_feed_updates_link_plural" class="activity_feed_updates_link" onclick="return $Core.loadMoreFeeds();"><?php echo Phpfox::getPhrase('feed.span_id_js_new_update_view_span_new_updates'); ?></a>
		</div>
<?php endif; ?>
<?php if (Phpfox ::isModule('captcha') && Phpfox ::getUserParam('captcha.captcha_on_comment')): ?>
<?php Phpfox::getBlock('captcha.form', array('sType' => 'comment','captcha_popup' => true)); ?>
<?php endif; ?>
<div id="feed"><a name="feed"></a></div>
<div <?php if (! $this->_aVars['bIsHashTagPop']): ?>id="js_feed_content"<?php endif; ?> class="js_feed_content">
<?php if ($this->_aVars['sCustomViewType'] !== null): ?>
		<h2><?php echo $this->_aVars['sCustomViewType']; ?></h2>
<?php endif; ?>
	<div id="js_new_feed_update"></div>
	<div id="js_new_feed_comment"></div>
	
<?php if (Phpfox ::getService('profile')->timeline()): ?>
<?php if (isset ( $this->_aVars['bNoLoadFeedContent'] )): ?>
<?php else: ?>
			<div>
<?php if (PHPFOX_IS_AJAX && ! empty ( $this->_aVars['sLastDayInfo'] ) && ! Phpfox ::getLib('request')->get('resettimeline')): ?>
					<div class="timeline_date">
						<span><?php echo $this->_aVars['sLastDayInfo']; ?></span>
					</div>
<?php endif; ?>
				<div class="timeline_left">			
<?php if (( ! PHPFOX_IS_AJAX && Phpfox ::getService('profile')->timeline()) || Phpfox ::getLib('request')->get('resettimeline')): ?>
<?php if (( Phpfox ::isUser() && ! PHPFOX_IS_AJAX && $this->_aVars['sCustomViewType'] === null ) || Phpfox ::getLib('request')->get('resettimeline')): ?>
<?php if (( Phpfox ::getUserBy('profile_page_id') > 0 && defined ( 'PHPFOX_IS_USER_PROFILE' ) ) || ( isset ( $this->_aVars['aFeedCallback']['disable_share'] ) && $this->_aVars['aFeedCallback']['disable_share'] ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'feed.share_on_wall' ) ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! Phpfox ::getUserParam('profile.can_post_comment_on_profile') && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId())): ?>

<?php else: ?>
								<div class="timeline_feed_row">
									<div class="timeline_arrow_left">0</div>
									<div class="timeline_float_left">0</div>			
									<div class="timeline_holder">
										<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.form');						
						?>
									</div>
								</div>
								<div class="timeline_left_new"></div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aFeedTimeline']['left'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeedTimeline']['left'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

						<div class="timeline_feed_row">
							<div class="timeline_arrow_left"><?php echo $this->_aVars['aFeed']['feed_id']; ?></div>
							<div class="timeline_float_left"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp']); ?></div>
							<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.timeline');						
						?>
						</div>		
<?php endforeach; endif; ?>
				</div>
				<div class="timeline_right">
<?php if (! PHPFOX_IS_AJAX || Phpfox ::getLib('request')->get('resettimeline')): ?>
						<div class="timeline_feed_row">				
<?php Phpfox::getBlock('friend.timeline', array()); ?>
						</div>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aFeedTimeline']['right'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeedTimeline']['right'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

						<div class="timeline_feed_row">
							<div class="timeline_arrow_right"><?php echo $this->_aVars['aFeed']['feed_id']; ?></div>
							<div class="timeline_float_right"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aFeed']['time_stamp']); ?></div>
							<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.timeline');						
						?>
						</div>
<?php endforeach; endif; ?>
				</div>		
				<div class="clear"></div>
			</div>	
	
<?php if (! PHPFOX_IS_AJAX): ?>
<?php if (count((array)$this->_aVars['aTimelineDates'])):  foreach ((array) $this->_aVars['aTimelineDates'] as $this->_aVars['aTimelineDate']): ?>
					<div id="js_timeline_year_holder_<?php echo $this->_aVars['aTimelineDate']['year']; ?>"></div>
<?php if (count((array)$this->_aVars['aTimelineDate']['months'])):  foreach ((array) $this->_aVars['aTimelineDate']['months'] as $this->_aVars['aMonth']): ?>
						<div id="js_timeline_month_holder_<?php echo $this->_aVars['aTimelineDate']['year']; ?>_<?php echo $this->_aVars['aMonth']['id']; ?>"></div>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
		
<?php endif; ?>
			
<?php else: ?>
	
<?php if (isset ( $this->_aVars['bNoLoadFeedContent'] )): ?>
<?php else: ?>
<?php if (count((array)$this->_aVars['aFeeds'])):  $this->_aPhpfoxVars['iteration']['iFeed'] = 0;  foreach ((array) $this->_aVars['aFeeds'] as $this->_aVars['aFeed']):  $this->_aPhpfoxVars['iteration']['iFeed']++; ?>

<?php if (isset ( $this->_aVars['aFeed']['feed_mini'] ) && ! isset ( $this->_aVars['bHasRecentShow'] )): ?>
<?php if ($this->_aVars['bHasRecentShow'] = true):  endif; ?>
					<div class="activity_recent_holder">
						<div class="activity_recent_title">
<?php echo Phpfox::getPhrase('feed.recent_activity'); ?>
						</div>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['aFeed']['feed_mini'] ) && isset ( $this->_aVars['bHasRecentShow'] )): ?>
					</div>
<?php unset($this->_aVars['bHasRecentShow']); ?>
<?php endif; ?>
		
				<div class="js_feed_view_more_entry_holder post_type_<?php echo $this->_aVars['aFeed']['type_ex_next']; ?>">
					<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.entry');						
						?>
<?php if (isset ( $this->_aVars['aFeed']['more_feed_rows'] ) && is_array ( $this->_aVars['aFeed']['more_feed_rows'] ) && count ( $this->_aVars['aFeed']['more_feed_rows'] )): ?>
<?php if (count((array)$this->_aVars['aFeed']['more_feed_rows'])):  foreach ((array) $this->_aVars['aFeed']['more_feed_rows'] as $this->_aVars['aFeed']): ?>
<?php if ($this->_aVars['bChildFeed'] = true):  endif; ?>
							<div class="js_feed_view_more_entry" style="display:none;">
								<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.entry');						
						?>
							</div>
<?php endforeach; endif; ?>
<?php unset($this->_aVars['bChildFeed']); ?>
<?php endif; ?>
				</div>
<?php endforeach; endif; ?>
<?php endif; ?>
<?php endif; ?>
	
<?php if (isset ( $this->_aVars['bHasRecentShow'] )): ?>
		</div>
<?php endif; ?>
<?php if ($this->_aVars['sCustomViewType'] === null): ?>
<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' )): ?>
<?php else: ?>
<?php if (count ( $this->_aVars['aFeeds'] ) || ( isset ( $this->_aVars['bForceReloadOnPage'] ) && $this->_aVars['bForceReloadOnPage'] )): ?>
				<div id="feed_view_more">
<?php if ($this->_aVars['bIsHashTagPop']): ?>
<?php if (count ( $this->_aVars['aFeeds'] ) > 8): ?>
					<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('hashtag');  echo $this->_aVars['sIsHashTagSearch']; ?>/page_1/" class="global_view_more no_ajax_link" style="display:block;"><?php echo Phpfox::getPhrase('feed.view_more'); ?></a>
<?php endif; ?>
<?php else: ?>
					<div id="js_feed_pass_info" style="display:none;">page=<?php echo $this->_aVars['iFeedNextPage'];  if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['sTimelineYear']; ?>&month=<?php echo $this->_aVars['sTimelineMonth'];  if (! empty ( $this->_aVars['sIsHashTagSearch'] )): ?>&hashtagsearch=<?php echo $this->_aVars['sIsHashTagSearch'];  endif; ?></div>
					<div id="feed_view_more_loader"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></div>
					<a <?php if (! PHPFOX_IS_AJAX && isset ( $this->_aVars['bForceReloadOnPage'] ) && $this->_aVars['bForceReloadOnPage']): ?> style="text-indent:-1000px; overflow:hidden; background:transparent; border:0px;"<?php endif; ?> href="<?php if (Phpfox ::getLib('module')->getFullControllerName() == 'core.index-visitor'):  echo Phpfox::getLib('phpfox.url')->makeUrl('core.index-visitor', array('page' => $this->_aVars['iFeedNextPage']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('current', array('page' => $this->_aVars['iFeedNextPage']));  endif; ?>" onclick="$(this).hide(); $('#feed_view_more_loader').show(); $.ajaxCall('feed.viewMore', 'page=<?php echo $this->_aVars['iFeedNextPage'];  if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] )): ?>&profile_user_id=<?php echo $this->_aVars['aUser']['user_id'];  endif;  if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>&callback_module_id=<?php echo $this->_aVars['aFeedCallback']['module']; ?>&callback_item_id=<?php echo $this->_aVars['aFeedCallback']['item_id'];  endif; ?>&year=<?php echo $this->_aVars['sTimelineYear']; ?>&month=<?php echo $this->_aVars['sTimelineMonth']; ?>', 'GET'); return false;" class="global_view_more no_ajax_link"><?php echo Phpfox::getPhrase('feed.view_more'); ?></a>
<?php endif; ?>
				</div>				
<?php else: ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && Phpfox ::getService('profile')->timeline()): ?>
<?php Phpfox::getBlock('user.birth', array()); ?>
<?php else: ?>
					<br />
					<div class="message js_no_feed_to_show"><?php echo Phpfox::getPhrase('feed.there_are_no_new_feeds_to_view_at_this_time'); ?></div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (! PHPFOX_IS_AJAX || ( PHPFOX_IS_AJAX && count ( $this->_aVars['aFeedVals'] ) )): ?>
		</div>
<?php endif; ?>
<?php if (Phpfox ::getParam('feed.refresh_activity_feed') > 0 && Phpfox ::getLib('module')->getFullControllerName() == 'core.index-member'): ?>
		<script type="text/javascript">
			$Behavior.reloadActivity = function() { $Core.reloadActivityFeed();	};
		</script>
<?php endif; ?>

<?php if (Phpfox ::getService('profile')->timeline()): ?>
		</div>
<?php if (isset ( $this->_aVars['aUser']['page_user_id'] )): ?>
			<div id="right">
<?php Phpfox::getBlock('feed.time', array()); ?>
<?php if (count((array)$this->_aVars['aLoadBlocks'])):  foreach ((array) $this->_aVars['aLoadBlocks'] as $this->_aVars['sBlock']): ?>
<?php Phpfox::getBlock($this->_aVars['sBlock'], array()); ?>
<?php endforeach; endif; ?>
			</div>
<?php endif; ?>
<?php endif;  endif; ?>


		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php endif;  unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName'], $this->_aVars['aMenu']); ?>

<?php if (isset ( $this->_aVars['sClass'] )): ?>
<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass']));  endif; ?>
