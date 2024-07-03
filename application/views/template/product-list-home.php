<?
$_prow_count = 4;
$_prow_countm = 6;
if(empty($callFor)){$callFor='';}
if($callFor == 'slider') {$_prow_count = 12;$_prow_countm=12;}
if($callFor == 'nonslider') {$_prow_count = 4;}
$display_product_count = 0;
$page_count = 0;
// echo "<pre>";
// print_r($products_list);
// echo "</pre>";
// die;
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
			$query_get_list = $this->db->query("SELECT c.name , c.slug_url , c.super_category_id , c.id as category_id FROM `product_category` as pc join category as c ON c.id = pc.category_id and c.super_category_id = ".$qd->category_id."  and pc.id = ".$product_id . " and status =1 order by c.id ASC limit 1  ");
			$query_data1 = $query_get_list->result();
			if($query_data1)
			{
				$qd1 = $query_data1[0];
				$gtm_product_list_category.= ' -> '.$qd1->name;
				$query_get_list = $this->db->query("SELECT c.name , c.super_category_id , c.slug_url , c.id as category_id FROM `product_category` as pc join category as c ON c.id = pc.category_id and c.super_category_id = ".$qd1->category_id." and pc.id = ".$product_id . " and status =1 order by c.id ASC limit 1  ");
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
        $hot_selling_now = $col['hot_selling_now'];
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


            <article class="row align-items-center hover-up">
                <figure class="col-md-4 mb-0">
                    <a href="<?= $product_link ?>"><img class="lazy_product" data-src="<?=_uploaded_files_?>product/medium/<? echo $product_image_name; ?>"  data-page_count="<? echo $page_count; ?>" alt="<? echo $product_name; ?>" title="<? echo $product_name; ?>" data-full-size-image-url="<?=_uploaded_files_?>product/medium/<? echo $product_image_name; ?>" data-callfor='<?=$callFor?>' /></a>
                </figure>
                <div class="col-md-8 mb-0">
									<?
									if (strlen($product_name) > 17) {

									  $product_name =  substr($product_name, 0, 17) . '...';
									} else {
									    $product_name =  $product_name;
									}
									?>
                    <h6>
                        <a href="<?= $product_link ?>"><? echo $product_name; ?></a>
                    </h6>
                    <div class="product-rate-cover ml-5 mt-1 row align-items-center">
                                                         <div class="product-rate d-inline-block col-md-6">
                                                                 <!-- <div class="product-rating" ></div> -->
																																 <div class="rating-block">

								 																									<div class="starrr_myBtn">
								 																										<div class="star-rating rating-sm">
								 																											<div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i>
								 																											</div>
								 																											<div class="rating-container rating-gly-star">
								 																												<input id="customer_rating" name="customer_rating"  value="<? echo number_format($avgrating, 1);?>" type="text" class="rating form-control rating-loading" data-min="0" data-max="5" data-step="1" data-size="sm" required="" title="" style="display: none;">
								 																											</div>
								 																										</div>
								 																									</div>
								 																								</div>
                                                         </div>
                                                         <span class="font-small  col-md-6 text-muted"> (<? echo empty($avgrating)?'0':$avgrating?>)</span>
                                                 </div>
                    <div class="product-price">
                        <span><?=$currency->symbol?> <? echo number_format($final_price) ?> </span>
                        <? if (!empty($discount) && $discount>0) { ?> <span class="old-price"><?=$currency->symbol?>  <? echo number_format($price) ?></span>
                           <?php } ?>
                    </div>
                </div>
            </article>






<? } ?>


 <? }else{ ?>

    <div class="row " style="clear: both;padding: 20px;font-weight: 600;font-size: 18px;text-shadow: 1px 4px 6px #b1b1b1;"><?php /*?>No product found. Please refine search criteria<?php */?>
    <div class="no_prd_found"><span>Sorry!</span> No Product Found</div>
    <img src="<?='assets/front/images/no-product.jpg'?>" class="responsiveImg">
    </div>


<? } ?>
