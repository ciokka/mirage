<?php

use WprAddons\Modules\Grid\Widgets\custom_Wpr_Grid;

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChildMasterChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
// apply tags to attachments
function wptp_add_tags_to_attachments()
{
	register_taxonomy_for_object_type('post_tag', 'attachment');
}
add_action('init', 'wptp_add_tags_to_attachments');

function hello_elementor_child_enqueue_scripts()
{
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

function wpb_adding_scripts()
{
	wp_register_script('my_amazing_script', get_theme_root_uri() . '/hello-theme-child-master/assets/js/bootstrap.min.js', array(), '1.0.0', true);
	wp_register_script('custom_script', get_theme_root_uri() . '/hello-theme-child-master/assets/js/custom.js', array(), '1.0.0', true);
	wp_enqueue_script('my_amazing_script');
	wp_enqueue_script('custom_script');
}

add_action('wp_enqueue_scripts', 'wpb_adding_scripts', 999);


add_filter('manage_prodotti_posts_columns', 'inol3_filter_posts_columns');
function inol3_filter_posts_columns($columns)
{
	$columns['marchio'] = __('marchio');
	return $columns;
}

add_filter('manage_360qrcode_posts_columns', 'qrcode_filter_posts_columns');
function qrcode_filter_posts_columns($columns)
{
	$columns['marchio'] = __('marchio');
	return $columns;
}

add_action('manage_posts_custom_column', 'my_show_columns', 10, 2);

function my_show_columns($name)
{
	global $post;
	switch ($name) {
		case 'marchio':
			$marchio = get_post_meta($post->ID, 'marchio', true);
			$res = [];
			if ($marchio):
				foreach ($marchio as $post_id):
					$res[] = get_the_title($post_id);
				endforeach;
			endif;
			echo implode(',', $res);
	}
}

function jsProdotti()
{
?>
	<link rel='stylesheet' id='wpr-lightgallery-css-css'
		href='/wp-content/plugins/royal-elementor-addons/assets/css/lib/lightgallery/lightgallery.min.css?ver=1.3.56'
		media='all' />
	<script type="text/javascript">
		let all = jQuery(".products-filter-all");
		let links = jQuery(".products-filter");

		links.on('click', function(e) {
			let target = jQuery(this).data('target');
			e.preventDefault();
			jQuery(".selected-brand").removeClass("selected-brand");
			jQuery(this).addClass("selected-brand");
			jQuery('.boxProdotti').fadeOut("fast");
			window.setTimeout(function() {
				jQuery('.' + target).fadeIn("fast");
				jQuery([document.documentElement, document.body]).scrollTop(jQuery(".products-filter-all").offset().top);
			}, 300);
			return false;
		});
		all.on('click', function(e) {
			e.preventDefault();
			jQuery(".selected-brand").removeClass("selected-brand");
			jQuery('.boxProdotti').fadeIn("fast");
			jQuery([document.documentElement, document.body]).scrollTop(jQuery(".products-filter-all").offset().top);
			return false;
		});

		var ll = jQuery(".wpr-grid-item");
		console.log(ll);
		ll.each(function(i) {
			var link = jQuery(this).find("[data-url]");
			console.log(link);
			console.log(i);
			var url = link.data("url");
			if (url.indexOf('placeholder') !== -1) {
				link.attr("data-url", "");
				jQuery(this).find(".wpr-grid-media-wrap").removeClass("wpr-grid-media-wrap");
				link.parent().parent().addClass("wpr-custom");
			}
		});

		let brand = jQuery("#productBrand").val();
		if (brand) {
			let target = "marchio-" + brand;
			jQuery(".selected-brand").removeClass("selected-brand");
			jQuery("#" + target).addClass("selected-brand");
			jQuery('.boxProdotti').fadeOut("fast");
			window.setTimeout(function() {
				jQuery('.' + target).fadeIn("fast");
				//jQuery([document.documentElement, document.body]).scrollTop(jQuery(".products-filter-all").offset().top);
			}, 300);
		}
	</script>

<?php
}

add_action('wp_footer', 'jsProdotti', 100);
add_filter('the_content', 'wpautop');
function Custom_Wpr_Grid()
{
	require(__DIR__ . "/includes/custom_Wpr_Grid.php");
	//var_dump(require(__DIR__ . "/includes/custom_Wpr_Grid-class.php"));
	new custom_Wpr_Grid();
}

add_action('init', 'Custom_Wpr_Grid', 100);

add_action('wp_head', 'my_analytics', 20);
function my_analytics()
{
?>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-M2RGNTF');
	</script>
	<!-- End Google Tag Manager -->
	<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {
			"askConsentAtCookiePolicyUpdate": true,
			"floatingPreferencesButtonCaptionColor": "#FFFFFF",
			"floatingPreferencesButtonColor": "#000000",
			"floatingPreferencesButtonDisplay": "anchored-bottom-left",
			"perPurposeConsent": true,
			"siteId": 3132077,
			"whitelabel": false,
			"gdprAppliesGlobally": false,
			"cookiePolicyId": 53368126,
			"lang": "it",
			"banner": {
				"acceptButtonDisplay": true,
				"closeButtonDisplay": false,
				"customizeButtonDisplay": true,
				"explicitWithdrawal": true,
				"listPurposes": true,
				"position": "bottom",
				"rejectButtonDisplay": true,
				"showPurposesToggles": true
			}
		};
	</script>
	<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
<?php
}

// Funzione per aggiungere WP PUSHER nella barra di amministrazione
function aggiungi_voce_wpadminbar($wp_admin_bar)
{
	// Cambia "Nuova Voce" con il testo desiderato per la tua voce nella barra di amministrazione
	$wp_admin_bar->add_menu(array(
		'id' => 'wppusheritem',
		'title' => 'Aggiorna da GIT Repo',
		'href' => '/wp-admin/admin.php?page=wppusher-themes',
		'meta' => array(
			'title' => 'Per eseguire l\'update del tema dalla repository', // Descrizione opzionale
		),
	));
}

// Aggiungi la funzione alla barra di amministrazione
add_action('admin_bar_menu', 'aggiungi_voce_wpadminbar', 999);

function wp_maintenance_mode()
{
	if (!current_user_can('administrator')) {
		wp_die('
        <h1>Stiamo aggiornando il nostro sito.</h1>
        <p>Sul sito sono in corso degli aggiornamenti. Si prega di ritornare più tardi.</p> ', 'Sito in modalità manutenzione');
	}
}
add_action('template_redirect', 'wp_maintenance_mode');
