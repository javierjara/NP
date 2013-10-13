<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (!empty($_POST) && isset($_POST[\'id\']) && Phpfox::getParam(\'feed.cache_each_feed_entry\') && !PHPFOX_IS_AJAX)
{
	$oReq = Phpfox::getLib(\'request\');
	$oDb = Phpfox::getLib(\'database\');
	
		$sCustomCurrentUrl = Phpfox::getLib(\'module\')->getFullControllerName();
		$aVals = $oReq->getArray(\'val\');		
		if (!empty($aVals))
		{
			switch ($sCustomCurrentUrl)
			{
				case \'blog.add\':
					Phpfox::getService(\'feed.process\')->clearCache(\'blog\', $_POST[\'id\']);
					break;
				case \'pages.add\':
					Phpfox::getService(\'feed.process\')->clearCache(\'pages_itemLiked\', $_POST[\'id\']);
					break;					
				case \'blog.delete\':
					Phpfox::getService(\'feed.process\')->clearCache(\'blog\', $oReq->get(\'id\'));
					break;
			}
		}
	
} $sHttp = (isset($_SERVER[\'HTTPS\']) && $_SERVER[\'HTTPS\'] == \'on\' ? \'https\' : \'http\');

$sFacebookAsync = "
(function(d){
     var js, id = \'facebook-jssdk\'; if (d.getElementById(id)) {return;}
     js = d.createElement(\'script\'); js.id = id; js.async = true;
     js.src = \\"//connect.facebook.net/en_US/all.js\\";
     d.getElementsByTagName(\'head\')[0].appendChild(js);
   }(document));		
		";

if ((defined(\'PHPFOX_IS_AJAX\') && PHPFOX_IS_AJAX) || (defined(\'PHPFOX_IS_AJAX_PAGE\') && PHPFOX_IS_AJAX_PAGE))
{
	
}
else
{
	if (!Phpfox::getParam(\'user.force_user_to_upload_on_sign_up\') && Phpfox::getParam(\'facebook.enable_facebook_connect\') && !Phpfox::isAdminPanel())
	{
		if (Phpfox::isUser())
		{
			if (Phpfox::getLib(\'request\')->get(\'req1\') == \'facebook\' && Phpfox::getLib(\'request\')->get(\'req2\') == \'unlink\')
			{
					
			}			
			else
			{
				if (Phpfox::getUserBy(\'fb_user_id\') && !Phpfox::getUserBy(\'fb_is_unlinked\'))
				{
					$oTpl->setHeader(array(
							\'<script type="text/javascript">
								window.onload = function()
								{
									FB.init(
									{
										appId  : \\\'\' . Phpfox::getParam(\'facebook.facebook_app_id\') . \'\\\',
										status : true,
										cookie : true,
										oauth  : true,
										xfbml  : true
									});

									FB.getLoginStatus(function(response)
									{
										if (!response.authResponse)
										{
											window.location.href = \\\'\' . Phpfox::getLib(\'url\')->makeUrl(\'facebook.unlink\', array(\'noapp\' => \'1\')) . \'\\\';
										}
									});
								};

								\' . $sFacebookAsync . \'
							</script>\')
					);
				}
				else
				{
					$oTpl->setHeader(array(
							// \'<script src="\' . $sHttp . \'://connect.facebook.net/en_US/all.js" type="text/javascript"></script>\',							
							\'<script type="text/javascript">
								window.onload = function()
								{
									FB.init(
									{
										appId  : \\\'\' . Phpfox::getParam(\'facebook.facebook_app_id\') . \'\\\',
										status : true,
										cookie : true,
										oauth  : true,
										xfbml  : true 
									});		
								};
							
								\' . $sFacebookAsync . \'
							</script>\')
						);			
				}
			}
		}
		else 
		{
			if (Phpfox::getLib(\'request\')->get(\'req1\') == \'facebook\' && Phpfox::getLib(\'request\')->get(\'req2\') == \'frame\')
			{

			}
			elseif (Phpfox::getLib(\'request\')->get(\'req1\') == \'facebook\' && Phpfox::getLib(\'request\')->get(\'req2\') == \'logout\')
			{

			}		
			elseif (Phpfox::getLib(\'request\')->get(\'req1\') == \'facebook\' && Phpfox::getLib(\'request\')->get(\'req2\') == \'account\')
			{

			}
			elseif (!empty($_REQUEST[\'facebook-process-login\']))
			{

			}
			else 
			{
				$oTpl->setHeader(array(													
						\'<script type="text/javascript">
							window.onload = function()
							{
								FB.init(
								{
									appId  : \\\'\' . Phpfox::getParam(\'facebook.facebook_app_id\') . \'\\\',
									status : true,
									cookie : true,
									oauth  : true,
									xfbml  : true 
								});
								
								FB.getLoginStatus(function(response){
									if (response.authResponse)
                                    {
										$(\\\'body\\\').html(\\\'<div id="fb-root"></div><div id="facebook_connection">\' . Phpfox::getPhrase(\'facebook.connecting_to_facebook_please_hold\') . \'</div>\\\');
										window.location.href = \\\'\' . Phpfox::getLib(\'url\')->makeUrl(\'facebook.frame\') . \'\\\';
									}
								});
						
								FB.Event.subscribe(\\\'auth.login\\\', function(response) 
								{
									if (response.authResponse) 
									{
										$(\\\'body\\\').html(\\\'<div id="fb-root"></div><div id="facebook_connection">\' . Phpfox::getPhrase(\'facebook.connecting_to_facebook_please_hold\') . \'</div>\\\');
										window.location.href = \\\'\' . Phpfox::getLib(\'url\')->makeUrl(\'facebook.frame\') . \'\\\';
									}
								});
							};	
													
							\' . $sFacebookAsync . \'
						</script>\')
					);
			}
		}
	}
	else
	{
		if (Phpfox::isUser() && !Phpfox::isAdminPanel() && Phpfox::getParam(\'facebook.facebook_app_id\'))
		{
			$oTpl->setHeader(array(					
					\'<script type="text/javascript">
						window.onload = function()
						{
							FB.init(
							{
								appId  : \\\'\' . Phpfox::getParam(\'facebook.facebook_app_id\') . \'\\\',
								status : true,
								cookie : true,			
								oauth  : true,
								xfbml  : true 
							});
						};
					
					\' . $sFacebookAsync . \'
					</script>\'
				)
			);
		}
	}
}

/*
							if (window.location.hash == \\\'#_=_\\\')
							{
								if (history.replaceState) 
								{
									// Keep the exact URL up to the hash.
									var cleanHref = window.location.href.split(\\\'#\\\')[0];

									// Replace the URL in the address bar without messing with the back button.
									history.replaceState(null, null, cleanHref);
								} 
								else
								{
									// Well, you are on an old browser, we can get rid of the _=_ but not the #.
									window.location.hash = \\\'\\\';
								}
							}	
*/ if (Phpfox::getParam(\'core.wysiwyg\') == \'tiny_mce\')
{	
		if (Phpfox::getParam(\'core.site_wide_ajax_browsing\'))
		{
			$oTpl->setHeader(array(
					\'wysiwyg/tiny_mce/tiny_mce.js\' => \'static_script\',
					\'wysiwyg/tiny_mce/core.js\' => \'static_script\'
				)
			);
			
			if (Phpfox::getService(\'tinymce\')->load())
			{			
				$oTpl->setHeader(array(
						Phpfox::getService(\'tinymce\')->getJsCode()
					)
				);
			}			
		}
		else
		{
			Phpfox::getService(\'tinymce\')->load();			
			$oTpl->setHeader(array(
					\'wysiwyg/tiny_mce/tiny_mce.js\' => \'static_script\',
					\'wysiwyg/tiny_mce/core.js\' => \'static_script\',
					Phpfox::getService(\'tinymce\')->getJsCode()
				)
			);			
		}
} '; ?>