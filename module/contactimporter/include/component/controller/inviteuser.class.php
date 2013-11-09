<?php

defined('PHPFOX') or exit('NO DICE!');
?>

<?php
class contactimporter_Component_Controller_InviteUser extends Phpfox_Component
{
	public function process()
	{	
        $iID = $this->request()->get('id');
        if($iID >0)
        {
            
            $sEmail = phpfox::getLib('database')->select('email')
                            ->from(phpfox::getT('user'),'u')
                            ->where('u.user_id = '.(int)phpfox::getLib('database')->escape($iID))
                            ->execute('getSlaveField');
            if(empty($sEmail))
            {
                $this->url()->send('');    
            }
            else
            {
                $iInvite = Phpfox::getService('invite.process')->addInvite($sEmail, $iID);    
                $sLink = Phpfox::getLib('url')->makeUrl('invite', array('id' => $iInvite));        
                $this->url()->send($sLink);
            }
            
            
        }
        else
        {
            $this->url()->send('');
        }
		
	}
}

?>