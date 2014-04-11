<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: template.html.php 6620 2013-09-11 12:10:20Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>{if !PHPFOX_IS_AJAX_PAGE}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
	<head>
		<title>{title}</title>	
                
		<link rel="stylesheet" href="eventCalendar_v054/css/eventCalendar.css">
                <link rel="stylesheet" href="eventCalendar_v054/css/eventCalendar_theme_responsive.css">
                <link rel="stylesheet" href="timePicker-master/timePicker.css">
                <link rel="stylesheet" href="sidr/stylesheets/jquery.sidr.light.css">

                   
                {header}
                    <script type="text/javascript"
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA6x6e7D8YTeV4xApjtyuE_n3sL6xnjsE&sensor=false">
                    </script>
                
                <meta name="viewport"  content="initial-scale=1, maximum-scale=1, width=device-width, user-scalable=no" >
                
	</head>
	<body>
            
            
		<div{if !Phpfox::isUser()} id="nb_body_holder_guest"{elseif defined('PHPFOX_IN_DESIGN_MODE')} id="nb_in_design"{/if}>
			{body}	
			{block location='9'}
                        
		
			<div id="header">
			
				{if !Phpfox::isUser()}
				{if Phpfox::getParam('user.hide_main_menu')}

				{else}

				{/if}
				{/if}		
                        
				<div class="holder">	
                                    
					{block location='10'}
					<div id="header_holder" {if !Phpfox::isUser()} class="header_logo"{/if}>				
						<div id="header_left">
                                                    <div id="header_left_holder">{logo}</div>
							
                                                        
                                                        {if Phpfox::isUser()}
                                                        <a id="menu-left-mobile" href="#sidr" class="dont-unbind">
                                                            <img src="static/image/menu-left-mobile.png" class="v_middle">
                                                        </a>
                                                        {/if}
						</div>
                                                
						<div id="header_right">
							<div id="header_top">

								{if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id') && !Phpfox::getParam('user.hide_main_menu')}
								<div id="nb_features">
									<a href="#" id="nb_features_link">Features</a>
									<div id="nb_features_holder">
										{assign var='bNoAppsMenu' value=true}									
										{menu}
									</div>								
								</div>
								{/if}
								<div id="header_menu_holder">
									{if Phpfox::isUser()}
                                                                        
                                                                        <a href="{url link=''}" id="logo-short">
                                                                            <img src="static/image/N.png" class="v_middle">
                                                                        </a>
                                                                        
                                                                        {menu_account}
									<div class="clear"></div>	
									{else}
									{module name='user.login-header'}
									{/if}							
								</div>							
								{if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id') && Phpfox::isModule('search')}
								<div id="header_search_header">	
									<div id="header_menu_space">
										<div id="header_sub_menu_search">
											<form method="post" id='header_search_form' action="{url link='search'}">																						
												<input type="text" name="q" value="{phrase var='core.search_dot'}" id="header_sub_menu_search_input" autocomplete="off" class="js_temp_friend_search_input" />											
												<div id="header_sub_menu_search_input"></div>
												<a href="#" onclick='$("#header_search_form").submit(); return false;' id="header_search_button">{phrase var='core.search'}</a>											
											</form>
										</div>
									</div>
								</div>	
								{/if}													
							</div>					
						</div>
                                                <div id='header_center'>
                                                    {if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id')}
                                                        <div id="holder_notify">																	
                                                            {notification}
                                                            <div class="clear"></div>
                                                        </div>
                                                    {/if}
                                                </div>
						{block location='6'}
					</div>
				</div>		
			</div>
			
			<div id="nb_body">
                            
                            
                            
                        <div id="sidr" style="display: none;">
                            <div onClick="$.sidr('close'); " id="close_left_menu_label">
                                <img src="static/image/menu-left-mobile-green.png" class="v_middle">
                            </div>
                        <!-- Your content -->
                        <ul>

                            <div id="nb_name">
                                    <div class="nb_name_image" style="border-radius: 10px;">
                                            {$sUserProfileImage}
                                    </div>
                                    <div class="nb_name_info">
                                            <a href="{$sUserProfileUrl}" class="nb_name_link">{$sCurrentUserName}</a>
                                            <div class="nb_name_edit" >
                                                <a href="{url link='user.profile'}" class="nb_name_link">{phrase var='theme.edit_profile'}</a>
                                            </div>
                                    </div>
                            </div>

                            <div id="nb_favorites" class="block">
                            {if false}
                                    <div class="title">
                                            <a href="#" class="nb_edit_block_title">{phrase var='theme.edit'}</a>
                                            {phrase var='theme.favorites'}
                                    </div>
                            {/if}
                                    <div id="nb_main_menu">
                                            {assign var='iTotalHide' value=8}
                                            {menu}
                                    </div>		
                            </div>
                            
                        </ul>
                        </div>
			
                            
                            
                            <div id="{if Phpfox::isUser()}main_core_body_holder{else}main_core_body_holder_guest{/if}">		
                                {block location='11'}
					<div id="main_content_holder">	
					{/if}
						<div {holder_name}>		
							<div {is_page_view} class="holder{if (defined('PHPFOX_IS_USER_PROFILE_INDEX') || defined('PHPFOX_IS_PAGES_IS_INDEX')) && Phpfox::getService('profile')->timeline()} js_is_profile_timeline{/if}">	
								
								{module name='profile.logo'}
								
								<div id="content_holder"{if isset($sMicroPropType)} itemscope itemtype="http://schema.org/{$sMicroPropType}"{/if}>
									
                                                                        {block location='13'}
									{block location='7'}				
									{if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
									
									{block location='12'}
									{/if}
		
									{if !$bUseFullSite}		
									{if defined('PHPFOX_IN_DESIGN_MODE') && Phpfox::getService('profile')->timeline()}
									
									{else}			
									<div id="right" class="content_column">
                                                                            
                                                                            
                                                                        
                                                                        
                                                                        <!--BEGIN ABOUT ME-->
                                                                        {if defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW') || !Phpfox::isUser()}
                                                                        <div style=" height: 150px;">        
                                                                        <h3 style="color:#52C921; font-weight:bold;">{$aUser.full_name|clean|split:30|shorten:50:'...'}</h3>
                                                                         <p style="overflow: auto; font-weight: bold; color:#807E7E; font-family: inherit; height: 90%;">
                                                            <b></b> <br>


                                                            {if Phpfox::getService('user.privacy')->hasAccess('' . $aUser.user_id . '', 'profile.view_location') && (!empty($aUser.city_location) || !empty($aUser.country_child_id) || !empty($aUser.location))}
                                                            {phrase var='profile.lives_in'} {if !empty($aUser.city_location)}{$aUser.city_location}{/if}
                                                                    {if !empty($aUser.city_location) && (!empty($aUser.country_child_id) || !empty($aUser.location))},{/if}
                                                                    {if !empty($aUser.country_child_id)} {$aUser.country_child_id|location_child}{/if} {if !empty($aUser.location)}{$aUser.location}{/if} <br>
                                                            {/if}
                                                            {if isset($aUser.birthdate_display) && is_array($aUser.birthdate_display) && count($aUser.birthdate_display)}
                                                                    {foreach from=$aUser.birthdate_display key=sAgeType item=sBirthDisplay}
                                                                            {if $aUser.dob_setting == '2'}
                                                                                    {phrase var='profile.age_years_old' age=$sBirthDisplay}
                                                                            {else}
                                                                                    {phrase var='profile.born_on_birthday' birthday=$sBirthDisplay} <br>
                                                                            {/if}
                                                                    {/foreach}
                                                            {/if}
                                                            {if Phpfox::getParam('user.enable_relationship_status') && isset($sRelationship) && $sRelationship != ''}{$sRelationship} <br> {/if}
                                                            {php}Phpfox::getBlock('userinfo.profileinfo', array('aUser' => $this->getVar('aUser')));{/php}
                                                            {if isset($aUser.category_name)}{$aUser.category_name|convert}{/if}
                                                           </p></div>
                                                                        {if Phpfox::getUserId() == $aUser.user_id}
                                                                        <div class="edit_profile">
                                                                            <a href="{url link='user.profile'}">{phrase var='profile.edit_profile'}</a></div>
                                                                        {elseif Phpfox::isModule('mail') && Phpfox::getService('user.privacy')->hasAccess('' . $aUser.user_id . '', 'mail.send_message')}
                                                                          <div class="edit_profile">  <a href="#" onclick="$Core.composeMessage({left_curly}user_id: {$aUser.user_id}{right_curly}); return false;">{phrase var='profile.send_message'}</a></div>
                                                                        {/if}
                                                                                {if Phpfox::isModule('friend') && !$aUser.is_friend && Phpfox::getUserParam('friend.can_add_friends') && Phpfox::getUserId() != $aUser.user_id && $aUser.is_friend_request !== 2}
                                                                                <div id="js_add_friend_on_profile_sidebar">
                                                                                    <a href="#?call=friend.request&amp;user_id={$aUser.user_id}&amp;width=420&amp;height=250" class="inlinePopup" title="{phrase var='profile.add_to_friends'}">
                                                                                        {phrase var='profile.add_to_friends'}
                                                                                    </a>
                                                                                </div>
                                                                                {/if}
                                                                                {menu_sub}
                                                                               
                                                                                
                                                                         {/if}
                                                                         
                                                                         <!--FINAL ABOUT ME-->
                                                                        
                                                                        {if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id') && Phpfox::isModule('search')}
                                                                        <div id="header_search">	
                                                                                <div id="header_menu_space">
                                                                                        <div id="header_sub_menu_search">
                                                                                                <form method="post" id='header_search_form' action="{url link='search'}">																						
                                                                                                        <input type="text" name="q" placeholder="{phrase var='core.search_dot'}" id="header_sub_menu_search_input" autocomplete="off" class="js_temp_friend_search_input" />											
                                                                                                        <div id="header_sub_menu_search_input"></div>
                                                                                                        <a href="#" onclick='$("#header_search_form").submit(); return false;' id="header_search_button">{phrase var='core.search'}</a>											
                                                                                                </form>
                                                                                        </div>
                                                                                </div>
                                                                        </div>	
                                                                        {/if} 
                                                                         
                                                                         
									{if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id')}
									{block location='20'}	                                                                                
                                                                                <div id="eventCalendarHumanDate"></div>
                                                                                
                                                                                
                                                                                
                                                                        {/if}
									</div>	
									{/if}				
									{/if}
		
                                                                        {if !$bUseFullSite}
												
                                                                        <div id="left" class="content_column" >
                                                                            <div id="content_column_left_out">
                                                                               
                                                                                
                                                                                {if !Phpfox::isUser() || Phpfox::getLib('module')->getFullControllerName() == 'core.index-member' || defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW')}
                                                                                {else}
                                                                         <div id="content_column_left_in">
                                                                                   <div id="my-book-profile">
                                                                                        <div id="nb_name">
                                                                                            <div class="nb_name_info" style="float: left;">
                                                                                                <a href="{$sUserProfileUrl}" class="nb_name_link">{$sCurrentUserName}</a>

                                                                                            </div>
                                                                                            <div style="clear: both;"></div>
                                                                                            <div class="nb_name_image" class="nb_name_link" style="float: left; margin-left: 25px;margin-top: 10px;">
                                                                                                {$sUserProfileImage}
                                                                                            </div>
                                                                                            <div class="nb_name_edit" style="float: right; margin-right: 40px; margin-top: 20px;">
                                                                                                <a href="{url link='user.profile'}" style="color:#FFFFFF" >{phrase var='theme.edit_profile'}</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                             
                                                                                    
                                                                                    <div id="nb_favorites" class="block">
                                                                                    {if false}
                                                                                            <div class="title">
                                                                                                    <a href="#" class="nb_edit_block_title">{phrase var='theme.edit'}</a>
                                                                                                    {phrase var='theme.favorites'}
                                                                                            </div>
                                                                                    {/if}
                                                                                            <div id="nb_main_menu">
                                                                                                    {assign var='iTotalHide' value=8}
                                                                                                    
                                                                                                    {menu}
                                                                                                    
                                                                                            </div>		
                                                                                    </div>
                                                                                

                                                                                </div>
                                                                         <div id="content_column_left_bottom"></div> 
                                                                                
                                                                                {menu_sub}
                                                                                {block location='1'}
                                                                                {/if}
                                                                                {unset var=$aMenu}
                                                                                {if defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW') || !Phpfox::isUser()}
                                                                              
                                                                               <div id="content_column_left_in">
                                                                                   <div id="my-book-profile">
                                                                                        <div id="nb_name">
                                                                                            <div class="nb_name_info" style="float: left;">
                                                                                                <a href="{$sUserProfileUrl}" class="nb_name_link">{$sCurrentUserName}</a>

                                                                                            </div>
                                                                                            <div style="clear: both;"></div>
                                                                                            <div class="nb_name_image" class="nb_name_link" style="float: left;margin-left: 25px; margin-top: 10px;">
                                                                                                {$sUserProfileImage}
                                                                                            </div>
                                                                                            <div class="nb_name_edit" style="float: right; margin-right: 40px; margin-top: 20px;">
                                                                                                <a href="{url link='user.profile'}" style="color:#FFFFFF" >{phrase var='theme.edit_profile'}</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <div id="nb_favorites" class="block">
                                                                                    {if false}
                                                                                            <div class="title">
                                                                                                    <a href="#" class="nb_edit_block_title">{phrase var='theme.edit'}</a>
                                                                                                    {phrase var='theme.favorites'}
                                                                                            </div>
                                                                                    {/if}
                                                                                            <div id="nb_main_menu">
                                                                                                    {assign var='iTotalHide' value=8}
                                                                                                    
                                                                                                    {menu}
                                                                                                    
                                                                                            </div>		
                                                                                    </div>
                                                                                

                                                                                </div>
                                                                                <div class="bustahover">
                                                                                <div id="busta" >{block location='3'}</div> 
                                                                                
                                                                                <div id="content_column_left_bottom" class="bottom_busta">  <img src="static/image/medal1.png"></div> 
                                                                                <!--HOME UP_BUSTA-->
                                                                                </div>
                                                                                {else}
                                                                                <!--HOME UP_UP-->
                                
                            

                                                                                {if Phpfox::getLib('module')->getFullControllerName() == 'core.index-member'}	
                                                                                <div id="content_column_left_in">

                                                                                    <div id="my-book-profile">
                                                                                        <div id="nb_name">
                                                                                            <div class="nb_name_info" style="float: left;">
                                                                                                <a href="{$sUserProfileUrl}" class="nb_name_link">{$sCurrentUserName}</a>

                                                                                            </div>
                                                                                            <div style="clear: both;"></div>
                                                                                            <div class="nb_name_image" style="float: left;margin-left: 25px;margin-top: 10px;">
                                                                                                {$sUserProfileImage}
                                                                                            </div>
                                                                                            <div class="nb_name_edit" style="float: right;margin-right: 40px;margin-top: 20px;">
                                                                                                <a href="{url link='user.profile'}" style="color:#FFFFFF" >{phrase var='theme.edit_profile'}</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                   

                                                                                     <div id="nb_favorites" class="block">
                                                                                        {if false}

                                                                                        <div class="title">
                                                                                            <a href="#" class="nb_edit_block_title">{phrase var='theme.edit'}</a>
                                                                                            {phrase var='theme.favorites'}
                                                                                        </div>
                                                                                        {/if}

                                                                                        <div id="nb_main_menu">
                                                                                            {assign var='iTotalHide' value=8}

                                                                                            {menu}
                                                                                    

                                                                                        </div>		
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <div class="bustahover">
                                                                                <div id="busta" >{block location='3'}</div> 
                                                                                
                                                                                <div id="content_column_left_bottom" class="bottom_busta">  <img src="static/image/medal1.png"></div> 
                                                                                <!--HOME UP_BUSTA-->
                                                                                </div>
                                                                             
                                                                                <!--HOME DOWN_BUSTA-->
                                                                                
                                                                                {menu_sub}
                                                                                <!{block location='1'}-->
                                                                                
                                                                                {if false}
                                                                                <a href="{url link='core.index-member.customize'}" class="no_ajax_link nb_customize_dash">{phrase var='core.customize_dashboard'}</a>
                                                                                {/if}

                                                                                {/if}								

                                                                                {/if}
                                                                            </div>

                                                                        </div>

                                                                        {/if}
                                                                        
									<div id="main_content">
												
										{if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
										{breadcrumb}
										{search}
										{/if}
										<div id="main_content_padding">
		
											{if defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW') || (isset($aPage) && isset($aPage.use_timeline) && $aPage.use_timeline)}
											    {if $bLoadedProfileHeader = true}{/if}
											    {module name='profile.header'}
											{/if}
											{if defined('PHPFOX_IS_PAGES_VIEW') && !isset($bLoadedProfileHeader)}
											    {block location='12'}
											    {module name='pages.header'}
											{/if}							
		
											<div id="content_load_data">
												{if isset($bIsAjaxLoader) || defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW')}
												{search}
												{/if}								
		
												{if isset($aBreadCrumbTitle) && count($aBreadCrumbTitle)}
												<h1><a href="{$aBreadCrumbTitle[1]}">{$aBreadCrumbTitle[0]|clean|split:30}</a></h1>
												{/if}
		
												<div id="content" {content_class}>
													
													{error}
													{block location='2'}
													{content}
													{block location='4'}
															
												</div>
		
												
		
												<div class="clear"></div>							
											</div>												
										</div>				
									</div>
									<div class="clear"></div>			
								</div>		
								{block location='8'}
								
								<div class="holder{if $bUseFullSite} nb_footer_full{else}{if defined('PHPFOX_IS_USER_PROFILE_INDEX') && Phpfox::getService('profile')->timeline()} js_is_profile_timeline{/if}{/if}">
									<div id="nb_footer">
									{menu_footer}					
									<div id="nb_copyright">
										{copyright}
									</div>				
									{block location='5'}
									</div>				
								</div>
							</div>							
						</div>			
					{if !PHPFOX_IS_AJAX_PAGE}
					</div>				
                                        
					{footer}		
				</div>		
			</div>		
		</div>		
	</body>
    <script src="eventCalendar_v054/js/jquery.timeago.js" type="text/javascript"></script>
    <script src="eventCalendar_v054/js/jquery.eventCalendar.js" type="text/javascript"></script>
    <script src="timePicker-master/jquery.timePicker.min.js" type="text/javascript"></script>
    <script src="sidr/jquery.sidr.min.js"></script>

    <script>
        

    </script>
    
</html>
{/if}