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
class Contactimporter_Component_Controller_Export extends Phpfox_Component 
{  
    public function process()
    {       
        if (!Phpfox::isUser())
        {                
			$this->url()->send('login',null,Phpfox::getPhrase('contactimporter.need_to_be_logged_in_for_exporting_your_friend_contacts').'.');
		}		
        if (!Phpfox::isUser())
		{                
			$this->url()->send('login', null, Phpfox::getPhrase('contactimporter.need_to_be_logged_in_for_exporting_your_friend_contacts').'.');

		}
        if($this->request()->get('option'))
        {
			$error = phpfox::getService('contactimporter.export')->exportCSV(phpfox::getUserId());
			if ($error !='')
			{
				$this->url()->send('contactimporter.export', null, $error);
			}           
        }
        $this->template()->setBreadcrumb(Phpfox::getPhrase('contactimporter.breadcrumb_contactimporter_title'));
        $this->template()->assign(
			array (
				'url' => phpfox::getLib('url')->makeUrl('contactimporter.export',array('option'=>'export')),
			)
        );
    }
}
?>