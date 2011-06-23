<h3><?php print $header?></h3>
<?php print form_open('auth/register',array('class'=>'horizontal'))?>
    <fieldset>
        <ol>
            <li>
                <label for="username"><?php print $this->lang->line('userlib_username')?>:</label>
                <input type="text" name="username" id="username" size="32" class="text" value="<?php print $this->validation->username?>" />
            </li>
            <li>
                <label for="email"><?php print $this->lang->line('userlib_email')?>:</label>
                <input type="text" name="email" id="email" class="text"  value="<?php print $this->validation->email?>" />
            </li>
            <li>
                <label for="password"><?php print $this->lang->line('userlib_password')?>:</label>
                <input type="password" name="password" id="password" size="32" class="text" />
            </li>
            <li>
                <label for="confirm_password"><?php print $this->lang->line('userlib_confirm_password')?>:</label>
                <input type="password" name="confirm_password" id="confirm_password" size="32" class="text" />
            </li>
            <?php if( $this->preference->item('allow_user_profiles')):?>
                <li>
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" id="fullname" size="32" class="text" value="<?php print $this->validation->fullname?>" />
                </li>
                <li>
                    <label for="company">Company:</label>
                    <input type="text" name="company" id="company" class="text"  value="<?php print $this->validation->company?>" />
                </li>
                <li>
                    <label for="address">Company Address:</label>
                    <input type="text" name="address" id="address" class="text"  value="<?php print $this->validation->address?>" />
                </li>
                <li>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" class="text"  value="<?php print $this->validation->city?>" />
                </li>
                <li>
                    <label for="zip">ZIP:</label>
                    <input type="text" name="zip" id="zip" class="text"  value="<?php print $this->validation->zip?>" />
                </li>
                <li>
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="text"  value="<?php print $this->validation->country?>" />
                </li>
                <li>
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="text"  value="<?php print $this->validation->phone?>" />
                </li>
                <li>
                    <label for="mobile">Mobile:</label>
                    <input type="text" name="mobile" id="mobile" class="text"  value="<?php print $this->validation->mobile?>" />
                </li>
                <li>
                    <label for="fax">Fax:</label>
                    <input type="text" name="fax" id="fax" class="text"  value="<?php print $this->validation->fax?>" />
                </li>
            <?php endif;?>
            <?php
            // Only display captcha if needed
            if($this->preference->item('use_registration_captcha')){
            ?>
            <li class="captcha">
                <label for="recaptcha_response_field"><?php print $this->lang->line('userlib_captcha')?>:</label>
                <?php print $captcha?>
            </li>
            <?php } ?>
            <li class="submit">
            	<div class="buttons">
            		<button type="submit" class="positive" name="submit" value="submit">
            			<?php print $this->bep_assets->icon('user') ?>
            			<?php print $this->lang->line('userlib_register')?>
            		</button>
            		
            		<a href="<?php print site_url('auth/login') ?>" class="negative">
            			<?php print $this->bep_assets->icon('cross') ?>
            			<?php print $this->lang->line('general_cancel')?>
            		</a>
            	</div>
            </li>
        </ol>
    </fieldset>
<?php print form_close()?>