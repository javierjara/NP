<div id="openinviter">
	{if count($aUsers)}
	{phrase var='friend.the_following_users_are_already_a_member_of_our_community'}:
	<div class="p_4">
		<div class="label_flow" style="height:100px;">
		{foreach from=$aUsers name=users item=aUser}
			<div class="{if is_int($phpfox.iteration.users/2)}row1{else}row2{/if} {if $phpfox.iteration.users == 1} row_first{/if}" id="js_invite_user_{$aUser.user_id}">
		{if $aUser.user_id == Phpfox::getUserId()}
			{$aUser.email} - {phrase var='friend.that_s_you'}
		{else}
			{$aUser.email} - {$aUser|user}{if !$aUser.friend_id} - <a href="#?call=friend.request&amp;user_id={$aUser.user_id}&amp;width=420&amp;height=250&amp;invite=true" class="inlinePopup" title="{phrase var='profile.add_to_friends'}">{phrase var='friend.add_to_friends'}</a>{/if}
		{/if}
			</div>
		{/foreach}
		</div>
	</div>
	{/if}
	<h3>{phrase var='contactimporter.your_contacts'}</h3>
	<p class="description" style="margin-bottom:5px;">{phrase var='contactimporter.you_can_send_max_invitations_per_time' max=$max_invitation}</p>
	<p class="description" style="margin-bottom: 5px;">{phrase var='contactimporter.are_not_joined_yet'}.</p>
	<br />
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
			{foreach from=$invite_list_sorts key=letter item=invite_list_sort}
			{if count($invite_list_sort) > 0}
			<?php $is_contact=false;?>
			<tr class="thTableOddRow"  id="title">
			 <td colspan="3" class="label"><div  id="letter_{$letter}">{$letter}</div></td>
			</tr>        
				{foreach from=$invite_list_sort item=invite_list}
					<?php $counter++?>          
					<tr class='thTableOddRow' id="row_<?php echo $counter?>">               
						<td align="left" width="10px">
							{*<input id='check_<?php echo $counter?>' name='val[check_<?php echo $counter?>]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='<?php echo $counter?>' type='checkbox' class='thCheckbox' checked>*}
							<input id='check_<?php echo $counter?>' name='val[items]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='{$invite_list.email}' type='checkbox' class='thCheckbox' checked>
							<input type='hidden' name='val[email_<?php echo $counter?>]' value='{$invite_list.email}'>
							<input type='hidden' name='val[name_<?php echo $counter?>]' value='{$invite_list.name}'>
						</td>
						<td style="width:100px" onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'> {$invite_list.name}</td>
						<td class="name" style="width:150px" onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>&lt;{$invite_list.email}&gt;</td>
					</tr>           
				{/foreach}
			{else}       
				<script type="text/javascript">
					$('#id_letter_{$letter}').addClass('hidden');
				</script>
			{/if}
			{/foreach}        
				<?php if($is_contact) echo "<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='3'>".Phpfox::getPhrase('contactimporter.there_is_no_contact_in_your_account')."</td></tr>";?>
			</table>
		</div>  
	</div>
	<div class="clear"></div>        
	<div class="clear"></div>

	<script type="text/javascript">
		var counter = <?php echo $counter?>;
		{literal}var total_allow_select ={/literal}{$max_invitation}{literal};
	</script>{/literal}
		
	<form method="post" action="{url link='contactimporter.invite'}" class="global_form" id='openinviterform' name='openinviterform' enctype="application/x-www-form-urlencoded" onsubmit="return check_select_invite();">
		<div class="form-wrapper" id="message-wrapper" style="clear:both;margin-top:5px">
			{if phpfox::getUserParam('contactimporter.hide_the_custom_invittation_message') == false}       
			<div class="form-label" id="message-label" style="width: 120px;text-align: left;"><br/>
				<label class="optional" for="message" style="margin-top:5px">
					{phrase var='contactimporter.custom_message_title'}
					<textarea rows="6" cols="45" id="message" name="message">{phrase var='contactimporter.default_invite_message_text'}</textarea>
				</label>
			</div>
			{/if}
		</div>		
		<input type="hidden" value="do_add" name="task" />                    
		<input type="hidden" value="{$plugType}" name="plugType" />                       
		<input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
		<input type='hidden' name='provider_box' value='{$provider_box}'>
		<span>
			<input class="button" type="submit" name="mysubmit" value="{phrase var='contactimporter.send_invites'}" id='submit' >
			<input class="button" type='button' id='' name='send' value ="{phrase var='contactimporter.skip'} &gt;&gt;" onclick="document.getElementById('skip').submit();">
		</span>
		<h3>{phrase var='invite.send_a_custom_invitation_link'}</h3>
		{phrase var='invite.send_friends_your_custom_invitation_link_by_copy_and_pasting_it_into_your_own_email_application'}:
		<div class="p_4">
			<input type="text" name="null" value="{$sIniviteLink}" id="js_custom_link" size="40" style="width:75%;" onfocus="this.select();" onkeypress="return false;" />
		</div>
		<input type="hidden" value="" id="contacts"  name="contacts" /> 
	</form>
</div>	
	
<form  method="post" action="{url link='contactimporter'}" id="skip">
	<input type="hidden" value="{$plugType}" name="plugType" />
	{if isset($oi_session_id)}
		<input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
	{/if}
	{if isset($provider_box)}
		<input type='hidden' name='provider_box' value='{$provider_box}'>
	{/if}
	<input type="hidden" value="skip" name="task" />
</form>