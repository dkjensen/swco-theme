<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

$categories = (array) wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );

$cat_color = ! empty( $categories ) ? get_term_meta( $categories[0], 'cc_color', true ) : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-post gcol-6_sm-12' ); ?>>
	<div class="grid-post-text <?php //print ( has_post_thumbnail() ? ' has-post-thumbnail' : '' ) . ( ! empty( $cat_color ) ? ' has-color' : '' ); ?>" <?php //print ( ! empty( $cat_color ) && ! has_post_thumbnail() ) ? sprintf( 'style="background: %s;"', $cat_color ) : ''; ?>>
		<?php if( has_post_thumbnail() ) : ?>
		<div class="grid-post-thumbnail">
			<a href="<?php print esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail( 'full' ); ?></a>
		</div>
		<?php endif; ?>
		<header class="grid-post-header">
			<?php _s_post_categories(); ?>
			
			<?php the_title( '<h2 class="grid-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .grid-post-header -->

		<div class="grid-post-content">
			<?php 
				if( ! has_post_thumbnail() ) {
					print wp_trim_words( get_the_excerpt(), 50 );
				}else {
					print wp_trim_words( get_the_excerpt(), 15 );
				}
			?>
		</div><!-- .grid-post-content -->

		<footer class="grid-post-footer">
			<div class="grid-post-meta">
				<span class="grid-post-author">
					<?php print '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_avatar( get_the_author_meta( 'ID' ), 64 ) . '<span>' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'; ?>
				</span>
				<span class="grid-post-sep"></span>
				<span class="grid-post-date">
					<i class="fa fa-calendar"></i>
					<?php the_date(); ?>
				</span>
			</div>
		</footer><!-- .grid-post-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
