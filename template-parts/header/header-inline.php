<div class="grid">
    <div class="site-branding col">
        <?php if( get_theme_mod( 'header_text', 1 ) ) : ?>

        123

        <?php else : ?>
        
        <?php the_custom_logo(); ?>
        
        <?php endif; ?>
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
</div>