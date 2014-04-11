<div style="width: 85%;">
{foreach name=aEmployments key=iKey from=$aEmployments item=aEmployment}
	<div class="main_break"></div>
{if $iKey != 0}
	<div style="height: 15px;"></div>
{/if}
	<div style="width: 100%;">
		<div style="width:110px; text-align:center;float:left;">
			{img user=$aEmployment suffix='_50' max_width=50 max_height=50}<br />
			<div style="width: 95%;margin: 0 auto;">
			<a href="{url link=$aEmployment.user_name}">{$aEmployment.full_name}</a>
			</div>
		</div>

		<div style="width: 80%; float:left;">
			{foreach name=aFields from=$aFields key=iKey item=aField}
				{if $aField.name != 'date'}
					{assign var=fname value=$aField.name}
					{if $aField.type == 1}
						{if $aField.name == 'employer'}
							{if $aEmployment[$fname]|is_array}
								<div style="padding-bottom: 5px;">{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aField.url_name}_{$aEmpText|trim|urlencode}"><span style="font-size: 14px;font-weight:bold;">{$aEmpText|trim|clean}</span></a>{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}</div>
							{/if}
						{else}
							{if $aField.searchable == 1}
								{if $aField.name != 'position'}&middot;{/if} {if $aEmployment[$fname]|is_array}
									{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aField.url_name}_{$aEmpText|trim|urlencode}">{$aEmpText|trim|clean}</a>{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}
								{/if}
							{else}
								{if $aField.name != 'position'}&middot;{/if} {if $aEmployment[$fname]|is_array}
									{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}{$aEmpText|trim|clean}{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}
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
</div>
<div style="clear:both;"></div>
{foreachelse}
<div class="p_4">{phrase var='userinfo.no_employments'}.</div>
{/foreach}

{if count($aEmployments) > 0 && $iCnt > count($aEmployments)}
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