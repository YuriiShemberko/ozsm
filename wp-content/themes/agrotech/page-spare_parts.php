<?php

get_header();

wp_enqueue_style( 'at_page_spare_parts_stylee', get_template_directory_uri() . '/css/page-spare-parts.css' );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$comp_product_id = $_GET[ 'comp_product_id' ] ?? '';
$comp_product_title = $comp_product_id ? get_the_title ( intval($comp_product_id) ) : null;
$comp_product_link = $comp_product_id ? get_post_permalink ( intval($comp_product_id) ) : null;

$query_args = array(
  'post_type' => 'at_spare_part',
  'posts_per_page' => 16,
  'paged' => $paged,
  'meta_query' => $comp_product_id ? array(
      'relation' => 'AND',
      array(
        'key' => 'at_spare_part_comp',
        'value' => $comp_product_id,
        'compare' => '=',
      ),
    ) : null,
  );

$query = new WP_Query( $query_args );
$spare_parts = wp_list_pluck( $query->get_posts(), 'ID' );
$products_query = new WP_Query( array (
  'post_type' => 'at_product',
  'posts_per_page' => -1,
) );
$product_ids = wp_list_pluck( $products_query->get_posts(), 'ID' );

global $wp;
$base_url = home_url( $wp->request );
?>

	<main id="primary" class="site-main">

    <div class="page-spare-parts-content">
      <h2 class="centered">Каталог запчастин</h2>
      <?php echo $comp_product_title ? ' <span class="comp-label"> для <a href="' . $comp_product_link . '">'  . $comp_product_title . '</a></span>' : '' ?>

      <div class="spare-parts-content-wrapper">
        <div class="spare-parts-compability">
          <h4>Сумісніcть:</h4>
          <div class="spare-parts-filters">
            <ul>
              <?php
                foreach ( $product_ids as $post ) {
                  $title = get_the_title( $post );
                  $link = $base_url . '?comp_product_id=' . $post;
                ?>
                  <li <?php echo $comp_product_id === strval( $post ) ? 'class="filter-active"' : null ?>><a href="<?php echo $link ?>"><?php echo $title ?></a></li>
                <?php
                }
                ?>
              <button class="reset-button" onclick="window.location.href='<?php echo $base_url ?>'">Скинути фільтр</button>
            </ul>
          </div>
        </div>

        <div class="spare-parts-container">
          <?php if ( !count( $spare_parts ) ) {
            ?>
              <div class="empty-state-container">
                <h2>На жаль, ми не знайшли запчастин за заданим фільтром :(</h2>
                <a href="<?php echo $base_url ?>">Скинути фільтр</a>
              </div>
            <?php
            }
          ?>

          <?php
            foreach ( $spare_parts as $post ) {
              $title = get_the_title( $post );
              $img_src = get_the_post_thumbnail_url( $post );
              $price = get_post_meta( $post, 'at_good_price', true );
              $link = get_permalink( $post );
              $comp = get_post_meta( $post, 'at_spare_part_comp' );
            ?>
              <div class="spare-part-container levitating" onclick="location.href = '<?php echo $link; ?>'">
                <div class="spare-part-thumbnail-wrapper">
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
    </div>

    <div class="spare-parts-pagination">
        <?php
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 5,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( 'Назад', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( 'Далі', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
    </div>

	</main><!-- #main -->

<?php
get_footer();
