<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $smof_data;
$title = $product->get_title();
$vertical_thumbnail = isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] == 'vertical';
?>
<div class="details-img col-md-5">

	<?php
	if( $vertical_thumbnail ){
		do_action( 'woocommerce_product_thumbnails' ); 
	}
	
	echo '<div class="images item-image">';
	
	do_action('ftc_before_product_image');
	
	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$attributes = array(
			'title'                   => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		
			$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
			$html .= '</a></div>';
		
	} else {
		$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
		$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'lolo' ) );
		$html .= '</div>';
	}
	
	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
	
	echo '</div>';
	?>

	<?php 
	if( !$vertical_thumbnail ){
		do_action( 'woocommerce_product_thumbnails' ); 
	}
	?>

</div>
