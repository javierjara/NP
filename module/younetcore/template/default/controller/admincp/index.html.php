<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>

<div style="float:left; width:670px; position:relative;" id="content" class="js_content_parent">
<form action="{url link='admincp.younetcore'}" method="post">
	<div class="error_message" style="font-size:11px;"> {phrase var='younetcore.if_there_are_any_problems_related_younet_core_plugins_and_others_developed_by_younet_company_please'}.
	<input type="hidden" name="recheck" value="Check Problems" />
	<a href="javascript:void(0);" onclick = "$(this).parent().parent().submit();">{phrase var='younetcore.check_problems'}</a> 
	</div>
	
</form>	
<div id="container">
	<ul class="menu">
		<li id="yoursplugin" class="active title">{phrase var='younetcore.yours_plugins'}</li>
		<li id="younetplugins" class="title">{phrase var='younetcore.younet_plugins'}</li>
		<li id="license" class="title">{phrase var='younetcore.license_terms'}</li>
	</ul>
	<div class="clear"></div>
	<div class="content yoursplugin">
			{template file='younetcore.block.yoursplugin'}
		</div>
	<div class="content younetplugins">
			{template file='younetcore.block.younet'}								
		</div>
	<div class="content license">
			{template file='younetcore.block.license'}
	</div>
</div>
</div>
<div style="margin-left:680px; position:relative; width:300px; overflow:hidden;" id="right_content" class="js_content_parent">
	{block location='1'}
	{block location='3'}
</div>
<div class="clear"></div>