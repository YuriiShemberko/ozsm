<?php
get_header();

$post = get_post();
$product_attrs = get_post_meta( $post->ID, 'at_product_attrs' );

get_template_part( "template-parts/common-info", "common-info", array(
  'attributes' => $product_attrs,
) );

get_footer();
?>
