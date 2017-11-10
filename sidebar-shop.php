<?php
/**
 * The sidebar containing the shop widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */


$shop_layout = get_theme_mod( 'shop_layout', 'sidebar-left' );
$single_template = get_theme_mod( 'product_layout', 'hero' );

if ( ! is_active_sidebar( 'sidebar-shop' ) || $shop_layout === 'sidebar-none' || $single_template === 'hero' ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-4<?php print ( $shop_layout === 'sidebar-left' ) ? '-first' : '-last'; ?>">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside><!-- #secondary -->
