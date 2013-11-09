<?php
/*
 * @copyright        [YouNet_COPYRIGHT]
 * @author           YouNet Company
 * @package          Module_Contactimporter
 * @version          2.06
 *
 */
defined('PHPFOX') or exit('NO DICE!');
if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'openinviter'.PHPFOX_DS.'openinviter.php'))
{
    require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'openinviter'.PHPFOX_DS.'openinviter.php');
}
?>
<?php
class contactimporter_Component_Controller_Index extends Phpfox_Component
{
   	public function process()
	{
		if (!Phpfox::isUser())
		{
			$this->url()->send('login',null,Phpfox::getPhrase('contactimporter.need_to_be_logged_in_for_getting_the_contact_importer_feature'));
		}
        $this->template()->assign(array(
			'sSecurityToken'=>Phpfox::getService('log.session')->getToken(),
			'contactimporter_link' => phpfox::getLib('url')->makeUrl('contactimporter'),
			'homepage' => phpfox::getParam('core.path'),
		));

		$max_invitation = Phpfox::getService('contactimporter')->getMaxInvitation();
		$this->setParam('max_invitation', $max_invitation);
		$this->template()->assign(array('max_invitation'=>$max_invitation));
		$aHotmailContacts = isset($_REQUEST['hotmail_contact']) ? json_decode(urldecode($_REQUEST['hotmail_contact'])) : null;
		if ($aHotmailContacts)
		{
			$aHotmail = Phpfox::getService('contactimporter')->getContactsHotmail($aHotmailContacts);
			if (!empty($aHotmail[0]))
			{
				$errors = '';
				$step = "get_invite";
				$this->template()->assign(array(
					'step' => $step,
					'invite_list_sorts' => $aHotmail[0],
					'aValid' => $aHotmail[1],
					'errors' => $errors,
					'aInValid' => $aHotmail[2],
					'aUsers' => $aHotmail[3],
					'plugType' => 'email',
					'tokenName' => Phpfox::getTokenName(),
					'tokenPhpFoxValue' => Phpfox::getService('log.session')->getToken() ,
					'oi_session_id' => uniqid(),
					'core_url' =>phpfox::getParam('core.path'),
					'sIniviteLink' => Phpfox::getLib('url')->makeUrl('contactimporter.inviteuser', array('id' => Phpfox::getUserId())),
                ));
				$this->template()->setHeader(array(
					'jquery.scrollTo-min.js'=>'module_contactimporter',
					'jquery.localscroll-min.js'=>'module_contactimporter',
					'init.js'=>'module_contactimporter',
                ));
				return;
			}
			else
			{
				$this->url()->send('contactimporter.invitations', null, Phpfox::getPhrase('invite.your_friends_have_successfully_been_invited'));
			}
		}
		elseif (isset($_REQUEST['get_success']) && $_REQUEST['get_success'] == 1)
		{
			$errors['contacts'] = Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
            $this->template()->assign(array('plugType'=>'email','provider_type' => 'hotmail','errors' => $errors));
		}

		$aYahooContacts = isset($_REQUEST['contact'])?json_decode(urldecode($_REQUEST['contact'])):null;
		if (isset($aYahooContacts[0]->errors) !='')
		{
            $errors['contacts'] = $aYahooContacts[0]->errors;
            $this->template()->assign(array('plugType'=>'email','provider_type' => 'yahoo','errors' => $errors));
		}
		else
		{
			$aYahoo = Phpfox::getService('contactimporter')->getContactsYahoo($aYahooContacts);
			if(!empty($aYahoo[0]))
			{
				$errors = '';
				$step = "get_invite";
				$this->template()->assign(array(
					'step' => $step,
					'invite_list_sorts' =>$aYahoo[0],
					'aValid' => $aYahoo[1],
					'errors' =>$errors,
					'aInValid' => $aYahoo[2],
					'aUsers' => $aYahoo[3],
					'plugType' => 'email',
					'tokenName' =>Phpfox::getTokenName(),
					'tokenPhpFoxValue' =>Phpfox::getService('log.session')->getToken() ,
					'oi_session_id'=>'9299392939293',
					'core_url' =>phpfox::getParam('core.path'),
					'sIniviteLink' => Phpfox::getLib('url')->makeUrl('contactimporter.inviteuser', array('id' => Phpfox::getUserId())),
                ));
				$this->template()->setHeader(array(
					'Ynscontactimporter.css' => 'module_contactimporter',
					'jquery.autocomplete.js'=>'module_contactimporter',
					'jquery.autocomplete.css'=>'module_contactimporter',
					'jquery.scrollTo-min.js'=>'module_contactimporter',
					'jquery.localscroll-min.js'=>'module_contactimporter',
					'init.js'=>'module_contactimporter',
                ));
				return;
			}
		}

		$fb_f_c = phpfox::getService('contactimporter');
		$facebook = $fb_f_c->initFB();
		if($facebook == false)
		{
           Phpfox_Error::set(Phpfox::getPhrase('contactimporter.please_enter_your_facebook_api'));
		   if(phpfox::getParam('core.site_wide_ajax_browsing') == true)
		   {
		   		Phpfox_Error::setDisplay(false);
		   }
		}
		$_SESSION['contact_url'] = phpfox::getLib('url')->makeUrl('contactimporter');
		$fbconnect = $this->request()->get('req2');
		if ($fb_f_c->verifyFB() && ($fbconnect == "fbcontact"))
		{
			$me = null;
			$me = @$fb_f_c->getUserProfileFB();
			if($me == null)
			{
               $loginUrl = $fb_f_c->getLoginUrl();
               $this->template()->assign(array(
                    'fbloginUrl' =>$loginUrl
                ));
			}
			else
			{
				$step = 'add_contact';
				$contacts = $fb_f_c->getUserFriendsFB();
				foreach ($contacts as $key => $email)
				{
					if (!is_numeric($key)) continue;
                    $char = strtoupper(substr($email['name'], 0, 1));
                    $social_c = ord($char);
                    for ($start = ord('A'); $start <= ord('Z');$start++)
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
				for($start = ord('A'); $start <= ord('Z');$start++)
				{
                    if(!isset($contact_list[chr($start)])) $contact_list[chr($start)] = array();
				}

				$errors = '';
				$this->template()->assign(array(
                        'step'=>$step,
                        'errors' =>$errors,
                        'social_invite_list'=>$contact_list,
                        'provider_box'=>'facebook',
                        'sIniviteLink' => Phpfox::getLib('url')->makeUrl('contactimporter.inviteuser', array('id' => Phpfox::getUserId())),
                        'core_url' =>phpfox::getParam('core.path')
                    )
				)
				->setBreadcrumb(Phpfox::getPhrase('contactimporter.breadcrumb_contactimporter_title'))
                ->setHeader(array(
                    'Ynscontactimporter.css' => 'module_contactimporter',
					'jquery.autocomplete.js'=>'module_contactimporter',
					'jquery.autocomplete.css'=>'module_contactimporter',
					'jquery.scrollTo-min.js'=>'module_contactimporter',
					'jquery.localscroll-min.js'=>'module_contactimporter',
					'init.js'=>'module_contactimporter',
					'slide.js'=>'module_contactimporter',
                ));
				return;
			}
		}
		else
		{
			$loginUrl = $fb_f_c->getLoginUrl();
			$this->template()->assign(array(
				'fbloginUrl' =>$loginUrl
			));
       }

       /**END***/
       $cur_url  = $_SERVER['REQUEST_URI'];
       $cur_url = str_replace('/index.php?do=','',$cur_url);
       parse_str($cur_url,$params);
       $contacts = array();
       $aInserts = array();
       $index = 0;
       $id = "";
       $name ="";
       $pic ="";
       $getcontact = false;
       $token = "";
       $secret_token = "";
       $getcontactYN = false;
       $getcontactTW = false;
       $errors = array();
       $this->template()->assign(array('sIniviteLink' => Phpfox::getLib('url')->makeUrl('contactimporter.inviteuser', array('id' => Phpfox::getUserId())),));
       $this->template()->setHeader('cache', array(
			'pager.css' => 'style_css',
		));

		foreach ($params as $key => $val)
		{
			if (strpos($key,'?user')!==false)
			{
				$getcontactTW = true;
				$_SESSION['user_id'] = $val;
			}
			if (strpos($key,'?contact')!==false)
			{
				$getcontact = true;
			}
			if (strpos($key,'?token') !== false)
			{
				$getcontactYN = true;
				$_SESSION['token_YT'] = $val;
			}
            if (strpos($key,'oauth_tok3n')!==false)
            {
                 $token = $val;
                  $_SESSION['token'] = $token;

            }
            if (strpos($key,'oauth_token_secret')!==false)
            {
                 $secret_token = $val;
                 $_SESSION['secret_token'] = $secret_token;

            }

            $pic = null;
            if (strpos($key,'id_')!==false)
            {
                 $id = $val;

            }
            if (strpos($key,'name_')!==false)
            {
                $name = $val;

            }
            if (strpos($key,'pic_')!==false)
            {

                $pic = $val;
                $index =2;
            }

            if ($index >=2)
            {
                $contacts[$id]= array('id'=>$id,'name'=>$name,'pic'=>$pic);

            }
		}

		if ($getcontact)
		{
			$_SESSION['token'] = $token;
			$_SESSION['secret_token'] = $secret_token;
			$contacts  = phpfox::getService('contactimporter')->getContacts();
			if(count($contacts) > 0)
			{
				$contact_list = phpfox::getService('contactimporter')->displayContacts($contacts);
				$this->template()->assign(array('is_linkedAPI'=>'is_linkedAPI','social_invite_list'=>$contact_list));
			}
			else
			{
                $errors['contacts'] =Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
                $this->template()->assign(array('plugType'=>'social','provider_type' => 'linkedin','errors' => $errors));
			}
		}
		$urs = $this->request()->get('email_box');
        if (!empty($urs)) {
            $_SESSION['username'] = $this->request()->get('email_box');
		}
        if ($getcontactYN)
        {
            $contacts  = phpfox::getService('contactimporter')->getContactsYT();
            if(count($contacts)>0)
            {
                $contact_list = phpfox::getService('contactimporter')->displayContacts($contacts);
                $this->template()->assign(array(
                        'step'=>isset($step)?$step:"",
                        'social_invite_list'=>$contact_list,
                        'is_and_YT'=>'is_and_YT',
                        'is_linkedAPI' => 'is_linkedAPI',
                        'sIniviteLink' => Phpfox::getLib('url')->makeUrl('contactimporter.inviteuser', array('id' => Phpfox::getUserId())),
                        'core_url' =>phpfox::getParam('core.path')
                    )
				)
				->setBreadcrumb(Phpfox::getPhrase('contactimporter.contact_importer'))
                ->setHeader(array(
                    'Ynscontactimporter.css' => 'module_contactimporter',
					'jquery.autocomplete.js'=>'module_contactimporter',
					'jquery.autocomplete.css'=>'module_contactimporter',
					'jquery.scrollTo-min.js'=>'module_contactimporter',
					'jquery.localscroll-min.js'=>'module_contactimporter',
					'init.js'=>'module_contactimporter',
					'slide.js'=>'module_contactimporter',
                ));
                return;
            }
            else
            {
                $errors['contacts'] = Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
                $this->template()->assign(array('plugType'=>'social','provider_type' => 'youtube','errors' => $errors));
            }
        }

        if ($getcontactTW)
        {
			$_SESSION['token'] = $token;
			$_SESSION['secret_token'] = $secret_token;
			$contacts = phpfox::getService('contactimporter')->getContactsTW();
			if (count($contacts)> 0)
			{
				$contact_list = phpfox::getService('contactimporter')->displayContacts($contacts);
				$this->template()->assign(array('is_linkedAPI'=>'is_linkedAPI','social_invite_list'=>$contact_list,'provider_box'=>isset($provider_box)));
				$this->template()->assign(array('is_and_YT'=>'is_and_TW'));
			}
            else
            {
                Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
                $this->template()->assign(array('plugType'=>'social','provider_type' => 'twitter','errors' => $errors));
            }
        }

		$plugType = "";
		$core_url = Phpfox::getParam('core.path');
		$this->template()->assign(array('core_url'=>$core_url));
		$oi_services = phpfox::getService('contactimporter')->getProvidersEnable();
        $options = $mapkey = array();
        foreach ($oi_services as $provider)
        {
			if ($provider['type'] =='social')
			{
				$options[$provider['name']]="{$provider['title']}";
                if ($provider['type'] == "email")
                {
                    $supported_domains = unserialize($provider['supported_domain']);
                    foreach($supported_domains as $domain)
                    {
                        $mapkey[$domain] = $provider['name'];
                    }
                    $mapkey[$provider['name']] = $provider['name'];
                }
			}
        }
        $step = 'get_contact';
        $provider_lists = Phpfox::getLib('phpfox.database')->select('*')
			->from(Phpfox::getT('contactimporter_providers'),'cp')
			->where('(type = "email" AND enable = 1 AND default_domain !="" ) OR (type = "social" AND enable = 1)')
			->order('cp.order_providers ASC')
			->execute('getSlaveRows');
		$provider_lists = phpfox::getService('contactimporter')->allowProvider($provider_lists);

		$this->template()->assign(array(
			'provider_lists' => $provider_lists,
			'step' => $step
		));

        $list_provider_domain_name_mail = Phpfox::getLib('phpfox.database')->select('*')
			->from(Phpfox::getT('contactimporter_providers'),'cp')
			->where('type = "email" AND enable = 1 AND default_domain !=" " ')
			->order('cp.order_providers ASC')
			->execute('getSlaveRows');
		$list_provider_domain_name_mail = phpfox::getService('contactimporter')->allowProvider($list_provider_domain_name_mail);

		$this->template()->setTitle(Phpfox::getPhrase('contactimporter.contact_importer'))
			->setBreadcrumb(Phpfox::getPhrase('contactimporter.contact_importer'))
			->setHeader(array(
				'Ynscontactimporter.css' => 'module_contactimporter',
				'jquery.autocomplete.js'=>'module_contactimporter',
				'jquery.autocomplete.css'=>'module_contactimporter',
				'jquery.scrollTo-min.js'=>'module_contactimporter',
				'jquery.localscroll-min.js'=>'module_contactimporter',
				'init.js'=>'module_contactimporter',
				'slide.js'=>'module_contactimporter',
			));

		$request = $this->request();
		$provider_box = $request->get('provider_box');
        if ($request->get('provider_box2') != '') $provider_box = $request->get('provider_box2');
        $provider_arr = explode('.', $provider_box);
        if(!empty($provider_arr)) $provider_box = $provider_arr[0];
		$type_err = '';
		$plugType = '';
		$errors = array();
        $this->template()->assign(array('type_email'=>$provider_box));
		$uploadcsv = $request->get('uploadcsv');
		if ($request->get('task')=='skip')
        {
            return;
        }
		if ( isset($uploadcsv) && $uploadcsv != null)
		{
			$service = Phpfox::getService('contactimporter');
			$results = $service->getContactsFromCSVFile(Phpfox::getUserId());
			if($results['is_error'] != 0)
			{
				$this->template()->assign(array('uploadcsv'=>'uploadcsv','error_message'=>$results['error_message']));
            }
			else
			{
				$step = 'get_invite';
				$contacts = $results['contacts'];
				$emailContacts = phpfox::getService('contactimporter')->displayEmailContacts($contacts);
                if (count($emailContacts[1]) > 0 || count($emailContacts[3]) > 0 )
				{
                    $this->template()->assign(array('invite_list' => $invite_list,'in_lst' =>$in_lst,'invite_list_sorts'=>$emailContacts[0]));
					$this->template()->assign(array(
							'aValid' => $emailContacts[1],//$aMails,
							'aInValid' => $emailContacts[2],//$aInvalid,
							'aUsers' => $emailContacts[3],//$aCacheUsers,
							'step' => $step,
							'oi_session_id'=>'9299392939293'
						)
					);
				}
				else
				{
					$error_message=Phpfox::getPhrase('contactimporter.all_your_contacts_was_sent_the_invitation');
					$this->template()->assign(array('uploadcsv'=>'uploadcsv','error_message'=>$error_message));
				}
            }
		}
		if (isset($provider_box) && $provider_box != null)
		{
            @ini_set('display_errors', '0');
			foreach ($oi_services as $provider)
			{
				if ($provider['name'] == $provider_box)
				{
					$plugType = $provider['o_type'];
					$type_err = $provider['type'];
					break;
				}
			}
			$this->template()->assign(array( 'plugType' => $plugType,'type_err' => $type_err));
			$email_box = $request->get('email_box');
			$password_box = $request->get('password_box');
			$openproviderContacts = phpfox::getService('contactimporter')->getContactOpenviter($provider_box,$email_box,$password_box);
			if ($openproviderContacts)
			{
				$provider_box = $openproviderContacts->provider_box;
				$oi_session_id = $openproviderContacts->oi_session_id;
				$errors = $openproviderContacts->error;
				if(is_object($openproviderContacts->contacts))
				{
					$openproviderContacts->contacts = (array)$openproviderContacts->contacts;
				}
				if(count($openproviderContacts->contacts)>0 && is_array($openproviderContacts->contacts))
				{
					foreach ($openproviderContacts->contacts as $key =>$aContacts)
					{
						$contacts[$key] = $aContacts;
					}
				}
			}
			else
			{
				$errors['login']=Phpfox::getPhrase('contactimporter.login_failed_please_check_the_email_and_password_you_have_provided_and_try_again_later');
			}

			/*
			$provider_internal = array('myspace','flickr','hi5','plaxo','aol','plurk','fdcareer','netlog','perfspot','mycatspace','motortopia');
            if(in_array($provider_box, $provider_internal))
            {
                $openinviter = null;
				if (!isset($openinviter) && $openinviter == null)
				{
					$openinviter = new openinviter();
				}
				$inPlugin = $openinviter->getPlugins(true);
				$openinviter->startPlugin($provider_box,true);
				$internal=$openinviter->getInternalError();
				if ($internal != null)
				{
					$errors['inviter'] = $internal;
				}
				elseif (!$openinviter->login($email_box,$password_box))
				{
					$internal=$openinviter->getInternalError();
					$errors['login']=$internal?$internal: Phpfox::getPhrase('contactimporter.login_failed_please_check_the_email_and_password_you_have_provided_and_try_again_later');
				}
				elseif (false===$contacts=$openinviter->getMyContacts())
				{
					$errors['contacts']=Phpfox::getPhrase('contactimporter.unable_to_get_contacts');
				}
				elseif (count($contacts) == 0)
				{
					$errors['contacts']=Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
				}
				else
				{
					$import_ok=true;
				   $oi_session_id = $openinviter->plugin->getSessionID();
				   $this->template()->assign(array('oi_session_id' => $oi_session_id,'provider_box' => $provider_box));
				}
			}
            else
            {
				$openproviderContacts = phpfox::getService('contactimporter')->getContactOpenviter($provider_box,$email_box,$password_box);
				if($openproviderContacts)
				{
					$provider_box = $openproviderContacts->provider_box;
					$oi_session_id = $openproviderContacts->oi_session_id;
					$errors = $openproviderContacts->error;
					if(is_object($openproviderContacts->contacts))
					{
						$openproviderContacts->contacts = (array)$openproviderContacts->contacts;
					}
					if(count($openproviderContacts->contacts)>0 && is_array($openproviderContacts->contacts))
					{
						foreach ($openproviderContacts->contacts as $key =>$aContacts)
						{
							$contacts[$key] = $aContacts;
						}
					}
				}
                else
				{
					$errors['login']=Phpfox::getPhrase('contactimporter.login_failed_please_check_the_email_and_password_you_have_provided_and_try_again_later');
				}
            }
			*/
			if (isset($errors) && $errors != null)
			{
				$this->template()->assign(array('provider_type'=>$provider_box,'type_err' => $type_err,'errors' => $errors));
			}
			else
			{
				if ($plugType =='email')
				{
					$step = 'get_invite';
					$errors = '';
					$emailContacts = phpfox::getService('contactimporter')->displayEmailContacts($contacts);
					if (count($emailContacts[1]) > 0 || count($emailContacts[3]) > 0)
					{
                        $invite_list = $emailContacts;
                        $in_lst = array();
						$this->template()->assign(array('invite_list' => $invite_list,'in_lst' =>$in_lst,'invite_list_sorts' =>$emailContacts[0]));
                        $this->template()->assign(array(
							'aValid' => $emailContacts[1],
							'aInValid' => $emailContacts[2],
							'aUsers' => $emailContacts[3],
							'step'   => $step,
							'errors' =>$errors,
							'oi_session_id' => $oi_session_id,
							'provider_box' => $provider_box,
						));
						return;
					}
					else
					{
						$errors['contacts'] = Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
						$this->template()->assign(array('provider_type'=>$provider_box, 'plugType'=>$plugType,'type_err' => $type_err,'errors' => $errors));
						return;
					}
				}
				elseif($plugType == 'social')
				{
					$step = 'add_contact';
					$errors = '';
					$contact_list = phpfox::getService('contactimporter')->displayContacts($contacts);
					if(count($contact_list) > 0)
					{
						$this->template()->assign(array('step'=>$step,'errors' =>$errors,'social_invite_list'=>$contact_list,'provider_box'=>$provider_box,'oi_session_id' => $oi_session_id));
						return;
					}
					else
					{
						$errors['contacts'] = Phpfox::getPhrase('contactimporter.there_is_not_contact_in_your_account');
						$this->template()->assign(array('provider_type'=>$provider_box,'step'=>$step,'social_invite_list'=>$contact_list,'provider_box'=>$provider_box,'oi_session_id' => $oi_session_id,'plugType' => 'social','errors' => $errors));
						return;
					}
				}
			}
        }
    }
}
?>