<?php

function nwtheme_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.
}
add_action( 'customize_register', 'nwtheme_customize_register' );