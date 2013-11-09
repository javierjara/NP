<?php
/**
 * [ContactImporter]
 * [ContactImporter]
 *
 * @copyright		[Younetco]

 * @package 		Phpfox
 * @version 		1.0
 */

defined('PHPFOX') or exit('NO DICE!');
?>
<link rel="stylesheet" type="text/css" href="{$core_url}module/contactimporter/static/css/default/default/Ynscontactimporter.css" />  
{literal}

<script type="text/javascript">
     if (opener)
    {
        if( opener.location.href == self.location.href ){
        
        }else{            
            self.close();
            opener.location.href = self.location.href;
        }
    }
 function setWaiting()
 {

     ele = document.getElementById('div_list_view').style.backgroundImage = "{/literal}{$core_url}{literal}module/contactimporter/static/image/loading.gif";
 }
  function unsetWaiting()
 {

     ele = document.getElementById('div_list_view').style.backgroundImage = "";
 }

 </script>
  {/literal}

  {literal}
<script type="text/javascript">
   
</script>
 {/literal}
  <script type="text/javascript" src="{$core_url}module/contactimporter/static/jscript/contactimporter.js"></script>
{if isset($is_linkedAPI) != 'is_linkedAPI'}
	<div style="display:none; margin:0 auto; text-align:center; background:url({$core_url}module/contactimporter/static/image/loading.gif) no-repeat;width:320px;height:320px; padding-top:180px;" id="loading">
		<div style="text-align:center; ">{phrase var='contactimporter.sending_request'}</div>
	</div>
{literal}
<script type="text/javascript">
    var newwindow;
</script>
{/literal}
{if ($step !='get_invite' and $step !='add_contact') or (count($errors) > 0 and  $errors != '')}
	<!--Global variable JS -->
 <div id="import_form">
    <!-- Imort email contact list !-->
    {template file='contactimporter.block.import_contact'}                 
    <!-- Imort email contact list !-->
 </div>
 {/if}
 {if $step == 'add_contact'}
  	{template file='contactimporter.block.get_contact'}
 {/if}
 {if $step == 'get_invite'}
    {template file='contactimporter.block.get_invite'}
 {/if}
{else}
    {template file='contactimporter.block.get_contact_api'}
{/if}