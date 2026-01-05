<?php
/**
 * Theme header forked from fasto/header.php
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<meta name="blogarama-site-verification" content="blogarama-6a414a1a-408c-47d6-acea-3a8694f29156">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); //added backward compatibility for this function in functions/theme.php ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fasto' ); ?></a>
<div class="overlay"></div>
<div class="site-grid" id="fasto-reader-mode-target"><!-- start .site-grid -->
<header id="theme-header" role="banner" class="fasto-child"><!-- header#theme-header -->
<?php
	include ('inc/functions/fasto_child_display_header.php');
	fasto_child_display_header();
?>
</header><!-- end header#theme-header -->
<?php if ( has_header_image() ) { ?>
<img src="<?php header_image(); ?>" class="header-image" alt="<?php esc_attr_e( 'Header image','fasto' ); ?>" />
<?php } ?>
<div class="site-grid-inner"><!-- start .site-grid-inner -->
