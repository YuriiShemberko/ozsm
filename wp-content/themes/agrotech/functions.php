<?php
/**
 * Agrotech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agrotech
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agrotech_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Agrotech, use a find and replace
		* to change 'agrotech' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'agrotech', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'agrotech' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'agrotech_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'agrotech_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agrotech_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'agrotech' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'agrotech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'agrotech_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agrotech_scripts() {
	wp_enqueue_style( 'agrotech-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'agrotech-style', 'rtl', 'replace' );

	wp_enqueue_script( 'agrotech-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agrotech_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function at_load_dashicons(){
   wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'at_load_dashicons', 999);

function at_contact_us_form_submit() {
    // Check if there is any post data and if it comes from our form
    if( empty( $_POST ) || !isset( $_POST[ 'action' ] ) || $_POST[ 'action' ] != 'at_contact_us_form_submit') {
        return;
    }

    // Check if inputs submitted are valid
  	if(
			( !isset( $_POST[ 'at_contact_form_phone' ]) || empty( $_POST[ 'at_contact_form_phone' ] ) ) ||
			( !isset( $_POST[ 'at_contact_form_email' ]) || empty( $_POST[ 'at_contact_form_email' ] ) ) ||
			( !isset( $_POST[ 'at_contact_form_message' ]) || empty( $_POST[ 'at_contact_form_message' ] ) ) ||
			( !isset( $_POST[ 'at_contact_form_name' ]) || empty( $_POST[ 'at_contact_form_name' ] ) )
		) {
        $_SESSION[ 'at_contact_form_submit_error' ] = __( 'Помилка: неправильні дані.' );
        return;
    }

		$to = "yurii.shemberko@gmail.com";//get_option( 'at_contacts_at_email' );
		$subject = "Нове повідомлення на сайті ozsm.ua";
		$message =
			"<h3>Надійшло нове повідомлення:</h3>" . "<br>" .
			"Від: <b>" . $_POST[ 'at_contact_form_name' ] . "</b><br>" .
			"Email клієнта: " . $_POST[ 'at_contact_form_email' ] . "<br>" .
			"Номер телефону клієнта: <b>" . $_POST[ 'at_contact_form_phone' ] . "</b><br>" .
			"Контекст: " . $_POST[ 'at_contact_form_context' ] . "<br><br>" .
			"Текст звернення: " . "<br>" . $_POST[ 'at_contact_form_message' ];

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <admin@ozsm.ua>' . "\r\n";

		$result = mail( $to, $subject, $message, $headers );

		if ($result) {
			$_SESSION[ 'at_contact_form_submit_success' ] = 'Ваше звернення уже в обробці.';
		} else {
			$_SESSION[ 'at_contact_form_submit_error' ] = 'Виникла непередбачувана помилка при відправці Вашого звернення.';
		}
}
add_action( 'init', 'at_contact_us_form_submit' );

function at_confirm_order() {
    // Check if there is any post data and if it comes from our form
    if( empty( $_POST ) || !isset( $_POST[ 'action' ] ) || $_POST[ 'action' ] != 'at_confirm_order') {
        return;
    }

		$cart_state = array_key_exists( 'at_cart', $_COOKIE ) ? json_decode(stripslashes( $_COOKIE[ 'at_cart' ] ), true) : [];
		$cart_items = array_key_exists( 'data', $cart_state ) ? $cart_state[ 'data' ] : [];

    // Check if inputs submitted are valid
  	if(
			( !isset( $_POST[ 'at_order_customer_phone' ] ) || empty( $_POST[ 'at_order_customer_phone' ] ) ) ||
			( !isset( $_POST[ 'at_order_customer_name' ] ) || empty( $_POST[ 'at_order_customer_name' ] ) ) ||
			( !isset( $_POST[ 'at_order_customer_email' ] ) || empty( $_POST[ 'at_order_customer_email' ] ) ) ||
			( empty( $cart_items ) )
		) {
        $_SESSION[ 'at_order_submit_error' ] = __( 'Помилка: неправильні дані.' );
        return;
    }

		$additional_info =
			isset( $_POST[ 'at_order_optional_message' ] ) && !empty( $_POST[ 'at_order_optional_message' ] ) ?	$_POST[ 'at_order_optional_message' ] : '-';

		$to = "yurii.shemberko@gmail.com";//get_option( 'at_contacts_at_email' );
		$subject = "Нове замовлення на сайті ozsm.ua";
		$message =
			"<h3>Оформлено нове замовлення:</h3>" . "<br>" .
			"Від: <b>" . $_POST[ 'at_order_customer_name' ] . "</b><br>" .
			"Email клієнта: " . $_POST[ 'at_order_customer_email' ] . "<br>" .
			"Номер телефону клієнта: <b>" . $_POST[ 'at_order_customer_phone' ] . "</b><br>" .
			"Додаткова інформація: " . "<br>" . $additional_info  . "<br><br>" .
			"<b>Замовлення</b>: " . "<br><br>";

		foreach ( $cart_items as $post_id => $value ) {
			$amount = $value['amount'];
      $item_title = get_the_title( $post_id );
			$item_url = get_post_permalink( $post_id );

			$message = $message .
				"Товар: " . $item_title . "<br>" .
				"Посилання: <a href=\"" . $item_url . "\">" . $item_url . "</a><br>" .
				"Кількість: " . $amount . "<br><br>" ;
		}

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <admin@ozsm.ua>' . "\r\n";

		$result = mail( $to, $subject, $message, $headers );

		if ($result) {
			header( 'Location: ' . get_site_url() . '/order_success' );
			exit();
			//$_SESSION[ 'at_confirm_order_success' ] = 'Дякуємо! Ми прийняли Ваше замовлення. Наш менеджер скоро зв\'яжеться з Вами.';
		} else {
			$_SESSION[ 'at_confirm_order_error' ] = 'Виникла непередбачувана помилка при оформленні Вашого замовлення. Будь ласка, спробуйте знову.';
		}
}
add_action( 'init', 'at_confirm_order' );
