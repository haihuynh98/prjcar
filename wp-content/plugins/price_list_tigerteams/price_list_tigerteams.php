<?php
/**
 * Plugin Name:     Price List
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     The price listing plugin
 * Author:          TigerGentlemen
 * Author URI:      https://tigergentlemen.com
 * Text Domain:     price_list_tigerteams
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Price_list_tigerteams
 */

const ACTION_SAVE_PRICE = 'save_price';
const PRICE_LIST_NONCE = 'price_list_nonce';
const DISTRICTS = [
	'hcm' => 'Hồ Chí Minh',
	'hn' => 'Hà Nội',
	'other' => 'Các tỉnh khác'
];
const ELEMENT_LIST = [
	'annual_price' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Giá niên yết'
	],
	'reduced_price' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Giá giảm'
	],
	'price' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Giá bán'
	],
	'registration_fee' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Phí trước bạ'
	],
	'registration_fee_2' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Phí đăng kiểm'
	], 'license_plate_fee' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Phí biển số'
	], 'physical_damage_coverage' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Bảo hiểm vật chất'
	], 'civil_liability_insurance' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Bảo hiểm dân sự'
	], 'registration_service_fee' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Phí dịch vụ đăng ký'
	], 'road_toll_per_year' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Phí đường bộ 1 năm'
	], 'deposit' => [
		'type' => 'number',
		'min' => 1000,
		'label' => 'Đặt cọc'
	],
];

require_once 'module-projects-listing.php';
include('includes/shortcode-build-form-price.php');

/**
 * Khai báo meta box
 **/
function pricedetails_meta_box()
{

	if (getPostType('price_list')) {
		wp_nonce_field(ACTION_SAVE_PRICE, PRICE_LIST_NONCE);
		foreach (DISTRICTS as $key => $district) {
			add_meta_box('price-details-' . $key, 'Chi tiết giá xe ' . $district, 'price_details_output_' . $key, 'price_list');
		}
	}
}

add_action('add_meta_boxes', 'pricedetails_meta_box');

/**
 * @return boolean
 */
function getPostType($postType): bool
{
	global $post;
	if (isset($_GET['post_type'])) {
		$currentPostType = $_GET['post_type'];
		if ($postType == $currentPostType || $post->post_type == $postType) {
			return TRUE;
		}
	}

	if ($post->post_type == $postType) {
		return TRUE;
	}
	return FALSE;
}


/**
 * @param $post
 * @return void
 */
function render_form($post, $pre): void
{
	$elements = ELEMENT_LIST;

	echo('<table class="form-table" role="presentation">');
	echo('<tbody>');
	foreach ($elements as $key => $element) {
		echo('<tr>');
		echo('<th scope="row"><label for="' . $key . '_' . $pre . '">' . $element['label'] . ' </label></th>');

		// Create input
		$dataMin = '';
		if ($element['min'] != null) {
			$dataMin = 'min="' . $element['min'] . '"';
		}
		$dataValue = get_post_meta($post->ID, '_' . $key . '_' . $pre, true);


		echo('<td><input name="' . $key . '_' . $pre . '" type="' . $element['type'] . '" id="' . $key . '_' . $pre . '" ' . $dataMin . ' value="' . esc_attr($dataValue) . '" class="regular-text"></td>');

		echo('</tr>');
	}
	echo('</tbody>');
	echo('</table>');
}

/**
 * Khai báo callback
 * @param $post là đối tượng WP_Post để nhận thông tin của post
 **/
function price_details_output_hcm($post)
{
	render_form($post, 'hcm');
}


/**
 * Khai báo callback
 * @param $post là đối tượng WP_Post để nhận thông tin của post
 **/

function price_details_output_hn($post)
{
	render_form($post, 'hn');
}

function price_details_output_other($post)
{
	render_form($post, 'other');
}

/**
 * Lưu dữ liệu meta box khi nhập vào
 * @param post_id là ID của post hiện tại
 **/
function price_list_save($post_id)
{
	if (getPostType('price_list')) {
		$elements = ELEMENT_LIST;
		if (isset($_POST[PRICE_LIST_NONCE])) {
			$priceListNonce = $_POST[PRICE_LIST_NONCE];
			// Kiểm tra nếu nonce chưa được gán giá trị
			if (!isset($priceListNonce)) {
				return;
			}
			// Kiểm tra nếu giá trị nonce không trùng khớp
			if (!wp_verify_nonce($priceListNonce, ACTION_SAVE_PRICE)) {
				return;
			}

		}
		foreach (DISTRICTS as $keyDistrict => $district) {
			foreach ($elements as $key => $element) {
				if (isset($_POST[$key . '_' . $keyDistrict])) {
					update_post_meta($post_id, '_' . $key . '_' . $keyDistrict, sanitize_text_field($_POST[$key . '_' . $keyDistrict]));
				} else {
					update_post_meta($post_id, '_' . $key . '_' . $keyDistrict, 0);
				}
			}
		}
	}
}

add_action('save_post', 'price_list_save');

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_register_script('price-list-tiger', plugin_dir_url(__FILE__) . 'assets/js/main.js', array('jquery'), '1.0');
		wp_enqueue_script('price-list-tiger');

		wp_register_style('price-list-tiger-style', plugin_dir_url(__FILE__) . 'assets/css/main.css');
		wp_enqueue_style('price-list-tiger-style');
	});
