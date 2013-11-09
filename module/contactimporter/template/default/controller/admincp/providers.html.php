<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_Contact
 * @version 		$Id: index.html.php 1424 2010-01-25 13:34:36Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
    #table-2
    {
        position: relative;
        top:0;
        border-collapse:collapse;
        overflow:hidden;
        
    }
    th.providers-active,th.providers-avatar
    {
        width:125px;
    }

    td.provider-type
    {
        text-transform:capitalize;
    }
    #table-2 td img
    {
        height:60px !important;
        width:60px !important;
    }

     #table-2 .draprow, #table-2 tr:hover
     {
        background-color: #FFF8DB;
    }

    #table-2 tr td, #title tr td
    {
        width:100px !important;
    }
</style>
{/literal}
{if count($providers)}
<div id="provider-list">
  <table id="title">
         <tr>
		<td>{phrase var='contactimporter.admincp_providers_title'}</td>
		<td>{phrase var='contactimporter.admincp_providers_type'}</td>
		<td>{phrase var='contactimporter.admincp_providers_logo'}</td>
		<td class="providers-active">Enabled</td>			
         </tr>
  </table>
 <table id="table-2">
            {foreach from=$providers key=iKey item=provider}
                    <tr id="{$provider.name}" class="checkRow{if $provider.enable eq 0} tr{else}{/if}" style="cursor:move;">
                                        <td>{$provider.title|convert|clean}</td>
                                            <td class="provider-type">{$provider.type}</td>
                                            <td style="width:10px"><img src="{$core_url}module/contactimporter/static/image/{$provider.logo}_status_up.png" /></td>
                                            <td style="width:10px">
                                                <div id="update_active_{$provider.name}">
                                                    <a style="cursor:pointer;text-decoration: underline;" href="javascript:updateprovideractive('{$provider.name}',{$provider.enable});">{if $provider.enable eq 1}Yes{else}No{/if}</a>
                                                </div>
                                            </td>                                      
                    </tr>             
            {/foreach}
 </table>
 </div>
<div class="table_bottom"></div>
{/if}

