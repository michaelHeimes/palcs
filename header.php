<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/assets/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/assets/images/favicon-16x16.png">
	<link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/assets/images/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'trailhead' ); ?></a>

			<div class="off-canvas-wrapper">
			
			<!-- Load off-canvas container. Feel free to remove if not using. -->			
			<?php get_template_part( 'template-parts/content', 'offcanvas' ); ?>
			
				<div class="off-canvas-content" data-off-canvas-content>
					<header class="site-header">
						<?php get_template_part( 'template-parts/nav', 'offcanvas-topbar' ); ?>
					</header><!-- #masthead -->
					
					<div id="page" class="site">

	