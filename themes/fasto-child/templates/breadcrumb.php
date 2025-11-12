<?php
/**
 * Template for breadcrumb navigation
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<?php if ( !fasto_is_home_or_front() ) { ?>
<div class="breadcrumb-navigation">
<?php if ( is_category() ) { ?>
<h1 class="page-title"><?php single_cat_title(); ?></h1>
<?php if ( !is_archive() ) { ?>
	<?php fasto_cat_breadcrumb(); ?>
<?php } ?>
<?php } ?>

<?php if ( is_author() ) { ?>
<div class="author-box"><!-- start .author-box -->
	<div class="author">
	<?php
		echo fasto_author_avatar(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									// fasto_author_avatar() - uses get_avatar() - which is escaped in WordPress core
	?>
	</div>
	<h3 class="primary-font color-1"><?php esc_attr_e('About author','fasto'); ?></h3>
	<h1><?php echo esc_html( fasto_author_info( 'nickname' ) ); ?></h1>
	<p><?php echo esc_html( fasto_author_info( 'description' ) ); ?></p>
</div><!-- end .author-box -->
<?php } ?>

<?php if ( is_tag() ) { ?>
<h1 class="page-title"><?php single_tag_title(); ?></h1>
<?php fasto_breadcrumb(); ?>
<?php } ?>

<?php if ( is_year() ) { ?>
<h1 class="page-title"><?php echo esc_html( get_the_time('Y') ); ?></h1>
<?php fasto_breadcrumb(); ?>
<?php } ?>

<?php if ( is_month() ) { ?>
<h1 class="page-title"><?php echo esc_html( get_the_time('F') ).' '.esc_html( get_the_time('Y') ); ?></h1>
<?php fasto_breadcrumb(); ?>
<?php } ?>

<?php if ( is_day() ) { ?>
<h1 class="page-title"><?php echo esc_html( get_the_time('d') ).' '.esc_html( get_the_time('F') ).' '.esc_html( get_the_time('Y') ); ?></h1>
<?php fasto_breadcrumb(); ?>
<?php } ?>
</div>
<?php } ?>
