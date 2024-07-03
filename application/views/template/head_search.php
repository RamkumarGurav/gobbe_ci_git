<center>
  <div class="row">
<?
$_prow_count = 4;
$_prow_countm = 6;
if(empty($callFor)){$callFor='';}
if($callFor == 'slider') {$_prow_count = 12;$_prow_countm=12;}
//if($callFor == 'slider') {$_prow_count = 3;}
if($callFor == 'nonslider') {$_prow_count = 4;}
$display_product_count = 0;
$page_count = 0;
if(!empty($products_list))
{
  foreach ($products_list as $col)
  {
    $display_product_count++;
    $page_count++;
        $product_name = $col['name'];
        $ps_slug_url = $col['ps_slug_url'];
        $product_id = $col['product_id'];
        $short_description = $col['short_description'];
        $manufacturer_name = _brand_name_;
        $totalrating = $col['totalrating'];
        $totalreview = $col['totalreview'];
    $avgrating = $col['avgrating'];
    $pc_ref_code = $col['pc_ref_code'];
    $product_id = $col['product_id'];
    $gtm_product_list_category='';
    $query_get_list = $this->db->query("SELECT c.name , c.slug_url , c.id as category_id , c.super_category_id FROM `product_category` as pc join category as c ON c.id = pc.category_id and super_category_id = 0 and pc.product_id = ".$product_id . " and status =1 order by c.id ASC limit 1 ");
    $query_data = $query_get_list->result();
    if(!empty($query_data))
    {
      $qd = $query_data[0];
      $gtm_product_list_category.= $qd->name;
      $query_get_list = $this->db->query("SELECT c.name , c.slug_url , c.super_category_id , c.id as category_id FROM `product_category` as pc join category as c ON c.id = pc.category_id and c.super_category_id = ".$qd->category_id."  and pc.product_id = ".$product_id . " and status =1 order by c.id ASC limit 1  ");
      $query_data1 = $query_get_list->result();
      if($query_data1)
      {
        $qd1 = $query_data1[0];
        $gtm_product_list_category.= ' -> '.$qd1->name;
        $query_get_list = $this->db->query("SELECT c.name , c.super_category_id , c.slug_url , c.id as category_id FROM `product_category` as pc join category as c ON c.id = pc.category_id and c.super_category_id = ".$qd1->category_id." and pc.product_id = ".$product_id . " and status =1 order by c.id ASC limit 1  ");
        $query_data2 = $query_get_list->result();
        if($query_data2)
        {
          $qd2 = $query_data2[0];
          $gtm_product_list_category.= ' -> '.$qd2->name;
        }
      }
    }
    $gtm_combi = str_replace('&nbsp;' , ' ' , $col['combi']);
        if ($col['discount_var'] == 'Rs')
    {
            $discount = $currency->symbol . ' ' . $col['discount'];
            $discount = trim($discount);
        }
    else
    {
            $discount = round($col['discount']) . ' ' . $col['discount_var'];
            $discount = trim($discount);
        }
        $price = $col['price'];
        $final_price = $col['final_price'];
    $discounted_price = $price - $final_price;
        $product_image_name = $col['product_image_name'];
        $combi = $col['combi'];
        $product_display_name = $col['product_display_name'];
        if(!empty($product_display_name))
    {
            $product_name = $product_display_name;
        }
    else
    {
            $product_name = $product_name;// . '<br>' . $combi;
        }
        unset($attribute);
        $attribute = $col['attribute'];
        $product_in_store_id = $col['product_in_store_id'];
        $product_combination_id = $col['product_combination_id'];
        $prod_in_cart = $col['prod_in_cart'];
        $prod_in_wishList = $col['prod_in_wishList'];
        $in_store_quantity = $col['quantity'];
        $stock_out_msg = $col['stock_out_msg'];
        //echo $combi;
        //echo "<pre>";print_r($attribute);echo "</pre>";
        //echo $pre_url_product;
        //echo '<br>'.$ps_slug_url;
        $product_link =  'products-details/' . $product_id.'/'.$product_combination_id;
        if (!empty($ps_slug_url))
    {
      $product_link = '';
  //        $product_link .= base_url();
            if (!empty($pre_url_product))
      {
                $product_link .= $pre_url_product;
            }
            $product_link .= $ps_slug_url;
        }
        ?>

        <div class="col-lg-<?=$_prow_count?> col-md-<?=$_prow_count?> col-12 col-sm-<?=$_prow_count?>">




     								 <div class="product-cart-wrap mb-30">
     										 <div class="product-img-action-wrap">
     												 <div class="product-img product-img-zoom">
     														 <a href="<?= $product_link ?>">
     																 <img class="default-img lazy_product" data-src="<?=_uploaded_files_?>product/medium/<? echo $product_image_name; ?>" data-page_count="<? echo $page_count; ?>" alt="<? echo $product_name; ?>" title="<? echo $product_name; ?>" data-full-size-image-url="<?=_uploaded_files_?>product/medium/<? echo $product_image_name; ?>" data-callfor='<?=$callFor?>' />

     														 </a>
     												 </div>
     												 <div class="product-action-1">
     													 <a  aria-label='Add To Wishlist' class="action-btn hover-up crt_button3 wishlist-i cart_wishlist_<? echo $product_in_store_id; ?> cart_wishlist_n_<? echo $product_in_store_id; ?> addToWishlistListBTN<? echo $offset ?>" data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,1" title="Add to Wishlist - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>" style=" <? if ($prod_in_wishList <= 0) { echo " display:inline-block";} else {echo "display:none";} ?>"><i class="fa fa-heart-o"></i></a>
     													 <a  aria-label='Remove From Wishlist'  class="action-btn hover-up crt_button3 wishlist-i cart_wishlist_<? echo $product_in_store_id; ?> cart_wishlist_y_<? echo $product_in_store_id; ?> addToWishlistListBTN<? echo $offset ?>" data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,2" title="Remove from Wishlist - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>" style=" <? if ($prod_in_wishList >= 1) {echo " display:inline-block";} else {echo "display:none";} ?> " ><i class="fa fa-heart"></i></a>
     														 <!-- <a  class='action-btn' href='#'><i class="fa fa-heart"></i></a> -->
     														 <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
     												 </div>
     												 

     										 </div>
     										 <div class="product-content-wrap">
     												 <div class="product-category">
     														 <a ><?= $gtm_product_list_category ?></a>
     												 </div>
     												 <h2><a href="<?= $product_link ?>" title="<? echo $product_name; ?> "><?= $product_name ?></a></h2>
     												 <?
     												 $att_values = '';
     												 foreach ($attribute as $att) {
     													 foreach ($att->attributeVal as $attributeVal ) {
     														 $att_values .= $att->name .':'. $attributeVal->name.',';
     													 }

     												 }
     												 if(!empty($att_values)){
     													 $att_values = rtrim($att_values,',');
     												 }
     												 ?>
     												 <div class="product-rate-cover">

     														 <span class="font-small ml-5 text-success"> (<?=$att_values?>)</span>
     												 </div>
     												 <div class="product-rate-cover">
     														 <div class="product-rate d-inline-block">
     																 <div class="product-rating" style="width: 90%"></div>
     														 </div>
     														 <span class="font-small ml-5 text-muted"> (4.0)</span>
     												 </div>

     												 <div class="product-card-bottom">
     														 <div class="product-price">
     																 <span><?=$currency->symbol?> <? echo number_format($final_price) ?></span>
     																 <? if (!empty($discount) && $discount>0) { ?> <span class="old-price"><?=$currency->symbol?>  <? echo number_format($price) ?></span>
                                         <?php } ?>


     														 </div>

     														 <?php if ($in_store_quantity > 0) { ?>

     																<div class="add-cart productAddShow_<? echo $product_in_store_id; ?>" <? if (!empty($prod_in_cart) || $prod_in_cart > 0) { ?> style="display:none;" <? } ?>>
     																		<a class='add adtocart ad_crt2_btn addToCartListBTN' data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,2" title="Add To Cart - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>"><i class="fa fa-shopping-cart mr-5"></i>Add </a>
     																</div>
     																<div class="add-cart go_to_cart qty_increDecre_<? echo $product_in_store_id; ?>" style="display:<? if (!empty($prod_in_cart) || $prod_in_cart > 0) {echo " block";} else {echo "none";} ?>">
     																		<a href="<?=base_url('viewcart')?>"class="add" onclick="cartopenNav()"><i class="fa fa-shopping-cart mr-5"></i>Go  </a>
     																</div>
     																<?php } else{ ?>
     																<div class="add-cart ">
     																		<a class="add">Out of Stock</a>
     																</div>
     																<? } ?>

     												 </div>
     										 </div>
     								 </div>


             </div>


<? } ?>





 <? }else{ ?>

    <div class="row " style="clear: both;padding: 20px;font-weight: 600;font-size: 18px;text-shadow: 1px 4px 6px #b1b1b1;"><?php /*?>No product found. Please refine search criteria<?php */?>
    <div class="no_prd_found"><span>Sorry!</span> No Product Found</div>
    <img src="<?='assets/front/images/no-product.jpg'?>" class="responsiveImg">
    </div>


<? } ?>
</div>
</center>
