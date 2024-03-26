<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementorChildMaster
 */
 
if (!defined('ABSPATH')) {
	exit(); // Exit if accessed directly.
}

while (have_posts()):
	the_post(); ?>

<?php if (false) { ?>
<script type="text/javascript" src="/wp-content/themes/hello-theme-child-master/assets/js/bootstrap.min.js"></script>
<?php } ?>
<?php $backgroundImg = wp_get_attachment_image_src(
		get_post_thumbnail_id($post->ID),
		'full'
	); ?>
<main id="prodotti" role="main">

		<section class="py-4 py-xl-5 headPost" style="background-color: #000;">

			<div class="container-fluid h-100">
				<div class="row h-100">
					<div
						class="text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
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
						<div class="wpr-grid-image-wrap thumb"><img src="<?php echo $backgroundImg[0]; ?>" alt="<?php the_field('title'); ?>" class="wpr-anim-timing-ease-default"></div>
					</div>

					<?php the_content(); ?>

					<div class="row mt-5">
						
					

					<?php

					$postTitle = $post->post_title;

					$args = array( 
						'post_type' => 'prodotti',
						);
						
					$new_post_loop = new WP_Query( $args );
					var_dump($new_post_loop);

					
					while ( $new_post_loop -> have_posts() ) {
						$new_post_loop -> the_post();

						$post_link = get_permalink();
						$backgroundImgProd = wp_get_attachment_image_src(
							get_post_thumbnail_id($post->ID),
							'full'
						); 
						if ( strtolower(wp_kses_post( get_the_title() )) == strtolower($postTitle)) {
							continue;
						}
						?>
						<div class="col-3" data-overlay-link="yes" style="cursor: pointer;">
							<div class="wpr-grid-image-wrap prodotti"
								style="background: url('<?php echo $backgroundImgProd[0]; ?>') center / cover;">
								<div class="wpr-grid-media-hover wpr-animation-wrap">
								<button class="wpr-grid-media-hover-bg">
								<div class="wpr-grid-media-hover-bottom elementor-clearfix">
									<h2
										class="wpr-grid-item-title">
										<div class="inner-block"><?php the_title(); ?></div>
									</h2>
									<div
										class="wpr-grid-item-read-more">
										<div class="inner-block"><?php the_content(); ?></div>
									</div>
								</div>
							</div>
							</div>

						</div>
					
					<?php } ?>
					
					</div>
				</div>

			</div>

		</div>


		</div>


</main>

<?php
endwhile;