<?php
namespace WprAddons\Modules\Grid\Widgets;

// require_once()
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class custom_Wpr_Grid extends \WprAddons\Modules\Grid\Widgets\Wpr_Grid {
    public function render_post_thumbnail( $settings ) {
		$id = get_post_thumbnail_id();
		$src = Group_Control_Image_Size::get_attachment_image_src( $id, 'layout_image_crop', $settings );
		$alt = '' === wp_get_attachment_caption( $id ) ? get_the_title() : wp_get_attachment_caption( $id );

		if ( has_post_thumbnail() ) {
			die();
			echo '<div class="wpr-grid-image-wrap" data-src="'. esc_url( $src ) .'">';
				if ( 'yes' == $settings['grid_lazy_loading'] ) {
					echo '<img src="'. WPR_ADDONS_ASSETS_URL . 'img/loading.gif" alt="'. esc_attr( $alt ) .'" class="wpr-hidden-image wpr-anim-timing-'. esc_attr($settings[ 'image_effects_animation_timing']) .'">';
				} else {
					echo '<img src="'. esc_url( $src ) . '" alt="'. esc_attr( $alt ) .'" class="wpr-anim-timing-'. esc_attr($settings[ 'image_effects_animation_timing']) .'">';
				}
			echo '</div>';
		}
	}
}