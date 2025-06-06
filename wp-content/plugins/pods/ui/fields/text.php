<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$attributes             = array();
$attributes['type']     = 'text';
$attributes['value']    = $value;
$attributes['tabindex'] = 2;
$attributes['class']    = 'regular-text';
// For setting pages
$attributes = PodsForm::merge_attributes( $attributes, $name, $form_field_type, $options );

if ( (bool) pods_v( 'readonly', $options, false ) ) {
	$attributes['readonly'] = 'READONLY';

	$attributes['class'] .= ' pods-form-ui-read-only';
}
?>
	<input<?php PodsForm::attributes( $attributes, $name, $form_field_type, $options ); ?> />
<?php
PodsForm::regex( $form_field_type, $options );
