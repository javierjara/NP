<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 4176 2012-05-16 10:49:38Z Raymond_Benc $
 */
 
 

?>
<div class="activity_feed_form_share">
	<div class="activity_feed_form_share_process"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'v_middle')); ?></div>
<?php if (! isset ( $this->_aVars['bSkipShare'] )): ?>
		<ul class="activity_feed_form_attach">
<?php if (! Phpfox ::isMobile()): ?>
				<li class="share"><?php echo Phpfox::getPhrase('feed.share'); ?>:</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
				<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedCallback']['ajax_request']; ?></span></div><div class="drop"></div></a></li>
<?php elseif (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
				<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.status'); ?><span class="activity_feed_link_form_ajax">user.updateStatus</span></div><div class="drop"></div></a></li>
<?php else: ?>
				<li><a href="#" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/comment_add.png','return_url' => true)); ?>') no-repeat center left;" rel="global_attachment_status" class="active"><div><?php echo Phpfox::getPhrase('feed.post'); ?><span class="activity_feed_link_form_ajax">feed.addComment</span></div><div class="drop"></div></a></li>
<?php endif; ?>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  $this->_aPhpfoxVars['iteration']['feedlinks'] = 0;  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']):  $this->_aPhpfoxVars['iteration']['feedlinks']++; ?>

			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == 3 && Phpfox ::getService('profile')->timeline()): ?>
			<li><a href="#" rel="view_more_link" class="timeline_view_more js_hover_title"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.view_more'); ?></span></a>
				<ul class="view_more_drop">
<?php endif; ?>
			
			
			
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) && $this->_aVars['aFeedStatusLink']['no_profile']): ?>
<?php else: ?>
<?php if (( $this->_aVars['aFeedStatusLink']['no_profile'] && ! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))) || ! $this->_aVars['aFeedStatusLink']['no_profile']): ?>
					<li>
						<a href="#" style="background-image:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'feed/'.$this->_aVars['aFeedStatusLink']['icon'].'','return_url' => true)); ?>'); background-repeat:no-repeat; background-position:<?php if (Phpfox ::getService('profile')->timeline() && $this->_aPhpfoxVars['iteration']['feedlinks'] >= 3): ?>5px center<?php else: ?>center left<?php endif; ?>;" rel="global_attachment_<?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>"<?php if ($this->_aVars['aFeedStatusLink']['no_input']): ?> class="no_text_input"<?php endif; ?>>
							<div>
<?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['title']); ?>
<?php if ($this->_aVars['aFeedStatusLink']['is_frame']): ?>
									<span class="activity_feed_link_form"><?php if ($this->_aVars['aFeedStatusLink']['module_id'] == 'video' && Phpfox ::getParam('video.convert_servers_enable')):  echo $this->_aVars['sVideoServerUrl'];  else:  echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['aFeedStatusLink']['module_id'].'.frame');  endif; ?></span>
<?php else: ?>
									<span class="activity_feed_link_form_ajax"><?php echo $this->_aVars['aFeedStatusLink']['module_id']; ?>.<?php echo $this->_aVars['aFeedStatusLink']['ajax_request']; ?></span>
<?php endif; ?>
								<span class="activity_feed_extra_info"><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aFeedStatusLink']['description']); ?></span>
							</div>
							<div class="drop"></div>
						</a>
					</li>
<?php endif; ?>
<?php endif; ?>
			
<?php if ($this->_aPhpfoxVars['iteration']['feedlinks'] == count ( $this->_aVars['aFeedStatusLinks'] ) && Phpfox ::getService('profile')->timeline()): ?>
				</ul>
			</li>			
<?php endif; ?>
			
<?php endforeach; endif; ?>
		</ul>
<?php endif; ?>
	<div class="clear"></div>
</div>	

<div class="activity_feed_form">
	<form method="post" action="#" id="js_activity_feed_form" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div id="js_custom_privacy_input_holder"></div>
<?php if (Phpfox ::getParam('video.convert_servers_enable') && isset ( $this->_aVars['sCustomVideoHash'] )): ?>
			<div><input type="hidden" name="_v_hash" value="<?php echo $this->_aVars['sCustomVideoHash']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
			<div><input type="hidden" name="val[callback_item_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
			<div><input type="hidden" name="val[callback_module]" value="<?php echo $this->_aVars['aFeedCallback']['module']; ?>" /></div>
			<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aFeedCallback']['item_id']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['bFeedIsParentItem'] )): ?>
			<div><input type="hidden" name="val[parent_table_change]" value="<?php echo $this->_aVars['sFeedIsParentItemModule']; ?>" /></div>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] != Phpfox ::getUserId()): ?>
			<div><input type="hidden" name="val[parent_user_id]" value="<?php echo $this->_aVars['aUser']['user_id']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['bForceFormOnly'] ) && $this->_aVars['bForceFormOnly']): ?>
			<div><input type="hidden" name="force_form" value="1" /></div>
<?php endif; ?>
		<div class="activity_feed_form_holder">		
			
			<div id="activity_feed_upload_error" style="display:none;"><div class="error_message" id="activity_feed_upload_error_message"></div></div>
			
			<div class="global_attachment_holder_section" id="global_attachment_status" style="display:block;">
				<div id="global_attachment_status_value" style="display:none;"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></div>
				<textarea <?php if (isset ( $this->_aVars['aPage'] )): ?> id="pageFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['aEvent'] )): ?> id="eventFeedTextarea" <?php else: ?> <?php if (isset ( $this->_aVars['bOwnProfile'] ) && $this->_aVars['bOwnProfile'] == false): ?>id="profileFeedTextarea" <?php endif;  endif;  endif; ?> cols="60" rows="8" name="val[user_status]"><?php if (isset ( $this->_aVars['aFeedCallback']['module'] ) || defined ( 'PHPFOX_IS_USER_PROFILE' )):  echo Phpfox::getPhrase('feed.write_something');  else:  echo Phpfox::getPhrase('feed.what_s_on_your_mind');  endif; ?></textarea>
<?php if (isset ( $this->_aVars['bLoadCheckIn'] ) && $this->_aVars['bLoadCheckIn'] == true): ?>
                    <script type="text/javascript">
                        oTranslations['feed.at_location'] = "<?php echo Phpfox::getPhrase('feed.at_location'); ?>";
                    </script>
                    <div id="js_location_feedback"></div>
<?php endif; ?>
			</div>
			
<?php if (count((array)$this->_aVars['aFeedStatusLinks'])):  foreach ((array) $this->_aVars['aFeedStatusLinks'] as $this->_aVars['aFeedStatusLink']): ?>
<?php if (! empty ( $this->_aVars['aFeedStatusLink']['module_block'] )): ?>
<?php Phpfox::getBlock($this->_aVars['aFeedStatusLink']['module_block'], array()); ?>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php if (Phpfox ::isModule('egift')): ?>
<?php Phpfox::getBlock('egift.display', array()); ?>
<?php endif; ?>
		</div>
		<div class="activity_feed_form_button">
<?php if ($this->_aVars['bLoadCheckIn']): ?>
				<div id="js_location_input">
					<input type="text" id="hdn_location_name">
					<a href="#" onclick="$Core.Feed.resetLocation(); return false;"><?php echo Phpfox::getPhrase('feed.not_here'); ?></a>
					<a href="#" onclick="$Core.Feed.cancelCheckIn(); return false;"><?php echo Phpfox::getPhrase('feed.cancel_uppercase'); ?></a>
				</div>
<?php endif; ?>
			
			<div class="activity_feed_form_button_status_info">
				<textarea id="activity_feed_textarea_status_info" cols="60" rows="8" name="val[status_info]"></textarea>
			</div>
			<div class="activity_feed_form_button_position">
				
<?php if (( ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] ) || ( ( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( ( Phpfox ::getParam('share.share_on_facebook') && Phpfox ::getParam('facebook.facebook_app_id') && Phpfox ::getParam('facebook.facebook_secret')) || Phpfox ::getParam('share.share_on_twitter'))) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates'))))): ?>
					
					<div id="activity_feed_share_this_one">
						<ul>
<?php if (( Phpfox ::isModule('share') && ! defined ( 'PHPFOX_IS_USER_PROFILE' ) && ! defined ( 'PHPFOX_IS_PAGES_VIEW' ) && ! defined ( 'PHPFOX_IS_EVENT_VIEW' ) && ( ( Phpfox ::getParam('share.share_on_facebook') && Phpfox ::getParam('facebook.facebook_app_id') && Phpfox ::getParam('facebook.facebook_secret')) || Phpfox ::getParam('share.share_on_twitter')))): ?>
							<li><a href="#" class="activity_feed_share_this_one_link parent feed_share_site js_hover_title" rel="feed_share_on_holder"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.share_this_on'); ?></span></a></li>
<?php endif; ?>
<?php if (( ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] && Phpfox ::getService('profile')->timeline()) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')))): ?>
							<li>
								<a href="#" class="activity_feed_share_this_one_link parent feed_share_watch js_hover_title" rel="timeline_date_holder_share"><span class="js_hover_info"><?php echo Phpfox::getPhrase('feed.set_a_date'); ?></span></a>
							</li>
<?php endif; ?>
<?php if (defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] && $this->_aVars['aPage']['page_id'] != Phpfox ::getUserBy('profile_page_id')): ?>
							<li>
								<div class="parent">
									<select name="custom_pages_post_as_page">
										<option value="<?php echo $this->_aVars['aPage']['page_id']; ?>"><?php echo Phpfox::getPhrase('feed.post_as'); ?>...</option>
										<option value="<?php echo $this->_aVars['aPage']['page_id']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPage']['full_name']), 20, '...'); ?></option>
										<option value="0"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['sGlobalUserFullName'], 20, '...'); ?></option>
									</select>							
								</div>
							</li>
<?php endif; ?>
<?php if ($this->_aVars['bLoadCheckIn']): ?>
								<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.checkin');						
						?>						
<?php endif; ?>
						</ul>
						<div class="clear"></div>
					</div>
				
<?php else: ?>
<?php if ($this->_aVars['bLoadCheckIn']): ?>
						<div id="activity_feed_share_this_one">
							<ul>
								<?php
						Phpfox::getLib('template')->getBuiltFile('feed.block.checkin');						
						?>
								</ul>
						<div class="clear"></div>
						</div>						
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('share')): ?>
				<div class="feed_share_on_holder timeline_date_holder">						
<?php if (Phpfox ::getParam('share.share_on_facebook') && Phpfox ::getParam('facebook.facebook_app_id') && Phpfox ::getParam('facebook.facebook_secret')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=facebook', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/facebook.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.facebook'); ?></a></div>
<?php endif; ?>
<?php if (Phpfox ::getParam('share.share_on_twitter')): ?>
					<div class="feed_share_on_item"><a href="#" onclick="$(this).toggleClass('active'); $.ajaxCall('share.connect', 'connect-id=twitter', 'GET'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/twitter.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('feed.twitter'); ?></a></div>
<?php endif; ?>
					<div class="clear"></div>
					<div><input type="hidden" name="val[connection][facebook]" value="0" id="js_share_connection_facebook" class="js_share_connection" /></div>
					<div><input type="hidden" name="val[connection][twitter]" value="0" id="js_share_connection_twitter" class="js_share_connection" /></div>
				</div>					
<?php endif; ?>
<?php if (( ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && $this->_aVars['aPage']['is_admin'] ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getService('profile')->timeline() && Phpfox ::getParam('feed.can_add_past_dates')))): ?>
				<div class="timeline_date_holder_share timeline_date_holder">					
					<div class="t_center p_top_8"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></div>					
				</div>
<?php endif; ?>
				
                                <div class="activity_feed_form_button_position_button submit_button_form_ex">
                                    <span class="ex_button_arrow"></span>
                                    <input type="submit" value="Ex"  id="activity_feed_submit_prova" class="button" />
				</div>					

                                <div class="activity_feed_form_button_position_button submit_button_form_next">
                                    <input type="submit" value="Next"  id="activity_feed_submit_prova" class="button" />
                                    <span class="next_button_arrow"></span>
				</div>
                                
<?php if (isset ( $this->_aVars['aFeedCallback']['module'] )): ?>
<?php else: ?>
<?php if (! isset ( $this->_aVars['bFeedIsParentItem'] ) && ( ! defined ( 'PHPFOX_IS_USER_PROFILE' ) || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId()))): ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_type' => 'mini')); ?>
<?php endif; ?>
<?php endif; ?>
				<div class="clear"></div>
			</div>
			
			
			
<?php if (Phpfox ::getParam('feed.enable_check_in') && ( Phpfox ::getParam('core.ip_infodb_api_key') != '' || Phpfox ::getParam('core.google_api_key') != '' )): ?>
				<div id="js_add_location">					
					<div><input type="hidden" id="val_location_latlng" name="val[location][latlng]"></div>
					<div><input type="hidden" id="val_location_name" name="val[location][name]"></div>
					<div id="js_add_location_suggestions" style="overflow-y: auto;"></div>
					<div id="js_feed_check_in_map"></div>
				</div>
<?php endif; ?>
				
				
				
		</div>			
	
</form>

	<div class="activity_feed_form_iframe"></div>
</div>

