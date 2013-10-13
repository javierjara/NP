<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: images.html.php 2817 2011-08-08 16:59:43Z Raymond_Benc $
 */
 
 

?>
<div class="user_welcome_images">
<?php if (count((array)$this->_aVars['aUserImages'])):  $this->_aPhpfoxVars['iteration']['userimages'] = 0;  foreach ((array) $this->_aVars['aUserImages'] as $this->_aVars['aUserImage']):  $this->_aPhpfoxVars['iteration']['userimages']++;  echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aUserImage'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50));  endforeach; endif; ?>
</div>
