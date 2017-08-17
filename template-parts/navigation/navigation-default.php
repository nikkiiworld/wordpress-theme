<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-style-1" role="navigation">
    <div class="container">
        <div class="row justify-content-between">

            <div class="navbar-brand-wrapper">
                <?php
                    if( has_custom_logo() ) : the_custom_logo(); endif;
                ?>
                <a class="navbar-brand" href=""><?php bloginfo('name'); ?></a>
            </div>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#nwtheme-primary-nav" aria-controls="nwtheme-primary-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <?php
            wp_nav_menu([
                'menu'            => 'primary',
                'theme_location'  => 'primary',
                'container'       => 'div',
                'container_id'    => 'nwtheme-primary-nav',
                'container_class' => 'collapse navbar-collapse',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav mr-auto nwtheme-nav',
                'depth'           => 3,
                'fallback_cb'     => 'bs4navwalker::fallback',
                'walker'          => new bs4navwalker()
            ]);
            ?>
        </div>
    </div>

</nav>