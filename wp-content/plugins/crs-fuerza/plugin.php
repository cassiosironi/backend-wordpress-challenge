<?php

/*
Plugin Name: Cursos Fuerza CRS
Description: Gerenciador de Cursos
Author: Cassio Sironi
License: GPLv2 or later
*/

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

class CrsFuerza
{
    public function __construct()
    {
        add_action('init', array($this, 'create_custom_post_type_modulo'));
    }

    public function create_custom_post_type_modulo()
    {
        $labels = array(
            'name'                  => _x('Fuerza Cursos', 'crs_fuerza', 'text_domain'),
            'singular_name'         => _x('Fuerza Curso', 'crs_fuerza', 'text_domain'),
            'menu_name'             => __('Fuerza Cursos', 'text_domain'),
            'name_admin_bar'        => __('Fuerza Curso', 'text_domain'),
        );

        $args = array(
            'label'                 => __('Fuerza Curso', 'text_domain'),
            'description'           => __('Descrição da Fuerza Curso ', 'text_domain'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 3,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'menu_icon'             => 'dashicons-book',
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type('crs_fuerza', $args);
    }
    public function activate()
    {
        #double check
        $this->create_custom_post_type_modulo();

        flush_rewrite_rules();

        # Se precisar rodar algo ao iniciar
        // global $wpdb;
        // $wpdb->get_results("INSERT INTO wp_posts (post_author, post_content, post_title, post_status, comment_status, ping_status, post_type, comment_count) VALUES (1,  'Curso', 'Curso', 'publish', 'open', 'open', 'crs_fuerza', 0);");
    }

    public function deactivate()
    {
        flush_rewrite_rules();
        # Se vc preciar desabilitar algo
    }

    public function uninstall()
    {
        flush_rewrite_rules();
        global $wpdb;
        $wpdb->get_results("delete from wp_posts where post_type='crs_fuerza';");
    }
}

if (class_exists('CrsFuerza')) {
    $didoxModulo = new CrsFuerza();
    register_activation_hook(__FILE__, array($didoxModulo, 'activate'));
    register_deactivation_hook(__FILE__, array($didoxModulo, 'deactivate'));
    register_uninstall_hook(__FILE__, array($didoxModulo, 'uninstall'));
}
