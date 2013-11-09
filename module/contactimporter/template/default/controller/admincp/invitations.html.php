<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright        [PHPFOX_COPYRIGHT]
 * @author          Miguel Espinoza
 * @package          Module_Contact
 * @version         $Id: index.html.php 1424 2010-01-25 13:34:36Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<script type="text/css">
    .table_right input{
        width:200px;
    }
</script>
{/literal}
<form method="post" action="{url link='admincp.contactimporter.invitations'}">
<div class="table_header">
    {phrase var='blog.search_filter'}
</div>
<div class="table">
    <div class="table_left">
        Keywords:
    </div>
    <div class="table_right">
        {$aFilters.title}
    </div>
    <div class="clear"></div>
</div>

<div class="table_clear">
    <input type="submit" name="search[submit]" value="{phrase var='core.submit'}" class="button" />
    <input type="submit" name="search[reset]" value="{phrase var='core.reset'}" class="button" />
    
</div>
</form>
{pager}
   <form action="{url link='admincp.contactimporter.invitations'}" method="post" onsubmit="return getsubmit();" >
    <table>
     <tr>
        <th width="10px"><input type="checkbox" value="" id = "checkAll" name="checkAll" onclick="javascript:selectAll()"/></th>
        <th>Inviter</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Options</th>
        
    </tr>
    {foreach from=$items key=iKey item=inviter}    
    <tr id="{$inviter.invite_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
        <td style="width:10px">
            <input type="checkbox" value="{$inviter.invite_id}" name="is_selected"/>
        </td>
        <td>{$inviter.user_name|clean}</td>
        <td>{$inviter.full_name|clean}</td>
        <td>{$inviter.receive_email}</td>
       <td width="40px">
            <div id = "resend_{if isset($aInvite)}{$aInvite.invite_id}{/if}" align="center">
            <span style="float:left;width:10px;margin-left: 4px;">
                <a class="inlinePopup"  title="Invitation Message"  border="0" href="#?call=contactimporter.reSendInvitation&invite_id={$inviter.invite_id}&width=300&height=200"><img alt="Resend Invitation" title="Resend Invitation" border="0" width="15" height="15" src="{$core_url}module/contactimporter/static/image/send_mail.png"></a>
           </span>
               {if isset($inviter)}
                    <a title="Delete Invitation " href="{url link='admincp.contactimporter.invitations.page_'.$iPage del=$inviter.invite_id }">{img theme='misc/delete.png' alt='' class='go_right'}</a>
                {/if}
            </div>
       </td>
    </tr>    
    {/foreach}
    <tr><td colspan="5">
         <div class="table_bottom">
        <input type="hidden" value="" name="arr_selected" id="arr_selected"/>
        <input type="hidden" value="" name="feed_selected" id="feed_selected"/>
         <input type="submit" name="deleteselect" value="Delete selected" class="button" onclick="javascript:setValue();"/>
    </div>
     </td></tr>
    </table>
 </form>
   {pager}

<script type="text/javascript">
                        <!--
                        {literal}
                        function reSendInvitation(id)
                        {
                        {/literal}                         
                            $.ajaxCall('contactimporter.reSendInvitation','invite_id='+id);    
                        {literal}    
                        }
                        {/literal}
                        -->
</script>