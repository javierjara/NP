<div style="width: 80%; float:left;">
{foreach name=aEdFields from=$aEdFields key=iKey item=aEdField}
			{if $aEdField.name != 'class_year'}
				{assign var=fname value=$aEdField.name}
				{if $aEdField.type == 1}
					{if $aEdField.name == 'institution'}
						{if $aEducation[$fname]|is_array}
						<div style="padding-bottom: 3px;">{foreach from=$aEducation[$fname] key=iKey item=aEduText}<a href="{$sEmpUrl}{$aEdField.url_name}_{$aEduText|trim|urlencode}"><span style="font-size: 12px;font-weight:bold;">{$aEduText|trim|clean}</span></a>{/foreach}</div>
						{/if}
					{else}
						{if $aEdField.searchable == 1}
							{if $aEducation[$fname]|is_array}
								&middot; {foreach from=$aEducation[$fname] key=iKey item=aEduText}<a href="{$sEmpUrl}{$aEdField.url_name}_{$aEduText|trim|urlencode}">{$aEduText|trim|clean}</a>{/foreach}
							{/if}
						{else}
							{if $aEducation[$fname]|is_array}
								&middot; {foreach from=$aEducation[$fname] key=iKey item=aEduText}{$aEduText|trim|clean}{/foreach}
							{/if}
						{/if}
					{/if}	
				{/if}
				
				{if $aEdField.type == 4}
					{if $aEducation.attended_for == 1}
						<a href="{$sEmpUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.elementary_school'}</a>
					{elseif $aEducation.attended_for == 2}
						<a href="{$sEmpUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.high_school'}</a>
					{elseif $aEducation.attended_for == 3}
						<a href="{$sEmpUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.college'}</a>
					{elseif $aEducation.attended_for == 4}
						<a href="{$sEmpUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.graduate_school'}</a>
					{elseif $aEducation.attended_for == 5}
						<a href="{$sEmpUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.professional_school'}</a>
					{/if}
				{/if}
				
			{else}
				{if $aEducation.is_present == 1}
					&middot; <a href="{$sEmpUrl}is-present_1">{phrase var='userinfo.still_attending'}</a>
				{else}
					&middot; <a href="{$sEmpUrl}class-year_{$aEducation.class_year}">{phrase var='userinfo.class_of'} {$aEducation.class_year}</a>
				{/if}
			{/if}
		{/foreach}
		
		{foreach name=aEdFields from=$aEdFields key=iKey item=aEdField}
			{if $aEdField.name != 'class_year'}
				{assign var=fname value=$aEdField.name}
				{if $aEdField.type == 2}
					{if $aEducation[$fname] != ''}
							<div style="margin-top: 4px;width: 80%;">
								{$aEducation[$fname]|trim}
							</div>
					{/if}
				{/if}
			{/if}
		{/foreach}
</div>
<div style="width: 20%; float:left;">
	<div style="width: 25px; float:left;">
			<span id="js_education_{$aEducation.id}_loading" style="display:none;">{img theme='ajax/small.gif'}</span>
					<span id="js_education_{$aEducation.id}_edit"><a href="#" onclick="$('#js_education_{$aEducation.id}_edit').hide();$('#js_education_{$aEducation.id}_loading').show();$.ajaxCall('userinfo.edit', 'id={$aEducation.id}&type=2', 'GET');return false;" class="employment_delete js_hover_title" title="Edit">{img theme='misc/page_white_edit.png'}<span class="js_hover_info">{phrase var='userinfo.edit'}</span></a></span>
	</div>
	<div style="width: 25px; float:left;">
			<a href="#" onclick="$.ajaxCall('userinfo.delete', 'id={$aEducation.id}&type=2', 'GET'); return confirm('Are you sure?');"}" class="employment_delete js_hover_title" title="Delete">{img theme='misc/delete.gif'}<span class="js_hover_info">{phrase var='userinfo.delete'}</span></a>
	</div>
</div>