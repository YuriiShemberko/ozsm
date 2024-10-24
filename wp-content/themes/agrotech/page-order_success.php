<?php

get_header();

wp_enqueue_script( 'at_order_success_script', get_template_directory_uri() . '/js/order-success.js' );

?>

	<main id="primary" class="site-main">

    <div class="order-success">
			<img class="medium" src="<?php echo get_template_directory_uri() . '/img/order.png'?>" />
      <h3>Дякуємо за замовлення! Наш менеджер зв'яжеться з вами якнайшвидше.</h3>
      <button class="levitating" onclick="window.location='<?php echo get_site_url() ?>'">Повернутися на головну</a>
    </div>

	</main><!-- #main -->

<?php
get_footer();
