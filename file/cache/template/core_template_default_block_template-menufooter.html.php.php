<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: template-menufooter.html.php 6413 2013-08-05 09:42:03Z Miguel_Espinoza $
 */
 
 

 if (! Phpfox ::getUserBy('profile_page_id')): ?>
	<ul id="footer_menu">
<?php if (count((array)$this->_aVars['aFooterMenu'])):  $this->_aPhpfoxVars['iteration']['footer'] = 0;  foreach ((array) $this->_aVars['aFooterMenu'] as $this->_aVars['iKey'] => $this->_aVars['aMenu']):  $this->_aPhpfoxVars['iteration']['footer']++; ?>

		<li<?php if ($this->_aPhpfoxVars['iteration']['footer'] == 1): ?> class="first"<?php endif; ?>><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['aMenu']['url'].''); ?>" class="ajax_link<?php if ($this->_aVars['aMenu']['url'] == 'mobile'): ?> no_ajax_link<?php endif; ?>"><?php echo Phpfox::getPhrase($this->_aVars['aMenu']['module'].'.'.$this->_aVars['aMenu']['var_name']); ?></a></li>
<?php endforeach; endif; ?>
<?php if (Phpfox ::getUserParam('core.can_design_dnd')): ?>
		<li>
<?php if (! Phpfox ::getService('theme')->isInDnDMode()): ?>
				<a href="#" onclick="$.ajaxCall('core.designdnd', 'enable=1&amp;inline=1'); return false;">
<?php echo Phpfox::getPhrase('core.enable_dnd_mode'); ?>
				</a>
<?php else: ?>
				<a href="#" onclick="$.ajaxCall('core.designdnd', 'enable=2&amp;inline=1'); return false;">
<?php echo Phpfox::getPhrase('core.disable_dnd_mode'); ?>
				</a>
<?php endif; ?>
		</li>
<?php endif; ?>
	</ul>
<?php endif; ?>
