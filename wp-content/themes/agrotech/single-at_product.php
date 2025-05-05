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
$related_spare_parts = wp_list_pluck( $related_spare_parts_query->posts, 'ID' );

get_header();
?>

<main id="primary" class="site-main">
  <div class="page-content">
    <div class="good-view-page-content">
      <?php
        get_template_part( "template-parts/common-info", "common-info", array(
          'attributes' => $product_attrs,
        ) );
        if ( !empty( $related_spare_parts ) ) {
          get_template_part( "template-parts/posts-preview", "related-spare-parts", array(
            "posts" => $related_spare_parts,
            "title" => "Запчастини та комплектуючі",
          ) );
        }
      ?>

      <div class="comments-wrapper">
        <h2>Відгуки</h2>
        <?php
          wp_reset_postdata();
          wp_reset_query();
          comments_template();
        ?>
      </div>
    </div>
  </div>
</main>

<?php
  get_footer();
?>
