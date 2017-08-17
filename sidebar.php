<div id="sidebar-primary" class="sidebar">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>
        <p>Upsz! Úgy tűnik nincs egyetlen widget sem!</p>
        <p>Ha kóddal szeretnéd az oldalsávot elkészíteni, azt a template-parts/sidebar/sidebar-html.php fájlban tudod megtenni.</p>
        <?php get_template_part( 'template-parts/sidebar/sidebar', 'html'); ?>
    <?php endif; ?>
</div>