<?php

get_header();

wp_enqueue_style( 'at_category_products_page_style', get_template_directory_uri() . '/css/category-products.css' );

$term = get_queried_object();

$category_id = $term->term_id;
$category_name = $term->name;
$products_query_args = array(
    'post_type' => 'at_product',
    'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'at_product_category',
          'value' => $category_id,
          'compare' => '=',
        ),
    ),
);
$products_query = new WP_query ( $products_query_args );
$products = $products_query->get_posts();

?>

	<main id="primary" class="site-main">
		<div class="category-products-page-content">
			<h2><?php echo $category_name ?></h2>
	    <div class="category-products-wrapper">
				<?php foreach( $products as $post ) {
					$title = get_the_title( $post );
					$img_src = get_the_post_thumbnail_url( $post, 'medium' );
					$price = get_post_meta( $post->ID, 'at_good_price', true );
					$link = get_permalink( $post );
				?>
					<div class="category-product-container levitating" onclick="window.location='<?php echo $link; ?>'">
						<div class="product-img-wrapper">
							<img src="<?php echo $img_src; ?>" />
						</div>
						<div class="product-bottom-section">
							<span><?php echo $title; ?></span>
							<h4><?php echo $price; ?> грн.</h4>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
