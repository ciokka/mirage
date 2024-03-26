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
	the_post();
	?>

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
								<?php //the_title('<h1 class="entry-title">', '</h1>'); ?>
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
						<div class="wpr-grid-image-wrap thumb">
							<div class="btnClose"><a href="javascript:history.back()"><i aria-hidden="true" class="fas fa-angle-left"></i> <?php esc_html_e('indietro', 'hello-theme-child-master'); ?></a></div>
							<h2 class="wpr-grid-item-title">
								<div class="inner-block">
									<?php the_title(); ?>
									<?php
										$marchio = get_post_meta($post->ID, 'marchio', true);
										
									if (is_array($marchio)) {
										$marchio = $marchio[0];
									}
										$res[] = get_the_title($marchio); 

										if (count($res) > 0) {
											$brand = $res[0];
										} else {
											$brand = '';
										}
									?>
									<input id="productBrand" type="hidden" value="<?php echo ($marchio); ?>">
									<p class="brand"><?php echo $brand; ?></p>
								</div>
							</h2>
							<div class="inner-block descrizione">
								<?php the_content(); ?>
							</div>
							<img src="<?php echo $backgroundImg[0]; ?>" alt="<?php the_field('title'); ?>" class="wpr-anim-timing-ease-default">

						</div>
					</div>
					<?php 
				
					$args = array( 
						'post_type' => 'brands',
						'tag' => 'homebrand',
						'posts_per_page' => 100,
						);
						
					$new_post_loop = new WP_Query( $args );

					?>
					<label><?php esc_html_e('Altri prodotti per brand', 'hello-theme-child-master'); ?></label>
						<div class="prodLinksFilters mt-4">
							<?php /** <a class="products-filter-all" href="#"><?php esc_html_e('vedi tutti', 'hello-theme-child-master'); ?></a> */?>
							<?php
								while ( $new_post_loop -> have_posts() ) {
									$new_post_loop -> the_post();
									$backgroundImgProd = wp_get_attachment_image_src(
										get_post_thumbnail_id($post->ID),
										'full'
								); 
							?>
							<a class="products-filter" href="#" id="marchio-<?php echo $post->ID; ?>" data-target="marchio-<?php echo $post->ID; ?>">
								<?php the_post_thumbnail(); ?>
							</a>
							<?php } ?>
						</div>

					<div class="container containerProd">
						<div class="row mt-0 mt-sm-3">
							<?php
							$postTitle = $post->post_title;
							$args = array( 
								'post_type' => 'prodotti',
								'posts_per_page' => 100,
								);
								
							$new_post_loop = new WP_Query( $args );
							while ( $new_post_loop -> have_posts() ) {
								$new_post_loop -> the_post();
								$backgroundImgProd = wp_get_attachment_image_src(
									get_post_thumbnail_id($post->ID),
									'full'
								); 
								if ( strtolower(wp_kses_post( get_the_title() )) == strtolower($postTitle)) {
									continue;
								}
								$marchio = get_field( 'marchio' ); 
								if ( $marchio ) : 
									foreach ( $marchio as $post_ids ) : 
										$object_marchio = $post_ids; 
									endforeach; 
								endif;
								?>

									<div class="col-6 col-sm-4 col-md-3 boxProdotti marchio-<?php echo $object_marchio; ?>" data-overlay-link="yes" style="cursor: pointer;">
										<div class="wpr-grid-image-wrap prodotti">
											<div class="wpr-grid-media-hover wpr-animation-wrap" style="background: url('<?php echo $backgroundImgProd[0]; ?>') center / cover;">
												<a href="<?php the_permalink(); ?>" class="wpr-grid-media-hover-bg">

												</a>
											</div>
										</div>
										<div class="descProdotti">
											<h2 class="wpr-grid-item-title">
												<div class="inner-block"><?php the_title(); ?></div>
											</h2>
											<div class="inner-block"><?php the_content(); ?></div>
										</div>
									</div>

							
							<?php } ?>
						
						</div>
					</div>
				</div>

			</div>

		</div>


		</div>


</main>

<?php
endwhile;

