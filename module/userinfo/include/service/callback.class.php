<?php
defined('PHPFOX') or exit('NO DICE!');

class Userinfo_Service_Callback extends Phpfox_Service 
{
	public function __construct()
	{	
	}
	
	public function getProfileSettings()
	{
		return array(
			'userinfo.display_on_profile' => array(
				'phrase' => Phpfox::getPhrase('userinfo.work_and_education'),
				'default' => '0'				
			)
		);
	}
	
	public function getActivityFeedEmployerAdd($aItem)
	{
		$oUrl = Phpfox::getLib('url');
		
		$sLink = $oUrl->makeUrl($aItem['user_name'].'.info');
		
		$aReturn = array(
			'feed_link' => $sLink,
			'feed_title' => '',
			'feed_info' => Phpfox::getPhrase('userinfo.added_employer_entry', array('gender' => Phpfox::getService('user')->gender($aItem['gender'], 1))),
			//'total_comment' => $aRow['total_comment'],
			//'feed_total_like' => $aRow['total_like'],
			//'feed_is_liked' => isset($aRow['is_liked']) ? $aRow['is_liked'] : false,
			'feed_icon' => Phpfox::getLib('image.helper')->display(array('theme' => 'misc/page_edit.png', 'return_url' => true)),
			'time_stamp' => $aItem['time_stamp'],
			'enable_like' => false,
			//'comment_type_id' => 'custom',
			//'like_type_id' => 'custom'
		);
			
		return $aReturn;
	}
	
	public function getActivityFeedEducationAdd($aItem)
	{
		$oUrl = Phpfox::getLib('url');
		
		$sLink = $oUrl->makeUrl($aItem['user_name'].'.info');
		$aReturn = array(
			'feed_link' => $sLink,
			'feed_title' => '',
			'feed_info' => Phpfox::getPhrase('userinfo.added_education_entry', array('gender' => Phpfox::getService('user')->gender($aItem['gender'], 1))),
			//'total_comment' => $aRow['total_comment'],
			//'feed_total_like' => $aRow['total_like'],
			//'feed_is_liked' => isset($aRow['is_liked']) ? $aRow['is_liked'] : false,
			'feed_icon' => Phpfox::getLib('image.helper')->display(array('theme' => 'misc/page_edit.png', 'return_url' => true)),
			'time_stamp' => $aItem['time_stamp'],
			'enable_like' => false,
			//'comment_type_id' => 'custom',
			//'like_type_id' => 'custom'
		);
			
		return $aReturn;
	}
	
	public function getActivityFeedEmployerEdit($aItem)
	{
		$oUrl = Phpfox::getLib('url');
		
		$sLink = $oUrl->makeUrl($aItem['user_name'].'.info');
		
		$aReturn = array(
			'feed_link' => $sLink,
			'feed_title' => '',
			'feed_info' => Phpfox::getPhrase('userinfo.updated_employer_entry', array('gender' => Phpfox::getService('user')->gender($aItem['gender'], 1))),
			//'total_comment' => $aRow['total_comment'],
			//'feed_total_like' => $aRow['total_like'],
			//'feed_is_liked' => isset($aRow['is_liked']) ? $aRow['is_liked'] : false,
			'feed_icon' => Phpfox::getLib('image.helper')->display(array('theme' => 'misc/page_edit.png', 'return_url' => true)),
			'time_stamp' => $aItem['time_stamp'],
			'enable_like' => false,
			//'comment_type_id' => 'custom',
			//'like_type_id' => 'custom'
		);
			
		return $aReturn;
	}
	
	public function getActivityFeedEducationEdit($aItem)
	{
		$oUrl = Phpfox::getLib('url');
		
		$sLink = $oUrl->makeUrl($aItem['user_name'].'.info');
		$aReturn = array(
			'feed_link' => $sLink,
			'feed_title' => '',
			'feed_info' => Phpfox::getPhrase('userinfo.updated_education_entry', array('gender' => Phpfox::getService('user')->gender($aItem['gender'], 1))),
			//'total_comment' => $aRow['total_comment'],
			//'feed_total_like' => $aRow['total_like'],
			//'feed_is_liked' => isset($aRow['is_liked']) ? $aRow['is_liked'] : false,
			'feed_icon' => Phpfox::getLib('image.helper')->display(array('theme' => 'misc/page_edit.png', 'return_url' => true)),
			'time_stamp' => $aItem['time_stamp'],
			'enable_like' => false,
			//'comment_type_id' => 'custom',
			//'like_type_id' => 'custom'
		);
			
		return $aReturn;
	}

	public function __call($sMethod, $aArguments)
	{
		if ($sPlugin = Phpfox_Plugin::get('userinfo.service_callback__call'))
		{
			eval($sPlugin);
			return;
		}
			
		Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
	}	
}

?>