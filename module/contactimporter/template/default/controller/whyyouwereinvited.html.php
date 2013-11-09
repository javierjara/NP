<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
{literal}
<style type="text/css">
    .user_invite .user_browse_info
    {
        float:left;
        position: relative;
        
    }
     .user_invite
     {
        clear:both;
        display:block;
    }
</style>
{/literal}
<h1>{phrase var='contactimporter.contact_importer'}</h1>
{if $checkMess eq ""}
<h3>{phrase var='contactimporter.you_were_invited_by_p'}</h3>
{foreach from=$uInvites item=aUser}
<div class="user_invite">
<div id="js_image_div_{$aser.user_id}" style="width:60px;" class="go_left t_center">
    {if $uUser.user_image != ""}
    <a title="{$aUser.full_name}" href="{$path}{$aUser.user_name}">
        <img width="50" height="50" id="sJsUserImage_{$aUser.user_id}"  src="{$aUser.user_image}">
    </a>
    {else}
    <a title="{$aUser.full_name}" href="{$path}{$aUser.user_name}">
        <img width="50" height="50" id="sJsUserImage_{$uUser.user_id}"  src="{$path}/static/image/misc/noimage_75.png">
    </a>
    {/if}
</div>
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
</div>
<h3 style="clear: both;width: 100%;display: block;"></h3>
{/foreach}
{else}
  {phrase var='contactimporter.you_were_invited_by' signup=$SignUp login=$login}
{/if}

