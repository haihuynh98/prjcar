<?php
function price_listing()
{
	$args = array(
		'taxonomy' => 'price_tag',
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => true,
	);
	$tagPrices = get_tags($args);
	$optionCat = ' <option value="">Vui lòng chọn</option>';
	foreach ($tagPrices as $key => $tagPrice) {
		$optionCat .= '<option value="' . $tagPrice->term_id . '">' . $tagPrice->name . '</option>';
	}

	$html = '<div class="container"> <table>
                        <tbody>
                            <tr>
                                <td>Dòng xe:</td>
                                <td>
                                    <select name="price_list_cat" id="price_list_cat">
                                    ' . $optionCat . '
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Phiên bản:</td>
                                <td>
                                    <select name="price_list_item" id="price_list_item" disabled>
                                    <option value="">Chọn xe</option>
                                    </select>
                                   </td>
                            </tr>
                            <tr>
                                <td>Nơi đăng ký:</td>
                                <td>
                                    <select name="dictrict_register" id="dictrict_register">
                                                                                                                        <option value="hcm">Hồ Chí Minh</option>
                                                                                    <option value="hn">Hà Nội</option>
                                                                                    <option value="other">Các tỉnh khác</option>
                                                                                                                </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td><button type="button" class="button_dutoanchiphi" disabled>Dự toán chi phí</button></td>
                            </tr>
                        </tfoot>
                    </table>
						<div class="xe_thumb"></div>
						<div class="devvn_muaxe_note">* Công cụ tính toán chỉ mang tính chất tham khảo</div>
                    </div>';

	return $html;
}

function render_price_detail($postId, $term)
{
	$metaPost = get_post_meta($postId);
	$total = $totalWithPDC = 0;
	foreach ($metaPost as $key => $value) {
		if (strpos($key, '_' . $term)) {
			$valueClear = reset($value);
			if ('_physical_damage_coverage_' . $term == $key) {
				$totalWithPDC += $valueClear;
			} else {
				$totalWithPDC += $valueClear;
				$total += $valueClear;
			}
		}
	}
	$script = '<script type="text/javascript">
            $(\'.enable_baohiemvatchat\').on("click", function() {
            if($(this).is(":checked")) {
                $(\'.tongdutoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val()));
                }else {
                $(\'.tongdutoan_val\').html(numberWithCommas($(\'input#tongdutoan\').val()));
              }
            })

            $(\'#vaynganhang\').on(\'change\',function() {
            	let per = $(this).val();
           		let deposit = $(\'#deposit\').val();
             	$(\'.vaynganhang_val\').html(numberWithCommas(parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)));
             	$(\'.tienthanhtoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val() - parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)));
             	$(\'.canthanhtoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val() - parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)-deposit));
            })
</script>';
	return '<div class="devvn_muaoto_right">
                    <table class="table_dutoanchiphi">
                        <tbody>
                            <tr>
                                <td>Giá niêm yết:</td>
                                <td>
                                    <span class="giaxe_val">' . number_format($metaPost['_annual_price_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Giảm giá:</td>
                                <td>
                                    <span class="discount_val">' . number_format($metaPost['_reduced_price_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Giá bán:</td>
                                <td>
                                    <span class="giaban_val">' . number_format($metaPost['_price_' . $term][0]) . '</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table_dutoanchiphi">
                        <tbody>
                            <tr>
                                <td>Phí trước bạ:</td>
                                <td>
                                    <span class="phitruocba_val">' . number_format($metaPost['_registration_fee_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí đăng Kiểm :</td>
                                <td>
                                ' . number_format($metaPost['_registration_fee_2_' . $term][0]) . '<input type="hidden" value="340000" class="input_to_calc">
                                </td>
                            </tr>
                            <tr>
                                <td>Phí biển số:</td>
                                <td>
                                    <span class="phibienso_val">' . number_format($metaPost['_license_plate_fee_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" value="1" name="enable_baohiemvatchat" id="enable_baohiemvatchat" class="enable_baohiemvatchat" checked="">
                                        Bảo hiểm Vật Chất:                                    </label>
                                </td>
                                <td>
                                    <span class="baohiemvatchat_val">' . number_format($metaPost['_physical_damage_coverage_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Bảo hiểm dân sự:</td>
                                <td>
                                    <span class="baohiemdansu_val">' . number_format($metaPost['_civil_liability_insurance_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí đường bộ 1 năm:</td>
                                <td>
                                    <span class="phiduongbo_val">' . number_format($metaPost['_road_toll_per_year_' . $term][0]) . '</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí dịch vụ đăng ký :</td>
                                <td>
                                    <span class="phidichvudangky_val">' . number_format($metaPost['_registration_service_fee_' . $term][0]) . '</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>TỔNG CHI PHÍ LĂN BÁNH:</td>
                                <td><span class="tongdutoan_val">'.number_format($totalWithPDC).'</span>
                                <input type="hidden" id="tongdutoan" name="tongdutoan" value="'.$total.'">
                                <input type="hidden" id="tongdutoanPDC" name="tongdutoanPDC" value="'.$totalWithPDC.'">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <fieldset>
                        <legend>Bảng tính đóng tiền xe</legend>
                        <table class="table_dutoanchiphi">
                            <tbody>
                                <tr>
                                    <td>Tổng chi phí lăn bánh xe</td>
                                    <td><span class="tienxe_val">'.number_format($totalWithPDC).'</span></td>
                                </tr>
                                <tr>
                                    <td>Tỷ lệ vay ngân hàng</td>
                                    <td><input type="number" min="0" max="80" value="75" style="width: 100px;" name="vaynganhang" id="vaynganhang" class="vaynganhang">%</td>
                                </tr>
                                <tr>
                                    <td>Số tiền ngân hàng hỗ trợ</td>
                                    <td><span class="vaynganhang_val">'.number_format(($totalWithPDC*75)/100).'</span></td>
                                </tr>
                                <tr>
                                    <td>Số tiền phải thanh toán</td>
                                    <td><span class="tienthanhtoan_val">'.number_format($totalWithPDC-($totalWithPDC*75)/100).'</span></td>
                                </tr>
                                <tr>
                                    <td>Số tiền đã cọc</td>
                                    <td>
                                    	<span class="dacoc_val">'.number_format($metaPost['_deposit_' . $term][0]).'</span>
                                    	<input type="hidden" name="deposit" id="deposit" value="'.$metaPost['_deposit_' . $term][0].'">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số tiền còn lại cần thanh toán</td>
                                    <td><span class="canthanhtoan_val">'.number_format($totalWithPDC-($totalWithPDC*75)/100-$metaPost['_deposit_' . $term][0]).'</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <small style="color: red;">* Mua qua ngân hàng "Bảo hiểm vật chất" là bắt buộc</small>
                    </fieldset>
                </div>';
}

function price_listing_form()
{
	$adminAjaxLink = admin_url('admin-ajax.php');
	$functionScript = '$(\'.enable_baohiemvatchat\').on("click", function() {
            if($(this).is(":checked")) {
                $(\'.tongdutoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val()));
                }else {
                $(\'.tongdutoan_val\').html(numberWithCommas($(\'input#tongdutoan\').val()));
              }
            })

            $(\'#vaynganhang\').on(\'change\',function() {
            	let per = $(this).val();
           		let deposit = $(\'#deposit\').val();
             	$(\'.vaynganhang_val\').html(numberWithCommas(parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)));
             	$(\'.tienthanhtoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val() - parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)));
             	$(\'.canthanhtoan_val\').html(numberWithCommas($(\'input#tongdutoanPDC\').val() - parseInt(($(\'input#tongdutoanPDC\').val()*per)/100)-deposit));
            })';

	$script = '<script type="text/javascript">
        $(document).ready(function(){
            $(\'#price_list_cat\').on("change", function(){
            $(\'#price_list_item\').attr(\'disabled\',\'disabled\')
            $(\'.button_dutoanchiphi\').attr(\'disabled\',\'disabled\')
                $.ajax({
                    type : "post", //Phương thức truyền post hoặc get
                    dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
						url : \'' . $adminAjaxLink . '\', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
                    data : {
                        action: "loadPriceList", //Tên action
                        price_cat_id : $(\'#price_list_cat option:selected\').val()
                    },
                    context: this,
                    beforeSend: function(){
                        //Làm gì đó trước khi gửi dữ liệu vào xử lý
                    },
                    success: function(response) {
                        //Làm gì đó khi dữ liệu đã được xử lý
                        if(response.success) {
                            $(\'#price_list_item\').html(response.data);
                            $(\'#price_list_item\').removeAttr(\'disabled\')
                            $(\'.button_dutoanchiphi\').removeAttr(\'disabled\')
                            '.$functionScript.'
                        }
                        else {
                            alert(\'Đã có lỗi xảy ra\');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( \'The following error occured: \' + textStatus, errorThrown );
                    }
                })
                return false;
            })

            $(\'.button_dutoanchiphi\').on("click", function(){
                $.ajax({
                    type : "post", //Phương thức truyền post hoặc get
                    dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
						url : \'' . $adminAjaxLink . '\', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
                    data : {
                        action: "loadImage", //Tên action
                        price_id : $(\'#price_list_item option:selected\').val(),
                        district : $(\'#dictrict_register option:selected\').val()
                    },
                    context: this,
                    beforeSend: function(){
                        //Làm gì đó trước khi gửi dữ liệu vào xử lý
                    },
                    success: function(response) {
                        //Làm gì đó khi dữ liệu đã được xử lý
                        if(response.success) {
                            $(\'.xe_thumb\').html(response.data);
                            '.$functionScript.'
                        }
                        else {
                            alert(\'Đã có lỗi xảy ra\');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( \'The following error occured: \' + textStatus, errorThrown );
                    }
                })
                $.ajax({
                    type : "post", //Phương thức truyền post hoặc get
                    dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
						url : \'' . $adminAjaxLink . '\', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
                    data : {
                        action: "loadPriceDetail", //Tên action
                        price_id : $(\'#price_list_item option:selected\').val(),
                        district : $(\'#dictrict_register option:selected\').val()
                    },
                    context: this,
                    beforeSend: function(){
                        //Làm gì đó trước khi gửi dữ liệu vào xử lý
                    },
                    success: function(response) {
                        //Làm gì đó khi dữ liệu đã được xử lý
                        if(response.success) {
                            $(\'.devvn_muaoto_right\').html(response.data);
                            '.$functionScript.'
                        }
                        else {
                            alert(\'Đã có lỗi xảy ra\');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( \'The following error occured: \' + textStatus, errorThrown );
                    }
                })
                return false;
            })
        })
</script>';
	$right_html = '<div class="devvn_muaoto_right">
                    <table class="table_dutoanchiphi">
                        <tbody>
                            <tr>
                                <td>Giá niêm yết:</td>
                                <td>
                                    <span class="giaxe_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Giảm giá:</td>
                                <td>
                                    <span class="discount_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Giá bán:</td>
                                <td>
                                    <span class="giaban_val">0</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table_dutoanchiphi">
                        <tbody>
                            <tr>
                                <td>Phí trước bạ:</td>
                                <td>
                                    <span class="phitruocba_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí đăng Kiểm :</td>
                                <td>0<input type="hidden" value="340000" class="input_to_calc">
                                </td>
                            </tr>
                            <tr>
                                <td>Phí biển số:</td>
                                <td>
                                    <span class="phibienso_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" value="1" name="enable_baohiemvatchat" class="enable_baohiemvatchat" checked="">
                                        Bảo hiểm Vật Chất:                                    </label>
                                </td>
                                <td>
                                    <span class="baohiemvatchat_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Bảo hiểm dân sự:</td>
                                <td>
                                    <span class="baohiemdansu_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí đường bộ 1 năm:</td>
                                <td>
                                    <span class="phiduongbo_val">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phí dịch vụ đăng ký :</td>
                                <td>
                                    <span class="phidichvudangky_val">0</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>TỔNG CHI PHÍ LĂN BÁNH:</td>

                                <td><span class="tongdutoan_val">0</span><span class="tongdutoan_vnd">VND</span>
                                 <input type="hidden" name="tongdutoan" value="0">
                                <input type="hidden" name="tongdutoanPDC" value="0"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <fieldset>
                        <legend>Bảng tính đóng tiền xe</legend>
                        <table class="table_dutoanchiphi">
                            <tbody>
                                <tr>
                                    <td>Tổng chi phí lăn bánh xe</td>
                                    <td><span class="tienxe_val">0</span></td>
                                </tr>
                                <tr>
                                    <td>Tỷ lệ vay ngân hàng</td>
                                    <td><input type="number" min="0" max="80" value="75" style="width: 100px;" name="vaynganhang" class="vaynganhang">%</td>
                                </tr>
                                <tr>
                                    <td>Số tiền ngân hàng hỗ trợ</td>
                                    <td><span class="vaynganhang_val">0</span></td>
                                </tr>
                                <tr>
                                    <td>Số tiền phải thanh toán</td>
                                    <td><span class="tienthanhtoan_val">0</span></td>
                                </tr>
                                <tr>
                                    <td>Số tiền đã cọc</td>
                                    <td><span class="dacoc_val">0</span></td>
                                </tr>
                                <tr>
                                    <td>Số tiền còn lại cần thanh toán</td>
                                    <td><span class="canthanhtoan_val">0</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <small style="color: red;">* Mua qua ngân hàng "Bảo hiểm vật chất" là bắt buộc</small>
                    </fieldset>
                </div>';
	$left_html = price_listing();
	$htmlOutput = '<div class="container price-list-tiger"><div class="row"><div class="col medium-6 small-12 large-6">' . $left_html . '</div><div class="col medium-6 small-12 large-6">' . $right_html . '</div></div></div>';
	return $htmlOutput . $script;
}

add_shortcode('price_listing_form', 'price_listing_form');


add_action('wp_ajax_loadPriceList', 'loadPriceList');
add_action('wp_ajax_nopriv_loadPriceList', 'loadPriceList');
function loadPriceList()
{

	ob_start(); //bắt đầu bộ nhớ đệm
	$price_id = $_POST['price_cat_id'];
	$post_new = new WP_Query(array(
		'post_type' => 'price_list',
		'tax_query' => array(
			array(
				'taxonomy' => 'price_tag',
				'terms' => $price_id,
				'field' => 'term_id',
			)
		),
	));

	if ($post_new->have_posts()):
		while ($post_new->have_posts()):$post_new->the_post();
			echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
		endwhile;
	endif;


	wp_reset_query();

	$result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result

	wp_send_json_success($result); // trả về giá trị dạng json

	die();//bắt buộc phải có khi kết thúc
}

add_action('wp_ajax_loadPriceDetail', 'loadPriceDetail');
add_action('wp_ajax_nopriv_loadPriceDetail', 'loadPriceDetail');
function loadPriceDetail()
{

	ob_start(); //bắt đầu bộ nhớ đệm
	$price_id = $_POST['price_id'];
	$district = $_POST['district'];
	echo render_price_detail($price_id, $district);
	$result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result

	wp_send_json_success($result); // trả về giá trị dạng json

	die();//bắt buộc phải có khi kết thúc
}

add_action('wp_ajax_loadImage', 'loadImage');
add_action('wp_ajax_nopriv_loadImage', 'loadImage');
function loadImage()
{

	ob_start(); //bắt đầu bộ nhớ đệm
	$price_id = $_POST['price_id'];
	$district = $_POST['district'];
	echo get_the_post_thumbnail($price_id);
	$result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result

	wp_send_json_success($result); // trả về giá trị dạng json

	die();//bắt buộc phải có khi kết thúc
}
