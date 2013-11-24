<form method="post" action="{url link='userinfo.employment'}">
<div class="p_bottom_15">
	
{foreach name=aFields from=$aFields item=aField}
	{if $aField.name == 'date'}
		<div style="margin-top: 3px;">
			{phrase var='userinfo.date'}:
			<div class="p_4">
				<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:employmentHideToFilter()" {if isset($aSearch)}{if $aSearch.is_present == 1}checked="checked"{/if}{/if} />{phrase var='userinfo.currently_work_here'}</label>
			</div>
		</div>
		
		<div style="margin-top: 3px;">
			From:
			<div class="p_4">
				<select id="month_from" name="val[month_from]">
						{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
							<option value="{$iKey}" {if isset($aSearch)}{if $aSearch.month_from == $iKey}selected="selected"{/if}{/if}>{$aMonth}</option>
						{/foreach}
					</select>&nbsp;
					<select id="year_from" name="val[year_from]">
						{foreach name=aYears key=iKey from=$aYears item=aYear}
							<option value="{$iKey}" {if isset($aSearch)}{if $aSearch.year_from == $iKey}selected="selected"{/if}{/if}}>{$aYear}</option>
						{/foreach}
					</select>
			</div>
		</div>
		
		<div id="date_to_container" style="margin-top: 3px;{if isset($aSearch) && $aSearch.is_present == 1}display:none;{/if}" >
		To:
			<div class="p_4">
				<select id="month_to" name="val[month_to]">
						{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
							<option value="{$iKey}" {if isset($aSearch)}{if $aSearch.month_to == $iKey}selected="selected"{/if}{/if}>{$aMonth}</option>
						{/foreach}
					</select>&nbsp;
					<select id="year_to" name="val[year_to]" >
						{foreach name=aYears key=iKey from=$aYears item=aYear}
							<option value="{$iKey}" {if isset($aSearch)}{if $aSearch.year_to == $iKey}selected="selected"{/if}{/if}>{$aYear}</option>
						{/foreach}
					</select>
			</div>
		</div>
	{else}
		<div style="margin-top: 3px;{if !$aField.searchable}display:none;{/if}">
			{$aField.rep_name}:
			<div class="p_4">
				{assign var=fid value=$aField.name}
						<input type="text" size="32" id="{$aField.name}" name="val[{$aField.name}]" value="{if isset($aSearch)}{$aSearch[$fid]}{/if}" />
					
			</div>
		</div>
	{/if}
{/foreach}

<div class="p_top_8" style="margin-left: 8px;">
	<input type="submit" name="search[submit]" value="{phrase var='core.submit'}" class="button" />
	<input type="submit" name="search[reset]" value="{phrase var='core.reset'}" class="button" />	
</div>

</div>

</form>