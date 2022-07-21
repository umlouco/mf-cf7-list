<?php 
/**
 * Plugin Name:       CF7 Forms List
 * Plugin URI:        https://mario-flores.com
 * Description:       Show list of form submissions in the frontend
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Mario Flores
 * Author URI:        https://mario-flores.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mf_front_page
 * Domain Path:       /languages
 */

add_action( 'wp_enqueue_scripts', 'mf_user_concent_enqueue' );
function mf_user_concent_enqueue( ) {
    wp_enqueue_script(
        'data-tables',
        'https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
    wp_enqueue_script( 'dataTables.buttons', 'https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js', array( 'jquery', 'data-tables' ) );

    wp_enqueue_style('data-tables-style', 'https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css', '', '1.0.0', false);
    wp_enqueue_script( 'buttons.html5', 'https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js' , array( 'jquery' ) );
    wp_enqueue_script( 'buttons.print', 'https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js' , array( 'jquery' ) );
}

add_shortcode('mf-contact-list', 'mf_contact_list');

function mf_contact_list($atts){
    global $wpdb;
    $a = shortcode_atts( array(
        'form_post_id' => 0
    ), $atts );
    $cfdb          = apply_filters( 'cfdb7_database', $wpdb );
    $table_name    = $cfdb->prefix.'db7_forms';
    $upload_dir    = wp_upload_dir();
    $cfdb7_dir_url = $upload_dir['baseurl'].'/cfdb7_uploads';

    $rows    = $cfdb->get_results( "SELECT * FROM $table_name WHERE form_post_id = ".$a['form_post_id'], OBJECT );
    $max = 0; 
    $max_key = 0; 
    $fields = array(); 
    if(!empty($rows)){
        foreach($rows as $key => $r){
            $data = unserialize($r->form_value); 
            if(sizeof($data) > $max){
                $max = sizeof($data);
                $max_key = $key; 
            }
        }
        $data = unserialize($rows[$max_key]->form_value); 
        foreach($data as $key => $r){
            $fields[] = $key; 
        }
    }
    ob_start();
    include(plugin_dir_path(__FILE__).'views/list.php'); 
    return  ob_get_clean();
}