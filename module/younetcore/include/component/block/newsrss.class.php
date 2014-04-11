<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class YounetCore_Component_Block_NewsRSS extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$aNews = Phpfox::getService('younetcore.core')->getNews();
		
		if ($aNews === false)
		{
			return false;
		}
		
		if (!Phpfox::getUserParam('core.can_view_news_updates'))
		{
			return false;
		}
		
		$this->template()->assign(array(
				'sHeader' => Phpfox::getPhrase('younetcore.phpfox_news_and_updates'),
				'aPhpfoxNews' => $aNews
			)
		);
		
		return 'block';
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