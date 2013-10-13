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
 */



/**
 * Display the image details when viewing an image.
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_<INSERT MODULE NAME HERE>
 * @version 		$Id: detail.class.php 254 2009-02-23 12:36:20Z Miguel_Espinoza $
 */

?>

<?php if (! $this->_aVars['bIsEventSection']): ?>
<div class="block_event_form">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event.add'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div id="js_quick_event_default" style="display:none;"><?php echo Phpfox::getPhrase('event.what_s_the_event'); ?></div>
		<div><input class="block_event_form_input block_event_form_input_off" type="text" name="val[title]" value="<?php echo Phpfox::getPhrase('event.what_s_the_event'); ?>" onfocus="if (this.value == $('#js_quick_event_default').html()) { $('.block_event_sub_holder').show(); this.value = ''; $(this).removeClass('block_event_form_input_off'); $.ajaxCall('event.loadMiniForm', '', 'GET'); }" /></div>
		<div class="block_event_sub_holder">
			<div class="t_center p_top_8"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></div>
		</div>		
	
</form>

</div>
<?php endif; ?>

<?php if (count((array)$this->_aVars['aUpcomingEvents'])):  $this->_aPhpfoxVars['iteration']['events'] = 0;  foreach ((array) $this->_aVars['aUpcomingEvents'] as $this->_aVars['sEventDate'] => $this->_aVars['aUpcomingEvent']):  $this->_aPhpfoxVars['iteration']['events']++; ?>

<div class="block_event_title_holder">
	<div class="block_event_title"><?php echo $this->_aVars['sEventDate']; ?></div>
<?php if (count((array)$this->_aVars['aUpcomingEvent'])):  $this->_aPhpfoxVars['iteration']['actualevents'] = 0;  foreach ((array) $this->_aVars['aUpcomingEvent'] as $this->_aVars['aEvent']):  $this->_aPhpfoxVars['iteration']['actualevents']++; ?>

	<a href="<?php echo $this->_aVars['aEvent']['url']; ?>" class="link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['title']), 30); ?></a> <?php if ($this->_aPhpfoxVars['iteration']['actualevents'] != count ( $this->_aVars['aUpcomingEvent'] )):  if ($this->_aPhpfoxVars['iteration']['actualevents'] == ( count ( $this->_aVars['aUpcomingEvent'] ) - 1 )): ?> <span class="detail_info"><?php echo Phpfox::getPhrase('event.and'); ?></span> <?php else: ?>,<?php endif;  endif; ?>
<?php endforeach; endif; ?>
</div>
<?php endforeach; endif; ?>

<?php if (isset ( $this->_aVars['aBirthdays'] ) && is_array ( $this->_aVars['aBirthdays'] ) && count ( $this->_aVars['aBirthdays'] )):  if (! $this->_aVars['bIsEventSection']): ?>
<div class="block_headline"><?php echo Phpfox::getPhrase('friend.birthdays'); ?></div>
<?php endif;  if (count((array)$this->_aVars['aBirthdays'])):  $this->_aPhpfoxVars['iteration']['birthdays'] = 0;  foreach ((array) $this->_aVars['aBirthdays'] as $this->_aVars['sDaysLeft'] => $this->_aVars['aBirthDatas']):  $this->_aPhpfoxVars['iteration']['birthdays']++; ?>

	<div class="block_event_title_holder">
		<div class="block_event_title">
<?php if ($this->_aVars['sDaysLeft'] == 1): ?>
<?php echo Phpfox::getPhrase('friend.tomorrow'); ?>
<?php elseif ($this->_aVars['sDaysLeft'] == 2): ?>
<?php echo Phpfox::getPhrase('friend.after_tomorrow'); ?>
<?php elseif ($this->_aVars['sDaysLeft'] < 1): ?>
<?php echo Phpfox::getPhrase('friend.today_normal'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('friend.days_left_days', array('days_left' => $this->_aVars['sDaysLeft'])); ?>
<?php endif; ?>
		</div>
<?php if (count((array)$this->_aVars['aBirthDatas'])):  $this->_aPhpfoxVars['iteration']['userbirthdays'] = 0;  foreach ((array) $this->_aVars['aBirthDatas'] as $this->_aVars['aBirthday']):  $this->_aPhpfoxVars['iteration']['userbirthdays']++; ?>

<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aBirthday']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aBirthday']['user_name'], ((empty($this->_aVars['aBirthday']['user_name']) && isset($this->_aVars['aBirthday']['profile_page_id'])) ? $this->_aVars['aBirthday']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aBirthday']['user_id'], $this->_aVars['aBirthday']['full_name']), Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?> <?php if ($this->_aVars['aBirthday']['show_age']): ?><span class="detail_info">(<?php echo $this->_aVars['aBirthday']['new_age']; ?>)</span><?php endif; ?>
<?php if ($this->_aPhpfoxVars['iteration']['userbirthdays'] != count ( $this->_aVars['aBirthDatas'] )):  if ($this->_aPhpfoxVars['iteration']['userbirthdays'] == ( count ( $this->_aVars['aBirthDatas'] ) - 1 )): ?> <span class="detail_info"><?php echo Phpfox::getPhrase('friend.and'); ?></span> <?php else: ?>,<?php endif;  endif; ?>
<?php endforeach; endif; ?>
	</div>
<?php endforeach; endif;  endif; ?>

<?php if (( empty ( $this->_aVars['aBirthdays'] ) || ! isset ( $this->_aVars['aBirthdays'] ) )): ?>
<?php if ($this->_aVars['bIsEventSection'] != true): ?>
	<div class="extra_info">
<?php echo Phpfox::getPhrase('friend.no_birthdays_coming_up'); ?>
	</div>
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
