<?php 

defined('PHPFOX') or exit('NO DICE!'); 

?>
{if $iEmpCount > 0}
<div style="width: 100px;float:left;">
	<div class="extra_info" style="font-weight:bold;font-size: 12px;"><a href="{$sEmpUrl}user_{$aUser.user_id}">{phrase var='userinfo.employers'}</a></div>
	<div><img src="{$sEmpIcon}" style="width:64px;height:64px;" /></div>
</div>

<div style="width: 65%;float:left;padding-top: 4px;">
	{foreach name=aEmployments key=iKey from=$aEmployments item=aEmployment}
	{foreach name=aEmFields from=$aEmFields key=iKey item=aEmField}
		{if $aEmField.name != 'date'}
			{assign var=fname value=$aEmField.name}
			{if $aEmField.type == 1}
			
				{if $aEmField.name == 'employer'}
					{if $aEmployment[$fname]|is_array}
					<div style="padding-bottom: 3px;">{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aEmField.url_name}_{$aEmpText|trim|urlencode}"><span style="font-size: 12px;font-weight:bold;">{$aEmpText|trim|clean}</span></a>{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}</div>
				{/if}
				{else}
					{if $aEmField.searchable == 1}
						{if $aEmployment[$fname]|is_array}
							{if $aEmField.name != 'position'}&middot; {/if}{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}<a href="{$sEmpUrl}{$aEmField.url_name}_{$aEmpText|trim|urlencode}">{$aEmpText|trim|clean}</a>{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}
						{/if}
					{else}
						{if $aEmployment[$fname]|is_array}
							{if $aEmField.name != 'position'}&middot; {/if}{foreach from=$aEmployment[$fname] key=iKey item=aEmpText}{$aEmpText|trim|clean}{if $iKey != (count($aEmployment[$fname]) - 1)},&nbsp;{/if}{/foreach}
						{/if}
					{/if}
				{/if}	
			{/if}
			
		{else}
			&middot; <a href="{$sEmpUrl}month-from_{$aEmployment.month_from}/year-from_{$aEmployment.year_from}">{$aEmployment.month_from_str} {$aEmployment.year_from}</a> {if $aEmployment.is_present == 1}{phrase var='userinfo.to'} <a href="{$sEmpUrl}is-present_1">{phrase var='userinfo.present'}</a>{else}{phrase var='userinfo.to'} <a href="{$sEmpUrl}searched_1/month-to_{$aEmployment.month_to}/year-to_{$aEmployment.year_to}">{$aEmployment.month_to_str} {$aEmployment.year_to}</a>{/if}
		{/if}
	{/foreach}
	{if Phpfox::getParam('userinfo.show_text_boxes')}
	{foreach name=aEmFields from=$aEmFields key=iKey item=aEmField}
		{if $aEmField.name != 'date'}
			{assign var=fname value=$aEmField.name}
			{if $aEmField.type == 2}
				{if $aEmployment[$fname] != ''}
						<div style="margin-top: 4px;width: 80%;">
							{$aEmployment[$fname]|trim}
						</div>
				{/if}
			{/if}
		{/if}
	{/foreach}
	{/if}
	<div style="height: 15px;"></div>
{/foreach}
</div>
<div style="clear:both;"></div>
{/if}

{if $iEduCount > 0}
<div style="width: 100px;float:left;{if $iEmpCount > 0}margin-top: 15px;{/if}">
	<div class="extra_info" style="font-weight:bold;font-size: 12px;"><a href="{$sEmpUrl}user_{$aUser.user_id}">{phrase var='userinfo.education'}</a></div>
	<div><img src="{$sEduIcon}" style="width:64px;height:64px;" /></div>
</div>

<div style="width: 65%;float:left;padding-top: 4px;{if $iEmpCount > 0}margin-top: 15px;{/if}">
	{foreach name=aEducations key=iKey from=$aEducations item=aEducation}
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
								{if $aEdField.name != 'attended_for'}&middot; {/if}{foreach from=$aEducation[$fname] key=iKey item=aEduText}<a href="{$sEmpUrl}{$aEdField.url_name}_{$aEduText|trim|urlencode}">{$aEduText|trim|clean}</a>{/foreach}
							{/if}
						{else}
							{if $aEducation[$fname]|is_array}
								{if $aEdField.name != 'attended_for'}&middot; {/if}{foreach from=$aEducation[$fname] key=iKey item=aEduText}{$aEduText|trim|clean}{/foreach}
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
		{if Phpfox::getParam('userinfo.show_text_boxes')}
		{foreach name=aEdFields from=$aEdFields key=iKey item=aEdField}
		{if $aEdField.name != 'date'}
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
	{/if}
		<div style="height: 15px;"></div>
	{/foreach}
</div>
<div style="clear:both;"></div>
{/if}

{if Phpfox::getParam('userinfo.show_text_boxes')}
	{if $iEmpCount > Phpfox::getParam('userinfo.profile_count') || $iEduCount > Phpfox::getParam('userinfo.profile_count')}
	<div style="width:100%; text-align:right;"><a href="{$sUserUrl}user_{$aUser.user_id}">{phrase var='userinfo.view_more'}</a></div>
	{/if}
{else}
	{if $iEmpCount > 0 || $iEduCount > 0}
	<div style="width:100%; text-align:right;"><a href="{$sUserUrl}user_{$aUser.user_id}">{phrase var='userinfo.view_more'}</a></div>
	{/if}
{/if}
