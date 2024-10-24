<?php
wp_enqueue_style( 'at_posts_preview_style', get_template_directory_uri() . '/css/posts-preview.css' );
$posts = array_key_exists( 'posts', $args ) ? $args['posts'] : [];
$title = array_key_exists( 'title', $args ) ? $args['title'] : [];

?>
<div class="posts-preview-wrapper">
  <h2><?php echo $title; ?></h2>
  <div class="posts-preview-container">
  <?php
    foreach ( $posts as $post ) {
      $title = get_the_title( $post );
      $img_src = get_the_post_thumbnail_url( $post );
      $price = get_post_meta( $post, 'at_good_price', true );
      $link = get_permalink( $post );
    ?>
      <div class="post-preview-container" onclick="location.href = '<?php echo $link; ?>'">
        <div class="post-thumbnail-wrapper">
          <img src="<?php echo $img_src ?>" />
        </div>
        <h5><?php echo $title; ?></h5>
        <h4><?php echo $price; ?> грн.</h4>
      </div>
    <?php
    }
    ?>
  </div>
</div>
