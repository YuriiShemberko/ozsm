<?php
$post = get_post();
$product_attrs = get_post_meta( $post->ID, 'at_product_attrs' );
$related_spare_parts_query_args = array(
    'post_type' => 'at_spare_part',
    'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'at_spare_part_comp',
          'value' => $post->ID,
          'compare' => '=',
        ),
    ),
);
$related_spare_parts_query = new WP_query ( $related_spare_parts_query_args );
$related_spare_pats = array_merge( $related_spare_parts_query->get_posts(), $related_spare_parts_query->get_posts(), $related_spare_parts_query->get_posts(), $related_spare_parts_query->get_posts(), $related_spare_parts_query->get_posts() );

get_header();
?>

<main id="primary" class="site-main">
  <div class="page-content">
    <?php
      get_template_part( "template-parts/common-info", "common-info", array(
        'attributes' => $product_attrs,
      ) );
      get_template_part( "template-parts/posts-preview", "related-spare-parts", array(
        "posts" => $related_spare_pats,
        "title" => "Запчастини та комплектуючі",
      ) );

      get_footer();
    ?>
  </div>
</main>
