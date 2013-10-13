<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: header.html.php 6522 2013-08-29 07:17:29Z Miguel_Espinoza $
 */



?>
	<div<?php if (Phpfox ::getService('profile')->timeline()): ?> class="profile_timeline_header_holder"<?php endif; ?>>
		<div class="profile_header<?php if (Phpfox ::getService('profile')->timeline()): ?> profile_timeline_header<?php endif;  if (( empty ( $this->_aVars['aUser']['cover_photo'] ) && ( ! isset ( $this->_aVars['aUser']['cover_photo_id'] ) || $this->_aVars['aUser']['cover_photo_id'] < 1 ) ) || ! Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'profile.view_profile' )): ?> no_cover_photo <?php endif; ?>">

<?php if (Phpfox ::getService('profile')->timeline()): ?>
<?php Phpfox::getBlock('profile.pic', array()); ?>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aUser']['page_user_id'] ) && isset ( $this->_aVars['aUser']['use_timeline'] ) && $this->_aVars['aUser']['use_timeline']): ?>
				
<?php else: ?>
<?php if (isset ( $this->_aVars['aPage']['title'] )): ?>
					<h1>
                        <a href="<?php echo $this->_aVars['aPage']['link']; ?>"><?php echo $this->_aVars['aPage']['title']; ?></a>
					</h1>
<?php endif; ?>
<?php endif; ?>
			<div class="profile_header_inner<?php if (Phpfox ::getService('profile')->timeline()): ?> profile_header_timeline<?php endif; ?>">				
			
				
				<div id="section_menu">				
<?php if (defined ( 'PHPFOX_IS_USER_PROFILE_INDEX' ) || defined ( 'PHPFOX_PROFILE_PRIVACY' ) || Phpfox ::getLib('module')->getFullControllerName() == 'profile.info'): ?>
					<ul>						
<?php if (Phpfox ::getUserId() == $this->_aVars['aUser']['user_id']): ?>
<?php if (Phpfox ::getUserParam('profile.can_change_cover_photo')): ?>
							<li><a href="#" id="js_change_cover_photo" onclick="$('#cover_section_menu_drop').toggle(); return false;"><?php if (empty ( $this->_aVars['aUser']['cover_photo'] )):  echo Phpfox::getPhrase('user.add_a_cover');  else:  echo Phpfox::getPhrase('user.change_cover');  endif; ?></a>
								<div id="cover_section_menu_drop">
									<ul>
										<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('profile.photo'); ?>"><?php echo Phpfox::getPhrase('user.choose_from_photos'); ?></a></li>
										<li><a href="#" onclick="$('#cover_section_menu_drop').hide(); $Core.box('profile.logo', 500); return false;"><?php echo Phpfox::getPhrase('user.upload_photo'); ?></a></li>
<?php if (! empty ( $this->_aVars['aUser']['cover_photo'] )): ?>
										<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('profile', array('coverupdate' => '1')); ?>"><?php echo Phpfox::getPhrase('user.reposition'); ?></a></li>
										<li><a href="#" onclick="$('#cover_section_menu_drop').hide(); $.ajaxCall('user.removeLogo'); return false;"><?php echo Phpfox::getPhrase('user.remove'); ?></a></li>
<?php endif; ?>
									</ul>
								</div>
							</li>
<?php endif; ?>
						<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.profile'); ?>"><?php echo Phpfox::getPhrase('profile.edit_profile'); ?></a></li>
<?php if (Phpfox ::getUserParam('profile.can_custom_design_own_profile')): ?>
						    <li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('profile.designer'); ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('profile.design_profile'); ?></a></li>
<?php endif; ?>
<?php else: ?>
<?php if (Phpfox ::isModule('mail') && Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'mail.send_message' )): ?>
								<li><a href="#" onclick="$Core.composeMessage({user_id: <?php echo $this->_aVars['aUser']['user_id']; ?>}); return false;"><?php echo Phpfox::getPhrase('profile.send_message'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::isUser() && Phpfox ::isModule('friend') && Phpfox ::getUserParam('friend.can_add_friends') && ! $this->_aVars['aUser']['is_friend'] && $this->_aVars['aUser']['is_friend_request'] !== 2): ?>
								<li id="js_add_friend_on_profile"<?php if (! $this->_aVars['aUser']['is_friend'] && $this->_aVars['aUser']['is_friend_request'] === 3): ?> class="js_profile_online_friend_request"<?php endif; ?>>
									<a href="#" onclick="return $Core.addAsFriend('<?php echo $this->_aVars['aUser']['user_id']; ?>');" title="<?php echo Phpfox::getPhrase('profile.add_to_friends'); ?>">
<?php if (! $this->_aVars['aUser']['is_friend'] && $this->_aVars['aUser']['is_friend_request'] === 3):  echo Phpfox::getPhrase('profile.confirm_friend_request');  else:  echo Phpfox::getPhrase('profile.add_to_friends');  endif; ?>
									</a>
								</li>
<?php endif; ?>
<?php if ($this->_aVars['bCanPoke'] && Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'poke.can_send_poke' )): ?>
								<li id="liPoke">
									<a href="#" id="section_poke" onclick="$Core.box('poke.poke', 400, 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('poke.poke', array('full_name' => '')); ?></a>
								</li>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('profile.template_block_menu_more')) ? eval($sPlugin) : false); ?>
<?php if (( Phpfox ::getUserParam('user.can_block_other_members') && isset ( $this->_aVars['aUser']['user_group_id'] ) && Phpfox ::getUserGroupParam('' . $this->_aVars['aUser']['user_group_id'] . '' , 'user.can_be_blocked_by_others' ) ) || ( isset ( $this->_aVars['aUser']['is_online'] ) && $this->_aVars['aUser']['is_online'] && Phpfox ::isModule('im') && Phpfox ::getParam('im.enable_im_in_footer_bar') && $this->_aVars['aUser']['is_friend'] == 1 ) || ( Phpfox ::getUserParam('user.can_feature')) || ( isset ( $this->_aVars['bPassMenuMore'] ) ) || ( Phpfox ::getUserParam('core.can_gift_points'))): ?>
							<li><a href="#" id="section_menu_more" class="js_hover_title"><span class="section_menu_more_image"></span><span class="js_hover_info"><?php echo Phpfox::getPhrase('profile.more'); ?></span></a></li>
<?php endif; ?>
<?php endif; ?>
					</ul>					
<?php elseif (Phpfox ::getLib('module')->getFullControllerName() == 'friend.profile'): ?>
<?php if (Phpfox ::getUserId() == $this->_aVars['aUser']['user_id']): ?>
					    <ul>
						    <li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('friend'); ?>"><?php echo Phpfox::getPhrase('profile.edit_friends'); ?></a></li>
					    </ul>
<?php endif; ?>
<?php else: ?>
					    <ul>
<?php if (count((array)$this->_aVars['aSubMenus'])):  $this->_aPhpfoxVars['iteration']['submenu'] = 0;  foreach ((array) $this->_aVars['aSubMenus'] as $this->_aVars['iKey'] => $this->_aVars['aSubMenu']):  $this->_aPhpfoxVars['iteration']['submenu']++; ?>

						    <li>
								<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aSubMenu']['url']); ?>" class="ajax_link">
<?php if (substr ( $this->_aVars['aSubMenu']['url'] , -4 ) == '.add' || substr ( $this->_aVars['aSubMenu']['url'] , -7 ) == '.upload' || substr ( $this->_aVars['aSubMenu']['url'] , -8 ) == '.compose'):  echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/section_menu_add.png','class' => 'v_middle'));  endif;  echo Phpfox::getPhrase($this->_aVars['aSubMenu']['module'].'.'.$this->_aVars['aSubMenu']['var_name']); ?>
								</a>
						    </li>
<?php endforeach; endif; ?>
<?php if (( isset ( $this->_aVars['aUser']['is_app'] ) && $this->_aVars['aUser']['is_app'] ) || ( isset ( $this->_aVars['aPage'] ) && isset ( $this->_aVars['aPage']['is_admin'] ) && ! $this->_aVars['aPage']['is_admin'] )): ?>
<?php if (isset ( $this->_aVars['aPage'] ) && $this->_aVars['aPage']['is_app']): ?>
									<li><a href="<?php echo Phpfox::permalink('apps', $this->_aVars['aPage']['app_id'], $this->_aVars['aPage']['title'], false, null, (array) array (
)); ?>"><?php echo Phpfox::getPhrase('pages.go_to_app'); ?></a></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPage'] ) && ! $this->_aVars['aPage']['is_admin']): ?>
									<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('pages.add'); ?>"><?php echo Phpfox::getPhrase('pages.create_a_page'); ?></a></li>
<?php endif; ?>
<?php endif; ?>
					    </ul>
<?php endif; ?>
				</div>
<?php if (Phpfox ::getUserBy('profile_page_id') <= 0): ?>
				<div id="section_menu_drop">
					<ul>
<?php if (Phpfox ::getUserParam('user.can_block_other_members') && isset ( $this->_aVars['aUser']['user_group_id'] ) && Phpfox ::getUserGroupParam('' . $this->_aVars['aUser']['user_group_id'] . '' , 'user.can_be_blocked_by_others' )): ?>
							<li><a href="#?call=user.block&amp;height=120&amp;width=400&amp;user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>" class="inlinePopup js_block_this_user" title="<?php if ($this->_aVars['bIsBlocked']):  echo Phpfox::getPhrase('profile.unblock_this_user');  else:  echo Phpfox::getPhrase('profile.block_this_user');  endif; ?>"><?php if ($this->_aVars['bIsBlocked']):  echo Phpfox::getPhrase('profile.unblock_this_user');  else:  echo Phpfox::getPhrase('profile.block_this_user');  endif; ?></a></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aUser']['is_online'] ) && $this->_aVars['aUser']['is_online'] && Phpfox ::isModule('im') && Phpfox ::getParam('im.enable_im_in_footer_bar') && $this->_aVars['aUser']['is_friend'] == 1): ?>
							<li><a href="#" onclick="$.ajaxCall('im.chat', 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('profile.instant_chat'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('user.can_feature')): ?>
							<li <?php if (isset ( $this->_aVars['aUser']['is_featured'] ) && ! $this->_aVars['aUser']['is_featured']): ?> style="display:none;" <?php endif; ?> class="user_unfeature_member">
								<a href="#" title="<?php echo Phpfox::getPhrase('profile.un_feature_this_member'); ?>" onclick="$(this).parent().hide(); $(this).parents('#section_menu_drop').find('.user_feature_member:first').show(); $.ajaxCall('user.feature', 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>&amp;feature=0&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('profile.unfeature'); ?></a></li>
							<li <?php if (isset ( $this->_aVars['aUser']['is_featured'] ) && $this->_aVars['aUser']['is_featured']): ?> style="display:none;" <?php endif; ?> class="user_feature_member">
								<a href="#" title="<?php echo Phpfox::getPhrase('profile.feature_this_member'); ?>" onclick="$(this).parent().hide(); $(this).parents('#section_menu_drop').find('.user_unfeature_member:first').show(); $.ajaxCall('user.feature', 'user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>&amp;feature=1&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('profile.feature'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('core.can_gift_points')): ?>
							<li>
								<a href="#?call=core.showGiftPoints&amp;height=120&amp;width=400&amp;user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>" class="inlinePopup js_gift_points" title="<?php echo Phpfox::getPhrase('core.gift_points'); ?>">
<?php echo Phpfox::getPhrase('core.gift_points'); ?>
								</a>
							</li>
<?php endif; ?>
<?php if (Phpfox ::isModule('friend') && Phpfox ::getUserParam('friend.link_to_remove_friend_on_profile') && isset ( $this->_aVars['aUser']['is_friend'] ) && $this->_aVars['aUser']['is_friend'] === true): ?>
							<li>
								<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure'); ?>'))$.ajaxCall('friend.delete', 'friend_user_id=<?php echo $this->_aVars['aUser']['user_id']; ?>&reload=1'); return false;">
<?php echo Phpfox::getPhrase('friend.remove_friend'); ?>
								</a>
							</li>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('profile.template_block_menu')) ? eval($sPlugin) : false); ?>
					</ul>
				</div>
<?php endif; ?>
				
<?php if (isset ( $this->_aVars['aUser']['is_online'] ) && $this->_aVars['aUser']['is_online'] || $this->_aVars['aUser']['is_friend'] === 2 || $this->_aVars['aUser']['is_friend'] === 3): ?>
					<span class="profile_online_status">
<?php if (! $this->_aVars['aUser']['is_friend'] && $this->_aVars['aUser']['is_friend_request'] === 2): ?>
							<span class="js_profile_online_friend_request"><?php echo Phpfox::getPhrase('profile.pending_friend_confirmation');  if ($this->_aVars['aUser']['is_online']): ?> &middot; <?php endif; ?></span>
<?php elseif (! $this->_aVars['aUser']['is_friend'] && $this->_aVars['aUser']['is_friend_request'] === 3): ?>
							<span class="js_profile_online_friend_request"><?php echo Phpfox::getPhrase('profile.pending_friend_request');  if ($this->_aVars['aUser']['is_online']): ?> &middot; <?php endif; ?></span>
<?php endif; ?>
<?php if ($this->_aVars['aUser']['is_online']): ?>
							(<?php echo Phpfox::getPhrase('profile.online'); ?>)
<?php endif; ?>
					</span>
<?php endif; ?>
				
				<h1 style="width:<?php if (isset ( $this->_aVars['aPage'] )):  else: ?>400px<?php endif; ?>;">
<?php if (isset ( $this->_aVars['aUser']['user_name'] )): ?>
					    <a href="<?php if (isset ( $this->_aVars['aUser']['link'] ) && ! empty ( $this->_aVars['aUser']['link'] )):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aUser']['link']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aUser']['user_name']);  endif; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aUser']['full_name']); ?>">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aUser']['full_name']), 30), 50, '...'); ?>
					    </a>
<?php endif; ?>
                    
<?php if (count((array)$this->_aVars['aBreadCrumbs'])):  $this->_aPhpfoxVars['iteration']['link'] = 0;  foreach ((array) $this->_aVars['aBreadCrumbs'] as $this->_aVars['sLink'] => $this->_aVars['sCrumb']):  $this->_aPhpfoxVars['iteration']['link']++;  if ($this->_aPhpfoxVars['iteration']['link'] == 1): ?><span class="profile_breadcrumb">&#187;</span><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sCrumb']; ?></a><?php endif;  endforeach; endif; ?>
				</h1>
				
				
				<div class="profile_info">
<?php if (Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'profile.view_location' ) && ( ! empty ( $this->_aVars['aUser']['city_location'] ) || ! empty ( $this->_aVars['aUser']['country_child_id'] ) || ! empty ( $this->_aVars['aUser']['location'] ) )): ?>
<?php echo Phpfox::getPhrase('profile.lives_in'); ?> <?php if (! empty ( $this->_aVars['aUser']['city_location'] )):  echo $this->_aVars['aUser']['city_location'];  endif; ?>
<?php if (! empty ( $this->_aVars['aUser']['city_location'] ) && ( ! empty ( $this->_aVars['aUser']['country_child_id'] ) || ! empty ( $this->_aVars['aUser']['location'] ) )): ?>,<?php endif; ?>
<?php if (! empty ( $this->_aVars['aUser']['country_child_id'] )): ?>&nbsp;<?php echo Phpfox::getService('core.country')->getChild($this->_aVars['aUser']['country_child_id']);  endif; ?> <?php if (! empty ( $this->_aVars['aUser']['location'] )):  echo $this->_aVars['aUser']['location'];  endif; ?> &middot;
<?php endif; ?>
<?php if (isset ( $this->_aVars['aUser']['birthdate_display'] ) && is_array ( $this->_aVars['aUser']['birthdate_display'] ) && count ( $this->_aVars['aUser']['birthdate_display'] )): ?>
<?php if (count((array)$this->_aVars['aUser']['birthdate_display'])):  foreach ((array) $this->_aVars['aUser']['birthdate_display'] as $this->_aVars['sAgeType'] => $this->_aVars['sBirthDisplay']): ?>
<?php if ($this->_aVars['aUser']['dob_setting'] == '2'): ?>
<?php echo Phpfox::getPhrase('profile.age_years_old', array('age' => $this->_aVars['sBirthDisplay'])); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('profile.born_on_birthday', array('birthday' => $this->_aVars['sBirthDisplay'])); ?>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
<?php if (Phpfox ::getParam('user.enable_relationship_status') && isset ( $this->_aVars['sRelationship'] ) && $this->_aVars['sRelationship'] != ''): ?>&middot; <?php echo $this->_aVars['sRelationship']; ?> <?php endif; ?>
					
<?php if (isset ( $this->_aVars['aUser']['category_name'] )):  echo Phpfox::getLib('locale')->convert($this->_aVars['aUser']['category_name']);  endif; ?>
				</div>

			</div>
		</div>
<?php if (Phpfox ::getService('profile')->timeline() && ( Phpfox ::getService('user.privacy')->hasAccess('' . $this->_aVars['aUser']['user_id'] . '' , 'profile.view_profile' ) )): ?>
			<div class="timeline_main_menu">
				<ul>
<?php if (count((array)$this->_aVars['aProfileLinks'])):  foreach ((array) $this->_aVars['aProfileLinks'] as $this->_aVars['aProfileLink']): ?>
						<li class="<?php if (isset ( $this->_aVars['aProfileLink']['is_selected'] )): ?> active<?php endif; ?>">
							<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aProfileLink']['url']); ?>" class="ajax_link"><?php echo $this->_aVars['aProfileLink']['phrase'];  if (isset ( $this->_aVars['aProfileLink']['total'] )): ?><span>(<?php echo number_format($this->_aVars['aProfileLink']['total']); ?>)</span><?php endif; ?></a>
<?php if (isset ( $this->_aVars['aProfileLink']['sub_menu'] ) && is_array ( $this->_aVars['aProfileLink']['sub_menu'] ) && count ( $this->_aVars['aProfileLink']['sub_menu'] )): ?>
							
<?php endif; ?>
						</li>
<?php endforeach; endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
<?php endif; ?>
	</div>
<?php if ($this->bIsSample):  if (defined('PHPFOX_NO_WINDOW_CLICK')):  if (defined('PHPFOX_IS_AD_SAMPLE')): Phpfox::getBlock('ad.sample', array('block_id' => 12)); endif;  else: ?><div class="sample"<?php echo (!defined('PHPFOX_NO_WINDOW_CLICK') ? " onclick=\"window.parent.$('#location').val('12'); window.parent.tb_remove();\"" : ' style="cursor:default;"'); ?>><?php echo Phpfox::getPhrase('core.block') ; ?> 12<?php if (defined('PHPFOX_IS_AD_SAMPLE')): echo Phpfox::getService('ad')->getSizeForBlock("12"); endif;  if (defined('PHPFOX_IS_AD_SAMPLE')): Phpfox::getBlock('ad.sample', array('block_id' => 12)); endif; ?></div><?php endif;  else:  $aBlocks = Phpfox::getLib('phpfox.module')->getModuleBlocks('12');  $aUrl = Phpfox::getLib('url')->getParams();  $bDesigning = Phpfox::getService("theme")->isInDnDMode();  if (!Phpfox::isAdminPanel() && ( (defined('PHPFOX_DESIGN_DND') && PHPFOX_DESIGN_DND) || $bDesigning || (defined("PHPFOX_IN_DESIGN_MODE") && PHPFOX_IN_DESIGN_MODE && in_array('12', array(1, 2, 3))))):?> <div class="js_can_move_blocks js_sortable_empty" id="js_can_move_blocks_12"> <div class="block js_sortable dnd_block_info">Position '12'</div></div><?php endif;  foreach ((array)$aBlocks as $sBlock):  if (!Phpfox::isAdminPanel() && ( (defined('PHPFOX_DESIGN_DND') && PHPFOX_DESIGN_DND) || $bDesigning || (defined("PHPFOX_IN_DESIGN_MODE") && PHPFOX_IN_DESIGN_MODE && in_array('12', array(1, 2, 3))))):?>
<div class="js_can_move_blocks" id="js_can_move_blocks_12">
<?php endif;  if (is_array($sBlock) && (!defined('PHPFOX_CAN_MOVE_BLOCKS') || !in_array('12', array(1, 2, 3, 4)))):  eval(' ?>' . $sBlock[0] . '<?php ');  else:  Phpfox::getBlock($sBlock, array('location' => '12'));  endif;  if (!Phpfox::isAdminPanel() && ( (defined('PHPFOX_DESIGN_DND') && PHPFOX_DESIGN_DND) || $bDesigning || (defined("PHPFOX_IN_DESIGN_MODE") && PHPFOX_IN_DESIGN_MODE && in_array('12', array(1, 2, 3))))):?></div><?php endif;  endforeach;  if (!Phpfox::isAdminPanel()):  Phpfox::getBlock('ad.display', array('block_id' => 12));  endif;  endif; ?>
