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
class Contactimporter_Component_Controller_blockallfurtheremailmessages  extends Phpfox_Component{ 
    public function process()
        {

            $path = $_SERVER['REQUEST_URI'];
            $encoded = explode('id=', $path);
            $encoded = isset($encoded[1])?$encoded[1]:"";
            $email=PREG_REPLACE("'([\S,\d]{2})'e","chr(hexdec('\\1'))",$encoded);
            $insertUnsubscribe = array(
                'email' => $email,
                'time_stamp' => PHPFOX_TIME
            );
            
            Phpfox::getService('contactimporter')->addUnsubscribe($insertUnsubscribe);
            $this->template()->assign(array(                      
                        'path'=> phpfox::getParam('core.path'),
                        'email' => $email,
            			'SignUp' =>phpfox::getLib('url')->makeUrl('user.register'),
            			'login' =>phpfox::getLib('url')->makeUrl('user.login'),	
                    ));
        }
}
?>
