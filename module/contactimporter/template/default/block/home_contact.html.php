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

<!--
    <script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js" /> </script>
    <script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/jquery.autocomplete.js" /></script>
-->

<script  type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js" /></script>

{literal}
<style type="text/css">
	#homecontact {
		
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
	
<div style="clear:both;width:100%;display:block"></div>
<span style="display:block;text-align: right;padding-right: 20px;"><a alt="{phrase var='contactimporter.view_all_of_providers'}" title="{phrase var='contactimporter.view_all_of_providers'}" href="{$more_path}">
    <img src="static/image/invite-friends-banner.png" style="width='250px'; height='250px'; border-radius: 10px;" /></a></span>
</div>			
<div style="clear:both;width:100%;display:block"></div>
</center>