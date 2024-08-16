<?php
$post = get_post();
$comp_array = get_post_meta ( $post->ID, "at_spare_part_comp" );

get_header();
?>

<main id="primary" class="site-main">
  <div class="page-content">
    <div class="good-view-page-content">
      <?php
        get_template_part( "template-parts/common-info" );

        if ( !empty( $comp_array ) ) {
          get_template_part( "template-parts/posts-preview", "at_spare_part_compatible_products", array (
            "posts" => $comp_array,
            "title" => "Підходить для:",
          ) );
        }

      ?>
    </div>

    <?php
      get_footer();
    ?>

  </div>
</main>
