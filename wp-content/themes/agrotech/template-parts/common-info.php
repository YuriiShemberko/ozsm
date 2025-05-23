<?php

$post = get_post();
$title = get_the_title( $post );
$main_image = get_post_thumbnail_id( $post );
$description = get_post_meta( $post->ID, 'at_good_description', true );
$price = get_post_meta( $post->ID, 'at_good_price', true );
$images_list = get_post_meta( $post->ID, 'at_good_images', false );
$product_attrs = array_key_exists( 'attributes', $args ) ? $args['attributes'] : [];
array_unshift( $images_list, $main_image );
wp_enqueue_style( 'at_common_info_style', get_template_directory_uri() . '/css/common-info.css' );
wp_enqueue_script( 'at_common_info_script', get_template_directory_uri() . '/js/common-info.js' );
?>
  <div class="good-wrapper">
    <div class="images-section-wrapper">
      <?php get_template_part( "template-parts/image-carousel", "image-carousel", array( 'img_ids' => $images_list ) ); ?>
    </div>
    <div class="good-info-wrapper">
      <h2><?php echo $title ?></h2>
			<div class="price-section">
				<h3>Ціна</h3>
				<h2><?php echo $price . ' грн.' ?></h2>
			</div>
      <div class="actions-section">
        <button class="contact-button" onclick="onAddToCartClick(this)" value="<?php echo $post->ID ?>">
          <span class="dashicons dashicons-cart"></span>
          <h3>До кошику</h3>
        </button>
        <div id="add-to-cart-notification">
          <span class="dashicons dashicons-yes cart-status"></span>
          <span class="cart-status">Товар додано до кошику.</span>
          <a href="<?php echo get_site_url() . '/cart' ?>">Оформити замовлення</a>
        </div>
      </div>
      <div><?php echo $description ?></div>
			<?php
				if ( !empty( $product_attrs ) && !empty( $product_attrs[0] ) ) {
				  ?>
				    <table class="product-attributes">
				      <tr>
				        <th>
				          Характеристики
				        </th>
				      </tr>

				      <?php
				        foreach( $product_attrs as $attr_str ) {
				          $attr_content = explode( '!', $attr_str );

                  if ( count( $attr_content ) != 2 ) {
                    continue;
                  }

				          $attr_name = $attr_content[0];
				          $attr_value = $attr_content[1];
				        ?>
				          <tr>
				            <td class="attribute-name"><?php echo $attr_name; ?></td>
				            <td class="attribute-value"><?php echo $attr_value; ?></td>
				          </tr>
				        <?php
				        }
				      ?>
				    </table>
				  <?php
				}
		 	?>
    </div>
  </div>
<?php
