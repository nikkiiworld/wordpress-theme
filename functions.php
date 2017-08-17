<?php

/**
 * Define variables
 */
define('NWTHEME_URI', get_template_directory_uri());
define('NWTHEME_DIR', get_template_directory());

/**
 * Theme setup
 */
if ( ! function_exists('nwtheme_setup' ) ){
    function nwtheme_setup(){

        /* Load scripts and styles */
        add_action('wp_enqueue_scripts', 'nwtheme_enqueue_assets');

        /* Set the content width */
        if ( !isset($content_width) ) { $content_width = 1170; }

        /* Register menus */
        add_action('init', 'nwtheme_menu_init');

        /* Add thumbnails support */
        add_theme_support( 'post-thumbnails' );

        /* Add images sizes*/
        add_image_size('nwtheme_medium', 960);
        add_image_size('nwtheme_small', 600);
        add_image_size('nwtheme_featured', 800, 300, true);
        add_image_size('nwtheme_gallery_thumb', 9999, 640, false);
        add_image_size('nwtheme_blog_thumb', 550, 360, true);
        add_image_size('nwtheme_square_thumb', 800, 800, true);
        add_image_size('nwtheme_portfolio_thumb', 800);

        /* Post formats */
        add_theme_support('post-formats', array('audio', 'video', 'quote', 'image', 'gallery', 'link'));

        /* Custom background */
        add_theme_support( 'custom-background',
            array(
                'default-color' => 'ffffff',
                'default-image'          => '',
                'default-repeat'         => '',
                'default-position-x'     => '',
                'default-attachment'     => '',
            ) );

        $defaults = array(
            'default-image'          => NWTHEME_URI . '/images/pexels-photo-195280-min.jpg',
            'width'                  => 1920,
            'height'                 => 500,
            'flex-height'            => true,
            'flex-width'             => true,
            'uploads'                => true,
            'random-default'         => false,
            'header-text'            => true,
            'default-text-color'     => '',
        );
        add_theme_support( 'custom-header', $defaults );

        /* Custom logo */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

        /* Automatic feed links */
        add_theme_support( 'automatic-feed-links' );

        /* Allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption. */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        /* Title tag */
        if ( function_exists( '_wp_render_title_tag' ) ) {
            add_theme_support( 'title-tag' );
        }

    }
}
add_action( 'after_setup_theme', 'nwtheme_setup' );

/**
 * Get Google Fonts
 */
function nwtheme_fonts_url(){
    $font_url = '';
    $font_families = array();

    $open_sans = 'Open Sans:300,400';
    $raleway = 'Raleway:300,400';
    $playfair_display = 'Playfair Display:400,700';

    $font_families[] = $open_sans;
    $font_families[] = $raleway;
    $font_families[] = $playfair_display;

    $font_url = add_query_arg( 'family', urlencode( implode($font_families, '|') ), "//fonts.googleapis.com/css" );

    return esc_url_raw($font_url);
}

/**
 * Enqueue scripts and styles
 */
if ( ! function_exists('nwtheme_enqueue_assets') ) {
    function nwtheme_enqueue_assets(){

        /**
         * Enqueue styles
         */
        /* Bootstrap */
        wp_enqueue_style('bootstrap', NWTHEME_URI . '/vendor/bootstrap4/css/bootstrap.css');

        /* Fontawesome */
        wp_enqueue_style('font-awesome', NWTHEME_URI . '/vendor/font-awesome/css/font-awesome.min.css');

        /* Theme main stylesheet */
        wp_enqueue_style('style', get_stylesheet_uri(), '');

        /* Custom styles */
        wp_enqueue_style('navigation-styles', NWTHEME_URI . '/css/navigations.css');
        wp_enqueue_style('header-styles', NWTHEME_URI . '/css/headers.css');
        wp_enqueue_style('widget-styles', NWTHEME_URI . '/css/widgets.css');
        wp_enqueue_style('post-styles', NWTHEME_URI . '/css/posts.css');
        wp_enqueue_style('footer-styles', NWTHEME_URI . '/css/footers.css');
        wp_enqueue_style('pagination-styles', NWTHEME_URI . '/css/paginations.css');
        wp_enqueue_style('comment-styles', NWTHEME_URI . '/css/comments.css');
        wp_enqueue_style('default-styles', NWTHEME_URI . '/css/default.css');

        /* Load fonts */
        wp_enqueue_style( 'nwtheme-googlefonts', nwtheme_fonts_url(), array(), '1.0.0' );


        /**
         * Enqueue scripts
         */
        /* jQuery */
        wp_enqueue_script( 'jquery', NWTHEME_URI . '/vendor/jquery/dist/jquery.min.js', array(), false, true );

        /* Bootstrap */
        wp_enqueue_script( 'popper', NWTHEME_URI . '/vendor/popperjs/umd/popper.js', array('jquery'), false, true );
        wp_enqueue_script( 'bootstrap-js', NWTHEME_URI . '/vendor/bootstrap4/js/bootstrap.js', array('jquery','popper'), false, true );

        /* Comment reply */
        if ( is_singular() && comments_open() ) {
            wp_enqueue_script('comment-reply');
        }
        /* Theme main js file */
        wp_enqueue_script('main', NWTHEME_URI . '/js/main.js', array('jquery'), false, true);

    }
}

/**
 * Register navigation menus
 */
if (! function_exists('nwtheme_menu_init') ) {
    function nwtheme_menu_init(){

        /**
         * Bootstrap structure and style for Wordpress menu
         * For Bootstrap 3.* uncomment use this line:
         * require_once('inc/wp-bootstrap-navwalker.php');
         * For Bootstrap 4.* use this
         * require_once('inc/bs4navwalker.php');
         */
        /* Register Custom Navigation Walker */
        require_once('inc/bs4navwalker.php');

        register_nav_menus(
            array(
                'primary'      => __('Header Navigation', 'nwtheme-wp'),
                'sidebar-menu' => __( 'Sidebar Menu' ),
                'social-menu' => __( 'Social Menu' ),
                'footer-menu' => __( 'Footer Menu' ),
            )
        );
    }
}

/**
 * Register sidebars
 */
if ( ! function_exists( 'nwtheme_widget_init' ) ) {
    function nwtheme_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            /* Register Sidebar-1 sidebar */
            register_sidebar(
                array(
                    'name'			=> esc_html__( 'Sidebar Widget Area', 'nwtheme' ),
                    'id'			=> 'sidebar-1',
                    'description'	=> esc_html__( 'Appears on posts and pages.', 'nwtheme' ),
                    'before_widget'	=> '<div id="%1$s" class="nwtheme-widget %2$s">',
                    'after_widget'	=> '</div> <!-- end widget -->',
                    'before_title'	=>	'<div class="widget-title"> <h3>',
                    'after_title'	=>	'</h3></div>'
                )
            );
        }
    }
    add_action( 'widgets_init', 'nwtheme_widget_init' );
}

/**
 * Install Plugins Required
 */
require get_template_directory() . '/inc/require-plugins.php';

if( ! function_exists( 'custom_comment' ) ){
    function custom_comment($comment, $args, $depth) {
        switch ($comment->comment_type) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <div class="comments">
                    <div class="comment-meta">
                        <div class="avatar"><?php  echo get_avatar($comment, 44); ?></div>
                        <div class="comment-author">
                            <?php printf(esc_html__('%s ', 'nwtheme'),
                                sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) );
                            ?>
                        </div>
                        <span class="date">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
                                <i class="fa fa-clock-o"></i>
                                <?php printf(esc_html__('%1$s. %2$s', 'nwtheme'), get_comment_date(), get_comment_time()); ?>
                            </a>
                        </span>
                        <span class="reply">
                            <?php
                                comment_reply_link(
                                    array_merge( $args,
                                        array(
                                            'depth' => $depth,
                                            'max_depth' => $args['max_depth'],
                                            'reply_text ' => 'Válasz'
                                        )
                                    )
                                );
                            ?>
                        </span>
                    </div>

                    <div class="comment-text">

                        <?php if ($comment->comment_approved == '0') : ?>
                            <div class="alert alert-info" role="alert"><?php esc_html_e('A hozzászólás moderálásra vár.', 'nwtheme'); ?></div>
                        <?php endif; ?>
                        <div class="comment-content-text">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                </div>
                <?php
                break;
            case 'pingback' :
            case 'trackback' : ?>
                <li class="post pingback">
                <p><?php esc_html_e('Pingback:', 'nwtheme'); ?> <?php comment_author_link(); ?><?php edit_comment_link(esc_html__('(Edit)', 'nwtheme'), ' '); ?></p>
                <?php
                break;
        endswitch;
    }
} 
