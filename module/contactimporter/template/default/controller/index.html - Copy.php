<?php
/**
 * [ContactImporter]
 * [ContactImporter]
 *
 * @copyright		[Younetco]

 * @package 		Phpfox
 * @version 		1.0
 */

defined('PHPFOX') or exit('NO DICE!');
?>

<script type="text/javascript">
    function openWindowPP(type)
{literal}    {   {/literal}

        var url ="{url link='contactimporter'}" ;
       // alert('http://openid.younetid.com/auth/'+type+'.php?callbackUrl='+url);
         newwindow=window.open('http://openid.younetid.com/auth/'+type+'.php?callbackUrl='+url,'name','scrollbars=yes,height=400,width=550');
             if (window.focus)
                 newwindow.focus();

{literal}     }  {/literal}
</script>
  <script type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js"></script>
{if $is_linkedAPI != 'is_linkedAPI'}



	<div style="display:none; margin:0 auto; text-align:center; background:url({$core_url}module/contactimporter/static/image/loading.gif) no-repeat;width:320px;height:320px; padding-top:180px;" id="loading">
		<div style="text-align:center; ">{phrase var='contactimporter.sending_request'}</div>
	</div>
{literal}
<script type="text/javascript">
    var newwindow;

    function poptastic(url)
    {
        newwindow=window.open(url,'name','height=400,width=400');
        if (window.focus) {newwindow.focus()}
    }

</script>
{/literal}
{if ($step !="get_invite" and $step !="add_contact") or $errors}

	<!--Global variable JS -->
	<script type="text/javascript">
    //var mapKey, mapProvider = new Array();
		var count = {$mapkey|@count} ;
		var specific = new Array({$arrtop_5_email});
		var provider_domain_mapping = new Array();
		{foreach from=$top_5_email item = email}
			provider_domain_mapping['{$email.name}']='{$email.default_domain}';
		{/foreach}
		var count_specific_email={$top_5_email|@count};
		var mapKey = new Array({$arrmapKey});
		var mapValue = new Array({$mapProvider});
        {literal}
        window.onbeforeunload = function () {
            // Empty function, but it prevents the browser caching this anyway!
          }

         $("#get_contact_email").submit(function() {
            $("#provider_box_mail2")[0].removeAttribute("autocomplete");
        });

		$(document).ready(function() {

            $("#provider_box_mail2").autocomplete(
             [ {/literal}
               {$default_list_domain}  {literal}
              ],
              {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    onItemSelect:selectItem,
                    onFindValue:findValue,
                    autoFill:true,
                    maxItemsToShow:10,
                    autocomplete :"OFF",
                    previousValue :""
            }
            );

        }    );

	</script>  {/literal}
	<!--..-->

   <div id="import_form">
		 <h3>{phrase var='contactimporter.import_email_contact_list'}</h3>
         <p class="description">{phrase var='contactimporter.get_contact_description_email'}.</p>

		<form id="get_contact_email" onsubmit="return do_submit();" enctype="" class="global_form" action="" method="post" autocomplete="off" >
			<div>
				<div>
					{if $plugType == 'email'}
						{if $errors != ''}
							{foreach from= $errors  item=er}

								<div><ul class='form-errors'>
								<li><ul class='errors'><li>{$er}</li></ul></li></ul></div>

							{/foreach}
						{/if}
					{/if}

					<div style="width: 500px; margin-left: 100px;">
                     <?php $num=0;?>
						{foreach from=$top_5_email item = email}
                        {if $email.logo !=''}
                         <?php $num++;if ($num <=5):?>

							<div onclick="choose_provider('provider_box_mail', '{$email.name}');" class="logo">
								<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png">
							</div>
                         <?php endif; ?>
                         {/if}
						{/foreach}
					</div>
					<div class="form-elements">
						<div id="email_box-wrapper" class="form-wrapper">
							<div id="email_box-label" class="form-label">
								 <label for="email_box" class="required" >{phrase var='user.email'}&nbsp;</label>
							</div>
							<div id="email_box-element" class="form-element">
								<input type="text" name="email_box" id="email_box" value="" style="width:205px;">
							</div>
							<div style="float: left;;margin-top:4px;margin-left:3px">@</div>
							<div id="provider_box-element" class="form-element">
								<select onchange="other_input('provider_box-element');" name="provider_box" id="provider_box_mail" size="1">

								{foreach from=$top_5_email item = email}

									<option value="{$email.name}" label="{$email.default_domain}">{$email.default_domain}</option>
								{/foreach}
									<!--<option value="other" label="---">---</option> -->
									<!--<option value="other" label="Other" style="padding-bottom:10px">Other</option>-->

								</select>
							</div>
                             <div id="provider_box-element2" class="form-element" style="display:none;">
                                <input type='text' value='' name='tmp' id='provider_box_mail2' style='width:80px;' autocomplete ="OFF"/>
                                <input type='hidden' value='' id='provider_box_input2' name='provider_box2'/>
                            </div>
						</div>
						<div id="password_box-wrapper" class="form-wrapper"  style="margin-bottom:3px">
							<div id="password_box-label" class="form-label" style="width:450px">
							<label for="password_box" class="required">{phrase var='user.password'}
							<input type="password" style="width:310px" name="password_box" id="password_box" value=""  />
							</label>
							</div>

						</div>
						<div id="import-element" class="form-element" style="clear:both;">
							<input class="button" name="import" id="import" type="submit" value="{phrase var='contactimporter.import_contact'}"/>
						</div>
					</div>
			</div>
			</div>
		</form>

     <div style="">
	  <h3></h3>
         <p class="description">{phrase var='contactimporter.or'} <a href="{url link='invite'}">{phrase var='contactimporter.inviete_by_manually'}</a> </p>


        <div id="uploadcsvform3" style="margin-bottom:10px">
		{if $uploadcsv eq 'uploadcsv'}
            <div style="margin-bottom:5px;margin-left:10px" ><ul class='form-errors'>
			<li><ul class='errors'><li>{$error_message}</li></ul></li></ul>
			</div>
        {/if}
		<form onsubmit="sending_request();" enctype="multipart/form-data" class="global_form" action="{url link='contactimporter'}" method="post">
				<div >
					<span >&nbsp;  {phrase var='contactimporter.or'} {phrase var='contactimporter.upload_file_csv'} :
					<input type="file" class="text" name="csvfile"/>

					</span>
					<div style="clear:both;margin-top:4px;margin-left:1px">
						<input name="submit_button" type="submit" style="margin-left:5px;" class="button" value="{phrase var='contactimporter.read_contact'}" />

					</div>
				</div>
				<div id="email_box-element" class="form-element">
					<input type="hidden" name="uploadcsv" value="uploadcsv"/>
				</div>



		</form>
        </div>
		 <h3></h3>
     </div>
     <!-- <p>{phrase var='contactimporter.or'} </p>-->

    <form onsubmit="sending_request();" enctype="" class="global_form" action="" method="post">
		<div><div>
                <h3>{phrase var='contactimporter.import_your_socail_contact_list'}</h3>
                <p class="description">{phrase var='contactimporter.get_contact_description_social'}</p>

				{if $plugType == 'social'}
                    {if $errors != ''}
                        {foreach from= $errors  item=er}

                            <div><ul class='form-errors'>
								<li><ul class='errors'><li>{$er}</li></ul></li></ul>
							</div>

						{/foreach}
                    {/if}
                {/if}

				<div style="width: 500px; margin-left: 100px;">
					{foreach from=$top_5_social item = social}
                    {if $social.name eq 'linkedin' }

                    <div onclick="" class="logo">

                        <a id="linkedinA" href="#?call=contactimporter.callLinkedIn&amp;height=80&amp;width=270" class="inlinePopup" title="LinkedIn Authorization"><img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/></a>

                    </div>

                    {else}
                        {if $social.name eq 'twitter' }
                            <div onclick="" class="logo">

                                <a id="twitterA" href="#?call=contactimporter.callTwitter&amp;height=80&amp;width=270" class="inlinePopup" title="Twitter Authorization"><img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/></a>

                            </div>
                        {else}
					    <div onclick="choose_provider('provider_box_social', '{$social.name}');" class="logo">
						    <img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/>
					    </div>
                        {/if}
                    {/if}
					{/foreach}

				</div>
				<div class="form-elements">
				<div>
					<div id="email_box-label" class="form-label">
					<label for="email_box2" class="required">{phrase var='contactimporter.user'}&nbsp;</label>
					</div>
					<div>
						<input type="text" name="email_box" value="" style="width:190px"/>
					</div>
				</div>
				<div style="margin-top:10px" >
					<div  id="email_box-label" class="form-label">
					<label for="password_box2" class="required">{phrase var='user.password'}&nbsp;</label>
					</div>
					<div>
						<input type="password" name="password_box" id="password_box" value="" style="width:190px"/>
					</div>
				</div>

				<div id="import-element" class="form-element" style="margin-top:10px">
                <div style="float: left;" class="form-label">
				<label for="provider_box" class="optional required" id="lable_provider_box" >{phrase var='contactimporter.provider_text'}&nbsp;
                 </label>
                </div>
                <div style="float: left;margin-left:0px;">
				<select name="provider_box" id="provider_box_social" style="clear: both;" >
					{foreach from=$options key=domain item = social}
						{if $domain eq $top_5_social[0].name}
							<option value="{$domain}" label="{$social}" selected > {$social}</option>
						{else}
							<option value="{$domain}" label="{$social}" >{$social}</option>
						{/if}
					{/foreach}
				</select>
                </div>
		         <div style=" vertical-align: middle;">
				<input class="button" name="import" id="import" type="submit" style="margin-left:5px;margin-top:0px" value="{phrase var='contactimporter.import_contact'}" onclick="return checkRespones();"/>
                </div>
				</div>
				</div></div></div></div>
		</form>

 </div>

 {/if}
 {if $step == 'add_contact'}
	<form method="post" action="{url link='contactimporter.addcontact'}" class="global_form" name='openinviter' enctype="application/x-www-form-urlencoded" onsubmit="return check_select();">
		<div>
		<div>
		<h3>{phrase var='contactimporter.your_contacts'}</h3>
        <p class="description">{phrase var='contactimporter.you_can_send'} <font color="red" style="font-weight:bold">{$max_invitation}</font> {phrase var='contactimporter.invitations'}</p>

		<p class="description">{phrase var='contactimporter.the_following_people_are_not_your_friends'}.</p>

		<div style='display:none' id="error">
			<ul class="form-errors"><li><ul class="errors"><li id='error_content'></li></ul></li></ul>
		</div>
           <div id="value_sort" style="float:left;margin-right:5px;font-size:12px;font-weight: bold;margin-bottom: 8px;">
            <ul class="pager" style="text-align: center;">
               <?php
                  echo "<li><a class='active' href='javascript:void(0)' id='active_alphabe_all' onclick=\"getByAlphbe(this,'All')\" > ".'ALL'."</a></li>";
                  for($letter = ord('A'); $letter <= ord('Z'); $letter++)
                        echo "<li><a href='javascript:void(0)' id='active_alphabe_".chr($letter)."' onclick=\"getByAlphbe(this,'".chr($letter)."')\" > ".chr($letter)."</a></li>";

                ?>
             </ul>
        </div>

		<table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:540px;border-left:2px solid #EDEDED;">
		<tr style='-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:#EDEDED none repeat scroll 0 50%;border-bottom:1px solid #C0C0C0;margin:10px auto 0;font-weight:bold;clear:both;width:100%'>

			<td width="10px">
				<input type='checkbox' id='checkallBox' onclick='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>
			</td>
			<td align="left">&nbsp;&nbsp;&nbsp;{phrase var='contactimporter.name'}</td>
            <td>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td align="right">{phrase var='contactimporter.avatar'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
        <div class="clear"></div>
        <div id="div_list_view" style=" height: 400px; overflow: auto;width:538px;border-bottom: 5px solid #EDEDED;border-left: 2px solid #EDEDED;">
        <table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:525px;border:0px solid" >

		<?php $counter=0?>
        <script type="text/javascript">
            var array_search = new Array();

        </script>
		{foreach from=$social_invite_list item=invite}
			<?php $counter++?>
				<script type="text/javascript">
                array_search[<?php echo $counter ?>] = '{$invite.name|clean}';

            </script>

				<tr class='thTableOddRow'  id='row_<?php echo $counter?>'  >

				<td>
				<input id='check_<?php echo $counter?>' name='val[check_<?php echo $counter?>]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='<?php echo $counter?>' type='checkbox' class='thCheckbox' checked>
				<input type='hidden' name='val[email_<?php echo $counter?>]' value='{$invite.key}'>
				<input type='hidden' name='val[name_<?php echo $counter?>]' value='{$$invite.name}'></td>
				<td onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>{$invite.name}</td>
				<td onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>&lt;{$invite.name}&gt;</td>
				<td align="right">
					{if $invite.pic eq ''}
						<img height='50px' width='50px' src="{$core_url}module/contactimporter/static/image/nophoto_user_thumb_icon.png">
					{else}
						<img height='50px' width='50px' src='{$invite.pic}'>
					{/if}
				</td>
				</tr>


		{foreachelse}
			<tr class='thTableOddRow'>
				<td align='center' style='padding:20px;' colspan='3'>
					{phrase var='contactimporter.not_have_any_contacts'}.
				</td>
			</tr>
		{/foreach}
		</table>
        </div>
		<div class="clear"></div>
        <div class="autocomplete" style="float:left;font-weight: bold;font-size: 13px;">
            <a id="toggleCurrent_id" href="javascript:void(0)" onclick="toggleCurrent(this)">Select Current Page</a> ||
            <a id="viewSelected_id" href="javascript:void(0)" onclick="viewSelected(this)">View All Selected Contacts</a>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
			var counter = <?php echo $counter?>;
            {literal}
            var total_allow_select ={/literal}{$max_invitation}{literal} ;
		</script>{/literal}

		<div class="form-wrapper" id="message-wrapper" style="clear:both">
		<div class="form-label" id="message-label" style="width: 120px;text-align: left;">
		<label class="optional" for="message">{phrase var='contactimporter.custom_message_title'}
		<textarea rows="6" cols="45" id="message" name="message">{phrase var='contactimporter.default_invite_message_text'}</textarea>
		</label></div>
		<div class="form-element" id="message-element">

		</div>
		</div>
		<table>
		<tr>
		<td>
		<input type="hidden" value="{$in_lst}" name="invite_list" />
		<input type="hidden" value="do_add" name="task" />
		<input type="hidden" value="{$plugType}" name="plugType" />
		<input type="hidden" name="oi_session_id" value="{$oi_session_id}">
		<input type="hidden" name="provider_box" value="{$provider_box}">
		<span>
		<input class="button" type='submit' id='submit' name='send' value="{phrase var='contactimporter.send_invites'}"/>
		<input class="button" type='button' id='' name='send' value ="Skip &gt;&gt;" onclick="document.getElementById('skip').submit();">
		</span>

		</td>
		</form>
		<td>

		</td></tr></table>

		<form  method="post" action="{url link='contactimporter'}" id="skip">
		<input type="hidden" value="{$in_lst}" name="invite_list" />
		<input type="hidden" value="$plugType" name="plugType" />
		<input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
		<input type='hidden' name='provider_box' value='{$provider_box}'>
		<input type="hidden" value="skip" name="task" />
		</form>


	</div>
	</div>

 {/if}
 {if $step == 'get_invite'}

		<form method="post" action="{url link='contactimporter.invite'}" class="global_form" id='openinviterform' name='openinviterform' enctype="application/x-www-form-urlencoded" onsubmit="return check_select_invite() ">
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
		<div>
		<h3>{phrase var='contactimporter.your_contacts'}</h3>
		<p class="description">{phrase var='contactimporter.are_not_joined_yet'}.</p>
		<p class="description">{phrase var='contactimporter.you_can_send'} <font color="red" style="font-weight:bold">{$max_invitation}</font> {phrase var='contactimporter.invitations'}</p>
		<br />
		<div style='display:none' id="error">
			<ul class="form-errors"><li><ul class="errors"><li id='error_content'></li></ul></li></ul>
		</div>
         <div id="value_sort" style="float:left;margin-right:5px;font-size:12px;font-weight: bold;margin-bottom: 8px;">
            <ul class="pager" style="text-align: center;">
               <?php
                  echo "<li><a class='active' href='javascript:void(0)' id='active_alphabe_all' onclick=\"getByAlphbe(this,'All')\" > ".'ALL'."</a></li>";
                  for($letter = ord('A'); $letter <= ord('Z'); $letter++)
                        echo "<li><a href='javascript:void(0)' id='active_alphabe_".chr($letter)."' onclick=\"getByAlphbe(this,'".chr($letter)."')\" > ".chr($letter)."</a></li>";

                ?>
             </ul>
        </div>

        <table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:520px;border-left:2px solid #EDEDED;" >
        <tr style='-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:#EDEDED none repeat scroll 0 50%;border-bottom:1px solid #C0C0C0;margin:0px auto 0;font-weight:bold;clear:both;width:80%'>

            <td align="left" width="10px">
                <input  type='checkbox' id='checkallBox' onclick='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>
            </td>
            <td align="left">{phrase var='contactimporter.name'}</td>
            <td align="left">{phrase var='user.email'}</td>

            </tr>
        </table>
         <div class="clear"></div>
        <div id="div_list_view" style=" height: 400px; overflow: auto;width:518px;border-bottom: 5px solid #EDEDED;border-left: 2px solid #EDEDED;">
		<table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:505px;border:0px solid" ;>


		<?php $counter=0?>
        <script type="text/javascript">
            var array_search = new Array();

        </script>
		{foreach from=$invite_list key=email item=name }
			<?php $counter++?>
            <script type="text/javascript">
                array_search[<?php echo $counter ?>] = '{$email}';

            </script>
			<tr class='thTableOddRow'  id="row_<?php echo $counter?>"  >

				<td align="left" width="10px">
					<input id='check_<?php echo $counter?>' name='val[check_<?php echo $counter?>]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='<?php echo $counter?>' type='checkbox' class='thCheckbox' checked>
					<input type='hidden' name='val[email_<?php echo $counter?>]' value='{$email}'>
					<input type='hidden' name='val[name_<?php echo $counter?>]' value='{$name}'>
				</td>
				<td style="width:100px" onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'> {$name}</td>
				<td style="width:150px" onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>&lt;{$email}&gt;</td>

			</tr>

		{foreachelse}
			<tr class='thTableOddRow'>
				<td align='center' style='padding:20px;' colspan='3'>
					{phrase var='contactimporter.not_have_any_contacts'}.
				</td>
			</tr>
		{/foreach}
		</table>
    </div>
        <div class="clear"></div>
        <div class="autocomplete" style="float:left;font-weight: bold;font-size: 13px;">
            <a id="toggleCurrent_id" href="javascript:void(0)" onclick="toggleCurrent(this)">Select Current Page</a> ||
            <a id="viewSelected_id" href="javascript:void(0)" onclick="viewSelected(this)">View All Selected Contacts</a>
        </div>
        <div class="clear"></div>

		<script type="text/javascript">
			var counter = <?php echo $counter?>;
            {literal}
            var total_allow_select ={/literal}{$max_invitation}{literal} ;
		</script>{/literal}

		<div class="form-wrapper" id="message-wrapper" style="clear:both;margin-top:5px">
		<div class="form-label" id="message-label" style="width: 120px;text-align: left;"><br/>
		<label class="optional" for="message" style="margin-top:5px">{phrase var='contactimporter.custom_message_title'}
		<textarea rows="6" cols="45" id="message" name="message">{phrase var='contactimporter.default_invite_message_text'}</textarea>
		</label></div>
		</div>

		<table>
		<tr>
			<td>
			<br/>
			<input type="hidden" value="do_add" name="task" />
			<input type="hidden" value="{$plugType}" name="plugType" />
			<input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
			<input type='hidden' name='provider_box' value='{$provider_box}'>
			<span>
				<input class="button" type="submit" name="mysubmit" value="Send invites" id='submit' >
				<input class="button" type='button' id='' name='send' value ="Skip &gt;&gt;" onclick="document.getElementById('skip').submit();">
			</span>
		</form>
			</td>
			<td>


			</td>
		</tr>
		</table>
		<form  method="post" action="{url link='contactimporter'}" id="skip">

			<input type="hidden" value="{$plugType}" name="plugType" />
			<input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
			<input type='hidden' name='provider_box' value='{$provider_box}'>
			<input type="hidden" value="skip" name="task" />

		</form>



</div></div>
 {/if}


{else}
    <form method="post" action="{url link='contactimporter.addcontact'}" class="global_form" name='openinviter' enctype="application/x-www-form-urlencoded" onsubmit="return check_select();">
        <div>
        <div>
          <h3>{phrase var='contactimporter.your_contacts'}</h3>
        <p class="description">{phrase var='contactimporter.you_can_send'} <font color="red" style="font-weight:bold">{$max_invitation}</font> {phrase var='contactimporter.invitations'}</p>

        <p class="description">{phrase var='contactimporter.the_following_people_are_not_your_friends'}.</p>

        <div style='display:none' id="error">
            <ul class="form-errors"><li><ul class="errors"><li id='error_content'></li></ul></li></ul>
        </div>
           <div id="value_sort" style="float:left;margin-right:5px;font-size:12px;font-weight: bold;margin-bottom: 8px;">
            <ul class="pager" style="text-align: center;">
               <?php
                  echo "<li><a class='active' href='javascript:void(0)' id='active_alphabe_all' onclick=\"getByAlphbe(this,'All')\" > ".'ALL'."</a></li>";
                  for($letter = ord('A'); $letter <= ord('Z'); $letter++)
                        echo "<li><a href='javascript:void(0)' id='active_alphabe_".chr($letter)."' onclick=\"getByAlphbe(this,'".chr($letter)."')\" > ".chr($letter)."</a></li>";

                ?>
             </ul>
        </div>

        <table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:540px;border-left:2px solid #EDEDED;">
        <tr style='-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:#EDEDED none repeat scroll 0 50%;border-bottom:1px solid #C0C0C0;margin:10px auto 0;font-weight:bold;clear:both;width:100%'>

            <td width="10px">
                <input type='checkbox' id='checkallBox' onclick='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>
            </td>
            <td align="left">&nbsp;&nbsp;&nbsp;{phrase var='contactimporter.name'}</td>
            <td>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td align="right">{phrase var='contactimporter.avatar'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
        <div class="clear"></div>
        <div id="div_list_view" style=" height: 400px; overflow: auto;width:538px;border-bottom: 5px solid #EDEDED;border-left: 2px solid #EDEDED;">
        <table class='thTableOddRow' align='left' cellspacing='0' cellpadding='5px' style="width:525px;border:0px solid" >

        <?php $counter=0?>
        <script type="text/javascript">
            var array_search = new Array();

        </script>
        {foreach from=$connections item=invite}
            <?php $counter++?>
                <script type="text/javascript">
                array_search[<?php echo $counter ?>] = '{$invite.name|clean}';

            </script>

                <tr class='thTableOddRow'  id='row_<?php echo $counter?>'  >

                <td>
                <input id='check_<?php echo $counter?>' name='val[check_<?php echo $counter?>]' onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),false);' value='<?php echo $counter?>' type='checkbox' class='thCheckbox' checked>
                <input type='hidden' name='val[email_<?php echo $counter?>]' value='{$invite.id}'>
                <input type='hidden' name='val[name_<?php echo $counter?>]' value='{$$invite.name}'></td>
                <td onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>{$invite.name}</td>
                <td onclick='check_toggle(<?php echo $counter?>,document.getElementById("row_<?php echo $counter?>"),true);'>&lt;{$invite.name}&gt;</td>
                <td align="right">
                    {if $invite.pic eq ''}
                        <img height='50px' width='50px' src="{$core_url}module/contactimporter/static/image/nophoto_user_thumb_icon.png">
                    {else}
                        <img height='50px' width='50px' src='{$invite.pic}'>
                    {/if}
                </td>
                </tr>


        {foreachelse}
            <tr class='thTableOddRow'>
                <td align='center' style='padding:20px;' colspan='3'>
                    {phrase var='contactimporter.not_have_any_contacts'}.
                </td>
            </tr>
        {/foreach}
        </table>
        </div>
        <div class="clear"></div>
        <div class="autocomplete" style="float:left;font-weight: bold;font-size: 13px;">
            <a id="toggleCurrent_id" href="javascript:void(0)" onclick="toggleCurrent(this)">Select Current Page</a> ||
            <a id="viewSelected_id" href="javascript:void(0)" onclick="viewSelected(this)">View All Selected Contacts</a>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
            var counter = <?php echo $counter?>;
            {literal}
            var total_allow_select ={/literal}{$max_invitation}{literal} ;
        </script>{/literal}

        <div class="form-wrapper" id="message-wrapper" style="clear:both">
        <div class="form-label" id="message-label" style="width: 120px;text-align: left;">
        <label class="optional" for="message">{phrase var='contactimporter.custom_message_title'}
        <textarea rows="6" cols="45" id="message" name="message">{phrase var='contactimporter.default_invite_message_text'}</textarea>
        </label></div>
        <div class="form-element" id="message-element">

        </div>
        </div>
        <table>
        <tr>
        <td>
        <input type="hidden" value="is_linkedAPI" name="is_linkedAPI" />
        <input type="hidden" value="{$is_and_YT}" name ="is_and_YT"/>
        <input type="hidden" value="{$res.oauth_token}" name="responseLink[oauth_token]" />
        <input type="hidden" value="{$res.oauth_verifier}" name="responseLink[oauth_verifier]" />

        <input type="hidden" value="{$in_lst}" name="invite_list" />
        <input type="hidden" value="do_add" name="task" />
        <input type="hidden" value="{$plugType}" name="plugType" />
        <input type="hidden" name="oi_session_id" value="{$oi_session_id}">
        <input type="hidden" name="provider_box" value="{$provider_box}">
        <span>
        <input class="button" type='submit' id='submit' name='send' value="{phrase var='contactimporter.send_invites'}" />
        <input class="button" type='button' id='' name='send' value ="Skip &gt;&gt;" onclick="document.getElementById('skip').submit();">
        </span>

        </td>
        </form>
        <td>

        </td></tr></table>

        <form  method="post" action="{url link='contactimporter'}" id="skip">
        <input type="hidden" value="{$in_lst}" name="invite_list" />
        <input type="hidden" value="$plugType" name="plugType" />
        <input type='hidden' name='oi_session_id' value='{$oi_session_id}'>
        <input type='hidden' name='provider_box' value='{$provider_box}'>
        <input type="hidden" value="skip" name="task" />
        </form>


    </div>
    </div>

{/if}
<h3>{phrase var='invite.send_a_custom_invitation_link'}</h3>
    {phrase var='invite.send_friends_your_custom_invitation_link_by_copy_and_pasting_it_into_your_own_email_application'}:
    <div class="p_4">
        <input type="text" name="null" value="{$sIniviteLink}" id="js_custom_link" size="40" style="width:75%;" onfocus="this.select();" />
    </div>
<script type="text/javascript">

 {literal}
    if (opener)
    {
        if( opener.location.href == self.location.href ){
            // alert(self.location.href);


        }else{

            //top.location.href = self.location.href;
            self.close();
            opener.location.href = self.location.href;
        }
    }
 {/literal}
  {literal}
 function setWaiting()
 {

     ele = document.getElementById('div_list_view').style.backgroundImage = "{/literal}{$core_url}{literal}module/contactimporter/static/image/loading.gif";
 }
  function unsetWaiting()
 {

     ele = document.getElementById('div_list_view').style.backgroundImage = "";
 }
  {/literal}
 </script>
