<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.html.php 2284 2011-02-01 15:58:18Z Raymond_Benc $
 */
 
 

?>
				<div class="global_attachment_holder_section" id="global_attachment_photo">
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_block_share_1')) ? eval($sPlugin) : false); ?>
					<div><input type="hidden" name="val[group_id]" value="<?php if (isset ( $this->_aVars['aFeedCallback']['item_id'] )):  echo $this->_aVars['aFeedCallback']['item_id'];  else: ?>0<?php endif; ?>" /></div>			
					<div><input type="hidden" name="val[action]" value="upload_photo_via_share" /></div>					
						<div id="divFileInput"><input type="file" name="image[]" id="global_attachment_photo_file_input" value="" onchange="$bButtonSubmitActive = true; $('.activity_feed_form_button .button').removeClass('button_not_active');" /></div>
						<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.select_a_photo_to_attach'); ?>
						</div>						
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_block_share_2')) ? eval($sPlugin) : false); ?>
				</div>		
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_block_share_3')) ? eval($sPlugin) : false); ?>
