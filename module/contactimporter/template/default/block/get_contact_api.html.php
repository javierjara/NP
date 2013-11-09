<h3>{phrase var='contactimporter.your_contacts'}</h3>
<p class="description" style="margin-bottom:5px;">{phrase var='contactimporter.you_can_send_max_invitations_per_time' max=$max_invitation}</p>
<p class="description" style="margin-bottom:5px;">{phrase var='contactimporter.the_following_people_are_not_your_friends'}.</p>
<div style='display:none' id="error">
	<ul class="form-errors"><li><ul class="errors"><li id='error_content'></li></ul></li></ul>
</div>
<table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style=" width: 100%;border-left:2px solid #EDEDED;" >
	<tr style='-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:#EDEDED none repeat scroll 0 50%;border-bottom:1px solid #C0C0C0;margin:0px auto 0;font-weight:bold;clear:both;width:80%'>
		<td align="left" width="10px">
			<input  type='checkbox' id='checkallBox' onclick='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>
		</td>
		<td align="left">{phrase var='contactimporter.name'}</td>
		<td align="left">{phrase var='user.email'}</td>
	</tr>
</table>
<div class="clear"></div>
<div class="wrapper-list">
	<div id="sort">
		<ul style="text-align: center;">
		<?php
			for($letter = ord('A'); $letter <= ord('Z'); $letter++)
			echo '<li id="id_letter_'.chr($letter).'"><a href="#letter_'.chr($letter).'">'.chr($letter).'</a></li>';
		?>
		</ul>
	</div>
	<div id="div_list_view">
		<table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:100%; border:0px solid">
		<?php $counter=0;$is_contact=true;?>
		{foreach from=$social_invite_list key=letter item=invites}
			{if count($invites) > 0}
			<?php $is_contact=false;?>
			<tr class="thTableOddRow" id="title">
				<td colspan="3" class="label"><div  id="letter_{$letter}">{$letter}</div></td>
			</tr>
			{foreach from=$invites item=invite}
			<?php $counter++?>
			<tr class='thTableOddRow'  id='row_<?php echo $counter?>'  >                
				<td>
					<input id='check_<?php echo $counter?>' name='val[items]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='{$invite.key}' type='checkbox' class='thCheckbox' checked>
					{*<input id='check_<?php echo $counter?>' name='val[check_<?php echo $counter?>]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='<?php echo $counter?>' type='checkbox' class='thCheckbox' checked>*}
					<input type='hidden' name='val[email_<?php echo $counter?>]' value='{$invite.key}'>
					<input type='hidden' name='val[name_<?php echo $counter?>]' value='{$$invite.name}'></td>
					<td onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>{$invite.name}</td>
					<td class="name" onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>&lt;{$invite.name}&gt;</td>
					<td align="right">
					{if $invite.pic eq ''}
						<img height='50px' width='50px' src="{$core_url}module/contactimporter/static/image/nophoto_user_thumb_icon.png">
					{else}
						<img height='50px' width='50px' src='{$invite.pic}'>
					{/if}
				</td>             
			</tr>
			{/foreach}
			{else}
				<script type="text/javascript">$('#id_letter_{$letter}').addClass('hidden');</script>
			{/if}
		{/foreach}
		<?php if($is_contact==true) echo "<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='3'>There is not contact in your account.</td></tr>";?>
		</table>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
	var counter = <?php echo $counter?>;
	{literal}
	var total_allow_select ={/literal}{$max_invitation}{literal} ;
</script>{/literal}	
<form method="post" action="{url link='contactimporter.addcontact'}" class="global_form" name='openinviter' enctype="application/x-www-form-urlencoded" onsubmit="return check_select();">
	<div class="form-wrapper" id="message-wrapper" style="clear:both">
		{if phpfox::getUserParam('contactimporter.hide_the_custom_invittation_message') == false}
			<div class="form-label" id="message-label" style="width: 120px;text-align: left;">
			<label class="optional" for="message">{phrase var='contactimporter.custom_message_title'}
			<textarea rows="6" cols="45" id="message" name="message">{phrase var='contactimporter.default_invite_message_text'}</textarea>
			</label></div>  
		{/if}                                                                           
		<div class="form-element" id="message-element"></div>
    </div>
	<input type="hidden" value="is_linkedAPI" name="is_linkedAPI" />
	<input type="hidden" value="{if isset($is_and_YT)}{$is_and_YT}{/if}" name ="is_and_YT"/>
	<input type="hidden" value="{if isset($res)}{$res.oauth_token}{/if}" name="responseLink[oauth_token]" />
	<input type="hidden" value="{if isset($res)}{$res.oauth_verifier}{/if}" name="responseLink[oauth_verifier]" />
	<input type="hidden" value="{if isset($in_lst) }{$in_lst}{/if}" name="invite_list" />
	<input type="hidden" value="do_add" name="task" />
	<input type="hidden" value="{if isset($plugType)}{$plugType}{/if}" name="plugType" />
	<input type="hidden" name="oi_session_id" value="{if isset($oi_session_id)}{$oi_session_id}{/if}">
	<input type="hidden" name="provider_box" value="{if isset($provider_box)}{$provider_box}{/if}">
	<span>
		<input class="button" type='submit' id='submit' name='send' value="{phrase var='contactimporter.send_invites'}" />
		<input class="button" type='button' id='' name='send' value ="{phrase var='contactimporter.skip'} &gt;&gt;" onclick="document.getElementById('skip').submit();">
	</span>
    <h3>{phrase var='invite.send_a_custom_invitation_link'}</h3>
    {phrase var='invite.send_friends_your_custom_invitation_link_by_copy_and_pasting_it_into_your_own_email_application'}:
    <div class="p_4">
        <input type="text" name="urlInviteLink" onkeypress="return false;" value="{$sIniviteLink}" id="js_custom_link" size="40" style="width:75%;" onfocus="this.select();" />
    </div>
	<input type="hidden" value="" id="contacts" name="contacts" /> 
</form>
<form method="post" action="{url link='contactimporter'}" id="skip">       
    <input type="hidden" value="skip" name="task" />      
</form>