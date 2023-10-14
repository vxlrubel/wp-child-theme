<?php

namespace Theme\Children;
// directly acces denied
defined('ABSPATH') || exit;

class WP_Theme_Child{

    // create evil
    private static $instance;

    /**
     * execute default method when activate the child theme
     */
    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * enqueue theme style and scripts
     *
     * @return void
     */
    public function enqueue_scripts(){

        // get parent style
        wp_enqueue_style(
            'parent-style',
            get_template_directory_uri() . '/style.css'
        );

        // enqueue child style
        wp_enqueue_style(
            'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            [ 'parent-style' ]
        );

    }

    /**
     * create singletone instance
     *
     * @return void
     */
    public static function init(){
        if( is_null( self::$instance ) )
            self::$instance = new self();

        return self::$instance;
    }
}

// create child theme object
function child_theme(){
    return WP_Theme_Child::init();
}

// execute the child theme
child_theme();