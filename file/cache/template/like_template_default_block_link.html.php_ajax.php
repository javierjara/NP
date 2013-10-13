<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:40 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: link.html.php 6671 2013-09-25 10:06:46Z Fern $
 */
 
 

?>	
<script type="text/javascript">
	if (typeof $Core.Like == 'undefined') $Core.Like = {};
	$Core.Like.Actions = 
	{
<?php if (Phpfox ::getParam('like.allow_dislike') && isset ( $this->_aVars['aActions'] )): ?>
			<?php echo '
				doAction: function(sActionTypeId, sItemTypeId, iItemId, sModule, sIteration, iParentId, oObj)
				{
					$(oObj).parent().parent().parent().after(\'<div id="js_gen_display_action_\' + sItemTypeId + \'_\' + iItemId + \'"></div>\');
					window.oTempO = oObj;
					
					/* Figure out if this item has been liked */
					if ( $(oObj).closest(\'.comment_mini_link_like\').find(\'.js_like_link_unlike\').is(\':visible\'))					
					{
						$(oObj).closest(\'.comment_mini_link_like\').find(\'.js_like_link_toggle\').toggle();
					}
					
					
					$.ajaxCall(\'like.doAction\', \'action_type_id=\' + sActionTypeId + \'&item_type_id=\' + sItemTypeId + \'&item_id=\' + iItemId + \'&module_name=\' + sModule + \'&parent_id=\' + iParentId);
					/* $(\'.like_action_\' + sActionTypeId + \'_\' + sIteration).each(function(){$(this).toggle();});			*/
					$(oObj).parent().find(\'a.like_action\').toggle();
					
				},
				removeAction: function(sActionTypeId, sItemTypeId, iItemId, sModule, sIteration, iParentId, oObj)
				{
					$.ajaxCall(\'like.removeAction\', \'action_type_id=\' + sActionTypeId + \'&item_type_id=\' + sItemTypeId + \'&item_id=\' + iItemId + \'&module_name=\' + sModule + \'&parent_id=\' + iParentId);
					if ( $(oObj).closest(\'.comment_mini_link_like\').find(\'.js_like_link_unlike\').is(\':visible\'))					
					{
						$(oObj).closest(\'.comment_mini_link_like\').find(\'.js_like_link_toggle\').toggle();
					}
					$(oObj).parent().find(\'a.like_action\').toggle();
				},
			'; ?>

<?php endif; ?>
	<?php echo '
		doLike : function(bIsCustom, sItemTypeId, iItemId, iParentId, oObj)
		{			
			
			if ($(oObj).closest(\'.comment_mini_link_like\').find(\'.like_action_unmarked\').is(\':visible\'))
			{
				$(\'#dislike_remove_\' + iItemId).hide();
				$(oObj).closest(\'.comment_mini_link_like\').find(\'.like_action_marked\').show();
				$(oObj).closest(\'.comment_mini_link_like\').find(\'.like_action_unmarked\').hide();
			}
			$(oObj).parent().find(\'.js_like_link_unlike:first\').show(); 
			$(oObj).hide();
			$.ajaxCall(\'like.add\', \'type_id=\' + sItemTypeId + \'&item_id=\' + iItemId + \'&parent_id=\' +iParentId + \'&custom_inline=\' + bIsCustom, \'GET\');
		}
	};
	'; ?>

</script>

<li class="li_action">
	<a href="#" onclick="$Core.Like.Actions.doLike(<?php if ($this->_aVars['aLike']['like_is_custom']): ?>1<?php else: ?>0<?php endif; ?>, '<?php echo $this->_aVars['aLike']['like_type_id']; ?>', <?php echo $this->_aVars['aLike']['like_item_id']; ?>, <?php if (isset ( $this->_aVars['aFeed']['feed_id'] )):  echo $this->_aVars['aFeed']['feed_id'];  else: ?>0<?php endif; ?>, this); return false;" class="js_like_link_toggle js_like_link_like"<?php if ($this->_aVars['aLike']['like_is_liked']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('feed.like'); ?>
	</a>
	<a href="#" onclick="$(this).parents('div:first').find('.js_like_link_like:first').show(); $(this).hide(); $.ajaxCall('like.delete', 'type_id=<?php echo $this->_aVars['aLike']['like_type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aLike']['like_item_id']; ?>&amp;parent_id=<?php if (isset ( $this->_aVars['aFeed']['feed_id'] )):  echo $this->_aVars['aFeed']['feed_id'];  else:  endif;  if ($this->_aVars['aLike']['like_is_custom']): ?>&amp;custom_inline=1<?php endif; ?>', 'GET'); return false;" class="js_like_link_toggle js_like_link_unlike"<?php if ($this->_aVars['aLike']['like_is_liked']):  else: ?> style="display:none;"<?php endif; ?>><?php echo Phpfox::getPhrase('feed.unlike'); ?></a>	
</li>
<?php if (Phpfox ::getParam('like.allow_dislike') && isset ( $this->_aVars['aActions'] ) && is_array ( $this->_aVars['aActions'] ) && ! empty ( $this->_aVars['aActions'] )): ?>
	<li><span>&middot;</span></li>
	<li class="li_action">
<?php if (count((array)$this->_aVars['aActions'])):  $this->_aPhpfoxVars['iteration']['action'] = 0;  foreach ((array) $this->_aVars['aActions'] as $this->_aVars['aAction']):  $this->_aPhpfoxVars['iteration']['action']++; ?>

<?php if (isset ( $this->_aVars['aAction']['action_type_id'] )): ?>
				<a href="#" onclick="$Core.Like.Actions.doAction('<?php echo $this->_aVars['aAction']['action_type_id']; ?>', '<?php if (isset ( $this->_aVars['aLike']['like_type_id'] )):  echo $this->_aVars['aLike']['like_type_id'];  else:  echo $this->_aVars['aAction']['item_type_id'];  endif; ?>', <?php echo $this->_aVars['aAction']['item_id']; ?>, '<?php if ($this->_aVars['aLike']['like_type_id'] == 'feed_mini'): ?>comment<?php else:  echo $this->_aVars['aAction']['module_name'];  endif; ?>', <?php echo $this->_aVars['aAction']['iActionIteration']; ?>,  <?php echo $this->_aVars['aFeed']['feed_id']; ?>, this); return false;" class="like_action_<?php echo $this->_aVars['aAction']['action_type_id']; ?>_<?php echo $this->_aVars['aAction']['iActionIteration']; ?> like_action like_action_marked" <?php if ($this->_aVars['aAction']['is_marked']): ?>style="display:none;"<?php endif; ?>>
<?php echo $this->_aVars['aAction']['phrase']; ?>
				</a>
				<a href="#" id="dislike_remove_<?php echo $this->_aVars['aAction']['item_id']; ?>" onclick="$Core.Like.Actions.removeAction('<?php echo $this->_aVars['aAction']['action_type_id']; ?>', '<?php if (isset ( $this->_aVars['aLike']['like_type_id'] )):  echo $this->_aVars['aLike']['like_type_id'];  else:  echo $this->_aVars['aAction']['item_type_id'];  endif; ?>', <?php echo $this->_aVars['aAction']['item_id']; ?>, '<?php if ($this->_aVars['aLike']['like_type_id'] == 'feed_mini'): ?>comment<?php else:  echo $this->_aVars['aAction']['module_name'];  endif; ?>', <?php echo $this->_aVars['aAction']['iActionIteration']; ?>,  <?php echo $this->_aVars['aFeed']['feed_id']; ?>, this); return false;" class="like_action_<?php echo $this->_aVars['aAction']['action_type_id']; ?>_<?php echo $this->_aVars['aAction']['iActionIteration']; ?> like_action like_action_unmarked" <?php if (! $this->_aVars['aAction']['is_marked']): ?>style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('like.remove'); ?> <?php echo $this->_aVars['aAction']['phrase']; ?>
				</a>
<?php endif; ?>
<?php endforeach; endif; ?>
	</li>
<?php else: ?>

<?php endif; ?>

