<?php
/**
 * Main Settings param
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


// Position of the menu
$position = array(
	'id'     => 'position',
	'name'   => 'param[position]',
	'type'   => 'select',
	'val'    => isset( $param['position'] ) ? $param['position'] : '-left-center',
	'option' => array(
		'-left-center'   => esc_attr__( 'Left Center', $this->plugin['text'] ),
		'-right-center'  => esc_attr__( 'Right Center', $this->plugin['text'] ),
	),
);

// Menu position help
$position_help = array(
	'text' => esc_attr__( 'Specify position on screen.', $this->plugin['text'] ),
);

// Shape for menu item
$shape = array(
	'name'   => 'param[shape]',
	'class'  => '',
	'type'   => 'select',
	'val'    => isset( $param['shape'] ) ? $param['shape'] : '-square',
	'option' => array(
		'-square'  => esc_attr__( 'Square', $this->plugin['text'] ),
		'-rsquare' => esc_attr__( 'Rounded square', $this->plugin['text'] ),
		'-circle'  => esc_attr__( 'Circle', $this->plugin['text'] ),
		'-ellipse' => esc_attr__( 'Ellipse', $this->plugin['text'] ),
	),
);

// Shape help
$shape_help = array(
	'text' => esc_attr__( 'The shape of the buttons. It also determines the shape of the labels.',
		$this->plugin['text'] ),
);

// Size
$size = array(
	'name'   => 'param[size]',
	'class'  => '',
	'type'   => 'select',
	'val'    => isset( $param['size'] ) ? $param['size'] : '-medium',
	'option' => array(
		'-medium' => esc_attr__( 'Medium', $this->plugin['text'] ),
	),
);

// Size help
$size_help = array(
	'text' => esc_attr__( 'Set the size for all buttons', $this->plugin['text'] ),
);

// Space
$space = array(
	'name'   => 'param[space]',
	'class'  => '',
	'type'   => 'select',
	'val'    => isset( $param['space'] ) ? $param['space'] : '-space',
	'option' => array(
		'-space' => esc_attr__( 'Yes', $this->plugin['text'] ),
		''       => esc_attr__( 'No', $this->plugin['text'] ),
	),
);

// Side Space help
$space_help = array(
	'text' => esc_attr__( 'If there should be space between buttons.', $this->plugin['text'] ),
);

// Label Animate
$animation = array(
	'name'   => 'param[animation]',
	'class'  => '',
	'type'   => 'select',
	'val'    => isset( $param['animation'] ) ? $param['animation'] : '',
	'option' => array(
		''             => esc_attr__( 'None', $this->plugin['text'] ),
	),
);

// Label Animate help
$animation_help = array(
	'text' => esc_attr__( 'The appearance effect of the button label', $this->plugin['text'] ),
);

// Shadow
$shadow = array(
	'name'   => 'param[shadow]',
	'class'  => '',
	'type'   => 'select',
	'val'    => isset( $param['shadow'] ) ? $param['shadow'] : '',
	'option' => array(
		''        => esc_attr__( 'No', $this->plugin['text'] ),
	),
);

// Side Space help
$shadow_help = array(
	'text' => esc_attr__( 'If there should be a shadow on buttons.', $this->plugin['text'] ),
);

$zindex = array(
	'name'   => 'param[zindex]',
	'type'   => 'number',
	'val'    => isset( $param['zindex'] ) ? round( $param['zindex'] ) : '9',
	'option' => array(
		'min'         => '0',
		'step'        => '1',
		'placeholder' => '9',
	),
);

// Z-index helper
$zindex_help = array(
	'text' => esc_attr__( 'The z-index property specifies the stack order of an element. An element with greater stack order is always in front of an element with a lower stack order.',
		$this->plugin['text'] ),
);
