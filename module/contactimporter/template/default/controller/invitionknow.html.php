<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<div class="main_break"></div>
{if count($aUsers)}
{foreach from=$aUsers name=users item=aUser}
	<div class="{if is_int($phpfox.iteration.users/2)}row1{else}row2{/if}{if $phpfox.iteration.users == 1} row_first{/if}" style="position:relative; min-height:150px; height:auto !important; height:150px;" id="js_parent_user_{$aUser.user_id}">
		<div class="user_browse_info">
				{phrase var='user.name'}: <a href="{url link=$aUser.user_name}">{$aUser.full_name|clean|shorten:50:'...'}</a> <br />
				{if !empty($aUser.gender) && Phpfox::getUserGroupParam('' . $aUser.user_group_id . '', 'user.can_edit_gender_setting')}
				{phrase var='user.gender'}: {$aUser.gender|gender} <br />
				{/if}
				{if Phpfox::getUserGroupParam('' . $aUser.user_group_id . '', 'user.can_edit_dob')}
				{if !empty($aUser.birthday) && $aUser.dob_setting != '3'}
				{if $aUser.dob_setting == '4'}
					{phrase var='user.birthday'}: {$aUser.month} {$aUser.day} <br />
				{else}
				{phrase var='user.age'}: {$aUser.birthday|age}
				{if $aUser.dob_setting == '1'}
					({$aUser.month} {$aUser.day})
				{elseif $aUser.dob_setting == '2'}

				{else}
					({$aUser.month} {$aUser.day}, {$aUser.year})
				{/if}
				<br />
				{/if}

				{/if}
				{/if}
				{if !empty($aUser.country_iso)}
				{phrase var='user.location'}: {if !empty($aUser.city_location)}{$aUser.city_location|clean} &raquo; {/if}{if !empty($aUser.country_child_id)}{$aUser.country_child_id|location_child} &raquo; {/if}{$aUser.country_iso|location} <br />
				{/if}
				{if Phpfox::isModule('rate') && Phpfox::getParam('profile.can_rate_on_users_profile') && $aUser.total_score > 0}
				{phrase var='user.rating'}: {phrase var='user.total_score_out_of_10' total_score=$aUser.total_score|round}
				{/if}
		</div>
		{if $aUser.user_id != Phpfox::getUserId()}
		<div class="user_browse_menu">
			<ul class="mini_action">
				<li><a href="{url link=$aUser.user_name}">{img theme='misc/user.png' alt='' class='v_middle'} {phrase var='user.view_profile'}</a></li>
				<li><a href="{url link='mail.compose' id=$aUser.user_id}">{img theme='misc/email_go.png' alt='' class='v_middle'} {phrase var='user.send_message'}</a></li>
				{if empty($aUser.is_friend)}
				<li><a href="#?call=friend.request&amp;user_id={$aUser.user_id}&amp;width=420&amp;height=250" class="inlinePopup" title="{phrase var='profile.add_to_friends'}">{img theme='misc/user_add.png' alt='' class='v_middle'} {phrase var='user.add_to_friends'}</a></li>
				{/if}
				{if Phpfox::getUserParam('user.can_feature')}
				<li {if empty($aUser.is_featured)} style="display:none;" {/if} class="user_unfeature_member"><a href="#" title="{phrase var='user.un_feature_this_member'}" onclick="$(this).parent().hide(); $(this).parents('.mini_action:first').find('.user_feature_member:first').show(); $.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=0&amp;type=1&amp;view={$sView}'); return false;">{img theme='misc/photo_unfeature.png' alt='' width='16' height='16' class='v_middle'} {phrase var='user.unfeature'}</a></li>
				<li  {if isset($aUser.is_featured) && $aUser.is_featured} style="display:none;" {/if} class="user_feature_member"><a href="#" title="{phrase var='user.feature_this_member'}" onclick="$(this).parent().hide(); $(this).parents('.mini_action:first').find('.user_unfeature_member:first').show(); $.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=1&amp;type=1'); return false;">{img theme='misc/photo_feature.png' alt='' width='16' height='16' class='v_middle'} {phrase var='user.feature'}</a></li>
				{/if}
			</ul>
		</div>
		{/if}
		<div class="user_browse_image">
			{img user=$aUser suffix='_75' max_width=75 max_height=75}
		</div>
		<div class="clear"></div>
	</div>
{/foreach}
{pager}
{/if}



