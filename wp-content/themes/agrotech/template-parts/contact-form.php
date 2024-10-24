<?php
  wp_enqueue_style( 'at_contact_form_style', get_template_directory_uri() . '/css/contact-form.css' );
  $context = $args[ 'context' ];
?>

<div id="at_contact_us_form">
  <form action="" method="post" class="contact-form">
    <div class="contact-form-section">
      <label for="at_contact_form_name">Ваше ім'я</label>
      <input type="text" name="at_contact_form_name" id="at_contact_form_name" required>
    </div>

    <div class="contact-form-section">
      <label for="at_contact_form_email">Електронна адреса</label>
      <input type="email" name="at_contact_form_email" id="at_contact_form_email" required>
    </div>

    <div class="contact-form-section">
      <label for="at_contact_form_phone">Номер телефону</label>
      <input type="tel" name="at_contact_form_phone" id="at_contact_form_phone" required>
    </div>

    <div class="contact-form-section">
      <label for="at_contact_form_message">Повідомлення</label>
      <textarea cols="10" rows="5" charswidth="23" name="at_contact_form_message" id="at_contact_form_message" required></textarea>
    </div>

    <input type="hidden" name="at_contact_form_context" value="<?php echo $context ?>">
    <input type="hidden" name="action" value="at_contact_us_form_submit">
    <input type="submit" id="contact-form-submit-btn" class="levitating" value="Надіслати">

    <div class="contact-form-submit-result">
      <?php
        if ( isset( $_SESSION ) ) {
          if ( isset( $_SESSION[ 'at_contact_form_submit_success' ] ) ) {
            echo $_SESSION[ 'at_contact_form_submit_success' ];
          } else if ( isset( $_SESSION[ 'at_contact_form_submit_error' ] ) ) {
            echo $_SESSION[ 'at_contact_form_submit_error' ];
          }
        }
      ?>
    </div>
  </form>
</div>
