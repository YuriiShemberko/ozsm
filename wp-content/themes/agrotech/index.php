<?php

get_header();
wp_enqueue_style( 'at_main_page_style', get_template_directory_uri() . '/css/main-page.css' );

$products_query = new WP_query ( array (
	'post_type' => 'at_product',
	'posts_per_page' => 5,
	'orderby' => 'comment_count'
) );

$products = $products_query->get_posts();
?>

	<main id="primary" class="site-main">
		<div class="hero-wrapper">
			<video
				poster="<?php echo get_template_directory_uri() . '/video/hero-poster.png' ?>"
				class="hero-video"
				preload="none"
				autoplay
				muted
				loop
			>
				<source src="<?php echo get_template_directory_uri() . '/video/hero-video.mp4' ?>" type="video/mp4">
			</video>
			<div class="hero-video-shadow">
				<span>Якісна сільгосптехніка від аграріїв для аграріїв</span>
				<button>
					<a href="#products">Продукція</a>
				</button>
			</div>
		</div>

		<div id="products" class="products-preview-wrapper">
			<?php get_template_part( 'template-parts/posts-preview', 'at_main_page_products_preview', array (
					"posts" => $products,
					"title" => "Популярна продукція",
				) )
			?>
			<button class="button-more" onclick="location.href = '<?php echo get_site_url() . '/products' ?>'">
				Більше товарів
			</button>
		</div>

		<div class="contact-form-wrapper">
			<h2>Зв'яжіться з нами</h2>
			<?php get_template_part( 'template-parts/contact-form', 'at_main_page_products_preview', array (
					"posts" => $products,
					"title" => "Популярна продукція",
					"context" => "Головна сторінка",
				) )
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
