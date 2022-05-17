<?php
/**
 * Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

include_once( 'icons.php' );
$icons_new = array();
foreach ( $icons as $key => $value ) {
	$icons_new[ $value ] = $value;
}

$count_i = ( ! empty( $param['menu_1']['item_type'] ) ) ? count( $param['menu_1']['item_type'] ) : '0';
if ( $count_i > 0 ) {
	for ( $i = 0; $i < $count_i; $i ++ ) {
		// Icon
		$item_icon_[ $i ] = array(
			'name'   => 'param[menu_1][item_icon][]',
			'class'  => 'icons',
			'type'   => 'select',
			'val'    => isset( $param['menu_1']['item_icon'][ $i ] ) ? $param['menu_1']['item_icon'][ $i ]
				: 'fas fa-hand-point-up',
			'option' => $icons_new,
		);

		// Label for item
		$item_tooltip_[ $i ] = array(
			'name'  => 'param[menu_1][item_tooltip][]',
			'class' => 'item-tooltip',
			'type'  => 'text',
			'val'   => isset( $param['menu_1']['item_tooltip'][ $i ] ) ? $param['menu_1']['item_tooltip'][ $i ] : '',
		);


		// Type of the item
		$item_type_[ $i ] = array(
			'name'   => 'param[menu_1][item_type][]',
			'type'   => 'select',
			'class'  => 'item-type',
			'val'    => isset( $param['menu_1']['item_type'][ $i ] ) ? $param['menu_1']['item_type'][ $i ] : 'link',
			'option' => array(
				'link'         => esc_attr__( 'Link', $this->plugin['text'] ),
			),
			'func'   => 'itemtype(this);',
		);

		// Link URL
		$item_link_[ $i ] = array(
			'name' => 'param[menu_1][item_link][]',
			'type' => 'text',
			'val'  => isset( $param['menu_1']['item_link'][ $i ] ) ? $param['menu_1']['item_link'][ $i ] : '',
		);

		// Text Color
		$color_[ $i ] = array(
			'name' => 'param[menu_1][color][]',
			'type' => 'color',
			'val'  => isset( $param['menu_1']['color'][ $i ] ) ? $param['menu_1']['color'][ $i ] : '#383838',
		);

		// Background
		$bcolor_[ $i ] = array(
			'name' => 'param[menu_1][bcolor][]',
			'type' => 'color',
			'val'  => isset( $param['menu_1']['bcolor'][ $i ] ) ? $param['menu_1']['bcolor'][ $i ] : '#81d742',
		);

		$button_id_[ $i ] = array(
			'name' => 'param[menu_1][button_id][]',
			'type' => 'text',
			'val'  => isset( $param['menu_1']['button_id'][ $i ] ) ? $param['menu_1']['button_id'][ $i ] : '',
		);

		$button_class_[ $i ] = array(
			'name' => 'param[menu_1][button_class][]',
			'type' => 'text',
			'val'  => isset( $param['menu_1']['button_class'][ $i ] ) ? $param['menu_1']['button_class'][ $i ] : '',
		);

		$link_rel_[ $i ] = array(
			'name' => 'param[menu_1][link_rel][]',
			'type' => 'text',
			'val'  => isset( $param['menu_1']['link_rel'][ $i ] ) ? $param['menu_1']['link_rel'][ $i ] : '',
		);

	}

}

$item_icon_help = array(
	'title' => esc_attr__( 'Set the icon for menu item. If you want use the custom item:', $this->plugin['text'] ),
	'ul'    => array(
		esc_attr__( '1. Check the box on "custom"', $this->plugin['text'] ),
		esc_attr__( '2. Upload the icon in Media Library', $this->plugin['text'] ),
		esc_attr__( '3. Copy the URL to icon', $this->plugin['text'] ),
		esc_attr__( '4. Paste the icon URL to field', $this->plugin['text'] ),
	),
);

$item_tooltip_help = array(
	'text' => esc_attr__( 'Set the text for menu item. Left empty, if you want use item without tooltip.', $this->plugin['text'] ),
);

$item_type_help = array(
	'title' => esc_attr__( 'Types of the button which can be select', $this->plugin['text'] ),
	'ul'    => array(
		esc_attr__( 'Link - insert any link', $this->plugin['text'] ),
	),
);

$hold_open_help = array(
	'text' => esc_attr__( 'Hold open button label.', $this->plugin['text'] ),
);

$button_class_help = array(
	'title' => esc_attr__( 'Set Class for element.', $this->plugin['text'] ),
	'ul'    => array(
		esc_attr__( 'You may enter several classes separated by a space.', $this->plugin['text'] ),
	)
);

$button_id_help = array(
	'text' => esc_attr__( 'Set ID for element.', $this->plugin['text'] ),
);

$image_alt_help = array(
	'text' => esc_attr__( 'Set the attribute Alt for custom image.', $this->plugin['text'] ),
);