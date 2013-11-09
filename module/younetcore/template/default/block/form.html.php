<?php
  defined('PHPFOX') or exit('NO DICE!'); 
?>
<div class="yn_verify">
<div class="settings">
    <form method="post" action="{url link='admincp.younetcore'}" class="global_form" enctype="application/x-www-form-urlencoded"  name="yn_verify_f" id="yn_verify_f">
        <div class="f_content">
            <div>
            <h3>{phrase var='younetcore.enter_your_license_key_for'}: {$aToken.title}</h3>
            <div class="form-elements">
                <div class="form-wrapper" id="controllersettings-wrapper"> 
                        <p class="description">{phrase var='younetcore.please_enter_your_license_key_that_was_provided_to_you_when_you_purchased_this_plugin'} </p>
                                    <div class="form-element" id="controllersettings-element">
                                        <span><label class="required" for="controllersettings">{phrase var='younetcore.license_key'}</label>&nbsp;&nbsp;<input type="text" value="" id="l" name="l"><span class="mes unknown" name="m_yn" id="m_yn"></span></span>
                                        <div id="loadding_yn" style="display:none;">
                                            <img src="{$sCoreUrl}/module/younetcore/static/image/largeloading.gif" align="left" style="display: inline-block;float: left;height: 25px;margin-right: 15px;vertical-align: middle;" id="img_loadding"/>
                                        </div>
                                        <input type="hidden" value="{$aToken.m}" id="ynm" name="m">
                                        <input type="hidden" value="{$aToken.tk}" id="yntk" name="tk">
                                        <input type="hidden" value="{$aToken.d}" id="ynd" name="d">
                                        <input type="hidden" value="{$aToken.ep}" id="ynep" name="ep">
                                        <input type="hidden" value="{$aToken.time}" id="yntime" name="time">
                                        <input type="hidden" value="" id="ls" name="ls">
                                        <input type="hidden" value="license" id="t" name="t">
                                        <div id="verify_status" style="margin-top:15px">
                                            
                                        </div>
                                        <div class="clear"></div>
                                        <div id="submit_yn" style="margin-top:15px">
                                        <input class="button" name="done_verify" id="done_verify" type="submit" value="{phrase var='younetcore.verify'}" onclick="return false;"/> 
                                        <input class="button" name="cancel_verify" id="cancel_verify" type="submit" onclick="return false;" value="{phrase var='younetcore.cancel'}"/>
                                        
                                        </div>
                                    </div>
                </div>
                                
            </div>
            </div>
        </div>
    </form> 
</div>
</div>
