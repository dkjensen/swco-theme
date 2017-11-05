<div class="grid">
    <div class="site-branding">
        <?php the_custom_logo(); ?>
    </div><!-- .site-branding -->

    <?php if( is_active_sidebar( 'header-1' ) ) : ?>

    <div class="site-header-widgets col-right">
        <?php dynamic_sidebar( 'header-1' ); ?>
    </div><!-- .site-header-widgets -->

    <?php endif; ?>
</div>
<div class="grid">
    <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );
        ?>
    </nav><!-- #site-navigation -->
 </div>