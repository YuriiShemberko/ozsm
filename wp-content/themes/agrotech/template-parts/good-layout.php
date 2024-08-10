<?php

get_header();

$post = get_post();
$title = get_the_title( $post );
$main_image = get_post_thumbnail_id( $post );
$description = get_post_meta( $post->ID, 'at_good_description', true );
$price = get_post_meta( $post->ID, 'at_good_price', true );
$images_list = get_post_meta( $post->ID, 'at_good_images', false );
array_unshift( $images_list, $main_image );

wp_enqueue_style( 'at_good_style', get_template_directory_uri() . '/css/good.css' );
?>

	<main id="primary" class="site-main">
    <div class="page-content">
      <div class="good-wrapper">
        <div class="images-section-wrapper">
          <?php get_template_part( "template-parts/image-carousel", "image-carousel", array( 'img_ids' => $images_list ) ); ?>
        </div>
        <div class="good-info-wrapper">
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
	</main>

<?php

get_footer();
