<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
{literal}
<style type="text/css">
   .formpopup .global_form div.form-elements {
      margin-left:50px;
    }
</style>
{/literal}
{literal}
<script type="text/javascript">
function submitViaEnter(myfield,e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if (keycode == 13)
	   {
	   myfield.form.submit();
	   return false;
	   }
	else
	   return true;
}
</script>
{/literal}
<div class="formpopup">
 <form id="get_contact_email" name="get_contact_email" onsubmit="" enctype="" class="global_form" action="{url link='contactimporter'}" method="post" autocomplete="off">
        <div class="form-elements toggle_container">
                    <div id="email_box-wrapper" class="form-wrapper">
                            <div id="email_box-label" class="form-label">
                                     <label for="email_box" class="required" >{phrase var='user.email'}&nbsp;</label>
                            </div>
                            <div id="email_box-element" class="form-element">
                                    <input type="text" name="email_box" id="email_box" value="" style="width:205px;" onkeypress="return submitViaEnter(this,event)" />
                            </div>
                     <div id="provider_box-element2" class="form-element" style="display:none;">
                        <input type='text' value={$email.default_domain} name='tmp' id='provider_box_mail2' style='width:80px;' autocomplete ="OFF"/>
                        <input type='hidden' value='' id='provider_box_input2' name='provider_box2'/>
                        <input type='hidden' value="{$email.name}" id='provider_box_mail' name='provider_box'/>
                    </div>
                    </div>
                    <div id="password_box-wrapper" class="form-wrapper"  style="margin-bottom:3px">
                            <div id="password_box-label" class="form-label" style="width:450px">
                            <label for="password_box" class="required">{phrase var='user.password'}
                                <input type="password" style="width:205px" name="password_box" id="password_box" value="" onkeypress="return submitViaEnter(this,event)" />
                            </label>
                            </div>
                    </div>
                    <div id="import-element" class="form-element" style="clear:both;">
                            <input class="button" name="import" id="import" type="submit" onclick="" value="{phrase var='contactimporter.import_contact'}" />
                    </div>

        </div>

</form>
</div>