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
class Contactimporter_Component_Block_Top_inviter extends Phpfox_Component
{    
    public function process()
    {
        $sLimit = 10;
        $topinviter =  phpfox::getLib('phpfox.database')->select('pu.user_name,pi.user_id,pu.full_name,pu.email as inviter_email,pi.emails as emails,pi.socials as socials,sum(emails + socials) as number_invitation')
			->from(phpfox::getT('contactimporter_statistics'),'pi')
			->leftJoin(phpfox::getT('user'),'pu','pu.user_id = pi.user_id')
			->group('pi.user_id')                            
			->where(isset($aCond))
			->order('number_invitation DESC')
			->limit($sLimit)                            
			->execute('getRows');              
		if (!$topinviter) return false;
        $this->template()->assign(array(
			'sHeader' => Phpfox::getPhrase('contactimporter.top_inviters'),//Phpfox::getPhrase('contactimporter.top-user'),
            'sDeleteBlock' => 'dashboard',   
			'Ynscontactimporter.css' => 'module_contactimporter',
			'jquery.min.js'=>'module_contactimporter',
			'contactimporter.js'=>'module_contactimporter',
			'topinviter'=>$topinviter ,
		));             
        return 'block';
    }
}
?>