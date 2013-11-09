<?php
    require_once "cli.php";
    if(!class_exists('Facebook'))
    {
        require_once 'facebook.php' ;
    }
    $url = phpfox::getLib('url')->makeUrl('contactimporter.fbcontact');
    $fb_settings = Phpfox::getLib('phpfox.database')->select('*')
                ->from(Phpfox::getT('contactimporter_api_settings'),'st')
                ->where('st.api_name = "facebook"')
                ->execute('getRow');
    if($fb_settings == null)
    {
        echo Phpfox::getPhrase('contactimporter.please_enter_your_facebook_api');
        exit;
        
    }
    $fb_settings['api_params'] = unserialize($fb_settings['api_params']);            
    $facebook  = new Facebook(array(
        'appId'  => $fb_settings['api_params']['appid'],
        'secret' => $fb_settings['api_params']['secret'],
        'cookie' => true,
    ));
    $session = $facebook->getSession();
    $facebook->setSession($session);
    echo "<script> opener.parent.location.href = '".$url."';</script>" ;
    echo "<script>self.close();</script>" ;
    /*if(!session_id())
    {
        session_start();
    }
    
    if(isset($_SESSION['fpConfig']))
    {
        $facebook = new Facebook(array(
          'appId'  => $_SESSION['fpConfig']['appId'],
          'secret' => $_SESSION['fpConfig']['secret'],
          'cookie' => true,
        ));
        $session = $facebook->getSession();
        
        $facebook->setSession($session);
        $_SESSION['fb_login_contact'] = true;
        //$url = "http://dev.nghiadh.yo/phpfox210/contactimporter/";
        $url = $_SESSION['contact_url'];
        echo "<script> opener.parent.location.href = '".$url."';</script>" ;
        echo "<script>self.close();</script>" ;
        //header('Location:'.$url);
    } */
    //$_SESSION['fb_login_contact'] = false;
    
?>