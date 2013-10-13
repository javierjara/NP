<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<?php if (count((array)$this->_aVars['aSettings'])):  foreach ((array) $this->_aVars['aSettings'] as $this->_aVars['aSetting']): ?>
		<div class="table js_custom_groups<?php if (isset ( $this->_aVars['aSetting']['group_id'] )): ?> js_custom_group_<?php echo $this->_aVars['aSetting']['group_id'];  endif; ?>">
			<div class="table_left">
<?php if ($this->_aVars['aSetting']['is_required'] && ! Phpfox ::isAdminPanel()):  if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  endif;  echo Phpfox::getPhrase($this->_aVars['aSetting']['phrase_var_name']); ?>:
			</div>
			<div class="table_right">
				<?php
						Phpfox::getLib('template')->getBuiltFile('custom.block.form');						
						?>
			</div>
		</div>
<?php endforeach; endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('user.template_controller_profile_form')) ? eval($sPlugin) : false); ?>
