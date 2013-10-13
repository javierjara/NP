<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: register.html.php 5143 2013-01-15 14:16:21Z Miguel_Espinoza $
 */



 echo '
<script type="text/javascript">
$Behavior.termsAndPrivacy = function()
{
	$(\'#js_terms_of_use\').click(function()
	{
		'; ?>

		tb_show('<?php echo Phpfox::getPhrase('user.terms_of_use', array('phpfox_squote' => true)); ?>', $.ajaxBox('page.view', 'height=410&width=600&title=terms')); 
		<?php echo '
		return false;
	});
	
	$(\'#js_privacy_policy\').click(function()
	{
		'; ?>

		tb_show('<?php echo Phpfox::getPhrase('user.privacy_policy', array('phpfox_squote' => true)); ?>', $.ajaxBox('page.view', 'height=410&width=600&title=policy')); 
		<?php echo '
		return false;
	});
}
</script>
'; ?>


<?php if (Phpfox ::getLib('module')->getFullControllerName() == 'user.register' && Phpfox ::isModule('invite')): ?>
<div id="main_registration_form">

	<h1><?php echo Phpfox::getPhrase('user.sign_up_for_ssitetitle', array('sSiteTitle' => $this->_aVars['sSiteTitle'])); ?></h1>
	<div class="extra_info">
<?php echo Phpfox::getPhrase('user.join_ssitetitle_to_connect_with_friends_share_photos_and_create_your_own_profile', array('sSiteTitle' => $this->_aVars['sSiteTitle'])); ?>
	</div>
	<div id="main_registration_form_holder">
<?php if (( ( Phpfox ::isModule('facebook') && Phpfox ::getParam('facebook.enable_facebook_connect')) || ( Phpfox ::isModule('janrain') && Phpfox ::getParam('janrain.enable_janrain_login'))) && ! Phpfox ::getService('invite')->isInviteOnly()): ?>
		<div id="main_registration_custom">
<?php echo Phpfox::getPhrase('user.or_sign_up_with'); ?>:
<?php if (Phpfox ::isModule('facebook') && Phpfox ::getParam('facebook.enable_facebook_connect')): ?>
			<div class="header_login_block">
				<fb:login-button scope="publish_stream,email,user_birthday" v="2"></fb:login-button>
			</div>
<?php endif; ?>
<?php if (Phpfox ::isModule('janrain') && Phpfox ::getParam('janrain.enable_janrain_login')): ?>
			<div class="header_login_block">
				<a class="rpxnow" onclick="return false;" href="<?php echo $this->_aVars['sJanrainUrl']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/janrain-icons.png')); ?></a>
			</div>
<?php endif; ?>
		</div>
<?php endif;  endif;  if (Phpfox ::getLib('module')->getFullControllerName() != 'user.register'): ?>
<div class="user_register_holder">
	<div class="holder">
		<div class="user_register_intro">		
<?php Phpfox::getBlock('user.welcome', array()); ?>
		</div>
		<div class="user_register_form">

<?php if (Phpfox ::getParam('user.allow_user_registration')): ?>
			<div class="user_register_title">
<?php echo Phpfox::getPhrase('user.sign_up'); ?>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('user.it_s_free_and_always_will_be'); ?>
				</div>
			</div>
<?php endif;  endif; ?>
<?php if (Phpfox ::isModule('invite') && Phpfox ::getService('invite')->isInviteOnly()): ?>
		<div class="main_break">
			<div class="extra_info">				
<?php echo Phpfox::getPhrase('user.ssitetitle_is_an_invite_only_community_enter_your_email_below_if_you_have_received_an_invitation', array('sSiteTitle' => $this->_aVars['sSiteTitle'])); ?>
			</div>
			<div class="main_break">
				<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.register'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div class="table">
						<div class="table_left">
<?php echo Phpfox::getPhrase('user.email'); ?>:
						</div>
						<div class="table_right">
							<input type="text" name="val[invite_email]" value="" />
						</div>
					</div>
					<div class="table_clear">
						<input type="submit" value="<?php echo Phpfox::getPhrase('user.submit'); ?>" class="button_register" />
					</div>
				
</form>

			</div>
		</div>
<?php else: ?>
<?php if (isset ( $this->_aVars['sCreateJs'] )): ?>
<?php echo $this->_aVars['sCreateJs']; ?>
<?php endif; ?>
		<div id="js_registration_process" class="t_center" style="display:none;">
			<div class="p_top_8">				
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','alt' => '')); ?>
			</div>
		</div>
		<div id="js_signup_error_message" style="width:350px;"></div>
<?php if (Phpfox ::getParam('user.allow_user_registration')): ?>
			<div class="main_break" id="js_registration_holder">	
				<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.register'); ?>" id="js_form" enctype="multipart/form-data">	
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>

					<div id="js_signup_block">
<?php if (isset ( $this->_aVars['bIsPosted'] ) || ! Phpfox ::getParam('user.multi_step_registration_form')): ?>
						<div>
							<?php
						Phpfox::getLib('template')->getBuiltFile('user.block.register.step1');						
						?>
							<?php
						Phpfox::getLib('template')->getBuiltFile('user.block.register.step2');						
						?>
						</div>
<?php else: ?>
							<?php
						Phpfox::getLib('template')->getBuiltFile('user.block.register.step1');						
						?>			
<?php endif; ?>
					</div>		
<?php (($sPlugin = Phpfox_Plugin::get('user.template_controller_register_pre_captcha')) ? eval($sPlugin) : false); ?>
<?php if (Phpfox ::isModule('captcha') && Phpfox ::getParam('user.captcha_on_signup')): ?>
					<div id="js_register_capthca_image"<?php if (Phpfox ::getParam('user.multi_step_registration_form') && ! isset ( $this->_aVars['bIsPosted'] )): ?> style="display:none;"<?php endif; ?>>
<?php Phpfox::getBlock('captcha.form', array()); ?>
					</div>
<?php endif; ?>
					
<?php if (Phpfox ::getParam('user.new_user_terms_confirmation')): ?>
					<div id="js_register_accept">
						<div class="table">			
							<div class="table_clear">
								<input type="checkbox" name="val[agree]" id="agree" value="1" class="checkbox v_middle" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('agree') && in_array('agree', $this->_aVars['aForms']))
							
{
								echo ' checked="checked" ';
							}

							if (isset($aParams['agree'])
								&& $aParams['agree'] == '1')

							{

								echo ' checked="checked" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['agree'])
									&& !isset($aParams['agree'])
									&& $this->_aVars['aForms']['agree'] == '1')
								{
								 echo ' checked="checked" ';
								}
								else
								{
									echo "";
								}
							}
							?>
/> <?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.i_have_read_and_agree_to_the_a_href_id_js_terms_of_use_terms_of_use_a_and_a_href_id_js_privacy_policy_privacy_policy_a'); ?>					
							</div>			
						</div>	
					</div>					
<?php endif; ?>
					
					<div class="table_clear">
<?php if (isset ( $this->_aVars['bIsPosted'] ) || ! Phpfox ::getParam('user.multi_step_registration_form')): ?>
						<input type="submit" value="<?php echo Phpfox::getPhrase('user.sign_up'); ?>" class="button_register" id="js_registration_submit" />
<?php else: ?>
						<input type="button" value="<?php echo Phpfox::getPhrase('user.sign_up'); ?>" class="button_register" id="js_registration_submit" onclick="$Core.registration.submitForm();" />
<?php endif; ?>
					</div>
				
</form>

			</div>
<?php endif; ?>
<?php endif;  if (Phpfox ::getLib('module')->getFullControllerName() != 'user.register'): ?>
		</div>
		<div class="clear"></div>
	</div>
<?php Phpfox::getBlock('user.images', array()); ?>
</div>
<?php endif;  if (Phpfox ::getLib('module')->getFullControllerName() == 'user.register'): ?>
	</div>
</div>
<?php endif; ?>
