<?php
/*
Plugin Name: Test face book
Description: Плагин достает количество лайков страницы.
Version: 1.0
Author: zorg
*/

/* подключение настроек в меню */
function admin_add_menu(){
    add_menu_page( 'Settings My Cool Plugin',  'Test face book', 'manage_options',  plugin_dir_path( __FILE__ ).'settings.php',  '',  '');

    wp_enqueue_script( 'my_js',  plugin_dir_url( __FILE__ ) . 'script.js', array('jquery'));


    }

add_action("admin_menu", "admin_add_menu");
/* подключение ссылки в плагине на настройки */
add_filter( 'plugin_action_links', 'settings_link', 10, 2 );

function settings_link( $actions, $plugin_name ){
    if( false === strpos( $plugin_name, basename(__FILE__) ) )
        return $actions;

    $settings_link = '<a href="options-general.php?page='. basename(dirname(__FILE__)).'/settings.php' .'">'.__("Settings").'</a>';
    array_unshift( $actions, $settings_link );
    return $actions;

}
/* сохранеине настроек */
add_action('wp_ajax_save_settings', 'my_plugin_save_settings');

function my_plugin_save_settings() {

    $value = sanitize_text_field($_POST['my_message']);
    $value_token = sanitize_text_field($_POST['my_token']);
    $up = update_option( 'facebook_id', $value , false);
    $up_token = update_option( 'facebook_token', $value_token , false);
    echo ($up || $up_token) ? 1: 0;

}
/* функция достающая id группы*/
function facebook_id_func() {


        $out = get_option('facebook_id');

    return $out;
}
/* функция достающая токен */
function facebook_token_func() {


    $out_token = get_option('facebook_token');

    return $out_token;
}

/* функция достающая лайки страницы */
function get_facebook_page_likes($page_id, $token) {
    $url = 'https://graph.facebook.com/v2.12/'.urlencode($page_id).'?fields=fan_count&access_token='.urlencode($token);
    $data = json_decode(file_get_contents($url));
    return $data->fan_count;
}
/* размещение результата в контенте */
function msp_helloworld_footer_notice(){
    $page_id = facebook_id_func();
    $token = facebook_token_func();
    echo '<img src="'.plugin_dir_url( __FILE__ ) . 'icon.png"><br>Количество подписчиков: '.get_facebook_page_likes($page_id, $token);
}
add_filter( 'the_content', 'msp_helloworld_footer_notice' );
?>