<form method="post" action="#" onsubmit="$('#js_employment_{$aEmployment.id}_submit').show();$(this).ajaxCall('userinfo.update', 'id={$aEmployment.id}&type=1'); return false;">
{foreach name=aFields from=$aFields item=aField}
	{if $aField.name == 'date'}
		<div {if $aField.name.id != 1}style="margin-top: 6px;"{/if}>
			<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:employmentHideTo({$aEmployment.id})" {if isset($aEmployment)}{if $aEmployment.is_present == 1}checked="checked"{/if}{/if} />{phrase var='userinfo.still_here'}</label>
			<div style="height: 30px;margin-top: 10px;">
				<select id="month_from" name="val[month_from]">
					{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
						<option value="{$iKey}" {if isset($aEmployment)}{if $aEmployment.month_from == $iKey}selected="selected"{/if}{/if}>{$aMonth}</option>
					{/foreach}
				</select>&nbsp;
				<select id="year_from" name="val[year_from]">
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}" {if isset($aEmployment)}{if $aEmployment.year_from == $iKey}selected="selected"{/if}{/if}}>{$aYear}</option>
					{/foreach}
				</select>
				<span id="date_to_container{$aEmployment.id}" {if isset($aEmployment) && $aEmployment.is_present == 1}style="display:none;"{/if}>
				&nbsp;to&nbsp;
				<select id="month_to{$aEmployment.id}" name="val[month_to]">
					{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
						<option value="{$iKey}" {if isset($aEmployment)}{if $aEmployment.month_to == $iKey}selected="selected"{/if}{/if}>{$aMonth}</option>
					{/foreach}
				</select>&nbsp;
				<select id="year_to{$aEmployment.id}" name="val[year_to]" >
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}" {if isset($aEmployment)}{if $aEmployment.year_to == $iKey}selected="selected"{/if}{/if}>{$aYear}</option>
					{/foreach}
				</select>
				</span>
				<span id="date_present_container{$aEmployment.id}" {if !isset($aEmployment) || (isset($aEmployment) && $aEmployment.is_present == 0)}style="display:none;"{/if}>
				&nbsp;{phrase var='userinfo.to'} {phrase var='userinfo.present'}
				</span>
		</div>
			
	{else}
		<div {if $aField.name.id != 1}style="margin-top: 6px;"{/if}>
				{assign var=fid value=$aField.name}
				
				{if $aField.type == 1}
					<input type="text" size="33" id="{$aField.name}{$aEmployment.id}" name="val[{$aField.name}]" value="{if isset($aEmployment)}{$aEmployment[$fid]}{/if}" />
				{elseif $aField.type == 2}
					<textarea rows="5" cols="25" id="{$aField.name}" name="val[{$aField.name}]">{if isset($aEmployment)}{$aEmployment[$fid]}{/if}</textarea>
				{/if}
		</div>
	{/if}
{/foreach}

<div class="table_clear" style="margin-top: 8px;">
	<input type="submit" value="{phrase var='userinfo.save_changes'}" class="button" />&nbsp;&nbsp;<span id="js_employment_{$aEmployment.id}_submit" style="display:none;">{img theme='ajax/small.gif'}</span>
</div>

<div class="clear"></div>		
	<div class="p_4" style="font-size: 10px;">
		{required} {phrase var='userinfo.required_field'}
	</div>	
	<div class="p_4" style="font-size: 10px;">
	{phrase var='userinfo.create_tags'}
	</div>
</form>