<h3>{phrase var='contactimporter.import_email_contact_list'}</h3>
         <p class="description">{phrase var='contactimporter.get_contact_description_email'}.</p>     
          {if $plugType == 'email'}
                 {if $errors != ''}
                   {foreach from= $errors  item=er}
                     <div id="errros_div_h" ><ul class='form-errors'>
                     <li><ul class='errors'><li>{$er}</li></ul></li></ul></div>
                   {/foreach}
                 {/if}
         		{/if}
           
          <ul class="mail_list">
                     <?php $num=0;?>
						{foreach from=$top_5_email item = email}
                        {if $email.logo !=''}
                           
                 <?php $num++;if ($num <=5):?>
               <form id="get_contact_email" onsubmit="sending_request();return do_submit();" enctype="" class="global_form" action="" method="post" autocomplete="off" >                                                              
              <span id="form_{$email.name}"></span>
                <li class="trigger">
							<div class="logo">
								<img src="{$core_url}module/contactimporter/static/image/{$email.logo}_status_up.png">
							</div>
               <span class="title">{$email.title}</span>
              </li>             
             <div class="form-elements toggle_container">             
						<div id="email_box-wrapper" class="form-wrapper">
							<div id="email_box-label" class="form-label">
								 <label for="email_box" class="required" >{phrase var='user.email'}&nbsp;</label>
							</div>
							<div id="email_box-element" class="form-element">
								<input type="text" name="email_box" id="email_box" value="" style="width:205px;">
							</div>							
                             <div id="provider_box-element2" class="form-element" style="display:none;">
                                <input type='text' value={$email.default_domain} name='tmp' id='provider_box_mail2' style='width:80px;' autocomplete ="OFF"/>
                                <input type='hidden' value='' id='provider_box_input2' name='provider_box2'/>
                                <input type='hidden' value="{$email.name}" id='provider_box_mail' name='provider_box'/>
                            </div>
						</div>
						<div id="password_box-wrapper" class="form-wrapper"  style="margin-bottom:3px">
							<div id="password_box-label" class="form-label" style="width:450px">
							<label for="password_box" class="required">{phrase var='user.password'}
							<input type="password" style="width:205px" name="password_box" id="password_box" value=""  />
							</label>
							</div>

						</div>
						<div id="import-element" class="form-element" style="clear:both;">
							<input class="button" name="import" id="import" type="submit" value="{phrase var='contactimporter.import_contact'}"/>
						</div>
					</div>
               </form>

                 <?php endif; ?>
                 {/if}
						{/foreach}
</ul>
