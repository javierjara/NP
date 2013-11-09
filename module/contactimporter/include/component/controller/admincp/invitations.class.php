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
 
class Contactimporter_Component_Controller_Admincp_Invitations extends Phpfox_Component
{
    public function process()
    {    
        
       
        
        $aFilters = array(
            'title' => array(
                'type' => 'input:text',
                'search' => " pi.email LIKE '%[VALUE]%' OR pu.user_name  LIKE '%[VALUE]%' OR pu.full_name  LIKE '%[VALUE]%'"
            ),                        
          
            
        );
        $oSearch = Phpfox::getLib('search')->set(array(
                'type' => 'invite_email',
                'filters' => $aFilters,
                'search' => 'search'
            )
        );
         if ($this->request()->get('deleteselect')=='Delete selected')
        {
           
            $arr_select = $this->request()->get('arr_selected');
          
            $arr_select = substr($arr_select,1);
            
            Phpfox::getLib('phpfox.database')->delete(Phpfox::getT('invite'), 'invite_id IN ('.$arr_select.')');
           
         
          
            
        }
        if($this->request()->get('del'))
        {
            $iInvite = $this->request()->get('del')  ;
            $bDel = Phpfox::getService('invite.process')->delete($iInvite, Phpfox::getUserId());
            if ($bDel)
            {
                $this->url()->send('admincp.contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_deleted'));
            }
            $this->url()->send('admincp.contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_not_found'));
        }
        $iPage = $this->request()->getInt('page');
        $iPageSize = 20;              
        list($iCnt,$items) = phpfox::getService('contactimporter')->getAllEmailInvitations($oSearch->getConditions(),"", $oSearch->getPage(), $iPageSize);
        $this->template()->setHeader(array('contactimporter.js' =>'module_contactimporter'));          
        
        $this->template()->assign(array('emails'=>isset($emails),'core_url'=>phpfox::getParam('core.path')));
       
            //echo $iPage;
            Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $oSearch->getSearchTotal($iCnt))); 
                     
            $this->template()->assign(array('items'=>$items,'iCnt'=>$iCnt,'iPage'=>$iPage))
                            ->setHeader('cache', array(
                                     'pager.css' => 'style_css',
               
            ));;
		$this->template()->setBreadCrumb('Invitations List', $this->url()->makeUrl('admincp.contactimporter.invitations'));
            
       
    }
}
 
?>