<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
	<div id="js_register_step1">
<?php (($sPlugin = Phpfox_Plugin::get('user.template_default_block_register_step1_3')) ? eval($sPlugin) : false); ?>
<?php if (Phpfox ::getParam('user.split_full_name')): ?>
		<div><input type="hidden" name="val[full_name]" id="full_name" value="stock" size="30" /></div>
		<div class="table">
			<div class="table_left">
				<label for="first_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.first_name'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[first_name]" id="first_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['first_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['first_name']) : (isset($this->_aVars['aForms']['first_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['first_name']) : '')); ?>
" size="30" />
			</div>			
		</div>		
		<div class="table">
			<div class="table_left">
				<label for="last_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.last_name'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[last_name]" id="last_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['last_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['last_name']) : (isset($this->_aVars['aForms']['last_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['last_name']) : '')); ?>
" size="30" />
			</div>			
		</div>		
		<div class="separate"></div>
<?php else: ?>
		<div class="table">
			<div class="table_left">
				<label for="full_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.full_name'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[full_name]" id="full_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['full_name']) : (isset($this->_aVars['aForms']['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['full_name']) : '')); ?>
" size="30" />
			</div>			
		</div>
<?php endif; ?>
<?php if (! Phpfox ::getParam('user.profile_use_id') && ! Phpfox ::getParam('user.disable_username_on_sign_up')): ?>
		<div class="table">
			<div class="table_left">
				<label for="user_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.choose_a_username'); ?>:</label>
			</div>
			<div class="table_right">                           
				<input type="text" name="val[user_name]" id="user_name" onkeyup="$('.bt-wrapper').remove(); $(this).ajaxCall('user.showUserName');" <?php if (Phpfox ::getParam('user.suggest_usernames_on_registration')): ?>onfocus="$('#btn_verify_username').slideDown()"<?php endif; ?> title="<?php echo Phpfox::getPhrase('user.your_username_is_used_to_easily_connect_to_your_profile'); ?>" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['user_name']) : (isset($this->_aVars['aForms']['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['user_name']) : '')); ?>
" size="30" autocomplete="off" />				
				<div class="p_4">
<?php echo Phpfox::getLib('phpfox.url')->makeUrl(''); ?><strong id="js_signup_user_name"><?php echo Phpfox::getPhrase('user.your_user_name'); ?></strong>/
				</div>
				<div id="js_user_name_error_message"></div>
				<div style="display:none;" id="js_verify_username"></div>
<?php if (Phpfox ::getParam('user.suggest_usernames_on_registration')): ?>
				<div class="p_4" style="display:none;" id="btn_verify_username">
					<a href="#" onclick="$(this).ajaxCall('user.verifyUserName', 'user_name='+$('#user_name').val(), 'GET'); return false;"><?php echo Phpfox::getPhrase('user.check_availability'); ?></a>
				</div>
<?php endif; ?>
			</div>			
		</div>		
<?php endif; ?>
<?php if (Phpfox ::getParam('user.reenter_email_on_signup')): ?>
		<div class="separate"></div>
<?php endif; ?>
		<div class="table">
			<div class="table_left">
				<label for="email"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.email'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[email]" id="email" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" size="30" />
			</div>			
		</div>
<?php if (Phpfox ::getParam('user.reenter_email_on_signup')): ?>
		<div class="table">
			<div class="table_left"></div>
			<div class="table_right">
				<strong><?php echo Phpfox::getPhrase('user.please_reenter_your_email_again_below'); ?></strong>
				<div class="p_top_8">
					<input type="text" name="val[confirm_email]" id="confirm_email" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['confirm_email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['confirm_email']) : (isset($this->_aVars['aForms']['confirm_email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['confirm_email']) : '')); ?>
" size="30" onblur="$('#js_form').ajaxCall('user.confirmEmail');" />
				</div>
				<div id="js_confirm_email_error" style="display:none;"><div class="error_message"><?php echo Phpfox::getPhrase('user.email_s_do_not_match'); ?></div></div>
			</div>			
		</div>				
		<div class="separate"></div>
<?php endif; ?>

<?php (($sPlugin = Phpfox_Plugin::get('user.template_default_block_register_step1_5')) ? eval($sPlugin) : false); ?>
		<div class="table">
			<div class="table_left">
				<label for="password"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.password'); ?>:</label>
			</div>
			<div class="table_right">
<?php if (isset ( $this->_aVars['bIsPosted'] )): ?>
				<input type="password" name="val[password]" id="password" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['password']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['password']) : (isset($this->_aVars['aForms']['password']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['password']) : '')); ?>
" size="30" />
<?php else: ?>
				<input type="password" name="val[password]" id="password" value="" size="30" />
<?php endif; ?>
			</div>			
		</div>
<?php (($sPlugin = Phpfox_Plugin::get('user.template_default_block_register_step1_4')) ? eval($sPlugin) : false); ?>
	</div>
