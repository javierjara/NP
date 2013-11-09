<?php
/**
 * [Yns_ContactImporter]
 * 
 * @copyright        [Younetco]

 * @package         Phpfox
 * @version         1.0
 */
 
defined('PHPFOX') or exit('NO DICE!'); 
?>
 { if isset($errors) and  count($errors)== 0}
     <h1>{phrase var='contactimporter.invite_friends'}</h1>
            <div>{phrase var='contactimporter.send_invitation_to_your_friends_successfully' contactimporter_link=$contactimporter_link homepage=$homepage}</div>
{else}
    <div>{phrase var='contactimporter.there_were_errors_when_you_send_the_invitation'}</div>
    {foreach from=$errors item=er}
        <div style="color:red;font-weight:700">{$er}</div>
    {/foreach}
{/if}

   
