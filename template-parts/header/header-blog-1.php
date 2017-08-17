<div class="navigation-top">
    <div class="wrap">
<?php if ( has_nav_menu( 'primary' ) ) : ?>
            <?php
                get_template_part( 'template-parts/navigation/navigation', 'default' );
            ?>
    <?php
else : ?>
    <p class="nav-error">Nincs menü beállítva</p>
<?php endif; ?>
    </div>
</div>
<?php
    $header = get_custom_header();
    $style = '';
    if( $header->url !== "" ) : $style = "background-image: url('".$header->url."');"; endif;
?>

<div class="blog-header-1" style="<?php echo $style; ?>">
    <div class="container">
        <h1 class="title display-3">
            <?php bloginfo( 'name' ); ?>
        </h1>
        <p class="description"><?php bloginfo( 'description' ); ?></p>
    </div>
</div>
