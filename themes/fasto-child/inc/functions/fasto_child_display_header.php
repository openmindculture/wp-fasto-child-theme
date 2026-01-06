<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
=================================================================================================================
fasto_child_display_header() forked from:
fasto_display_header() - Display theme header
=================================================================================================================
*/

function fasto_child_display_header(){ ?>

		<div class="logo">
			<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
			<!-- BEGIN patch prevent multiple H1 headings -->
			<div class="site-title fasto-child"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
			<!-- END patch prevent multiple H1 headings -->
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>

		<nav class="primary" id="primary" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"  aria-label="<?php esc_attr_e( 'Primary Menu', 'fasto' ); ?>">

			<button class="mobile-menu-icon mobile-trigger mobile-trigger--slider" aria-label="<?php esc_attr_e( 'Open mobile menu','fasto' ) ?> aria-controls="primary" aria-expanded="false">
				<span class="mobile-trigger-box">
					<span class="mobile-trigger-inner"></span>
					<span class="screen-reader-text"><?php esc_html_e('Menu','fasto') ?></span>
				</span>
			</button>

		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary', 'menu_class' => 'menu', 'container' => '', ) ); ?>

		</nav>

		<div class="author-social-search">
			<div class="social-and-search">
				<ul>
					<?php fasto_output_social(); ?>
					<li class="fasto-child-desktop-only"><?php include_once (get_stylesheet_directory() . '/inc/functions/fasto_child_reader_mode_trigger.php');
						echo fasto_child_reader_mode_trigger(); ?></li>
					<li><a href="#searchform" class="search-trigger" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" width="20" height="20"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></a></li>
				</ul>
			</div>
		</div>

		<div class="search-mobile">
			<button class="search-trigger mobile" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" width="20" height="20"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></button>
		</div>

	<?php get_search_form();  ?>

<?php }
