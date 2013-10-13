<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: index.html.php 5844 2013-05-09 08:00:59Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if !count($aItems)}
<div class="extra_info">
	{phrase var='blog.no_blogs_found'}
</div>
{else}
{foreach from=$aItems name=blog item=aItem}
	{item name='BlogPosting'}
		{template file='blog.block.entry'}
	{/item}
{/foreach}
{if Phpfox::getUserParam('blog.can_approve_blogs') || Phpfox::getUserParam('blog.delete_user_blog')}
{moderation}
{/if}
{unset var=$aItems}
{pager}
{/if}