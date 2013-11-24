<div style="width: 85%;">
	{foreach name=aEducations key=iKey from=$aEducations item=aEducation}
	<div class="main_break"></div>
	{if $iKey != 0}
		<div style="height: 15px;"></div>
	{/if}
	<div style="width: 100%;">
		<div style="width:110px; text-align:center;float:left;">
			{img user=$aEducation suffix='_50' max_width=50 max_height=50}<br />
			<div style="width: 95%;margin: 0 auto;">
			<a href="{url link=$aEducation.user_name}">{$aEducation.full_name}</a>
			</div>
		</div>
		
		<div style="width: 80%; float:left;">
		{foreach name=aEdFields from=$aEdFields key=iKey item=aEdField}
			{if $aEdField.name != 'class_year'}
				{assign var=fname value=$aEdField.name}
				{if $aEdField.type == 1}
					{if $aEdField.name == 'institution'}
						{if $aEducation[$fname]|is_array}
						<div style="padding-bottom: 5px;">{foreach from=$aEducation[$fname] key=iKey item=aEduText}<a href="{$sEduUrl}{$aEdField.url_name}_{$aEduText|trim|urlencode}"><span style="font-size: 14px;font-weight:bold;">{$aEduText|trim|clean}</span></a>{/foreach}</div>
						{/if}
					{else}
						{if $aEdField.searchable == 1}
							{if $aEducation[$fname]|is_array}
								&middot; {foreach from=$aEducation[$fname] key=iKey item=aEduText}<a href="{$sEduUrl}{$aEdField.url_name}_{$aEduText|trim|urlencode}">{$aEduText|trim|clean}</a>{if $iKey != (count($aEducation[$fname]) - 1)},&nbsp;{/if}{/foreach}
							{/if}
						{else}
							{if $aEducation[$fname]|is_array}
							&middot; {foreach from=$aEducation[$fname] key=iKey item=aEduText}{$aEduText|trim|clean}{if $iKey != (count($aEducation[$fname]) - 1)},&nbsp;{/if}{/foreach}
						{/if}
						{/if}
					{/if}
				{/if}
				
				{if $aEdField.type == 4}
					{if $aEducation.attended_for == 1}
						<a href="{$sEduUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.elementary_school'}</a>
					{elseif $aEducation.attended_for == 2}
						<a href="{$sEduUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.high_school'}</a>
					{elseif $aEducation.attended_for == 3}
						<a href="{$sEduUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.college'}</a>
					{elseif $aEducation.attended_for == 4}
						<a href="{$sEduUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.graduate_school'}</a>
					{elseif $aEducation.attended_for == 5}
						<a href="{$sEduUrl}attended-for_{$aEducation.attended_for|urlencode}">{phrase var='userinfo.professional_school'}</a>
					{/if}
				{/if}
				
			{else}
				{if $aEducation.is_present == 1}
					&middot; <a href="{$sEduUrl}is-present_1">{phrase var='userinfo.still_attending'}</a>
				{else}
					&middot; <a href="{$sEduUrl}class-year_{$aEducation.class_year}">{phrase var='userinfo.class_of'} {$aEducation.class_year}</a>
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
	</div>
	<div style="clear:both;"></div>
	{foreachelse}
	<div class="p_4">{phrase var='userinfo.no_educations'}.</div>
	{/foreach}

{if count($aEducations) > 0 && $iCnt > count($aEducations)}
{if isset($aPager) && $aPager.totalPages > 1}
<div class="pager_outer" style="margin-top: 50px;">
	<div class="pager_right">
		<ul class="pager">
			<li>{phrase var='core.page_x_of_x' current=$aPager.current total=$aPager.totalPages}&nbsp;&nbsp;</li>
			{if isset($aPager.firstUrl)}<li><a href="{$aPager.firstUrl}">{phrase var='core.first'}</a></li>{/if}
			{if isset($aPager.prevUrl)}<li><a href="{$aPager.prevUrl}">{phrase var='core.previous'}</a></li>{/if}
		{foreach from=$aPager.urls key=sLink item=sPage}
			<li><a href="{$sLink}" onclick="href="{if $sLink}{$sLink}{else}javascript:void(0);{/if}"{if !$sLink} class="active"{/if}>{$sPage}</a></li>
		{/foreach}
			{if isset($aPager.nextUrl)}<li><a href="{$aPager.nextUrl}">{phrase var='core.next'}</a></li>{/if}
			{if isset($aPager.lastUrl)}<li><a href="{$aPager.lastUrl}">{phrase var='core.last'}</a></li>{/if}
		</ul>		
	</div>
</div>
{/if}
{/if}
<div class="main_break"></div>
</div>