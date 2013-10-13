<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: welcome.html.php 3382 2011-10-31 11:53:10Z Raymond_Benc $
 */
 
 

?>
<h1><?php echo Phpfox::getPhrase('user.ssitename_helps_you_connect_and_share_with_the_people_in_your_life', array('sSiteName' => $this->_aVars['sSiteTitle'])); ?></h1>
<div class="t_center">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/banner.png')); ?>
</div>
