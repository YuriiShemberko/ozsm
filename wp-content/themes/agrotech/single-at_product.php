<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrotech
 */

get_header();

$post = get_post();
$title = get_the_title( $post );
$main_image = get_the_post_thumbnail_url( $post );
$description = get_post_meta( $post->ID, 'at_good_description', true );
$price = get_post_meta( $post->ID, 'at_good_price', true );
$images_list = get_post_meta( $post->ID, 'at_good_images', true );

$images_array = explode( ',', $images_list );
$images_src_array = [];

$images_src_array[] = $main_image;
foreach ($images_array as $image_id) {
  $images_src_array[] = wp_get_attachment_url( $image_id );
}

wp_enqueue_style( 'at_product_style', get_template_directory_uri() . '/css/product.css' );
wp_enqueue_style( 'at_fullscreen_style', get_template_directory_uri() . '/css/fullscreen-preview.css' );
wp_register_script( 'at_product_script', get_template_directory_uri() . '/js/product.js' );
wp_localize_script( 'at_product_script', 'at_product_data', array (
  'images_src_array' => $images_src_array,
));
wp_enqueue_script( 'at_product_script' );

?>

	<main id="primary" class="site-main">

    <div class="page-content">

      <div class="secondary-images-wrapper">
        <div class="secondary-images-container">
          <?php
            foreach ( $images_src_array as $secondary_image_src ) {
              ?>
                <div class="secondary-image-wrapper">
                  <img src="<?php echo $secondary_image_src ?>" onclick="onClickGalleryImage(this)"/>
                </div>
              <?php
            }
          ?>
        </div>
      </div>

      <div class="product-wrapper">

      <div class="primary-image-container">
        <img id="primary-image" src="<?php echo $main_image; ?>" onclick="openFullscreenPreview()" />

        <button class="slider-button" id="slider-button-prev" onclick="onClickPrevImage()">
          <span class="dashicons dashicons-arrow-left-alt2"></span>
        </button>
        <button class="slider-button" id="slider-button-next" onclick="onClickNextImage()">
          <span class="dashicons dashicons-arrow-right-alt2"></span>
        </button>
      </div>

      <div class="product-info-wrapper">
        <h2><?php echo $title ?></h2>

        <div><?php echo $description ?></div>

        <div>
          <h3>Ціна</h3>
          <h2><?php echo $price ?></h2>
        </div>

        <button class="contact-button">
          <span class="dashicons dashicons-cart"></span>
          <h3>Замовити</h3>
        </button>
      </div>


      </div>
    </div>

	</main><!-- #main -->

<?php

get_footer();
get_template_part( "template-parts/fullscreen-preview" );
