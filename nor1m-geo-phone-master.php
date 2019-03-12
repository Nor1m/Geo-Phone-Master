<?php
/*
    Plugin Name: Geo Phone Master
    Plugin URI: https://github.com/Nor1m/Nor1m-Geo-Phone-Master
    Description: Геотаргетинг (Вывод телефона в зависимости от гео положения). Мультигород (Окно выбора города, редирект на город по гео). Импорт и Экспорт данных. 
    Version: 1.3
    Author: Vitaly Mironov
    Author URI: http://nor1m.ru
*/
/*  Copyright 2018  Vitaly Mironov  (email: nor1msoft@mail.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General License for more details.

    You should have received a copy of the GNU General License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

    
    //-----------------------------------------
    // --------------- Константы --------------
    //-----------------------------------------

    define( "NGP_API_SX_GEO_DB_SERVER", "http://nor1m.ru/api/sxgeo/get" ); // сервер, где лежит sxgeo 
    define( "NGP_SX_GEO", dirname( __FILE__ ) . "/includes/class-sx-geo.php" ); // гео контроллер
    define( "NGP_SX_GEO_DB", dirname( __FILE__ ) . "/includes/sx-geo-city.dat" ); // база данных гео
    define( "NGP_ISSET_SX_GEO_DB", file_exists(NGP_SX_GEO_DB) ); // существование файла гео бд
	
	define( "NGP_CONTROLLER", dirname( __FILE__ ) . "/includes/class-ngp-controller.php" ); // контроллер
	
	define( "NGP_ADMIN", dirname( __FILE__ ) . "/nor1m-geo-phone-master-admin.php" ); // геотаргетинг
	define( "NGP_POPUP", dirname( __FILE__ ) . "/nor1m-geo-phone-master-popup.php" ); // мультигород
	define( "NGP_SETTING", dirname( __FILE__ ) . "/nor1m-geo-phone-master-setting.php" ); // настройки
	define( "NGP_HELP", dirname( __FILE__ ) . "/nor1m-geo-phone-master-help.php" ); // справка
	define( "NGP_IMPORT_EXPORT", dirname( __FILE__ ) . "/nor1m-geo-phone-master-import-export.php" ); // импорт/экспорт
	define( "NGP_THEMES", dirname( __FILE__ ) . "/nor1m-geo-phone-master-themes.php" ); // темы
	
	define( "NGP_PLAGIN_PATH", WP_PLUGIN_DIR .'/'. plugin_basename( dirname( __FILE__ ) ) ); // путь к папке плагина
	define( "NGP_PLAGIN_PATH_ABS", WP_PLUGIN_URL .'/'. plugin_basename( dirname( __FILE__ ) ) ); // абсолютный путь к корню плагина
 
    // подключаем файлы
    require_once NGP_SX_GEO;
    require_once NGP_CONTROLLER;
    
    //-----------------------------------------
    // --------------- Объекты ---------------
    //-----------------------------------------

    // подключаем класс контроллер
    $NGP = new NGP_controller();
    // подключаем класс геотаргетинга
    $NGP_GeoTargeting = new NGP_geotargeting();
    // подключаем класс мультигорода
    $NGP_Multicity = new NGP_multicity();
    
    //-----------------------------------------
    // ------------ Инициализация -------------
    //-----------------------------------------
    
    // инициализация айпи
    $NGP->theUserIP();
    
    // инициализация языка
    $NGP->theLang();
    
    // инициализация геоданных
    if ( NGP_ISSET_SX_GEO_DB ) {
        $NGP->theGeo();
    }
    
    //-----------------------------------------
    // --------------- Шорткоды ---------------
    //-----------------------------------------
    
	// шорткод геотаргетинг
    add_shortcode( 'NGP', 'NGP_GeoTargetShortcode' );
    function NGP_GeoTargetShortcode( $atts, $content ) {
        global $NGP_GeoTargeting;
        return $NGP_GeoTargeting->GetDataOnGeo( $atts, $content );
    }
    
    // шорткод вывод гео данных пользователя
    add_shortcode( 'NGP_MY_GEO', 'NGP_MyGeoShortcode' );
    function NGP_MyGeoShortcode( $atts, $content ) {
        global $NGP_GeoTargeting;
        return $NGP_GeoTargeting->GetUserGeo( $atts, $content );
    }
	    
    // шорткод вывод гео данных пользователя
    add_shortcode( 'NGSC', 'NGSC_Shortcode' );
    function NGSC_Shortcode( $atts, $content ) {
        global $NGP_Multicity;
        return $NGP_Multicity->showPopup( $atts, $content );
    }
    
    // скачивание sxgeo
    add_action( 'wp_ajax_ngp_sxgeo_load', 'ngp_sxgeo_load' );
    function ngp_sxgeo_load() {
        $res = copy( NGP_API_SX_GEO_DB_SERVER, NGP_SX_GEO_DB );
        wp_die($res);
    }
        
    //-----------------------------------------
    // ----------- Скрипты и стили ------------
    //-----------------------------------------

    // подключение jQuery
    add_action( 'admin_enqueue_scripts', 'enqueue_my_scripts' );
    function enqueue_my_scripts($hook) {
        if ( 'geo-phone_page_ngp_admin_panel' != $hook ) {
            return;
        } else{
            wp_enqueue_script( 'jquery' );
        }
    }
    
	// подключаем стили
    wp_register_style( 'css_ngp', plugins_url( '/css/style_ngp.css', __FILE__ ), false, null );
    wp_enqueue_style( 'css_ngp', plugins_url( '/css/style_ngp.css', __FILE__ ) );
    
 	// подключаем скрипты
    wp_register_script( 'js_ngp', plugins_url( '/js/js_ngp.js', __FILE__ ), false, null );
    wp_enqueue_script( 'js_ngp', plugins_url( '/js/js_ngp.js', __FILE__ ), array('jquery'), null, true );

    // подключение языкового пакета для js
    add_action( 'admin_enqueue_scripts', 'ngp_admin_enqueue_scripts' );
    function ngp_admin_enqueue_scripts(){
        wp_localize_script( 'jquery', 'lang_ngp', array(
            'Rule' => __("Rule", 'ngp'),
            'Remove' => __("Remove", 'ngp'),
            'View_Hide' => __("View/Hide", 'ngp'),
            'RuleName' => __("RuleName", 'ngp'),
            'Label' => __("Label", 'ngp'),
            'Country' => __("Country", 'ngp'),
            'Condition' => __("Condition", 'ngp'),
            'True' => __("True", 'ngp'),
            'False' => __("False", 'ngp'),
            'Country' => __("Country", 'ngp'),
            'Region' => __("Region", 'ngp'),
            'City' => __("City", 'ngp'),
            'Data' => __("Data", 'ngp'),
            'Link' => __("Link", 'ngp'),
        ));
    }

    // стили пользователя
    add_action( 'wp_enqueue_scripts', 'ngp_user_styles' );
    function ngp_user_styles() {
        $custom_css = get_option('ngp_custom_styles', false);
        wp_add_inline_style( 'css_ngp', esc_attr($custom_css) );
    }
    
    //-----------------------------------------
    // -------------- Локализация --------------
    //-----------------------------------------
    add_action( 'plugins_loaded', 'ngp_lang_init' );
    function ngp_lang_init() {
        load_plugin_textdomain( 'ngp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
    
    //-----------------------------------------
    // -------------- Админ меню --------------
    //-----------------------------------------
    
    // вывод меню в админ. панели
    add_action( 'admin_menu', function() {
	    add_menu_page( 'Geo Phone Master', 'Geo Phone Master', 8, 'nor1m-gp', 'ngp_geotargeting', 'dashicons-location', 10 );
	    add_submenu_page( 'nor1m-gp', __('Geo targeting', 'ngp'), __('Geo targeting', 'ngp'), 8, 'ngp_geotargeting', 'ngp_geotargeting' );
	    add_submenu_page( 'nor1m-gp', __('Multi-city', 'ngp'), __('Multi-city', 'ngp'), 8, 'ngp_multicity', 'ngp_multicity' );
	    add_submenu_page( 'nor1m-gp', __('Settings', 'ngp'), __('Settings', 'ngp'), 8, 'ngp_setting', 'ngp_menu_setting' );
	    add_submenu_page( 'nor1m-gp', __('Help', 'ngp'), __('Help', 'ngp'), 8, 'ngp_help', 'ngp_menu_help' );
	    add_submenu_page( 'nor1m-gp', __('Widget themes', 'ngp'), __('Widget themes', 'ngp'), 8, 'ngp_menu_themes', 'ngp_menu_themes' );
	    add_submenu_page( 'nor1m-gp', __('Import-export', 'ngp'), __('Import-export', 'ngp'), 8, 'ngp_import_export', 'ngp_menu_import_export' );
	    remove_submenu_page( 'nor1m-gp', 'nor1m-gp' ); 
	} );
    
    // контент страницы Панель управления
	function ngp_geotargeting() {
    	include ( NGP_ADMIN );
	}
	
	// контент страницы Панель управления
	function ngp_multicity() {
    	include ( NGP_POPUP );
	}
    
	// контент страницы Настроек
	function ngp_menu_setting() {
    	include ( NGP_SETTING );
	}
	
	// контент страницы Справка
	function ngp_menu_help() {
    	include ( NGP_HELP );
	}
	
	// контент страницы Импорт/Экспорт
	function ngp_menu_import_export() {
    	include ( NGP_IMPORT_EXPORT );
	}
	
	// контент страницы Темы 
	function ngp_menu_themes() {
    	include ( NGP_THEMES );
	}
