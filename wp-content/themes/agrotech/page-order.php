<?php

get_header();

wp_enqueue_style( 'at_cart_style', get_template_directory_uri() . '/css/cart.css' );
wp_enqueue_style( 'at_page_order_style', get_template_directory_uri() . '/css/page-order.css' );

$cart_state = $_COOKIE[ 'at_cart' ] ? json_decode(stripslashes( $_COOKIE[ 'at_cart' ] ), true) : [];
$cart_path = get_site_url() . '/cart';
?>

	<main id="primary" class="site-main">

		<div class="cart-page-content">
			<?php if ( !isset( $_SESSION ) || isset( $_SESSION[ 'at_order_submit_error' ] ) ) { ?>
				<h2>Ваше замовлення</h2>
				<?php
					get_template_part( "template-parts/cart-items", "cart-items-editable", array(
						"cart_items" => $cart_state['data'],
						"can_edit" => false,
					) );
				?>
				<div id="at_order_confirmation_form">
					<form action="" method="post" class="order-confirmation-form">
						<div class="order-info-section">
							<label for="at_order_customer_name">Ваше ім'я</label>
							<input type="text" name="at_order_customer_name" id="at_order_customer_name" required>
						</div>

						<div class="order-info-section">
							<label for="at_order_customer_email">Електронна адреса</label>
							<input type="email" name="at_order_customer_email" id="at_order_customer_email" required>
						</div>

						<div class="order-info-section">
							<label for="at_order_customer_phone">Номер телефону</label>
							<input type="tel" name="at_order_customer_phone" id="at_order_customer_phone" required>
						</div>

						<div class="order-info-section">
							<label for="at_order_optional_message">Додаткова інформація (необов'язково)</label>
							<textarea cols="10" rows="5" charswidth="23" name="at_order_optional_message" id="at_order_optional_message"></textarea>
						</div>
						<input type="hidden" name="action" value="at_confirm_order">
						<input class="levitating" type="submit" id="contact-form-submit-btn" value="Підтвердити замовлення">

						<?php if ( isset( $_SESSION ) && isset( $_SESSION[ 'at_confirm_order_error' ] ) ) { ?>
							<div class="order-confirm-error">
								<?php echo $_SESSION[ 'at_confirm_order_error' ]; ?>
							</div>
						<?php	} ?>

					</form>
				</div>
			<?php } ?>
			<?php if ( isset( $_SESSION ) && isset( $_SESSION[ 'at_confirm_order_success' ] ) ) { ?>
				<div class="order-confirm-success">
					<?php echo $_SESSION[ 'at_confirm_order_success' ]; ?>
					<a href="<?php echo get_site_url() ?>">На головну</a>
				</div>
			<?php } ?>
		</div>


	</main><!-- #main -->

<?php
get_footer();
