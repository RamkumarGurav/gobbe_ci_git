
<? $CI=&get_instance(); ?>

<?
$total = 0;
$sub_total = 0;
$total_saving = 0;
$total_prod = 0;
$display_body='';
$currency = (object)array("symbol" => '<i class="fa fa-inr"></i>');
$SimagePath = _uploaded_files_ . 'product/small/';
if(!empty($products_list)){
?>
<div class="mb-50">
		<h1 class="heading-2 mb-10">Your Wishlist</h1>
		<h6 class="text-body">There are <span class="text-brand"><?echo (isset($products_list)) ? count($products_list): '0' ?></span> products in this list</h6>
</div>
<div class="table-responsive shopping-summery ">
		<table class="table table-wishlist">
				<thead>
						<tr class="main-heading">

								<th scope="col" colspan="2">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Stock Status</th>
								<th scope="col">Action</th>
								<th scope="col" class="end">Remove</th>
						</tr>
				</thead>
				<tbody class="">

<? //echo "<pre>"; print_r($products_list); echo "</pre>";
foreach($products_list as $col){
			$product_name = $col['name'];
			$product_id = $col['product_id'];
			if(empty($col['brand_name'])){$col['brand_name'] = '';}
			$brand_name = $col['brand_name'];
			$short_description = $col['short_description'];
			//Default combination details
			foreach($col['product_combination'] as $row){
			if($row['discount_var']=='Rs')
{
	$discount = $currency->symbol.' '.$CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['discount']));$discount = trim($discount);
}
else
{
	$discount = round($row['discount']).' '.$row['discount_var'];$discount = trim($discount);
}
				//$discount = $row['discount'].' '.$row['discount_var'];$discount = trim($discount);
				$price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['price']));
				$final_price = $CI->getCurrencyPrice(array('obj'=>$this->data , 'amount'=>$row['final_price']));
				$product_image_name = $row['product_image_name'];
				$combi = $row['combi'];
				$ps_slug_url = $row['ps_slug_url'];
				$product_in_store_id = $row['product_in_store_id'];
				$product_combination_id = $row['product_combination_id'];
				$prod_in_cart = $row['prod_in_cart'];
				$prod_in_wishList = $row['prod_in_wishList'];
				$in_store_quantity = $row['quantity'];
				$stock_out_msg = $row['stock_out_msg'];
				$quantity_per_order = $row['quantity_per_order'];
				$offset='';
				$total_prod+=$prod_in_cart;
				$total+=$prod_in_cart*$final_price;
				$sub_total+=$prod_in_cart*$final_price;
				$total_saving+=$prod_in_cart*$price;

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


<tr class="pt-30">

		<td class="image product-thumbnail pt-40"><img src="<?=$SimagePath.$product_image_name?>"alt="<?=$product_name?>" /></td>
		<td class="product-des product-name">
				<h6><a class='product-name mb-10' href="<?=$product_link?>"><?=$product_name?></a></h6>
				<div class="product-rate-cover">
						<div class="product-rate d-inline-block">
								<div class="product-rating" style="width: 90%"></div>
						</div>
						<span class="font-small ml-5 text-muted"> (4.0)</span>
				</div>
		</td>
		<td class="price" data-title="Price">
				<h3 class="text-brand"><?=$currency->symbol.' '.$final_price?></h3>
		</td>
		<td class="text-center detail-info" data-title="Stock">
				<span class="stock-status in-stock mb-0"> In Stock </span>
		</td>
		<td class="text-right" data-title="Cart">
				<button class="btn btn-sm  addToWishlistListBTN move-to-cart-btn" data-val='<?=$product_in_store_id?>,<?=$product_id?>,<?=$product_combination_id?>,4'>Add to cart</button>
		</td>
		<td class="action text-center" data-title="Remove">
				<a  data-val="<?=$product_in_store_id?>,<?=$product_id?>,<?=$product_combination_id?>,2" class="text-body delete addToWishlistListBTN"><i class="fa fa-trash"></i></a>
		</td>
</tr>





<? }}?>
</tbody>
</table>
</div>
<? }else{ ?>
<?php /*?><article class="cart_tabs_1 clearfix col-lg-12 cart-indi">
	<img src="<?=__scriptFilePath__?>images/icons/heart.png" class="empty_notif_2">

    <span class="empty_notif_1">your wishlist is empty</span>
    <a href="<?=base_url()?>all-products" class="empty_notif_3"><button class="proceed_ckt"><i class="fa fa-shopping-cart"></i> <span> Continue Shopping</span></button></a>
</article><?php */?>

<article class="cart_tabs_1 clearfix col-md-12 cart-indi wishlistPageEmpty">


    <!--<span class="empty_notif_1">your wishlist is empty</span>-->
		<a class="btn " href="<?=base_url()?>all-products" style="background: #fdc040 !important"><i class="fa fa-arrow-right mr-10"></i>Continue Shopping</a>

</article>

<? } ?>
