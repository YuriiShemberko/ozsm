<?php

// Add meta to custom post imagetypes

if ( ! function_exists('at_load_meta_boxes_assets' ) ) {
  function at_load_meta_boxes_assets () {
      global $post_type;
      if( $post_type === 'at_product' || $post_type === 'at_spare_part' )
          wp_enqueue_style( 'at_meta_style', plugins_url( 'argotech/assets/css/meta.css' ) );
          wp_enqueue_script( 'at_meta_script', plugins_url( 'argotech/assets/js/meta.js' ) );
  }
}
add_action( 'admin_print_styles-post-new.php', 'at_load_meta_boxes_assets' );
add_action( 'admin_print_styles-post.php', 'at_load_meta_boxes_assets' );


if ( ! function_exists( 'at_add_meta_boxes' ) ) {
  function at_add_meta_boxes() {
    add_meta_box( 'at_good_description_meta_box', 'Опис продукту', 'at_render_description_meta_box', array('at_product', 'at_spare_part') );
    add_meta_box( 'at_good_price_meta_box', 'Ціна', 'at_render_price_meta_box', array( 'at_product', 'at_spare_part' ) );
    add_meta_box( 'at_good_images', 'Додаткові зображення', 'at_render_images_meta_box', array( 'at_product', 'at_spare_part' ) );
  }
}
add_action( 'add_meta_boxes', 'at_add_meta_boxes' );

if ( ! function_exists( 'at_render_description_meta_box' ) ) {
  function at_render_description_meta_box( $post ) {
    $description = get_post_meta( $post->ID, 'at_good_description', true );
    ?>
    <textarea name="at_good_description" id="at_good_description"><?php echo $description; ?></textarea>
    <?php
  }
}

if ( ! function_exists( 'at_render_price_meta_box' ) ) {
  function at_render_price_meta_box( $post ) {
    $price = get_post_meta( $post->ID, 'at_good_price', true );
    ?>
      <input type="text" name="at_good_price" id="at_good_price" value="<?php echo $price; ?>" />
    <?php
  }
}

if ( ! function_exists( 'at_render_images_meta_box' ) ) {
  function at_render_images_meta_box( $post ) {
    $good_images = get_post_meta( $post->ID, 'at_good_images', true );
    ?>
      <a onClick="at_onUploadClick()">Редагувати список зображеннь</a>
      <input type="hidden" id="at_good_images_input" name="at_good_images" value="<?php echo $good_images; ?>" />
      <div class="images-wrapper">
        <?php
          if ( $good_images ) {
            foreach ( explode( ',', $good_images ) as $attachment_id ) {
              ?>
                <?php echo wp_get_attachment_image( $attachment_id ); ?>
              <?php
            }
          }
        ?>
      </div>
    <?php
  }
}

if ( ! function_exists( 'at_save_meta' ) ) {
  function at_save_meta( $post_id ) {
    $post_type = get_post_type();

    if( 'at_product' !== $post_type && 'at_spare_part' !== $post_type ) {
      return $post_id;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
      return $post_id;
    }

    if ( isset( $_POST[ 'at_good_description' ] ) ) {
      update_post_meta( $post_id, 'at_good_description', sanitize_text_field( $_POST[ 'at_good_description' ] ) );
    } else {
      delete_post_meta( $post_id, 'at_good_description' );
    }

    if ( isset( $_POST[ 'at_good_price' ] ) ) {
      update_post_meta( $post_id, 'at_good_price', sanitize_text_field( $_POST[ 'at_good_price' ] ) );
    } else {
      delete_post_meta( $post_id, 'at_good_price' );
    }

    $good_images = $_POST[ 'at_good_images' ];
    if ( isset ( $good_images ) ) {
      update_post_meta( $post_id, 'at_good_images', $good_images );
    }

  }
}
add_action( 'save_post', 'at_save_meta' );
