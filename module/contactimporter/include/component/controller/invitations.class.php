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
class Contactimporter_Component_Controller_Invitations extends Phpfox_Component
{	
	public function process()
	{
		if (!Phpfox::isUser())
		{
			$path = phpfox::getParam('core.path').'user/login';
			$this->url()->send('login',null,'Need to be logged in for showing your invitations.');
		}
		
		if ($iInvite = $this->request()->getInt('del'))
		{
			$bDel = Phpfox::getService('invite.process')->delete($iInvite, Phpfox::getUserId());
			if ($bDel)
			{
				$this->url()->send('contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_deleted'));
			}
			$this->url()->send('contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_not_found'));
		}
		elseif ($aInvite = $this->request()->get('val'))
		{
			$bDel = true;
			foreach ($aInvite as $iInvite)
			{
				$bDel = $bDel && Phpfox::getService('invite.process')->delete($iInvite, Phpfox::getUserId());
			}
			if ($bDel)
			{
				$this->url()->send('contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_deleted'));
			}
			$this->url()->send('contactimporter.invitations', null, Phpfox::getPhrase('invite.invitation_not_found'));
		}
		$iPage = $this->request()->getInt('page');
		$iPageSize = (int) Phpfox::getParam('invite.pendings_to_show_per_page');		

		list($iCnt, $aInvites) = Phpfox::getService('contactimporter')->get(Phpfox::getUserId(), $iPage, $iPageSize);
		
		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));	

		$this->template()->setTitle(Phpfox::getPhrase('invite.pending_invitations'))
			->setBreadcrumb(Phpfox::getPhrase('invite.pending_invitations'))
			->assign(array(
					'aInvites' => $aInvites,
					'iPage' => $iPage,
					'core_url'=>Phpfox::getParam('core.path')
				)
			)
			->setHeader('cache', array(
				'pager.css' => 'style_css',
				'pending.js' => 'module_contactimporter'
			));
        //$this->template()->setBreadcrumb(Phpfox::getPhrase('contactimporter.breadcrumb_contactimporter_title'));
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('invite.component_controller_invitations_clean')) ? eval($sPlugin) : false);
	}
}

?>