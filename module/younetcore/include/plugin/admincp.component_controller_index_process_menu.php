<?php
    if(phpfox::isModule('younetcore'))
    {
        $aMenus['younetcore.younetcore'] ='admincp.younetcore';
        phpfox::getService('younetcore.core')->reverifiedModules(); 
        $aModules = phpfox::getService('younetcore.core')->checkYouNetProducts($aModules);
    }
?>