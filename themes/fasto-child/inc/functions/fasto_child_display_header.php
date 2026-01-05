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
					<li>
						<a href="#fasto-reader-mode-target" class="fasto-reader-mode-trigger" id="fasto-reader-mode-trigger" aria-label="<?php esc_attr_e( 'Reader mode','fasto' ) ?>"><svg viewBox="0 0 24 24" width="20" height="20"><path fill-rule="nonzero" d="M8.99 2.5c1.148 0 2.231.467 3.015 1.267A4.221 4.221 0 0 1 15.02 2.5h3.735a.75.75 0 0 1 .75.75v.754h1.75a.75.75 0 0 1 .743.649l.007.102V20.25a.75.75 0 0 1-.649.743l-.101.007h-18.5a.75.75 0 0 1-.743-.648l-.007-.102V4.755a.75.75 0 0 1 .648-.744l.102-.006 1.749-.001V3.25a.75.75 0 0 1 .649-.743l.101-.007H8.99ZM4.503 5.504h-1V19.5h7.444a2.866 2.866 0 0 0-1.98-.993l-.195-.007H5.254a.75.75 0 0 1-.743-.648l-.007-.102V5.504Zm15 12.246a.75.75 0 0 1-.75.75h-3.518c-.845 0-1.637.372-2.175 1h7.444V5.504h-1V17.75ZM18.007 3.999 15.02 4l-.194.007c-.837.06-1.6.503-2.071 1.205v12.565l.023-.017a4.35 4.35 0 0 1 2.458-.76l2.77-.001V4.798l-.003-.043.003-.045v-.711ZM8.989 4l-2.985-.001.002.756-.002.028v12.216l2.77.001c.802 0 1.572.22 2.239.62l.24.156V5.211a2.726 2.726 0 0 0-1.878-1.184l-.192-.02L8.99 4Z"/></svg></a>
					</li>
					<li><a href="#searchform" class="search-trigger" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" width="20" height="20"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></a></li>
				</ul>
			</div>
		</div>

		<div class="search-mobile">
			<button class="search-trigger mobile" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" width="20" height="20"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></button>
		</div>

	<?php get_search_form();  ?>

<?php }
