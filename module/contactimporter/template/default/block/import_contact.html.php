<h3 style="border:none">{phrase var='contactimporter.import_email_contact_list'}</h3>
{if isset($plugType)}
	{if isset($errors) and count($errors) > 0}
		{foreach from= $errors  item=er}
		 <div id="errros_div_h" ><ul class='form-errors'>
		 <li><ul class='errors'><li>{$er}</li></ul></li></ul></div>
		{/foreach}
	{/if}
{/if}
<div class="mail_list">                     
{foreach from=$provider_lists item = email}
	{if $email.logo !=''}   
	<form id="get_contact_email" onsubmit="sending_request();" enctype="" class="global_form" action="{url link='contactimporter'}" method="post" autocomplete="off">                                                              
		<span id="form_{$email.name}"></span>
		{if $email.name eq 'yahoo'}
			<a  id="yahoo" href="#?call=contactimporter.callYahoo&amp;height=80&amp;width=270"  class=" inlinePopup usingapi"  title="{phrase var='contactimporter.yahoo_contacts'}">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png" />
			   <span class="title">{$email.title}</span>
			</a>
		{elseif $email.name eq 'hotmail'}
			<a id="linkedinA" href="#?call=contactimporter.callHotmail&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.hotmail_authorization'}">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
				<span class="title">{$email.title}</span>
			</a>
		{elseif $email.name eq 'linkedin'}
			<a id="linkedinA" href="#?call=contactimporter.callLinkedIn&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.linkedin_authorization'}">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
				<span class="title">{$email.title}</span>
			</a>
		{elseif $email.name eq 'twitter'}
			<a id="twitterA" href="#?call=contactimporter.callTwitter&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.twitter_authorization'}">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
				<span class="title">{$email.title}</span>
			</a>			
		{elseif $email.name eq 'facebook_'}
			<a class="usingapi" id="fbApi" href="{if isset($fbloginUrl)}javascript:popitup('{$fbloginUrl}','Facebook'){else}javascript:void(0);{/if}">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
				<span class="title">{$email.title}</span>
			</a>
		{elseif $email.name eq 'youtube'}
			<a class="usingapi" id="fbApi" href="javascript:openYoutubePopup('http://openid.younetid.com/auth/youtube.php?callbackUrl={url link='contactimporter'}')">
				<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
				<span class="title">{$email.title}</span>
			</a>
		{else}
			<h5 class="trigger" id="trigger_{$email.name}">
				<div class="logo"><img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png" /></div>
				<span class="title">{$email.title}</span>
			</h5>
		{/if}	
   
		<div id="js_form_{$email.name}">
			<div class="form-elements toggle_container">             
				<div id="email_box-wrapper" class="form-wrapper">
					<div id="email_box-label" class="form-label">
						<label for="email_box" class="required" >{phrase var='user.email'}&nbsp;</label>
					</div>
					<div id="email_box-element" class="form-element">
						<input type="text" name="email_box" id="email_box" value="" style="width:205px;">
					</div>							
					<div id="provider_box-element2" class="form-element" style="display:none;">
						<input type='text' value={$email.default_domain} name='tmp' id='provider_box_mail2' style='width:80px;' autocomplete ="OFF"/>
						<input type='hidden' value='' id='provider_box_input2' name='provider_box2'/>
						<input type='hidden' value="{$email.name}" id='provider_box_mail' name='provider_box'/>
					</div>
				</div>
				<div id="password_box-wrapper" class="form-wrapper"  style="margin-bottom:3px">
					<div id="password_box-label" class="form-label">
						<label for="password_box" class="required">{phrase var='user.password'}</label>
						</div>
					<div id="password_box-element" class="form-element">
						<input type="password" style="width:205px" name="password_box" id="password_box" value=""  />
					</div>                                                
				</div>
				<div id="import-element" class="form-element" style="clear:both;">
					<input class="button" name="import" id="import" type="submit" value="{phrase var='contactimporter.import_contact'}"/>
				</div>
			</div>
		</div>
	</form>
	{literal}<script type="text/javascript">
		$Behavior.initContactImporterAPI{/literal}{$email.name}{literal} = function() {
			$(".toggle_container").hide();			
			$("#trigger_{/literal}{$email.name}{literal}").click(
				function() {
					$(".toggle_container").css("display","none");
					$(".trigger").removeClass("active");
					$("#trigger_{/literal}{$email.name}{literal}").addClass("active");
					$("#js_form_{/literal}{$email.name}{literal}  .toggle_container").css("display","block");
					$("#js_form_{/literal}{$email.name}{literal}  .toggle_container").addClass("active");
				}
			);				 
		};
	</script>{/literal}             
	{/if}
{/foreach}
						   
{if isset($uploadcsv) eq 'uploadcsv'}
<div style="margin-bottom:5px;margin-left:10px" ><ul class='form-errors'>
	<li><ul class='errors'><li>{$error_message}</li></ul></li></ul>
</div>
{/if}

<h5 class="trigger" id="trigger_export"><span>{phrase var='contactimporter.other_tools_title'}</span></h5>
	<div id="js_form_export">
		<div class="toggle_container">
			<p class="description">{phrase var='contactimporter.or'} <a href="{url link='invite'}">{phrase var='contactimporter.inviete_by_manually'}</a> </p>
			<div id="uploadcsvform3" style="margin-bottom:10px">
				<form onsubmit="sending_request();" enctype="multipart/form-data" class="global_form" action="{url link='contactimporter'}" method="post">
					<div>
						<span>
							&nbsp;  {phrase var='contactimporter.or'} {phrase var='contactimporter.upload_file_csv'} :
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
			{literal}<script type="text/javascript">
				$Behavior.initContactImporterCSVFile = function() {							
					$(".toggle_container").hide();
					$("#trigger_export").click(function(){
						$(".toggle_container").css("display","none");
						$(".trigger").removeClass("active");
						$("#trigger_export").addClass("active");
						$("#js_form_export  .toggle_container").css("display","block");
						$("#js_form_export  .toggle_container").addClass('active');
					});
				};
			</script>{/literal}
		</div>
	</div>	                             
	{literal}<script type="text/javascript">                                
		  $("#form_{/literal}{if isset($provider_type)}{$provider_type}{/if}{literal}").html($('#errros_div_h').html());
		  $('#errros_div_h').hide();  						  
	</script>{/literal}	
</div>