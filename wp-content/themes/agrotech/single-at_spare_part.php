<?php
$post = get_post();

get_header();
?>

<main id="primary" class="site-main">
  <div class="page-content">
    <?php
      get_template_part( "template-parts/common-info" );

      get_template_part( "template-parts/posts-preview", "at_spare_part_compatible_products", array (
        "posts" => get_post_meta ( $post->ID, "at_spare_part_comp" ),
        "title" => "Підходить для:",
      ) );

      get_footer();
    ?>
  </div>
</main>
