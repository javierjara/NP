<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if(Phpfox::isModule(\'facebook\') && Phpfox::getParam(\'facebook.enable_facebook_connect\'))
    {
        echo \'<div class="header_login_block">
                    <fb:login-button scope="publish_stream,email,user_birthday" v="2"></fb:login-button>
              </div>\';
    } if (Phpfox::isModule(\'janrain\') && Phpfox::getParam(\'janrain.enable_janrain_login\')) 
    { 
        echo     \'<div class="header_login_block"> 
                <a class="rpxnow" onclick="return false;" href="\' 
                . Phpfox::getService(\'janrain\')->getUrl() . \'">\'  
                . Phpfox::getLib(\'phpfox.image.helper\')->display(array(\'theme\' => \'layout/janrain-icons.png\')) 
                . \'</a> 
            </div>\'; 
    } '; ?>