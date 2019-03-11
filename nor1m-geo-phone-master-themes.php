<?php

    // подключаем контроллер
    $NGP = new NGP_controller();
    

    // если сохранение настроек
    if ( $_POST['ngp_theme'] ) {
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else { 
            $NGP->saveTheme();
        }
    } 
    
    // получаем настройки 
	$ngp_theme = get_option('ngp_theme', false);
    $ngp_animation = get_option('ngp_animation', false);
    $ngp_duration = get_option('ngp_duration', false);
    $ngp_custom_styles = get_option('ngp_custom_styles', false);
    
	// значение по умолчанию
	if( ! $ngp_theme ) $ngp_theme = "ngp_theme_flat_blue";
    if( ! $ngp_animation ) $ngp_animation = "none";
    if( ! $ngp_duration ) $ngp_duration = 0;
    if( ! $ngp_custom_styles ) $ngp_custom_styles = "";

?>
    <h2><?php _e('Theme widgets', 'ngp') ?></h2>
    <div class="ngp_setting_block">
	    <table class="form-table">
			<tbody>
                <tr>
                    <td>
                        <div class="nscp_simple_vidget">
                            <div class="nscp_inner">
                                <div class="nscp_block_popup">
                                    <div id="nscp_block_theme" class="<?php echo $ngp_theme ?>" 
                                         data-animation="<?php echo $ngp_animation?>" 
                                         data-duration="<?php echo $ngp_duration?>">
                                        <span class="fa fa-map-marker"></span>
                                        <a class="nscp_city" onclick="showNCSPPopup();"><?php _e('Click me', 'ngp') ?></a>
                                        <div class="nscp_popover_parent_block">
                                            <div class="nscp_popover">
                                                <div class="nscp_arrow"></div>
                                                <h3 class="nscp_popover_title"><?php _e('Your city is Moscow ?', 'ngp') ?></h3>
                                                <div class="nscp_popover_content">
                                                    <div class="nscp_top_buttons">
                                                        <button class="nscp_btn_no" onclick="openCityList();"><?php _e('No, select city', 'ngp') ?></button>
                                                        <button class="nscp_btn_yes" onclick="closeNCSPPopup();"><?php _e('Yes', 'ngp') ?></button>
                                                    </div>
                                                    <div class="nscp_select_city_parent">
                                                        <div class="nscp_select_city">
                                                            <a href="#city1" onclick="closeNCSPPopup();"><?php _e('Moscow', 'ngp') ?></a>
                                                            <a href="#city2" onclick="closeNCSPPopup();"><?php _e('New York', 'ngp') ?></a>
                                                            <a href="#city3" onclick="closeNCSPPopup();"><?php _e('Beijing', 'ngp') ?></a>
                                                            <a href="#city4" onclick="closeNCSPPopup();"><?php _e('Kiev', 'ngp') ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
				    <td>
				        <div class="ngp_container">
    				        <div class="nscp_simple_vidget_list">
        					    <form id="ngp_theme_form" method="POST">
                                    
        			                <label for="ngp_theme"><?php _e('The theme of the widget', 'ngp') ?></label><br />
                                    <select name="ngp_theme" id="ngp_theme" onchange="ngsc_theme( 'class', jQuery(this).val() );">
                                        <option value="ngp_theme_flat_blue" <?php if ( $ngp_theme == "ngp_theme_flat_blue" ) echo( "selected='selected'" );?>>Flat Blue</option>
                                        <option value="ngp_theme_gradient" <?php if ( $ngp_theme == "ngp_theme_gradient" ) echo( "selected='selected'" );?>>Gradient</option>
                                        <option value="ngp_theme_modal" <?php if ( $ngp_theme == "ngp_theme_modal" ) echo( "selected='selected'" );?>>Modal</option>
                                        <option value="ngp_theme_white" <?php if ( $ngp_theme == "ngp_theme_white" ) echo( "selected='selected'" );?>>White</option>
                                    </select><br /><br />
                                    
                                    <label for="ngp_animation"><?php _e('Animation', 'ngp') ?></label><br />
                        			<select name="ngp_animation" id="ngp_animation" onchange="ngsc_theme( 'animation', jQuery(this).val() );">
                        				<option value="none" <?php if ( $ngp_animation == "none" ) echo( "selected='selected'" );?>><?php _e('No') ?></option>
                        				<option value="toggle" <?php if ( $ngp_animation == "toggle" ) echo( "selected='selected'" );?>>Toggle</option>
                        				<option value="fade" <?php if ( $ngp_animation == "fade" ) echo( "selected='selected'" );?>>Fade</option>
                                        <option value="hide" <?php if ( $ngp_animation == "hide" ) echo( "selected='selected'" );?>>Hide</option>
                        			</select><br /><br />
                                    
                                    <label for="ngp_duration"><?php _e('Animate duration', 'ngp') ?></label><br />
                                    <input name="ngp_duration" type="number" min="0" max="999" id="ngp_duration" 
                                           value="<?php echo $ngp_duration ?>" 
                                           onchange="ngsc_theme( 'duration', jQuery(this).val() );" />
                                    <br /><br />
                                    
                                    <label for="ngp_custom_styles"><?php _e('Custom styles', 'ngp') ?></label><br />
                                    <?php 
                                        wp_editor( $ngp_custom_styles, 'ngp_custom_styles', array(
                                            'textarea_name' => 'ngp_custom_styles',
                                            'media_buttons' => 0,
                                            'teeny' => 1,
                                            'tinymce' => 0,
                                            'quicktags' => 0,
                                            'textarea_rows' => 4
                                        )); 
                                    ?>
                        			<?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                        		</form>
    				        </div>
    				        
    				    </div>
				    </td>
				</tr>
				<tr>
				    <td>
				        <div class="ngp_save_theme_block">
                            <p class="btn_block_inline">
                                <input type="button" class="button button-custom" onclick="showNCSPPopup();" value="<?php _e('Test', 'ngp') ?>" />
                            </p>
                        	<p class="btn_block_inline">
                			    <input type="submit" class="button button-custom-save" onclick="jQuery('#ngp_theme_form').submit()" value="<?php _e('Save', 'ngp') ?>" />
                		    </p>
            		    </div>
				    </td>
				</tr>
			</tbody>
		</table>
    </div>
