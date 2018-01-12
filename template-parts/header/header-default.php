<?php if( is_active_sidebar( 'header-top' ) ) : ?>
<div class="grid site-header-row-top top-header-widgets">
    <?php dynamic_sidebar( 'header-top' ); ?>
</div>
<?php endif; ?>

<div class="grid site-header-row-1">
    <div class="site-branding col">
        <?php the_custom_logo(); ?>
    </div><!-- .site-branding -->

    <?php if( is_active_sidebar( 'header-1' ) ) : ?>

    <div class="site-header-widgets col">
        <div class="grid">
            <?php dynamic_sidebar( 'header-1' ); ?>
        </div>
    </div><!-- .site-header-widgets -->

    <?php endif; ?>
</div>
<div class="grid site-header-row-2">
    <nav id="site-navigation" class="main-navigation col-12">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );
        ?>
    </nav><!-- #site-navigation -->
 </div>