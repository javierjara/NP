<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:40 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Captcha
 * @version 		$Id: form.html.php 6264 2013-07-15 12:12:21Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['bCaptchaPopup'] ) && $this->_aVars['bCaptchaPopup']): ?>
<div id="js_captcha_load_for_check">
	<form method="post" action="#" id="js_captcha_load_for_check_submit">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>';  endif; ?>
<div class="table_clear">
	<div class="captcha_holder">
		<div class="captcha_title"><?php echo Phpfox::getPhrase('captcha.captcha_challenge'); ?></div>
<?php if (Phpfox ::getParam('captcha.recaptcha')): ?>
			<div id="js_recaptcha_holder" style="direction:ltr;">
<?php echo $this->_aVars['sCaptchaData']; ?>
			</div>
<?php else: ?>
			<div class="go_left">
				<a href="#" onclick="$('#js_captcha_process').html($.ajaxProcess('<?php echo Phpfox::getPhrase('captcha.refreshing_image', array('phpfox_squote' => true)); ?>')); $('#js_captcha_image').ajaxCall('captcha.reload', 'sId=js_captcha_image&amp;sInput=image_verification'); return false;"><img src="<?php echo $this->_aVars['sImage']; ?>" alt="<?php echo Phpfox::getPhrase('captcha.reload_image'); ?>" id="js_captcha_image" class="captcha" title="<?php echo Phpfox::getPhrase('captcha.click_refresh_image'); ?>" /></a>
			</div>
			<a href="#" onclick="$('#js_captcha_process').html($.ajaxProcess('<?php echo Phpfox::getPhrase('captcha.refreshing_image', array('phpfox_squote' => true)); ?>')); $('#js_captcha_image').ajaxCall('captcha.reload', 'sId=js_captcha_image&amp;sInput=image_verification'); return false;" title="<?php echo Phpfox::getPhrase('captcha.click_refresh_image', array('phpfox_squote' => true)); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/reload.gif','alt' => 'Reload')); ?></a>		
			<span id="js_captcha_process"></span>
			<div class="clear"></div>
			<div class="captcha_form">
				<input type="text" name="val[image_verification]" size="10" id="image_verification" />
				<div class="extra_info">
<?php echo Phpfox::getPhrase('captcha.type_verification_code_above'); ?>
				</div>
			</div>
			<script type="text/javascript">
				$Behavior.loadImageVerification = function(){
					$('#image_verification').attr('autocomplete', 'off');
				}
			</script>
<?php endif; ?>
	</div>
</div>
<?php if (isset ( $this->_aVars['bCaptchaPopup'] ) && $this->_aVars['bCaptchaPopup']): ?>
		<ul class="table_clear_button">
			<li><input type="submit" value="Submit" class="button" /></li>
			<li><input type="button" value="Cancel" class="button button_off" onclick="$('#js_captcha_load_for_check').hide();" /></li>
		</ul>
	
</form>

</div>
<?php endif; ?>
