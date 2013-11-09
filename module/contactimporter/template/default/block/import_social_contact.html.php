				{if $plugType == 'social'}
                    {if $errors != ''}
                        {foreach from= $errors  item=er}
                            <div id="errros_div_h"><ul class='form-errors'>
								<li><ul class='errors'><li>{$er}</li></ul></li></ul>
							</div>

						{/foreach}
                    {/if}
            {/if}

          <ul class="mail_list">
					{foreach from=$top_5_social item = social}
          <form onsubmit="sending_request();" enctype="" class="global_form" action="" method="post">          
            <span id="form_{$social.name}"></span>
           <li class="trigger" onclick="choose_provider('provider_box_social', '{$social.name}');">
                     {if $social.name eq 'linkedin'}
                     <div onclick="" class="logo">
                         <a id="linkedinA" href="#?call=contactimporter.callLinkedIn&amp;height=80&amp;width=270" class="inlinePopup" title="{phrase var='contactimporter.linkedin_authorization'}"><img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/></a>

                     </div>

                     {else}
                         {if $social.name eq 'twitter' }
                             <div onclick="" class="logo">
                                 <a id="twitterA" href="#?call=contactimporter.callTwitter&amp;height=80&amp;width=270" class="inlinePopup" title="{phrase var='contactimporter.twitter_authorization'}"><img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/></a>

                             </div>
                         {else}
                      <div class="logo">
                        <img src="{$core_url}module/contactimporter/static/image/{$social.logo}_status_up.png"/>
                      </div>
                         {/if}
                     {/if}
               <span class="title">{$social.title}</span>
             </li>             
              <div class="form-elements toggle_container">
                          <div>
                            <div id="email_box-label" class="form-label">
                            <label for="email_box2" class="required">{phrase var='contactimporter.user'}&nbsp;</label>
                            </div>
                            <div>
                              <input type="text" name="email_box" value="" style="width:205px"/>
                            </div>
                          </div>
                          <div style="margin-top:10px" >
                            <div  id="email_box-label" class="form-label">
                            <label for="password_box2" class="required">{phrase var='user.password'}&nbsp;</label>
                            </div>
                            <div>
                              <input type="password" name="password_box" id="password_box" value="" style="width:205px"/>
                            </div>
                          </div>

                          <div id="import-element" class="form-element" style="margin-top:10px">                                      
                           <input type="hidden" name="provider_box" id="provider_box_social" value="{$social.name}" />
                               <div style=" vertical-align: middle;">
                          <input class="button" name="import" id="import" type="submit" style="margin-left:5px;margin-top:0px" value="{phrase var='contactimporter.import_contact'}" onclick="return checkRespones();"/>
                                  </div>
                          </div>
               </div>
           </form>         
					{/foreach}
     </ul>
     {if $uploadcsv eq 'uploadcsv'}
                 <div style="margin-bottom:5px;margin-left:10px" ><ul class='form-errors'>
               <li><ul class='errors'><li>{$error_message}</li></ul></li></ul>
               </div>
                 {/if}
    <ul class="othertools">

          <li class="trigger"><span>Other Tools</span></li>
                   <div class="toggle_container">
                  <p class="description">{phrase var='contactimporter.or'} <a href="{url link='invite'}">{phrase var='contactimporter.inviete_by_manually'}</a> </p>

                 <div id="uploadcsvform3" style="margin-bottom:10px">            
             <form onsubmit="sending_request();" enctype="multipart/form-data" class="global_form" action="{url link='contactimporter'}" method="post">
                 <div >
                   <span >&nbsp;  {phrase var='contactimporter.or'} {phrase var='contactimporter.upload_file_csv'} :
                   <input type="file" class="text" name="csvfile"/>

                   </span>
                   <div style="clear:both;margin-top:4px;margin-left:1px">
                     <input name="submit_button" type="submit" style="margin-left:5px;" class="button" value="{phrase var='contactimporter.read_contact'}" />

                   </div>
                 </div>
                 <div id="email_box-element" class="form-element">
                   <input type="hidden" name="uploadcsv" value="uploadcsv"/>
                 </div>
             </form>
                 </div>
              <h3></h3>
          </div>
 </ul>
 {literal}
<script type="text/javascript">
  $("#form_{/literal}{$type_email}{literal}").html($('#errros_div_h').html());
  $('#errros_div_h').hide();
 </script>
{/literal}