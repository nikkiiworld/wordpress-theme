<?php get_header(); ?>

    <main id="main-content" class="col blog-main" role="main">

        <?php

        if( have_posts() ) :
            while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content/content', get_post_format() ? : 'post' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

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