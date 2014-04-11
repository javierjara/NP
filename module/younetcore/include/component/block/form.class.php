<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class YounetCore_Component_Block_Form extends Phpfox_Component
{
    /**
     * Class process method wnich is used to execute this component.
     */
    public function process()
    {
        $sModule = $this->getParam('m');
        $aToken = $this->getParam('token');
        
        $this->template()->assign(
            array(
                'aToken'=>$aToken,
                'sCoreUrl' => phpfox::getParam('core.path'),
            )
        );
    }
    
    /**
     * Garbage collector. Is executed after this class has completed
     * its job and the template has also been displayed.
     */
    public function clean()
    {
        (($sPlugin = Phpfox_Plugin::get('core.component_block_news_clean')) ? eval($sPlugin) : false);
    }
}

?>