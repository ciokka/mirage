<?php
/**
 * The template for displaying search results.
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
			<h1 class="entry-title">
				<?php esc_html_e( 'Risultati per: ', 'hello-theme-child-master' ); ?>
				<strong><?php echo get_search_query(); ?></strong>
			</h1>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php if ( have_posts() ) : ?>
			<?php
				while ( have_posts() ) :
				the_post();
				?>

					<div class="row searchRes">
						<div class="col-md-9">
							<?php printf( '<h2><a class="titPostLink" href="%s">%s</a></h2>', esc_url( get_permalink() ), esc_html( get_the_title() ) );?>
							<span class="dataPost"><?php the_date();?></span>
							<?php the_excerpt(); ?>
						</div>
						<div class="col-md-3 imgThumb">
							<?php the_post_thumbnail(); ?>
						</div>
					</div>

				<?php
				endwhile;
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'Sembra che non esista quello che stai cercando', 'hello-theme-child-master' ); ?></p>
		<?php endif; ?>
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
