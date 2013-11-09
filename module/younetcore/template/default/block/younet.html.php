<?php 
defined('PHPFOX') or exit('NO DICE!');

?>
{literal}
<style type="text/css">
	div.menu_control ul li.price
	{
		background:url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/price.png) no-repeat scroll center left;
	}
	div.menu_control ul li.detail
	{
		background:url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/detail.png) no-repeat scroll center left;
	}
	div.menu_control ul li.demo
	{
		background:url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/demo.png) no-repeat scroll center left;
	}
	div.menu_control ul li.photo
	{
		background:url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/photo.png) no-repeat scroll center left;
	}
	#lbPrevLink:hover {
		background: transparent url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/prevlabel.gif) no-repeat 0 15%;
    }
    #lbNextLink:hover {
	background: transparent url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/nextlabel.gif) no-repeat 100% 15%;
	}
	#lbCloseLink {
	
	background: transparent url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/closelabel.gif) no-repeat center;
	
	}
	.lbLoading {
	background: #fff url({/literal}{$sCoreUrl}{literal}module/younetcore/static/image/loading2.gif) no-repeat center;
	}


</style>
<script type="text/javascript">
	function viewPhotos(name)
	{
		var imgloading = '<img src="'+oParams['sJsHome']+'module/younetcore/static/image/loading.gif" alt="loading"/>';
		$('.'+name+'_loading').html(imgloading);
		$('.view_photo').each(function(){
			$(this).html('');
		});
		$Core.ajax('younetcore.viewPhotos', 
        {
            params: 
            {     
                'm':name,
                't':'photo',
            },
            success: function(sData)            
            {
            	$('.'+name+'_loading').html('');
                if(sData)
                {
                    sData = $.parseJSON(sData);
                }
            	
                viewP(sData,name);
            }
        });
	}
	function viewP(response,name)
    {
        var html = "";
        if(response == false || response == "undefined" || response == null )
        {
            html = "{/literal}{phrase var='younetcore.there_are_no_photos_description'}{literal}";
            
        }
        else
        {
            
            var length = response.length;
            var i = 0;
            for( i = 0 ; i< length; i++)
            {
            	
                html+="<li><a href='"+response[i].reallink+"' rel='lightboxcore' ><img src='"+response[i].thumnail+"' alt='"+name+"'/></a></li>";
            }
        }

        $('.photos_view_descriptions_'+name).html('<ul class="view_yn_photo" >'+html+'</ul>');
        Slimboxscan();
    }
    function Slimboxscan()
	{
		
		$("a[rel^='lightboxcore']").slimbox({/* Put custom options here */}, null, function(el) {
				return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
		});
	}

</script>
{/literal}
<div id="ynmodulelist">
{if count($aYnModules)>0}
	<ul class="ynmodules">
	{foreach from=$aYnModules key=index item=ynm name=ynmodules}
		<li>
			<div class="info_header"><a href="{$ynm.purchase}" title="{$ynm.name}" target="_blank">{$ynm.name}</a> - <strong>{$ynm.latest_v}</strong> </div>
			<div class="info_module_content">
				<a href="{$ynm.purchase}" title="{$ynm.name}" target="_blank"><img src="{$ynm.image_url}" alt="{$ynm.name}" width="80" height="80" class="img_descriptions" align="left"/></a>
				<div class="description">
					<span >{$ynm.sort_description}</span>
				</div>
				
			</div>
			<div class="menu_control">
					<ul>
						<li class="price">
							<span class="price">{$ynm.price} {$ynm.currency}</span>
						</li>
						<li class="detail">
							<a href="{$ynm.purchase}" title="Detail URL" target="_blank">{phrase var='younetcore.detail_url'}</a>
						</li>
						<li class="demo">
							<a href="{$ynm.demo_url}" title="Demo URL" target="_blank">{phrase var='younetcore.demo_url'}</a>
						</li>
						<li class="photo">
							<a href="javascript:void(0);" onclick="javascript:viewPhotos('{$ynm.key}')">{phrase var='younetcore.photos'}</a>
						</li>
						<li style="padding:0;">
							<span class="{$ynm.key}_loading"></span>
						</li>
					</ul>
				</div>
			<div class="clear"></div>
			<div class="photos_view_descriptions_{$ynm.key} view_photo">
				
			</div>
			<div class="clear"></div>
		</li>
	{/foreach}
	</ul>
{else}
	{phrase var='younetcore.no_plugins_by_younet_company_were_found_on_your_site_click_a_href_http_phpfox_modules2buy_com'}
{/if}
</div>
