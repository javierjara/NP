<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Share
 * @version 		$Id: link.html.php 4154 2012-05-07 14:32:57Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['sBookmarkDisplay'] == 'menu'): ?>
<li class="sub_menu_bar_li"><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('share.share', array('phpfox_squote' => true)); ?>', $.ajaxBox('share.popup', 'height=300&amp;width=550&amp;type=<?php echo $this->_aVars['sBookmarkType']; ?>&amp;url=<?php echo $this->_aVars['sBookmarkUrl']; ?>&amp;title=<?php echo $this->_aVars['sBookmarkTitle'];  if (isset ( $this->_aVars['sFeedShareId'] ) && $this->_aVars['sFeedShareId'] > 0): ?>&amp;feed_id=<?php echo $this->_aVars['sFeedShareId'];  endif;  if (isset ( $this->_aVars['sFeedType'] )): ?>&amp;is_feed_view=1<?php endif; ?>&amp;sharemodule=<?php echo $this->_aVars['sShareModuleId']; ?>')); return false;"<?php if ($this->_aVars['bIsFirstLink']): ?> class="first"<?php endif; ?>><?php echo Phpfox::getPhrase('share.share'); ?></a></li>
<?php elseif ($this->_aVars['sBookmarkDisplay'] == 'menu_link'): ?>
<li><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('share.share', array('phpfox_squote' => true)); ?>', $.ajaxBox('share.popup', 'height=300&amp;width=550&amp;type=<?php echo $this->_aVars['sBookmarkType']; ?>&amp;url=<?php echo $this->_aVars['sBookmarkUrl']; ?>&amp;title=<?php echo $this->_aVars['sBookmarkTitle']; ?>')); return false;"<?php if ($this->_aVars['bIsFirstLink']): ?> class="first"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'icon/share.png','class' => 'item_bar_image')); ?> <?php echo Phpfox::getPhrase('share.share'); ?></a></li>
<?php elseif ($this->_aVars['sBookmarkDisplay'] == 'image'): ?>
<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('share.share', array('phpfox_squote' => true)); ?>', $.ajaxBox('share.popup', 'height=300&amp;width=350&amp;type=<?php echo $this->_aVars['sBookmarkType']; ?>&amp;url=<?php echo $this->_aVars['sBookmarkUrl']; ?>&amp;title=<?php echo $this->_aVars['sBookmarkTitle']; ?>')); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/icn_share.png','class' => 'v_middle')); ?> <?php echo Phpfox::getPhrase('share.share'); ?></a>
<?php else: ?>
<a href="#"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/add.png','alt' => '','style' => 'vertical-align:middle;')); ?></a> <a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('share.share', array('phpfox_squote' => true)); ?>', $.ajaxBox('share.popup', 'height=300&amp;width=350&amp;type=<?php echo $this->_aVars['sBookmarkType']; ?>&amp;url=<?php echo $this->_aVars['sBookmarkUrl']; ?>&amp;title=<?php echo $this->_aVars['sBookmarkTitle']; ?>')); return false;"><?php echo Phpfox::getPhrase('share.share'); ?></a>
<?php endif; ?>
