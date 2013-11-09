<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');


class YouNetCore_Component_Ajax_Ajax extends Phpfox_Ajax
{	
	public function viewPhotos()
	{
		$t = $this->get('t');
		$m = $this->get('m');
		$response = phpfox::getService('younetcore.core')->getPhotos($m,$t);
		echo($response);die();
	}
    public function l()
    {
        $data = $this->get('data');  
        parse_str($data,$sData);
        if(isset($sData['core']))
        {
            unset($sData['core']);
        }
        $result = phpfox::getService('younetcore.core')->verifyM($sData);
        echo $result;die();
    }
    public function f()
    {
        $plugin_name = $this->get('ur');
        $token = phpfox::getService('younetcore.core')->getToken($plugin_name);
        if(isset($token['m']))
        {
            $token['title'] = phpfox::getLib('database')->select('title')->from(phpfox::getT('product'),'p')->where('p.product_id = "'.$token['m'].'"')->execute('getSlaveField');    
        }
        phpfox::getBlock('younetcore.form',array(
            'token' =>$token
            )
        );
        $this->html('#verify_lis',$this->getContent(false)."<script>q();</script>");
        
    }
}

?>