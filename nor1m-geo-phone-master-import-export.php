<?php
    
    // подключаем контроллер
    $NGP = new NGP_controller();
    
    // получаем данные
    $ngp_lang = get_option('ngp_lang', false);
    $ngp_const = get_option('ngp_const', false);
    $ngp_rules = get_option('ngp_rules', false);
    $ngp_multicity_rules = get_option('ngp_multicity_rules', false);
	  
    // если режим экспорта
    if ( $_POST['ngp_export'] ) {
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else {
            $NGP->export();
        }
    } 
    
    // если режим импорта
    if ( $_FILES['ngp_file_import'] ) { 
		if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['ngp_protect'], 'ngp_protect' ) ) {
            $NGP->msg( 'error', __('Access denied', 'ngp') );
        } else {
		    $NGP->import();
        }
    }
		
?>
    <h2><?php _e('Import-export', 'ngp') ?></h2>
    <div class="ngp_setting_block">
	    <table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label><?php _e('Export', 'ngp') ?></label></th>
					<td>
					    <div class="ngp_import_export">
    					    <form id="ngp_setting" method="POST">
                    		    <input name="ngp_export" type="hidden" id="ngp_export" value="true" />
                    		    <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                            	<p class="submit">
                    			    <input type="submit" class="button button-custom" value="<?php _e('To generate the settings file', 'ngp') ?>" />
                    		    </p>
                        	</form>
                    	</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php _e('Import', 'ngp') ?></label></th>
					<td>
					    <div class="ngp_import_export">
						    <p class="description" id="tagline-description"><?php _e('<b> Warning: </b> all old data will be overwritten! </b>', 'ngp') ?></p>
						    <br />
    					    <form id="ngp_import_form" method="POST" action="#" enctype="multipart/form-data">
    					        <label for="ngp_file_import" class="ngp_custom_file"><?php _e('Select file', 'ngp') ?></label>
    	                        <input type="file" style="display: none" onchange="ngp_getFileName();" name="ngp_file_import" id="ngp_file_import"  multiple="false" />
    	                        <?php wp_nonce_field( 'ngp_protect', 'ngp_protect' ); ?>
                            	<input type="submit" style="display: none" class="button button-custom-save btn-import-start" value="<?php _e('Import', 'ngp') ?>" />
                        	</form>
                    	</div>
					</td>
				</tr>
			</tbody>
		</table>
    </div>
