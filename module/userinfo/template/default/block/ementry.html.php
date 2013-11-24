<div style="width: 80%; float:left;">
{foreach name=aFields from=$aFields key=iKey item=aField}
	{if $aField.name != 'date'}
		{assign var=fname value=$aField.name}
		{if $aField.type == 1}
			{if $aField.name == 'employer'}
				{if $aEmployment[$fname]|is_array}
				<div style="padding-bottom: 3px;">{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aField.url_name}_{$aEmpText|trim|urlencode}"><span style="font-size: 12px;font-weight:bold;">{$aEmpText|trim|clean}</span></a>{/foreach}</div>
			{/if}
			{else}
				{if $aField.searchable == 1}
					{if $aEmployment[$fname]|is_array}
						{if $aField.name != 'position'}&middot;{/if} {foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aField.url_name}_{$aEmpText|trim|urlencode}">{$aEmpText|trim|clean}</a>{/foreach}
					{/if}
				{else}
					{if $aEmployment[$fname]|is_array}
						{if $aField.name != 'position'}&middot;{/if} {foreach from=$aEmployment[$fname] key=iKey item=aEmpText}{$aEmpText|trim|clean}{/foreach}
					{/if}
				{/if}
			{/if}	
		{/if}
		
	{else}
		&middot; <a href="{$sEmpUrl}month-from_{$aEmployment.month_from}/year-from_{$aEmployment.year_from}">{$aEmployment.month_from_str} {$aEmployment.year_from}</a> {if $aEmployment.is_present == 1}{phrase var='userinfo.to'} <a href="{$sEmpUrl}is-present_1">{phrase var='userinfo.present'}</a>{else}{phrase var='userinfo.to'} <a href="{$sEmpUrl}searched_1/month-to_{$aEmployment.month_to}/year-to_{$aEmployment.year_to}">{$aEmployment.month_to_str} {$aEmployment.year_to}</a>{/if}
	{/if}
{/foreach}

{foreach name=aFields from=$aFields key=iKey item=aField}
	{if $aField.name != 'date'}
		{assign var=fname value=$aField.name}
		{if $aField.type == 2}
			{if $aEmployment[$fname] != ''}
					<div style="margin-top: 4px;width: 80%;">
						{$aEmployment[$fname]|trim}
					</div>
			{/if}
		{/if}
	{/if}
{/foreach}
</div>
<div style="width: 20%; float:left;">
	<div style="width: 25px; float:left;">
			<span id="js_employment_{$aEmployment.id}_loading" style="display:none;">{img theme='ajax/small.gif'}</span>
				<span id="js_employment_{$aEmployment.id}_edit"><a href="#" onclick="$('#js_employment_{$aEmployment.id}_edit').hide();$('#js_employment_{$aEmployment.id}_loading').show();$.ajaxCall('userinfo.edit', 'id={$aEmployment.id}&type=1', 'GET');return false;" class="employment_delete js_hover_title" title="Edit">{img theme='misc/page_white_edit.png'}<span class="js_hover_info">{phrase var='userinfo.edit'}</span></a></span>
	</div>
	<div style="width: 25px; float:left;">
			<a href="#" onclick="$.ajaxCall('userinfo.delete', 'id={$aEmployment.id}&type=1', 'GET'); return confirm('Are you sure?');"}" class="employment_delete js_hover_title" title="Delete">{img theme='misc/delete.gif'}<span class="js_hover_info">{phrase var='userinfo.delete'}</span></a>
	</div>
</div>