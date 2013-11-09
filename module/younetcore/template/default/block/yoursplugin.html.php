<?php 
defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
.package_query_results li.error {
    background-image: url("{/literal}{$sCoreUrl}{literal}module/younetcore/static/image/error.png");
    background-position: 5px center;
    background-repeat: no-repeat;
}
span.validated1{
    background:url('{/literal}{$sCoreUrl}{literal}module/younetcore/static/image/success.png') no-repeat center left;
    margin: 5px;
    padding-left: 24px;
       
}
span.invalid1{
    background:url('{/literal}{$sCoreUrl}{literal}module/younetcore/static/image/error.png') no-repeat center left;
    margin: 5px;
    padding-left: 24px;
}
td {
	vertical-align: middle;
}
</style>
<script type="text/javascript">
   function request1()
    {
        var img = '<img src="'+oParams['sJsHome']+'module/younetcore/static/image/largeloading.gif" align="left" style="display: inline-block;float: left;height: 50px;margin-right: 15px;vertical-align: middle;" id="img_loadding"/>';
        $('#verify_lis').html(img);
    }
    function verify(name)
    {
        request1();
        $.ajaxCall('younetcore.f','ur='+name);
    }
    function q()
    {
         $('#done_verify').unbind('click');
         $('#done_verify').bind('click', function(event) {
            $('#ls').val($('#l').val());
            request();
            $Core.ajax('younetcore.l', 
            {
                params: 
                {     
                    'data': $("#yn_verify_f").serialize(),
                },
                success: function(sData)            
                {
                    sData = $.parseJSON(sData);
                    viewrequest();
                    viewmessage(sData.key);
                }
            });
         });
         $('#cancel_verify').bind('click', function(event)
         {
             $('#verify_lis').html('');
         });
         $('#img_loadding').attr('style','display: inline-block;float: left;height: 48px;margin-right: 15px;vertical-align: middle;');
    }
    function request()
    {
        $('#loadding_yn').show();$('#l').hide();$('#done_verify').hide();
        $('#submit_yn').attr('style','margin:0');
        $('#m_yn').hide();
        $('#cancel_verify').unbind('click');
        $('#cancel_verify').bind('click', function(event)
        {
            viewrequest();  
        });
    }
    function viewrequest()
    {
        $('#loadding_yn').hide();$('#l').show();$('#done_verify').show();
        $('#submit_yn').attr('style','margin-top:15px');
        $('#m_yn').show();
        $('#cancel_verify').unbind('click');
        $('#cancel_verify').bind('click', function(event)
        {
            $('#verify_lis').html('');
        });
           
    } 
    function viewmessage(mes)
    {
        if(mes == false)
        {
            $('#m_yn').text('{/literal}{phrase var='younetcore.invalid_key'}{literal}');
            $('#m_yn').attr('class','mes invalid1');
        }
        else
        {
            var svl = '<input type="hidden" name="svl" id="svl" value="'+mes+'">';
            $('#yn_verify_f').html($('#yn_verify_f').html() + svl);
            $('#m_yn').text('{/literal}{phrase var='younetcore.validated'}{literal}');
            $('#m_yn').attr('class','mes validated1');
            $('#done_verify').val('{/literal}{phrase var='younetcore.continue'}{literal}');
            $('#l').attr('disabled', true);
            $('#l').attr('style', 'display:inline-block;background:#FAF8E9');
            $('#l').val($('#ls').val());
            $('#done_verify').unbind('click'); 
            $('#done_verify').bind('click', function(event)
            {
                
                $('#yn_verify_f').submit();
            });
            $('#cancel_verify').unbind('click');  
            $('#cancel_verify').bind('click', function(event)
            {
                $('#verify_lis').html('');
            });
        }

    }   
</script>
{/literal}
{if count($aProducts)}
    <div id="verify_lis" style="margin-bottom:15px"></div> 
	<table>
	<tr>
		<th style="width:20px;"></th>
		<th>{phrase var='admincp.name'}</th>
		<th class="t_center">{phrase var='admincp.latest'}</th>
		<th class="t_center">{phrase var='admincp.version'}</th>
		<th class="t_center">{phrase var='admincp.upgrade'}</th>
		<th style="width:60px;">{phrase var='younetcore.status'}</th>
	</tr>
	{foreach from=$aProducts key=iKey item=aProduct}
	<tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
		<td class="t_center">
			{if $aProduct.yncparams != null && $aProduct.yncstatus == 1}
				<img src="{$sCoreUrl}module/younetcore/static/image/success.png" alt="success"/>
			{else}
				<img src="{$sCoreUrl}module/younetcore/static/image/error.png" alt="success"/>
			{/if}
					
		</td>		
		<td>{$aProduct.title}</td>
		<td class="t_center">{if $aProduct.latest_version > 0}{if !empty($aProduct.url)}<a href="{$aProduct.url}" target="_blank">{/if}{$aProduct.latest_version}</a>{else}{$aProduct.version}{/if}</td>
		<td class="t_center">{$aProduct.version}</td>
		<td class="t_center">
		{if isset($aProduct.upgrade_version)}
			<a href="{url link='admincp.product' upgrade=$aProduct.product_id}" class="action_link">{phrase var='admincp.upgrade_upgrade_version' upgrade_version=$aProduct.upgrade_version}</a>
		{else}
			{phrase var='admincp.n_a'}
		{/if}
		</td>
		<td class="t_center">
			{if $aProduct.yncparams != null && $aProduct.yncstatus == 1}
				{phrase var='younetcore.up_to_date'}
			{else}
				<a href="javascript:void(0);" onclick="javascript:verify('{$aProduct.product_id}');return false;">{phrase var='younetcore.verify'}</a>
			{/if}
			
			
		</td>	
	</tr>
	{/foreach}
	</table>


{else}
	{phrase var='younetcore.no_plugins_by_younet_company_were_found_on_your_site_click_a_href_http_phpfox_modules2buy_com'}
{/if}