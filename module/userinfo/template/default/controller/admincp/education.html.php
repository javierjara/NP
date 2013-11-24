{module name='help.info' phrase='userinfo.admin_tip'}
{module name='help.info' phrase='userinfo.admin_tip2'}
{$sCreateJs}
<form method="post" action="{url link="admincp.userinfo.education"}" onsubmit="return startProcess({$sGetJsForm}, false);" name="empform" id="empform">
	<div class="table_header">
	{phrase var='userinfo.add_field'}
	</div>
	<div class="table">
		<div class="table_left">
			{img theme='misc/add.png'}&nbsp;{phrase var='userinfo.field'}
		</div>
		<div class="table_right">
			<input type="text" id="name" name="val[name]" size="32" value="{value type='input' id='name' default=''}" />&nbsp;
			<select id="type" name="val[type]">
				<option value="1" {value type='select' id='type' default='1'}>{phrase var='userinfo.text_field'}</option>
				<option value="2" {value type='select' id='type' default='2'}>{phrase var='userinfo.text_box'}</option>
			</select>
			<br /><input type="checkbox" id="required"  name="val[required]" value="1" class="checkbox v_middle" {value type='checkbox' id='required' default='0'}/> {phrase var='userinfo.required'}<br />			
			<input type="checkbox" id="searchable"  name="val[searchable]" value="1" class="checkbox v_middle" {value type='checkbox' id='required' default='0'}/> {phrase var='userinfo.searchable'}
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{phrase var='admincp.submit'}" class="button" />
	</div>
</form>
<br />

<form method="post" action="{url link="admincp.userinfo.education"}">	
<div class="table_header">
	Manage Fields
</div>
	<table>
	<tr>
		<th style="width:10px;">&nbsp;</th>
		<th style="width:150px;">{phrase var='userinfo.field'}</th>
		<th>{phrase var='userinfo.info'}</th>
		<th style="width:150px;">{phrase var='userinfo.actions'}</th>
		<th class="t_center" style="width:80px;">{phrase var='userinfo.required'}</th>
		<th class="t_center" style="width:80px;">{phrase var='userinfo.searchable'}</th>
	</tr>
	{foreach from=$aFields name=aFields key=iKey item=aField}
	<tr id="js_row{$aField.id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td style="vertical-align:middle;"><input type="checkbox" name="id[]" class="checkbox" value="{$aField.id}|{$aField.name}" id="js_id_row{$aField.id}" {if $aField.name == 'institution' || $aField.name == 'date' || $aField.name == 'attended_for'}disabled="disabled"{/if} /></td>
		<td style="vertical-align:middle;">
				{$aField.ucname|clean}
		</td>
		<td style="vertical-align:middle;">{if $aField.type == 0}{phrase var='userinfo.date'}{elseif $aField.type == 1}{phrase var='userinfo.text_field'}{elseif $aField.type == 2}{phrase var='userinfo.text_box'}{elseif $aField.type == 4}{phrase var='userinfo.drop_down'}{/if}<br />{phrase var='userinfo.language_phrase'}: <span style="font-style:italic">userinfo.field_{$aField.name}</span></td>
		<td class="t_center" style="vertical-align:middle;">{if $aField.id != 1 && $aField.id != 2}<div id="form_container"><div id="left_forms" style="float:left">{if {$iKey != 0 && $iKey != 1 && $iKey != 2}<div id="form1" style="float:left;"><form action="{url link='admincp.userinfo.education'}" method="post"><input type="hidden" name="field_id" value="{$aField.id}" /><input class="button" id="fldup" name="fldup" type="submit" value="{phrase var='userinfo.up'}" style="margin-left:0;" /></form></div>{/if}{if {$aField.position < count($aFields)}<div id="form2" style="float:left;"><form action="{url link='admincp.userinfo.education'}" method="post"><input type="hidden" name="field_id" value="{$aField.id}" /><input class="button" id="flddown" name="flddown" type="submit" value="{phrase var='userinfo.down'}" {if {$iKey != 0 && $iKey != 1 && $iKey != 2}style="margin-left:5px;"{/if} /></form></div>{/if}</div>{/if}</td>
		<td class="t_center" style="vertical-align:middle;">
			{if $aField.name == 'institution' || $aField.name == 'class_year' || $aField.name == 'attended_for'}
				{phrase var='userinfo.yes'}
			{else}
				<div><input type="hidden" name="req[{$aField.id}][id]" value="{$aField.id}" />
				<input type="checkbox" name="req[{$aField.id}][required]" value="1" {if $aField.required == 1}checked="checked" {/if}/></div>
			{/if}
		</td>
		<td class="t_center" style="vertical-align:middle;">
			{if $aField.name == 'institution' || $aField.name == 'class_year' || $aField.name == 'attended_for'}
				{phrase var='userinfo.yes'}
			{else}
				<div><input type="hidden" name="search[{$aField.id}][id]" value="{$aField.id}" />
				<input type="checkbox" name="search[{$aField.id}][search]" value="1" {if $aField.searchable == 1}checked="checked" {/if}/></div>
			{/if}
		</td>
	</tr>
	{/foreach}
	</table>
	<div class="table_bottom">
		<input type="submit" name="update" value="{phrase var='core.update'}" class="button" />&nbsp;<input type="submit" name="delete" value="{phrase var='userinfo.delete_selected'}" class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true" />
	</div>
</form>