<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: top.html.php 1318 2009-12-14 22:34:04Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<!-- {$core_path}module/contactimporter/include/component/controller/Apiconnection-->
<div id="js_report_body">

<div class="p_4">
   {phrase var='contactimporter.login_to_access_and_get_yahoo_contacts_from_your_account'}.
</div>
<div class="p_4" align="center">
  <input type="button" value="{phrase var='core.yes'}" class="button" onclick="window.location='http://dp.younetid.com/phpfox-contact/yahoo/yahoo_connect.php?login=1&security_token={$sSecurityToken}&token_name={$tokenName}&callback={url link='contactimporter'}','name','height=400,width=550';
        tb_remove();if (window.focus) newwindow.focus();
;tb_remove();redirect();" />
    <input type="button" value="{phrase var='core.no'}" class="button" onclick="tb_remove();" />
</div>              