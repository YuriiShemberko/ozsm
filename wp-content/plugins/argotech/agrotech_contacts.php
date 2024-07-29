<?php

if ( ! function_exists('at_add_contacts_page_to_admin_panel' ) ) {
  function at_add_contacts_page_to_admin_panel() {
    add_options_page(
      'Управління контактами',
      'Контакти',
      'manage_options',
      'manage_contacts',
      'at_render_manage_contacts_page',
    );
  }
}
add_action ( 'admin_menu', 'at_add_contacts_page_to_admin_panel' );

if ( ! function_exists ('at_load_manage_contacts_assets' ) ) {
  function at_load_manage_contacts_assets( $hook ) {
    if ( $hook !== 'toplevel_page_manage_contacts' ) {
      return;
    }
    wp_enqueue_style( 'at_admin_style', plugins_url( 'argotech/assets/css/admin.css', __FILE__ ) );
    wp_enqueue_script( 'at_admin_script', plugins_url( 'argotech/assets/js/agrotech_contacts.js' ) );
  }
}
add_action( 'admin_enqueue_scripts', 'at_load_manage_contacts_assets' );

if ( ! function_exists ('at_register_contacts_options' ) ) {
  function at_register_contacts_options() {
    // Main telephone number
    register_setting (
      'at_contacts', 'at_primary_phone', [
      'type' => 'string',
      'show_in_rest' => true,
      'default' => ''
    ] );

    // Secondary telephone number
    register_setting (
      'at_contacts', 'at_secondary_phone', [
      'type' => 'string',
      'show_in_rest' => true,
      'default' => '',
    ] );

    // Contact email
    register_setting (
      'at_contacts', 'at_email', [
      'type' => 'string',
      'show_in_rest' => true,
      'default' => '',
    ] );
  }
}
add_action( 'admin_init', 'at_register_contacts_options' );

if ( ! function_exists ('at_render_manage_contacts_page' ) ) {
  function at_render_manage_contacts_page() {
    ?>
    <div class="wrap">
    <h1>Налаштування ОЗСМ "АгроТех"</h1>

    <form method="post" action="options.php">
        <?php settings_fields( 'at_contacts' ); ?>
        <?php do_settings_sections( 'at_contacts' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Основний контактний номер телефону</th>
            <td><input type="text" name="at_primary_phone" value="<?php echo esc_attr( get_option('at_primary_phone') ); ?>" /></td>
            </tr>

            <tr valign="top">
            <th scope="row">Додатковий контактний номер телефону</th>
            <td><input type="text" name="at_secondary_phone" value="<?php echo esc_attr( get_option('at_secondary_phone') ); ?>" /></td>
            </tr>

            <tr valign="top">
            <th scope="row">Адреса контактної електронної пошти</th>
            <td><input type="text" name="at_email" value="<?php echo esc_attr( get_option('at_email') ); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
    </div>
    <?php }
}
