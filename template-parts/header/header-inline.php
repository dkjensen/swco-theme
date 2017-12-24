<div class="grid-middle">
    <div class="col-3">
        <div class="site-branding">
            <?php the_custom_logo(); ?>
        </div><!-- .site-branding -->
    </div>
    <div class="col" data-push-right="off-3">
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
</div>