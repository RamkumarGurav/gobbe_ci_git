<? $CI=&get_instance(); ?>
<?
$total = 0;
$total_mrp_price = 0;
$sub_total = 0;
$total_saving = 0;
$total_prod = 0;
$total_gst = 0;
$display_body='';
$total_packing_charges=0;
$total_dicount_price=0;
$delivery_charges = 0;
$discounted_price=0;
$currency = (object)array("symbol" => '<i class="fa fa-inr"></i>');
$SimagePath = _uploaded_files_ . 'product/small/';
//echo "<pre>"; print_r($products_list); echo "</pre>";
if(!empty($products_list)){
$c_count=0;
foreach($products_list as $col){
			$product_name = $col['name'];
			$product_id = $col['product_id'];
			$tax_percentage = $col['tax_percentage'];
			if(empty($col['brand_name'])){$col['brand_name'] = '';}
			$brand_name = $col['brand_name'];
			$short_description = $col['short_description'];
			//Default combination details
			foreach($col['product_combination'] as $row){

		$temp_currency_id = $this->session->userdata('application_sess_currency_id'); //echo "temp_currency_id : $temp_currency_id </br>";
		if(empty($temp_currency_id) || $temp_currency_id==1)
		{
			if(!empty($cart_coupon_code) && !empty($cart_coupon_discount) && _is_coupon_applicable_on_mrp ==1 ){
				if($row['discount_var']=='Rs')
				{
					//$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['discount']));$discount = trim($discount);
					$discount = $currency->symbol.' '.$row['discount'];$discount = trim($discount);
				}
				else
				{
					$discount = round($row['discount']).' '.$row['discount_var'];$discount = trim($discount);
				}
				$discount='';
				$price = $row['price'];

				//$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
				$final_price = $price;
			}
			else{
				if($row['discount_var']=='Rs')
				{
					//$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['discount']));$discount = trim($discount);
					$discount = $currency->symbol.' '.$row['discount'];$discount = trim($discount);
				}
				else
				{
					$discount = round($row['discount']).' '.$row['discount_var'];$discount = trim($discount);
				}
				$price = $row['price'];
				$final_price = $row['final_price'];

				$discounted_price = $price - $final_price;
			}
		}
		else
		{
			if(!empty($coupon_discount) && !empty($coupon_code) ){
				if($row['discount_var']=='Rs')
				{
					//$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_discount']));$discount = trim($discount);
					$discount = $currency->symbol.' '.$row['other_discount'];$discount = trim($discount);
				}
				else
				{
					$discount = $row['other_discount'].' '.$row['other_discount_var'];$discount = trim($discount);
				}
				$discount='';
				$price = $row['other_price'];

				//$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
				$final_price = $price;
				$discounted_price = $price - $final_price;
			}
			else{
				if($row['other_discount_var']=='Rs')
				{
					//$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_discount']));$discount = trim($discount);
					$discount = $currency->symbol.' '.$row['other_discount'];$discount = trim($discount);
				}
				else
				{
					$discount = $row['other_discount'].' '.$row['other_discount_var'];$discount = trim($discount);
				}
				$price = $row['other_price'];
				$final_price = $row['other_final_price'];

				$discounted_price = $price - $final_price;
			}
		}
				//$discount = $row['discount'].' '.$row['discount_var'];$discount = trim($discount);

				$product_image_name = $row['product_image_name'];
				$product_display_name = $row['product_display_name'];
				$combi = $row['combi'];
				$product_in_store_id = $row['product_in_store_id'];
				$product_combination_id = $row['product_combination_id'];
				$prod_in_cart = $row['prod_in_cart'];
				$cart_comment = $row['cart_comment'];
				$prod_in_wishList = $row['prod_in_wishList'];
				$in_store_quantity = $row['quantity'];
				$stock_out_msg = $row['stock_out_msg'];
				$quantity_per_order = $row['quantity_per_order'];
				$packing_charges = $row['delivery_charges'];

				$total_packing_charges += $prod_in_cart*$packing_charges;
				$total_dicount_price += $prod_in_cart*$discounted_price;

				$total_prod+=$prod_in_cart;
				$total+=$prod_in_cart*$final_price;
				$total_mrp_price+=$prod_in_cart*$price;
				$sub_total+=$prod_in_cart*$final_price;
				$total_saving+=$prod_in_cart*$price;
$c_count++;
$product_link = base_url() . 'products-details/' . $product_id;
//calculate tax
if($tax_percentage<10)
{
	$tax_percentage = ($tax_percentage/100);
	$tax_percentage = 1 + $tax_percentage;
}
else
{
	$tax_percentage = ($tax_percentage/100);
	$tax_percentage = 1 + $tax_percentage;
}
//echo $tax_percentage.' - '.$tax_percentage.'<br>';
//$total_gst += ($prod_in_cart*$final_price)*($tax_percentage/100);
$total_gst += (($prod_in_cart*$final_price) - ($prod_in_cart*$final_price)/$tax_percentage);


        if (!empty($ps_slug_url)) {

            $product_link = '';

            $product_link .= base_url();

            if (!empty($pre_url_product)) {

                $product_link .= $pre_url_product;

            }

            $product_link .= $ps_slug_url;

        }
?>

<? if($c_count==1){ ?>

								<div class="table-responsive order_table checkout">
										<table class="table no-border">
												<tbody>



<? } ?>
<?
if (strlen($product_display_name) > 50) {

	$product_display_name =  substr($product_display_name, 0, 50) . '...';
} else {
		$product_display_name =  $product_display_name;
}
?>
<tr>
		<td class="image product-thumbnail"><img src="<?=$SimagePath.$product_image_name?>" alt="<?=$product_name?>" title="<?=$product_name?>"></td>
		<td>
				<h6 class="w-160 mb-5"><a class='text-heading'  href="<?=$product_link?>" ><?=$product_display_name?></a></h6></span>
				<div class="product-rate-cover">
						<div class="product-rate d-inline-block">
								<div class="product-rating" style="width:90%">
								</div>
						</div>
						<span class="font-small ml-5 text-muted"> (4.0)</span>
				</div>
		</td>
		<td>
				<h6 class="text-muted pl-20 pr-20">x <?=$prod_in_cart?></h6>
		</td>
		<td>
				<h4 class="text-brand"><?=$currency->symbol.' '.$final_price;?></h4>
		</td>
</tr>


<?
}
}
 ?>
 <?
 $final_cart_amount = $total+$total_packing_charges;
					 if($final_cart_amount <= __free_shipping_above__) { $delivery_charges = 90; } else { $delivery_charges = 0;}
 	?>
	<!-- <tr >
			<td colspan="3" class="cart_total_label">
					<h6 class="text-muted"> Net Amount</h6>
			</td>
			<td class="cart_total_amount">
				<?
				$total_gst = 	round($total_gst , 2);
				?>
					<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_mrp_price-$total_gst?> </h4>
			</td>
	</tr>
	<tr>
			<td colspan="3" class="cart_total_label">
					<h6 class="text-muted"> Tax</h6>
			</td>
			<td class="cart_total_amount">
					<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_gst?> </h4>
			</td>
	</tr> -->
 <tr>
		 <td colspan="3"  class="cart_total_label">
				 <h6 class="text-muted">Sub Total</h6>
		 </td>
		 <td class="cart_total_amount">
				 <h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_mrp_price?> </h4>
		 </td>
 </tr>
 <tr>
		 <td colspan="3" class="cart_total_label">
				 <h6 class="text-muted">Discount</h6>
		 </td>
		 <td class="cart_total_amount">
				 <h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=$total_dicount_price?> </h4>
		 </td>
 </tr>
 <tr>
		 <td colspan="3" class="cart_total_label">
				 <h6 class="text-muted">Packing Charges</h6>
		 </td>
		 <td class="cart_total_amount">
				 <h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=$total_packing_charges?> </h4>
		 </td>
 </tr>
 <tr>
		 <td colspan="3" class="cart_total_label">
				 <h6 class="text-muted">Shipping Charges</h6>
		 </td>
		 <td class="cart_total_amount">
				 <h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=number_format($delivery_charges )?> </h4>
		 </td>
 </tr>

 <tr>
		 <td colspan="3" class="cart_total_label">
				 <h6 class="text-muted">Total</h6>
		 </td>
		 <td class="cart_total_amount">
				 <h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total+$total_packing_charges+$delivery_charges?></h4>
		 </td>
 </tr>
</tbody>
</table>
</div>

<?
}
