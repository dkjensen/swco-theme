<?php
/**
 * Template part for displaying the page hero
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */


$thumbnail = get_the_post_thumbnail_url( null, 'full' );

while ( have_posts() ) : the_post(); ?>

<section class="page-hero" <?php if( $thumbnail ) printf( 'style="background-image: url(%s);"', esc_url( $thumbnail ) ); ?>>
    <div class="container">
        <?php if( ! get_post_meta( get_the_ID(), 'hide_title', true ) ) : ?>

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title hero-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        
        <?php endif; ?>
    </div>
</section>

<?php endwhile ?>