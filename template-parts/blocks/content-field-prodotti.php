<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'prodotto-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Load values and handle defaults.
$text = get_post_meta(get_the_ID(), 'linkprodotto', true);


?>
<div >
    <blockquote class="testimonial-blockquote">
        <span class="testimonial-text"><?php echo $text; ?></span><br>
    </blockquote>
</div>