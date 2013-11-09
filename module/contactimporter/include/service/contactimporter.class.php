<?php
    /*
    * @copyright        [YouNet_COPYRIGHT]
    * @author           YouNet Development
    * @package          Module_Contactimporter
    * @version          2.06
    *
    */
    defined('PHPFOX') or exit('NO DICE!');
?>

<?php
if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'linkedin_2.1.0.class.php'))
{
   // require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'linkedin_2.1.0.class.php');  
}
if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'facebook.php'))
{
	require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'facebook.php');  
}

class contactimporter_Service_contactimporter extends Phpfox_Service 
{
	private $_fbAdapter = null;
	/**Have a quick fix for fb using api**/
	
	public $_aAllowProvider = array (
		'yahoo','gmail','plaxo','hotmail',
        'facebook_','twitter','myspace','linkedin','plaxo','famiva','fdcareer','flickr','hyves','kincafe','motortopia','techemail','netlog','perfspot','plurk',/*'rediff','bigstring','nz11'*/
	);		
	
	public $_apiLink = 'http://dp.younetid.com/phpfox-contact/open_inviter.php';
	
	public function allowProvider($provider_lists) 
	{
		if (count($provider_lists))
		{
			foreach($provider_lists as $key=>$value)
			{
				if (!in_array($value['name'], $this->_aAllowProvider))
				{
					unset($provider_lists[$key]);    
				}
			}
		}
		return $provider_lists;
	}
	
	public function initFB()
	{
		if ($this->_fbAdapter == null)
		{
			$fb_settings = Phpfox::getLib('phpfox.database')->select('*')
				->from(Phpfox::getT('contactimporter_api_settings'),'st')
				->where('st.api_name = "facebook"')
				->execute('getRow');
			if ($fb_settings == null)
			{
				//Phpfox_Error::set('Please enter your facebook API.');
				return false;
			}
			$fb_settings['api_params'] = unserialize($fb_settings['api_params']);            
				$this->_fbAdapter  = new Facebook(array(
				'appId'  => $fb_settings['api_params']['appid'],
				'secret' => $fb_settings['api_params']['secret'],
				'cookie' => true,
			));
			$_SESSION['fpConfig'] = array(
				'appId'  => $fb_settings['api_params']['appid'],
				'secret' => $fb_settings['api_params']['secret'],
				'cookie' => true,
			);
		}
		return $this->_fbAdapter;
	}
	
	public function verifyFB()
	{
		if($this->_fbAdapter)
		{
			$session = $this->_fbAdapter->getSession();
			if($session)
			{
				return true;
			}
		}
		return false;
	}
	
	public function getSession()
	{
		return $this->_fbAdapter->getSession();
	}
	
	public function setSession($session = null)
	{
		if(!$this->_fbAdapter)
		{
			$this->initFB();
		}
		return $this->_fbAdapter->getSession($session);
	}
	
	public function getLoginUrl()
	{
		if($this->_fbAdapter)
		{
			$params['req_perms'] = 'publish_stream';
			$module_url = urlencode(phpfox::getLib('url')->makeUrl('contactimporter'));
			$module_url = str_replace("%2Fcontactimporter%2F","%2Fcontactimporter",$module_url);                
			$module_url2 = urlencode(phpfox::getLib('url')->makeUrl('contactimporter'));
			$module_url2 = str_replace("%2Fcontactimporter%2F","%252Fcontactimporter%252F",$module_url2);
			if(!PHPFOX_IS_AJAX_PAGE)
			{
				$url = $this->_fbAdapter->getLoginUrl($params);     
			}
			else
			{
				$url = $this->_fbAdapter->getLoginUrl($params,phpfox::getLib('url')->makeUrl('contactimporter'));     
			}
			
			$url = str_replace($module_url2,urlencode(phpfox::getParam('core.path').'/module/contactimporter/static/fb.php'),$url);
			$url = str_replace($module_url,urlencode(phpfox::getParam('core.path').'/module/contactimporter/static/fb.php'),$url);
			$url = str_replace("fbcontact%2F","",$url);
			$url = str_replace("index.php?do=%2F","",$url);
			return $url;
		}
	}

	public function getLoginUrlHome()
	{
		if($this->_fbAdapter)
		{
			$params['req_perms'] = 'publish_stream';
			$module_url = urlencode(phpfox::getLib('url')->makeUrl('contactimporter'));
			$url = $this->_fbAdapter->getLoginUrlHome($params);
			return str_replace($module_url,urlencode(phpfox::getParam('core.path').'/module/contactimporter/static/fb.php'),$url);
		}
	}

	public function getUserProfileFB()
	{
		if($this->_fbAdapter)
		{
			$uid = $this->_fbAdapter->getUser();
			try{
				$me = $this->_fbAdapter->api('/me');    
			}catch(FacebookApiException $e){
				Phpfox_Error::set($e);
				return null;
			}
			return $me;
		}
		return null;
	}
        
	public function getUserFriendsFB()
	{
		if($this->_fbAdapter)
		{
			$frfb = array();
			try
			{

				$session = $this->_fbAdapter->getSession();  
				$friends= $this->_fbAdapter->api('/me/friends?token='.$session['access_token']);
				$imgLink = "http://graph.facebook.com/%s/picture";
				foreach ($friends as $key => $value) 
				{
					foreach ($value as $key2=>$aFriend)
					{
						//echo "<img src ='".sprintf($imgLink,$aFriend['id'])."' alt=''/>";
						$friends[$key][$key2]['pic'] =sprintf($imgLink,$aFriend['id']); 
						$frfb[$aFriend['id']] = array(
							'id' =>$aFriend['id'],
							'pic' =>sprintf($imgLink,$aFriend['id']),
							'name' =>$aFriend['name'],
						);
					}
				}
			}
			catch(FacebookApiException $e)
			{
				Phpfox_Error::set($e);
				return $frfb;
			}
			return $frfb;
		}
		return null;
	}
	
	public function logoutFB()
	{
		if($this->_fbAdapter)
		{
			if($this->getSession())
			{
				$urlLogOut = $this->_fbAdapter->getLogoutUrl();
			}
		}
	}
	
	public function sendInvitationFB($list, $message, $link)
	{
		if ($this->_fbAdapter)
		{
			if (isset($list))
			{				
				$message = nl2br($message);
				$name = Phpfox::getPhrase('contactimporter.you_are_invited_to_message_from_host', array('host' => phpfox::getParam('core.path'), 'link'=>$link));
				$name = nl2br($name);
				$param = array (
					'message' => $message,					
					'link' => $link,
					'name' => $name,
					'caption' => phpfox::getParam('core.path'),
					'description' => phpfox::getParam('core.global_site_title')
				);
				foreach ($list as $key => $user)
				{					
					try 
					{
						$fbme  = $this->_fbAdapter->api('/'.$key.'/feed', 'POST', $param);
					}
					catch(Exception $e)
					{
						//Phpfox_Error::set($e);
					}					
				}
			}
		}
	}
		
	/**END**/
	public function updateStatistic($user_id,$emails ,$social )
	{
		$statistic = phpfox::getLib('phpfox.database')->select('*')
		->from(phpfox::getT('contactimporter_statistics'))
		->where('user_id = '.$user_id)                               
		->execute('getRow');
		if($statistic != null)
		{
			phpfox::getLib('phpfox.database')
			->update(phpfox::getT('contactimporter_statistics'),
			array('emails'=>$statistic['emails']+$emails,'socials'=>$statistic['socials']+$social),
			'statictis_id = '.$statistic['statictis_id']);
		}
		else
		{
			Phpfox::getLib('phpfox.database')
			->insert(Phpfox::getT('contactimporter_statistics'),
			array('user_id' =>$user_id,'emails'=>$emails,'socials'=>$social));            
		}
	}
        
	public function getAllEmailInvitations($aCond = array(),$sSort = 'invite_id ASC', $iPage = '', $sLimit = '', $bCount = true)
	{
		if ($bCount )
		{
			$emails =  phpfox::getLib('phpfox.database')->select('pu.user_name,pi.user_id,pu.full_name,pu.email as inviter_email,pi.email as receive_email,pi.invite_id')
				->from(phpfox::getT('invite'),'pi')
				->leftJoin(phpfox::getT('user'),'pu','pu.user_id = pi.user_id')
				->where($aCond)
				->execute('getRows');
			$iCnt = count($emails);
		}
		if ($iCnt)
		{
			$emails =  phpfox::getLib('phpfox.database')->select('pu.user_name,pi.user_id,pu.full_name,pu.email as inviter_email,pi.email as receive_email,pi.invite_id')
			->from(phpfox::getT('invite'),'pi')
			->leftJoin(phpfox::getT('user'),'pu','pu.user_id = pi.user_id')
			->where($aCond)
			->limit($iPage, $sLimit, $iCnt)
			->execute('getRows');
		}
		
		if (!$bCount)
		{
			return $emails;
		}
		return array($iCnt, $emails);
	}

	public function getContactsTW()
	{
		$params = "task=get_contact_list";
		$params .="&oauth_tok3n=". $_SESSION['token'];
		$params .="&oauth_token_secret=". $_SESSION['secret_token'];   
		$params .="&user_id=".$_SESSION['user_id'];      
		$ch = curl_init("http://openid.younetid.com/auth/twitter.php");
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$return_Data = curl_exec($ch);
		$index = strpos($return_Data,'returnConnnetions=');
		if ($index < 0)
		{
			return array();
		} 
		else
		{
			$datastr = substr($return_Data,$index+strlen('returnConnnetions='));
			//echo $datastr;die('2222');
			$array_data = explode(',',$datastr);
			// echo "<pre>".print_r($array_data,true)."</pre>";
			$count = count($array_data)-1;
			$contacts = array();
			for($i = 0 ; $i < $count-1; $i+=6)
			{
				$contacts[$array_data[$i+1]]= array('id'=>$array_data[$i+1],'name'=>$array_data[$i+3],'pic'=>$array_data[$i+5]); 
			}
		}
		return $contacts;
	}

	public function getOpenInviterLink()
	{		
		return 'http://dp.younetid.com/phpfox-contact/open_inviter.php';
	}

	public function getContactOpenviter($provider_box,$email_box,$password_box)
	{
		$api = 'http://dp.younetid.com/phpfox-contact/open_inviter.php';
		$email_box = $_POST['email_box'];
		$password_box = $_POST['password_box'];
		$provider_box = $_POST['provider_box'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api);//$this->getOpenInviterLink()
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=utf-8"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "provider_box={$provider_box}&email_box={$email_box}&password_box={$password_box}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          
		$server_output = curl_exec($ch);
		curl_close($ch);
		$aReturnInfo = json_decode($server_output);
		return $aReturnInfo;
	}

	public function sendMessageTW($contacts = array(),$message,$linkInvite = "",$res= array())
	{
		$message = strip_tags($message);
		$mailtemp = substr($message, 0, 140 - strlen($linkInvite))."\n\r".$linkInvite;
		$cons = array();  
		$postdata = array();
		$postdata['lType'] = 'message';
		//$postdata['connections'] = $cons;
		$postdata['message_subject'] =  phpfox::getUserBy('user_name');
		$postdata['message_body'] = $mailtemp;      
		$params = "task=send_message";
		$params .="&user_id=" . $_SESSION['user_id'];  
		$i = 0;
		foreach ($contacts as $key =>$name)
		{            
			$params.="&$i=$key";
			$i++;
		}
		$params .="&message_body=".htmlspecialchars($mailtemp);
		$params .="&message_subject=".phpfox::getUserBy('user_name');
		$params .="&oauth_tok3n=". $_SESSION['token'];
		$params .="&oauth_token_secret=". $_SESSION['secret_token'];
		
		$s = print_r(array($_SESSION['token'], $_SESSION['secret_token']), true);	
		file_put_contents(PHPFOX_DIR_FILE . 'log/importer.txt', $s);
		
		$ch = curl_init("http://openid.younetid.com/auth/twitter.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$Rec_Data = curl_exec($ch);
	}
       
	public function getContactsYT($username = null)
	{        
		if (!isset($_SESSION['token_YT']) || !isset($_SESSION['sessionToken'])) return null;
		$params = "operation=get_list_contacts";     
		$params .="&username=". '';
		$params .="&tok3n=". $_SESSION['token_YT'];   
		$params .="&sessionToken=". $_SESSION['sessionToken'];
		$ch = curl_init("http://openid.younetid.com/auth/youtube.php");
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$return_Data = curl_exec($ch);		
		$pattern = "/{sessionToken}(.*?){\/sessionToken}/";
		preg_match($pattern, $return_Data, $matches);
		if (isset($matches[1]) && !empty($matches[1])) 
		{
			$_SESSION['sessionToken'] = $matches[1];
		}
		$index = strpos($return_Data,'returnConnnetions=');  
		if ($index < 0)
		{
			return array();
		}
		else
		{
			$datastr = substr($return_Data,$index+strlen('returnConnnetions='));
			$array_data = explode(',',$datastr);        
			$count = count($array_data)-1;
			$contacts = array();
			for($i = 0 ; $i < $count-1; $i+=6)
			{
				$contacts[$array_data[$i+1]]= array('id'=>$array_data[$i+1],'name'=>$array_data[$i+3],'pic'=>$array_data[$i+5]); 
			}
		}     
		return $contacts;
	}
        
	public function sendMessageYT($contacts = array(),$message,$res= array())
	{       
		$mailtemp = "";
		foreach($message as $key=>$mess)
		{
			if ($key !="attachment") $mailtemp .= $mess;
		}		
		$cons = $postdata = array();
		$postdata['operation'] = 'send_message';     
		$postdata['subject'] =  phpfox::getUserBy('user_name');
		$postdata['message'] = $mailtemp;
		$params = "operation=send_message_vunh";
		$params .= "&tok3n=".$_SESSION['token_YT'];		
		foreach ($contacts as $key =>$name)
		{            
			$params.="&connections[]=$key";
		}
		$params .="&message=".htmlspecialchars($mailtemp);
		$params .="&subject=".phpfox::getUserBy('user_name');       
		$ch = curl_init("http://openid.younetid.com/auth/youtube.php");     
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$Rec_Data = curl_exec($ch);
		curl_close($ch);
		$respone = json_decode($Rec_Data);      
	}

	public function getContacts()
	{
		$params = "lType=getconnections";
		$params .="&oauth_tok3n=". $_SESSION['token'];
		$params .="&oauth_token_secret=". $_SESSION['secret_token'];       
		$ch = curl_init("http://openid.younetid.com/auth/contact.php");
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$return_Data = curl_exec($ch);
		$index = strpos($return_Data,'returnConnnetions=');
		if ($index < 0)
		{
			return array();
		} 
		else
		{
			$datastr = substr($return_Data,$index+strlen('returnConnnetions='));
			$array_data = explode(',',$datastr);
			$count = count($array_data)-1;
			$contacts = array();
			for($i = 0 ; $i < $count-1; $i+=6)
			{
				$contacts[$array_data[$i+1]]= array('id'=>$array_data[$i+1],'name'=>$array_data[$i+3],'pic'=>$array_data[$i+5]); 
			}
		}
		return $contacts;
	}
	
	public function sendMessage($contacts = array(),$message,$res= array())
	{       
		$mailtemp = "";        
		foreach($message as $key=>$mess)
		{
			if ($key !="attachment") $mailtemp .= $mess;
		}
		
		$cons = array();
		$postdata = array();
		$postdata['lType'] = 'message';

		$postdata['message_subject'] =  phpfox::getUserBy('user_name');
		$postdata['message_body'] = $mailtemp;
		$params = "lType=message";
		$i=0;
		foreach ($contacts as $key =>$name)
		{
			$params.="&$i=$key";
			$i++;
		}
		$params .="&message_body=".htmlspecialchars($mailtemp);
		$params .="&message_subject=".phpfox::getUserBy('user_name');
		$params .="&oauth_tok3n=". $_SESSION['token'];
		$params .="&oauth_token_secret=". $_SESSION['secret_token'];    
		$ch = curl_init("http://openid.younetid.com/auth/contact.php");
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
		curl_setopt($ch, CURLOPT_HEADER ,1);  // DO NOT RETURN HTTP HEADERS 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$Rec_Data = curl_exec($ch);       
	}

	public function Authorized($res = array())
	{
		$OBJ_linkedin = new linkedin_API();       
		$response = $OBJ_linkedin->token_access($res['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $res['oauth_verifier']);
		if ($response['success'] === true) 
		{
			// the request went through without an error, gather user's 'access' tokens
			$_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
			// set the user as authorized for future quick reference
			$_SESSION['oauth']['linkedin']['authorized'] = true;
		}      
	}

	public function getLinkedInContacts()
	{
		$OBJ_linkedin = new linkedin_API();
		$OBJ_linkedin->set_token_access($_SESSION['oauth']['linkedin']['access']);
		$response = $OBJ_linkedin->connections();         
		$connections = new SimpleXMLElement($response['linkedin']);          
		return $connections;
	}

	public function get($iUser, $iPage, $iPageSize)
	{
		$iCnt = $this->database()->select("COUNT(*)")
			->from(Phpfox::getT('invite'), 'i')
			->where('i.user_id = ' . (int) $iUser)
			->execute('getSlaveField');

		$aInvites = $this->database()->select('*')
			->from(Phpfox::getT('invite'))
			->where('user_id = ' . (int) $iUser)
			->order('invite_id DESC')
			->limit($iPage, $iPageSize, $iCnt)
			->execute('getSlaveRows');

		$iTotal = ($iPage > 1 ? (($iPageSize * $iPage) - $iPageSize) : 0);
		foreach ($aInvites as $iKey => $aPost)
		{
			$iTotal++;
			$aInvites[$iKey]['count'] = $iTotal;
		}
		return array($iCnt, $aInvites);
	}

	public function getMaxInvitation()
	{				
		$iGroupId = Phpfox::getLib('phpfox.database')->select('user_group_id')
			->from(Phpfox::getT('user'))
			->where('user_id = ' . Phpfox::getUserId())
			->execute('getSlaveField');			
		$iMax = Phpfox::getLib('phpfox.database')->select('number_invitation')
			->from(Phpfox::getT('contactimporter_max_invitations'), 'm')
			->where('m.id_user_group = ' . $iGroupId)
			->execute('getSlaveField');		
		if (!$iMax) return 60;
		return $iMax;
	}

	public function getStatistics()
	{
		$aStatistics = phpfox::getLib('phpfox.database')->select('*')
			->from(phpfox::getT('contactimporter_statistics'))
			->where('user_id = ' . phpfox::getUserId())
			->execute('getRow');		
		return $aStatistics;
	}
	
	public function getIconSize()
	{
		$sCacheId = $this->cache()->set('contactimporter_setting_icon_size');
		if (!($icon_size = $this->cache()->get($sCacheId, 60*60)))
		{			
			$icon_size = Phpfox::getLib('database')->select('param_values')
				->from(Phpfox::getT('contactimporter_settings'))
				->where('settings_type="icon_size"')
				->execute('getRow');  
			$icon_size = isset($icon_size['param_values']) && $icon_size['param_values'] ? $icon_size['param_values'] : 30;
			$this->cache()->save($sCacheId, $icon_size);
		}
		return $icon_size;
	}
	
	public function getTopProviders()
	{	
		$sCacheId = $this->cache()->set('contactimporter_providers');
		if (!($providers = $this->cache()->get($sCacheId, 60*60)))
		{		
			$number_provider_display = phpfox::getLib('database')->select('param_values')
				->from(phpfox::getT('contactimporter_settings'))
				->where('settings_type="number_provider_display"')
				->execute('getRow');			
			$number_limit = isset($number_provider_display['param_values']) && $number_provider_display['param_values'] >= 0 ? $number_provider_display['param_values']  : 100;  
			if ($number_limit == 0) return array();			
			$providers = Phpfox::getLib('phpfox.database')->select('*')
				->from(Phpfox::getT('contactimporter_providers'))
				->where('enable = 1')
				->order('order_providers ASC')				
				->execute('getSlaveRows');
			$providers = $this->allowProvider($providers);
			$providers = array_slice($providers, 0, $number_limit);
			$this->cache()->save($sCacheId, $providers);
		}
		return $providers;
	}
	
	public function getProvidersEnable()
	{
		$providers = Phpfox::getLib('phpfox.database')->select('*')
			->from(Phpfox::getT('contactimporter_providers'))
			->where('enable = 1')
			->execute('getRows');
		$providers = $this->allowProvider($providers);
		return $providers;
	}
	
	public function removeCache()
	{
		$this->cache()->remove('contactimporter_setting_icon_size');
		$this->cache()->remove('contactimporter_providers');
	}
	
	public function getProviders($aConds = array())
	{		
		$con = array();
		foreach ($aConds as $c)
		{
			if (strpos($c,'LIKE'))
			{
				if (!strpos($c,'All')&& $c !='2')
				{
					$c = str_replace('disable','0',$c);
					$c = str_replace('enable','1',$c);
					$c = str_replace('active','enable',$c);
					if ( count($con) ==0)
						$con[] = $c;
					else
						$con[] = ' AND '. $c;
				}
			}
		}

		(($sPlugin = Phpfox_Plugin::get('contactimporter.component_service_contactimporter_getProviders__start')) ? eval($sPlugin) : false);
		
		//Phpfox::getLib('phpfox.database')->update(Phpfox::getT('contactimporter_providers'), array('enable' => 1), 'name IN ("hi5","aol","mycatspace","koolro")');
		
		$providers = Phpfox::getLib('phpfox.database')->select('*')
			->from(Phpfox::getT('contactimporter_providers'),'cp')
			->where($con)
			->order('cp.order_providers ASC')
			->execute('getSlaveRows');	
		
		$providers = $this->allowProvider($providers);

		(($sPlugin = Phpfox_Plugin::get('contactimporter.component_service_contactimporter_getProviders__end')) ? eval($sPlugin) : false);
		return $providers;
	}
	
	function validateEmail($email)
	{
		$pattern = "/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/";
		return (bool) preg_match($pattern, $email);
	}   

	function endsWith($FullStr, $EndStr)
	{
		// Get the length of the end string
		$StrLen = strlen($EndStr);
		// Look at the end of FullStr for the substring the size of EndStr
		$FullStrEnd = substr($FullStr, strlen($FullStr) - $StrLen);
		// If it matches, it does end with EndStr
		return $FullStrEnd == $EndStr;
	}

    public function getContactsFromCSVFile($user)
    {
		$contacts = array();
		$friends = array();
		$is_error = 0;
		$message = '';
		$ci_contacts = array();
		if ( !Phpfox::isUser() || $user != Phpfox::getUserId() )
		{
			$message = 'You are not owner the upload file';
			$is_error = 1;
		}
		else
        {
            require_once 'VcardReader.php';
            // list the permitted file type
			$permit_file_types = array(
				'text/csv' => 'csv',
				'text/x-csv' => 'csv',
				'text/comma-separated-values' => 'csv',
				'application/csv' => 'csv',
				'application/excel' => 'csv',
				'application/vnd.ms-excel' => 'csv',
				'application/vnd.msexcel' => 'csv',
				'text/anytext' => 'csv',
				'text/x-vcard' => 'vcf',
				'application/vcard' => 'vcf',
				'text/anytext' => 'vcf',
				'text/directory' => 'vcf',
				'text/x-vcalendar' => 'vcf',
				'application/x-versit' => 'vcf',
				'text/x-versit' => 'vcf',
				'application/octet-stream'=>'ldif',
			);

            for(;;) 
			{
				$uploaded_file = $_FILES['csvfile']['tmp_name'];
				$filetype = $_FILES['csvfile']["type"];

				$filename = $_FILES['csvfile']['name'];		
				// Check file types
				if (!array_key_exists($filetype, $permit_file_types))
				{
					$is_error = 1;
					$message = "Invalid file type!";
					break;
				}

				if(is_uploaded_file($uploaded_file))
				{
					$fh = fopen($uploaded_file, "r");                        
					if ($this->EndsWith(mb_strtolower($filename), 'csv'))
					{
						// Process CSV file type
						$i = 0;
						$row = fgetcsv($fh, 1024, ',');
						$first_name_pos = -1;
						$email_pos = -1;
						$first_display_name = -1;
						$count = count($row);

						for ($i = 0; $i < $count; $i = $i + 1)
						{
							if ($row[$i] == "E-mail Display Name" || $row[$i]=="First" || $row[$i]=="First Name")
							{
								$first_name_pos = $i;
							}
							elseif ($row[$i] == "E-mail Address" || $row[$i]=="Email" || $row[$i] == "E-mail Address")
							{
								$email_pos = $i;
							}
							elseif($row[$i] == "First Name" || $row[$i]=="First")//yahoo format oulook
							{
								$first_display_name = $i; 
							}
							else
							{
								// do nothing
							}
						}

						if (($email_pos == -1) || ($first_name_pos == -1))
						{
							$is_error = 1;
							$message = "Invalid file format!";
							break;
						}
						else
						{
							if ($first_display_name ==-1) $first_display_name = $first_name_pos;
						}

						while( ($row = fgetcsv($fh, 1024, ',')) != false )
						{
							if(isset($row[$email_pos]) && !empty($row[$email_pos]))
							{
								$contacts[] = array(
									'email' => $row[$email_pos],
									'name' => empty($row[$first_name_pos])?$row[$first_display_name]:$row[$first_name_pos]
								);
							}                                
						}
						fclose($fh);						
                    }
                    elseif ($this->EndsWith(mb_strtolower($filename), 'vcf'))
					{
						// Process VCF file type                             
						$file_size = filesize($uploaded_file);
						if ($file_size == 0)
						{
							$is_error = 1;
							$message = 'Empty file!';
							break;
						}

						$vcf = fread($fh, filesize($uploaded_file));
						fclose($fh);
						$vCard = new VCardTokenizer($vcf);

						$contacts = array();
						$result = $vCard->next();
						$contact = array();

						while($result)
						{
							if(mb_strtolower($result->name) == 'email')
							{
								$contact['email'] = $result->getStringValue();
							}
							elseif(mb_strtolower($result->name) == 'n')
							{

								$name = $result->getStringValue();
								$parts = explode(";", $name, 2);
								if($parts[1] == '')
								{
									$contact['first_name'] = $parts[0];
									$contact['name'] = $contact['first_name'];
								}
								else
								{
									$contact['last_name'] = $parts[0];
									$contact['first_name'] = $parts[1];

									$contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];
								}
							}
							else if(mb_strtolower($result->name) == 'org')
							{
								$contact['company'] = $result->getStringValue();
							}
							elseif(mb_strtolower($result->name) == 'title')
							{
								$contact['position'] = $result->getStringValue();
							}
							$result = $vCard->next();
						}

						if ((!isset($contact['email'])) || (!isset($contact['name'])))
						{
							$is_error = 1;
							$message = "Invalid file format!";
							break;
						}

						if(isset($contact['email']))
						{                                
							if($this->validateEmail($contact['email']))
							{
								$contacts[] = array('email' => $contact['email'], 'name' => $contact['name']);
							}
							else
							{                                    
								$is_error = 0;
								$message = "There's some error in your contact file";
							}
						}
					}
                    elseif($this->EndsWith(mb_strtolower($filename), 'ldif'))//thunderbirth
                    {                            
						$thunder_data = fread($fh, filesize($uploaded_file));
						$rows = explode(PHP_EOL,$thunder_data);
						$name = "";
						$email ="";
						$contacts = array();

						foreach($rows as $index=>$row)
						{
							try
							{
								@list($key,$data) = @explode(':',$row);
								if($key == 'cn')
									$name = $data;
								if($key =='mail')
									$email = trim($data);

								if ($name != "" && $email!="")
								{
									$contacts[] = array('email' => $email, 'name' => $name);
									$name = "";
									$email ="";
								}
							}
							catch(Exception $ex)
							{
							}                               
						}
					}
					else
					{                         
						$is_error = 1;
						$message = "Unknown file type!";
					}
				}

				if(empty($contacts)) 
				{
					$is_error = 1;
					$message = "There is no contact in your address book";
					break;
				}

				foreach ($contacts as $value)
				{
					$ci_contacts["{$value["email"]}"] = $value["name"];
				}
				break;
			}
		}
		$returns['contacts'] = $ci_contacts;
		$returns['is_error'] = $is_error;
		$returns['error_message'] = $message;          
		return $returns;
	}

	public function addContactImporter($aVals)
	{
		$sqlInsert = "insert IGNORE  into ".phpfox::getT('contactimporter')."(contactimporter_id,user_id,provider,contactimporter_user_id,time_stamp) values (null,".$aVals['user_id'].","."'".$aVals['provider']."','".$aVals['contactimporter_user_id']."',".$aVals['time_stamp'].")";
		$insert = phpfox::getLib('database')->query($sqlInsert);
	}

	public function addUnsubscribe($aVals)
	{
		$sqlInsert = "insert IGNORE  into ".phpfox::getT('contactimporter_unsubscribe')."(`unsubscribe_id`,`email`,`time_stamp`) values (null,'".$aVals['email']."','".$aVals['time_stamp']."')";
		$insert = phpfox::getLib('database')->query($sqlInsert);
	}

	public function getEmailUnsubscribe()
	{
		$aEmails = $this->database()->select('email')
		->from(phpfox::getT('contactimporter_unsubscribe'), 'e')
		->where(1)
		->execute('getRows');
		$emails = array();
		foreach ($aEmails as $key => $value) 
		{
			$emails[$key] = $value['email'];
		}     
		return $emails;
	}


	public function getUserInvite($iPage = 0, $iLimit = 0)
	{
		$aCond = array();
		$email_invited = $this->database()->select('email')
			->from(phpfox::getT('user'), 'u')
			->where('u.user_id='.phpfox::getUserId())
			->execute('getSlaveField');
		$aCond[] = "inv.email = '" . $email_invited ."'";

		$aRows = $this->database()->select('DISTINCT u.*')
			->from(phpfox::getT('user'), 'u')
			->join(phpfox::getT('invite'),'inv','u.user_id = inv.user_id')
			->where($aCond)
			->execute('getSlaveRows');
		$iCnt = count($aRows);
		return array($iCnt, $aRows);
	}

	public function subscribe($email)
	{
		$this->database()->delete(phpfox::getT('contactimporter_unsubscribe'), "email ='".$email."'");
		$aRow = $this->database()->select('email')
			->from(phpfox::getT('contactimporter_unsubscribe'))
			->where("email ='" . $email."'")
			->execute('getRow');

		if(count($aRow) > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
		return false;
	}
	
	public function getUsersInvite($email_invited)
	{
		$aCond = array();
		$aCond[] = "inv.email = '" . $email_invited ."'";
		$aRows = $this->database()->select('DISTINCT u.*')
			->from(phpfox::getT('user'), 'u')
			->join(phpfox::getT('invite'),'inv','u.user_id = inv.user_id')
			->where($aCond)
			->execute('getSlaveRows');
		$iCnt = count($aRows);
		return array($iCnt, $aRows);
	}

	public function getContactsYahoo($aYahooContacts)
	{
		$contacts = array(); 
		if(!$aYahooContacts || count($aYahooContacts)<=0)
		{
			return $contacts;
		}
		foreach($aYahooContacts as $key=>$aContact)
		{
			$contacts[$key]['name'] = $aContact->name ;
			$contacts[$key]['email'] = $aContact->email ;
		}
		$aMails = array();

		foreach ($contacts as $key=>$aContact)
		{
			$aMails[]= $aContact['email'];
		}

		list($aMails, $aInvalid, $aCacheUsers) = Phpfox::getService('invite')->getValid($aMails, Phpfox::getUserId());

		if (count($aMails) > 0 )
		{
			$invite_list = array();
			$in_lst = '';
			foreach ($contacts as $key=>$aContact)
			{
				$email = $aContact['email'];
				$name = $aContact['name'];
				if (in_array($email,$aMails))
				{
					$invite_list[$email] =strlen($name)>40?substr($name,0,40).'...':$name;
					$in_lst .=','.$email;
				}
			}
			foreach ($invite_list as $email => $name) 
			{
				$char = strtoupper(substr($email, 0,1));
				if(is_numeric($char))
				{
					$invite_list_sort['Z'][] = array('email'=>$email,'name'=>$name);
				}
				else
				{
					$invite_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($invite_c == $start)
						{
							$invite_list_sort[chr($start)][] = array('email'=>$email,'name'=>$name);
							break;
						}
						else
						{
							if(!isset($invite_list_sort[chr($start)])) $invite_list_sort[chr($start)] = array();
						}
					}
				}
			}
			for($start = ord('A'); $start <= ord('Z');$start++)
			{
				if(!isset($invite_list_sort[chr($start)])) $invite_list_sort[chr($start)] = array();
			}
			arsort($invite_list);
			ksort($invite_list_sort);
			$invite_list = array_reverse($invite_list);
			$provider_box ="yahoo";
			if(count($invite_list_sort > 0))
			{
				foreach($invite_list_sort as $key => $contacts)
				{
					foreach ($contacts as $contact)
					{
						$aInsertContacts = array(
							'user_id' => phpfox::getUserId(),
							'provider'=> $provider_box,
							'contactimporter_user_id' => $contact['email'],
							'time_stamp' => PHPFOX_TIME
						);
						phpfox::getService('contactimporter')->addContactImporter($aInsertContacts);
					}
				}
			}
		}
		return array($invite_list_sort,$aMails, $aInvalid, $aCacheUsers);
	}

	public function getContactsHotmail($aContacts)
	{
		$contacts = array(); 
		if (!$aContacts || count($aContacts)<=0)
		{
			return $contacts;
		}
		foreach ($aContacts as $key => $aContact)
		{
			$contacts[$key]['name'] = $aContact->name;
			$contacts[$key]['email'] = $aContact->email;
		}
		
		$aMails = array();
		foreach ($contacts as $key=>$aContact)
		{
			$aMails[]= $aContact['email'];
		}

		list($aMails, $aInvalid, $aCacheUsers) = Phpfox::getService('invite')->getValid($aMails, Phpfox::getUserId());
		if (count($aMails) > 0 )
		{
			$invite_list = array();
			$in_lst = '';
			foreach ($contacts as $key=>$aContact)
			{
				$email = $aContact['email'];
				$name = $aContact['name'];
				if (in_array($email,$aMails))
				{
					$invite_list[$email] = strlen($name) > 40 ? substr($name, 0, 40) . '...' : $name;
					$in_lst .=','.$email;
				}
			}
			foreach ($invite_list as $email => $name) 
			{
				$char = strtoupper(substr($email, 0,1));
				if(is_numeric($char))
				{
					$invite_list_sort['Z'][] = array('email'=>$email,'name'=>$name);
				}
				else
				{
					$invite_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($invite_c == $start)
						{
							$invite_list_sort[chr($start)][] = array('email'=>$email,'name'=>$name);
							break;
						}
						else
						{
							if(!isset($invite_list_sort[chr($start)])) $invite_list_sort[chr($start)] = array();
						}
					}
				}
			}
			for($start = ord('A'); $start <= ord('Z');$start++)
			{
				if(!isset($invite_list_sort[chr($start)])) $invite_list_sort[chr($start)] = array();
			}
			arsort($invite_list);
			ksort($invite_list_sort);
			$invite_list = array_reverse($invite_list);
			$provider_box = "hotmail";
			if (count($invite_list_sort > 0))
			{
				foreach($invite_list_sort as $key => $contacts)
				{
					foreach ($contacts as $contact)
					{
						$aInsertContacts = array(
							'user_id' => phpfox::getUserId(),
							'provider'=> $provider_box,
							'contactimporter_user_id' => $contact['email'],
							'time_stamp' => PHPFOX_TIME
						);
						phpfox::getService('contactimporter')->addContactImporter($aInsertContacts);
					}
				}
			}
		}
		return array($invite_list_sort, $aMails, $aInvalid, $aCacheUsers);
	}	
	
	public function displayContacts($contacts)
	{
		$contact_list = array();
		foreach ($contacts as $key=>$email)
		{                                           
			if(is_array($email))
			{                                             
				$char = strtoupper(substr($email['name'], 0,1));
				if(is_numeric($char))
				{
					$contact_list['Z'][] = array('key'=>$key,'name'=>$email['name'],'pic'=>$email['pic']);
				}
				else
				{
					$social_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($social_c == $start)
						{
							if (is_array($email))
							{                                                                  
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email['name'],'pic'=>$email['pic']);
								break;
							}
							else
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>'');
								break;
							}
						}
						else
						{
							if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
						}
					}
				}                                                
			}
			else
			{
				$char = strtoupper(substr($email, 0,1));
				if(is_numeric($char))
				{
					$contact_list['Z'][] = array('key'=>$key,'name'=>$email,'pic'=>$email['pic']);
				}
				else 
				{
					$social_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($social_c == $start)
						{
							if (is_array($email))
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>$email['pic']);
								break;
							}
							else
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>'');
								break;
							}
						}
						else
						{
							if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
						}
					}
				} 
			}                                           
		}                            
		for($start = ord('A'); $start <= ord('Z');$start++)
		{
			if(!isset($contact_list[chr($start)]))
				$contact_list[chr($start)] = array();
		}
		ksort($contact_list);            
		return $contact_list;
	}

	public function getContactsMyspace($aMyspaceContacts)
	{
		$contacts = array();
		foreach($aMyspaceContacts as $key=>$aContact)
		{
			$contacts[$key]['name'] = $aContact->name ;
			$contacts[$key]['pic'] = $aContact->pic ;
		}     
		$contact_list = array();
		foreach ($contacts as $key=>$email)
		{
			if(is_array($email))
			{
				$char = strtoupper(substr($email['name'], 0,1));
				if(is_numeric($char))
				{
					$contact_list['Z'][] = array('key'=>$key,'name'=>$email['name'],'pic'=>$email['pic']);
				}
				else
				{
					$social_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($social_c == $start)
						{
							if (is_array($email))
							{                                                                  
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email['name'],'pic'=>$email['pic']);
								break;
							}
							else
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>'');
								break;
							}
						}
						else
						{
							if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
						}
					}
				}
			}
			else
			{
				$char = strtoupper(substr($email, 0,1));
				if(is_numeric($char))
				{
					$contact_list['Z'][] = array('key'=>$key,'name'=>$email,'pic'=>$email['pic']);
				}
				else 
				{
					$social_c = ord($char);
					for($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($social_c == $start)
						{
							if (is_array($email))
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>$email['pic']);
								break;
							}
							else
							{
								$contact_list[chr($start)][] = array('key'=>$key,'name'=>$email,'pic'=>'');
								break;
							}
						}
						else
						{
							if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
						}
					}
				}
			}
		}
		for($start = ord('A'); $start <= ord('Z');$start++)
		{
			if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
		}
		ksort($contact_list);        
		return $contact_list;
	}

	public function displayEmailContacts($contacts)
	{      
		$aMails = array();
		foreach ($contacts as $email=>$name)
		{
			$aMails[]=$email;
		}      
		Phpfox_Error::skip(true);
		list($aMails, $aInvalid, $aCacheUsers) = Phpfox::getService('invite')->getValid($aMails, Phpfox::getUserId());
		$invite_list = array();
		$in_lst = '';
		foreach ($contacts as $email=>$name) 
		{
			if (in_array($email,$aMails))
			{
				$char = strtoupper(substr($email, 0,1));
				if (is_numeric($char))
				{
					$invite_list_sort[chr($start)][] = array('email'=>$email,'name'=>$name);
				}
				else
				{
					$invite_c = ord($char);
					for ($start = ord('A'); $start <= ord('Z');$start++)
					{
						if($invite_c == $start)
						{
							if(!empty($name))
							{
								$invite_list_sort[chr($start)][] = array('email'=>$email,'name'=>$name);
								$in_lst .=','.$email;
								break;
							}
							else
							{
								$invite_list_sort[chr($start)][] = array('email'=>$email,'name'=>$email);
								$in_lst .=','.$email;
								break;
							}
						}
						else
						{
							if (!isset($invite_list_sort[chr($start)])) $invite_list_sort[chr($start)] = array();
						}
					}
				}
			}
		}

		for($start = ord('A'); $start <= ord('Z');$start++)
		{       if(!isset($invite_list_sort[chr($start)]))
				$invite_list_sort[chr($start)] = array();
		}
		ksort($invite_list_sort);		        
		return array($invite_list_sort,$aMails, $aInvalid, $aCacheUsers);
	}

	public function updateOrderProviders($orderProviders,$name)
	{
		$this->database()->update(phpfox::getT('contactimporter_providers'),array('order_providers'=>$orderProviders),"name='".$name."'");
		phpfox::getService('contactimporter')->removeCache();
	}
}
?>