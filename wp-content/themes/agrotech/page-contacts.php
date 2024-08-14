<?php

get_header();

wp_enqueue_style( 'at_contacts_page_style', get_template_directory_uri() . '/css/contacts-page.css' );
?>

	<main id="primary" class="site-main">
    <div class="page-content">
			<div class="contacts-page-content">
				<div class="main-contacts" >
					<div>
						<h3>Відділ продажів</h4>
						<a href="tel:<?php echo get_option( 'at_contacts_at_primary_phone' ); ?>"><?php echo get_option( 'at_contacts_at_primary_phone' ); ?></a>
					</div>
					<div>
						<h3>Наш e-mail</h4>
						<a href="mailto:<?php echo get_option( 'at_contacts_at_email' ); ?>"><?php echo get_option( 'at_contacts_at_email' ); ?></a>
					</div>
					<div>
						<h3>Відділ продажу запчастин та комплектуючих</h4>
						<a href="tel:<?php echo get_option( 'at_contacts_at_secondary_phone' ); ?>"><?php echo get_option( 'at_contacts_at_secondary_phone' ); ?></a>
					</div>
					<div>
						<h3>Графік роботи</h4>
					 	<pre><?php echo get_option ('at_contacts_at_working_hours' ); ?></pre>
					</div>
					<div class="contact-form-wrapper">
					 <h3>Задайте нам питання через форму</h3>
					 <?php get_template_part( "template-parts/contact-form" ) ?>
					</div>
			 	</div>
				<div class="google-map-wrapper">
					<h3>Ми знаходимось тут</h3>
					<div class="google-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10685.68378311339!2d34.9538053!3d47.9669205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dc7a8a1dfd3425%3A0x7b03de5482428e19!2z0LLRg9C70LjRhtGPINCU0L3RltC_0YDQvtC_0LXRgtGA0L7QstGB0YzQutCwLCDQm9GD0LrQsNGI0LXQstC1LCDQl9Cw0L_QvtGA0ZbQt9GM0LrQsCDQvtCx0LvQsNGB0YLRjCwgNzA0MTA!5e0!3m2!1suk!2sua!4v1723645928127!5m2!1suk!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
  	</div>
	</main><!-- #main -->

<?php
get_footer();
