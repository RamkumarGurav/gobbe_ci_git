<?
$offset = '';
$CI = &get_instance();
foreach ($products_list as $col) {
   //	echo "<pre>"; print_r($col); echo "</pre>";
   $is_bulk_enquiry = $col['is_bulk_enquiry'];
   $product_main_name = $product_name = $col['name'];
   $product_id = $col['product_id'];
   $short_description = $col['short_description'];
   $brand_name = $col['brand_name'];
   $description = $col['description'];

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
               $discount = round($cpc['discount']) . ' ' . $cpc['discount_var'];
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
                               <a href='#' rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
                               <span></span> Products Detail <span></span> Dry Fruits & Nuts
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
                                   <span class="stock-status out-stock"> Sale Off </span>
                                   <h2 class="title-detail">   <?= $product_display_name ?></h2>
                                   <div class="product-detail-rating">
                                       <div class="product-rate-cover text-end">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 90%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                       </div>
                                   </div>
                                   <div class="clearfix product-price-cover">
                                       <div class="product-price primary-color float-left">
                                           <span class="current-price text-brand"><?= $currency->symbol ?><? echo number_format($final_price) ?></span>
                                           <? //if (!empty($discount) && $discount > 0) { ?>
                                              <span class="save-price font-md color3 ml-15"><?= $currency->symbol ?>
                                                   <? echo number_format($price) ?></span>
                                                   <span class="old-price font-md ml-15"><?= $currency->symbol ?>
                                                               <?= number_format($discounted_price) ?></span>
                                            <?php //} ?>
                                           <span>



                                           </span>
                                       </div>
                                   </div>
                                   <div class="short-desc mb-30">
                                       <p class="font-lg"><?=$short_description?></p>
                                   </div>
                                   <div class="attr-detail attr-size mb-30">
                                       <strong class="mr-10">Size / Weight: </strong>
                                       <ul class="list-filter size-filter font-small">
                                         <?
                                         // echo "<pre>";
                                         // print_r($products_list);
                                         // echo "</pre>";
                                         // die;
                                         if (count($products_list[0]['attribute_data']) > 0) {
                                           $k = 1;
                                           foreach ($products_list[0]['attribute_data'] as $attribute_data ) {
                                             if($k == 1){
                                               $active = 'active';
                                             }else {
                                               $active = '';
                                             }
                                             ?>
                                                <li class="<?=$active?>"><a ><?echo $attribute_data['a_name'] .':'. $attribute_data['v_name']  ?></a></li>
                                             <?
                                             $k++;
                                           }


                                         }
                                         ?>



                                       </ul>
                                   </div>
                                   <div class="detail-extralink mb-50">
                                       <div class="detail-qty border radius">
                                           <a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
                                           <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                           <a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
                                       </div>
                                       <div class="product-extra-link2">
                                           <button type="submit" class="button button-add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                           <a aria-label='Add To Wishlist' class='action-btn hover-up' href='#'><i class="fa fa-heart"></i></a>
                                           <!-- <a aria-label='Compare' class='action-btn hover-up' href='shop-compare.html'><i class="fi-rs-shuffle"></i></a> -->
                                       </div>
                                   </div>
                                   <div class="font-xs">
                                       <ul class="mr-50 float-start">
                                           <li class="mb-5">Type: <span class="text-brand">Organic</span></li>
                                           <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2024</span></li>
                                           <li>LIFE: <span class="text-brand">70 days</span></li>
                                       </ul>
                                       <ul class="float-start">
                                           <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                           <li class="mb-5">Tags: <a href="#" rel="tag">Snack</a>, <a href="#" rel="tag">Organic</a>, <a href="#" rel="tag">Brown</a></li>
                                           <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li>
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
                                       <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
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
                                       <div class="comments-area">
                                           <div class="row">
                                               <div class="col-lg-12">
                                                   <h4 class="mb-30">Customer questions & answers</h4>

                                               </div>

                                           </div>
                                       </div>
                                       <!--comment form-->
                                       <div class="comment-form">
                                           <h4 class="mb-15">Add a review</h4>
                                           <div class="product-rate d-inline-block mb-30"></div>
                                           <div class="row">
                                               <div class="col-lg-8 col-md-12">
                                                   <form class="form-contact comment_form" action="#" id="commentForm">
                                                       <div class="row">
                                                           <div class="col-12">
                                                               <div class="form-group">
                                                                   <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                               </div>
                                                           </div>
                                                           <div class="col-sm-6">
                                                               <div class="form-group">
                                                                   <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                               </div>
                                                           </div>
                                                           <div class="col-sm-6">
                                                               <div class="form-group">
                                                                   <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                               </div>
                                                           </div>
                                                           <div class="col-12">
                                                               <div class="form-group">
                                                                   <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <button type="submit" class="button button-contactForm">Submit Review</button>
                                                       </div>
                                                   </form>
                                               </div>
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
                                   <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                       <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat1.webp" alt="" />
                                               <!-- <img class="hover-img" src="<?=IMAGE?>cat1.webp" alt="" /> -->
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                       <div class="product-badges product-badges-position product-badges-mrg">
                                           <span class="hot">Hot</span>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Dry fruits & Nuts</a>
                                       </div>
                                       <h2><a href='#'>Mixed Dry Fruits & Nuts</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 90%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (4.0)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹28.85</span>
                                               <span class="old-price">₹32.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                 <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat2.png" alt="" />
                                               <img class="hover-img" src="<?=IMAGE?>cat2.png" alt="" />
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                       <div class="product-badges product-badges-position product-badges-mrg">
                                           <span class="sale">Sale</span>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Seeds</a>
                                       </div>
                                       <h2><a href='#'>Natural Mixed seeds</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 80%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (3.5)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹52.85</span>
                                               <span class="old-price">₹55.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat3.png" alt="" />
                                               <img class="hover-img" src="<?=IMAGE?>cat3.png" alt="" />
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                       <div class="product-badges product-badges-position product-badges-mrg">
                                           <span class="new">New</span>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Combo pack</a>
                                       </div>
                                       <h2><a href='#'>Combo Pack</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 85%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (4.0)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹48.85</span>
                                               <span class="old-price">₹52.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat4.png" alt="" />
                                               <img class="hover-img" src="<?=IMAGE?>cat4.png" alt="" />
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Gift Packs</a>
                                       </div>
                                       <h2><a href='#'>Free Gift Packs</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 90%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (4.0)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹17.85</span>
                                               <span class="old-price">₹19.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".5s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat5.png" alt="" />
                                               <img class="hover-img" src="<?=IMAGE?>cat5.png" alt="" />
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                       <div class="product-badges product-badges-position product-badges-mrg">
                                           <span class="best">-14%</span>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Millets</a>
                                       </div>
                                       <h2><a href='#'>Refined Millets</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 90%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (4.0)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹23.85</span>
                                               <span class="old-price">₹25.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product-cart-wrap wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                   <div class="product-img-action-wrap">
                                       <div class="product-img product-img-zoom">
                                           <a href='#'>
                                               <img class="default-img" src="<?=IMAGE?>cat6.png" alt="" />
                                               <img class="hover-img" src="<?=IMAGE?>cat6.png" alt="" />
                                           </a>
                                       </div>
                                       <div class="product-action-1">
                                           <a aria-label='Add To Wishlist' class='action-btn' href='#'><i class="fa fa-heart"></i></a>
                                           <a aria-label='Compare' class='action-btn' href='#'><i class="fa fa-refresh"></i></a>
                                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa fa-eye"></i></a>
                                       </div>
                                   </div>
                                   <div class="product-content-wrap">
                                       <div class="product-category">
                                           <a href='#'>Muesli</a>
                                       </div>
                                       <h2><a href='#'>Tasty Mixed Muesli</a></h2>
                                       <div class="product-rate-cover">
                                           <div class="product-rate d-inline-block">
                                               <div class="product-rating" style="width: 90%"></div>
                                           </div>
                                           <span class="font-small ml-5 text-muted"> (4.0)</span>
                                       </div>

                                       <div class="product-card-bottom">
                                           <div class="product-price">
                                               <span>₹54.85</span>
                                               <span class="old-price">₹55.8</span>
                                           </div>
                                           <div class="add-cart">
                                               <a class='add' href='#'><i class="fa fa-shopping-cart mr-5"></i>Add to Cart </a>
                                           </div>
                                       </div>

                               </div>
                                   </div>
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
