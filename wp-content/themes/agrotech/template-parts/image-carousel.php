<?php
  $img_ids = $args['img_ids'];
  $img_srcs = [];
  foreach ($img_ids as $img_id) {
    $img_srcs[] = wp_get_attachment_image_src ( $img_id, 'large' )[0];
  }

  wp_enqueue_style( 'at_image_carousel_style', get_template_directory_uri() . '/css/image-carousel.css' );

  wp_register_script( 'at_image_carousel_script', get_template_directory_uri() . '/js/image-carousel.js' );
  wp_localize_script( 'at_image_carousel_script', 'at_img_data', array( 'img_srcs' => $img_srcs ) );
  wp_enqueue_script( 'at_image_carousel_script', get_template_directory_uri() . '/js/image-carousel.js' );
?>

<div class="image-carousel-wrapper">
    <div id="carousel-content-container">

      <div class="primary-image-wrapper">
        <div class="primary-image-container">
          <img id="primary-image" src=" <?php echo $img_srcs[0] ?>" onclick="openFullscreenPreview()" />
        </div>
      </div>

      <div class="secondary-images-wrapper">
        <div class="secondary-images-container">
          <?php
            foreach ( $img_srcs as $img_src ) {
              ?>
                <div class="secondary-image-wrapper" onclick="onClickGalleryImage(this)">
                  <img src="<?php echo $img_src ?>" />
                </div>
              <?php
            }
          ?>
        </div>
      </div>

      <button class="slider-button" id="slider-button-prev" onclick="onClickPrevImage()">
        <span class="dashicons dashicons-arrow-left-alt2"></span>
      </button>
      <button class="slider-button" id="slider-button-next" onclick="onClickNextImage()">
        <span class="dashicons dashicons-arrow-right-alt2"></span>
      </button>
    </div>
    <button id="fullscreen-close-btn" onclick="closeFullscreenPreview()">
      <span class="dashicons dashicons-no-alt"></span>
    </button>
</div>
