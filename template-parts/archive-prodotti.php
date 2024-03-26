<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementorChildMaster
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<main id="prodotti" class="archivio" role="main">

	<!-- <section class="py-4 py-xl-5 headPost" style="background-color: #000;">

			<div class="container-fluid h-100">
				<div class="row h-100">
					<div
						class="text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
						<div>
							<header class="page-header text-uppercase fw-bold postTitle py-4 py-xl-5" style="color: aliceblue;">
								<?php the_archive_title('<h1 class="entry-title">', '</h1>'); ?>
							</header>
						</div>
					</div>
				</div>
			</div>
		</section> -->
	<div class="container">

		<div class="row">
			<div class="postContent theContent">
				<div class="wpr-grid-media-wrap" data-overlay-link="yes" style="cursor: pointer;">

				</div>
				<?php

				$args = array(
					'post_type' => 'brands',
					'tag' => 'homebrand',
					'posts_per_page' => 100,
					'orderby' => 'title',
					'order'   => 'DESC',
				);
				
				$new_post_loop = new WP_Query($args);

				?>

				<div class="container containerProd">
					<div class="row mt-0 mt-sm-3">
						<?php
						$postTitle = $post->post_title;
						$args = array(
							'post_type' => 'prodotti',
							'posts_per_page' => 100,
						);
						
						$new_post_loop = new WP_Query($args);

						//Primo ciclo per determinare gli N brands
						$brandsArray = [];

						while ($new_post_loop->have_posts()) {
							$new_post_loop->the_post();

							$marchio = get_field('marchio');

							

							if ($marchio):
								foreach ($marchio as $post_ids):

									$b_post = get_post($post_ids);
									if (count($brandsArray) > 0) {
										$save = true;
										foreach ($brandsArray as $k => $v) {
											if ($v == $post_ids) {
												$save = false;
												continue;
											}
										}


										if ($save) {
											$brandsArray[$b_post->post_date] = $post_ids;
										}

									} else {
										$brandsArray[$b_post->post_date] = $post_ids;
									}


								endforeach;
							endif;
						}

						ksort($brandsArray);

						$newBrandsArray = [];

						foreach ($brandsArray as $k => $v) {
							$newBrandsArray[$k]['brand_id'] = $v;
							$newBrandsArray[$k]['products'] = [];
						}

						$brandsArray = $newBrandsArray;

						if ($new_post_loop->have_posts()) {

							while ($new_post_loop->have_posts()) {
								$new_post_loop->the_post();

								$marchio = get_field('marchio');

								if ($marchio):
									foreach ($marchio as $post_ids):
										$object_marchio = $post_ids;
									endforeach;
								endif; foreach ($brandsArray as $k => &$v) {
									if ($v['brand_id'] == $object_marchio) {
										$v['product_id'][] = $post->ID;

									}
								}

							}
						}


						foreach ($brandsArray as $key => $val) {
							$brandId = $val['brand_id'];
							$productsId = $val['product_id'];


							$backgroundImgBrand = wp_get_attachment_image_src(
								get_post_thumbnail_id($brandId),
								'full'
							);
							?>
							<div class="col-12 col-sm-4 col-md-3 boxProdotti">
								<div class="wpr-grid-image-wrap prodotti">
									<a href="<?php echo get_permalink($brandId) ?>">
										<div class="wpr-grid-media-hover wpr-animation-wrap logoBrand"
											style="background: url('<?php echo $backgroundImgBrand[0]; ?>') top / contain no-repeat;">
										</div>
									</a>
								</div>
							</div>
							<?php
							foreach ($productsId as $pid) {
								$content_post = get_post($pid);
								$content = $content_post->post_content;
								$backgroundImgProd = wp_get_attachment_image_src(
									get_post_thumbnail_id($pid),
									'full'
								);
								?>

								<div class="col-6 col-sm-4 col-md-3 boxProdotti marchio-<?php echo $object_marchio; ?>"
									data-overlay-link="yes" style="cursor: pointer;">
									<div class="wpr-grid-image-wrap prodotti">
										<div class="wpr-grid-media-hover wpr-animation-wrap"
											style="background: url('<?php echo $backgroundImgProd[0]; ?>') center / cover;">
											<a href="<?php echo get_the_permalink($pid); ?>"
												class="wpr-grid-media-hover-bg"></a>
										</div>
									</div>
									<div class="descProdotti">
										<h2 class="wpr-grid-item-title">
											<div class="inner-block">
												<?php echo get_the_title($pid); ?>
											</div>
										</h2>
										<div class="inner-block">
											<p>
												<?php echo $content; ?>
											</p>
										</div>
									</div>
								</div>
								<?php
							}
							?>
							<div class="clearfix divider"></div>
						<?php
						}
						?>



					</div>
				</div>
			</div>

		</div>

	</div>


	</div>


</main>