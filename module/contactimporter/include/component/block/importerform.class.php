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
class Contactimporter_Component_Block_ImporterForm extends Phpfox_Component
{
    public function process()
    {
        $email = array();        
        $email['default_domain']= $this->request()->get('default_domain');
        $email['provider_type']= $this->request()->get('provider_type');
        $email['name'] = $this->request()->get('provider_box');      
        $this->template()->assign(array('email'=>$email));
        return 'block';
    }
}

?>
