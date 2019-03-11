            
    // вывод шорткода
    function ngp_get_shortcode(label){
        $el = jQuery( '#ngp_shortcode_block' );
        $el.find( '#ngp_shortcode_input' ).val( "[NGP label='" + label + "'] " );
        $el.slideDown();
    }
    
    // получение имени загруженного файла
    function ngp_getFileName() {
        $file_name = jQuery('#ngp_file_import').val();
        $file_name = $file_name.replace (/\\/g, '/').split ('/').pop();
        jQuery('.ngp_custom_file').text( "Выбран: " + $file_name );
        jQuery('.btn-import-start').show(200);
    }
    
    // создание нового правила для геотерагетинга 
    function ngp_new_right_block() {
        
        $last_id = jQuery( '[data-id]:last' ).attr( 'data-id' );
        
        if ( $last_id ) {
            $id = ( $last_id * 1 ) + 1;
        } else {
            $id = 1;
        }
        
        var lang = lang_ngp;
        
        $block = '<div class="ngp_select_city" data-id="' + $id + '">';
        $block += ' <div class="head_item">';
    	$block += '	    <b>' + lang.Rule + ' #' + $id + '</b>';
    	$block += '	    <a class="remove_item" onclick="jQuery(this).parent().parent().remove()">' + lang.Remove + ' </a>';
    	$block += '	    <a class="toggle_item" onclick="jQuery(this).parent().parent().children(\'.items\').slideToggle();"> ' + lang.View_Hide + ' </a>';
    	$block += ' </div>';
    	$block += '<input name="ngp_rules[ngp_rule_' + $id + '][id]" type="hidden" hidden id="ngp_id[ngp_rule_' + $id + ']" value="' + $id + '">';
    	$block += ' <div class="items">';
    	$block += '	    <div class="item">';
    	$block += '		    <label for="ngp_name_[ngp_rule_' + $id + ']">' + lang.RuleName + '</label><br>';
    	$block += '		    <input name="ngp_rules[ngp_rule_' + $id + '][name]" type="text" id="ngp_name_[ngp_rule_' + $id + ']">';
    	$block += '		</div>';
    	$block += '	    <div class="item">';
    	$block += '		    <label for="ngp_label_[ngp_rule_' + $id + ']">' + lang.Label + '</label><br>';
    	$block += '		    <input name="ngp_rules[ngp_rule_' + $id + '][label]" type="text" id="ngp_label_[ngp_rule_' + $id + ']">';
    	$block += '		</div>';
        $block += '    	<div class="item">';
        $block += '    		<label for="ngp_term_[ngp_rule_' + $id + ']">' + lang.Condition + '</label><br>';
        $block += '    		<select name="ngp_rules[ngp_rule_' + $id + '][term]" id="ngp_term_[ngp_rule_' + $id + ']">';
        $block += '    			<option selected value="1">' + lang.True + '</option>';
        $block += '    			<option value="2">' + lang.False + '</option>';
        $block += '    		</select>';
        $block += '    	</div>';
    	$block += '	    <div class="item">';
    	$block += '		    <label for="ngp_country_[ngp_rule_' + $id + ']">' + lang.Country + '</label><br>';
    	$block += '	        <input name="ngp_rules[ngp_rule_' + $id + '][country]" type="text" id="ngp_country_[ngp_rule_' + $id + ']">';
    	$block += '	    </div>';
    	$block += '	    <div class="item">';
    	$block += '	    	<label for="ngp_region_[ngp_rule_' + $id + ']">' + lang.Region + '</label><br>';
    	$block += '	        <input name="ngp_rules[ngp_rule_' + $id + '][region]" type="text" id="ngp_region_[ngp_rule_' + $id + ']">';
    	$block += '    	</div>';
    	$block += '    	<div class="item">';
    	$block += '	    	<label for="ngp_city_[ngp_rule_' + $id + ']">' + lang.City + '</label><br>';
    	$block += '	    	<input name="ngp_rules[ngp_rule_' + $id + '][city]" type="text" id="ngp_city_[ngp_rule_' + $id + ']">';
    	$block += '     </div>';
    	$block += '	    <div class="item_full">';
    	$block += '	        <label for="ngp_data_[ngp_rule_' + $id + ']">' + lang.Data + '</label><br>';
    	$block += '	    	<textarea name="ngp_rules[ngp_rule_' + $id + '][data]" id="ngp_data_[ngp_rule_' + $id + ']" class="large-text code" cols="100" rows="2"></textarea>';
    	$block += '	    </div>';
    	$block += ' </div>';
        $block += '</div>';
        jQuery( '.ngp_select_city_section' ).append( $block );
    }
    
    // создание нового правила для мультигорода
    function ngsc_new_right_block() {

        var lang = lang_ngp;
        
        $last_id = jQuery( '[data-id]:last' ).attr( 'data-id' );
        if ( $last_id ) {
            $id = ( $last_id * 1 ) + 1;
        } else {
            $id = 1;
        }
        
        $block = '<div class="ngp_select_city" data-id="' + $id + '">';
        $block += ' <div class="head_item">';
    	$block += '	    <b>' + lang.Rule + ' #' + $id + '</b>';
    	$block += '	    <a class="remove_item" onclick="jQuery(this).parent().parent().remove()"> ' + lang.Remove + ' </a>';
    	$block += '	    <a class="toggle_item" onclick="jQuery(this).parent().parent().children(\'.items\').slideToggle();"> ' + lang.View_Hide + ' </a>';
    	$block += ' </div>';
    	$block += '<input name="ngp_multicity_rules[ngp_rule_' + $id + '][id]" type="hidden" hidden id="ngp_id[ngp_rule_' + $id + ']" value="' + $id + '">';
    	$block += ' <div class="items">';
    	$block += '	    <div class="item">';
    	$block += '		    <label for="ngp_name_[ngp_rule_' + $id + ']">' + lang.RuleName + '</label><br>';
    	$block += '		    <input name="ngp_multicity_rules[ngp_rule_' + $id + '][name]" type="text" id="ngp_name_[ngp_rule_' + $id + ']">';
    	$block += '		</div>';
    	$block += '    	<div class="item">';
    	$block += '	    	<label for="ngp_city_[ngp_rule_' + $id + ']">' + lang.City + '</label><br>';
    	$block += '	    	<input name="ngp_multicity_rules[ngp_rule_' + $id + '][city]" type="text" id="ngp_city_[ngp_rule_' + $id + ']">';
    	$block += '     </div>';
    	$block += '    	<div class="item">';
    	$block += '	    	<label for="ngp_link_[ngp_rule_' + $id + ']">' + lang.Link + '</label><br>';
    	$block += '	    	<input name="ngp_multicity_rules[ngp_rule_' + $id + '][link]" type="text" id="ngp_link_[ngp_rule_' + $id + ']">';
    	$block += '     </div>';
    	$block += ' </div>';
        $block += '</div>';
        jQuery( '.ngp_select_city_section' ).append( $block );
}

	// открыть список городов
	function openCityList(){
        if ( jQuery('.nscp_select_city_parent')[0] ) {
            document.querySelector('.nscp_select_city_parent').style.display = "inline-block";
        }
	}
	// показать попап
	function showNCSPPopup(){
		if ( jQuery('.nscp_popover_parent_block')[0] ) {
            var animation = jQuery('#nscp_block_theme').attr('data-animation');
            var popover_parent = jQuery('#nscp_block_theme');
            var popover = jQuery('.nscp_popover_parent_block .nscp_popover');
            var margin = ( ( popover.width() - popover_parent.width() ) / 2 ) * (-1);
            if ( ! jQuery('#nscp_block_theme').hasClass('ngp_theme_modal') ) {
                popover.css('margin-left', margin);
			}
			if ( animation ) {
                NCSPPopupAnimate('show');
			} else {
                jQuery('.nscp_popover_parent_block').addClass('active');
			}
            setCookie("NGP_POPUP", "1");
		}
	}
	
	function NCSPPopupAnimate(mode) {
        var animation = jQuery('#nscp_block_theme').attr('data-animation');
        var duration = jQuery('#nscp_block_theme').attr('data-duration') * 1;
		switch (animation) {
			case 'fade':
                if ( mode == "show" ) jQuery('.nscp_popover_parent_block').fadeIn(duration);
                else jQuery('.nscp_popover_parent_block').fadeOut(duration);
				break;
			case 'toggle':
                if ( mode == "show" ) jQuery('.nscp_popover_parent_block').slideDown(duration);
                else jQuery('.nscp_popover_parent_block').slideUp(duration);
				break;
			case 'hide':
                if ( mode == "show" ) jQuery('.nscp_popover_parent_block').show(duration);
                else jQuery('.nscp_popover_parent_block').hide(duration);
				break;
			default:
                if ( mode == "show" ) jQuery('.nscp_popover_parent_block').addClass('active');
                else jQuery('.nscp_popover_parent_block').removeClass('active');
        }
    }
	
	// закрыть попап
	function closeNCSPPopup(){
        if ( jQuery('.nscp_popover_parent_block')[0] ) {
            var animation = jQuery('#nscp_block_theme').attr('data-animation');
            if ( animation ) {
                NCSPPopupAnimate('hide');
            } else {
                jQuery('.nscp_popover_parent_block').removeClass('active');
            }
        }
	}

	// если мы уже показали попап юзеру, то больше не показываем
	// иначе показываем
	jQuery(document).ready(function() {
		if( ( getCookie("NGP_POPUP") * 1 ) != 1 ){
			setTimeout(function(){
		 		showNCSPPopup();
			}, 3000)
		}
	});
	
	// смена темы в админке
    function ngsc_theme(mode, data){
    	console.log(mode, data);
        var el = jQuery('#nscp_block_theme');
        if ( mode == "class" ) {
            el.removeClass();
            el.addClass(data);
		} else if ( mode == "animation" ) {
            el.attr('data-animation', data);
        } else if ( mode == "duration" ) {
            el.attr('data-duration', data);
        } 
    }

	//>>РАБОТА С КУКАМИ

	function setCookie(name, value) {
		document.cookie = name + "=" + value + "; expires=" + (3600 * 24 * 30) + "; path=/;";
	}
	function getCookie(name) {
		var r = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|jQuery)");
		if (r) return r[2];
		else return "";
	}
	function deleteCookie(name) {
		var date = new Date(); // Берём текущую дату
		date.setTime(date.getTime() - 1); // Возвращаемся в "прошлое"
		document.cookie = name += "=; expires=" + date.toGMTString(); // Устанавливаем cookie пустое значение и срок действия до прошедшего уже времени
	}

	//>>
