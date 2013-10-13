<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:28 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<div class="user_tooltip_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aUser'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
</div>
<div class="user_tooltip_info">
<?php (($sPlugin = Phpfox_Plugin::get('user.template_block_tooltip_1')) ? eval($sPlugin) : false); ?>
	<div class="user_tooltip_info_user"><?php echo Phpfox::getLib('phpfox.parse.output')->split('<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aUser']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aUser']['user_name'], ((empty($this->_aVars['aUser']['user_name']) && isset($this->_aVars['aUser']['profile_page_id'])) ? $this->_aVars['aUser']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aUser']['user_id'], $this->_aVars['aUser']['full_name']), 30, '...') . '</a></span>', 20); ?></div>
<?php (($sPlugin = Phpfox_Plugin::get('user.template_block_tooltip_3')) ? eval($sPlugin) : false); ?>
<?php if ($this->_aVars['bIsPage']): ?>
<?php echo Phpfox::getLib('locale')->convert($this->_aVars['aUser']['page']['category_name']); ?>
		<br />
<?php if ($this->_aVars['aUser']['page']['page_type'] == '1'): ?>
<?php if ($this->_aVars['aUser']['page']['total_like'] == 1): ?>
<?php echo Phpfox::getPhrase('user.1_member'); ?>
<?php elseif ($this->_aVars['aUser']['page']['total_like'] > 1): ?>
<?php echo Phpfox::getPhrase('user.total_members', array('total' => number_format($this->_aVars['aUser']['page']['total_like'])));  endif; ?>
<?php else: ?>
<?php if ($this->_aVars['aUser']['page']['total_like'] == 1): ?>
<?php echo Phpfox::getPhrase('user.1_person_likes_this'); ?>
<?php elseif ($this->_aVars['aUser']['page']['total_like'] > 1): ?>
<?php echo Phpfox::getPhrase('user.total_people_like_this', array('total' => number_format($this->_aVars['aUser']['page']['total_like']))); ?>
<?php endif; ?>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_aVars['aUser']['gender_name']; ?><br />
<?php if (count((array)$this->_aVars['aUser']['birthdate_display'])):  foreach ((array) $this->_aVars['aUser']['birthdate_display'] as $this->_aVars['sAgeType'] => $this->_aVars['sBirthDisplay']): ?>
<?php if ($this->_aVars['aUser']['dob_setting'] == '2'): ?>
<?php echo Phpfox::getPhrase('user.age_years_old', array('age' => $this->_aVars['sBirthDisplay'])); ?>
<?php else: ?>
<?php echo $this->_aVars['sBirthDisplay']; ?>
<?php endif; ?>
<?php endforeach; endif; ?>
		<br />
<?php echo $this->_aVars['aUser']['location']; ?>
<?php if ($this->_aVars['iMutualTotal'] > 0): ?>
		<div class="user_tooltip_mutual">
			<a href="#" onclick="$Core.box('friend.getMutualFriends', 300, 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('user.mutual_friends_total', array('total' => $this->_aVars['iMutualTotal'])); ?></a>
			<div class="block_listing_inline">
				<ul>			
<?php if (count((array)$this->_aVars['aMutualFriends'])):  foreach ((array) $this->_aVars['aMutualFriends'] as $this->_aVars['aMutual']): ?>
					<li><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aMutual'],'suffix' => '_50_square','max_width' => 32,'max_height' => 32,'class' => 'js_hover_title')); ?></li>
<?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('user.template_block_tooltip_5')) ? eval($sPlugin) : false); ?>
<?php endif; ?>
	
<?php (($sPlugin = Phpfox_Plugin::get('user.template_block_tooltip_2')) ? eval($sPlugin) : false); ?>
	
</div>
<div class="clear"></div>
<?php if ($this->_aVars['aUser']['user_id'] != Phpfox ::getUserId() && ! $this->_aVars['bIsPage']): ?>
<div class="user_tooltip_action">
	<ul>
<?php if (! $this->_aVars['aUser']['is_friend']): ?>
		<li><a href="#" onclick="return $Core.addAsFriend('<?php echo $this->_aVars['aUser']['user_id']; ?>');" title="<?php echo Phpfox::getPhrase('profile.add_to_friends'); ?>"><?php echo Phpfox::getPhrase('user.add_as_friend'); ?></a></li>
<?php endif; ?>
		<li><a href="#" onclick="$Core.composeMessage({user_id: <?php echo $this->_aVars['aUser']['user_id']; ?>}); return false;"><?php echo Phpfox::getPhrase('user.send_message'); ?></a></li>
<?php if ($this->_aVars['bShowBDay'] == true): ?>
			<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aUser']['user_name']); ?>"><?php echo Phpfox::getPhrase('user.say_happy_birthday'); ?></a></li>
<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
