<?php

wp_enqueue_style( 'at_grid_infographics', get_template_directory_uri() . '/css/grid-infographics.css' );
$infographics_data = $args[ 'infographics_data' ];

function at_render_infographics_section( $img_src, $header_text, $span_text ) {
  ?>
    <div class="infographic-section">
      <img src="<?php echo $img_src ?>" />
      <h3><?php echo $header_text ?></h3>
      <span>
        <?php echo $span_text ?>
      </span>
    </div>
  <?php
}
?>

<div class="infographics-container">
  <?php
    foreach( $infographics_data as $infographic ) {
      at_render_infographics_section(
        $infographic[ 'img_src' ],
        $infographic[ 'header_text' ],
        isset( $infographic[ 'span_text'] ) ? $infographic[ 'span_text' ] : '',
      );
    }
  ?>
</div>
