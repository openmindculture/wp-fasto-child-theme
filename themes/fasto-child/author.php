<?php
get_header();
$author = get_queried_object();
if ( $author instanceof WP_User ) {
?>
<div class="article-single">

	<h1 class="article-title"><?php echo esc_html( $author->display_name ); ?> - Open Mind Culture Blog</h1>

	<div class="author-box"><!-- start .author-box -->
		<div class="author vcard">
			<div class="primary-font color-1"><?php esc_html_e('About author', 'fasto'); ?></div>
			<h2>Ingo Steinke</h2>
			<p><?php echo esc_html( get_the_author_meta( 'description', $author->ID ) ); ?></p>

			<?php if ($author->ID == 1) { ?>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@id": "https://www.ingo-steinke.de/",
						"@type": "Person",
						"name": "Ingo Steinke",
						"jobTitle": "Web Developer",
						"url": "https://www.ingo-steinke.de/",
						"sameAs": [
							"https://www.google.com/maps?cid=8458046942524580197",
							"https://www.linkedin.com/in/ingosteinke/",
							"https://github.com/openmindculture",
							"https://mastodon.social/@openmindculture",
							"https://dev.to/ingosteinke",
							"https://ingosteinke.substack.com/",
							"https://www.open-mind-culture.org/author/ingo-steinke/",
							"https://stackoverflow.com/users/5069530/ingo-steinke"
						]
					}
				</script>
			<?php } ?>
		</div>
	</div><!-- end .author-box -->

</div>
<?php }
