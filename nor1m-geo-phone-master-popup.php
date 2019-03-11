<?php
    
    // подключаем контроллер
    $NGSC = new NGP_controller();
    
    // если пришли данные для сохранения
    if ( $_POST['ngsc_save'] ) { 
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGSC->msg( 'error', __('Access denied', 'ngp') );
        } else {
           $NGSC->saveMulticityRules();
        }
	}
	
	// получаем правила
	$NGSC_multicity_rules = get_option( 'ngp_multicity_rules', false );
?>

    <h2><?php _e('Multi-city', 'ngp') ?></h2>
    <div class="ngp_setting_block">
	    <table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="blogdescription"><?php _e('Rules', 'ngp') ?></label></th>
					<td>
						<div class="rules_block_form">
						<p class="description" id="tagline-description"><?php _e('<b>Tip: </b> Leave blank if it is not necessary to consider', 'ngp') ?></p>
    						<form class="ngp_select_city_section" name="ngp_multicity_rules_form" id="ngp_form" method="POST">
    						    <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                    		    <input name="ngsc_save" type="hidden" id="ngsc_save" value="true" />
    						    
    						    <?php if ( $NGSC_multicity_rules ): ?>
    						    
        						    <?php foreach ( $NGSC_multicity_rules as $data ): ?>
        						        
        						       <?php 
        						           // фильтрация данных
        						           $id = (int) $data['id'];
        						           $name = sanitize_text_field( $data['name'] );
        						           $city = sanitize_text_field( $data['city'] );
        						           $link = sanitize_text_field( $data['link'] );
        						       ?>
        						    
                					    <div class="ngp_select_city" data-id='<?php echo $id ?>'>
                					        <div class="head_item head_item_blue">
                					            <b><?php echo ( $name ? $name : __e('Rule') ) ; ?></b>
                					            <a class="remove_item" onclick="jQuery(this).parent().parent().remove()"> <?php _e('Remove', 'ngp') ?> </a>
                					            <a class="toggle_item" onclick="jQuery('#ngsc_shortcode_block').slideDown();"> <?php _e('Get shortcode', 'ngp') ?> </a>
                					            <a class="toggle_item" onclick="jQuery(this).parent().parent().children('.items').slideToggle()"> <?php _e('View', 'ngp') ?> </a>
                					        </div>
                					        <div class="items" style="display: none">
                    					        <input name="ngp_multicity_rules[ngp_rule_<?php echo $id ?>][id]" type="hidden" id="ngp_id_<?php echo $id ?>" value="<?php echo $id ?>" />
                    					        <div class="item">
                    					            <label for="ngp_name_<?php echo $id ?>"><?php _e('Rule name', 'ngp') ?></label><br>
                    					            <input require="required" name="ngp_multicity_rules[ngp_rule_<?php echo $id ?>][name]" type="text" id="ngp_name_<?php echo $id ?>" value="<?php echo $name ?>" />
                    					        </div>
                    					        <div class="item">
                    					            <label for="ngp_city_<?php echo $id ?>"><?php _e('City', 'ngp') ?></label><br />
                    					            <input name="ngp_multicity_rules[ngp_rule_<?php echo $id ?>][city]" type="text" id="ngp_city_<?php echo $id ?>" value="<?php echo $city ?>" />
                    					        </div> 
                    					        <div class="item">
                    					            <label for="ngp_link_<?php echo $id ?>"><?php _e('Link', 'ngp') ?></label><br />
                    					            <input name="ngp_multicity_rules[ngp_rule_<?php echo $id ?>][link]" type="text" id="ngp_link_<?php echo $id ?>" value="<?php echo $link ?>" />
                    					        </div> 
                					        </div>
                					    </div>
            					    <?php endforeach; ?>
        					    <?php endif; ?>
    					    </form>
    				    </div>  
                        <div class="ngp_shortcode_block" id="ngsc_shortcode_block">
                            <p class="ngp_shortcode"><?php _e('Shortcode', 'ngp') ?>: <input id="ngsc_shortcode_input" type="text" name="ngp_short_input" value="[NGSC def_city='<?php _e('The default city', 'ngp') ?>' def_link='<?php _e('The default link', 'ngp') ?>' ]" /></p>
                        </div>
				        <div class="item_button">
				            <br />
				            <button class="button button-custom" onclick="ngsc_new_right_block();"><?php _e('Add rule', 'ngp') ?></button>
            			    <input type="button" class="button button-custom-save" onclick="jQuery('#ngp_form').submit();" value="<?php _e('Save', 'ngp') ?>" />
				        </div>
					</td>
				</tr>
			</tbody>
		</table>
    </div>
    
    <script>
        
        
        
    </script>


		
