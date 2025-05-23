<?php

namespace Pods\Blocks\Types;

use Exception;
use Pods\Blocks\Blocks_Abstract;
use WP_Block;

/**
 * Field block functionality class.
 *
 * @since 2.8.0
 */
abstract class Base extends Blocks_Abstract {

	/**
	 * Set the default attributes of this block.
	 *
	 * @since 2.8.0
	 *
	 * @return array List of attributes.
	 */
	public function default_attributes() {
		$fields = $this->fields();

		$defaults = [];

		foreach ( $fields as $field ) {
			$defaults[ $field['name'] ] = $this->default_attribute( $field );
		}

		return $defaults;
	}

	/**
	 * Get the default attribute for a field.
	 *
	 * @since 2.8.0
	 *
	 * @param array $field The field to get the default attribute for.
	 *
	 * @return mixed The default attribute for a field.
	 */
	public function default_attribute( $field ) {
		$default_value = isset( $field['default'] ) ? $field['default'] : '';

		if ( 'pick' === $field['type'] && isset( $field['data'] ) ) {
			foreach ( $field['data'] as $key => $value ) {
				if ( ! is_array( $value ) ) {
					$value = [
						'label' => $value,
						'value' => $key,
					];
				}

				if ( $default_value === $value['value'] ) {
					$default_value = $value;

					break;
				}
			}
		}

		return $default_value;
	}

	/**
	 * Get list of Field configurations to register with Pods for the block.
	 *
	 * @since 2.8.0
	 *
	 * @return array List of Field configurations.
	 */
	public function fields() {
		return [];
	}

	/**
	 * Register the block with Pods.
	 *
	 * @since 2.8.0
	 */
	public function register_with_pods() {
		$block = $this->block();

		if ( empty( $block ) ) {
			return;
		}

		$block['name'] = $this->slug();

		$this->assets();
		$this->hook();

		pods_register_block_type( $block, $this->fields() );
	}

	/**
	 * Get block configuration to register with Pods.
	 *
	 * @since 2.8.0
	 *
	 * @return array Block configuration.
	 */
	public function block() {
		return [];
	}

	/*
	 * {@inheritDoc}
	 *
	 * @since 2.8.0
	*/
	public function attributes( $params = [] ) {
		// Convert any potential array values for pick/boolean.
		foreach ( $params as $param => $value ) {
			if ( is_array( $value ) ) {
				if ( isset( $value['label'], $value['value'] ) ) {
					$params[ $param ] = $value['value'];
				} elseif ( isset( $value[0]['label'], $value[0]['value'] ) ) {
					$params[ $param ] = array_values( wp_list_pluck( $value, 'value' ) );
				}
			}
		}

		$params['_is_editor_mode'] = $this->in_editor_mode( $params );
		$params['_is_preview']     = is_preview();
		$params['_preview_id']     = $params['_is_preview'] ? get_queried_object_id() : null;

		return parent::attributes( $params );
	}

	/**
	 * Render content for block with placeholder template.
	 *
	 * @since 2.8.0
	 *
	 * @param string $heading The heading text.
	 * @param string $content The content text.
	 * @param null|string $image The image content or null if not set.
	 *
	 * @return string The content to render.
	 */
	public function render_placeholder( $heading, $content, $image = null ) {
		ob_start();
		?>
		<div <?php echo get_block_wrapper_attributes( [ 'class' => 'pods-block-placeholder_container' ] ); ?>">
			<div class="pods-block-placeholder_content-container">
				<img src="<?php echo esc_url( PODS_URL . 'ui/images/pods-logo-green.svg' ); ?>" alt="<?php esc_attr_e( 'Pods logo', 'pods' ); ?>" class="pods-logo">
				<div class="pods-block-placeholder_content">
					<h2 class="pods-block-placeholder_title"><?php echo wp_kses_post( $heading ); ?></h2>
					<p><?php echo wp_kses_post( $content ); ?></p>
				</div>
			</div>
			<?php if ( $image ) : ?>
				<?php echo wp_kses_post( $image ); ?>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Get the list of all Pods for a block field.
	 *
	 * @since 2.9.10
	 *
	 * @return array List of all Pod names and labels.
	 */
	public function callback_get_all_pods() {
		$api = pods_api();

		$all_pods = [];

		try {
			$all_pods = $api->load_pods( [ 'names' => true ] );
		} catch ( Exception $exception ) {
			pods_debug_log( $exception );
		}

		return array_merge( [
				'' => '- ' . __( 'Use Current Pod', 'pods' ) . ' -',
		], $all_pods );
	}

	/**
	 * Get the list of all Pod Templates for a block field.
	 *
	 * @since 2.9.10
	 *
	 * @return array List of all Pod Template names and labels.
	 */
	public function callback_get_all_pod_templates() {
		$api = pods_api();

		$all_templates = [];

		try {
			$all_templates = $api->load_templates( [ 'names' => true ] );
		} catch ( Exception $exception ) {
			pods_debug_log( $exception );
		}

		return array_merge( [
				'' => '- ' . __( 'Use Custom Template', 'pods' ) . ' -',
		], $all_templates );
	}

	/**
	 * Determine whether we are preloading a block.
	 *
	 * @since 2.8.8
	 *
	 * @return bool Whether we are preloading a block.
	 */
	public function is_preloading_block() {
		return is_admin() && 'edit' === pods_v( 'action' ) && 0 < (int) pods_v( 'post' );
	}

	/**
	 * Determine whether to preload the block.
	 *
	 * @since 2.8.8
	 *
	 * @param array         $attributes           The block attributes used.
	 * @param WP_Block|null $block                The WP_Block object or null if not provided.
	 *
	 * @return bool Whether to preload the block.
	 */
	public function should_preload_block( $attributes = [], $block = null ) {
		/**
		 * Allow filtering whether to preload the Pods block.
		 *
		 * @since 2.8.8
		 *
		 * @param bool          $should_preload_block Whether to preload the block.
		 * @param array         $attributes           The block attributes used.
		 * @param WP_Block|null $block                The WP_Block object or null if not provided.
		 * @param Base          $block_type           The block type object (not WP_Block).
		 */
		return (bool) apply_filters( 'pods_blocks_types_preload_block', true, $attributes, $block, $this );
	}

	/**
	 * Determine whether the block is being rendered in editor mode.
	 *
	 * @param array $attributes The block attributes used.
	 *
	 * @return bool Whether the block is being rendered in editor mode.
	 */
	public function in_editor_mode( $attributes = [] ) {
		if ( ! empty( $attributes['_is_editor'] ) && ! empty( $attributes['_is_editor_mode'] ) ) {
			return true;
		}

		if ( is_admin() ) {
			$screen = get_current_screen();

			if ( $screen && 'post' === $screen->base ) {
				return true;
			}
		}

		if (
			wp_is_json_request()
			&& did_action( 'rest_api_init' )
		) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether to apply wpautop to the block content output.
	 *
	 * @since 3.2.8
	 *
	 * @param string|mixed $content    The content to determine whether to autop.
	 * @param array        $attributes The Pods render attributes that will be used.
	 *
	 * @return bool Whether to apply wpautop to the block content output.
	 */
	public function should_autop( $content, array $attributes = [] ): bool {
		$should_autop = (
			is_string( $content )
			&& false === strpos( $content, '<div' )
			&& false === strpos( $content, '<ul' )
			&& false === strpos( $content, '<ol' )
			&& false === strpos( $content, '<h' )
			&& false === strpos( $content, '<p' )
		);

		/**
		 * Allow filtering whether to apply wpautop to the block content output.
		 *
		 * This is used for things like Field block render or List block render of the no items found message.
		 *
		 * @since 3.2.8
		 *
		 * @param bool         $should_autop Whether to apply wpautop to the block content output.
		 * @param string|mixed $content      The content to determine whether to autop.
		 * @param array        $attributes   The Pods render attributes that will be used.
		 */
		return (bool) apply_filters( 'pods_blocks_should_autop', $should_autop, $content, $attributes );
	}
}
