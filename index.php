<?php get_header(); ?>

    <main id="main-content" class="col blog-main" role="main">

        <?php

        if( have_posts() ) :
            while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content/content', get_post_format() ? : 'post' );
                // End the loop.
            endwhile;
        ?>
            <div class="pagination-wrapper">
                <?php get_template_part( 'template-parts/pagination/pagination', 'number' ); ?>
            </div>
    <?php
        else :
            get_template_part( 'template-parts/content/content', 'none' );
        endif;
            ?>

    </main><!-- .site-main -->

<?php get_footer(); ?>
