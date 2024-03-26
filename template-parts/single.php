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

<main id="content" <?php post_class('site-main'); ?> role="main">
<?php $backgroundImg = wp_get_attachment_image_src(
    get_post_thumbnail_id($post->ID),
    'full'
); ?>
<section class="py-4 py-xl-5 headPost" style="background: url('<?php echo $backgroundImg[0]; ?>') center / cover; background-color: #000;">
        <div class="container h-100">
            <div class="row h-100">
                <div class="text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                    <div>
						<header class="page-header text-uppercase fw-bold postTitle">
							<?php if (apply_filters('hello_elementor_page_title', true)): ?>
							<?php endif; ?>
							<p class="dataPost"><?php the_date(); ?></p>
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

			<pre><?php var_dump($post->post_type); ?></pre>
                <?php the_content(); ?>
            </div>
			<?php
				ob_start();
				the_tags('<span class="tag-links"> ', ' | ', '</span>');
				$tags = ob_get_clean();
			?>
			
				<div class="postContent post-tags">
				<?php print($tags); ?>
				</div>
				
				<?php if (comments_open( $post->ID )) { ?>
					<div class="postContent postComment">
						<?php wp_link_pages(); ?>
						<p class="text-center">

					<button class="btn btn-primary mt-3 mb-3 mb-sm-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
					<?php esc_html_e( 'visualizza commenti', 'hello-theme-child-master' ); ?>
					</button>
					<div class="collapse" id="collapseComment">
					<div class="card card-body">
					<?php comments_template(); ?>
					</div>
				<?php } ?>
				
			</div>	
				
			</div>

        </div>
		

    </div>
	<div class="navigation">
	<?php the_post_navigation([
     'prev_text' => __('<span class="meta-nav">&larr;</span> precedente'),
     'next_text' => __('prossimo <span class="meta-nav">&rarr;</span>'),
 ]); ?>
	</div>
		
</main>

	<?php
endwhile;
