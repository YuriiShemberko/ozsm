<?php

get_header();

wp_enqueue_style( 'at_cart_style', get_template_directory_uri() . '/css/cart.css' );

$cart_state = array_key_exists( 'at_cart', $_COOKIE ) ? json_decode(stripslashes( $_COOKIE[ 'at_cart' ] ), true) : [];
$is_cart_empty = !array_key_exists( 'data', $cart_state ) || empty( $cart_state[ 'data' ] );
$order_path = get_site_url() . '/order';

?>

	<main id="primary" class="site-main">

		<div class="cart-page-content">
			<h2>Кошик</h2>
			<?php
				get_template_part( "template-parts/cart-items", "cart-items-editable", array(
          "cart_items" => !$is_cart_empty ? $cart_state['data'] : [],
          "can_edit" => true,
        ) );
			?>
			<?php if (!$is_cart_empty) { ?>
				<button class="levitating" id="cart-confirm" onClick="window.location.href='<?php echo $order_path ?>'">Оформити замовлення</button>
			<?php } ?>
		</div>


	</main><!-- #main -->

<?php
get_footer();
