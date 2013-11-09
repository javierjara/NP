<?php
$_pluginInfo=array(
	'name'=>'MySpace',
	'version'=>'1.1.1',
	'description'=>"Get the contacts from a MySpace account",
	'base_version'=>'1.8.0',
	'type'=>'social',
	'check_url'=>'http://www.myspace.com',
	'requirement'=>'email',
	'allowed_domains'=>false,
    'photo_import'=>true,
	);
/**
 * MySpace Plugin
 * 
 * Import user's contacts from MySpace and send 
 * messages using the internal messaging system
 * 
 * @author OpenInviter
 * @version 1.0.5
 */
class myspace extends openinviter_base
	{
	private $login_ok=false;
	public $showContacts=true;
	public $internalError=false;
	protected $timeout=30;
	protected $maxUsers=100;
	public $debug_array=array(
				'initial_get'=>'__VIEWSTATE',
				'login'=>'Compose',
				'get_url_friends'=>'presence=ONLINE',
				'url_friends'=>'txtFriendSearch',
                'login_ok'=>'signout'
				);
	
	/**
	 * Login function
	 * 
	 * Makes all the necessary requests to authenticate
	 * the current user to the server.
	 * 
	 * @param string $user The current user.
	 * @param string $pass The password for the current user.
	 * @return bool TRUE if the current user was authenticated successfully, FALSE otherwise.
	 */
	public function login_normal($user,$pass)
		{
		$this->resetDebugger();
		$this->service='myspace';
		$this->service_user=$user;
		$this->service_password=$pass;
		if (!$this->init()) return false;
		
		$res=$this->get("http://www.myspace.com/");
		if ($this->checkResponse("initial_get",$res))
			$this->updateDebugBuffer('initial_get',"http://www.myspace.com/",'GET');
		else
			{
			$this->updateDebugBuffer('initial_get',"http://www.myspace.com/",'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$form_action="http://secure.myspace.com/index.cfm?fuseaction=login.process";
		$post_elements=array('__VIEWSTATE'=>$this->getElementString($res,'id="__VIEWSTATE" value="','"'),
							 'NextPage'=>'',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_Email_Textbox'=>$user,
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_Password_Textbox'=>$pass,
							 'dlb'=>'Log In',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_SingleSignOnHash'=>'',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_SingleSignOnRequestUri'=>'',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_nexturl'=>'',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_apikey'=>'',
							 'ctl00_ctl00_cpMain_cpMain_LoginBox_ContainerPage'=>''							
							);
		$res=$this->post($form_action,$post_elements,true);		
		if ($this->checkResponse("get_url_friends",$res))
			$this->updateDebugBuffer('get_url_friends',$form_action,'POST',true,$post_elements);
		else
			{
			$this->updateDebugBuffer('get_url_friends',$form_action,'POST',false,$post_elements);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$url_friends="http://friends.myspace.com/index.cfm?fuseaction=user.viewfriends&friendID=".$this->getElementString($res,'"UserId":',',');
		$this->login_ok=$url_friends;
        $_SESSION['myspace_user_'.$this->session_id] = $user;
        $_SESSION['myspace_pass_'.$this->session_id] = $pass;
		return true;
		}

	/**
	 * Get the current user's contacts
	 * 
	 * Makes all the necesarry requests to import
	 * the current user's contacts
	 * 
	 * @return mixed The array if contacts if importing was successful, FALSE otherwise.
	 */	
	public function getMyContacts_normal()
		{
		if (!$this->login_ok)
			{
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		else $url=$this->login_ok;
		$res=$this->get($url,true);
		
		if ($this->checkResponse("url_friends",$res))
			$this->updateDebugBuffer('url_friends',$url,'GET');
		else
			{
			$this->updateDebugBuffer('url_friends',$url,'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		
		$contacts=array();
		$doc=new DOMDocument();libxml_use_internal_errors(true);if (!empty($res)) $doc->loadHTML($res);libxml_use_internal_errors(false);
        
			$xpath=new DOMXPath($doc);
            
            
            //GET PICS LIST
            $query="//img[@class='profilePic']";
            $data=$xpath->query($query);
            $pic = array();
            foreach ($data as $node)
                {$pic[] = $node->getAttribute('src');}
            
            
            $query="//a[@class='msProfileTextLink']";           
            $data=$xpath->query($query);
            $count = 1;
			foreach ($data as $node)
				{$contacts[str_replace('http://www.myspace.com/','',$node->getAttribute('href'))]=array('name' => (string)$node->nodeValue,'pic'=>$pic[$count++]);}

		return $contacts;
		}

	/**
	 * Send message to contacts
	 * 
	 * Sends a message to the contacts using
	 * the service's inernal messaging system
	 * 
	 * @param string $cookie_file The location of the cookies file for the current session
	 * @param string $message The message being sent to your contacts
	 * @param array $contacts An array of the contacts that will receive the message
	 * @return mixed FALSE on failure.
	 */
     
    public function login($user,$pass)
        {
        $this->resetDebugger();
        $this->service='myspace';
        $this->service_user=$user;
        $this->service_password=$pass;
        if (!$this->init()) return false;
        
        $res=$this->get("http://m.myspace.com/login.wap");
        if ($this->checkResponse("initial_get",$res))
            $this->updateDebugBuffer('initial_get',"http://m.myspace.com/login.wap",'GET');
        else
            {
            $this->updateDebugBuffer('initial_get',"http://m.myspace.com/login.wap",'GET',false);
            $this->debugRequest();
            $this->stopPlugin();
            return false;
            }
        $form_action="http://m.myspace.com/login.wap?sb=&jklaajkkjwioppznzknllkk=&c=en-US&bfd=offdeck&a=b";
        $post_elements=array('__VIEWSTATE'=>"",
                             'NextPage'=>'',
                             'emailTextBox'=>$user,
                             'passwordTextBox'=>$pass,
                             'loginCommand'=>'Log In'
                            );
        $res=$this->post($form_action,$post_elements,true); 
        if ($this->checkResponse("login_ok",$res))
            $this->updateDebugBuffer('login_ok',$form_action,'POST',true,$post_elements);
        else
            {
            $this->updateDebugBuffer('login_ok',$form_action,'POST',false,$post_elements);
            $this->debugRequest();
            $this->stopPlugin();
            return false;
            }
        $url_friends="http://m.myspace.com/friends/friendlist.wap?bfd=offdeck";
        $this->login_ok=$url_friends;
        return true;
        } 
        
        
/**
     * Get the current user's contacts
     * 
     * Makes all the necesarry requests to import
     * the current user's contacts
     * 
     * @return mixed The array if contacts if importing was successful, FALSE otherwise.
     */    
    public function getMyContacts()
        {
        if (!$this->login_ok)
            {
            $this->debugRequest();
            $this->stopPlugin();
            return false;
            }
        else $url=$this->login_ok;
        $res=$this->get($url,true);
        
        if ($this->checkResponse("url_friends",$res))
            $this->updateDebugBuffer('url_friends',$url,'GET');
        else
            {
            $this->updateDebugBuffer('url_friends',$url,'GET',false);
            $this->debugRequest();
            $this->stopPlugin();
            return false;
            }
        
        $contacts=array();
       
            
            
            //GET PICS LIST
          /*  $query="//img[@class='thumbnail']";
            $data=$xpath->query($query);
            $pic = array();
            foreach ($data as $node)
                {$pic[] = $node->getAttribute('src');}
            */
          $countUsers=0;
        do 
        {
             $doc=new DOMDocument();libxml_use_internal_errors(true);if (!empty($res)) $doc->loadHTML($res);libxml_use_internal_errors(false);        
            $xpath=new DOMXPath($doc);
            $nextPage=false;
            $query="//div[@class='listItem']";           
            $data=$xpath->query($query);
            $count = 1;
            foreach ($data as $node)
                { 
                    $img = @$node->getElementsByTagName('img')->item(0)->getAttribute('src');
                    $a = @$node->getElementsByTagName('a')->item(0);                  
                    $contacts[str_replace('/profile/profilehome.wap?bfd=offdeck&friendid=','',$a->getAttribute('href'))]=array('name' => (string)$a->nodeValue,'pic'=>$img);
                    $countUsers++;
                }
            $query="//div[@class='alternatingListItem']";           
            $data=$xpath->query($query);
            $count = 1;
            foreach ($data as $node)
                { 
                    $img = @$node->getElementsByTagName('img')->item(0)->getAttribute('src');
                    $a = @$node->getElementsByTagName('a')->item(0);                  
                    $contacts[str_replace('/profile/profilehome.wap?bfd=offdeck&friendid=','',$a->getAttribute('href'))]=array('name' => (string)$a->nodeValue,'pic'=>$img);
                    $countUsers++;
                }
                
            $query="//div[@class='thirdNav']/a";$data=$xpath->query($query);
            $nextPage = '';
            foreach($data as $node) { 
                $img = @$node->getElementsByTagName('img')->item(0)->getAttribute('src');
                
                if (strpos($img,'pagination_next'))
                { 
                    $nextPage=$node->getAttribute("href"); 
                    break;
                } 
            }   
            
            if ($countUsers>$this->maxUsers) break; 
            if (!empty($nextPage)) $res=$this->get("http://m.myspace.com".$nextPage);
        }while ($nextPage) ;   

        return $contacts;
        }        
	public function sendMessage($session_id,$message,$contacts)
		{
/*           if (!isset($_SESSION['myspace_user_'.$session_id])) return false;
        $user = $_SESSION['myspace_user_'.$session_id];
        $pass = $_SESSION['myspace_pass_'.$session_id];
        unset($_SESSION['myspace_user_'.$session_id]);
        unset($_SESSION['myspace_pass_'.$session_id]);
        $this->login_mobile($user,$pass);*/
		//$res=$this->get("http://m.myspace.com/messaging/createmessage.wap?bfd=offdeck&folderid=-1",true);
//		$mytokenvar=$this->getElementString($res,"MyToken=","')");
		$countMessages=0;
       
        
		foreach($contacts as $id=>$name)
			{
			$countMessages++;
			$url_messaging="http://m.myspace.com/messaging/createmessage.wap?friendid={$id}&bfd=offdeck&folderid=-1";
			$res=$this->get($url_messaging,true);
			$post_elements=array(
								 '__VIEWSTATE'=>$this->getElementString($res,'id="__VIEWSTATE" value="','"'),								
								 'subject'=>$message['subject'],
								 'fh'=>$this->getElementString($res,'name="fh" value="','"'),
								 'fb'=>$message['body'],
								 'ctl00$WapPageBody$sendCommand' => 'Send'
								);
			$res=$this->post($url_messaging,$post_elements,true);
			sleep($this->messageDelay);
			if ($countMessages>$this->maxMessages) {$this->debugRequest();$this->resetDebugger();$this->stopPlugin();break;}
			}	
		}

	/**
	 * Terminate session
	 * 
	 * Terminates the current user's session,
	 * debugs the request and reset's the internal 
	 * debudder.
	 * 
	 * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
	 */	
	public function logout()
		{
         if (isset($_SESSION['myspace_user_'.$this->getSessionID()])) 
         {
             unset($_SESSION['myspace_user_'.$this->getSessionID()]);
             unset($_SESSION['myspace_pass_'.$this->getSessionID()]);    
         }
        
        
		if (!$this->checkSession()) return false;
		$res=$this->get("http://www.myspace.com/index.cfm?fuseaction=signout",true);
		$this->debugRequest();
		$this->resetDebugger();
		$this->stopPlugin();
		return true;	
		}
	}	

?>