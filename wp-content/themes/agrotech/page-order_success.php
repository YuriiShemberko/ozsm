<?php

get_header();

wp_enqueue_script( 'at_order_success_script', get_template_directory_uri() . '/js/order-success.js' );

?>

	<main id="primary" class="site-main">

    <div class="order-success">
      <h3>Дякуємо за замовлення! Наш менеджер зв'яжеться з Вами якнайшвидше.</h3>
      <a href="<?php echo get_site_url() ?>">Повернутися на головну</a>
    </div>

	</main><!-- #main -->

<?php
get_footer();
