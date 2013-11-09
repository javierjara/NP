<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h1>{phrase var='contactimporter.export_your_friend_contacts'}</h1>
   <p>{phrase var='contactimporter.if_you_have_posts_in_another_system_you_can_export_those_into_this_site_to_get_started_choose_a_s'}:</p>
   <div style="padding: 10px;">
   <table style="background-color:#FFFFFF;border-color:#DFDFDF;-moz-border-radius:4px 4px 4px 4px; border-spacing:0;border-style:solid;border-width:1px;clear:both;margin:0;width:100%;" cellspacing='0'  >
   <tbody>
   <tr style="background-color:#F9F9F9;">
   <td style="padding:6px 15px;font-size:12px !important; font-weight:bold;  border-color:#DFDFDF;border-bottom-style:solid; border-bottom-width:1px;">
   <a title="{phrase var='contactimporter.export_contact_to_csv_file'}" href="javascript:void(0);" onclick="window.location.href='{$url}';return false;">{phrase var='contactimporter.export_contacts'}</a>
   </td>
   <td style="padding:6px 15px;border-color:#DFDFDF;border-bottom-style:solid; border-bottom-width:1px;">{phrase var='contactimporter.export_your_friend_contacts_to_csv_file'}.</td>
   </tr>
   </tbody>
   </table>
</div>