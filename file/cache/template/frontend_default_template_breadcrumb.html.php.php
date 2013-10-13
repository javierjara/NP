<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: breadcrumb.html.php 5844 2013-05-09 08:00:59Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aBreadCrumbs'] )): ?>
<div id="breadcrumb_holder"<?php if (! $this->_aVars['bIsUsersProfilePage'] && count ( $this->_aVars['aSubMenus'] )): ?> class="has_section_menu"<?php endif; ?> itemscope itemtype="http://schema.org/WebPage">
	<div id="breadcrumb_content" itemprop="breadcrumb">
<?php if (empty ( $this->_aVars['aBreadCrumbTitle'] )): ?>
<?php if (count((array)$this->_aVars['aBreadCrumbs'])):  $this->_aPhpfoxVars['iteration']['link'] = 0;  foreach ((array) $this->_aVars['aBreadCrumbs'] as $this->_aVars['sLink'] => $this->_aVars['sCrumb']):  $this->_aPhpfoxVars['iteration']['link']++; ?>

<?php if ($this->_aPhpfoxVars['iteration']['link'] == 1): ?>
<?php if (count ( $this->_aVars['aBreadCrumbTitle'] )): ?><div class="h1"><?php else: ?><h1><?php endif;  if (! empty ( $this->_aVars['sLink'] )): ?><a href="<?php echo $this->_aVars['sLink']; ?>" class="ajax_link"><?php endif;  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['sCrumb']);  if (! empty ( $this->_aVars['sLink'] )): ?></a><?php endif;  if (count ( $this->_aVars['aBreadCrumbTitle'] )): ?></div><?php else: ?></h1><?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
<?php Phpfox::getBlock('core.template-breadcrumblist'); ?>
	</div>	
<?php Phpfox::getBlock('core.template-breadcrumbmenu'); ?>
</div>
<?php endif; ?>
