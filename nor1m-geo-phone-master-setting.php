<?php

    // подключаем контроллер
    $NGP = new NGP_controller();
    
    // если режим сброса данных
    if ( $_POST['ngp_drop'] ) {
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else {
            $NGP->drop();
        }
    } 
    // если сохранение настроек
    if ( $_POST['ngp_lang'] || $_POST['ngp_const'] ) {
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else { 
            $NGP->saveSettings();
        }
    } 
    
    // получаем настройки 
	$ngp_lang = get_option('ngp_lang', false);
	$ngp_const = get_option('ngp_const', false);
	$ngp_multicity_id = get_option('ngp_multicity_id', false);
	$ngp_multicity_class = get_option('ngp_multicity_class', false);

?>
    <h2><?php _e('Plugin settings', 'ngp') ?></h2>
    <div class="ngp_setting_block">
	    <table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="blogdescription"><?php _e('Settings', 'ngp') ?></label></th>
					<td>
					    <div class="ngp_setting_items">
    					    <form id="ngp_setting" method="POST">
                                <label for="ngp_multicity_class"></label><?php _e('Class for the selection widget of the city', 'ngp') ?></label><br />
                    		    <input name="ngp_multicity_class" type="text" required="required" id="ngp_multicity_class" value="<?php echo $ngp_multicity_class ?>" />
                    		    <br /><br />
    			                <label for="ngp_multicity_id"><?php _e('Id for the selection widget of the city', 'ngp') ?></label><br />
                    		    <input name="ngp_multicity_id" type="text" required="required" id="ngp_multicity_id" value="<?php echo $ngp_multicity_id ?>" />
                    		    <br /><br />
    			                <label for="ngp_lang"><?php _e('Select the language to work with geo database', 'ngp') ?></label><br />
                    			<select name="ngp_lang" id="ngp_lang" style="width: 200px;">
                    				<option value="name_ru"<?php if ( $ngp_lang == 'name_ru' ) echo( "selected='selected'" );?>>Русский</option>
                    				<option value="name_en"<?php if ( $ngp_lang == 'name_en' ) echo( "selected='selected'" );?>>English</option>
                    			</select>
                    		    <br />
                                <p class="description"><?php _e('<b>Example: </b> If you specify a Russian, instead Москва need to write Moscow. Default: English.', 'ngp') ?></p>
                    			<br />
    			                <label for="ngp_const"><?php _e('A constant containing the user\'s IP', 'ngp') ?></label><br />
                    		    <input name="ngp_const" type="text" required="required" placeholder="REMOTE_ADDR" id="ngp_const" value="<?php echo $ngp_const ?>" />
                    		    <br />
    					        <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
    						   
                        	</form>
                    	</div>
                    	<p class="submit">
            			    <input type="submit" class="button  button-custom-save" onclick="jQuery('#ngp_setting').submit()" value="<?php _e('Save', 'ngp') ?>" />
            		    </p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="blogdescription"><?php _e('Reset', 'ngp') ?></label></th>
					<td>
					    <form id="ngp_setting_drop" method="POST">
    					    <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                		    <input name="ngp_drop" type="hidden" id="ngp_drop" value="true" />
					    </form>
						<p class="description" id="tagline-description"><?php _e('<b> Warning! </b> When you reset, you delete all the plugin settings, including rules.', 'ngp') ?></p>
                    	<p class="submit">
            			    <input type="submit" class="button  button-custom-delete" onclick="jQuery('#ngp_setting_drop').submit()" value="<?php _e('Reset all data', 'ngp') ?>" />
            		    </p>
					</td>
				</tr>
			</tbody>
		</table>
    </div>
