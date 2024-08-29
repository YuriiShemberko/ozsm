<?php

wp_enqueue_style( 'at_cart_style', get_template_directory_uri() . '/css/cart.css' );

$can_edit = array_key_exists( 'can_edit', $args ) ? $args['can_edit'] : false;
$cart_items = array_key_exists( 'cart_items', $args ) ? $args['cart_items'] : [];

?>

<?php
  if ( !empty( $cart_items ) ) {
    $total_sum = 0;
?>
    <div class="cart-items-container">
      <?php
        foreach ( $cart_items as $post_id => $value ) {
          $item_title = get_the_title( $post_id );
          $item_thumbnail_src = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
          $item_price = get_post_meta( $post_id, 'at_good_price' )[0];
          $amount = $value[ 'amount' ];
          $total_sum += $amount * $item_price;
        ?>
            <div class="cart-item-wrapper">
              <img src="<?php echo $item_thumbnail_src ?>" />
              <div class="text-section">
                <h4><?php echo $item_title ?></h4>
                <p>Ціна: <b><?php echo $item_price; ?> грн.</b></p>
              </div>

              <?php
                if ($can_edit) {
                  ?>
                    <div class="amount-section">
                      <button value="<?php echo $post_id ?>" onclick="onMinusClick(this)"><span class="dashicons dashicons-minus"></span></button>
                      <p><b><?php echo $amount; ?></b></p>
                      <button value="<?php echo $post_id ?>" onclick="onPlusClick(this)"><span class="dashicons dashicons-plus"></span></button>
                    </div>
                    <div class="remove-section">
                      <button value="<?php echo $post_id ?>" onclick="onRemoveClick(this)"><span class="dashicons dashicons-trash"></span></button>
                    </div>
                  <?php
                }
              ?>
            </div>
          <?php
        }
      ?>
    </div>
    <h3>Всього <?php echo $total_sum ?> грн.</h3>
<?php
  } else {
    ?>
      <h3>Ваш кошик наразі порожній.</h3>
      <a href="<?php echo get_site_url() ?>">На головну</a>
    <?php
  }
?>
