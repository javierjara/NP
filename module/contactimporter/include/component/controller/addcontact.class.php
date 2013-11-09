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
if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'openinviter'.PHPFOX_DS.'openinviter.php'))
{
    require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'openinviter'.PHPFOX_DS.'openinviter.php');
}
?>
<?php 
class contactimporter_Component_Controller_Addcontact extends Phpfox_Component
{
	public function process()
	{		 
		if (!Phpfox::isUser())
		{
			return Phpfox_Error::display(Phpfox::getPhrase('contactimporter.need_to_be_logged_in'));

		}
        $this->template()->assign(array(
			'contactimporter_link' => phpfox::getLib('url')->makeUrl('contactimporter'),
			'homepage' => phpfox::getParam('core.path'),
		));
     
		$errors = array();
		$max_invitation = Phpfox::getService('contactimporter')->getMaxInvitation();
		$request = $this->request();               
		$oi_session_id = $request->get('oi_session_id');
		$is_linkedAPI = $request->get('is_linkedAPI');
		$provider = $request->get('provider_box');
		
        /**Quick fix for fb**/
        if(isset($_POST) &&  $provider == 'facebook')
        {   
			phpfox_error::skip(true);     
            $provider = $request->get('provider_box');            
            if(isset($provider) && $provider == 'facebook')
            {
                $selected_contacts = $request->get('contacts');
				$selected_contacts = explode(',', $selected_contacts);
				$selected_contacts = array_slice($selected_contacts, 0, $max_invitation - 1);
				/*
				$selected_contacts=array();                 
				$aVals = $request->get('val');
                foreach ($aVals as $key => $val)
                {                    
                    if (strpos($key,'check_')!==false)
                    {
                        $selected_contacts[$aVals['email_'.$val]]=$aVals['name_'.$val];                                                                    
                        $max_invitation--;
                        if ($max_invitation < 1) break;
                    }
                    elseif (strpos($key,'email_')!==false)
                    {
                        $temp=explode('_',$key);
                        $counter=$temp[1];
                        if (is_numeric($temp[1]))
                        $contacts[$val]=$aVals['name_'.$temp[1]];
                    }
                }
				*/ 				
                if (!empty($selected_contacts))
                {
                    $mess = $request->get('message');
                    if (phpfox::getUserParam('contactimporter.hide_the_custom_invittation_message') == true)
                    {
                        $mess = phpfox::getPhrase('contactimporter.default_invite_message_text');
                    }
                    $iInvite = Phpfox::getService('invite.process')->addInvite(Phpfox::getUserBy('email'), Phpfox::getUserId());  
                    $linkInvite = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));
                    $fb_f_c = phpfox::getService('contactimporter');
                    $facebook = $fb_f_c->initFB();
                    if ($fb_f_c->verifyFB())
                    {
						if (!is_array($selected_contacts)) $selected_contacts = array($selected_contacts); 
						$contacts = array();						
						for ($i = 0; $i < count($selected_contacts); $i++)
						{
							$contacts[$selected_contacts[$i]] = $selected_contacts[$i]; 
						}
						$fb_f_c->sendInvitationFB($contacts, $mess, $linkInvite);    
                    }
                }
                phpfox::getService('contactimporter')->updateStatistic(phpfox::getUserId(),0,count($selected_contacts));
            }       
            $this->template()->assign(array( 'errors'=>array()));
            return;
        }		
		/**End**/
		
		if ($oi_session_id !=0 || $is_linkedAPI == 'is_linkedAPI')
		{
            $max_invitation = 40;
			$task = $request->get('task');
			if (isset($task)&& $task=='do_add')
			{
                $mess = $request->get('message');
			    $selected_contacts = $request->get('contacts');
				$selected_contacts = explode(',', $selected_contacts);
				$selected_contacts = array_slice($selected_contacts, 0, $max_invitation - 1);
						
				/*
				$selected_contacts=array();
                $aVals = $request->get('val');                               
				foreach ($aVals as $key => $val)
				{					
					if (strpos($key,'check_')!==false)
					{
						$selected_contacts[$aVals['email_'.$val]]=$aVals['name_'.$val];                                                                    
						$max_invitation--;
						if ($max_invitation < 1) break;
					}
					elseif (strpos($key,'email_')!==false)
					{
						$temp=explode('_',$key);
						$counter=$temp[1];
						if (is_numeric($temp[1]))
						$contacts[$val]=$aVals['name_'.$temp[1]];
					}
				}			
                */
			
				if (!empty($selected_contacts))
				{
					if (!is_array($selected_contacts)) $selected_contacts = array($selected_contacts); 
					$contacts = array();						
					for ($i = 0; $i < count($selected_contacts); $i++)
					{
						$contacts[$selected_contacts[$i]] = $selected_contacts[$i]; 
					}
					$selected_contacts = $contacts;
					
					if ($is_linkedAPI == 'is_linkedAPI')
                    {
						$userId = Phpfox::getUserId();
                        $user = Phpfox::getLib('phpfox.database')->select('*')
							->from(Phpfox::getT('user'))
							->where('user_id = '.$userId)
							->execute('getRow');                        
                        $mail_settings = array (
							'displayname' => $user['full_name'],
							'message'=>$mess,
							'object_link' => 'http://' . $_SERVER['HTTP_HOST'] .'/invite/id_'.$userId .'/',
							'header'=>'',
							'footer'=>'',
							'sender_email' => $user['email'],
							'host' => $_SERVER['HTTP_HOST']
						);
                        $iInvite = Phpfox::getService('invite.process')->addInvite(Phpfox::getUserBy('email'), Phpfox::getUserId());  
                        $linkInvite = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));                      
                        $message = array('subject'=>$user['full_name'].Phpfox::getPhrase('contactimporter.is_inviting_you_to').$mail_settings['host'],'body'=>"\n\r ".Phpfox::getPhrase('contactimporter.is_inviting_you_to').$mail_settings['host']."\n\r ".Phpfox::getPhrase('contactimporter.to_join_please_follow_the_link')." \n\r".$linkInvite."\n\r ".Phpfox::getPhrase('contactimporter.message').": \n\r".$mess."\n\r",'attachment'=>"\n\r".Phpfox::getPhrase('contactimporter.attached_message').": \n\r".$mess); 
                        $responseLink = $request->get('responseLink');                     
                        if ($this->request()->get('is_and_YT')=="")
						{
                            phpfox::getService('contactimporter')->sendMessage($selected_contacts,$message,$responseLink);
                        }
						else
                        {
                            if ($this->request()->get('is_and_YT') == "is_and_TW")
                                phpfox::getService('contactimporter')->sendMessageTW($selected_contacts,$mess,$linkInvite); 
                            else
                                phpfox::getService('contactimporter')->sendMessageYT($selected_contacts,$message,$responseLink); 
                        }                     
                        phpfox::getService('contactimporter')->updateStatistic(phpfox::getUserId(),0,count($selected_contacts));
                    }
					else
					{
						$openinviter = new openinviter();
						$inPlugin = $openinviter->getPlugins(true);
						$provider_box = $request->get('provider_box');
						$openinviter->startPlugin($provider_box,false);
						$internal = $openinviter->getInternalError();	
						if ($internal)
						{
							$errors[] =$internal;
						} 
						else
						{
							$userId = Phpfox::getUserId();
							$user = Phpfox::getLib('phpfox.database')->select('*')
								->from(Phpfox::getT('user'))
								->where('user_id = '.$userId)
								->execute('getRow');						
							$mail_settings = array(
								'displayname' => $user['full_name'],
								'message'=>$mess,
								'object_link' => 'http://' . $_SERVER['HTTP_HOST'] .'/invite/id_'.$userId .'/',
								'header'=>'',
								'footer'=>'',
								'sender_email' => $user['email'],
								'host' => $_SERVER['HTTP_HOST']
							);                                                
							$iInvite = Phpfox::getService('invite.process')->addInvite(Phpfox::getUserBy('email'), Phpfox::getUserId());  
							$linkInvite = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));					
							$message = array('subject'=>$user['full_name'].Phpfox::getPhrase('contactimporter.is_inviting_you_to').$mail_settings['host'],'body'=>"\n\r ".Phpfox::getPhrase('contactimporter.is_inviting_you_to').$mail_settings['host']."\n\r ".Phpfox::getPhrase('contactimporter.to_join_please_follow_the_link')." \n\r".$linkInvite."\n\r ".Phpfox::getPhrase('contactimporter.message').": \n\r".$mess."\n\r",'attachment'=>"\n\r".Phpfox::getPhrase('contactimporter.attached_message').": \n\r".$mess); 
                            $sendMessage = $openinviter->sendMessage($oi_session_id, $message, $selected_contacts);
						}				    
						phpfox::getService('contactimporter')->updateStatistic(phpfox::getUserId(), 0, count($selected_contacts));
					}
				}
				else
				{
					$errors[]=Phpfox::getPhrase('contactimporter.you_haven_t_selected_any_contacts_to_invite').'!';
				}	
			}
		}
		else
		{
			$errors[]=Phpfox::getPhrase('contactimporter.you_haven_t_selected_any_contacts_to_invite')."!";
		}
		$this->template()->assign(array( 'errors'=>$errors ));
	}
} 
?>