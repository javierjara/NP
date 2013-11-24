<form method="post" action="#" onsubmit="$('#js_education_{$aEducation.id}_submit').show();$(this).ajaxCall('userinfo.update', 'id={$aEducation.id}&type=2'); return false;">
{foreach name=aEdFields from=$aEdFields item=aEdField}
	{if $aEdField.name == 'class_year'}
	<div class="table">
		<div class="table_left">
		<label for="title">{phrase var='userinfo.field_class_year'}{required}:</label>
		</div>
		<div class="table_right">
			<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:educationHideTo({$aEducation.id})" {if isset($aEducation)}{if $aEducation.is_present == 1}checked="checked"{/if}{/if} />{phrase var='userinfo.still_here_edu'}</label>
			<div id="class_year_container{$aEducation.id}" style="height: 30px;margin-top: 10px;{if isset($aEducation)}{if $aEducation.is_present == 1}display:none;"{/if}{/if}">
				<select id="class_year{$aEducation.id}" name="val[class_year]" >
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}" {if isset($aEducation)}{if $aEducation.class_year == $iKey}selected="selected"{/if}{/if}>{$aYear}</option>
					{/foreach}
				</select>
			</div>
			
		</div>
	</div>
	
	{elseif $aEdField.name == 'attended_for'}
	<div class="table">
		<div class="table_left">
		<label for="title">{phrase var='userinfo.field_attended_for'}{required}:</label>
		</div>
		<div class="table_right">
				<select id="attended_for" name="val[attended_for]" >
					<option value="0" {if isset($aEducation)}{if $aEducation.attended_for == 0}selected="selected"{/if}{/if}>{phrase var='userinfo.type'}:</option>
					<option value="1" {if isset($aEducation)}{if $aEducation.attended_for == 1}selected="selected"{/if}{/if}>{phrase var='userinfo.elementary_school'}</option>
					<option value="2" {if isset($aEducation)}{if $aEducation.attended_for == 2}selected="selected"{/if}{/if}>{phrase var='userinfo.high_school'}</option>
					<option value="3" {if isset($aEducation)}{if $aEducation.attended_for == 3}selected="selected"{/if}{/if}>{phrase var='userinfo.college'}</option>
					<option value="4" {if isset($aEducation)}{if $aEducation.attended_for == 4}selected="selected"{/if}{/if}>{phrase var='userinfo.graduate_school'}</option>
					<option value="5" {if isset($aEducation)}{if $aEducation.attended_for == 5}selected="selected"{/if}{/if}>{phrase var='userinfo.professional_school'}</option>
				</select>
		</div>
	</div>
	
	{else}
		<div class="table">
			<div class="table_left">
				{$aEdField.rep_name}{if $aEdField.required == 1}{required}{/if}:
			</div>
			<div class="table_right">
				{assign var=fid value=$aEdField.name}
				
				{if $aEdField.type == 1}
					<input type="text" size="33" id="{$aEdField.name}{$aEducation.id}" name="val[{$aEdField.name}]" value="{if isset($aEducation)}{$aEducation[$fid]}{/if}" />
				{elseif $aEdField.type == 2}
					<textarea rows="5" cols="25" id="{$aEdField.name}" name="val[{$aEdField.name}]">{if isset($aEducation)}{$aEducation[$fid]}{/if}</textarea>
				{/if}
			</div>
		</div>
	{/if}
{/foreach}

<div class="table_clear" style="margin-top: 8px;">
	<input type="submit" value="{phrase var='userinfo.save_changes'}" class="button" />&nbsp;&nbsp;<span id="js_education_{$aEducation.id}_submit" style="display:none;">{img theme='ajax/small.gif'}</span>
</div>

<div class="clear"></div>		
	<div class="p_4" style="font-size: 10px;">
		{required} {phrase var='userinfo.required_field'}
	</div>	
	<div class="p_4" style="font-size: 10px;">
	{phrase var='userinfo.create_tags'}
	</div>
</form>