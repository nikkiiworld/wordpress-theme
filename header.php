<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
    <meta name="description" content="<?php esc_attr( bloginfo( 'description' ) ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php wp_title(); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

    <div id="wrapper">

        <?php get_template_part('template-parts/header/header', 'blog-1'); ?>

        <div class="site-wrapper container">
            <div class="row">

                <aside id="sidebar" class="col-md-4 sidebar">
                    <?php get_sidebar(); ?>
                </aside>





