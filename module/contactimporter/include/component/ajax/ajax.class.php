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
class Contactimporter_Component_Ajax_Ajax extends Phpfox_Ajax
{	
    public function callLinkedIn()
    {
        Phpfox::isUser(true);        
        Phpfox::getBlock('contactimporter.linkedin', array()
        );
    }

    public function updateOrderProviders()
    {
        $providerSort=$_REQUEST['order'];
        $order = array();
        $providerSort = trim($providerSort);
        $order = split(' ',$providerSort);
        foreach($order as $key=>$value)
        {
            phpfox::getService('contactimporter')->updateOrderProviders($key,$value);
        }
      
    }

    public function updateProviderActive()
    {        
        $provider_name = $this->get('provider_name');
        $is_actived = (int)$this->get('is_actived');               
        if ($provider_name)
        {
			$is_actived = (int)(!$is_actived);
            Phpfox::getLib('phpfox.database')->update(Phpfox::getT('contactimporter_providers'), array('enable'=>$is_actived), 'name ="'.$provider_name.'"');
            Phpfox::getService('contactimporter')->removeCache();
			$str = $is_actived ? Phpfox::getPhrase('core.yes') : Phpfox::getPhrase('core.no');
			$this->html('#update_active_'.$provider_name, '<a href="javascript:updateprovideractive('."'".$provider_name."',".$is_actived.');">'.$str.'</a>');
        }
    }

    public function callYahoo()
    {
        Phpfox::isUser(true);
        Phpfox::getBlock('contactimporter.yahoo',array());
    }

	public function callHotmail()
    {
        Phpfox::isUser(true);
        Phpfox::getBlock('contactimporter.hotmail',array());
    }
	
    public function callImporterForm()
    {
        Phpfox::getBlock('contactimporter.importerform',array());
    }
    public function callTwitter()
    {
        Phpfox::isUser(true);    
        Phpfox::getBlock('contactimporter.twitter', array(           
            )
        );
    }
	public function reSendInvitation()
	{

		$message = Phpfox::getPhrase('contactimporter.default_invite_message_text');
		$iInvite = $this->get('invite_id');                
		$sMail = Phpfox::getLib('phpfox.database')->select('email')
			->from(Phpfox::getT('invite'),'invite')
			->where('invite.invite_id = '.$iInvite)
			->execute('getSlaveRow');                
			$sLink = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));
                $subcribe_message = "";
                $is_unsubcribe = phpfox::getLib('database')->select('param_values')
                                                                 ->from(phpfox::getT('contactimporter_settings'))
                                                                 ->where('settings_type="is_unsubcribed"')
                                                                 ->execute('getRow');
                if(isset($is_unsubcribe['param_values']) && $is_unsubcribe['param_values'])
                {
                  $encoded = PREG_REPLACE("'(.)'e","dechex(ord('\\1'))",$sMail['email']);
                  //$whyyouwereinvited = Phpfox::getParam('core.path').'contactimporter/whyyouwereinvited?id='. $encoded;
                  $whyyouwereinvited = phpfox::getLib('url')->makeURL('contactimporter/whyyouwereinvited');
                  $whyyouwereinvited .= '?id='. $encoded;
                  //$blockall = Phpfox::getParam('core.path').'contactimporter/blockallfurtheremailmessages?id='. $encoded;
                  $blockall = Phpfox::getLib('url')->makeURL('contactimporter/blockallfurtheremailmessages');
                  $blockall .= '?id='. $encoded;
                 $subcribe_message  = '<a target="_blank" href="'.$whyyouwereinvited.'">'.Phpfox::getPhrase('contactimporter.find_out_why_you_were_invited_by_clicking_here').'</a><br /><a target="_blank" href="'.$blockall.'">'.Phpfox::getPhrase('contactimporter.block_all_further_email_mesages').'</a>';
                }
                $unsubscribeEmail = phpfox::getService('contactimporter')->getEmailUnsubscribe();              
                if(!in_array($sMail['email'], $unsubscribeEmail))
                {

                      $bSent = Phpfox::getLib('mail')->to($sMail['email'])
                        //->fromEmail(Phpfox::getUserBy('email'))
                        //->fromName(Phpfox::getUserBy('full_name'))
                        ->subject(array('invite.full_name_invites_you_to_site_title', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title'))))
                        ->message(array('invite.full_name_invites_you_to_site_title_link', array('full_name' => Phpfox::getUserBy('full_name'), 'site_title' => Phpfox::getParam('core.site_title').'<br/>'.$message.'<br/>'.$subcribe_message,'link' => $sLink)))
                        ->send();
            
		if ($bSent)
            //echo 'The invitation message was resent to '.$sMail['email'] .' successfullly.';
			echo Phpfox::getPhrase('contactimporter.the_invitation_message_was_resent_successfully');
		else
            //echo 'The invitaion message was not resent to '.$sMail['email'] .'.';
			echo Phpfox::getPhrase('contactimporter.the_invitaion_message_was_not_resent');
                }
                else
                {
                    //echo 'The invitaion was added in the unsubscribe. Please do not send any to  '.$sMail['email'] .'.';
                    echo Phpfox::getPhrase('contactimporter.the_invitation_was_added_in_the_unsubscribe_please_do_not_send_anything_else');
                }		
	}
        
        public function subscribe()
        {
            $email = $this->get('email');          
            $del = phpfox::getService('contactimporter')->subscribe($email);            
            if($del)
            {
                //$this->setMessage('Email is subscribed successfullly.');
                echo Phpfox::getPhrase('contactimporter.email_is_subscribed_successfullly');
            }
            else
            {
                //$this->setMessage('Email did not subscribe.');
                echo Phpfox::getPhrase('contactimporter.email_did_not_subscribe');
            }
        }

}
?>