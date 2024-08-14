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
?>
  <div class="good-wrapper">
    <div class="images-section-wrapper">
      <?php get_template_part( "template-parts/image-carousel", "image-carousel", array( 'img_ids' => $images_list ) ); ?>
    </div>
    <div class="good-info-wrapper">
      <h2><?php echo $title ?></h2>
			<div class="price-section">
				<h3>Ціна</h3>
				<h2><?php echo $price ?></h2>
			</div>
			<button class="contact-button">
				<h3>Замовити</h3>
				<span class="dashicons dashicons-phone"></span>
			</button>
      <div><?php echo $description ?></div>
			<?php
				if ( !empty( $product_attrs ) ) {
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
