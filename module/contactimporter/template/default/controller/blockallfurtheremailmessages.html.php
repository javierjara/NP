<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h1>{phrase var='contactimporter.contact_importer'}</h1>
{phrase var='contactimporter.block_all_further_email_messages' signup=$SignUp login=$login}
<p>{phrase var='contactimporter.you_can_click'} <a  title="Subscribe Your Email" class="inlinePopup" href="#?call=contactimporter.subscribe&amp;width=300&amp;height=300&amp;email={$email}">{phrase var='contactimporter.subscribe'}</a> {phrase var='contactimporter.to_receive_the_further_email_messages'} </p>
