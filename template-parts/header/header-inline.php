<div class="grid site-header-row-1">
    <div class="site-branding col">
        <?php the_custom_logo(); ?>
    </div><!-- .site-branding -->

    <nav id="site-navigation" class="main-navigation col">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );
        ?>
    </nav><!-- #site-navigation -->

    <?php if( is_active_sidebar( 'header-1' ) ) : ?>
    <div class="site-header-widgets col">
        <?php dynamic_sidebar( 'header-1' ); ?>
    </div><!-- .site-header-widgets -->
    <?php endif; ?>
</div>