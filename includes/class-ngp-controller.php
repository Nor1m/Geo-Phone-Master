<?php

    class NGP_controller{
        
        // функция вывода сообщений
        public function msg( $mode, $data ) {
        	echo '<div class="ngp_alert notice notice-' . $mode . ' is-dismissible"><p>' . $data . '</p></div>';
        }
        
        // функция экпорта данных
        public function export() {
            
	    	$ngp_lang = get_option( 'ngp_lang' );
	    	$ngp_const = get_option( 'ngp_const' );
	    	$ngp_rules = get_option( 'ngp_rules' );
	    	$ngp_multicity_rules = get_option( 'ngp_multicity_rules' );
	    	$ngp_multicity_id = get_option( 'ngp_multicity_id' );
	    	$ngp_multicity_class = get_option( 'ngp_multicity_class' );
	    	$ngp_theme = get_option( 'ngp_theme' );
            
            // проверяем на наличие
        	if ( ! $ngp_lang ) {
        	    $ngp_lang = "name_ru";
        	}
        	if ( ! $ngp_const ) {
        	    $ngp_const = "REMOTE_ADDR";
        	}
        	if ( ! $ngp_rules ) {
        	    $ngp_rules = " ";
        	}
        	   
        	// переводим в json
        	$ngp_lang_json = json_encode( $ngp_lang );
        	$ngp_const_json = json_encode( $ngp_const );
        	$ngp_rules_json = json_encode( $ngp_rules );
        	$ngp_multicity_rules_json = json_encode( $ngp_multicity_rules );
        	$ngp_multicity_id_json = json_encode( $ngp_multicity_id );
        	$ngp_multicity_class_json = json_encode( $ngp_multicity_class );
        	$ngp_theme_json = json_encode( $ngp_theme );
        	
        	// пути к файлу
        	$path_to_file = NGP_PLAGIN_PATH . "/temp/file.json";
        	$abs_path_to_file = NGP_PLAGIN_PATH_ABS . '/temp/file.json';
        	
        	// создаем содержимое файла
        	$text = $ngp_lang_json . PHP_EOL . $ngp_const_json . PHP_EOL . $ngp_rules_json . 
        	PHP_EOL . $ngp_multicity_rules_json . PHP_EOL . $ngp_multicity_id_json . PHP_EOL . $ngp_multicity_class_json . PHP_EOL . $ngp_theme_json;
        	
        	// если файл отрывается
            if ( $fp = fopen( $path_to_file, "w" ) ) {
                // то записываем данные
                if ( fwrite( $fp, $text ) ) {
                    $this->msg( 'success', __('Settings file successfully generated!', 'ngp') . 
                        " <a download='ngp_export.json' href='" . $abs_path_to_file . "'>" . __('Load', 'ngp') . "</a>" );
                    fclose( $fp );
                }
            }
        }
        
        // функция импорта данных

        public function import() {
            // разрешенные типы
            $types = array( 'text/plain','application/json' );
            
            // макс размер
		    $size = 10 * 1024 * 1024; // 10 мб
            
			if ( $_FILES['ngp_file_import']['size'] > $size ) {
                $this->msg( 'error', __('The file is too large! (max 10 MB)', 'ngp') );
			} else if ( !in_array( $_FILES['ngp_file_import']['type'], $types ) ) {
                $this->msg( 'error',  __('Available JSON file type', 'ngp') );
			} else if ( strlen( $_FILES['ngp_file_import']['name'] ) > 30 ) {
                $this->msg( 'error',  __('Shorten file name (max 30 characters)', 'ngp') );
	        } else {
	            // временный файл
	    		$tmp_name = $_FILES['ngp_file_import']['tmp_name'];
	    		
	    		// содержимое в чистом виде
	    		$text = file_get_contents( $tmp_name );
	    		
	    		// разбиваем на массив
	    		$text_array = explode( PHP_EOL, $text );
	    		
                // очищаем от ненужного, оставляя только текст
	    		$ngp_lang = sanitize_text_field( json_decode( $text_array[0], true ) );
	    		$ngp_const = sanitize_text_field( json_decode( $text_array[1], true ) );
	    		
                // пропускаем как есть
	    		$ngp_rules = json_decode( $text_array[2], true );
	    		$ngp_multicity_rules = json_decode( $text_array[3], true );
	    		$ngp_multicity_id = json_decode( $text_array[4], true );
	    		$ngp_multicity_class = json_decode( $text_array[5], true );
	    		$ngp_theme = json_decode( $text_array[6], true );
	    		
	    		// обновляем опции содержимым файла
	    		update_option( 'ngp_lang', $ngp_lang );
	    		update_option( 'ngp_const', $ngp_const );
	    		update_option( 'ngp_rules', $ngp_rules );
	    		update_option( 'ngp_multicity_rules', $ngp_multicity_rules );
	    		update_option( 'ngp_multicity_id', $ngp_multicity_id );
	    		update_option( 'ngp_multicity_class', $ngp_multicity_class );
	    		update_option( 'ngp_theme', $ngp_theme );
                $this->msg( 'success', __('The data was successfully imported.', 'ngp') );
			} 
        }
        
        // функция удаления данных
        public function drop() {
            delete_option('ngp_rules');
            delete_option('ngp_lang');
            delete_option('ngp_const');
            delete_option('ngp_multicity_rules');
            delete_option('ngp_multicity_id');
            delete_option('ngp_multicity_class');
            delete_option('ngp_theme');
            $this->msg( 'success', __('The data was successfully deleted.', 'ngp') );
        }
        
        public function saveSettings() {
            // очищаем от ненужного, оставляя только текст
            $ngp_lang = sanitize_text_field( $_POST['ngp_lang'] );
            $ngp_const = sanitize_text_field( $_POST['ngp_const'] );
            $ngp_multicity_class = sanitize_text_field( $_POST['ngp_multicity_class'] );
            $ngp_multicity_id = sanitize_text_field( $_POST['ngp_multicity_id'] );
            
    		// сохраняем данные в бд
            update_option( 'ngp_lang', $ngp_lang );
            update_option( 'ngp_const', $ngp_const );
            update_option( 'ngp_multicity_class', $ngp_multicity_class );
            update_option( 'ngp_multicity_id', $ngp_multicity_id );
            
    		// выводим сообщение об успехе
            $this->msg( 'success', __('The settings are successfully saved.', 'ngp') );
        }
        
        // сохранение темы виджета
        public function saveTheme() {
            // очищаем от ненужного, оставляя только текст
            $ngp_theme = sanitize_text_field( $_POST['ngp_theme'] );
            $ngp_animation = sanitize_text_field( $_POST['ngp_animation'] );
            $ngp_duration = (int)$_POST['ngp_duration'];
            $ngp_custom_styles = esc_attr($_POST['ngp_custom_styles']);
            
    		// сохраняем данные в бд
            update_option( 'ngp_theme', $ngp_theme );
            update_option( 'ngp_animation', $ngp_animation );
            update_option( 'ngp_duration', $ngp_duration );
            update_option( 'ngp_custom_styles', $ngp_custom_styles );
            
    		// выводим сообщение об успехе
            $this->msg( 'success', __('The settings are successfully saved.', 'ngp') );
        }
        
        public function saveRules() {
            $ngp_rules = array();
            $ngp_post_array = $_POST['ngp_rules'];
            
            // перебираем массивы и пушим в один
            foreach ( $ngp_post_array as $array ) {
                $ngp_rules[] = $array;
            }
            // сохраняем данные в бд
            update_option( 'ngp_rules', $ngp_rules );
            
            // выводим сообщение об успехе
            $this->msg( 'success', __('The settings are successfully saved.', 'ngp') );
        }
        
        public function saveMulticityRules() {
            $ngp_multicity_rules = array();
            $ngp_post_array = $_POST['ngp_multicity_rules'];
            
            // перебираем массивы и пушим в один
            foreach ( $ngp_post_array as $array ) {
                $ngp_multicity_rules[] = $array;
            }
            // сохраняем данные в бд
            update_option( 'ngp_multicity_rules', $ngp_multicity_rules );
            
            // выводим сообщение об успехе
            $this->msg( 'success', __('The settings are successfully saved.', 'ngp') );
        }
        
        // фильтр для html
        public function filter( $text ) {
            // разрешенные теги
            $allowed_html = array(
            	'a' => array(
            		'href' => true,
            		'class' => true,
            		'id' => true,
            	),
            	'p' => array(
            		'class' => true,
            		'id' => true,
            	),
            	'span' => array(
            		'class' => true,
            		'id' => true,
            	),
            	'br' => array(),
            	'strong' => array(
            		'class' => true,
            		'id' => true,
            	),
            	'b' => array(
            		'class' => true,
            		'id' => true,
            	),
            	'i' => array(
            		'class' => true,
            		'id' => true,
            	)
            );
            return wp_kses( $text, $allowed_html );
        }
        
        // язык общения с бд
        public function theLang() {
           	$ngp_lang = get_option( 'ngp_lang' );
        	if ( $ngp_lang == 'name_ru' ) {
        		define( "NGP_LANG_DATA", "ru" );
        	} else {
        		define( "NGP_LANG_DATA", "en" );
        	}
        }
        
        // айпи пользователя
        public function theUserIP() {
            define( "NGP_USER_IP", '5.128.25.46' ); return true;
           	$ngp_const = get_option( 'ngp_const' );
        	if ( $ngp_const ) {
        		define( "NGP_USER_IP", $_SERVER[ $ngp_const ] );
        	} else {
        		define( "NGP_USER_IP", $_SERVER['REMOTE_ADDR'] );
        	}
        }
        
        // полная информация по IP
        public function theGeo() {
    
            $lang = NGP_LANG_DATA;
            $url = API_SERVER . '/all/' . $lang . '/' . NGP_USER_IP;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
            $response_curl = curl_exec($ch);
            curl_close($ch);
            $response_json = json_decode($response_curl);
           
            if ( $response_json->status == 200 ) {
                $response = $response_json->response;
            } else {
                return false;
            }
            
            $lang = "name_" . $lang;
            
        	define( "NGP_USER_COUNTRY", strtolower( $response->country->$lang ) );
        	define( "NGP_USER_REGION", strtolower( $response->region->$lang ) );
        	define( "NGP_USER_CITY", strtolower( $response->city->$lang ) );
            define( "NGP_USER_CITY_LAT", strtolower( $response->city->lat ) );
            define( "NGP_USER_CITY_LON", strtolower( $response->city->lon ) );
            define( "NGP_USER_COUNTRY_LAT", strtolower( $response->country->lat ) );
            define( "NGP_USER_COUNTRY_LON", strtolower( $response->country->lon ) );
            define( "NGP_USER_COUNTRY_ISO", strtolower( $response->country->iso ) );
            define( "NGP_USER_REGION_ISO", strtolower( $response->region->iso ) );
        }
    }
    
    
    // класс для геотаргетинга
    class NGP_geotargeting extends NGP_controller {
        
        // функция для вывода геоданных пользователя
        public function GetUserGeo( $atts, $content ) {
    	    if ( in_array('country', $atts) ) {
    	        return NGP_USER_COUNTRY;
    	    } else if ( in_array('region', $atts) ) {
    	        return NGP_USER_REGION;
    	    } else if ( in_array('city', $atts) ) {
    	        return NGP_USER_CITY;
    	    } else if ( in_array('ip', $atts) ) {
    	        return NGP_USER_IP;
            } else if ( in_array('country_lon', $atts) ) {
                return NGP_USER_COUNTRY_LON;
            } else if ( in_array('country_lat', $atts) ) {
                return NGP_USER_COUNTRY_LAT;
            } else if ( in_array('city_lon', $atts) ) {
                return NGP_USER_CITY_LON;
            } else if ( in_array('city_lat', $atts) ) {
                return NGP_USER_CITY_LAT;
            } else if ( in_array('country_iso', $atts) ) {
                return NGP_USER_COUNTRY_ISO;
            } else if ( in_array('region_iso', $atts) ) {
                return NGP_USER_REGION_ISO;
    	    } else {
        	    return false;
	        }
        }
        
        // функция для вывода готовых данных 
    	public function GetDataOnGeo( $atts, $content ) {

    	    global $NGP;
    	    
            // полный массив с правилами 
            $ngp_rules = get_option( 'ngp_rules', false );
            
    	    if ( $ngp_rules) {
    	        
    	        // если указан ярлык
    	        if ( $atts['label'] ) {
    	            
    	            // парсим данные юзера
    	            foreach ( $ngp_rules as $save_data ) {
    	                
    	                // если ярлык совпал
    	                if ( strtolower( $save_data['label'] ) == strtolower( $atts['label'] ) ) { 
    	                    
    	                    // если страна учитывается
    	                    if ( $save_data['country'] ) {
    	                        
    	                        if ( $save_data['term'] == 1 ) { // если условие - равно
        	                        if ( strtolower( $save_data['country'] ) != NGP_USER_COUNTRY ) { //если не совпали 
        	                            continue; // возвращаем false
        	                        }
    	                        } else if ( $save_data['term'] == 2 ) { // если условие - не равно
        	                        if ( strtolower( $save_data['country'] ) != NGP_USER_COUNTRY ) { //если не совпали 
        	                           return $NGP->filter( $save_data['data'] ); // возвращаю данные
        	                        }
    	                        } 
    	                        
    	                    }
    	                    // если регион учитывается
    	                    if ( $save_data['region'] ) { 
    	                        
    	                        if ( $save_data['term'] == 1 ) { // если условие - равно
        	                        if ( strtolower( $save_data['region'] ) != NGP_USER_REGION ) { //если не совпали
        	                            continue; // возвращаем false
        	                        }
    	                        } else if ($save_data['term'] == 2 ) { // если условие - не равно
        	                        if ( strtolower( $save_data['region'] ) != NGP_USER_REGION ) { //если не совпали 
        	                           return $NGP->filter( $save_data['data'] ); // возвращаю данные
        	                        }
    	                        } 
    	                        
    	                    }
    	                    // если город учитывается
    	                    if ( $save_data['city'] ) { 
    	                        
    	                        if ($save_data['term'] == 1) { // если условие - равно
        	                        if ( strtolower( $save_data['city'] ) != NGP_USER_CITY ) { //если не совпали 
        	                            continue; // возвращаем false
        	                        }
    	                        } else if ( $save_data['term'] == 2 ) { // если условие - не равно
        	                        if ( strtolower( $save_data['city'] ) != NGP_USER_CITY ) { //если не совпали 
        	                           return $NGP->filter( $save_data['data'] ); // возвращаю данные
        	                        }
    	                        } 
    	                        
    	                    }
    	                    // если условие - "равно" и все совпали то выводим данные
    	                    if ( $save_data['term'] == 1 ) {
    	                        return $NGP->filter( $save_data['data'] );
    	                    } else {
    	                        continue; // иначе пропускаем
    	                    }
    	                }
    	            } 
    	        } else {
        	        return false;
        	    }
    	    } else {
    	        return false;
    	    }
    	    // если не совпало ни одно условие, то выводим значение по умолчанию
    	    return $NGP->filter( $content );
        }
    }
    
    
    //класс для мультигорода
    class NGP_multicity extends NGP_controller {
            
        // фукция создания виджета
        public function showPopup( $atts ) {
            
            // полный массив с правилами 
            $ngp_multicity_rules = get_option( 'ngp_multicity_rules', false );
            // класс виджета
            $class = get_option( 'ngp_multicity_class', false );
            // айди виджета
            $id = get_option( 'ngp_multicity_id', false );
            
    		$cur_name = mb_strtolower( $_SERVER['SERVER_NAME'] );// текущее имя сайта
            $city_on_IP = mb_strtolower( NGP_USER_CITY ); // город пользователя
            
            if ( ! empty( $atts['def_city'] ) ) {
                $default_city = mb_strtolower( $atts['def_city'] ) ; // город по умолчанию
            } 
            
            if ( ! empty( $atts['def_link'] ) ) {
                $default_link = mb_strtolower( $atts['def_link'] ) ; // город по умолчанию
            } 
    
            $html_cities_list = "";
    		$cities_array = array();
    
    		// собираем код списка городов
    		foreach ( $ngp_multicity_rules as $key => $value ) {
    		    
    			$city = mb_strtolower( $value['city'] );
    			$url = mb_strtolower( $value['link'] );
    			
    			// добавляем название города в массив
    			$cities_array[] = $city;
    			
    			// создаем ссылки в виде html списка
    			$html_cities_list .= '<a href="' . $url . '">' . $city . '</a>';
    
    			// удаляем протокол и меняем регистр
    			$cu = preg_replace( "(https|http|:\/\/)", "", $cur_name ); // текущий url сайта
    			$url = preg_replace( "(https|http|:\/\/)", "", $url ); // город из цикла
    	    	
    			// если текущий url совпадает с url города из цикла то показываем его город в попапе
    			if ( $cu == $url ||
                    urldecode( $cu ) == $url || 
                    $cu == urldecode( $url ) ||
                    urldecode( $cu ) == urldecode( $url ) ) {
    				$current_city = $city;
    			} 
    			
    			// если это текущий город, то назначаем редирект на ссылку этого города и прекращаем цикл
    			if ( $city == $city_on_IP ) {
    				$redirect = $url; 
    				$city_name = $city;
    				continue;
    			}
    		}
    		
    		// если в массиве нет города то ставим по умолчанию
    		if ( ! in_array( $current_city, $cities_array ) || ! $current_city ) {
    			$city_name = preg_replace( "(https|http|:\/\/)", "", $default_city );
    			$redirect = preg_replace( "(https|http|:\/\/)", "", $default_link );
    		}
    		
			// если мы уже на нужном сайте, то не редиректим
			if ( $cur_name == $redirect || urldecode( $cur_name ) == $redirect || $cur_name == urldecode( $redirect ) || urldecode( $cur_name ) == urldecode( $redirect ) ) {
				$current_city = $city;
			} else {
				// если у юзера нет куки с городом то редиректим
				if( ! $_COOKIE['NGP_CITY'] ) {
                    echo "<script> 
				            console.log( 'set', '" . $city_name . "');
							setCookie( 'NGP_CITY', '" . $city_name . "');
							setCookie( 'NGP_POPUP', '0' );
							document.location.href = '//" . $redirect . "'; 
					    </script>";
                }
			}
			
			// класс темы
	        $ngp_theme = get_option('ngp_theme', false);
            // анимация
            $ngp_animation = get_option('ngp_animation', false);
            // продолжительность анимации
            $ngp_duration = get_option('ngp_duration', false);
	        
    	    // готовый код попапа
	    	$html = '<div class="nscp_block_popup ' . $class . '"'; 
	    	if ( ! empty( $id ) ) $html .= ' id="' . $id . '"'; 
	    	$html .= '> 
			    <div id="nscp_block_theme" class="' . $ngp_theme . ' data-animation="' . $ngp_animation . '  data-duration="' . $ngp_duration . '">
    				<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
    	            <a class="nscp_city" onclick="showNCSPPopup();">' . $city_name . '</a>
    	            <div class="nscp_popover_parent_block">
    		            <div class="nscp_popover">
    		                <div class="nscp_arrow"></div>
    		                <h3 class="nscp_popover_title">' . __('Your city', 'ngp') . ' ' . $city_name . '?</h3>
    		                <div class="nscp_popover_content">
                                <div class="nscp_top_buttons">
                                    <button class="nscp_btn_no" onclick="openCityList();">' . __('No, select city', 'ngp') . '</button> 			                	
                                    <button class="nscp_btn_yes" onclick="closeNCSPPopup();">' . __('Yes', 'ngp') . '</button>
    		                	</div>
    		                	<div class="nscp_select_city_parent">
    			                	<div class="nscp_select_city">
    									' . $html_cities_list . '
    			                	</div>
    		                	</div>
    		                </div>
    		            </div>
		            </div>
	            </div>
	        </div>';
	    	return $html;
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
