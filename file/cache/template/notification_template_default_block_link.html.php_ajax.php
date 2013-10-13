<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 13, 2013, 1:28 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: link.html.php 6238 2013-07-12 09:44:30Z Miguel_Espinoza $
 */
 
 

 if (count ( $this->_aVars['aNotifications'] )): ?>
	<ul id="js_new_notification_holder_drop">
<?php if (count((array)$this->_aVars['aNotifications'])):  $this->_aPhpfoxVars['iteration']['notifications'] = 0;  foreach ((array) $this->_aVars['aNotifications'] as $this->_aVars['aNotification']):  $this->_aPhpfoxVars['iteration']['notifications']++; ?>

			<li id="js_notification_read_<?php echo $this->_aVars['aNotification']['notification_id']; ?>" class="holder_notify_drop_data<?php if ($this->_aPhpfoxVars['iteration']['notifications'] == 1): ?> first<?php endif; ?>"><a href="<?php echo $this->_aVars['aNotification']['link']; ?>" class="main_link<?php if (! $this->_aVars['aNotification']['is_seen']): ?> is_new<?php endif; ?>">
					<div class="drop_data_image">
<?php if (! isset ( $this->_aVars['aNotification']['no_profile_image'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aNotification'],'max_width' => '50','max_height' => '50','suffix' => '_50_square','no_link' => true)); ?>
<?php endif; ?>
					</div>
					<div class="drop_data_content">
<?php echo $this->_aVars['aNotification']['message']; ?>
						<div class="drop_data_time">
<?php if (! empty ( $this->_aVars['aNotification']['icon'] )): ?><img src="<?php echo $this->_aVars['aNotification']['icon']; ?>" alt="" class="v_middle" /> <?php endif;  echo Phpfox::getLib('date')->convertTime($this->_aVars['aNotification']['time_stamp']); ?>
						</div>
					</div>
					<div class="clear"></div>
				</a>
			</li>
<?php endforeach; endif; ?>
	</ul>
	<?php echo '
		<script type="text/javascript">	
			var $iTotalNotifications = parseInt($(\'#js_total_new_notifications\').html());
			var $iNewTotalNotifications = 0;
			$(\'#js_new_notification_holder_drop li\').each(function()
			{
				$iNewTotalNotifications++;
				$aNotificationOldHistory[$(this).attr(\'id\').replace(\'js_notification_read_\', \'\')] = true;		
			});
			
			$iTotalNotifications = parseInt(($iTotalNotifications - $iNewTotalNotifications));
			if ($iTotalNotifications < 0)
			{
				$iTotalNotifications = 0;
			}
			
			if ($iTotalNotifications === 0)
			{
				$(\'#js_total_new_notifications\').html(\'\').hide();	
			}
			else
			{
				$(\'#js_total_new_notifications\').html($iTotalNotifications);
			}	
		</script>
	'; ?>

<?php else: ?>
<div class="drop_data_empty">
<?php echo Phpfox::getPhrase('notification.no_new_notifications'); ?>
</div>
<?php endif; ?>
<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('notification'); ?>" class="holder_notify_drop_link"><?php echo Phpfox::getPhrase('notification.see_all_notifications'); ?></a>
