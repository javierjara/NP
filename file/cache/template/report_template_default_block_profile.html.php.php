<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: profile.html.php 5077 2012-12-13 09:05:45Z Raymond_Benc $
 */
 
 

 if (Phpfox ::isModule('report')):  if ($this->_aVars['aUser']['user_id'] != Phpfox ::getUserId() || isset ( $this->_aVars['bShowRssFeedForUser'] )): ?>
<div class="pages_view_sub_menu">
	<ul>
<?php if ($this->_aVars['aUser']['user_id'] != Phpfox ::getUserId()): ?><li><a href="#?call=report.add&amp;height=220&amp;width=400&amp;type=user&amp;id=<?php echo $this->_aVars['aUser']['user_id']; ?>" class="inlinePopup" title="<?php echo Phpfox::getPhrase('report.report_this_user'); ?>"><?php echo Phpfox::getPhrase('report.report_this_user'); ?></a></li><?php endif; ?>
<?php if (isset ( $this->_aVars['bShowRssFeedForUser'] )): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''.$this->_aVars['aUser']['user_name'].'.rss'); ?>" class="no_ajax_link"><?php echo Phpfox::getPhrase('rss.subscribe_via_rss'); ?></a></li>
<?php endif; ?>
	</ul>
</div>
<?php endif;  endif; ?>
