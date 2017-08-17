<?php while ( have_posts() ) : the_post(); ?>
<div <?php post_class(); ?>>
    <div class="card mb-3">

        <?php
        if ( has_post_thumbnail() ) :
            $url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured')[0];
        else :
            $url =  NWTHEME_URI .'/images/pexels-photo-195280-min.jpg';
        endif; ?>
        <div class="featured-image" style="background-image: url('<?php echo $url;?>');"></div>
        <div class="card-body">
            <div class="text-center category">
                <?php the_category(' '); ?>
            </div>
            <h4 class="card-title">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h4>
            <div class="card-date">
                <span>
                    <i class="fa fa-clock-o"></i> <?php echo get_the_date('Y.m.d H:i'); ?>,
                </span>
                <span>
                    <i class="fa fa-user"></i> <?php echo get_the_author(); ?>
                </span>

            </div>
            <div class="card-text">
                <?php the_content(); ?>
            </div>
            <div class="card-bottom">
                <div class="container">
                    <div class="row align-items-stretch">
                        <div class="col comments">
                            <a href="<?php comments_link(); ?>">
                                <i class="fa fa-comment-o"></i> Szólj hozzá!
                            </a>
                        </div>
                        <div class="col social-links">
                            <?php if( function_exists('wpfai_social') ) : echo wpfai_social();
                            else : echo 'Bővítmény szükséges!';
                            endif; ?>
                        </div>
                        <div class="col tags">
                            <?php
                            if( !has_tag() ) :
                                echo 'Nincs címke megadva.';
                            else :
                                echo the_tags('<i class="fa fa-tag"></i>', ', ','');
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php endwhile; ?>

    <?php comments_template(); ?>

    <div class="pagination-wrapper">
        <div class="container">
            <div class="row justify-content-space-around">
                <div class="col"><?php previous_post_link(); ?></div>
                <div class="col"><?php next_post_link();  ?></div>
            </div>
        </div>

    </div>

