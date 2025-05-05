<?php

get_header();

wp_enqueue_style( 'at_page_products_style', get_template_directory_uri() . '/css/page-products.css' );

$terms = get_terms(
  array(
    'taxonomy' => 'at_product_category',
    'hide_empty' => false,
  )
);

$products_query = new WP_query ( array (
	'post_type' => 'at_product',
	'posts_per_page' => 5,
	'orderby' => 'comment_count'
) );

$popular_products = wp_list_pluck( $products_query->get_posts(), 'ID' );

?>

	<main id="primary" class="site-main">

    <div class="page-products-content">
      <h2>Категорії</h2>
      <div class="categories-wrapper">
        <?php foreach ($terms as $term) {
          $term_name = $term->name;
          $term_slug = $term->slug;
          $term_img_id = get_term_meta($term->term_id, 'at_product_category_image')[0];
          $term_img = wp_get_attachment_image_src( $term_img_id, 'medium' )[0];
        ?>
            <div class="category-container levitating" onclick="window.location='<?php echo $term_slug ?>'">
              <div class="category-image-wrapper">
                <img src="<?php echo $term_img ?>" />
              </div>
              <h3><?php echo $term_name ?></h3>
            </div>
        <?php } ?>
      </div>
      <div class="popular-products">
        <?php get_template_part( 'template-parts/posts-preview', 'at_main_page_products_preview', array (
            "posts" => $popular_products,
            "title" => "Популярна продукція",
          ) )
        ?>
      </div>
    </div>

	</main><!-- #main -->

<?php
get_footer();
