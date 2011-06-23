
<table width="100%">
    <tr>
        <td style="width:270px;">
            <?php print $this->bep_assets->icon('titles/bigjava-logo-ad-in') ?><br />
        </td>
        <td style="text-align:right;border-left:3px solid #9d9c9c;padding:5px;padding-left:30px;" id="login_cell">
            <?php print form_open('auth/login',array('class'=>'horizontal'))?>
                <fieldset>
                    <ol>
                        <li>
                            <label for="login_field"><?php print $login_field?>:</label>
                            <input type="text" name="login_field" id="login_field" class="text" value="<?php print $this->validation->login_field?>"/>
                        </li>
                        <li>
                            <label for="password"><?php print $this->lang->line('userlib_password')?>:</label>
                            <input type="password" name="password" id="password" class="text" />
                        </li>
                        <li>
                            <label for="remember"><?php print $this->lang->line('userlib_remember_me')?>?</label>
                            <?php print form_checkbox('remember','yes',$this->input->post('remember'))?>
                        </li>
                        <?php
                        // Only display captcha if needed
                        if($this->preference->item('use_login_captcha')):?>
                        <li class="captcha">
                            <label for="recaptcha_response_field"><?php print $this->lang->line('userlib_captcha')?>:</label>
                            <?php print $captcha?>
                        </li>
                        <?php endif;?>

                        <li class="submit" style="padding-left:0px;margin-left:0px;" >
                        	<div class="buttons" style="padding-left:0px;margin-left:0px;text-align:right;">

                        		<?php if($this->preference->item('allow_user_registration')):?>
                            		<a href="<?php print site_url('auth/register') ?>">
                            			<?php print $this->bep_assets->icon('titles/22/register') ?>
                            			<?php print $this->lang->line('userlib_register')?>
                            		</a>
                        		<?php endif;?>
                        		
                        		<a href="<?php print site_url('auth/forgotten_password') ?>">
                        			<?php print $this->bep_assets->icon('titles/22/forgot') ?>
                        			<?php print $this->lang->line('userlib_forgotten_password')?>
                        		</a>

                        		<button type="submit" class="positive" name="submit" value="submit">
                        			<?php print $this->bep_assets->icon('titles/22/gembok') ?>
                        			<?php print $this->lang->line('userlib_login')?>
                        		</button>
                        </li>
                    </ol>
                </fieldset>
            <?php print form_close()?>
        </td>
    </tr>
</table>
