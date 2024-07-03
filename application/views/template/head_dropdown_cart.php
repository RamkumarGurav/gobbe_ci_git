<?
$CI=&get_instance();
?>
<ul>


<?
$currency = (object)array("symbol" => '<i class="fa fa-inr"></i>');

$total = 0;
$sub_total = 0;
$total_saving = 0;
$total_prod = 0;
$display_body='';
if(!empty($header_products_list)){
$c_count=0;
foreach($header_products_list as $col){
			$product_name = $col['name'];
			$product_id = $col['product_id'];
			//$manufacturer_name = $col['manufacturer_name'];
			$short_description = $col['short_description'];
			//Default combination details
			foreach($col['product_combination'] as $row){

		$temp_currency_id = $this->session->userdata('application_sess_currency_id');
		if(empty($temp_currency_id) || $temp_currency_id==1)
		{
			if(!empty($coupon_discount) && !empty($coupon_code) ){
				if($row['discount_var']=='Rs')
				{
					$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['discount']));$discount = trim($discount);
				}
				else
				{
					$discount = round($row['discount']).' '.$row['discount_var'];$discount = trim($discount);
				}
				$discount='';
				$price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['price']));
				//$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
				$final_price = $price;
			}
			else{
				if($row['discount_var']=='Rs')
				{
					$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['discount']));$discount = trim($discount);
				}
				else
				{
					$discount = $row['discount'].' '.$row['discount_var'];$discount = trim($discount);
				}
				$price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['price']));
				$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
			}
		}
		else
		{
			if(!empty($coupon_discount) && !empty($coupon_code) ){
				if($row['discount_var']=='Rs')
				{
					$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_discount']));$discount = trim($discount);
				}
				else
				{
					$discount = $row['other_discount'].' '.$row['other_discount_var'];$discount = trim($discount);
				}
				$discount='';
				$price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_price']));
				//$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
				$final_price = $price;
			}
			else{
				if($row['other_discount_var']=='Rs')
				{
					$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_discount']));$discount = trim($discount);
				}
				else
				{
					$discount = $row['other_discount'].' '.$row['other_discount_var'];$discount = trim($discount);
				}
				$price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_price']));
				$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['other_final_price']));
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

				$total_prod+=$prod_in_cart;
				$total+=$prod_in_cart*$final_price;
				$sub_total+=$prod_in_cart*$final_price;
				$total_saving+=$prod_in_cart*$price;
$c_count++;
$product_link = base_url() . 'products-details/' . $product_id;

        if (!empty($ps_slug_url)) {

            $product_link = '';

            $product_link .= base_url();

            if (!empty($pre_url_product)) {

                $product_link .= $pre_url_product;

            }

            $product_link .= $ps_slug_url;

        }
?>
<?
if (strlen($product_display_name) > 17) {

  $product_display_name =  substr($product_display_name, 0, 17) . '...';
} else {
    $product_display_name =  $product_display_name;
}
?>
<li>
    <div class="shopping-cart-img">
        <a href="<?=$product_link?>"><img  data-src="<?=base_url()."assets/uploads/product/small/".$product_image_name?>"  class="lazy" /></a>
    </div>
    <div class="shopping-cart-title">

        <h4><a href="<?=$product_link?>"><?=$product_display_name?></a></h4>
        <h4><span><?=$prod_in_cart?> × </span><?=$currency->symbol.' '.$final_price?></h4>
    </div>

</li>




 <? }} ?>

</ul>
<div class="shopping-cart-footer">
  <div class="shopping-cart-total">
      <h4>Total <span id="head_cart_total">₹4000.00</span></h4>
  </div>
  <div class="shopping-cart-button">
      <a class='outline' href="<?=base_url().__cart__?>">View cart</a>
      <a href="<?  echo base_url(__payment__); ?>">Checkout</a>
  </div>
</div>



<script>

document.getElementById('head_cart_total').innerHTML = '<?=$currency->symbol?> <?=$total?>';
</script>

<? }else{ ?>

<center>your cart is empty</center>

<? } ?>
