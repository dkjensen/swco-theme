<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header <?php _s_header_classes(); ?>">
		<div class="container">
			<?php
			switch( get_theme_mod( 'header_layout', 'default' ) ) {
				case 'split' :
					get_template_part( 'template-parts/header/header', 'split' );
					break;
				case 'inline' : 
					get_template_part( 'template-parts/header/header', 'inline' );
					break;
				default :
					get_template_part( 'template-parts/header/header', 'default' );
			}
			?>
		</div><!-- .container -->
	</header><!-- #masthead -->

	<?php
		/**
		 * @hooked _s_hero_header - 10
		 */
		do_action( 'before_site_content' );
	?>

	<div id="content" class="site-content">
		<div class="container">

			<?php
				/**
				 * @hooked _s_show_breadcrumbs - 10
				 */
				do_action( 'before_site_main' );
			?>

			<div class="grid">