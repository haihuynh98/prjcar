<?php
/**
 * Main Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once( 'options/main.php' );

?>
<fieldset class="itembox">
    <legend>
		<?php esc_attr_e( 'Main', $this->plugin['text'] ); ?>
    </legend>

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Position', $this->plugin['text'] ); ?><?php self::tooltip( $position_help ); ?>
                </label>
				<?php self::option( $position ); ?>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Shape', $this->plugin['text'] ); ?><?php self::tooltip( $shape_help ); ?>
                </label>
				<?php self::option( $shape ); ?>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Size', $this->plugin['text'] ); ?><?php self::tooltip( $size_help ); ?>
                </label>
				<?php self::option( $size ); ?>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Space', $this->plugin['text'] ); ?><?php self::tooltip( $space_help ); ?>
                </label>
				<?php self::option( $space ); ?>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Animation', $this->plugin['text'] ); ?><?php self::tooltip( $animation_help ); ?>
                </label>
				<?php self::option( $animation ); ?>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Shadow', $this->plugin['text'] ); ?><?php self::tooltip( $shadow_help ); ?>
                </label>
				<?php self::option( $shadow ); ?>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column is-4">
            <div class="field">
                <label class="label">
					<?php esc_attr_e( 'Z-index', $this->plugin['text'] ); ?><?php self::tooltip( $zindex_help ); ?>
                </label>
				<?php self::option( $zindex ); ?>
            </div>
        </div>
    </div>

</fieldset>