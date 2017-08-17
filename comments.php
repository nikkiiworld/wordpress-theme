<?php
/**
 * The template for Comments.
 *
 */
    if ( post_password_required() ) {
        return;
    }
?>
<div class="comments-inner">

    <h4 id="comments-title">
        <?php $post_comments = esc_html__('Hozzászólások', 'nwtheme');
        printf($post_comments.' <em>(%1$s)</em>', get_comments_number(), number_format_i18n(get_comments_number()), '' . get_the_title() . ''); ?>
    </h4>

    <?php if ( have_comments() ) : ?>

        <a name="comments"></a>

        <div class="comments-container">

            <?php if ( post_password_required() ) : ?>
                <p><?php esc_html_e( 'Ez a bejegyzés jelszó-védett. A megtekintéshez add meg a jelszót.', 'nwtheme' ); ?></p>
                <?php
                return;
            endif;

            if ( have_comments() ) :

                if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>

                    <div id="pagination" class="pagination">
                        <?php paginate_comments_links( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
                    </div>

                <?php endif; ?>

                <ol class="commentlist">
                    <?php wp_list_comments( array('callback' => 'custom_comment', 'avatar_size' => 96) ); ?>
                </ol>

                <?php

            else :

                if ( !comments_open() ) : ?>
                    <p class="no-comments"><?php esc_html_e( 'A hozzászólás ki van kapcsolva.', 'nwtheme' ); ?></p>
                <?php endif;

            endif; ?>

        </div>

    <?php endif; ?>

    <div class="comments-container">
        <?php
            ob_start();
            $commenter = wp_get_current_commenter();
            $req = true;
            $aria_req = ( $req ? " aria-required='true'" : '' );

            $comments_arg = array(
                'form'	=> array(
                    'class' => ''
                ),
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'autor' => '<div class="form-group">' .
                        '<label for="author">' . __( 'Név', 'nwtheme' ) . '</label> ' .
                        ( $req ? '<span>*</span>' : '' ) .
                        '<input id="author" name="author" class="form-control" type="text" value="" size="30"' . $aria_req . ' />'.
                        '<p id="d1" class="text-danger"></p>' .
                        '</div>',
                    'email' =>  '<div class="form-group">' .
                        '<label for="email">' . __( 'Email', 'nwtheme' ) . '</label> ' .
                        ( $req ? '<span>*</span>' : '' ) .
                        '<input id="email" name="email" class="form-control" type="text" value="" size="30"' . $aria_req . ' />'.
                        '<p id="d2" class="text-danger"></p>' .
                        '</div>',
                    'url' => '')),
                'comment_field' =>  '<div class="form-group">' .
                    '<label for="comment">' .
                    __( 'Hozzászólás', 'nwtheme' ) .
                    '</label><span>*</span>' .
                    '<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea>
                                <p id="d3" class="text-danger"></p>' .
                    '</div>',
                'comment_notes_after' 	=> '',
                'class_submit'			=> 'btn btn-default'
            );
        ?>
        <?php
            comment_form($comments_arg);
            echo str_replace(   'class="comment-form"',
                'class="comment-form" name="commentForm" onsubmit=""',
                ob_get_clean()
            );
        ?>
    </div>

</div>
