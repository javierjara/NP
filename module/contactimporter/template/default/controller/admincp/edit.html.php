<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_Contact
 * @version 		$Id: index.html.php 1424 2010-01-25 13:34:36Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<form method="post" action="{url link='admincp.contactimporter.edit'}">
<div class="table_header">
	{phrase var='contactimporter.contact_providers_edit'}
</div>
<div class="table">
	<div class="table_left">
		{phrase var='contactimporter.contact_providers_name'}:
	</div>
	<div class="table_right">
		{$provider.name}
	</div>
	<div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{phrase var='contactimporter.contact_providers_title'}:
	</div>
	<div class="table_right">
		<input type="text" value ="{$provider.title}" name="provider_edit[title]"/>
	</div>
	<div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{phrase var='contactimporter.contact_providers_type'}:
	</div>
	<div class="table_right">
		{$provider.type}
	</div>
	<div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{phrase var='contactimporter.admincp_providers_order'}:
	</div>
	<div class="table_right">
		<input type="text" value ="{$provider.order_providers}" name="provider_edit[order]"/>
	</div>
	<div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		Default Domain:
	</div>
	<div class="table_right">
		<input type="text" value ="{$provider.default_domain}" name="provider_edit[default_domain]"/>
	</div>
	<div class="clear"></div>
</div>
<div class="table">
	<div class="table_left">
		{phrase var='contactimporter.contact_providers_active'}:
	</div>
	<div class="table_right">
		<select name="provider_edit[enable]">
		<option value="1" {if $provider.enable == 1 } selected {/if}>Enable</option>
		<option value="0" {if $provider.enable == 0 } selected {/if}>Disable</option>
		</select>
		
	</div>
	<div class="clear"></div>
</div>

<div class="table_clear">
	<input type="hidden" name="provider" value="{$provider.name}" id="provider"/>
	<input type="submit" name="edit" value="{phrase var='core.submit'}" class="button" />		
</div>
</form>