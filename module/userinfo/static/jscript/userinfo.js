function employmentHideTo(sId) {
	var oTo = $('#date_to_container' + sId).get(0);
	var oPres = $('#date_present_container' + sId).get(0);
	$('#month_to' + sId).get(0).selectedIndex = 0;
	$('#year_to' + sId).get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
		oPres.style.display = '';
	}
	else { 
		oTo.style.display = '';
		oPres.style.display = 'none';
	}
}

function employmentAddHideTo() {
	var oTo = $('#adddate_to_container').get(0);
	var oPres = $('#adddate_present_container').get(0);
	$('#addmonth_to').get(0).selectedIndex = 0;
	$('#addyear_to').get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
		oPres.style.display = '';
	}
	else { 
		oTo.style.display = '';
		oPres.style.display = 'none';
	}
}

function employmentHideToFilter() {
	var oTo = $('#date_to_container').get(0);
	$('#month_to').get(0).selectedIndex = 0;
	$('#year_to').get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
	}
	else { 
		oTo.style.display = '';
	}
}

function showAddForm(type)
{
	if(type == 'em')
	{
		if($('#add_employment').get(0).style.display == 'none')
		{
			$('#add_employment').get(0).style.display = '';
			$('#add_employment_title').get(0).style.display = 'none';
			$('#add_education').get(0).style.display = 'none';
			$('#add_education_title').get(0).style.display = '';
		}
		else
		{
			$('#add_employment').get(0).style.display = 'none';
			$('#add_employment_title').get(0).style.display = '';
			$('#add_education').get(0).style.display = 'none';
			$('#add_education_title').get(0).style.display = '';
		}
	}
	
	else if(type == 'ed')
	{
		if($('#add_education').get(0).style.display == 'none')
		{
			$('#add_education').get(0).style.display = '';
			$('#add_education_title').get(0).style.display = 'none';
			$('#add_employment').get(0).style.display = 'none';
			$('#add_employment_title').get(0).style.display = '';
		}
		else
		{
			$('#add_education').get(0).style.display = 'none';
			$('#add_education_title').get(0).style.display = '';
			$('#add_employment').get(0).style.display = 'none';
			$('#add_employment_title').get(0).style.display = '';
		}
	}
}

function educationHideTo(sId) {
	var oTo = $('#class_year_container' + sId).get(0);
	$('#class_year'+ sId).get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
	}
	else { 
		oTo.style.display = '';
	}
}

function educationAddHideTo() {
	var oTo = $('#addclass_year_container').get(0);
	$('#addclass_year').get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
	}
	else { 
		oTo.style.display = '';
	}
}

function educationHideToFilter() {
	var oTo = $('#date_to_container').get(0);
	$('#class_year').get(0).selectedIndex = 0;
	
	if (oTo.style.display == '') 
	{
		oTo.style.display = 'none';
	}
	else { 
		oTo.style.display = '';
	}
}