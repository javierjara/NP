<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: top.html.php 1318 2009-12-14 22:34:04Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div style="display:none; margin-left:250px; background:url({$core_url}module/contactimporter/static/image/loading_small.gif) no-repeat;width:320px;height:100px;" id="loading">    
		<div style="text-align:left;padding-top:50px;padding-left:-20px; ">{phrase var='contactimporter.sending_request'}</div>
</div>

<link rel="stylesheet" type="text/css" href="{$core_url}module/contactimporter/static/css/default/default/Ynscontactimporter.css" />
<link rel="stylesheet" type="text/css" href="{$core_url}module/contactimporter/static/css/default/default/jquery.autocomplete.css" />
<script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js" /> </script>
<script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/jquery.autocomplete.js" /></script>
<script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js" /></script>

{literal}
<style type="text/css">
	#homecontact {
		padding-left: 8px;
	}
    #homecontact .logoContact {  
		float:left;
		height:{/literal}{$icon_size}{literal}px;        
        width:{/literal}{$icon_size}{literal}px;
		padding:0px 12px 4px 0px;
    }
    #homecontact .logoContact img,#homecontact .logoContact a {
		display:block;
        height:{/literal}{$icon_size}{literal}px;
        width:{/literal}{$icon_size}{literal}px;
    }
</style>
{/literal}
{literal}
<script type="text/javascript">

</script>
{/literal}
<center>
<div id="homecontact">
<table width="100%" border="0"><tr><td align="center">	
{foreach from=$top_5_email item = email}
{if $email.logo !=''}
	{if $email.name eq 'yahoo'}
		<div class="logoContact">
		   <a id="yahoo" href="#?call=contactimporter.callYahoo&amp;height=80&amp;width=270"  class=" inlinePopup usingapi"  title="{phrase var='contactimporter.yahoo_contacts'}">
				<img alt="{$email.title}" title="{$email.title}" src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png" />
		   </a>
		</div>
	{elseif $email.name eq 'hotmail'}
		<div class="logoContact">
			<a id="hotmail" href="#?call=contactimporter.callHotmail&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.hotmail_authorization'}">
				<img alt="{$email.title}" title="{$email.title}" src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
			</a>
		</div>
	{elseif $email.name eq 'linkedin'}
		<div class="logoContact">
		   <a id="linkedinA" href="#?call=contactimporter.callLinkedIn&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.linkedin_authorization'}">
			 <img alt="{$email.title}" title="{$email.title}"  src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png" />
			</a>
		</div>
	{elseif $email.name eq 'twitter'}
	<div class="logoContact">
		<a id="twitterA" href="#?call=contactimporter.callTwitter&amp;height=80&amp;width=270" class="inlinePopup usingapi" title="{phrase var='contactimporter.twitter_authorization'}">
			<img alt="{$email.title}" title="Twitter"  src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
		</a>
	</div>
	{elseif $email.name eq 'facebook_'}
	<div class="logoContact">
		<a class="usingapi" id="fbApi" href="{if isset($fbloginUrl)}javascript:popitup('{$fbloginUrl}','Facebook'){else}javascript:void(0);{/if}">
			<img alt="Facebook" title="Facebook"  src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
		</a>
	</div>
	{elseif $email.name eq 'youtube'}
	<div class="logoContact">
		<a class="usingapi" id="fbApi" href="javascript:popitup('http://openid.younetid.com/auth/youtube.php?callbackUrl={url link='contactimporter'}','youtube')">
			<img alt="{$email.title}" title="{$email.title}" src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png"/>
		</a>
	</div>
	{else}
	<div class="logoContact">
		<a title="{phrase var='contactimporter.import_your_contacts'}" href="#?call=contactimporter.callImporterForm&amp;height=150&amp;width=400&amp;provider_type={$email.type}&amp;default_domain={$email.default_domain}&amp;provider_box={$email.name}" class="inlinePopup">
			<img alt="{$email.title}" title="{$email.title}"  src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png">
		</a>
	</div>
	{/if}
{/if}
{/foreach}
</td></tr></table>	
<div style="clear:both;width:100%;display:block"></div>
<span style="display:block;text-align: right;padding-right: 20px;"><a alt="{phrase var='contactimporter.view_all_of_providers'}" title="{phrase var='contactimporter.view_all_of_providers'}" href="{$more_path}">{phrase var='contactimporter.view_more'} &raquo;</a></span>
</div>			
<div style="clear:both;width:100%;display:block"></div>
</center>