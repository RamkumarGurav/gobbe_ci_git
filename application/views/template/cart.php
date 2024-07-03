<? $CI=&get_instance(); ?>
<?
$total = 0;
$total_mrp_price = 0;
$sub_total = 0;
$total_gst = 0;
$total_saving = 0;
$total_prod = 0;
$delivery_charges = 0;
$display_body='';
$total_packing_charges=0;
$total_dicount_price=0;
$discounted_price=0;
$currency = (object)array("symbol" => '<i class="fa fa-inr"></i>');
$SimagePath = _uploaded_files_ . 'product/small/';
//echo "<pre>"; print_r($products_list); echo "</pre>";
if(!empty($products_list)){
$c_count=0;
foreach($products_list as $col){
			$product_name = $col['name'];
			$product_id = $col['product_id'];
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
				$tax_percentage = $col['tax_percentage'];
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
	<div class="col-lg-8">
			<div class="table-responsive shopping-summery">
					<table class="table table-wishlist">
							<thead>
									<tr class="main-heading">

											<th scope="col" colspan="2">Product</th>
											<th scope="col">Unit Price</th>
											<th scope="col">Quantity</th>
											<th scope="col">Subtotal</th>
											<th scope="col" class="end">Remove</th>
									</tr>
							</thead>
							<tbody>
<? } ?>
<tr class="pt-30">

		<td class="image product-thumbnail pt-40"><img src="<?=$SimagePath.$product_image_name?>" alt="<?=$product_name?>" title="<?=$product_name?>"></td>
		<td class="product-des product-name">
				<h6 class="mb-5"><a class='product-name mb-10 text-heading' href="<?=$product_link?>" ><?=$product_display_name?></a></h6>
				<div class="product-rate-cover">
						<div class="product-rate d-inline-block">
								<div class="product-rating" style="width:90%">
								</div>
						</div>
						<span class="font-small ml-5 text-muted"> (4.0)</span>
				</div>
		</td>
		<td class="price" data-title="Price">
				<h4 class="text-body"><?=$currency->symbol.' '.$final_price?> </h4>
		</td>
		<td class="text-center detail-info" data-title="Stock">
				<div class="detail-extralink mr-15">
						<div class="detail-qty border radius">
							  <? if($in_store_quantity>0){ ?>
									<a  class="qty-down incToCartListBTNCART" data-val='<?=$product_in_store_id?>,<?=$product_id?>,<?=$product_combination_id?>,1,cart'><i class="fa fa-angle-down"></i></a>
									<input type="text" name="quantity" class="qty-val cart_increment_<?=$product_in_store_id?>" value="<?=$prod_in_cart?>" min="1">
									<a  class="qty-up incToCartListBTNCART right" data-val='<?=$product_in_store_id?>,<?=$product_id?>,<?=$product_combination_id?>,2,cart'><i class="fa fa-angle-up"></i></a>
								<? }else{ ?>
												<div style="max-width: max-content !important">	<?=$stock_out_msg?></div>
											<? } ?>

						</div>
				</div>
		</td>
		<td class="price" data-title="Price">
				<h4 class="text-brand"><?=$currency->symbol.' '.$final_price?></h4>
		</td>
		<td class="action text-center delete incToCartListBTNCART" data-title="Remove" data-val='<?=$product_in_store_id?>,<?=$product_id?>, <?=$product_combination_id?>,3,cart'><a  class="text-body"><i class="fa fa-trash"></i></a></td>
</tr>

<?
}
}
 ?>

</tbody>
</table>
</div>
<div class="divider-2 mb-30"></div>
<div class="cart-action d-flex justify-content-between">
<a class="btn " href="<?=base_url()?>all-products" style="background: #fdc040 !important"><i class="fa fa-arrow-left mr-10"></i>Continue Shopping</a>
<a class="btn  mr-10 mb-sm-15"><i class="fa fa-refresh mr-10"></i>Update Cart</a>
</div>
<div class="row mt-50">
<div class="col-lg-7">
<div class="calculate-shiping p-40 border-radius-15 border">
		<h4 class="mb-10">Calculate Shipping</h4>
		<form class="field_form shipping_calculator">

				<div class="form-row row">

						<div class="d-flex justify-content-between">
								<input required="required" placeholder="PostCode / ZIP" name="name" id="pincode_d" type="text">
									<button class="btn" type="button" onclick="getPincodeDetail()">Check</button>
						</div>
						<p id="PincodeData"></p>
				</div>
		</form>
</div>
</div>
<div class="col-lg-5">
<div class="p-40">
		<h4 class="mb-10">Apply Coupon</h4>
		<p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
		<form action="<?=base_url().__cart__?>" method="post"  >
				<div class="d-flex justify-content-between">
						<input class="font-medium mr-15 coupon" id="coupon" required name="coupon"placeholder="Enter Your Coupon">
						<button class="btn" type="submit" name="CouponBTN" value="1">Apply</button>
				</div>
		</form>
</div>
</div>
</div>
</div>
<?
$final_cart_amount = $total+$total_packing_charges;
					if($final_cart_amount <= __free_shipping_above__) { $delivery_charges = 90; } else { $delivery_charges = 0;}
?>
<div class="col-lg-4">
<div class=" calculation-p p-md-4 cart-totals ml-30">
<div class="table-responsive">
<table class="table no-border">
		<tbody>
			<?
			$total_gst = 	round($total_gst , 2);
			?>
			<tr>
					<td class="cart_total_label">
							<h6 class="text-muted"> Net Amount</h6>
					</td>
					<td class="cart_total_amount">
							<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_mrp_price-$total_gst?> </h4>
					</td>
			</tr>
			<tr>
					<td class="cart_total_label">
							<h6 class="text-muted"> Tax</h6>
					</td>
					<td class="cart_total_amount">
							<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_gst?> </h4>
					</td>
			</tr>
				<tr>
						<td class="cart_total_label">
								<h6 class="text-muted">Sub Total</h6>
						</td>
						<td class="cart_total_amount">
								<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total_mrp_price?> </h4>
						</td>
				</tr>

				<tr>
						<td class="cart_total_label">
								<h6 class="text-muted">Discount</h6>
						</td>
						<td class="cart_total_amount">
								<h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=$total_dicount_price?> </h4>
						</td>
				</tr>

				<tr>
						<td class="cart_total_label">
								<h6 class="text-muted">Packing Charges</h6>
						</td>
						<td class="cart_total_amount">
								<h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=$total_packing_charges?> </h4>
						</td>
				</tr>
				<tr>
						<td class="cart_total_label">
								<h6 class="text-muted">Shipping Charges</h6>
						</td>
						<td class="cart_total_amount">
								<h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <?=number_format($delivery_charges )?> </h4>
						</td>
				</tr>
				<?
if(!empty($coupon_discount) && !empty($coupon_code) ){
?>
<tr>
		<td class="cart_total_label">
				<h6 class="text-muted">Discount (<?=$coupon_code?> at <?=$coupon_discount?>%)</h6>
		</td>
		<td class="cart_total_amount">
				<h4 class="text-brand text-end text-danger"><?=$currency->symbol?> <? echo (($coupon_discount/100)*($total)); $total -=(($coupon_discount/100)*($total))  ?> </h4>
				<a href="<?=base_url().__removeCoupon__?>" class="close lnr lnr-cross" title="Remove Discount" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
		</td>
</tr>


<? } ?>
				<tr>
						<td class="cart_total_label">
								<h6 class="text-muted">Total</h6>
						</td>
						<td class="cart_total_amount">
								<h4 class="text-brand text-end"><?=$currency->symbol?> <?=$total+$total_packing_charges+$delivery_charges?></h4>
						</td>
				</tr>
		</tbody>
</table>
</div>
<a href="<? echo base_url(__payment__);?>" class="btn mb-20 w-100">Proceed To CheckOut<i class="fa fa-sign-out ml-15"></i></a>
</div>
</div>
<?
}else{ ?>
<article class="cart_tabs_1 clearfix col-lg-12 cart-indi">
 <!-- <img src="<?=__scriptFilePath__?>images/emptycart.png" class="empty_notif_2"> -->

	<!--  <span class="empty_notif_1">your cart is empty</span> -->
	<a class="btn " href="<?=base_url()?>all-products" style="background: #fdc040 !important"><i class="fa fa-arrow-right mr-10"></i>Continue Shopping</a>

	 <!-- <a href="<?=base_url()?>all-products" class="empty_notif_3" title="Continue Shopping"><button class="proceed_ckt"><i class="fa fa-shopping-cart"></i> <span> Continue Shopping</button></a> -->
</article>
<? } ?>
