<?
$offset = '';
$CI = &get_instance();
foreach ($products_list as $col) {
   	// echo "<pre>"; print_r($col); echo "</pre>";die;
   $is_bulk_enquiry = $col['is_bulk_enquiry'];
   $product_main_name = $product_name = $col['name'];
   $product_id = $col['product_id'];
   $short_description = $col['short_description'];
   $brand_name = $col['brand_name'];
   $ref_code = $col['ref_code'];
   $description = $col['description'];
   //$hot_selling_now = $col['hot_selling_now'];

   $totalrating = $col['totalrating']; //echo $totalrating;
   $totalreview = $col['totalreview']; //echo $totalreview;
   $avgrating = $col['avgrating'];
   $onerating = $col['onerating'];
   $tworating = $col['tworating'];
   $threerating = $col['threerating'];
   $fourrating = $col['fourrating'];
   $fiverating = $col['fiverating'];
   $product_use_info = $col['product_use_info'];

   if (empty($selected_combination_id)) {
      foreach ($col['product_combination'] as $cpc) {
         $selected_combination_id = $default_product_combination_id = $product_combination_id = $cpc['product_combination_id'];
         break;
      }
   }
   $selected_product_image_id = '';
   //echo "<pre>"; print_r($col['product_combination']); echo "</pre>";
   foreach ($col['product_combination'] as $cpc) {
      if ($cpc['product_combination_id'] == $selected_combination_id) {
         //Default combination details
         $selected_product_image_id = $cpc['product_image_id'];
         $temp_currency_id = $this->session->userdata('application_sess_currency_id');
         //echo "temp_currency_id : $temp_currency_id </br>";
         if (empty($temp_currency_id) || $temp_currency_id == 1) {
            if ($cpc['discount_var'] == 'Rs') {
               $discount = $currency->symbol . ' ' . $cpc['discount'];
               $discount = trim($discount);
            } else {
               $discount = round($cpc['discount']) . '' . $cpc['discount_var'];
               $discount = trim($discount);
            }
            $price = $cpc['price'];
            $final_price = $cpc['final_price'];
            $discounted_price = $price - $final_price;
         } else {
            if ($cpc['other_discount_var'] == 'Rs') {
               $discount = $currency->symbol . ' ' . $cpc['other_discount'];
               $discount = trim($discount);
            } else {
               $discount = $cpc['other_discount'] . ' ' . $cpc['other_discount_var'];
               $discount = trim($discount);
            }
            $price = $cpc['other_price'];
            $final_price = $cpc['other_final_price'];
            $discounted_price = $price - $final_price;
         }

         //	echo "final_price : $final_price </br>";
         $product_image_name = $cpc['product_image_name'];

         $r_product_name = $cpc['product_display_name'];
         $r_combi = $cpc['combi'];
         $combi = $cpc['combi'];

         //echo "<pre>"; print_r($cpc['combi']); echo "</pre>";



         $combi_ref_code = $cpc['ref_code'];
         $combi_product_l = $cpc['product_l'];
         $combi_product_b = $cpc['product_b'];
         $combi_product_h = $cpc['product_h'];

         $product_in_store_id = $cpc['product_in_store_id'];
         $default_product_combination_id = $product_combination_id = $cpc['product_combination_id'];
         $prod_in_cart = $cpc['prod_in_cart'];
         $prod_in_wishList = $cpc['prod_in_wishList'];
         $delivery_charges = $cpc['delivery_charges'];
         $product_display_name = $cpc['product_display_name'];
         $model_number = $cpc['model_number'];
         if (!empty($product_display_name)) {
            //$product_name = $product_display_name;
         } else {
            //$product_name = $product_name . '<br>' . $combi;
            $product_name = $product_name;
         }
         $current_viewers_msg = $cpc['current_viewers_msg'];
         $current_sold_msg = $cpc['current_sold_msg'];
         $is_msg_dynamic = $cpc['is_msg_dynamic'];
         $in_store_quantity = $cpc['quantity'];
         $stock_out_msg = $cpc['stock_out_msg'];
         $product_weight = $cpc['product_weight'];

         break;
      }
   }

}
//print_r($product_image_name = $cpc);
$SimagePath = _uploaded_files_ . 'product/small/';
$MimagePath = _uploaded_files_ . 'product/medium/';
$LimagePath = _uploaded_files_ . 'product/large/';
//$LimagePath = 'assets/uploads/product/large/';
//setTimeout(function(){ $('head').append( '<meta property="og:title" content="short title of your website/webpage" />' ); }, 1500);
//<meta property="og:title" content="short title of your website/webpage" />/
//<meta property="og:url" content="https://www.example.com/webpage/" />
//<meta property="og:description" content="description of your website/webpage">
//<meta property="og:image" content="//cdn.example.com/uploads/images/webpage_300x200.png">
//<meta property="og:type" content="article" />
//<meta property="og:locale" content="en_US" />
$og_title = $product_name;
if (!empty($meta_title)) {
   $og_title = $meta_title;
}

$product_link = base_url() . 'products-details/' . $product_id;
if (!empty($product_seo_list[0]->slug_url)) {
   $product_link = '';
   $product_link .= base_url();
   if (!empty($pre_url_product)) {
      $product_link .= $pre_url_product;
   }
   $product_link .= $product_seo_list[0]->slug_url;
}
$og_url = $product_link;
$og_description = $short_description;
if (!empty($meta_description)) {
   $og_description = $meta_description;
}
$og_product_image_name = '';
//$og_product_image_name = $SimagePath.$cpc['product_image_name'];



if (empty($product_specification)) {
   $product_specification = array();
}
if (!empty($current_category)) {
   $product_specification_temp[] = array('info_title' => "Category", 'info' => $current_category->name);
}
if (!empty($model_number)) {
   //$product_specification_temp[] = array('info_title'=>"Model" , 'info'=>$model_number);
}
//$product_specification = array_merge($product_specification_temp , $product_specification);

$products_image_d = array();
$products_image_o = array();

foreach ($products_image as $pi) {
   if ($selected_product_image_id == $pi['product_image_id']) {
      $products_image_d[] = $pi;
   } else {
      $products_image_o[] = $pi;
   }

}
$products_image = array_merge($products_image_d, $products_image_o);
//echo $selected_combination_id;
//echo "<pre>";print_r($cpc);print_r($products_image);echo "</pre>";
?>

<main class="main">
       <div class="page-header mt-30">
           <div class="container">
               <div class="archive-header1">
                   <div class="row align-items-center">
                       <div class="col-md-12">
                           <!-- <h1 class="mb-15">Dry Fruits & Nuts</h1> -->
                           <div class="breadcrumb">
                               <?=$breadcrumbs?>
                               <span></span>
                               <li>
                                 <?= $product_name ?>
                              </li>
                           </div>
                       </div>

                   </div>
               </div>
           </div>
       </div>
        <div class="container mb-30">
           <div class="row">
               <div class="col-lg-12 col-lg-12 m-auto">
                   <div class="product-detail accordion-detail">
                       <div class="row mb-50 mt-30">
                           <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                               <div class="detail-gallery">
                                   <span class="zoom-icon"><i class="fa fa-search"></i></span>
                                   <!-- MAIN SLIDES -->
                                   <div class="product-image-slider">
                                     <? $picount = 0;
                                 foreach ($products_image as $pi) {
                                    $picount++; ?>
                                    <figure class="border-radius-10">
                                        <img  src="<?= $LimagePath . $pi['product_image_name'] ?>"
                                                alt="<?= $product_name ?>" title="<?= $product_name ?>"  />
                                    </figure>
                                    <?
                                  }

                                    ?>


                                   </div>
                                   <!-- THUMBNAILS -->
                                   <div class="slider-nav-thumbnails">
                                     <? $picount = 0;
                                 foreach ($products_image as $pi) {
                                    $picount++; ?>
                                    <div><img src="<?= $SimagePath . $pi['product_image_name'] ?>"
                                            alt="<?= $product_name ?>" title="<?= $product_name ?>" /></div>

                                    <?
                                  }

                                    ?>


                                   </div>
                               </div>
                               <!-- End Gallery -->
                           </div>
                           <div class="col-md-6 col-sm-12 col-xs-12">
                               <div class="detail-info pr-30 pl-30">

                                 <!-- <span class="stock-status out-stock"> Hot </span> -->

                                   <h2 class="title-detail">   <?= $product_display_name ?></h2>
                                   <div class="product-detail-rating1">
                                       <div class="mt-30">
                                           <!-- <div class="product-rate1 d-inline-block"> -->
                                            <div class=" d-flex align-items-center justify-content-center">
                                              <div class="col-md-12">
                                             <div class="starrr_myBtn ">
                                               <?
                                               for ($i=1; $i <=5 ; $i++) {
                                                 if($avgrating >= $i){
                                                   $star_cls = "fa-solid";
                                                 }else{
                                                     $star_cls = "fa-regular";
                                                 }
                                                 ?>
                                                   <i class="<?=$star_cls?> fa-star"></i>
                                                 <?
                                               }
                                               ?><span class="font-small ml-5 text-muted " style="margin-top: 10px"> (<?=count($product_reviews_list)?> reviews)</span>
                                                                     </div>
                                                                   </div>
                                               <!-- <div class="product-rating" style="width: 90%"></div> -->
                                           <!-- </div> -->

                                         </div>
                                       </div>
                                   </div>
                                   <div class="clearfix product-price-cover">

                                       <div class="product-price primary-color float-left">
                                           <span class="current-price text-brand"><?= $currency->symbol ?><? echo number_format($final_price) ?></span>
                                           <? if (!empty($discount) && $discount > 0) { ?>
                                              <span>
                                              <span class="save-price font-md color3 ml-15">
                                                   <? echo $discount ?> Off</span>
                                                   <span class="old-price font-md ml-15"><?= $currency->symbol ?>
                                                                <?= number_format($discounted_price) ?></span>
                                                                </span>
                                            <?php } ?>

                                           <span>



                                           </span>
                                       </div>
                                   </div>
                                   <div class="short-desc mb-30">
                                       <p class="font-lg"><?=$short_description?></p>
                                   </div>
                                   <div class="attr-detail attr-size mb-30">
                                       <strong class="mr-10">Size / Weight: </strong>
                                   <?
            //echo "<pre>";print_r($products_list);echo "</pre>";

            if (count($products_list[0]['product_combination']) > 0) {
               ?>

               <ul class="list-filter size-filter font-small">

               <? //$this->load->view('templates/product-list',$this->data);  ?>

               <?

               foreach ($products_list[0]['product_combination'] as $r_pc) {
                 if ($default_product_combination_id == $r_pc['product_combination_id']) {
                   $active = 'active';
                 }else{
                   $active = '';
                 }
                  //if ($default_product_combination_id != $r_pc['product_combination_id']) {
                     $r_product_name = $r_pc['product_display_name'];
                     $r_combi = $r_pc['combi'];

                     $product_image_name = $r_pc['product_image_name'];
                     $ps_slug_url = $r_pc['ps_slug_url'];
                     $combi = $r_pc['combi'];
                     $combi_ref_code = $r_pc['ref_code'];
                     $product_in_store_id = $r_pc['product_in_store_id'];
                     $product_combination_id = $r_pc['product_combination_id'];
                     $prod_in_cart = $r_pc['prod_in_cart'];
                     $prod_in_wishList = $r_pc['prod_in_wishList'];
                     $delivery_charges = $r_pc['delivery_charges'];
                     $product_display_name = $r_pc['product_display_name'];
                     $model_number = $r_pc['model_number'];
                     if (!empty($product_display_name)) {
                        $product_name = $product_display_name;
                     } else {
                        //$product_name = $product_name . '<br>' . $combi;
                        $product_name = $product_name;
                     }
                     $current_viewers_msg = $r_pc['current_viewers_msg'];
                     $current_sold_msg = $r_pc['current_sold_msg'];
                     $is_msg_dynamic = $r_pc['is_msg_dynamic'];
                     $in_store_quantity = $r_pc['quantity'];
                     $stock_out_msg = $r_pc['stock_out_msg'];

                     $temp_currency_id = $this->session->userdata('application_sess_currency_id');
                     if (empty($temp_currency_id) || $temp_currency_id == 1) {
                        if ($r_pc['discount_var'] == 'Rs') {
                           $discount = $currency->symbol . ' ' . $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['discount']));
                           $discount = trim($discount);
                        } else {
                           $discount = round($r_pc['discount']) . ' ' . $r_pc['discount_var'];
                           $discount = trim($discount);
                        }
                        $price = $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['price']));
                        $final_price = $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['final_price']));
                     } else {
                        if ($r_pc['other_discount_var'] == 'Rs') {
                           $discount = $currency->symbol . ' ' . $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['other_discount']));
                           $discount = trim($discount);
                        } else {
                           $discount = $r_pc['other_discount'] . ' ' . $r_pc['other_discount_var'];
                           $discount = trim($discount);
                        }
                        $price = $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['other_price']));
                        $final_price = $CI->getCurrencyPrice(array('obj' => $this->data, 'amount' => $r_pc['other_final_price']));
                     }
                     $product_link = base_url() . 'products-details/' . $product_id . '/' . $product_combination_id;
                     if (!empty($ps_slug_url)) {
                        $product_link = '';
                        $product_link .= base_url();
                        if (!empty($pre_url_product)) {
                           $product_link .= $pre_url_product;
                        }
                        $product_link .= $ps_slug_url;
                     }
                     ?>
                     <li class="<?=$active?>"><a href="<?=$product_link?>" ><?echo $combi?></a></li>
                  <? //}
               } ?>
             </ul>
               <?
            } ?>

          </div>
                                   <div class="detail-extralink mb-50">
                                          <div class="product-extra-link2" style="display: flex;">
                                     <? if ($in_store_quantity > 0) {

                                       ?>


                                         <a href="<?=base_url('viewcart')?>" style="width: max-content">
                                           <button type="button" class="button button-add-to-cart productInCartShow_<? echo $product_in_store_id; ?>" <? if (!empty($prod_in_cart) || $prod_in_cart > 0) { ?> style="display:inline-block"<? } else { ?>style="display:none"<? } ?>><i class="fa fa-shopping-cart"></i>Go to cart</button>

                                         </a>



                                             <button type="button" class="button button-add-to-cart ad_cart_btn  addToCartListBTN<? echo $offset ?> productAddShow_<? echo $product_in_store_id; ?>" <? if (!empty($prod_in_cart) || $prod_in_cart > 0) { ?> style="display:none"<? } else { ?>style="display:inline-block"<? } ?> title="Add To Cart - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>" data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,2" ><i class="fa fa-shopping-cart"></i>Add to cart</button>



                                           <!-- <a aria-label='Compare' class='action-btn hover-up' href='shop-compare.html'><i class="fi-rs-shuffle"></i></a> -->

                                       <?}else{
                                        
                                         ?>
                                           <a  style="width: max-content">
                                             <button type="button" class="button button-add-to-cart " ><? echo $stock_out_msg; ?></button>

                                           </a>

                                         <?
                                       }?>
                                       <a aria-label='Add To Wishlist'  class="action-btn hover-up crt_button3 wishlist-i cart_wishlist_<? echo $product_in_store_id; ?> cart_wishlist_n_<? echo $product_in_store_id; ?> addToWishlistListBTN<? echo $offset ?>" data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,1" title="Add to Wishlist - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>" style=" <? if ($prod_in_wishList <= 0) { echo " display:inline-block";} else {echo "display:none";} ?>"><i class="fa fa-heart-o"></i></a>
                                       <a  aria-label='Remove From Wishlist'   class="action-btn hover-up crt_button3 wishlist-i cart_wishlist_<? echo $product_in_store_id; ?> cart_wishlist_y_<? echo $product_in_store_id; ?> addToWishlistListBTN<? echo $offset ?>" data-val="<? echo $product_in_store_id; ?>,<? echo $product_id; ?>,<? echo $product_combination_id; ?>,2" title="Remove from Wishlist - <? echo $product_name; ?> - <? echo str_replace('&nbsp;' , ' ' , $combi); ?>" style=" <? if ($prod_in_wishList >= 1) {echo " display:inline-block";} else {echo "display:none";} ?> " ><i class="fa fa-heart"></i></a>
                                     </div>
                                     	</div>
                                   </div>
                                   <div class="font-xs">
                                       <ul class="mr-50 float-start">
                                           <li class="mb-5">Brand Name: <span class="text-brand"><?=$brand_name?></span></li>

                                       </ul>
                                       <ul class="float-start">
                                           <li class="mb-5">Reference Code: <a href="#"><?=$ref_code?></a></li>

                                       </ul>
                                   </div>
                               </div>
                               <!-- Detail Info -->
                           </div>
                       </div>
                       <div class="product-info">
                           <div class="tab-style3">
                               <ul class="nav nav-tabs text-uppercase">
                                   <li class="nav-item">
                                       <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                   </li>

                                   <li class="nav-item">
                                       <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (<?=count($product_reviews_list)?>)</a>
                                   </li>
                               </ul>
                               <div class="tab-content shop_info_tab entry-main-content">
                                   <div class="tab-pane fade show active" id="Description">
                                       <div class="">
                                           <?=$description?>
                                       </div>
                                   </div>

                                   <div class="tab-pane fade" id="Reviews">
                                       <!--Comments-->
                                       <!-- <div class="comments-area">
                                           <div class="row">
                                               <div class="col-lg-12">
                                                   <h4 class="mb-30">Customer questions & answers</h4>

                                               </div>

                                           </div>
                                       </div> -->
                                       <!--comment form-->
                                       <div class="col-sm-5">
                    								<div class="rating-block">
                    									<h4>Average user rating</h4>
                    									<h2 class="bold padding-bottom-7"><? echo round($avgrating, 1);?><small>/ 5</small></h2>
                    									<div class="starrr_myBtn">
                    										<div class="star-rating rating-sm">
                                          <?
                                          for ($i=1; $i <=5 ; $i++) {
                                            if($avgrating >= $i){
                                              $star_cls = "fa-solid";
                                            }else{
                                                $star_cls = "fa-regular";
                                            }
                                            ?>
                                              <i class="<?=$star_cls?> fa-star"></i>
                                            <?
                                          }
                                          ?>
                    										</div>
                    									</div>
                    								</div>
                    							</div>
                                       <div class="comment-form">
                                           <h4 class="mb-15">Add a review</h4>
                                           <!-- <div class="product-rate d-inline-block mb-30"></div> -->
                                           <div class="row">
                                               <div class="col-lg-8 col-md-12">
                                                   <form class="form-contact comment_form" action="#" id="commentForm">
                                                     	<span id="review_alert_msg" class="review_alert_msg">
                                                     <input type="hidden" name="product_id" id="product_id" value="<? echo $product_id;?>" />

                                                   <input type="hidden" name="product_combination_id" id="product_combination_id" value="<? echo $product_combination_id;?>" />

                                                       <div class="row">
                                                         <div class="col-12">
                                                             <div class="form-group">
                                                                 <input class="form-control" name="review_title" id="review_title" type="text" maxlength="60" placeholder="Maximum 60 Words. (Example: Great Product)" />
                                                             </div>
                                                         </div>
                                                           <div class="col-12">
                                                               <div class="form-group">
                                                                   <textarea class="form-control w-100" name="customer_review" id="customer_review" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                               </div>
                                                           </div>
                                                           <div class="col-12">
                                                             <div class="starrr_myBtn">
                                                                       <div class="star-rating rating-sm rating-active">
                                                                         <div class="rating-container rating-gly-star">
                                                                           <input id="rating" name="rating" value="<? echo round($avgrating, 1);?>" type="text" class="rating form-control rating-loading" data-min="0" data-max="5" data-step="1" data-size="sm" required="" title="" style="display: none;">
                                                                         </div>
                                                                       </div>
                                                                     </div>
                                                           </div>
                                                       </div>
                                                       <div class="form-group mt-4">
                                                           <button type="button" onclick="SubmitReviewForm()" class="button button-contactForm">Submit Review</button>
                                                       </div>
                                                   </form>
                                               </div>
                                               <? if(count($product_reviews_list) > 0 || true){?>


                                                    <? $this->load->view('template/product_review', $this); ?>
                                                    </div>


                                                 <? }else{ ?>
                                                    <p><a class="add_to_cart " data-toggle="collapse" href="#reviewform">Be the First To Review This Product</a></p>
                                                 <? } ?>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-60">
                           <div class="col-12">
                               <h2 class="section-title style-1 mb-30">Related products</h2>
                           </div>
                           <div class="col-12">

                               <div class="carausel-4-columns-cover arrow-center position-relative">
                                   <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                   <div class="slider_related_products_now carausel-arrow-center" id="slider_related_products_now" data-val="<?= $product_id ?> , <?= $product_combination_id ?>">

                               </div>

                       <!--End tab-content-->
                   </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </main>
<script>
function SubmitReviewForm()
{

  $('.review_alert_msg').html('');
  alert($('#product_id').val())
  var product_id=document.getElementById('product_id').value;
  var product_combination_id=document.getElementById('product_combination_id').value;
  var rating=document.getElementById('rating').value;
  //var customer_name=document.getElementById('customer_name').value;
  var review_title=document.getElementById('review_title').value;
  var review=document.getElementById('customer_review').value;
  $('.review_alert_msg').hide();
  $('.review_alert_msg').html('');

  if(rating == '' || rating == 0)
  {
    $('.review_alert_msg').show();
    $('.review_alert_msg').html('<div class="alert alert-danger" role="alert">Please select rating</div>');
    document.getElementById('rating').focus();
    return false;
  }

  else{
     //alert(product_id+'   '+rating);
     $(".loader").show();
      $.ajax({
      type: "POST",
      url : $('.siteUrl').val()+"Products/doPostReview",
      dataType : 'json',
      //data : {"rating" :rating , "product_id" : product_id, "customer_name" :customer_name , "review_title" :review_title, "review" :review},
      data : {"rating" :rating , "product_id" : product_id, "review_title" :review_title, "review" :review, "product_combination_id" :product_combination_id},
      success : function(result){
      //alert(result);
      //document.getElementById('review_response').innerHTML = '<div class="alert alert-success" role="alert">' + result + '</div>';
      $('.review_alert_msg').show();
      $('.review_alert_msg').html(result.response_text);
      //document.getElementById('customer_name').value='';
      if(result.response_code == 1)
      {
        document.getElementById('review_title').value='';
        document.getElementById('customer_review').value='';
      }
      $(".loader").hide();
      }
      });

  }

}
</script>
