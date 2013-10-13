<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:39 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: login.html.php 3445 2011-11-03 13:11:23Z Raymond_Benc $
 */
 
 

 echo $this->_aVars['sCreateJs']; ?>
<div class="main_break">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("user.login"); ?>" id="js_login_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div class="table">
			<div class="table_left">
				<label for="login"><?php if (Phpfox ::getParam('user.login_type') == 'user_name'):  echo Phpfox::getPhrase('user.user_name');  elseif (Phpfox ::getParam('user.login_type') == 'email'):  echo Phpfox::getPhrase('user.email');  else:  echo Phpfox::getPhrase('user.login');  endif; ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[login]" id="login" value="<?php echo $this->_aVars['sDefaultEmailInfo']; ?>" size="40" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
				<label for="password"><?php echo Phpfox::getPhrase('user.password'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="password" name="val[password]" id="password" value="" size="40" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table_clear">
			<label><input type="checkbox" class="checkbox" name="val[remember_me]" value="" /> <?php echo Phpfox::getPhrase('user.remember'); ?></label>
		</div>
		
<?php (($sPlugin = Phpfox_Plugin::get('user.template_controller_login_end')) ? eval($sPlugin) : false); ?>
		
		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('user.login_button'); ?>" class="button" /><?php if (Phpfox ::getParam('user.allow_user_registration')): ?> <?php echo Phpfox::getPhrase('user.sign_for_site_name', array('url' => $this->_aVars['sSignUpPage'],'name' => $this->_aVars['sSiteName']));  endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('user.template.login_header_set_var')) ? eval($sPlugin) : false); ?>
<?php if (isset ( $this->_aVars['bCustomLogin'] )): ?>
			<div class="p_top_8">
<?php echo Phpfox::getPhrase('user.or_login_with'); ?>:
				<div class="p_top_4">					
<?php (($sPlugin = Phpfox_Plugin::get('user.template_controller_login_block__end')) ? eval($sPlugin) : false); ?>
				</div>
			</div>
<?php endif; ?>
		</div>
		
		<div class="table_clear">
			<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.password.request'); ?>"><?php echo Phpfox::getPhrase('user.forgot_your_password'); ?></a>
		</div>	
	
</form>
	
</div>
