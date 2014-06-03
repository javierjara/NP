<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: pic.html.php 6083 2013-06-17 15:48:53Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if Phpfox::getService('profile')->timeline()}
    {if !empty($sProfileImage)}
	    <div class="profile_timeline_profile_photo">
		    <div class="profile_image">
			{if Phpfox::isModule('photo')}
				{if isset($aUser.user_name)}
				    <a href="{permalink module='photo.album.profile' id=$aUser.user_id title=$aUser.user_name}">{$sProfileImage}</a>
				{else}
				    <a href="{permalink module='photo.album.profile' id=$aUser.user_id}">{$sProfileImage}</a>
				{/if}
				<p>{$sProfileImage}</p>
			{else}
				{$sProfileImage} 
			{/if}
			{if Phpfox::getUserId() == $aUser.user_id}
			    <div class="p_4">
				    <a href="{if isset($aPage) && isset($aPage.page_id)}{url link='pages.add' id=$aPage.page_id}#photo{else}{url link='user.photo'}{/if}">{phrase var='profile.change_picture'}</a>
			    </div>
			{/if}

		    </div>

			<div style="position:absolute; bottom:0px; z-index:100; width:100%;">
				{if isset($aUser.user_name)}
				{if isset($aPage.title)}

				{template file='pages.block.joinpage'}

				{/if}
				{/if}
			</div>

	    </div>
    
    {/if}

{else}

{if !empty($sProfileImage)}
<div class="image_profile_position">
<div class="image_profile_wrapper">
{if Phpfox::getUserId() == $aUser.user_id}
<div id="book-button-wrapper">
	<div class="my-book-button-wrapper" >
          <a id="activity_feed_popup_ex" href="#" class="button dont-unbind" onclick="tb_show('Ex life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_ex_tooltip'}"> <img class="my-book-button" src="static/image/my-book-left-button.png" /></a> 
         </div>
    <div class="my-book-button-wrapper" >
           <a id="activity_feed_popup_next" href="#" class="button dont-unbind" onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">  <img class="my-book-button" src="static/image/my-book-right-button.png" /></a>
         </div>
</div>
{/if}

<!--POPUP HTML START-->
<div id="popup_box">
<div id="js_box_id_1" class="js_box  ui-draggable" style="width: 500px; top: 10%; left: 10%; margin-left: -162px; z-index: 5003; display: block; ">
<div class="js_box_title" style="display: block; ">Profile Picture</div>
<div class="js_box_content"><div class="main_break"></div>
<div class="block sub_block">
<div class="content" align="center">
	{if Phpfox::getUserId() == $aUser.user_id}
	   	<?php echo Phpfox::getLib('phpfox.image.helper')->display(array(
	   		'user' => $this->_aVars['aGlobalUser'],
	   		'max_width' => 500,
	   		'max_height' => 500)); ?> 
	{else}
	   		{$sProfileImage}
	{/if}
</div>
<div class="clear"></div>
</div>
</div><div class="js_box_close" style="display: block; "><a href="#" onclick="$('#popup_box').hide(); return false;" id="styling_close"></a></div>
</div>
</div>
<!-- POPUP HTML END-->

 				
   <div id="img_profile"> 
        <div class="profile_image" >
	<div class="profile_image_holder">
	    {if Phpfox::isModule('photo')}
		{if isset($aUser.user_name)}
		    	<a id="styling_open" onclick="$('#popup_box').show(); return false;" href="#">{$sProfileImage}</a>
		    	<!-- <a href="{permalink module='photo.album.profile' id=$aUser.user_id}">{$sProfileImage}</a> -->
		{/if}
	    {else}
		    {$sProfileImage}
	    {/if}
	</div>
	    {if Phpfox::getUserId() == $aUser.user_id}
	    <div class="change_pic_holder">
		    <a class="change_pic" href="{url link='user.photo'}">{phrase var='profile.change_picture'} </a>
	    </div>
	    {/if}



        </div>
        
</div></div> </div>
{/if}


<div class="horizontal_bar" >
	<ul>		
		{foreach from=$aProfileLinks item=aProfileLink}
			<li class="{if isset($aProfileLink.is_selected)} active{/if}">
				<a href="{url link=$aProfileLink.url}" class="ajax_link"{if isset($aProfileLink.icon)} style="background-image:url('{img theme=$aProfileLink.icon' return_url=true}');"{/if}>{$aProfileLink.phrase}{if isset($aProfileLink.total)}<span>({$aProfileLink.total|number_format})</span>{/if}</a>
				{if isset($aProfileLink.sub_menu) && is_array($aProfileLink.sub_menu) && count($aProfileLink.sub_menu)}
				<ul>
				{foreach from=$aProfileLink.sub_menu item=aProfileLinkSub}
					<li class="{if isset($aProfileLinkSub.is_selected)} active{/if}"><a href="{$aProfileLinkSub.url}">{$aProfileLinkSub.phrase}{if isset($aProfileLinkSub.total) && $aProfileLinkSub.total > 0}<span class="pending">{$aProfileLinkSub.total|number_format}</span>{/if}</a></li>
				{/foreach}
				</ul>
				{/if}
			</li>
		{/foreach}
	</ul>
</div>
{if Phpfox::getUserId() == $aUser.user_id}
<div class="horizontal_bar" >
	<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
				<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}"> 
					<div class="ca-item ca-item-1">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>MOMENTS</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-2">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>MOVIES</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-3">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>FAMILY</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-4">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>ACTIVITIES</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-5">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>BOOKS</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-6">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>ANIMALS</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-7">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>PHRASES</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-8">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>MUSIC</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-9">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>HOLIDAYS</span>
							</h4>
						</div>
					</div>
					</a>
					<a href="#"  onclick="tb_show('Next life', $.ajaxBox('feed.popup', 'height=300&width=550')); return false;" title="{phrase var='feed.submit_next_tooltip'}">
					<div class="ca-item ca-item-10">
						<div class="ca-item-main">
							<div class="ca-icon"></div>
							<h4>
								<span>PLACES</span>
							</h4>
						</div>
					</div>
					</a>
				</div>
			</div>
</div>
{/if}

{literal} 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
	$('#ca-container').contentcarousel();
</script>
{/literal}

{/if}

    <div class="clear"></div>
    <div class="js_cache_check_on_content_block" style="display:none;"></div>
    <div class="js_cache_profile_id" style="display:none;">{$aUser.user_id}</div>
    <div class="js_cache_profile_user_name" style="display:none;">{if isset($aUser.user_name)}{$aUser.user_name}{/if}</div>