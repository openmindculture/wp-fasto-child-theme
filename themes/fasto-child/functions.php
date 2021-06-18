<?php

    function child_theme_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));
    }

    add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

    function child_theme_scripts() {
        /* depend on jquery because our parent scripts do, that we like to modify */
        wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '', true );
    }

    add_action( 'wp_enqueue_scripts', 'child_theme_scripts' );

    function modified_fasto_developer_credit(){
        $url = 'https://wowlayers.com/';
        echo '<div class="copyright-fasto">'.esc_html__( 'WordPress theme: fasto by ','fasto' ).'<a href="'. $url .'" target="_blank">'.esc_html__( 'WOWLayers.com','fasto' ).'</a></div>';
    }

    function child_remove_parent_function() {
        remove_action( 'wp_footer', 'fasto_developer_credit' );
    }

    add_action( 'wp_loaded', 'child_remove_parent_function' );
    add_action( 'wp_footer', 'modified_fasto_developer_credit', 200 );
    