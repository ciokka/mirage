<?php
/**
 * The template for displaying 404 pages (not found).
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
			<h1 class="entry-title"><?php esc_html_e( 'Pagina non trovata.', 'hello-theme-child-master' ); ?></h1>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<p><?php esc_html_e( 'Sembra che non sia stato trovato nulla con questo indirizzo.', 'hello-theme-child-master' ); ?></p>
	</div>

</main>
