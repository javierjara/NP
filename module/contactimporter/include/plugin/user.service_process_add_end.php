<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $users = phpfox::getLib('database')->select('max(user_id) as user_id')
                ->from(phpfox::getT('user'))
                ->where(1)
                ->execute('getSlaveField');

        $email_signup = phpfox::getLib('database')->select('email')
                ->from(phpfox::getT('user'))
                ->where('user_id = '.$users)
                ->execute('getSlaveField');

        $contactimporter_user_id = phpfox::getLib('database')->select('DISTINCT inv.email')
                ->from(phpfox::getT('invite'),'inv')
                ->where(1)
                ->execute('getRows');       
        $emails = array();
        foreach ($contactimporter_user_id as $key=>$email_contacts)
        {
            $emails[$key] = $email_contacts['email'];
        }  
        if(in_array($email_signup,$emails))
        {
            $_SESSION['signup_plugin'] = 1;
        }
?>
