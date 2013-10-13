<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: pic.html.php 6083 2013-06-17 15:48:53Z Raymond_Benc $
 */
 
 

 if (Phpfox ::getService('profile')->timeline()): ?>
<?php if (! empty ( $this->_aVars['sProfileImage'] )): ?>
	    <div class="profile_timeline_profile_photo">
		    <div class="profile_image">
<?php if (Phpfox ::isModule('photo')): ?>
<?php if (isset ( $this->_aVars['aUser']['user_name'] )): ?>
				    <a href="<?php echo Phpfox::permalink('photo.album.profile', $this->_aVars['aUser']['user_id'], $this->_aVars['aUser']['user_name'], false, null, (array) array (
)); ?>"><?php echo $this->_aVars['sProfileImage']; ?></a>
<?php else: ?>
				    <a href="<?php echo Phpfox::permalink('photo.album.profile', $this->_aVars['aUser']['user_id'], null, false, null, (array) array (
)); ?>"><?php echo $this->_aVars['sProfileImage']; ?></a>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_aVars['sProfileImage']; ?>
<?php endif; ?>
<?php if (Phpfox ::getUserId() == $this->_aVars['aUser']['user_id']): ?>
			    <div class="p_4">
				    <a href="<?php if (isset ( $this->_aVars['aPage'] ) && isset ( $this->_aVars['aPage']['page_id'] )):  echo Phpfox::getLib('phpfox.url')->makeUrl('pages.add', array('id' => $this->_aVars['aPage']['page_id'])); ?>#photo<?php else:  echo Phpfox::getLib('phpfox.url')->makeUrl('user.photo');  endif; ?>"><?php echo Phpfox::getPhrase('profile.change_picture'); ?></a>
			    </div>
<?php endif; ?>

		    </div>

			<div style="position:absolute; bottom:0px; z-index:100; width:100%;">
<?php if (isset ( $this->_aVars['aUser']['user_name'] )): ?>
<?php if (isset ( $this->_aVars['aPage']['title'] )): ?>

				<?php
						Phpfox::getLib('template')->getBuiltFile('pages.block.joinpage');						
						?>

<?php endif; ?>
<?php endif; ?>
			</div>

	    </div>
<?php endif; ?>

<?php else:  if (! empty ( $this->_aVars['sProfileImage'] )): ?>
    <div class="profile_image">
	<div class="profile_image_holder">
<?php if (Phpfox ::isModule('photo')): ?>
<?php if (isset ( $this->_aVars['aUser']['user_name'] )): ?>
		    <a href="<?php echo Phpfox::permalink('photo.album.profile', $this->_aVars['aUser']['user_id'], $this->_aVars['aUser']['user_name'], false, null, (array) array (
)); ?>"><?php echo $this->_aVars['sProfileImage']; ?></a>
<?php else: ?>
		    <a href="<?php echo Phpfox::permalink('photo.album.profile', $this->_aVars['aUser']['user_id'], null, false, null, (array) array (
)); ?>"><?php echo $this->_aVars['sProfileImage']; ?></a>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_aVars['sProfileImage']; ?>
<?php endif; ?>
	</div>
<?php if (Phpfox ::getUserId() == $this->_aVars['aUser']['user_id']): ?>
	    <div class="p_4">
		    <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.photo'); ?>"><?php echo Phpfox::getPhrase('profile.change_picture'); ?></a>
	    </div>
<?php endif; ?>



    </div>

<?php endif; ?>
<div class="sub_section_menu">
	<ul>		
<?php if (count((array)$this->_aVars['aProfileLinks'])):  foreach ((array) $this->_aVars['aProfileLinks'] as $this->_aVars['aProfileLink']): ?>
			<li class="<?php if (isset ( $this->_aVars['aProfileLink']['is_selected'] )): ?> active<?php endif; ?>">
				<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aProfileLink']['url']); ?>" class="ajax_link"<?php if (isset ( $this->_aVars['aProfileLink']['icon'] )): ?> style="background-image:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => $this->_aVars['aProfileLink']['icon'],'return_url' => true)); ?>');"<?php endif; ?>><?php echo $this->_aVars['aProfileLink']['phrase'];  if (isset ( $this->_aVars['aProfileLink']['total'] )): ?><span>(<?php echo number_format($this->_aVars['aProfileLink']['total']); ?>)</span><?php endif; ?></a>
<?php if (isset ( $this->_aVars['aProfileLink']['sub_menu'] ) && is_array ( $this->_aVars['aProfileLink']['sub_menu'] ) && count ( $this->_aVars['aProfileLink']['sub_menu'] )): ?>
				<ul>
<?php if (count((array)$this->_aVars['aProfileLink']['sub_menu'])):  foreach ((array) $this->_aVars['aProfileLink']['sub_menu'] as $this->_aVars['aProfileLinkSub']): ?>
					<li class="<?php if (isset ( $this->_aVars['aProfileLinkSub']['is_selected'] )): ?> active<?php endif; ?>"><a href="<?php echo $this->_aVars['aProfileLinkSub']['url']; ?>"><?php echo $this->_aVars['aProfileLinkSub']['phrase'];  if (isset ( $this->_aVars['aProfileLinkSub']['total'] ) && $this->_aVars['aProfileLinkSub']['total'] > 0): ?><span class="pending"><?php echo number_format($this->_aVars['aProfileLinkSub']['total']); ?></span><?php endif; ?></a></li>
<?php endforeach; endif; ?>
				</ul>
<?php endif; ?>
			</li>
<?php endforeach; endif; ?>
	</ul>
</div>
<?php endif; ?>

    <div class="clear"></div>
    <div class="js_cache_check_on_content_block" style="display:none;"></div>
    <div class="js_cache_profile_id" style="display:none;"><?php echo $this->_aVars['aUser']['user_id']; ?></div>
    <div class="js_cache_profile_user_name" style="display:none;"><?php if (isset ( $this->_aVars['aUser']['user_name'] )):  echo $this->_aVars['aUser']['user_name'];  endif; ?></div>
