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
if (file_exists(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'facebook.php'))
{
    require_once(PHPFOX_DIR.'module'.PHPFOX_DS.'contactimporter'.PHPFOX_DS.'include'.PHPFOX_DS.'component'.PHPFOX_DS.'controller'.PHPFOX_DS.'Apiconnection'.PHPFOX_DS.'facebook.php');
}
?>
<?php
class Contactimporter_Component_Block_Home_contact extends Phpfox_Component
{
    public function process()
	{
		$fb_f_c = phpfox::getService('contactimporter');
		$facebook = $fb_f_c->initFB();
		$_SESSION['contact_url'] = phpfox::getLib('url')->makeUrl('contactimporter');
        if ($fb_f_c->verifyFB() && isset($_SESSION['fb_login_contact']) && $_SESSION['fb_login_contact'] == true)
		{
			$_SESSION['fb_login_contact'] = false;
			$me = null;
			$me = @$fb_f_c->getUserProfileFB();
			if ($me == null)
			{
				$loginUrl = $fb_f_c->getLoginUrl();
				$loginUrl = str_replace("index.php%3Fdo%3D","",$loginUrl);
				$loginUrl = urldecode($loginUrl);

				$loginUrlF =str_replace(Phpfox::getParam('core.path'),Phpfox::getParam('core.path').'module/contactimporter/static/fb.php', $loginUrl);
				$loginUrl = urlencode($loginUrlF);
				$this->template()->assign(
                    array(
                        'fbloginUrl' =>$loginUrl
                    )
                );
			}
			else
			{
				$step = 'add_contact';
				$contacts = $fb_f_c->getUserFriendsFB();
				foreach ($contacts as $key=>$email)
				{
                    $char = strtoupper(substr($email['name'], 0,1));
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
                            if(!isset($contact_list[chr($start)]))
                                $contact_list[chr($start)] = array();
                        }

                    }
                }
				for($start = ord('A'); $start <= ord('Z');$start++)
				{
                    if(!isset($contact_list[chr($start)]))
                           $contact_list[chr($start)] = array();
				}

				$errors = '';
				$this->template()->assign(array(
                        'step'=>$step,
                        'errors' =>$errors,
                        'social_invite_list'=>$contact_list,
                        'provider_box'=>'facebook',
                        'sIniviteLink' => Phpfox::getLib('url')->makeUrl('invite', array('user' => Phpfox::getUserId())),
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
		}
		else
		{
			$loginUrl = $fb_f_c->getLoginUrl();
			$loginUrl = str_replace("index.php%3Fdo%3D","",$loginUrl);
			$loginUrl = urldecode($loginUrl);
			$loginUrlF =str_replace(Phpfox::getParam('core.path'),Phpfox::getParam('core.path').'module/contactimporter/static/fb.php', $loginUrl);
			$loginUrl = urlencode($loginUrlF);
			$this->template()->assign(array(
					'fbloginUrl' =>$loginUrl
				)
			);
		}
		/**END***/
    	$this->template()->assign(array(
				'icon_size' => phpfox::getService('contactimporter')->getIconSize(),
				'top_5_email' => $top_5_email = phpfox::getService('contactimporter')->getTopProviders(),
                'more_path' => Phpfox::getLib('url')->makeUrl('contactimporter'),
				'core_url' => Phpfox::getParam('core.path'),
				'sHeader' => Phpfox::getPhrase('contactimporter.homepage_contact'),
				'sDeleteBlock' => 'dashboard',
				'Ynscontactimporter.css' => 'module_contactimporter',
				'jquery.min.js'=>'module_contactimporter',
				'contactimporter.js'=>'module_contactimporter'
			)
		);
		if (!$top_5_email) return false;
		return 'block';
	}
}
?>