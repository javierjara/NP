<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: pager.html.php 5844 2013-05-09 08:00:59Z Raymond_Benc $
 */
 
 

?>
<div class="js_pager_view_more_link">
<?php if (isset ( $this->_aVars['iPagerNextPageCnt'] )): ?>
	<a href="<?php echo $this->_aVars['aPager']['nextAjaxUrlPager']; ?>" class="global_view_more<?php if (isset ( $this->_aVars['aPager']['lastAjaxUrl'] )): ?> no_ajax_link<?php endif; ?>" <?php if (isset ( $this->_aVars['aPager']['lastAjaxUrl'] )): ?>onclick="$Core.addUrlPager(this); $.ajaxCall('blog.viewMore', 'page=<?php echo $this->_aVars['iPagerNextPageCnt']; ?>&amp;do=' + $Core.getRequests(this, true), 'GET'); return false;"<?php endif; ?>><?php echo Phpfox::getPhrase('core.view_more'); ?></a>
<?php elseif (isset ( $this->_aVars['sAjax'] )): ?>
	<div class="pager_view_more_holder">
		<div class="pager_view_more_link">
<?php if (! empty ( $this->_aVars['aPager']['nextAjaxUrl'] )): ?>
			<a href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>" class="pager_view_more no_ajax_link" onclick="$.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['nextAjaxUrl'];  echo $this->_aVars['aPager']['sParamsAjax']; ?>', 'GET'); return false;">
<?php if (! empty ( $this->_aVars['aPager']['icon'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => $this->_aVars['aPager']['icon'],'class' => 'v_middle')); ?>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aPager']['phrase'] )):  echo $this->_aVars['aPager']['phrase'];  else:  echo Phpfox::getPhrase('core.view_more');  endif; ?>
			<span><?php echo Phpfox::getPhrase('core.displaying_of_total', array('displaying' => $this->_aVars['aPager']['displaying'],'total' => $this->_aVars['aPager']['totalRows'])); ?></span>
			</a>
<?php endif; ?>
		</div>			
	</div>
<?php else: ?>
<?php if (isset ( $this->_aVars['aPager'] ) && $this->_aVars['aPager']['totalPages'] > 1): ?>
<?php if (! defined ( 'PHPFOX_PAGER_FORCE_COUNT' )): ?>
	<div class="pager_links_holder">
		<div class="pager_links">
			<a class="pager_previous_link<?php if (! isset ( $this->_aVars['aPager']['prevUrl'] )): ?> pager_previous_link_not<?php endif; ?>" <?php if (! isset ( $this->_aVars['aPager']['prevUrl'] )): ?> href="#" onclick="return false;" <?php else:  if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['prevAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>"<?php endif;  endif; ?>><?php echo Phpfox::getPhrase('core.previous'); ?></a>
			<a class="pager_next_link<?php if (! isset ( $this->_aVars['aPager']['nextUrl'] )): ?> pager_next_link_not<?php endif; ?>" <?php if (! isset ( $this->_aVars['aPager']['nextUrl'] )): ?> href="#" onclick="return false;" <?php else:  if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['nextAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>"<?php endif;  endif; ?>><?php echo Phpfox::getPhrase('core.next'); ?></a>				
			<div class="clear"></div>
		</div>
		<span class="extra_info"><?php echo Phpfox::getPhrase('core.fromrow_torow_of_totalrows_results', array('fromRow' => number_format($this->_aVars['aPager']['fromRow']),'toRow' => number_format($this->_aVars['aPager']['toRow']),'totalRows' => number_format($this->_aVars['aPager']['totalRows']))); ?></span>
	</div>
<?php else: ?>
	<div class="pager_outer">
			<ul class="pager">
<?php if (! isset ( $this->_aVars['bIsMiniPager'] )): ?>
				<li class="pager_total"><?php echo Phpfox::getPhrase('core.page_x_of_x', array('current' => $this->_aVars['aPager']['current'],'total' => $this->_aVars['aPager']['totalPages'])); ?></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['firstUrl'] )): ?>
		<li class="first">
			<a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['firstUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['firstAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['firstUrl']; ?>"<?php endif; ?>>
<?php echo Phpfox::getPhrase('core.first'); ?>
			</a>
		</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['prevUrl'] )): ?>
		<li>
			<a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['prevAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>"<?php endif; ?>>
<?php echo Phpfox::getPhrase('core.previous'); ?>
			</a>
		</li>
<?php endif; ?>
<?php if (count((array)$this->_aVars['aPager']['urls'])):  $this->_aPhpfoxVars['iteration']['pager'] = 0;  foreach ((array) $this->_aVars['aPager']['urls'] as $this->_aVars['sLink'] => $this->_aVars['sPage']):  $this->_aPhpfoxVars['iteration']['pager']++; ?>

		<li <?php if (! isset ( $this->_aVars['aPager']['firstUrl'] ) && $this->_aPhpfoxVars['iteration']['pager'] == 1): ?> class="first"<?php endif; ?>>
			<a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['sLink']; ?>" onclick="<?php if ($this->_aVars['sLink']): ?>$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['sPage'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this);<?php endif; ?> return false;<?php else: ?>href="<?php if ($this->_aVars['sLink']):  echo $this->_aVars['sLink'];  else: ?>javascript:void(0);<?php endif;  endif; ?>"<?php if ($this->_aVars['aPager']['current'] == $this->_aVars['sPage']): ?> class="active"<?php endif; ?>>
<?php echo $this->_aVars['sPage']; ?>
			</a>
		</li>
<?php endforeach; endif; ?>
<?php if (isset ( $this->_aVars['aPager']['nextUrl'] )): ?>
		<li>
			<a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['nextAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>"<?php endif; ?>>
<?php echo Phpfox::getPhrase('core.next'); ?>
			</a>
		</li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['lastUrl'] )): ?><li><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['lastUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['lastAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['lastUrl']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('core.last'); ?></a></li><?php endif; ?>
			</ul>	
			<div class="clear"></div>		
	</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
</div>
