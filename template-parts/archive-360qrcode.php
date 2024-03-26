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

<main id="prodotti" class="archivio 360qr" role="main">

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
					'order' => 'DESC',
				);

				$new_post_loop = new WP_Query($args);

				?>

				<div class="container containerProd">
					<div class="row mt-0 mt-sm-3">
						<?php
						$postTitle = $post->post_title;
						$args = array(
							'post_type' => '360qrcode',
							'posts_per_page' => 1000,
							'orderby' => 'title',
							'order' => 'ASC',
						);

						$new_post_loop = new WP_Query($args);

						//Primo ciclo per determinare gli N brands
						$brandsArray = [];

						while ($new_post_loop->have_posts()) {
							$new_post_loop->the_post();

							$marchio = get_field('marchio');



							if ($marchio) :
								foreach ($marchio as $post_ids) :

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

								if ($marchio) :
									foreach ($marchio as $post_ids) :
										$object_marchio = $post_ids;
									endforeach;
								endif;
								foreach ($brandsArray as $k => &$v) {
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
										<div class="wpr-grid-media-hover wpr-animation-wrap logoBrand" style="background: url('<?php echo $backgroundImgBrand[0]; ?>') top / contain no-repeat;">
										</div>
									</a>
								</div>
							</div>
							<?php
							foreach ($productsId as $pid) {
								$content_post = get_post($pid);
								$content = $content_post->post_content;
								$prod360 = get_post($pid);
								$slug = $prod360->post_name;
								$codice = $prod360->post_title;
								$url360 = get_field('url360', $pid);

								$backgroundImgProd = wp_get_attachment_image_src(
									get_post_thumbnail_id($pid),
									'full'
								);
							?>

								<div class="col-6 col-sm-4 col-md-3 boxProdotti marchio-<?php echo $object_marchio; ?>" data-overlay-link="yes" style="cursor: pointer;">
									<div class="wpr-grid-image-wrap prodotti">
										<div class="wpr-grid-media-hover wpr-animation-wrap" style="background: url('<?php echo $backgroundImgProd[0]; ?>') center / cover;">
											<a id="trigger-<?= $slug ?>" data-bs-toggle="modal" data-bs-target="#product-view" href="#<?= $slug ?>" class="wpr-grid-media-hover-bg open-frame" data-toggle="modal" data-url="<?php echo $url360 ?>" data-code="<?php echo $codice ?>"></a>
										</div>
									</div>
									<div class="descProdotti">
										<h2 class="wpr-grid-item-title">
											<div class="inner-block">
												<?php echo get_the_title($pid); ?>
											</div>
										</h2>
									</div>
								</div>
							<?php
							}
							?>
							<div class="clearfix divider"></div>
						<?php
						}
						?>

						<div class="inner-block">

							<div class="clearfix divider"></div>
							<div class="modal fade" id="product-view" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-fullscreen">
									<div class="modal-content">
										<div class="modal-header">
											<span id="code" style="color:#333333;"></span>
											<button type="button" class="btn btn-close lg-close lg-icon" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body iframe-wrapper">
											<iframe id="product-360" class="iframe" src=""></iframe>
										</div>
									</div>
								</div>
							</div>
						</div>

						<script>
							//shortcut for $(document).ready

							jQuery(document).ready(function() {

								$ = jQuery;

								$(".open-frame").on("click", function(e) {
									$("#product-360").attr("src", "").hide();
									$("#code").text("");
									let t_url = $(this).attr("href");
									t_url = t_url.replace("", "");
									history.pushState({}, '', t_url.replace('#', '?'));

									let $code = $(this).data("code");
									let $url = $(this).data("url");

									$("#product-360").attr("src", $url).show("fast");
									$("#code").text($code);
								});


								$("#product-view .btn-close").on("click", function(e) {
									$("#product-360").hide();
									$("#product-360").attr("src", "");
									$("#code").text("");
								});

								if (location.href.indexOf('#') !== -1) {
									location.href = location.href.replace("#", "?");
									let loc = location.href.split('?');
									console.log(loc[1]);
									window.setTimeout(() => {
										jQuery('#trigger-' + loc[1]).trigger("click");
										$('#product-view').modal("show")
									}, 100);

								}

								if (location.href.indexOf('?') !== -1) {

									let loc = location.href.split('?');
									console.log(loc[1]);
									window.setTimeout(() => {
										jQuery('#trigger-' + loc[1]).trigger("click");
										$('#product-view').modal("show")
									}, 100);

								}
							});
						</script>

					</div>
				</div>
			</div>

		</div>

	</div>


	</div>


</main>