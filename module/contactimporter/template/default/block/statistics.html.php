   <?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright        [PHPFOX_COPYRIGHT]
 * @author          younetco
 * @package          Module_Contactimporter
 * @version         
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<ul class="action">
 <li><a>{phrase var='contactimporter.you_can_send_max_invitations_per_time' max=$max_invitation}</a></li> 
 <li><a>{phrase var='contactimporter.total_contats_you_sent_the_invitations'}: <font color="red" style="font-weight:bold">{$total_invitation}</font></a></li> 
 <li>
    <ul>
        <li><a>{phrase var='contactimporter.your_contacts_from_emails'}: <font color="red" style="font-weight:bold">{if isset($statistics.emails)}{$statistics.emails}{else}0{/if}</font></a></li>
        <li><a>{phrase var='contactimporter.your_contacts_from_socials'}: <font color="red" style="font-weight:bold">{if isset($statistics.socials)}{$statistics.socials}{else}0{/if}</font></a></li>
    </ul>
 </li> 
</ul>
