<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// css et js
function chargement_styles_et_javascripts() {

    // JavaScript
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'main', 
        get_template_directory_uri() . '/asset/js/main.js', 
        array('jquery'), 
        '1.0', 
        true
    );

    if( is_front_page()) {
        wp_enqueue_script(
            'front-page', 
            get_template_directory_uri() . '/asset/js/front-page.js', 
            array('jquery', 'main'), 
            '1.0', 
            true
        );
    }

    // CSS
    wp_enqueue_style(
        'tailwind', 
        get_template_directory_uri() . '/tailwind/style.css',
        array(), 
        '1.0'
    );

    wp_enqueue_style( 
        'main', 
        get_template_directory_uri() . '/asset/css/main.css',
        array('tailwind'), 
        '1.0'
    );

    if( is_front_page()) {
        wp_enqueue_style(
            'front-page', 
            get_template_directory_uri() . '/asset/css/front-page.css',
            array(), 
            '1.0'
        );
    }
}

add_action('wp_enqueue_scripts' , 'chargement_styles_et_javascripts');

// Custom Post Type et taxonomie
function declaration_custom_post_type() {
    // cpt
    $labels = array(
        'name' => 'Portfolio',
        'all_items' => 'Tous les projets', 
        'singular_name' => 'Projet',
        'add_new_item' => 'Ajouter un projet',
        'edit_item' => 'Modifier le projet',
        'menu_name' => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail', 'excerpt', 'custom-fields', 'page-attributes'  ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-admin-customizer',
	);

	register_post_type( 'portfolio', $args );

    // taxo
    $labels = array(
        'name' => 'Langages et librairies',
        'new_item_name' => 'Nom du langage',
    	'parent_item' => 'Langage parent',
    );

    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );

    register_taxonomy( 'langages', 'portfolio', $args );

}

add_action( 'init', 'declaration_custom_post_type');