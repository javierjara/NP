<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>

<?php if (Phpfox ::getParam('like.show_user_photos')): ?>
	<div class="activity_like_holder comment_mini" style="position:relative;">		
		<a href="#" class="like_count_link js_hover_title" onclick="return $Core.box('like.browse', 400, 'type_id=<?php if (isset ( $this->_aVars['aFeed']['like_type_id'] )):  echo $this->_aVars['aFeed']['like_type_id'];  else:  echo $this->_aVars['aFeed']['type_id'];  endif; ?>&amp;item_id=<?php echo $this->_aVars['aFeed']['item_id']; ?>');">			
<?php echo number_format($this->_aVars['aFeed']['feed_total_like']); ?>
			<span class="js_hover_info">
<?php if (defined ( 'PHPFOX_IS_THEATER_MODE' )):  echo Phpfox::getPhrase('like.likes');  else:  echo Phpfox::getPhrase('like.people_who_like_this');  endif; ?>
			</span>
		</a>		
<?php Phpfox::getBlock('like.displayactions', array('aFeed' => $this->_aVars['aFeed'])); ?>
		
		<div class="like_count_link_holder">
<?php if (count((array)$this->_aVars['aFeed']['likes'])):  $this->_aPhpfoxVars['iteration']['likes'] = 0;  foreach ((array) $this->_aVars['aFeed']['likes'] as $this->_aVars['aLikeRow']):  $this->_aPhpfoxVars['iteration']['likes']++; ?>

<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aLikeRow'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'class' => 'js_hover_title v_middle')); ?>&nbsp;
<?php endforeach; endif; ?>
		</div>
	</div>	
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeed']['call_displayactions'] )): ?>
<?php Phpfox::getBlock('like.displayactions', array('aFeed' => $this->_aVars['aFeed'])); ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aFeed']['feed_like_phrase'] )): ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_like_phrase'] )): ?>
			<div class="activity_like_holder comment_mini" id="activity_like_holder_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/like.png','class' => 'v_middle')); ?>&nbsp;
<?php echo $this->_aVars['aFeed']['feed_like_phrase']; ?>
			</div>
<?php else: ?>
<?php endif; ?>
	
<?php else:  if (isset ( $this->_aVars['aFeed']['feed_is_liked'] ) && $this->_aVars['aFeed']['feed_is_liked'] || ( isset ( $this->_aVars['aFeed']['total_like'] ) && $this->_aVars['aFeed']['total_like'] > 0 ) || ( isset ( $this->_aVars['aFeed']['feed_total_like'] ) && $this->_aVars['aFeed']['feed_total_like'] > 0 )): ?><div class="activity_like_holder comment_mini"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/like.png','class' => 'v_middle')); ?>&nbsp;<?php if ($this->_aVars['aFeed']['feed_is_liked']):  if (! count ( $this->_aVars['aFeed']['likes'] ) == 1):  echo Phpfox::getPhrase('like.you');  elseif (count ( $this->_aVars['aFeed']['likes'] ) == 1):  echo Phpfox::getPhrase('like.you_and'); ?>&nbsp;<?php else:  echo Phpfox::getPhrase('like.you_comma');  endif;  else:  echo Phpfox::getPhrase('like.article_to_upper');  endif;  if (count((array)$this->_aVars['aFeed']['likes'])):  $this->_aPhpfoxVars['iteration']['likes'] = 0;  foreach ((array) $this->_aVars['aFeed']['likes'] as $this->_aVars['aLikeRow']):  $this->_aPhpfoxVars['iteration']['likes']++;  if ($this->_aVars['aFeed']['feed_is_liked'] || $this->_aPhpfoxVars['iteration']['likes'] > 1):  echo Phpfox::getPhrase('like.article_to_lower');  endif;  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aLikeRow']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aLikeRow']['user_name'], ((empty($this->_aVars['aLikeRow']['user_name']) && isset($this->_aVars['aLikeRow']['profile_page_id'])) ? $this->_aVars['aLikeRow']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aLikeRow']['user_id'], $this->_aVars['aLikeRow']['full_name']), 30, '...') . '</a></span>';  if ($this->_aPhpfoxVars['iteration']['likes'] == ( count ( $this->_aVars['aFeed']['likes'] ) - 1 ) && $this->_aVars['aFeed']['feed_total_like'] <= Phpfox ::getParam('feed.total_likes_to_display')): ?>&nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php elseif ($this->_aPhpfoxVars['iteration']['likes'] != count ( $this->_aVars['aFeed']['likes'] )): ?>,&nbsp;<?php endif;  endforeach; endif;  if ($this->_aVars['aFeed']['feed_total_like'] > Phpfox ::getParam('feed.total_likes_to_display')): ?>   <a href="#" onclick="return $Core.box('like.browse', 400, 'type_id=<?php echo $this->_aVars['aFeed']['like_type_id']; ?>&amp;item_id=<?php echo $this->_aVars['aFeed']['item_id']; ?>');">			<?php if ($this->_aVars['iTotalLeftShow'] = ( $this->_aVars['aFeed']['feed_total_like'] - Phpfox ::getParam('feed.total_likes_to_display'))): ?>			<?php endif; ?>			<?php if ($this->_aVars['iTotalLeftShow'] == 1): ?>			    &nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php echo Phpfox::getPhrase('like.1_other_person'); ?>&nbsp;			<?php else: ?>			    &nbsp;<?php echo Phpfox::getPhrase('like.and'); ?>&nbsp;<?php echo number_format($this->_aVars['iTotalLeftShow']); ?>&nbsp;<?php echo Phpfox::getPhrase('like.others'); ?>&nbsp;			<?php endif; ?>		    </a>		    <?php echo Phpfox::getPhrase('like.likes_this'); ?>		<?php else: ?>		    <?php if (( count ( $this->_aVars['aFeed']['likes'] ) > 1 )): ?>			&nbsp;<?php echo Phpfox::getPhrase('like.like_this'); ?>		    <?php else: ?>			<?php if ($this->_aVars['aFeed']['feed_is_liked']): ?>			    <?php if (count ( $this->_aVars['aFeed']['likes'] ) == 1): ?>				&nbsp;<?php echo Phpfox::getPhrase('like.like_this'); ?>			    <?php else: ?>				<?php if (count ( $this->_aVars['aFeed']['likes'] ) == 0): ?>				    &nbsp;<?php echo Phpfox::getPhrase('like.you_like'); ?>				<?php else: ?>				    <?php echo Phpfox::getPhrase('like.likes_this'); ?>				<?php endif; ?>			    <?php endif; ?>			<?php else: ?>			    <?php if (count ( $this->_aVars['aFeed']['likes'] ) == 1): ?>				&nbsp;<?php echo Phpfox::getPhrase('like.likes_this'); ?>			    <?php else: ?>				<?php echo Phpfox::getPhrase('like.like_this'); ?>			    <?php endif; ?>			<?php endif; ?>		    <?php endif; ?>		<?php endif; ?>	    </div>	<?php endif; ?>    <?php endif;  endif; ?>

    
