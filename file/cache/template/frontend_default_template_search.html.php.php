<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 12:36 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: search.html.php 6361 2013-07-25 08:37:06Z Raymond_Benc $
 */



 if (! defined ( 'PHPFOX_IS_FORCED_404' ) && ! empty ( $this->_aVars['aSearchTool'] ) && is_array ( $this->_aVars['aSearchTool'] )): ?>
	<div class="header_bar_menu">
<?php if (isset ( $this->_aVars['aSearchTool']['search'] )): ?>
			<div class="header_bar_search">
				<form method="post" action="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSearchTool']['search']['action']); ?>" onbeforesubmit="$Core.Search.checkDefaultValue(this,'<?php echo $this->_aVars['aSearchTool']['search']['default_value']; ?>');">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div>
						<input type="hidden" name="search[submit]" value="1" />
					</div>
					<div class="header_bar_search_holder">
						<div class="header_bar_search_default"><?php echo $this->_aVars['aSearchTool']['search']['default_value']; ?></div>
						<input type="text" class="txt_input<?php if (isset ( $this->_aVars['aSearchTool']['search']['actual_value'] )): ?> input_focus<?php endif; ?>" name="search[<?php echo $this->_aVars['aSearchTool']['search']['name']; ?>]" value="<?php if (isset ( $this->_aVars['aSearchTool']['search']['actual_value'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSearchTool']['search']['actual_value']);  else:  echo $this->_aVars['aSearchTool']['search']['default_value'];  endif; ?>" />
						<div class="header_bar_search_input"></div>
					</div>
					<div id="js_search_input_holder">
						<div id="js_search_input_content">
<?php if (isset ( $this->_aVars['sModuleForInput'] )): ?>
<?php Phpfox::getBlock('input.add', array('module' => $this->_aVars['sModuleForInput'],'bAjaxSearch' => true)); ?>
<?php endif; ?>
						</div>
					</div>
				
</form>

			</div>
<?php endif; ?>

<?php if (! Phpfox ::isMobile() && isset ( $this->_aVars['aSearchTool']['filters'] ) && count ( $this->_aVars['aSearchTool']['filters'] )): ?>
			<div class="header_filter_holder">
<?php if (count((array)$this->_aVars['aSearchTool']['filters'])):  foreach ((array) $this->_aVars['aSearchTool']['filters'] as $this->_aVars['sSearchFilterName'] => $this->_aVars['aSearchFilters']): ?>
<?php if (! isset ( $this->_aVars['aSearchFilters']['is_input'] )): ?>
						<div class="header_bar_float">
							<div class="header_bar_drop_holder">
								<ul class="header_bar_drop">
									<li><span><?php echo $this->_aVars['sSearchFilterName']; ?>:</span></li>
									<li><a href="#" class="header_bar_drop"><?php if (isset ( $this->_aVars['aSearchFilters']['active_phrase'] )):  echo $this->_aVars['aSearchFilters']['active_phrase'];  else:  echo $this->_aVars['aSearchFilters']['default_phrase'];  endif; ?></a></li>
								</ul>
								<div class="clear"></div>
								<div class="action_drop_holder">
									<ul class="action_drop"<?php if (isset ( $this->_aVars['aSearchFilters']['height'] )): ?> style="height:<?php echo $this->_aVars['aSearchFilters']['height']; ?>; overflow:auto;"<?php endif; ?>>
<?php if (count((array)$this->_aVars['aSearchFilters']['data'])):  foreach ((array) $this->_aVars['aSearchFilters']['data'] as $this->_aVars['aSearchFilter']): ?>
										<li>
											<a href="<?php echo $this->_aVars['aSearchFilter']['link']; ?>" class="ajax_link <?php if (isset ( $this->_aVars['aSearchFilter']['is_active'] )): ?>active<?php endif; ?>"<?php if (isset ( $this->_aVars['aSearchFilters']['width'] )): ?> style="width:<?php echo $this->_aVars['aSearchFilters']['width']; ?>;"<?php endif; ?> <?php if (isset ( $this->_aVars['aSearchFilter']['nofollow'] )): ?>rel="nofollow"<?php endif; ?>>
<?php echo $this->_aVars['aSearchFilter']['phrase']; ?>
											</a>
										</li>
<?php endforeach; endif; ?>
									</ul>
								</div>
							</div>
						</div>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php if (Phpfox ::isModule('input') && isset ( $this->_aVars['bHasInputs'] ) && $this->_aVars['bHasInputs'] == true): ?>
					<a href="#" onclick="$('#js_search_input_holder').show(); return false;" class="header_bar_advanced_filters">
<?php echo Phpfox::getPhrase('input.advanced_filters'); ?>
					</a>
<?php endif; ?>
				<div class="clear"></div>
			</div>

<?php endif; ?>
	</div>
<?php endif; ?>


