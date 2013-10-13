<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<?php if (count ( $this->_aVars['aBreadCrumbs'] ) > 1 || ! empty ( $this->_aVars['aBreadCrumbTitle'] )): ?>
<?php if ($this->_aVars['iBreadTotal'] = count ( $this->_aVars['aBreadCrumbs'] )):  endif; ?>
		<div id="breadcrumb_list">
			<ul>
<?php if (Phpfox ::isMobile()): ?>
				<li><a href="#" onclick="window.history.back(); return false;" class="mobile_back"><?php echo Phpfox::getPhrase('core.back'); ?></a></li>
<?php else: ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''); ?>" class="home" title="<?php echo Phpfox::getPhrase('core.home'); ?>"><?php echo Phpfox::getPhrase('core.home'); ?></a></li>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aBreadCrumbs'])):  $this->_aPhpfoxVars['iteration']['link'] = 0;  foreach ((array) $this->_aVars['aBreadCrumbs'] as $this->_aVars['sLink'] => $this->_aVars['sCrumb']):  $this->_aPhpfoxVars['iteration']['link']++; ?>

				<li><?php if (! empty ( $this->_aVars['sLink'] )): ?><a href="<?php echo $this->_aVars['sLink']; ?>" class="ajax_link<?php if ($this->_aPhpfoxVars['iteration']['link'] == '1'): ?> first<?php endif; ?>"><?php endif;  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['sCrumb']);  if (! empty ( $this->_aVars['sLink'] )): ?></a><?php endif; ?></li>
<?php if ($this->_aVars['iBreadTotal'] != $this->_aPhpfoxVars['iteration']['link']): ?><li>&raquo;</li><?php endif; ?>
<?php endforeach; endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
<?php endif; ?>
