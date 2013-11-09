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
class Contactimporter_Component_Controller_invitionknow extends Phpfox_Component {

    public function process()
	{
		Phpfox::isUser(true);
		$iPage = $this->request()->getInt('page');
		$iLimit = 5;

		list($iCnt, $aUsers) = Phpfox::getService('contactimporter')->getUserInvite($iPage, $iLimit);

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $iCnt));

		$this->template()->setTitle('People who you may know')
			->setBreadcrumb('People who you may know')
			->setHeader('cache', array(					
					'pager.css' => 'style_css'
				)
			)
			->assign(array(
				'aUsers' => $aUsers				
			)
		);
	}
}
?>
