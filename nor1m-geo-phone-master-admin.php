<?php
    
    // подключаем контроллер
    $NGP = new NGP_controller();
    // если нет гео бд, то просим юзера ее установить
    $NGP->issetGeoDat();
    
    // если пришли данные для сохранения
    if ( $_POST['ngp_save'] ) { 
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else {
           $NGP->saveRules();
        }
	}
	// получаем правила
	$ngp_rules = get_option( 'ngp_rules', false );
	
?>

    <h2><?php _e('Geo targeting', 'ngp') ?></h2>
    <div class="ngp_setting_block">
	    <table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="blogdescription"><?php _e('Rules', 'ngp') ?></label></th>
					<td>
						<div class="rules_block_form">
						<p class="description" id="tagline-description"><?php _e('<b>Tip: </b> Leave blank if it is not necessary to consider', 'ngp') ?></p>
    						<form class="ngp_select_city_section" name="ngp_rules_form" id="ngp_form" method="POST">
    						    <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                    		    <input name="ngp_save" type="hidden" id="ngp_save" value="true" />
    						    
    						    <?php if ( $ngp_rules ): ?>
    						    
        						    <?php foreach ( $ngp_rules as $data ): ?>
        						        
        						       <?php 
        						           // фильтрация данных
        						           $id = (int) $data['id'];
        						           $term = (int) $data['term'];
        						           $name = sanitize_text_field( $data['name'] );
        						           $label = sanitize_text_field( $data['label'] );
        						           $country = sanitize_text_field( $data['country'] );
        						           $region = sanitize_text_field( $data['region'] );
        						           $city = sanitize_text_field( $data['city'] );
        						           $data = $NGP->filter( $data['data'] );
        						       ?>
        						    
                					    <div class="ngp_select_city" data-id='<?php echo $id ?>'>
                					        <div class="head_item">
                					            <b><?php echo ( $name ? $name : __e('Rule', 'ngp') ) ?></b>
                					            <a class="remove_item" onclick="jQuery(this).parent().parent().remove()"> <?php _e('Remove', 'ngp') ?> </a>
                					            <a class="toggle_item" onclick="ngp_get_shortcode(jQuery(this).parent().parent().children('.items').find('.ngp_label_input').val());"> <?php _e('Get shortcode', 'ngp') ?> </a>
                					            <a class="toggle_item" onclick="jQuery(this).parent().parent().children('.items').slideToggle()"> <?php _e('View', 'ngp') ?> </a>
                					        </div>
                					        <div class="items" style="display: none">
                    					        <input name="ngp_rules[ngp_rule_<?php echo $id ?>][id]" type="hidden" id="ngp_id_<?php echo $id ?>" value="<?php echo $id ?>" />
                    					        <div class="item">
                    					            <label for="ngp_name_<?php echo $id ?>"><?php _e('Rule name', 'ngp') ?></label><br>
                    					            <input require="required" name="ngp_rules[ngp_rule_<?php echo $id ?>][name]" type="text" id="ngp_name_<?php echo $id ?>" value="<?php echo $name ?>" />
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_label_<?php echo $id ?>"><?php _e('Label', 'ngp') ?></label><br>
                    					            <input class="ngp_label_input" require="required" name="ngp_rules[ngp_rule_<?php echo $id ?>][label]" type="text" id="ngp_label_<?php echo $id ?>" value="<?php echo $label ?>" />
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_term_<?php echo $id ?>"><?php _e('Condition', 'ngp') ?></label><br>
                    					            <select name="ngp_rules[ngp_rule_<?php echo $id ?>][term]" id="ngp_term_<?php echo $id ?>">
                    					                <option <?php if ( $term == 1 ) echo " selected='selected' " ?> value="1"><?php _e('True', 'ngp') ?></option>
                    					                <option <?php if ( $term == 2 ) echo " selected='selected' " ?> value="2"><?php _e('False', 'ngp') ?></option>
                    					            </select>
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_country_<?php echo $id ?>"><?php _e('Country', 'ngp') ?></label><br />
                    					            <input name="ngp_rules[ngp_rule_<?php echo $id ?>][country]" type="text" id="ngp_country_<?php echo $id ?>" value="<?php echo $country ?>" />
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_region_<?php echo $id ?>"><?php _e('Region', 'ngp') ?></label><br />
                    					            <input name="ngp_rules[ngp_rule_<?php echo $id ?>][region]" type="text" id="ngp_region_<?php echo $id ?>" value="<?php echo $region ?>" />
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_city_<?php echo $id ?>"><?php _e('City', 'ngp') ?></label><br />
                    					            <input name="ngp_rules[ngp_rule_<?php echo $id ?>][city]" type="text" id="ngp_city_<?php echo $id ?>" value="<?php echo $city ?>" />
                    					        </div> 
                    					        <div class="item_full">
                    					            <label for="ngp_data_<?php echo $id ?>"><?php _e('Data', 'ngp') ?></label><br />
                    						        <textarea name="ngp_rules[ngp_rule_<?php echo $id ?>][data]" id="ngp_data_<?php echo $id ?>" class="large-text code" cols="100" rows="2"><?php echo $data ?></textarea>
                    					        </div>
                					        </div>
                					    </div>
            					    <?php endforeach; ?>
        					    <?php endif; ?>
    					    </form>
    				    </div>  
                        <div class="ngp_shortcode_block" id="ngp_shortcode_block">
                            <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input id="ngp_shortcode_input" type="text" name="ngp_short_input" value="[NGP label='Ярлык']<?php _e('Default', 'ngp') ?>[/NGP]" /></p>
                        </div>
				        <div class="item_button">
				            <br />
				            <button class="button button-custom" onclick="ngp_new_right_block();"><?php _e('Add rule', 'ngp') ?></button>
            			    <input type="button" class="button button-custom-save" onclick="jQuery('#ngp_form').submit();" value="<?php _e('Save', 'ngp') ?>" />
				        </div>
					</td>
				</tr>
			</tbody>
		</table>
    </div>


