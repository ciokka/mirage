<?php

/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementorChildMaster
 */
$is_elementor_theme_exist = function_exists('elementor_theme_do_location');

if (!defined('ABSPATH')) {
	exit(); // Exit if accessed directly.
}

while (have_posts()) :
	the_post(); ?>

	<?php if (false) { ?>
		<script type="text/javascript" src="/wp-content/themes/hello-theme-child-master/assets/js/bootstrap.min.js"></script>
	<?php } ?>
	<?php $backgroundImg = wp_get_attachment_image_src(
		get_post_thumbnail_id($post->ID),
		'full'
	); ?>
	<main id="brands" role="main">
		<?php if (get_field('immaginebrand')) : ?>
			<section class="py-4 py-xl-5 headPost" style="background: url('<?php the_field(
																				'immaginebrand'
																			); ?>') center / cover; background-color: #000;">
			<?php else : ?>
				<section class="py-4 py-xl-5 headPost" style="background-color: #000;">
				<?php endif; ?>

				<div class="container-fluid h-100">
					<div class="row h-100">
						<div class="text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
							<div>
								<header class="page-header text-uppercase fw-bold postTitle py-4 py-xl-5">
									<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
								</header>
							</div>
						</div>
					</div>
				</div>
				</section>
				<div class="container">
					<div class="row">
						<div class="postContent theContent">
							<div class="wpr-grid-media-wrap" data-overlay-link="yes" style="cursor: pointer;">
								<div class="wpr-grid-image-wrap marchi"><img src="<?php echo $backgroundImg[0]; ?>" alt="<?php the_field('title'); ?>" class="wpr-anim-timing-ease-default">
								</div>
							</div>
							<?php the_content(); ?>
							<div class="pulsanti">
								<?php
								if (get_field('linkbrand')) { ?>
									<a href="<?php the_field('linkbrand') ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button" target="_blank">
										<span class="elementor-button-content-wrapper">
											<span class="elementor-button-text">
												<?php esc_html_e('vai al sito', 'hello-theme-child-master'); ?>
											</span>
										</span>
									</a>
								<?php }
								?>
								<?php
								if (get_field('pdf')) {
									echo do_shortcode(get_field('pdf'));
								}
								?>
								<?php
								if (get_field('pdf2')) {
									echo do_shortcode(get_field('pdf2'));
								}
								?>
							</div>
							<div class="boxLink mt-5">
								<div class="linkBrands">
									<?php esc_html_e('altri brands', 'hello-theme-child-master'); ?>
								</div>
								<?php

								$postTitle = $post->post_title;

								$args = array(
									'post_type' => array('brands'),
									'tag' => 'homebrand',
									'post_status' => 'publish',
								);

								$new_post_loop = new WP_Query($args);

								while ($new_post_loop->have_posts()) {
									$new_post_loop->the_post();

									$post_link = get_permalink();
									if (strtolower(wp_kses_post(get_the_title())) == strtolower($postTitle)) {
										continue;
									}

									printf('<div class="%s"><a href="%s">%s</a></div>', 'linkBrands', esc_url($post_link), wp_kses_post(get_the_title()));
								} ?>
							</div>
						</div>

					</div>

				</div>


				</div>


	</main>

<?php
endwhile;
