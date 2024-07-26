<?php
 
 /**
 * Plugin Name: ОЗСМ "АгроТех" Плагін
 * Description: Власний плагін, що містить функціонал для сайту.
 */
 
 if ( is_admin() ) {
    require_once __DIR__ . '/agrotech.php';
}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
 
 /**
 * A function to register custom post types.
 *
 * TODO: complete labels. See get_post_type_labels() 
 */
 
if ( ! function_exists( 'at_setup_custom_post_types' ) ) {
	
	function at_setup_custom_post_types() {
				 
		/**
		* Registers a product as a custom post type.
		*/
		
		register_post_type( 'product', [
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'description' => 'This is a post type which describes a product',
			'labels' => [
				'name' => 'Продукт',
				'add_new' => 'Додати продукт',
				'add_new_item' => 'Додати продукт',
				'new_item' => 'Новий продукт',
				'view_item' => 'Переглянути продукт',
				'view_items' => 'Переглянути продукти',
				'search_items' => 'Пошук продуктів',
				'not_found' => 'Не знайдено продуктів',
				'not_found_in_trash' => 'Не знайдено продуктів у кошику',
				'archives' => 'Архів продуктів',
				'attributes' => 'Характеристики продукта',
				'insert_into_item' => 'Додати до продукта',
				'uploaded_to_this_item' => 'Завантажено до продукта',
				'featured_image' => 'Головне зображення',
				'set_featured_image' => 'Встановити головне зображення',
				'remove_featured_image' => 'Видалити головне зображення',
				'use_featured_image' => 'Використовувати головне зображення',
				'filter_items_list' => 'Фільтрувати список продуктів',
				'filter_by_date' => 'Фільтр по даті',
				'items_list_navigation' => 'Навігація по продуктам',
				'items_list' => 'Список продуктів',
				'item_published' => 'Продукт опублікований',
				'item_reverted_to_draft' => 'Продукт конвертований у чернетку',
				'item_trashed' => 'Продукт видалено до кошику',
				'item_scheduled' => 'Продукт заплановано до публікації',
				'item_updated' => 'Продукт оновлено',
				'item_link' => 'Посилання на продукт',
				'item_link_description' => 'Посилання на продукт',
			],
		] );
		
		
		/**
		* Registers a spare part as a custom post type.
		*/
		
		register_post_type( 'spare_part', [
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'description' => 'This is a post type which describes a product',
			'labels' => [
				'name' => 'Запчастина',
				'add_new' => 'Додати запчастину',
				'add_new_item' => 'Додати запчастину',
				'new_item' => 'Нова запчастина',
				'view_item' => 'Переглянути запчастину',
				'view_items' => 'Переглянути запчастини',
				'search_items' => 'Пошук запчастин',
				'not_found' => 'Не знайдено запчастин',
				'not_found_in_trash' => 'Не знайдено запчастин у кошику',
				'archives' => 'Архів запчастин',
				'attributes' => 'Характеристики запчастини',
				'insert_into_item' => 'Додати до запчастини',
				'uploaded_to_this_item' => 'Завантажено до запчастини',
				'featured_image' => 'Головне зображення',
				'set_featured_image' => 'Встановити головне зображення',
				'remove_featured_image' => 'Видалити головне зображення',
				'use_featured_image' => 'Використовувати головне зображення',
				'filter_items_list' => 'Фільтрувати список запчастин',
				'filter_by_date' => 'Фільтр по даті',
				'items_list_navigation' => 'Навігація по запчастинам',
				'items_list' => 'Список запчастин',
				'item_published' => 'Запчастину опублікований',
				'item_reverted_to_draft' => 'Запчастину конвертовано у чернетку',
				'item_trashed' => 'Запчастину видалено до кошику',
				'item_scheduled' => 'Запчастину заплановано до публікації',
				'item_updated' => 'Запчастину оновлено',
				'item_link' => 'Посилання на запчастину',
				'item_link_description' => 'Посилання на запчастину',
			],
		] );
	}
 }
add_action( 'init', 'at_setup_custom_post_types' );

 
 /**
 * Activate the plugin.
 */
 
if ( ! function_exists( 'at_activate' ) ) {
	function at_activate() { 
		// Trigger our function that registers the custom post type plugin.
		at_setup_custom_post_types(); 
		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules(); 
	}
 }
register_activation_hook( __FILE__, 'at_activate' );


/**
 * Deactivation hook.
 */
 
if ( ! function_exists( 'at_deactivate' ) ) {
	function at_deactivate() {
		// Unregister the post type, so the rules are no longer in memory.
		unregister_post_type( 'product' );
		unregister_post_type( 'spare_part' );
		// Clear the permalinks to remove our post type's rules from the database.
		flush_rewrite_rules();
	}
}
register_deactivation_hook( __FILE__, 'at_deactivate' );
