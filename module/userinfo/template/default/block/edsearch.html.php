<form method="post" action="{url link='userinfo.education'}">
<div class="p_bottom_15">
	
{foreach name=aEdFields from=$aEdFields item=aEdField}
	{if $aEdField.name == 'class_year'}
		<div style="margin-top: 3px;">
			{phrase var='userinfo.field_class_year'}:
			<div class="p_4">
				<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:educationHideToFilter()" {if isset($aSearch)}{if $aSearch.is_present == 1}checked="checked"{/if}{/if} />{phrase var='userinfo.currently_attend_here'}</label>
			</div>
		</div>
				
		<div id="date_to_container" style="margin-top: 3px;{if isset($aSearch) && $aSearch.is_present == 1}display:none;{/if}" >
			<div class="p_4">
				<select id="class_year" name="val[class_year]" >
						{foreach name=aYears key=iKey from=$aYears item=aYear}
							<option value="{$iKey}" {if isset($aSearch)}{if $aSearch.class_year == $iKey}selected="selected"{/if}{/if}>{$aYear}</option>
						{/foreach}
					</select>
			</div>
		</div>
	
	{elseif $aEdField.name == 'attended_for'}
		<div style="margin-top: 3px;">
			{phrase var='userinfo.field_attended_for'}:
			<div class="p_4">
				<select id="attended_for" name="val[attended_for]" >
					<option value="0" {if isset($aSearch)}{if $aSearch.attended_for == 0}selected="selected"{/if}{/if}>{phrase var='userinfo.type'}:</option>
					<option value="1" {if isset($aSearch)}{if $aSearch.attended_for == 1}selected="selected"{/if}{/if}>{phrase var='userinfo.elementary_school'}</option>
					<option value="2" {if isset($aSearch)}{if $aSearch.attended_for == 2}selected="selected"{/if}{/if}>{phrase var='userinfo.high_school'}</option>
					<option value="3" {if isset($aSearch)}{if $aSearch.attended_for == 3}selected="selected"{/if}{/if}>{phrase var='userinfo.college'}</option>
					<option value="4" {if isset($aSearch)}{if $aSearch.attended_for == 4}selected="selected"{/if}{/if}>{phrase var='userinfo.graduate_school'}</option>
					<option value="5" {if isset($aSearch)}{if $aSearch.attended_for == 5}selected="selected"{/if}{/if}>{phrase var='userinfo.professional_school'}</option>
				</select>
			</div>
		</div>
		
	{else}
		<div style="margin-top: 3px;{if !$aEdField.searchable}display:none;{/if}">
			{$aEdField.rep_name}:
			<div class="p_4">
				{assign var=fid value=$aEdField.name}
					<input type="text" size="32" id="{$aEdField.name}" name="val[{$aEdField.name}]" value="{if isset($aSearch)}{$aSearch[$fid]}{/if}" />
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