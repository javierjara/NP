<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
  /* $mess = 'You have already been friend of';
   phpfox::getLib('url')->send('contactimporter',null,$mess);*/

if(isset ($_SESSION['signup_plugin']) && $_SESSION['signup_plugin'] ==1)
{           
        unset ($_SESSION['signup_plugin']);
        $mess = 'You have already been a friend of people';
         phpfox::getLib('url')->send('contactimporter.invitionknow',null,$mess);
}

?>
