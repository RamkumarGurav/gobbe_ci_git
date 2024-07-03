<?
  $trending_now=0;  $id = 0;$hot_selling_now=0;$best_sellers=0;$new_product=0;
  $product_display_name = $ref_code = $uom_id = '';
  $select_product_attribute_id = $product_seo_id = $combination_values =  '';
  $select_product_attribute_value_id = '';
     $autoMetaCategory='';
     $status = 1;
  $quantity = '';
  $price = '';
  $discounted_price = '';
  $discount = '';
  $discount_var = '';
  $final_price = '';
  $product_weight = '';
  $product_l = '';
  $product_b = '';
  $product_h = '';
  $delivery_charges = '';
  $current_sold_msg = '';
  $is_google_product = '';
  $gtin = '';
  $is_seo_tag = '';
  $slug_url = '';
  $meta_title = '';
  $meta_description = '';
  $meta_keywords = '';
  $product_combination_id = '';
  if(!empty($product_combination_detail)){

    $product_combination_id = $product_combination_detail->id;
    $product_display_name = $product_combination_detail->product_display_name;
    $quantity = $product_combination_detail->quantity;
    $price = $product_combination_detail->price;
    $final_price = $product_combination_detail->final_price;
    $product_l = $product_combination_detail->product_l;
    $product_b = $product_combination_detail->product_b;
    $product_h = $product_combination_detail->product_h;
    $discounted_price = $product_combination_detail->final_price;
    $uom_id = $product_combination_detail->uom_id;

    $product_weight = $product_combination_detail->product_weight;
    //$discounted_price = $product_combination_detail->discounted_price;
    $ref_code = $product_combination_detail->ref_code;
    $trending_now = $product_combination_detail->trending_now;
    $hot_selling_now = $product_combination_detail->hot_selling_now;
    $best_sellers = $product_combination_detail->best_sellers;
    $new_product = $product_combination_detail->new_product;
    $discount_var = $product_combination_detail->discount_var;
    $discount = $product_combination_detail->discount;
    $delivery_charges = $product_combination_detail->delivery_charges;
    $current_sold_msg = $product_combination_detail->current_sold_msg;
    $is_google_product = $product_combination_detail->is_google_product;
    $gtin = $product_combination_detail->gtin;

    $status = $product_combination_detail->status;
    $slug_url =  $product_combination_detail->slug_url;
    $meta_title =  $product_combination_detail->meta_title;
    $meta_description =  $product_combination_detail->meta_description;
    $meta_keywords =  $product_combination_detail->meta_keywords;
    $product_seo_id =  $product_combination_detail->product_seo_id;
    if(!empty($meta_keywords)){
      $is_seo_tag = 1;
    }
    $select_product_attribute_value_id =  $product_combination_detail->product_attribute_value_id;
    $select_product_attribute_id  =  $product_combination_detail->product_attribute_id;
  //  $combination_values  =  $product_combination_detail->combination_value;
  }
?>
<div class="tpa-conp-inner">
    <div class="tpci-head">
        <div class="tpci-row-one">
            <div class="tpci-ro-inner">
                <div class="tpci-roi-l">
                    <h4>Product Combinations</h4>
                    <p>Product Combinations info, combinations and extras.</p>
                </div>
                <div class="tpci-roi-r">
                    <span class="apc-conp-close"><i
                            class="fa-solid fa-xmark"></i></span>
                </div>
            </div>
        </div>

    </div>
    <div class="tpci-tab-con">
        <div class="tpi-product-row">
            <div class="tpi-pr-inner justify-content-center">

                <div class="tpi-pri-r">
                    <span class="tpr-ec">
                        Edit Combination : <span><?=$product_display_name?></span>
                    </span>

                </div>
            </div>
        </div>
        <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doAddProductCombination", array('method' => 'post', 'id' => 'combination_form' , 'onsubmit'=>'return  savedoAddProductCombination(this)', "name"=>"form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
        <?php $value = set_value('id'); if(empty($value)){$value = $id;}$attributes = array('name'  => 'id', 'id'  => 'id', 'value' => $value, 'type' => 'hidden' ); echo form_input($attributes);?>

        <div class="row">

              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Product Display Name', 'name', $flattributes);
                $value = set_value('product_display_name');
                if(empty($value)){$value = $product_display_name;}
                $attributes = array(
                'name'  => 'product_display_name',
                'id'  => 'product_display_name',
                'value' => $value,
                'placeholder' => "Product Display Name",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);
                echo form_hidden('product_id',$product_id);
                echo  form_hidden('product_combination_id',$product_combination_id);
                echo  form_hidden('is_update_store',1);
                ?>

                <span>
                <?php echo form_error('product_display_name', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>

              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',
                'id'    => 'ref_code',
                );
                echo form_label('Combinations Reference Code', 'name', $flattributes);
                $value = set_value('ref_code');
                if(empty($value)){$value = $ref_code;}
                $attributes = array(
                'name'  => 'ref_code',
                'id'  => 'ref_code',
                'value' => $value,
                'placeholder' => "Combinations Reference Code",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('ref_code', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                  <?php

                  	echo form_label('Units', 'uom_id');
                  $value = set_value('uom_id');
                          if(!empty($value)){$uom_id = $value; }
                          if(empty($value)){$value = $uom_id;}
                    $attributes = array(
                    'name'	=> 'uom_id',
                    'id'	=> 'uom_id',
                    'title' => "Select Role",
                    'class' => 'form-control form-control-sm',
                    'required' => 'required',

                    );
                    echo form_dropdown($attributes , $units , $value );
                  ?>
                <span>
                <?php echo form_error('uom_id', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>

              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                  <?php
                //  print_r($product_attributes);
                  	echo form_label('Attribute Name', 'select_product_attribute_id');
                  $value = set_value('select_product_attribute_id');
                          if(!empty($value)){$select_product_attribute_id = $value; }
                          if(empty($value)){$value = $select_product_attribute_id;}
                    $attributes = array(
                    'name'	=> 'select_product_attribute_id',
                    'id'	=> 'select_product_attribute_id',
                    'title' => "Attribute Name",
                    'class' => 'form-control form-control-sm',
                    'required' => 'required',

                    );
                    echo form_dropdown($attributes , $product_attributes , $value );
                  ?>
                <span>
                <?php echo form_error('select_product_attribute_id', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                  <?php
                    echo form_label('Attribute Value', 'select_product_attribute_value_id');
                  $value = set_value('select_product_attribute_value_id');
                          if(!empty($value)){$select_product_attribute_value_id = $value; }
                          if(empty($value)){$value = $select_product_attribute_value_id;}
                    $attributes = array(
                    'name'	=> 'select_product_attribute_value_id',
                    'id'	=> 'select_product_attribute_value_id',
                    'title' => "Select Role",
                    'class' => 'form-control form-control-sm',
                    'required' => 'required',

                    );
                    echo form_dropdown($attributes , $product_attributes_values , $value );
                  ?>
                <span>
                <?php echo form_error('select_product_attribute_value_id', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Combination Value', 'combination_values', $flattributes);
                $value = set_value('combination_values');
                if(empty($value)){$value = $combination_values;}
                $attributes = array(
                'name'  => 'combination_values',
                'id'  => 'combination_values',
                'value' => $value,
                'placeholder' => "Combinations Value",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',

                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('combination_values', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                  <input type="button" onclick="myFunc()" class="btn btn-primary" value="Make Combination" style="width: 100%;">
              </div>
              <div class="col-10">



                                        <label class="control-label"  for="Name">
                                           Combinations
                                           <div data-title="Created Combinations." class="ico-help icon_title_box"><i class="fa fa-question-circle"></i></div>
                                        </label>

                                        <ul id="list" style="display: inline-flex;"> </ul>

                                        <span class="field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>


                                  </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',
                'id'    => 'quantity',
                );
                echo form_label('Quantity', 'quantity', $flattributes);
                $value = set_value('quantity');
                if(empty($value)){$value = $quantity;}
                $attributes = array(
                'name'  => 'quantity',
                'id'  => 'quantity',
                'value' => $value,
                'placeholder' => "Quantity",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('quantity', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Price Excl. GST', 'price');
                $value = set_value('price');
                if(empty($value)){$value = $price;}
                $attributes = array(
                'name'  => 'price',
                'id'  => 'price',
                'value' => $value,
                'placeholder' => "Price Excl. GST",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'number',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('price', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Discounted Price Excl. GST', 'price');
                $value = set_value('discounted_price');
                if(empty($value)){$value = $discounted_price;}
                $attributes = array(
                'name'  => 'discounted_price',
                'id'  => 'discounted_price',
                'value' => $value,
                'placeholder' => "Discounted Price Excl. GST",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'number',
                'onchange'=>"discountByPrice()",
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('discounted_price', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Discount', 'discount');
                $value = set_value('discount');
                if(empty($value)){$value = $discount;}
                $attributes = array(
                'name'  => 'discount',
                'id'  => 'discount',
                'value' => $value,
                'placeholder' => "Discount",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('discount', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Discount Variable ', 'discount');
                $value = set_value('discount_var');
                $discount_vars = array(
                  'Rs'=> 'Rs. Off',
                  '%'=> ' % Off'
                );
                if(empty($value)){$value = $discount_var;}
                $attributes = array(
                'name'  => 'discount_var',
                'id'  => 'discount_var',
                'value' => $value,
                'placeholder' => "Discount Variable ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_dropdown($attributes,$discount_vars);?>
                <span>
                <?php echo form_error('discount', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Final Price ', 'final_price');
                $value = set_value('final_price');

                if(empty($value)){$value = $final_price;}
                $attributes = array(
                'name'  => 'final_price',
                'id'  => 'final_price',
                'value' => $value,
                'placeholder' => "Final Price ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('final_price', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Product Weight(In Gram)  ', 'product_weight');
                $value = set_value('product_weight');

                if(empty($value)){$value = $product_weight;}
                $attributes = array(
                'name'  => 'product_weight',
                'id'  => 'product_weight',
                'value' => $value,
                'placeholder' => "Product Weight(In Gram) ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('product_weight', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Product Dimension ( IN CM )', 'product_l');
                $value = set_value('product_l');

                if(empty($value)){$value = $product_l;}
                $attributes = array(
                'name'  => 'product_l',
                'id'  => 'product_l',
                'value' => $value,
                'placeholder' => "Length ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('product_l', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Product Dimension ( IN CM )', 'product_b');
                $value = set_value('product_b');

                if(empty($value)){$value = $product_b;}
                $attributes = array(
                'name'  => 'product_b',
                'id'  => 'product_b',
                'value' => $value,
                'placeholder' => "Breadth ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('product_b', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php

                echo form_label('Product Dimension ( IN CM )', 'product_h');
                $value = set_value('product_h');

                if(empty($value)){$value = $product_h;}
                $attributes = array(
                'name'  => 'product_h',
                'id'  => 'product_h',
                'value' => $value,
                'placeholder' => "Height ",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',
                'required' => 'required'
                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('product_h', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                	<?php
                	$attributes = array('class'=>'form-label');
                	echo form_label('Trending Now', 'trending_now1', $attributes);
                	?>
                	<div class="cupn-pubished-btn">
                		<label class="switch">
                		<?
                			$value = set_value('trending_now');
                			if(empty($value)){$value = $trending_now;}

                			//echo $value;
                			$attributes = array(
                			'name'	=> 'trending_now',
                			'id'	=> 'Active',

                			'value'	=> "1",

                			"checked" => ($value == "1") ? "checked" : false
                			);
                			echo form_checkbox($attributes);?>
                			<span class="slider round"></span>
                			<span>
                			<?php echo form_error('trending_now', '<div class="error" style="color: red">', '</div>'); ?>
                			</span>
                			</label>
                		</div>

                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                	<?php
                	$attributes = array('class'=>'form-label');
                	echo form_label('Is Hot Selling Now', 'hot_selling_now', $attributes);
                	?>
                	<div class="cupn-pubished-btn">
                		<label class="switch">
                		<?
                			$value = set_value('hot_selling_now');
                			if(empty($value)){$value = $hot_selling_now;}

                			//echo $value;
                			$attributes = array(
                			'name'	=> 'hot_selling_now',
                			'id'	=> 'Active',

                			'value'	=> "1",

                			"checked" => ($value == "1") ? "checked" : false
                			);
                			echo form_checkbox($attributes);?>
                			<span class="slider round"></span>
                			<span>
                			<?php echo form_error('hot_selling_now', '<div class="error" style="color: red">', '</div>'); ?>
                			</span>
                			</label>
                		</div>

                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                	<?php
                	$attributes = array('class'=>'form-label');
                	echo form_label('Is Best Sellers ', 'best_sellers', $attributes);
                	?>
                	<div class="cupn-pubished-btn">
                		<label class="switch">
                		<?
                			$value = set_value('best_sellers');
                			if(empty($value)){$value = $best_sellers;}

                			//echo $value;
                			$attributes = array(
                			'name'	=> 'best_sellers',
                			'id'	=> 'Active',

                			'value'	=> "1",

                			"checked" => ($value == "1") ? "checked" : false
                			);
                			echo form_checkbox($attributes);?>
                			<span class="slider round"></span>
                			<span>
                			<?php echo form_error('best_sellers', '<div class="error" style="color: red">', '</div>'); ?>
                			</span>
                			</label>
                		</div>

                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                	<?php
                	$attributes = array('class'=>'form-label');
                	echo form_label('Is New Product ', 'new_product', $attributes);
                	?>
                	<div class="cupn-pubished-btn">
                		<label class="switch">
                		<?
                			$value = set_value('new_product');
                			if(empty($value)){$value = $new_product;}

                			//echo $value;
                			$attributes = array(
                			'name'	=> 'new_product',
                			'id'	=> 'Active',

                			'value'	=> "1",

                			"checked" => ($value == "1") ? "checked" : false
                			);
                			echo form_checkbox($attributes);?>
                			<span class="slider round"></span>
                			<span>
                			<?php echo form_error('new_product', '<div class="error" style="color: red">', '</div>'); ?>
                			</span>
                			</label>
                		</div>

                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',
            'id'    => 'delivery_charges',
            );
            echo form_label('Delivery Charges', 'name', $flattributes);
            $value = set_value('delivery_charges');
            if(empty($value)){$value = $delivery_charges;}
            $attributes = array(
            'name'  => 'delivery_charges',
            'id'  => 'delivery_charges',
            'value' => $value,
            'placeholder' => "Delivery Charges Name",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',
            'required' => 'required'
            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('delivery_charges', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',
            'id'    => 'current_sold_msg',
            );
            echo form_label('Sold In Last 7 Days (In Number)', 'current_sold_msg', $flattributes);
            $value = set_value('current_sold_msg');
            if(empty($value)){$value = $current_sold_msg;}
            $attributes = array(
            'name'  => 'current_sold_msg',
            'id'  => 'current_sold_msg',
            'value' => $value,
            'placeholder' => "Sold In Last 7 Days (In Number)",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',
            'required' => 'required'
            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('current_sold_msg', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>
              </div>

              <div class="tpc-cmb-box col-12">



                                             <label class="control-label" for="Name">

                                                Combination Default Image

                                                <div data-title="Price Of This Combination." class="ico-help icon_title_box"><i class="fa fa-question-circle"></i></div>

                                             </label>

                                             <article class="row">

                                                <?

                                                   $pid_count=0;

                                                   foreach($product_image_detail as $col){$pid_count++; ?>

                                                <div class="img-checkbox demo-radio-button">
                                                	<div class="icheck-success d-inline">

                                                   <input class="radio-col-green"
                                                   <?=($col->default_image==1)? 'checked' : ''?>
                                                    name="product_image_id" id="product_image_id_<? echo $col->product_image_id; ?>" value="<? echo $col->product_image_id; ?>" <? if($pid_count==1){echo "checked";} ?> required type="radio" />

                                                   <label  for="product_image_id_<? echo $col->product_image_id; ?>">

                                                   <img id="img_product_image_id_<? echo $col->product_image_id ?>" src="<?=_uploaded_files_?>product/small/<? echo $col->product_image_name; ?>" width="80" />
                                                   </label>
</div>
                                                </div>

                                                <? } ?>

                                             </article>

                                             <span class="field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>


              </div>
              <div class="tpc-cmb-box col-4">
                <div class="form-group">

                  <?php
                  $attributes = array('class'=>'form-label');
                  echo form_label('GTIN', 'is_google_product', $attributes);
                  ?>
                  <div class="cupn-pubished-btn">
                    <label class="switch">
                    <?
                      $value = set_value('is_google_product');
                      if(empty($value)){$value = $is_google_product;}

                      //echo $value;
                      $attributes = array(
                      'name'	=> 'is_google_product',
                      'id'	=> 'is_google_product',
                      'class' => 'is_google_product',
                      'value'	=> "1",

                      "checked" => ($value == "1") ? "checked" : false
                      );
                      echo form_checkbox($attributes);?>
                      <span class="slider round"></span>
                      <span>
                      <?php echo form_error('is_google_product', '<div class="error" style="color: red">', '</div>'); ?>
                      </span>
                      </label>
                    </div>

                </div>
              </div>
              <?
              if(empty($is_google_product)){
                $display = 'none';
              }else{
                  $display = 'block';
              }
              if(empty($is_seo_tag)){
                $displayseo = 'none';
              }else{
                  $displayseo = 'block';
              }
              ?>
              <div class="tpc-cmb-box col-4 gtin_class" style="display:<?=$display?>;">
                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',
            'id'    => 'gtin',
            );
            echo form_label('Global Trade Item Number (GTIN)', 'gtin', $flattributes);
            $value = set_value('gtin');
            if(empty($value)){$value = $gtin;}
            $attributes = array(
            'name'  => 'gtin',
            'id'  => 'gtin',
            'value' => $value,
            'placeholder' => "Global Trade Item Number (GTIN)",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',

            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('name', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>
              </div>
              <div class="tpc-cmb-box col-4" >
                <div class="form-group">

                  <?php
                  $attributes = array('class'=>'form-label');
                  echo form_label('Status', 'status', $attributes);
                  ?>
                  <div class="cupn-pubished-btn">
                    <label class="switch">
                    <?
                      $value = set_value('status');
                      if(empty($value)){$value = $status;}

                      //echo $value;
                      $attributes = array(
                      'name'	=> 'status',
                      'id'	=> 'status',

                      'value'	=> "1",

                      "checked" => ($value == "1") ? "checked" : false
                      );
                      echo form_checkbox($attributes);?>
                      <span class="slider round"></span>
                      <span>
                      <?php echo form_error('status', '<div class="error" style="color: red">', '</div>'); ?>
                      </span>
                      </label>
                    </div>

                </div>
              </div>
              <div class="tpc-cmb-box col-4" >
                <div class="form-group">

                  <?php
                  $attributes = array('class'=>'form-label');
                  echo form_label('Edit SEO Tags', 'is_seo_tag', $attributes);
                  ?>
                  <div class="cupn-pubished-btn">
                    <label class="switch">
                    <?
                      $value = set_value('is_seo_tag');
                      if(empty($value)){$value = $is_seo_tag;}

                      //echo $value;
                      $attributes = array(
                      'name'	=> 'is_seo_tag',
                      'id'	=> 'is_seo_tag',

                      'value'	=> "1",

                      "checked" => ($value == "1") ? "checked" : false
                      );
                      echo form_checkbox($attributes);?>
                      <span class="slider round"></span>
                      <span>
                      <?php echo form_error('is_seo_tag', '<div class="error" style="color: red">', '</div>'); ?>
                      </span>
                      </label>
                    </div>

                </div>
              </div>

              <div class="auto_seo_combi_tags" style="display:<?=$displayseo?>">
                <? echo form_hidden('product_seo_id',$product_seo_id)?>
                <div class="tpc-cmb-box col-8">
                    <input type="button" onclick="combinationValidation('generateMeta')" class="btn btn-primary" value="Generate SEO Tags" style="width: 100%;">
                </div>
                <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Slug Url', 'slug_url', $flattributes);
                $value = set_value('slug_url');
                if(empty($value)){$value = $slug_url;}
                $attributes = array(
                'name'  => 'slug_url',
                'id'  => 'slug_url',
                'value' => $value,
                'placeholder' => "Slug Url",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',

                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('slug_url', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
                </div>
                <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Meta Title', 'meta_title', $flattributes);
                $value = set_value('meta_title');
                if(empty($value)){$value = $meta_title;}
                $attributes = array(
                'name'  => 'meta_title',
                'id'  => 'meta_title',
                'value' => $value,
                'placeholder' => "Meta Title",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',

                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('meta_title', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
                </div>
                <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Meta Description', 'meta_description', $flattributes);
                $value = set_value('meta_description');
                if(empty($value)){$value = $meta_description;}
                $attributes = array(
                'name'  => 'meta_description',
                'id'  => 'meta_description',
                'value' => $value,
                'placeholder' => "Meta Description",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',

                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('meta_description', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
                </div>
                <div class="tpc-cmb-box col-4">
                <div class="form-group">
                    <?php
                    $flattributes = array(
                'class' => 'form-label',

                );
                echo form_label('Meta Keyword', 'meta_keyword', $flattributes);
                $value = set_value('meta_keyword');
                if(empty($value)){$value = $meta_keywords;}
                $attributes = array(
                'name'  => 'meta_keywords',
                'id'  => 'meta_keyword',
                'value' => $value,
                'placeholder' => "Meta Keyword",
                'autofocus' => 'autofocus',
                'class' => 'form-control form-control-sm',
                'type' => 'text',

                );
                echo form_input($attributes);?>
                <span>
                <?php echo form_error('meta_keyword', '<div class="error" style="color: red">', '</div>'); ?>
                </span>
                </div>
                </div>
              </div>



        </div>
        <div class="tpci-bottom">
                  <div class="tpbt-inner">

                      <button  type="button"class="btn1 bg-ff apc-cancel">Cancel</button>
                      <button class="btn2" type="submit" name="save"> Save</button>
                  </div>
              </div>
            <?echo form_close();?>
    </div>


</div>
<script>

   function myFunc(){

    event.preventDefault()

    var ul= document.getElementById("list");

    var select_product_attribute_id = document.getElementById('select_product_attribute_id').value;

    var select_product_attribute_value_id = document.getElementById('select_product_attribute_value_id').value;

    var combination_values = document.getElementById('combination_values').value;

    var select_product_attribute_text = $("#select_product_attribute_id option:selected").text();

    var select_product_attribute_value_text = $("#select_product_attribute_value_id option:selected").text();

    var val = select_product_attribute_text + " : " +  combination_values + " " + select_product_attribute_value_text + '  ';

    if(select_product_attribute_id>0 && select_product_attribute_value_id>0)

    {

      var condition_per_product_count = 0;

      var select_product_attribute_condition_per_product = getAttributePerProduct(select_product_attribute_id);

      var select_product_attribute_condition_per_product_count = document.getElementsByName('product_attribute_id[]');

      for(a=0;a<select_product_attribute_condition_per_product_count.length ; a++){

        if(select_product_attribute_condition_per_product_count[a].value==select_product_attribute_id)

        condition_per_product_count++;

      }

      //alert(select_product_attribute_condition_per_product+" : "+condition_per_product_count);

      if(condition_per_product_count>=select_product_attribute_condition_per_product)

      {

        alert("You Can Not Create More Than "+select_product_attribute_condition_per_product+" Combination of Selected Attribute.");

        return false;

      }



      var li = document.createElement("li");

      if(val.trim()!=''){

        li.appendChild(document.createTextNode(val ));

        li.innerHTML = val+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img width="22px" height="22px" src="<?=_admin_files_."img/cancel.png" ?>" /> <input type="hidden" name="product_attribute_id[]" value="'+select_product_attribute_id+'" /><input type="hidden" name="combination_value[]" value="'+combination_values+'" /><input type="hidden" name="product_attribute_value_id[]" value="'+select_product_attribute_value_id+'"  />';

        li.setAttribute("onclick", "$(this).remove();");
        li.setAttribute("class", "combination_list_items");

        ul.appendChild(li);

        document.getElementById('combination_values').value='';

      }

      var a=0;

      var color = '#f00';

      for(a=0;a<ul.getElementsByTagName("li").length ; a++){

        if(a==ul.getElementsByTagName("li").length-1){color="#00f";}

        ul.getElementsByTagName("li")[a].style.color=color;

      }



      $('li', ul).each(function() {

        if($('li:contains("' + $(this).text() + '")', ul).length > 1)

          $(this).remove();

      });

    }

   }

   function getAttributePerProduct(attribute_value)

   {

    <? foreach($product_attribute_list as $col){ ?>

      if(attribute_value==<? echo $col->id; ?>)

        return "<? echo $col->condition_per_product; ?>";

    <? } ?>

    else return 1;

   }
   function combinationValidation(val='')

                        {

              window.scrollTo(0, 20);

                         var t_product_attribute_id = document.getElementsByName('product_attribute_id[]');

                         var t_combination_value = document.getElementsByName('combination_value[]');

                         var t_product_attribute_value_id = document.getElementsByName('product_attribute_value_id[]');



                         var discounted_price = document.getElementById("discounted_price");

                         var product_display_name = document.getElementById("product_display_name");

                         var price = document.getElementById("price");

                         var final_price = document.getElementById("final_price");

                         var discount = document.getElementById("discount");

                         var discount_var = document.getElementById("discount_var");

                         var temp=document.getElementById("price");

                         var t_product_image_id = document.getElementsByName('product_image_id');

                         var t_product_image_id = document.getElementsByName('product_image_id');



                         var meta_keyword = document.getElementById('meta_keyword');

                         var meta_description = document.getElementById('meta_description');

                         var meta_title = document.getElementById('meta_title');

                         var slug_url = document.getElementById('slug_url');

                         var is_seo_tag = document.querySelector('input[name="is_seo_tag"]:checked').value;





                         const slug_url_only = string => [...string].every(c => '0123456789abcdefghijklmnopqrstuvwxyz-.ABCDEFGHIJKLMNOPQRSTUVWXYZ'.includes(c));



                         if(val==1 || val==3){

                           event.preventDefault();

                           if(discount_var.value=='Rs')

                           {

                             final_price.value = Number(price.value)-Number(discount.value);

                           }

                           else if(discount_var.value=='%')

                           {



                             if(discounted_price.value != '' && discounted_price.value>0)

                             {

                               //discount_var.value = '%';

                               final_price.value = Number(discounted_price.value);

                               var dv = ((Number(price.value) - Number(final_price.value))/Number(price.value))*Number(100);

                               dv = dv.toFixed(2);

                               dv = dv.replace(/\.00$/,'');

                               discount.value = dv;

                             }

                             else if(discount.value=='' && discount.value==0){

                               final_price.value = price.value;

                             }

                             else

                             {

                               var fp_temp = Number(price.value)-((price.value)*Number(discount.value)/100) ;

                               //var fp_temp = parseFloat(fp_temp.toFixed(1));



                               final_price.value = fp_temp;

                             }

                           }

                           else

                           {

                             final_price.value = price.value;

                           }

                           if(Number(price.value) < Number(final_price.value) || Number(final_price.value)<0)

                           {

                             alert("Final Price Cannot be less than price or 0");

                             return false;

                           }

                           return false;

                         }

                         else if(document.getElementsByName('product_attribute_id[]').length<=0)

                         {

                           alert("Create Atleast One Combination ");

                           return false;

                         }







                         if(product_display_name.value == '' || product_display_name.value == '')

                         {

                           alert("Please Provide Product Display Name");

                           product_display_name.focus();

                           return false;

                         }

                         if(discount.value == '' || discount.value == '')

                         {

                           document.getElementById("discount_var").required = false;

                           document.getElementById("discount").required = false;

                         }

                         if((discount.value != '' || discount.value == '') && (discount.value == '' || discount.value != ''))

                         {

                           document.getElementById("discount_var").required = true;

                           document.getElementById("discount").required = true;

                           //return false;

                         }

                         else

                         {

                           document.getElementById("discount_var").required = true;

                           document.getElementById("discount").required = true;

                         }

                         if(discount_var.value=='Rs')

                         {

                           final_price.value = Number(price.value)-Number(discount.value);

                         }

                         else if(discount_var.value=='%')

                         {

                           if(discounted_price.value != '' && discounted_price.value>0)

                           {

                             //discount_var.value = '%';

                             final_price.value = Number(discounted_price.value);

                             var dv = ((Number(price.value) - Number(final_price.value))/Number(price.value))*Number(100);

                             dv = dv.toFixed(2);

                             dv = dv.replace(/\.00$/,'');

                             discount.value = dv;

                           }

                           else if(discount.value==''){

                               final_price.value = price.value;

                             }

                           else

                           {

                             var fp_temp = Number(price.value)-((price.value)*Number(discount.value)/100) ;

                             //var fp_temp = parseFloat(fp_temp.toFixed(1));



                             final_price.value = fp_temp;

                           }

                         }

                         else

                         {

                           final_price.value = price.value;

                         }

                         if(Number(price.value) < Number(final_price.value) || Number(final_price.value)<0)

                         {

                           alert("Final Price Cannot be less than price or 0");

                           return false;

                         }//ProductAttributeForm product_combination_id product_id comb_slug_url

                         var pid_check = true;

                         for(var ii=0 ; ii< t_product_image_id.length ; ii++)

                         {

                           if(t_product_image_id[ii].checked)

                           {

                             pid_check = false;

                           }

                         }



                         if(pid_check)

                         {

                           alert("Please select the default image for this combination.");

                           return false;

                         }



                         if(val=='generateMeta'){



                           generate_auto_seo_tags();

                           return false;

                         }





                         var form = document.getElementById('ProductAttributeForm');

                         //console.log(form.elements);

                         for(var i=0; i < form.elements.length; i++){

                              if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){

                             form.elements[i].focus();

                                alert(form.elements[i].name + ' is required fields!');

                                return false;

                              }

                            }





                         if(is_seo_tag==1)

                         {

                           if(slug_url.value == '')

                           {

                             alert("Please Enter Slug Url");

                             slug_url.focus();

                             return false;

                           }

                           if(!slug_url_only(slug_url.value))

                           {

                             alert("Slug Url Contains Only A-Z a-z 0-9 '.' and '-' only. without space");

                             slug_url.focus();

                             return false;

                           }



                           if(meta_title.value == '')

                           {

                             alert("Please Enter Meta Title");

                             meta_title.focus();

                             return false;

                           }

                           var meta_title_val = meta_title.value;



                           if(meta_title_val.length > 60)

                           {

                             alert("Meta Title alphabet count should not be greater than 60 characters");

                             meta_title.focus();

                             return false;

                           }



                           if(meta_description.value == '')

                           {

                             alert("Please Enter Meta Description");

                             meta_description.focus();

                             return false;

                           }



                           var meta_description_val = meta_description.value;



                           if(meta_description_val.length > 160)

                           {

                             alert("Meta Description alphabet count should not be greater than 160 characters");

                             meta_description.focus();

                             return false;

                           }



                           if(meta_keyword.value == '')

                           {

                             alert("Please Enter Meta Keywords");

                             meta_keyword.focus();

                             return false;

                           }

                         }





                         event.preventDefault();

                         console.log(Array.from(t_product_attribute_id));

                         console.log(Array.from(t_product_attribute_value_id));

                         console.log(Array.from(t_combination_value));

                         var form_obj = $('#ProductAttributeForm');

                        //, "t_product_attribute_id" : t_product_attribute_id, "t_product_attribute_value_id" : t_product_attribute_value_id, "t_combination_value" : t_combination_value



                         $.ajax({

                                type: "POST",

                               url:'<? echo MAINSITE_Admin ?>catalog/Product-Module/checkProductCombinationCombiRefCode',

                                dataType : "json",

                                <?php /*?>data : {"product_id" : document.getElementById('product_id').value , "combref_code" : document.getElementById('combref_code').value, "product_combination_id" : document.getElementById('product_combination_id').value, "t_product_attribute_id" : Array.from(t_product_attribute_id), "t_product_attribute_value_id" : Array.from(t_product_attribute_value_id), "t_combination_value" : Array.from(t_combination_value) },<?php */?>

                                data: form_obj.serialize(),

                                success : function(result){

                                 //alert(result);

                                 if(result.position_status=='')

                                 {

                                   if(document.getElementById('product_combination_id').value>0)

                                   {

                                     alert("Kindly update the Product SEO Settings is required.");

                                   }

                                   $('.loader').show();

                                   if(val==1){}



                                   else

                                   {

                                     document.ProductAttributeForm.submit();

                                   }

                                 }

                                 else{

                                   if(result.position_status=='exist')

                                   {

                                     alert("The Product reference code is already in database");

                                     document.getElementById('combref_code').focus();

                                   }

                                   if(result.position_status=='combi_duplicate')

                                   {
                                     alert("The Product combination is already in database");
                                     document.getElementById('select_product_attribute_id').focus();
                                   }
                                   if(result.position_status=='slug_duplicate')

                                   {
                                     alert("The Product slug Url is already in database");
                                     document.getElementById('slug_url').focus();
                                   }
                                 }
                                 }
                                });

          }


                           function generate_auto_seo_tags()

                           {

                            //alert("func call");

                            var final_price = document.getElementById("final_price");

                            var product_display_name = document.getElementById('product_display_name');

                            var combi = "";



                            var meta_keyword = document.getElementById('meta_keyword');

                            var meta_description = document.getElementById('meta_description');

                            var meta_title = document.getElementById('meta_title');

                            var slug_url = document.getElementById('slug_url');





                            $slug_url = "#product_name#-#combi#";



                            //$title = "#product_name# - #combi# in India | Buy #product_name# #combi# Online At Best Price at seasonkart.com | #category#";

                            $title = "#product_name# - #combi# in India";



                            $keyword = "#product_name# - #combi# Price, #product_name#, Buy #product_name# Online";



                            //$description = "Buy #product_name# - #combi# for Rs.#price# online. #product_name# at best prices with FREE shipping & cash on delivery. Only Genuine Products";

                            $description = "Buy #product_name# - #combi# for Rs.#price# online. #product_name# at best prices with FREE shipping & cash on delivery.";



                            $slug_url = $slug_url.replace("#category#", "<?=$autoMetaCategory?>");

                            $title = $title.replace("#category#", "<?=$autoMetaCategory?>");

                            $keyword = $keyword.replace("#category#", "<?=$autoMetaCategory?>");

                            $description = $description.replace("#category#", "<?=$autoMetaCategory?>");



                            $slug_url = replaceAll($slug_url , "#product_name#", product_display_name.value);

                            $title = replaceAll($title , "#product_name#", product_display_name.value);

                            $keyword = replaceAll($keyword , "#product_name#", product_display_name.value);

                            $description = replaceAll($description , "#product_name#", product_display_name.value);



                            $slug_url = replaceAll($slug_url , "#price#", final_price.value);

                            $title = replaceAll($title , "#price#", final_price.value);

                            $keyword = replaceAll($keyword , "#price#", final_price.value);

                            $description = replaceAll($description , "#price#", final_price.value);





                              $('#list li').each(function(){

                                var myText = $(this).text();

                                combi = combi.concat(' '+myText);

                                combi = combi.trim();

                              });



                            $slug_url = replaceAll($slug_url , "#combi#", combi);

                            $title = replaceAll($title , "#combi#", combi);

                            $keyword = replaceAll($keyword , "#combi#", combi);

                            $description = replaceAll($description , "#combi#", combi);



                            //$slug_url = encodeURI($slug_url);



                            $slug_url = replaceAll($slug_url, ' ', '-')

                            $slug_url = replaceAll($slug_url, ':', '-')

                            $slug_url = replaceAll($slug_url, '--', '-')

                            $slug_url = replaceAll($slug_url, '--', '-')

							$slug_url = $slug_url.replace(/[^a-zA-Z 0-9 & -]/g, "");

                            var text = $slug_url;




                            slug_url.value = text.toLowerCase($slug_url);

                            meta_title.value = $title;
							var meta_title_count = meta_title.value.substring(0, 60);
							meta_title.value = meta_title_count;

                            meta_description.value = $description;
							var meta_description_count = meta_description.value.substr(0, 160);
							meta_description.value = meta_description_count;

                            meta_keyword.value = $keyword;







                           }
                           function replaceAll(str, find, replace)

                          {

                            return str.replace(new RegExp(find, 'g'), replace);

                          }

                           function discountByPrice()

                           {

                            var discounted_price = document.getElementById("discounted_price");

                            var product_display_name = document.getElementById("product_display_name");

                            var price = document.getElementById("price");

                            var final_price = document.getElementById("final_price");

                            var discount = document.getElementById("discount");

                            var discount_var = document.getElementById("discount_var");

                            var temp=document.getElementById("price");

                            if(discounted_price.value == '')

                            {

                              return false;

                            }



                            if(Number(discounted_price.value) > Number(price.value))

                            {

                              alert("Final Price Cannot be less than price or 0");

                              return false;

                            }



                            discount_var.value = '%';

                            final_price.value = Number(discounted_price.value);

                            var dv = ((Number(price.value) - Number(final_price.value))/Number(price.value))*Number(100);

                            dv = dv.toFixed(2);

                            dv = dv.replace(/\.00$/,'');

                            discount.value = dv;



                           }


function setGtin()
{

	if($("#is_google_product").is(":checked"))
	{

		$(".gtin_class").show();
		$("#gtin").attr("required", true);
	}
	else
	{
		$(".gtin_class").hide();
		$("#gtin").attr("required", false);
		document.getElementById('gtin').value = '';
	}
}
<?
if(!empty($select_product_attribute_id)){
  ?>
  myFunc();
  <?
}

?>
   </script>
