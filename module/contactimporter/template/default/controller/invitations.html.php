<?php 
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if count($aInvites)}
	<div class="header_bar">
		<div id="js_select_info">
			<div class="go_left" style="padding-top:3px;">
				<label>
				{phrase var='invite.select'}:
				<select name="select" onchange="$Core.inviteContactimpoter.localSelector(this.value);" class="js_selector">
					<option value="">---</option>
						<option value="none">{phrase var='invite.none'}</option>
						<option value="all">{phrase var='invite.all'}</option>
					</select>
				</label>
					{phrase var='contactimporter.and'}
					<select name="action" disabled="disabled" id="js_action_selector_1" onchange="return $Core.inviteContactimpoter.doAction(this.value);">
						<option value="">---</option>
						<option value="delete">{phrase var='invite.delete'}</option>
					</select>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<form method="post" action="{url link='current'}" id="js_form">
		<div class="main_break" style=" margin: -5px 5px 4px;padding: 5px 5px 10px;">
			{foreach from=$aInvites name=invite item=aInvite}
				<div id="js_invite_{$aInvite.invite_id}" class="js_selector_class_{$aInvite.invite_id} {if is_int($phpfox.iteration.invite/2)}row1{else}row2{/if}{if $phpfox.iteration.invite == 1} row_first{/if}">
					<div class="go_left t_center" style="width:20px;">
						<input type="checkbox" name="val[]" value="{$aInvite.invite_id}" onclick="$Core.inviteContactimpoter.enableDelete(this)" class="checkbox" id="js_selector_checkbox_{$aInvite.invite_id}" />
					</div>
					<div class="go_left" style="width:400px;">                                         
						{$aInvite.count}. {$aInvite.email|shorten:50:'...'}
					</div>
					<div class="t_right">
                                         {literal}
                                            <script type="text/javascript">
                                                    function reSendInvitation(id)
                                                    {
                                                           $.ajaxCall('contactimporter.reSendInvitation','invite_id='+id);                                                
                                                    }
                                            </script>
                                         {/literal}
						<div id = "resend_{$aInvite.invite_id}" style="float:right"><span style="float: right;width:10px;margin-left: 4px;">
                                                        <a class="inlinePopup"  title="Invitation Message"  border="0" href="#?call=contactimporter.reSendInvitation&invite_id={$aInvite.invite_id}&width=300&height=200"><img alt="Resend Invitation" title="Resend Invitation" border="0" width="15" height="15" src="{$core_url}module/contactimporter/static/image/send_mail.png"></a>
                         </span>
						<a title="Delete Invitation" href="{url link='current' del=$aInvite.invite_id}">{img theme='misc/delete.png' alt='' class='go_right' }</a>
                       
						</div>
						
					</div>
					<div class="clear"></div>
				</div>
			{/foreach}
		</div>
	</form>
	
{pager}
{else}
	<div class="extra_info">
		{phrase var='invite.there_are_no_pending_invitations'}
		<ul class="action">
			<li><a href="{url link='contactimporter'}">{phrase var='invite.invite_your_friends'}</a></li>
		</ul>
	</div>
{/if}