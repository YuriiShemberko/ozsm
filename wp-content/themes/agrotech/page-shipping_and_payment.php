<?php

get_header();

wp_enqueue_style( 'at_shipping_and_payment_style', get_template_directory_uri() . '/css/shipping-and-payment.css' );
?>

	<main id="primary" class="site-main">
    <div class="page-content">
			<div class="shipping-and-delivery-page-content">
				<h2>Форми доставки та оплати</h2>
				<?php get_template_part( 'template-parts/grid-infographics', 'at_shipping_and_delivery_infograpics', array(
					'infographics_data' => array(
						[
								'img_src' => get_template_directory_uri() . '/img/geo.png',
								'header_text' => 'Доставка в усі регіони України',
						],
						[
								'img_src' => get_template_directory_uri() . '/img/pickup.png',
								'header_text' => 'Самовивіз',
						],
						[
								'img_src' => get_template_directory_uri() . '/img/handshake.png',
								'header_text' => 'Інші варіанти доставки (за домовленістю)',
						],
						[
								'img_src' => get_template_directory_uri() . '/img/cash.png',
								'header_text' => 'Оплата готівкою',
						],
						[
								'img_src' => get_template_directory_uri() . '/img/bank.png',
								'header_text' => 'Безготівковий розрахунок з ПДВ',
						],
						[
								'img_src' => get_template_directory_uri() . '/img/handshake.png',
								'header_text' => 'Інші варіанти оплати (за домовленістю)',
						],
					) ) )
				?>
				<div class="shipping-and-payment-contact-form-wrapper">
					<h2>Залишились питання? Зв'яжіться з нами!</h2>
					<?php get_template_part( "template-parts/contact-form", "shipping_and_payment_contact_form", array( 'context' => 'Сторінка --ДОСТАВКА ТА ОПЛАТА--' ) ) ?>
				</div>
			</div>
  	</div>
	</main><!-- #main -->

<?php
get_footer();
