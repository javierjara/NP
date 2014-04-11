{if $bIsAllowed}
<div style="width:100%;">
<div id="add_employment_title" style="float:left;height: 25px;width:50%;text-align:left;"><a href="#" onclick="showAddForm('em')">
	Add Employer</a>
</div>
<div id="add_education_title" style="float:right;height: 25px;width:50%;text-align:left;"">
	<a href="#" onclick="showAddForm('ed')">Add Education</a>
	</div>
</div>

<div style="clear:both"></div>

<div id="add_employment" style="display:none;">
<form method="post" action="#" onsubmit="$('#js_employment_submit').show();$(this).ajaxCall('userinfo.add', 'type=1'); return false;">
{foreach name=aEmFields from=$aEmFields item=aEmField}
	{if $aEmField.name == 'date'}
	<div class="table">
		<div class="table_left">
			<label for="title">{phrase var='userinfo.field_date'}{required}:</label>
		</div>
		<div class="table_right">
			<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:employmentAddHideTo()" />{phrase var='userinfo.still_here'}</label>
			<div style="height: 70px;margin-top: 10px;">
				<select id="month_from" name="val[month_from]">
					{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
						<option value="{$iKey}">{$aMonth}</option>
					{/foreach}
				</select>&nbsp;
				<select id="year_from" name="val[year_from]">
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}">{$aYear}</option>
					{/foreach}
				</select>
				<span id="adddate_to_container">
				&nbsp;to
				<div style="margin-top: 6px;">
				<select id="addmonth_to" name="val[month_to]">
					{foreach name=aMonths key=iKey from=$aMonths item=aMonth}
						<option value="{$iKey}">{$aMonth}</option>
					{/foreach}
				</select>&nbsp;
				<select id="addyear_to" name="val[year_to]">
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}">{$aYear}</option>
					{/foreach}]
				</select>
				</div>
				</span>
				<span id="adddate_present_container" style="display:none;">
				&nbsp;{phrase var='userinfo.to'} {phrase var='userinfo.present'}
				</span>
			</div>
			
		</div>
	</div>
	{else}
		<div class="table">
			<div class="table_left">
				{$aEmField.rep_name}{if $aEmField.required == 1}{required}{/if}:
			</div>
			<div class="table_right">
				{assign var=fid value=$aEmField.name}
				
				{if $aEmField.type == 1}
					<input type="text" size="33" id="{$aEmField.name}" name="val[{$aEmField.name}]" value="" />
				{elseif $aEmField.type == 2}
					<textarea rows="5" cols="25" id="{$aEmField.name}" name="val[{$aEmField.name}]"></textarea>
				{/if}
			</div>
		</div>
	{/if}
{/foreach}

<div class="table_clear">
	<input type="submit" value="{phrase var='userinfo.add_employment'}" class="button" />&nbsp;&nbsp;<span id="js_employment_submit" style="display:none;">{img theme='ajax/small.gif'}</span>
</div>

<div class="clear"></div>		
<div class="p_4" style="font-size: 10px;">
{required} {phrase var='userinfo.required_field'}</div>	
<div class="p_4" style="font-size: 10px;">
	{phrase var='userinfo.create_tags'}
</div>
</form>
</div>

<div id="add_education" style="display:none;">
<form method="post" action="#" onsubmit="$('#js_education_submit').show();$(this).ajaxCall('userinfo.add', 'type=2'); return false;">
{foreach name=aEdFields from=$aEdFields item=aEdField}
	{if $aEdField.name == 'class_year'}
	<div class="table">
		<div class="table_left">
		<label for="title">{phrase var='userinfo.field_class_year'}{required}:</label>
		</div>
		<div class="table_right">
			<label><input type="checkbox" id="is_present" name="val[is_present]" class="checkbox v_middle" value="1" onclick="javascript:educationAddHideTo()" />{phrase var='userinfo.still_here_edu'}</label>
			<div id="addclass_year_container" style="height: 30px;margin-top: 10px;">
				<select id="addclass_year" name="val[class_year]" >
					{foreach name=aYears key=iKey from=$aYears item=aYear}
						<option value="{$iKey}">{$aYear}</option>
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
					<option value="0"}>{phrase var='userinfo.type'}:</option>
					<option value="1">{phrase var='userinfo.elementary_school'}</option>
					<option value="2">{phrase var='userinfo.high_school'}</option>
					<option value="3">{phrase var='userinfo.college'}</option>
					<option value="4">{phrase var='userinfo.graduate_school'}</option>
					<option value="5">{phrase var='userinfo.professional_school'}</option>
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
					<input type="text" size="33" id="{$aEdField.name}" name="val[{$aEdField.name}]" value="" />
				{elseif $aEdField.type == 2}
					<textarea rows="5" cols="25" id="{$aEdField.name}" name="val[{$aEdField.name}]"></textarea>
				{/if}
			</div>
		</div>
	{/if}
{/foreach}


<div class="table_clear">
	<input type="submit" value="{phrase var='userinfo.add_education'}" class="button" /> &nbsp;&nbsp;<span id="js_education_submit" style="display:none;">{img theme='ajax/small.gif'}</span>
</div>

<div class="clear"></div>		
<div class="p_4" style="font-size: 10px;">
{required} {phrase var='userinfo.required_field'}</div>	
<div class="p_4" style="font-size: 10px;">
	{phrase var='userinfo.create_tags'}
</div>
</form>
</div>
{else}
{$sUpgradeMessage}
{/if}

