<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'facebook.enable_facebook_connect\'))
{
	$this->database()->select(\'fbconnect.fb_user_id, fbconnect.is_unlinked AS fb_is_unlinked, fbconnect.share_feed AS fb_share_feed, fbconnect.send_email AS fb_send_email, \')->leftJoin(Phpfox::getT(\'fbconnect\'), \'fbconnect\', \'fbconnect.user_id = u.user_id\');
} if (Phpfox::getParam(\'janrain.enable_janrain_login\'))
{
	$this->database()->select(\'janrain.user_id as janrain_user_id, \')
		->leftJoin(Phpfox::getT(\'janrain\'), \'janrain\', \'janrain.user_id = u.user_id\');
} $bLoadUserField = true;
$sUserFieldSelect = \'uf.subscribe_id, \'; '; ?>