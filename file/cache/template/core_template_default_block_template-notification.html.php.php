<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: template-notification.html.php 2838 2011-08-16 19:09:21Z Raymond_Benc $
 */
 
 

?>
<ul>
<?php if (Phpfox ::getUserBy('profile_page_id') <= 0): ?>
<?php if (Phpfox ::isModule('friend')): ?>
<?php Phpfox::getBlock('friend.notify', array()); ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('mail')): ?>
<?php Phpfox::getBlock('mail.notify', array()); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('notification')): ?>
<?php Phpfox::getBlock('notification.notify', array()); ?>
<?php endif; ?>
</ul>
