<?php

wp_enqueue_style( 'at_about_us_style', get_template_directory_uri() . '/css/about-us.css' );

get_header();
?>

	<main id="primary" class="site-main">
		<div class="page-content">
			<div class="about-us-page-content">
				<h2 class="about-us-header">Про нашу компанію</h2>
				<span class="about-us-text-info">
					Завод Агротех – це не тільки завод з виробництва сучасної сільськогосподарської техніки, а й група компаній у Запорізькій області, основними видами діяльності якої є сільське господарство.
					Характерна риса нашої компанії — якість.
					Для багатьох аграріїв важливо, що сільгоспагрегати від заводу виробника АГРОТЕХ адаптовані як до вітчизняної, так і до імпортної тягової техніки, і підходять як для невеликих фермерських господарств (з парком тракторів невеликої потужності 80-180 к.с.), так і для великих агропідприємств, орієнтованих на обробку великих площ (з найпотужнішими тракторами).
				</span>
				<div class="about-us-benefits-wrapper">
					<h2 class="about-us-header">Наші переваги</h2>
					<?php get_template_part( "template-parts/grid-infographics", "at_benefits_infographics", array(
							'infographics_data' => array(
								[
										'img_src' => get_template_directory_uri() . '/img/factory.png',
										'header_text' => 'Перевірені часом',
										'span_text' => 'Завод «Агротех» вже 21 рік виробляє ґрунтообробну сільськогосподарську техніку.',
								],
								[
										'img_src' => get_template_directory_uri() . '/img/compensation.png',
										'header_text' => 'Компенсація до 25%',
										'span_text' => 'Техніка компанії «Агротех» частково компенсується за рахунок коштів державного бюджету.',
								],
								[
										'img_src' => get_template_directory_uri() . '/img/service.png',
										'header_text' => 'Оперативність',
										'span_text' => 'Сервісне обслуговування техніки компанії "Агротех" здійснюється цілодобово - 24/7',
								],
								[
										'img_src' => get_template_directory_uri() . '/img/culture.png',
										'header_text' => 'Перевірено на собі',
										'span_text' => 'Техніка випробовується на власній землі. Наш земельний банк - 17000га',
								],
								[
										'img_src' => get_template_directory_uri() . '/img/warranty.png',
										'header_text' => 'Гарантія до 2 років',
										'span_text' => 'Завод компанії "Агротех" надає гарантію на всю техніку власного виробництва - 24 місяці',
								],
								[
										'img_src' => get_template_directory_uri() . '/img/delivery.png',
										'header_text' => 'Доставка',
										'span_text' => 'Доставка техніки здійснюється за допомогою власного автопарку',
								],
							)
						) );
					?>
				</div>
				<div class="about-us-contact-form-wrapper">
					<h2 class="about-us-header">Задайте нам питання</h2>
					<?php get_template_part( "template-parts/contact-form", "at_about_us_contact_form", array( 'context' => 'Сторінка --ПРО НАС--' ) ) ?>
				</div>
			</div>
    </div>
	</main><!-- #main -->

<?php
get_footer();
