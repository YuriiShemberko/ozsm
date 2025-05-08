<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agrotech
 */
wp_enqueue_style( 'at_header_style', get_template_directory_uri() . '/css/header.css' );
wp_enqueue_script( 'at_cart_script', get_template_directory_uri() . '/js/cart.js' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'agrotech' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<div class="ozsm-logo">
				<?php the_custom_logo(); ?>
			</div>
			<div class="site-branding-text">
				<h1><?php bloginfo( 'name' ); ?></h1>
				<p class="site-description"><?php echo get_bloginfo( 'description', 'display' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '≡', 'agrotech' ); ?></button>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
			?>
		</nav><!-- #site-navigation -->

		<div class="cart">
			<button onclick="location.href = '<?php echo get_site_url() . '/cart' ?>'">
				<span class="dashicons dashicons-cart"></span>
			</button>
		</div>
		<div class="cart-counter">
			<span id="cart-products-counter">0</span>
		</div>
	</header><!-- #masthead -->
