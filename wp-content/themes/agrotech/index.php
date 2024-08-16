<?php

get_header();

?>

	<main id="primary" class="site-main">
		<div class="hero-wrapper">
			<video
				poster="<?php echo get_template_directory_uri() . '/video/hero-poster.png' ?>"
				class="hero-video"
				preload="none"
				autoplay
				muted
				loop
			>
				<source src="<?php echo get_template_directory_uri() . '/video/hero-video.mp4' ?>" type="video/mp4">
			</video>
			<div class="hero-video-shadow">
				<span>Якісна сільгосптехніка від аграріїв для аграріїв</span>
				<button>Продукція</button>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
