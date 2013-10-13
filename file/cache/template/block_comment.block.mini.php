<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: mini.html.php 6630 2013-09-12 09:24:48Z Fern $
 */
 
 

?>
	<div id="js_comment_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="js_mini_feed_comment comment_mini js_mini_comment_item_<?php echo $this->_aVars['aComment']['item_id']; ?>">
<?php if (( Phpfox ::getUserParam('comment.delete_own_comment') && Phpfox ::getUserId() == $this->_aVars['aComment']['user_id'] ) || Phpfox ::getUserParam('comment.delete_user_comment') || ( defined ( 'PHPFOX_IS_USER_PROFILE' ) && isset ( $this->_aVars['aUser']['user_id'] ) && $this->_aVars['aUser']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('comment.can_delete_comments_posted_on_own_profile')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
			<div class="feed_comment_delete_link">
				<a href="#" class="action_delete js_hover_title" onclick="$.ajaxCall('comment.InlineDelete', 'type_id=<?php echo $this->_aVars['aComment']['type_id']; ?>&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id'];  if (defined ( 'PHPFOX_IS_THEATER_MODE' )): ?>&photo_theater=1<?php endif; ?>', 'GET'); return false;">
					<span class="js_hover_info">
<?php echo Phpfox::getPhrase('comment.delete'); ?>
					</span>
				</a>
			</div>
<?php elseif (Phpfox ::getUserParam('comment.can_delete_comment_on_own_item')&& isset ( $this->_aVars['aFeed'] ) && isset ( $this->_aVars['aFeed']['feed_link'] ) && $this->_aVars['aFeed']['user_id'] == Phpfox ::getUserId()): ?>
			<div class="feed_comment_delete_link">
				<a href="<?php echo $this->_aVars['aFeed']['feed_link']; ?>ownerdeletecmt_<?php echo $this->_aVars['aComment']['comment_id']; ?>/" class="action_delete js_hover_title sJsConfirm">
					<span class="js_hover_info">
<?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )): ?>
<?php echo Phpfox::getPhrase('comment.delete'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('comment.delete_this_comment'); ?>
<?php endif; ?>
					</span>
				</a>
			</div>
<?php endif; ?>
		<div class="comment_mini_image">
<?php if (Phpfox ::isMobile()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aComment'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aComment'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32)); ?>
<?php endif; ?>
		</div>
		<div class="comment_mini_content">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aComment']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aComment']['user_name'], ((empty($this->_aVars['aComment']['user_name']) && isset($this->_aVars['aComment']['profile_page_id'])) ? $this->_aVars['aComment']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aComment']['user_id'], $this->_aVars['aComment']['full_name']), 30, '...') . '</a></span>'; ?><div id="js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="comment_mini_text <?php if ($this->_aVars['aComment']['view_id'] == '1'): ?>row_moderate<?php endif; ?>"><?php echo Phpfox::getLib('parse.output')->maxLine(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('parse.output')->feedStrip($this->_aVars['aComment']['text']), '300', 'comment.view_more', true), 30)); ?></div>
			<div class="comment_mini_action">
				<ul>
					<li class="comment_mini_entry_time_stamp"><?php if (isset ( $this->_aVars['aComment']['unix_time_stamp'] )):  echo Phpfox::getLib('date')->convertTime($this->_aVars['aComment']['unix_time_stamp'], 'comment.comment_time_stamp');  else:  echo Phpfox::getLib('date')->convertTime($this->_aVars['aComment']['time_stamp'], 'comment.comment_time_stamp');  endif; ?></li>
					<li><span>&middot;</span></li>
<?php if (! Phpfox ::isMobile()): ?>
<?php if (( Phpfox ::getUserParam('comment.edit_own_comment') && Phpfox ::getUserId() == $this->_aVars['aComment']['user_id'] ) || Phpfox ::getUserParam('comment.edit_user_comment')): ?>
							<li>
								<a href="inline#?type=text&amp;&amp;simple=true&amp;id=js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;call=comment.updateText&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;data=comment.getText" class="quickEdit"><?php echo Phpfox::getPhrase('comment.edit'); ?></a>
							</li>
							<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php if (Phpfox ::getParam('comment.comment_is_threaded') && Phpfox ::getUserParam('feed.can_post_comment_on_feed')): ?>
<?php if (( isset ( $this->_aVars['aComment']['iteration'] ) && $this->_aVars['aComment']['iteration'] >= Phpfox ::getParam('comment.total_child_comments')) || isset ( $this->_aVars['bForceNoReply'] )): ?>
						
<?php else: ?>
							<li><a href="#" class="js_comment_feed_new_reply" rel="<?php echo $this->_aVars['aComment']['comment_id']; ?>"><?php echo Phpfox::getPhrase('comment.reply'); ?></a></li>
							<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php if (Phpfox ::isModule('report') && Phpfox ::getUserParam('report.can_report_comments')): ?>
<?php if ($this->_aVars['aComment']['user_id'] != Phpfox ::getUserId()): ?>
							<li><a href="#?call=report.add&amp;height=210&amp;width=400&amp;type=comment&amp;id=<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="inlinePopup" title="<?php echo Phpfox::getPhrase('report.report_a_comment'); ?>"><?php echo Phpfox::getPhrase('report.report'); ?></a></li>
							<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
					
<?php Phpfox::getBlock('like.link', array('like_type_id' => 'feed_mini','like_item_id' => $this->_aVars['aComment']['comment_id'],'like_is_liked' => $this->_aVars['aComment']['is_liked'],'like_is_custom' => true)); ?>
					<li class="js_like_link_holder"<?php if ($this->_aVars['aComment']['total_like'] == 0): ?> style="display:none;"<?php endif; ?>><span>&middot;</span></li>
					<li class="js_like_link_holder"<?php if ($this->_aVars['aComment']['total_like'] == 0): ?> style="display:none;"<?php endif; ?>>
						<a href="#" onclick="return $Core.box('like.browse', 400, 'type_id=feed_mini&amp;item_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>');">
							<span class="js_like_link_holder_info">
<?php if ($this->_aVars['aComment']['total_like'] == 1): ?>
<?php echo Phpfox::getPhrase('comment.1_person'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('comment.total_people', array('total' => number_format($this->_aVars['aComment']['total_like']))); ?>
<?php endif; ?>
							</span>
						</a>
					</li>
<?php if (Phpfox ::isModule('like')): ?>
<?php if (Phpfox ::getParam('like.allow_dislike')): ?>
						<li class="js_dislike_link_holder"<?php if ($this->_aVars['aComment']['total_dislike'] == 0): ?> style="display:none;"<?php endif; ?>><span>&middot;</span></li>
						<li class="js_dislike_link_holder"<?php if ($this->_aVars['aComment']['total_dislike'] == 0): ?> style="display:none;"<?php endif; ?>>
							<a href="#" id="js_dislike_mini_a_<?php echo $this->_aVars['aComment']['comment_id']; ?>" onclick="return  $Core.box('like.browse', 400, 'type_id=feed_mini&amp;item_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;dislike=1');">
<?php if ($this->_aVars['aComment']['total_dislike'] == 1): ?>
<?php echo Phpfox::getPhrase('comment.1_person'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('comment.total_people', array('total' => number_format($this->_aVars['aComment']['total_dislike']))); ?>
<?php endif; ?>
							</a>
						</li>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('comment.can_moderate_comments') && $this->_aVars['aComment']['view_id'] == '1'): ?>
						<li>
							<a href="#" onclick="$('#js_comment_text_<?php echo $this->_aVars['aComment']['comment_id']; ?>').removeClass('row_moderate'); $(this).remove(); $.ajaxCall('comment.moderateSpam', 'id=<?php echo $this->_aVars['aComment']['comment_id']; ?>&amp;action=approve&amp;inacp=0'); return false;"><?php echo Phpfox::getPhrase('comment.approve'); ?></a>					
						</li>
<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>		
		<div id="js_comment_form_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="js_comment_form_holder"></div>

		<div class="comment_mini_child_holder<?php if (isset ( $this->_aVars['aComment']['children'] ) && $this->_aVars['aComment']['children']['total'] > 0): ?> comment_mini_child_holder_padding<?php endif; ?>">
<?php if (isset ( $this->_aVars['aComment']['children'] ) && $this->_aVars['aComment']['children']['total'] > 0): ?>
				<div class="comment_mini_child_view_holder" id="comment_mini_child_view_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>">
					<a href="#" onclick="$.ajaxCall('comment.viewAllComments', 'comment_type_id=<?php echo $this->_aVars['aComment']['type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aComment']['item_id']; ?>&amp;comment_id=<?php echo $this->_aVars['aComment']['comment_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('comment.view_total_more', array('total' => number_format($this->_aVars['aComment']['children']['total']))); ?></a>
				</div>
<?php endif; ?>
			<div id="js_comment_children_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>" class="comment_mini_child_content">				
<?php if (isset ( $this->_aVars['aComment']['children'] ) && count ( $this->_aVars['aComment']['children']['comments'] )): ?>
<?php if (count((array)$this->_aVars['aComment']['children']['comments'])):  foreach ((array) $this->_aVars['aComment']['children']['comments'] as $this->_aVars['aCommentChilded']): ?>
<?php Phpfox::getBlock('comment.mini', array('comment_custom' => $this->_aVars['aCommentChilded'])); ?>
						<div id="js_feed_like_holder_<?php echo $this->_aVars['aCommentChilded']['comment_id']; ?>"> 
<?php Phpfox::getBlock('like.displayactions', array('aChildFeed' => $this->_aVars['aCommentChilded'])); ?>
						</div>
<?php endforeach; endif; ?>
<?php else: ?>
					<div id="js_feed_like_holder_<?php echo $this->_aVars['aComment']['comment_id']; ?>"> </div>
<?php endif; ?>
				
			</div>
		</div>		
		
	</div>

