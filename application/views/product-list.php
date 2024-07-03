<main class="main">

       <div class="page-header mt-30 mb-50">
           <div class="container">
               <div class="archive-header1">
                   <div class="row align-items-center">
                       <div class="col-md-12">
                           <!-- <h1 class="mb-15">Dry Fruits & Nuts</h1> -->
                           <div class="breadcrumb">
                             <?=$breadcrumbs?>

                           </div>
                       </div>

                   </div>
               </div>
           </div>
       </div>
       <?

$cat_name = '';
if(!empty($current_category->name))
{
	$cat_name = $current_category->name;
}

$searchSugg = '';
		if(!empty($_REQUEST['searchSugg']))
		{
			$searchSugg = $_REQUEST['searchSugg'];
		}
?>


<form id="prd_search_form" name="prd_search_form" action="" method="post" >
  <input type="hidden" name="c_max_final_price" id="c_max_final_price" value="<?=ceil($max_final_price)?>" />

  <input type="hidden" name="r_min_final_price" id="r_min_final_price" value="<?=round($min_final_price)?>" />

<?
$att_count=0;
if(!empty($super_sub_cat)){$attribute_cat = $super_sub_cat;$sub_cat='';$main_cat='';}
else if(!empty($sub_cat)){$attribute_cat = $sub_cat;$super_sub_cat='';$main_cat='';}
else if(!empty($main_cat)){$attribute_cat = $main_cat;$sub_cat='';$super_sub_cat='';}
?>
<input type="hidden" name="main_cat_search" id="main_cat_search" value="<?=$main_cat?>" />
<input type="hidden" name="sub_cat_search" id="sub_cat_search" value="<?=$sub_cat?>" />
<input type="hidden" name="super_sub_cat_search" id="super_sub_cat_search" value="<?=$super_sub_cat?>" />
<input type="hidden" name="searchSugg" id="searchSugg" value="<?=$searchSugg?>" />
<input type="hidden" name="offset" id="offset" value="0" />
<input type="hidden" name="callFor" id="callFor" value="loadMore" />
<input type="hidden" name="p_search_by" id="p_search_by" value="" />

       <div class="container mb-30">
           <div class="row">
               <div class="col-lg-3">
                  <div class="left-side" >
                <div class="sidebar-widget widget-category-2 mb-30">
                       <h5 class="section-title style-1 mb-30">Category</h5>
                          <? if(!empty($menu)){ ?>
                       <ul>

                            <? foreach($menu as $m){ ?>
                              <li>
                                  <a  href="<?=$m->slug_url?>"> <img src="<?=IMAGE?>theme/icons/icon-hot.svg" alt="" /><?=$m->name?></a>
                              </li>


                            <?}?>



                       </ul>
                         <?}?>
                   </div>
                   <div class="sidebar-widget price_range range mb-30">
                       <h5 class="section-title style-1 mb-2">Out of Stock</h5>
                   <div class="list-group">
                           <div class="list-group-item mb-10 mt-10">

                               <div class="custome-checkbox">
                                   <p>
                                   <input class="form-check-input search_att" onchange="searchProduct()" name="in_stock" value="1"  id="st_in_stock" type="checkbox" name="checkbox"  value="" />
                                   <label class="form-check-label" for="in_stock"><span>Exclude Outof stock </span></label>
                                   </p>
                               </div>

                           </div>
                       </div>
                   </div>
                   <? if(!empty($attribute)){

                    foreach($attribute as $a){
                      if(!empty($a->attributeVal)){
                    $att_count++;
                         ?>
                    <div class="sidebar-widget price_range range mb-30">
                       <h5 class="section-title style-1 mb-2"><?=$a->name?></h5>
                   <div class="list-group">
                           <div class="list-group-item mb-10 mt-10">

                               <div class="custome-checkbox">

                                       <?
                                       foreach($a->attributeVal as $av){
                                   ?>
                                   <?
                    $checked = '';
                    if(in_array($av->id , $Qsearch)){ $checked = 'checked="checked"';}

                    $atter_val = json_encode(array('product_attribute_value_id'=>$av->id , 'combination_value'=>$av->combination_value));

                    ?>
                                   <p>
                                   <input class="form-check-input search_att" type="checkbox" onchange="$('#p_search_by').val('f_attr_<?=$a->product_attribute_id?>');searchProduct()" <?=$checked?> value='<?=$atter_val?>' id="att_check_<?=$av->id?>" name="search<?=$a->product_attribute_id?>[]" data-attparent='<?=$a->name ?>'  data-attchild='<?=$av->name ?>'  />
                                   <label class="form-check-label" for="att_check_<?=$av->id?>"><span><?=$av->combination_value?> <?=$av->name?></span></label>
                                  </p>
                                   <? } ?>


                               </div>

                           </div>
                       </div>
                   </div>
                    <? }}} ?>

                   <div class="sidebar-widget price_range range mb-30">
                       <h5 class="section-title style-1 mb-2">Brand</h5>
                    <div class="list-group">
                           <div class="list-group-item mb-10 mt-10">

                               <div class="custome-checkbox">
                                 <? $md_count=0; foreach($manufacturer_data as $md){$md_count++; ?>
                  								<?
                  								$checked = '';
                  								if(in_array($md->id , $search_manufacturer_data)){ $checked = 'checked="checked"';}
                  								?>

                                  <p>
                                  <input class="form-check-input" type="checkbox" onchange="$('#p_search_by').val('brand');searchProduct()" <?=$checked?> name="manufacturer_id[]" id="md_<?=$md_count?>" value="<?=$md->id?>" data-attparent='Brand'  data-attchild='<?=addslashes($md->name)?>' />
                                  <label class="form-check-label"for="md_<?=$md_count?>"><span><?=$md->name?></span></label>
                                  </p>
                  							<? } ?>


                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- Fillter By Price -->
                   <div class="sidebar-widget price_range range mb-30">
                       <h5 class="section-title style-1 mb-2">Price</h5>
                       <div class="price-filter">
                           <div class="price-filter-inner">
                               <div id="slider-range" class="mb-20"></div>
                               <div class="d-flex justify-content-between">

                                 <input type="hidden" min="<?=$min_final_price?>" max="<?=$max_final_price?>" value="<?=$min_final_price?>" name="min_price" id="min_price" class="pr_lu" >
                                  <input type="hidden" min="<?=$min_final_price?>" max="<?=ceil($max_final_price)?>" value="<?=$max_final_price?>" name="max_price" id="max_price" class="pr_lu" >

                                   <div class="caption">From: <strong id="slider-range-value1" class="text-brand"><?=$min_final_price?></strong></div>
                                   <div class="caption">To: <strong id="slider-range-value2" class="text-brand"><?=$max_final_price?></strong></div>
                               </div>
                           </div>
                       </div>

                       <!-- <a class='btn btn-sm btn-default' href='#'><i class="fa fa-filter mr-5"></i> Fillter</a> -->
                   </div>

                   </div>

               </div>
               <div class="col-lg-9">
                   <div class="shop-product-fillter">
                       <div class="totall-product">
                           <p>We found <strong class="text-brand"><?=$products_list_count?></strong> items for you!</p>
                       </div>
                       <div class="sort-by-product-area">
                           <div class="sort-by-cover mr-10">

                               <div class="sort-by-dropdown">
                                   <ul>
                                       <li><a class="active" href="#">50</a></li>
                                       <li><a href="#">100</a></li>
                                       <li><a href="#">150</a></li>
                                       <li><a href="#">200</a></li>
                                       <li><a href="#">All</a></li>
                                   </ul>
                               </div>
                           </div>
                           <div class="sort-by-cover">
                               <div class="sort-by-product-wrap">
                                   <div class="sort-by">
                                       <!-- <span><i class="fa fa-sort"></i>Sort by:</span> -->
                                   </div>
                                   <div class="sort-by-dropdown-wrap">
                                       <!-- <span> Featured <i class="fa fa-angle-down"></i></span> -->
                                       <select onchange="searchProduct()" name="order" class="sort_sectin">
                                                <option <? if($order==1){echo "selected";} ?> value="1">Price: Low to High</option>
                                                <option <? if($order==2){echo "selected";} ?> value="2">Price: High to Low</option>
                                                <option <? if($order==3){echo "selected";} ?> value="3">Product: Featured Products</option>
                                                <option <? if($order==4){echo "selected";} ?> value="4">Product: Hot Selling Now</option>
                                                <option <? if($order==5){echo "selected";} ?> value="5">Product: Best Sellers</option>
                                                <option <? if($order==6){echo "selected";} ?> value="6">Product: What's New</option>
                                                <option <? if($order==7){echo "selected";} ?> value="7">Discount: High to Low</option>
                                                <option <? if($order==8){echo "selected";} ?> value="8">Name: A to Z</option>
                                                <option <? if($order==9){echo "selected";} ?> value="9">Name: Z to A</option>
                                                </select>
                                   </div>
                               </div>
                               <div class="sort-by-dropdown">
                                   <ul>
                                       <li><a class="active" href="#">Featured</a></li>
                                       <li><a href="#">Price: Low to High</a></li>
                                       <li><a href="#">Price: High to Low</a></li>
                                       <li><a href="#">Release Date</a></li>
                                       <li><a href="#">Avg. Rating</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row product-grid DisplayMoreProd">
                     <?
                 if(!empty($products_list))
                 {
                   $this->load->view('template/product-list',$this->data);
                 }
                 else
                 {?>
                                     <div class="no_prd_found text-center">
                                       <h2 class="no_product">Sorry<span class="no_product_symbol">!</span></h2>
                                       <p class="no_product_para">No Product <span class="no_product_text">Found.</span></p>
                                       </div>
                                     <img src="<?=base_url().'assets/front/images/no-product.jpg'?>" class="responsiveImg">
                   <?php /*?><p class="">No Products to display</p><?php */?>
                 <?
                 }
               ?>

                           <!--end product card-->


                   </div>
                   <!--product grid-->
                   <div class="row loadMoreProductText" style="    clear: both;text-align: center;padding: 20px;font-weight: 600;font-size: 16px;text-shadow: 1px 4px 6px #b1b1b1;"></div>


               </div>


           </div>
       </div>
       </form>
   </main>
<script type="text/javascript">
    
</script>
