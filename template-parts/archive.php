<?php
/**
 * The template for displaying archive pages.
 *
 * @package HelloElementorChildMaster
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main" role="main">

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<p class="archive-description">', '</p>' );
			?>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php
		while ( have_posts() ) {
			the_post();
			$post_link = get_permalink();
			?>

			<article class="row post">
						<div class="col-md-9">
							<?php printf( '<h2><a class="titPostLink" href="%s">%s</a></h2>', esc_url( get_permalink() ), esc_html( get_the_title() ) );?>
							<span class="dataPost"><?php the_date();?></span>
							<?php the_excerpt(); ?>
						</div>
						<div class="col-md-3 imgThumb">
							<?php the_post_thumbnail(); ?>
						</div>

			</article>
		<?php } ?>
	</div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav class="pagination" role="navigation">
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s + vecchio', 'hello-theme-child-master' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( '+ nuovo %s', 'hello-theme-child-master' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
