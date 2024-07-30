<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agrotech
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer-section">
			<div>
				<h4>Відділ продажів</h4>
				<a href="tel:<?php echo get_option( 'at_primary_phone' ); ?>"><?php echo get_option( 'at_primary_phone' ); ?></a>
			</div>
			<div>
				<h4>Наш e-mail</h4>
				<a href="mailto:<?php echo get_option( 'at_email' ); ?>"><?php echo get_option( 'at_email' ); ?></a>
			</div>
		</div>

		<div class="site-footer-section">
			<div>
				<h4>Відділ продажу запчастин та комплектуючих</h4>
				<a href="tel:<?php echo get_option( 'at_secondary_phone' ); ?>"><?php echo get_option( 'at_secondary_phone' ); ?></a>
			</div>
		</div>

		<div class="site-footer-section">
			<div>
				<h4>Наша сторінка в TikTok</h4>
				<a rel="noreferrer" target="_blank" href="<?php echo get_option( 'at_tiktok_link' ); ?>">Відкрити посилання</a>
			</div>
		</div>

		<div class="site-footer-section">
			<div>
			 <h4>Графік роботи</h4>
			 <pre><?php echo get_option ('at_working_hours' ); ?></pre>
		 </div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
