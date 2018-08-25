<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

$footer_columns = (int) get_theme_mod( 'footer_columns', '1' );
$site_info 		= get_theme_mod( 'site_info' );

?>

			</div><!-- .grid -->
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<?php if( is_active_sidebar( 'footer-top' ) ) dynamic_sidebar( 'footer-top' ); ?>
			<div class="footer-widgets">
				<div class="ggrid">
					<?php for( $i = 1; $i <= ( ( $footer_columns < 1 || $footer_columns > 6 ) ? 1 : $footer_columns ); $i++ ) : ?>

					<div class="gcol_xs-12">
						<div class="footer-widget-area">

							<?php dynamic_sidebar( 'footer' . ( $i > 1 ? '-' . $i : '' ) ); ?>

						</div>
					</div>

					<?php endfor; ?>
				</div>
			</div>
			<?php if( is_active_sidebar( 'footer-bottom' ) ) dynamic_sidebar( 'footer-bottom' ); ?>
			<div class="site-info">
				<?php print apply_filters( 'comment_text', $site_info ); ?>
			</div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>