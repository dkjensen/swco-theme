<?php if( is_active_sidebar( 'header-top' ) ) : ?>
<div class="ggrid site-header-row-top top-header-widgets">
    <?php dynamic_sidebar( 'header-top' ); ?>
</div>
<?php endif; ?>

<div class="ggrid site-header-row-1">
    <div class="site-branding gcol">
        <?php the_custom_logo(); ?>
    </div><!-- .site-branding -->

    <?php if( is_active_sidebar( 'header-1' ) ) : ?>

    <div class="site-header-widgets gcol">
        <div class="ggrid">
            <?php dynamic_sidebar( 'header-1' ); ?>
        </div>
    </div><!-- .site-header-widgets -->

    <?php endif; ?>
</div>
<div class="ggrid site-header-row-2">
    <nav id="site-navigation" class="main-navigation gcol-12">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 768 768">
                <title/>
                <path d="M96 192h576v64.5H96V192zm0 223.5v-63h576v63H96zM96 576v-64.5h576V576H96z"/>
            </svg>
        </button>
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'menu-1',
                'menu_id'           => 'primary-menu',
                'container_class'   => 'primary-menu-wrapper',
            ) );
        ?>
    </nav><!-- #site-navigation -->
 </div>