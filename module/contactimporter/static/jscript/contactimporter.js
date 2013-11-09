function getItemsChecked(strItemName, sep) {
	var x=document.getElementsByName(strItemName);
	var p="";
	for(var i=0; i<x.length; i++) {
		if(x[i].checked) {
			p += x[i].value + sep;
		}
	}
	var result = (p != '' ? p.substr(0, p.length - 1) : '');
	return result;
}

function openYahooPopup(urlapp) {
	var url ="{url link='contactimporter'}";
	newwindow=window.open(urlapp,'name','scrollbars=yes,height=400,width=550');
}

function openYoutubePopup(urlapp) {
    newwindow=window.open(urlapp,'name','scrollbars=yes,height=400,width=550,top:200,left:200');
    if (window.focus) newwindow.focus();
}

function poptastic(url) {
	newwindow=window.open(url,'name','height=400,width=400');
	if (window.focus) newwindow.focus();
}

function popitup(url,windowName) {
	var windowWidth = 650;
	var windowHeight = 400;
	if(windowName == "") {
		windowName = "Contactimporter";
	}
	var centerWidth = (window.screen.width - windowWidth) / 2;
	var centerHeight = (window.screen.height - windowHeight) / 2;
	newWindow = window.open(url, windowName, 'resizable=0,width=' + windowWidth +
		',height=' + windowHeight +
		',left=' + centerWidth +
		',top=' + centerHeight);
	newWindow.focus();
}

function openWindowPP(type) {
    var url ="{url link='contactimporter'}" ;
    newwindow=window.open('http://openid.younetid.com/auth/'+type+'.php?callbackUrl='+url,'name','scrollbars=yes,height=400,width=550');
    if (window.focus) newwindow.focus();
}

function popitup(url,windowName) {
	var windowWidth = 650;
	var windowHeight = 400;
	if (windowName == "") windowName = "Contactimporter";
	var centerWidth = (window.screen.width - windowWidth) / 2;
	var centerHeight = (window.screen.height - windowHeight) / 2;
	newWindow = window.open(url, windowName, 'resizable=0,width=' + windowWidth +
		',height=' + windowHeight +
		',left=' + centerWidth +
		',top=' + centerHeight);
	newWindow.focus();
}

function toggleCurrent(element) {
	var check = false;
	if(element.innerHTML == 'Select Current Page')
	{
		check = true;
		element.innerHTML = 'Unselect Current Page' ;
	}
	else
	{
		check = false;
		element.innerHTML = 'Select Current Page' ;
	}

	var form = document.forms.openinviterform, z = 0;

	for (id=1; id<=counter;id++)
	{
		if(document.getElementById('row_'+id).style.display == '' )
		{
			document.getElementById('check_'+id).checked = check;
			//id = form[z].name.substring(6);
			if(document.getElementById('row_'+id))
			{
				if(check ) {
					document.getElementById('row_'+id).className='thTableSelectRow';
				} else {
					if (z%2 ==1 ) {
						document.getElementById('row_'+id).className='thTableOddRow';
					} else {
						document.getElementById('row_'+id).className='thTableEvenRow';
					}
				}
			}
		}
	}
}

function viewSelected(ele) {
	var form = document.forms.openinviterform, z = 0;
	for(id=1; id<=counter;id++)
	{
		if (document.getElementById('check_'+id).checked == true) {
			document.getElementById('row_'+id).style.display = '';
		} else {
			document.getElementById('row_'+id).style.display = 'none';
		}
	}
}
function getByAlphbe(ele,value)
{
	//alert(ele.innerHTML);
	//setWaiting();
	ele.setAttribute("class", "active");
	if ( ele != document.getElementById('active_alphabe_all'))
	{
		 document.getElementById('active_alphabe_all').setAttribute('class','');
	}
	for( i = 65; i <=90; i++ )
	{
	   var sChar=String.fromCharCode(i);

	   eleUnactive = document.getElementById('active_alphabe_'+sChar);
	   if ( eleUnactive != ele)
	   {
		   eleUnactive.setAttribute('class','unactive');
	   }

	}
	var length = array_search.length;
	value = value.toLowerCase();
	document.getElementById('toggleCurrent_id').innerHTML = 'Select Current Page';

	for (i=1; i<length; i++)
	{
		var casechanged=array_search[i].toLowerCase();

		if ( casechanged.indexOf(value) == 0 || value =='all')
		{

			document.getElementById('row_'+i).style.display = '';
		}
		else
		{
			document.getElementById('row_'+i).style.display = 'none';
		}

	}
	unsetWaiting();
}

function checkRespones()
{
	var provider_box_social = document.getElementById('provider_box_social');
	if (provider_box_social.value == 'linkedin') {
		$('#linkedinA').trigger('click');
		//$('#linkedinA').click();
		return false;
	}
	if (provider_box_social.value == 'twitter') {
		$('#twitterA').trigger('click');
		//$('#linkedinA').click();
		return false;
	}

	if (provider_box_social.value == 'youtube') {
		openWindowPP('youtube');
		return false;
	}
	return true;
}

function choose_provider(kind,provider)
{
	var provider_list = document.getElementById(kind);
	var flag = true;
	var i =0;
	if (provider_list.tagName == "INPUT") {
		for (i=0;i<count_specific_email;i++) {
			if (specific[i].search(provider_domain_mapping[provider])!=-1) {
				provider_list.value = specific[i];
				flag = false;
				break;
			}

		}
		if (flag) {
			provider_list.value = provider;
		}
	} else {
		for (i=0;i<provider_list.options.length;i++) {
			if (provider == provider_list.options[i].value) {
				provider_list.options[i].selected = true;
				flag = false;
				var provider_box_mail2 = document.getElementById('provider_box_mail2');
				provider_box_mail2.value =  provider_list.options[i].innerHTML;
				break;
			}
		}
		if (flag) {
			var provider_box_mail = document.getElementById('provider_box_mail');
			provider_box_mail.value = 'other';
			other_input('provider_box-element');
			provider_list.value = provider;
			return true;
		}
	}
}

function check_domain(domain,providerObj,emailObj) {
	error_email_empty = "Your email is empty!";
	errror_not_support_domain = "This mail domain isn't supported.";
	if (emailObj.value == '') {
		error_notify("Email should not be left blank!",error_email_empty);
		return false;
	}
	if (!providerObj) {
		if (emailObj.value.search('@') == -1) {
			emailObj.value+="@"+document.getElementById('provider_box_mail').options[document.getElementById('provider_box_mail').selectedIndex].text;
		}
		sending_request();
		return true;
	}
	for (i=0;i<count;i++) {
		if (domain.search(mapKey[i]+".")!= -1) {
			providerObj.value = mapValue[i];
			emailObj.value += "@"+domain;
			sending_request();
			return true;
		}
	}
	error_notify("error_mail",errror_not_support_domain);
	return false;
}

function other_input(obj) {
	var element = document.getElementById(obj);
	var newElement = document.getElementById('provider_box-element2');
	var provider_box_mail = document.getElementById('provider_box_mail');
	if (provider_box_mail.value == 'other') {
		element.style.display = 'none';
		newElement.style.display ='';
		var provider_box_mail2 = document.getElementById('provider_box_mail2');
		provider_box_mail2.value ='';
		//element.innerHTML = "<input type='text' value='' name='tmp' id='provider_box_mail' style='width:80px;' /><input type='hidden' value='' id='provider_box_input' name='provider_box'/>";

		//element.set('html',"&lt;input type='text' value='' name='tmp' id='provider_box_mail' style='width:80px;' /&gt;&lt;input type='hidden' value='' id='provider_box_input' name='provider_box'/&gt;");
	}
}
    //
function lookupLocal() {
	var oSuggest = $("#provider_box_mail2")[0].autocompleter;
	oSuggest.findValue();
	return false;
}

function selectItem(li) {
	findValue(li);
}
function findValue(li) {
	if( li == null ) return ;
    if( !!li.extra ) var sValue = li.extra[0];
    else var sValue = li.selectValue;
}

function do_submit() {
	var provider_box_mail= document.getElementById('provider_box_mail');
	var provider_box_input= document.getElementById('provider_box_input');
	if (provider_box_mail.value == '' || provider_box_mail.value == 'other') {
		provider_box_mail =  document.getElementById('provider_box_mail2');
		provider_box_input= document.getElementById('provider_box_input2');
	}
	var email_box= document.getElementById('email_box');
	if (!check_domain(provider_box_mail.value,provider_box_input,email_box)) return false;
	return true;
}

function do_submit_social() {
	var provider_box_mail= document.getElementById('provider_box_mail');
	var provider_box_input= document.getElementById('password_box');
	var email_box= document.getElementById('email_box');
	if (!check_domain(provider_box_mail.value,provider_box_input,email_box)) return false;
	return true;
}

function sending_request() {
	var import_form = document.getElementById('import_form');
	var loading = document.getElementById('loading');
	import_form.style.display = 'none';
	loading.style.display = 'block';
}

function error_notify(objId,error) {
	document.getElementById(objId+"_content").innerHTML = error;
	document.getElementById(objId).style.display = '';
}

function IsNumeric(sText) {
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) {
		Char = sText.charAt(i);
		if (ValidChars.indexOf(Char) == -1)
		{
			IsNumber = false;
		}
	}
	return IsNumber;
}

function toggleAll(element) {
	var form = document.forms.openinviterform, z = 0;
	for (id=1; id<=counter;id++)	{
		//if(form[z].type == 'checkbox')
		{
			document.getElementById('check_'+id).checked = element.checked;
			if (document.getElementById('row_'+id)) {
				if(element.checked) {
					document.getElementById('row_'+id).className='thTableSelectRow';
				} else {
					if (z%2 == 1) {
						document.getElementById('row_'+id).className='thTableOddRow';
					} else {
						document.getElementById('row_'+id).className='thTableEvenRow';
					}
				}
			}
		}
	}
}

function check_toggle(element_id,obj,isCheckBox) {
	var check_element = document.getElementById('check_'+element_id);
	if (isCheckBox) check_element.checked = !check_element.checked;
	if (check_element.checked) {
		obj.className='thTableSelectRow';
	} else {
		if (element_id%2 ==1) {
			obj.className='thTableOddRow';
		} else {
			obj.className='thTableEvenRow';
		}
	}
}

function check_select() {	
	error_no_contact = "No contacts were selected.'";
	var limit_select = 0;
	var x = document.getElementsByName('val[items]');
	var items = '';
	for (var i=0; i<x.length; i++) {
		if (x[i].checked) {
			limit_select++;
			items += x[i].value + ',';
		}
	}	
	if (limit_select >0) {		
		if (items) {
			var items = items.substr(0, items.length - 1);
			$('#contacts').val(items);
		}
		if (limit_select > total_allow_select) {
			alert("You can send "+total_allow_select+" invitations per time.\n You have selected "+limit_select+" contacts.");
			/*
			if (confirm("You can send "+total_allow_select+" invitations.\n You have selected "+limit_select+" contacts.\n Are you sure want to continue")) {
				sending_request();
				return true;
			} else {
				document.getElementById('checkallBox').checked = false;
				toggleAll(document.getElementById('checkallBox'))
				return false;
			}
			*/
			return false;
		} else {
			sending_request();
			return true;
		}
	}
	error_notify(error_no_contact);
	return false;
}

function error_notify(error) {
	alert(error);
}

function check_select_invite() {
	error_no_contact = "No contacts were selected.'";
	var limit_select = 0;
	var sep = ',';
	var x = document.getElementsByName('val[items]');
	var items = '';
	for (var i=0; i<x.length; i++) {
		if (x[i].checked) {
			limit_select++;
			items += x[i].value + sep;
		}
	}
	if (limit_select > 0) {
		if (items) {
			var items = items.substr(0, items.length - 1);
			$('#contacts').val(items);
		}
		if (limit_select > total_allow_select) {
			alert("You can send "+total_allow_select+" invitations per time.\n You have selected "+limit_select+" contacts.");
			/*
			if (confirm("You can send "+total_allow_select+" invitations.\n You have selected "+limit_select+" contacts.\n Are you sure want to continue")) {
				sending_request();
				return true;
			} else {
				document.getElementById('checkallBox').checked = false;
				toggleAll(document.getElementById('checkallBox'));
				return false;
			}
			*/
			return false;
		} else {
			sending_request();
			return true;
		}
	}
	error_notify(error_no_contact);
	return false;
}

function sending_request_invite() {
	document.getElementById('openinviter').style.display = 'none';
	document.getElementById('loading').style.display = 'block';
}

function selectAll() {
    var check = document.getElementsByName('is_selected');
    var is_select = document.getElementById('checkAll');
    var count = check.length;
    for(var i = 0 ; i < count ; i++){
        check[i].checked = is_select.checked;
    }
}

function updateprovideractive(provider_name,is_actived) {
   $('#update_active_'+provider_name).html('Updating...');
   $.ajaxCall('contactimporter.updateProviderActive','provider_name='+provider_name+'&is_actived='+is_actived);
}

function setValue() {
	var check = document.getElementsByName('is_selected');
	var count = check.length;
	var arr = "";
	for (var i = count-1 ; i >=0 ; i--) {
		if ( check[i].checked == true) {
			arr+=","+check[i].value;
		}
	}
	document.getElementById('arr_selected').value = arr;

    if (arr.length>0) {
        var conf = "Are you sure you want to delete ?";
        if (is_category == true) {
             conf = "Are you sure you want to delete ? This action will delete all feeds belong to .";
             is_category = false;
        }
        if (confirm(conf)) {
            is_submit=true;
        } else {
            document.getElementById('arr_selected').value="";is_submit = false;;
        }
    } else  {
        document.getElementById('arr_selected').value ="";
        is_submit = false;;
        return false;
    }
}

var is_submit=true;
var is_category = false;
function getsubmit() {
    return is_submit;
}