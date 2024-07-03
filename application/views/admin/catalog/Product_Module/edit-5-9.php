<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<?
$name =    $ref_code = $hsn_code = $long_description = $short_description =  $meta_keyword = $meta_description =  $condition_per_product = "";
$id= $brand_id = $tax_id =  $super_category_id =   0;
$status= $is_bulk_enquiry = 1;
   $category_id_arr = array();
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	//$product_attribute_id = $list_data->product_attribute_id;
	$name = $list_data->product_name;
	$status = $list_data->status;
	$ref_code = $list_data->ref_code;
	$hsn_code = $list_data->hsn_code;

	$short_description = $list_data->short_description;
	$is_bulk_enquiry = $list_data->is_bulk_enquiry;
	$long_description = $list_data->long_description;
	$tax_id = $list_data->tax_id;
	$brand_id = $list_data->brand_id;

}
if(!empty($product_category_detail)){

	 foreach($product_category_detail as $row){

		 $category_id_arr[]=$row->category_id;

	 }
 }
?>
<?
  //print_r($list_data);
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<div class="tpi-add-attr">
    <div class="tpa-conp-inner">

        <div class="tpci-head">
            <div class="tpci-row-one">
                <div class="tpci-ro-inner">
                    <div class="tpci-roi-l">
                    <h4><?=$page_type_action?> <?=$page_module_name?></h4>
                    </div>
                    <div class="tpci-roi-r">
                        <span class="tpa-conp-close"><i
                                class="fa-solid fa-xmark"></i></span>
                    </div>
                </div>
            </div>
            <div class="tpci-row-varient">
                <div class="tpci-varient-inner">

                </div>
            </div>
            <div class="tpci-row-tabber">
                <ul class="nav nav-pills mb-3" id="ex3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="ex3-tab-1"
                            data-bs-toggle="pill" href="#ex3-pills-1" role="tab"
                            aria-controls="ex3-pills-1" aria-selected="false"
                            tabindex="-1">Basic Info</a>
                    </li>
										<?
										if(!empty($id)){
											?>
											<li class="nav-item" role="presentation">
													<a class="nav-link" id="ex3-tab-2" data-bs-toggle="pill"
															href="#ex3-pills-2" role="tab"
															aria-controls="ex3-pills-2" aria-selected="false"
															tabindex="-1">Combination</a>
											</li>
											<li class="nav-item" role="presentation">
													<a class="nav-link" id="ex3-tab-3" data-bs-toggle="pill"
															href="#ex3-pills-3" role="tab"
															aria-controls="ex3-pills-3" aria-selected="false"
															tabindex="-1">Gallary</a>
											</li>
											<?
										}
										?>

                </ul>
            </div>
        </div>

        <div class="tpci-tab-con">
            <div class="tab-content" id="ex3-content">
                <div class="tab-pane active show" id="ex3-pills-1" role="tabpanel"
                    aria-labelledby="ex3-tab-1">
                    <div class="tpci-tab-con">
                        <div class="ttc-pro-inner ">
              <div class="ttc-pro-inner">
                <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doEdit", array('method' => 'post', 'id' => 'product_form' , 'onsubmit'=>'return  saveModule(this)', "name"=>"form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

                <?php $value = set_value('id'); if(empty($value)){$value = $id;}$attributes = array('name'  => 'id', 'id'  => 'id', 'value' => $value, 'type' => 'hidden' ); echo form_input($attributes);?>

                <?php $attributes = array('name'  => 'redirect_type', 'id'  => 'redirect_type', 'value' => '', 'type' => 'hidden' ); echo form_input($attributes);?>


                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',

            );
            echo form_label($page_module_name, 'name', $flattributes);
            $value = set_value('name');
            if(empty($value)){$value = $name;}
            $attributes = array(
            'name'  => 'name',
            'id'  => 'name',
            'value' => $value,
            'placeholder' => "$page_module_name Name",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',
            'required' => 'required'
            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('name', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>

                    <div class="form-group">
                      <?php
                                echo form_label('Brand', 'brand_id');
                                ?>
                                <?php
                                $value = set_value('brand_id');
                                        if(!empty($value)){$brand_id = $value; }
                                        if(empty($value)){$value = $brand_id;}
                                  $attributes = array(
                                  'name'	=> 'brand_id',
                                  'id'	=> 'brand_id',

                                  'class' => 'form-control form-control-sm',
                                  'required' => 'required',

                                  );
                                  echo form_dropdown($attributes , $brands , $value );
                                ?>
                                <span>
                                        <?php echo form_error('brand_id', '<div class="error" style="color: red">', '</div>'); ?>
                                    </span>
                    </div>

                        <div class="form-group">
                          <?php
                                    echo form_label('Tax', 'tax_id');
                                    ?>
                                    <?php
                                    $value = set_value('tax_id');
                                            if(!empty($value)){$tax_id = $value; }
                                            if(empty($value)){$value = $tax_id;}
                                      $attributes = array(
                                      'name'	=> 'tax_id',
                                      'id'	=> 'tax_id',

                                      'class' => 'form-control form-control-sm',
                                      'required' => 'required',

                                      );
                                      echo form_dropdown($attributes , $taxs , $value );
                                    ?>
                                    <span>
                                            <?php echo form_error('tax_id', '<div class="error" style="color: red">', '</div>'); ?>
                                        </span>
                        </div>
                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',
            'id'    => 'name',
            );
            echo form_label('Product Short Description', 'short_description', $flattributes);
            $value = set_value('short_description');
            if(empty($value)){$value = $short_description;}
            $attributes = array(
            'name'  => 'short_description',
            'id'  => 'short_description',
            'value' => $value,
            'placeholder' => "Product Short Description",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'rows' => '3',
            'required' => 'required'
            );
            echo form_textarea($attributes);?>
            <span>
            <?php echo form_error('short_description', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>
                <div class="form-group">
                    <?php
                    $flattributes = array(
            'class' => 'form-label',
            'id'    => 'name',
            );
            echo form_label('Select Category Name', 'is_bulk_enquiry', $flattributes);
            ?>

						<div class="tcp-ctg">
						<ul class="tree">
							<li >
									<details open>

											<summary>New Parent Category</summary>

											<ul>
														<?

						foreach($category_list as $row1)
						{
						if($row1->super_category_id==0)
						{
						?>


							<?
										$liClassExpend=''; $liClass = ''; $liFolderCount=0;
										foreach($category_list as $row2)
										{

										if(in_array($row2->id , $category_id_arr ))
												$liClassExpend = 'open';
											if($row2->super_category_id==$row1->id)
												$liFolderCount++;
										}
										if($liFolderCount>0)
										{
											$liClass = 'isFolder';
										}
										if($liClass == 'isFolder'){
											?>
											<li>
										<details <?=$liClassExpend?>>
														<summary><input type="checkbox" style="width:20%" name="category_id[]" value="<? echo $row1->id; ?>" <? if(in_array($row1->id , $category_id_arr ))echo "checked";else echo ""; ?> id="" class="tree-cb"><? echo $row1->name; ?>
															</summary>
															<? foreach($category_list as $row3){

																				if($row3->super_category_id==$row1->id){

																				 ?>

																				<? $liClassExpend='';$liClass = ''; $liFolderCount=0;foreach($category_list as $row4){if(in_array($row4->id , $category_id_arr ))$liClassExpend = 'open';if($row4->super_category_id==$row3->id)$liFolderCount++;}if($liFolderCount>0){$liClass = 'isFolder';} ?>
																				<?
																				if($liClass == 'isFolder'){
																					?>
																					<ul>
																							<li>
																				<details <?=$liClassExpend?>>
																								<summary><input type="checkbox" style="width:20%" value="<? echo $row3->id; ?>"<? if(in_array($row3->id , $category_id_arr ))echo "checked";else echo ""; ?> name="category_id[]" id="" class="tree-cb"><? echo $row3->name; ?>
																									</summary>
																									<?
																				}

																				?>
																					 <ul>

																							<? foreach($category_list as $row5){ //echo "<pre>"; print_r($category_list); echo "</pre>";

																								 if($row5->super_category_id==$row3->id){

																									 ?>

																							<li><input type="checkbox" style="width:20%" value="<? echo $row5->id; ?>" name="category_id[]" id="" <? if(in_array($row5->id , $category_id_arr ))echo "checked";else echo ""; ?> class="tree-cb"><? echo $row5->name; ?></li>

																							<? }
																						} ?>

																					 </ul>
																					 <?
																					 if($liClass == 'isFolder'){
																						 ?>

																					 </details>
																				 </li>
																					</ul>
																						 <?
																					 }else{
																						 ?>
																							 <li>
																							 <input type="checkbox" value="<? echo $row3->id; ?>" <? if(in_array($row3->id , $category_id_arr ))echo "checked";else echo ""; ?> style="width:20%" name="category_id[]" id="" class="tree-cb"><? echo $row3->name; ?>

																						 </li>
																						 <?
																					 }
																						 ?>


																		 <? }} ?>
																	 </li>
											<?
										}else{
											?>
												<li>
												<input type="checkbox" style="width:20%" value="<? echo $row1->id; ?>" <? if(in_array($row1->id , $category_id_arr ))echo "checked";else echo ""; ?> name="category_id[]" id="" class="tree-cb"><? echo $row1->name; ?>

											</li>
											<?
										}
									?>
								<?
								if($liClass == 'isFolder'){
									?>
								</details>
								<li>
								</ul>
									<?
								}
								?>

						<?
						}
						}
						?>
						</details>
						</li>
						</ul>

						</div>
            <span>
            <?php echo form_error('name', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
                </div>

            <div class="form-group">

              <?php
              $attributes = array('class'=>'form-label');
              echo form_label('Bulk Enquiry', 'is_bulk_enquiry', $attributes);
              ?>
              <div class="cupn-pubished-btn">
                <label class="switch">
                <?
                  $value = set_value('is_bulk_enquiry');
                  if(empty($value)){$value = $is_bulk_enquiry;}

                  //echo $value;
                  $attributes = array(
                  'name'	=> 'is_bulk_enquiry',
                  'id'	=> 'Active',

                  'value'	=> "1",

                  "checked" => ($value == "1") ? "checked" : false
                  );
                  echo form_checkbox($attributes);?>
                  <span class="slider round"></span>
                  <span>
                  <?php echo form_error('is_bulk_enquiry', '<div class="error" style="color: red">', '</div>'); ?>
                  </span>
                  </label>
                </div>

            </div>
            <div class="form-group">
                <?php
                $flattributes = array(
            'class' => 'form-label',
            'id'    => 'cover_image',
            );
            echo form_label('Cover Image', 'cover_image', $flattributes);
            ?>
            <div class="upload__box">
                      <div class="upload__btn-box">
                        <label class="upload__btn">
                            <p>Upload image</p>
                            <?
                            $value = set_value('image');

                            $attributes = array(
                            'name'  => 'image[]',
                            'id'  => 'image',
                            'class' => 'upload__inputfile',
                            'type' => 'file',
                            'multiple' => 'multiple',
                            // 'required' => 'required'
                            );
                            echo form_input($attributes);?>
                            <!-- <input type="file" data-max_length="20" class="upload__inputfile"> -->
                          </label>
                    </div>
              <div class="upload__img-wrap"></div>
            </div>

            <span>
            <?php echo form_error('image', '<div class="error" style="color: red">', '</div>'); ?>
            </span>

            </div>

            <div class="form-group">
                <?php
                $flattributes = array(
            'class' => 'form-label',

            );
            echo form_label('Reference Code', 'ref_code', $flattributes);
            $value = set_value('ref_code');
            if(empty($value)){$value = $ref_code;}
            $attributes = array(
            'name'  => 'ref_code',
            'id'  => 'ref_code',
            'value' => $value,
            'placeholder' => "Reference Code",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',
            'onblur' => 'checkProductRefCode()',
            'required' => 'required'
            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('ref_code', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
            </div>
            <div class="form-group">
                <?php
                $flattributes = array(
            'class' => 'form-label',

            );
            echo form_label('HSN Code', 'hsn_code', $flattributes);
            $value = set_value('hsn_code');
            if(empty($value)){$value = $hsn_code;}
            $attributes = array(
            'name'  => 'hsn_code',
            'id'  => 'hsn_code',
            'value' => $value,
            'placeholder' => "HSN Code",
            'autofocus' => 'autofocus',
            'class' => 'form-control form-control-sm',
            'type' => 'text',
            'required' => 'required'
            );
            echo form_input($attributes);?>
            <span>
            <?php echo form_error('hsn_code', '<div class="error" style="color: red">', '</div>'); ?>
            </span>
            </div>
            <div class="form-group">
                <?php
                $flattributes = array(
            'class' => 'form-label',

            );
            echo form_label('Long Description', 'long_description', $flattributes);
          ?>
            </div>
            <div class="col-12">
              <?
              $value = set_value('long_description');
              if(empty($value)){$value = $long_description;}
              $attributes = array(
              'name'  => 'long_description',
              'id'  => 'long_description',
              'value' => $value,
              'placeholder' => "Long Description",
              'autofocus' => 'autofocus',
              'class' => 'form-control form-control-sm search_textbox ckeditor',
              'rows' => '3',
              'onblur' => 'setLongdescription()',
              'required' => 'required'
              );
              echo form_textarea($attributes);?>
              <span>
              <?php echo form_error('long_description', '<div class="error" style="color: red">', '</div>'); ?>
              </span>
            </div>
            <br>
            <div class="form-group">

              <?php
              $attributes = array('class'=>'form-label');
              echo form_label('Status', 'status1', $attributes);
              ?>
              <div class="cupn-pubished-btn">
                <label class="switch">
                <?
                  $value = set_value('status');
                  if(empty($value)){$value = $status;}

                  //echo $value;
                  $attributes = array(
                  'name'	=> 'status',
                  'id'	=> 'Active',

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
            <div class="tpci-bottom">
            <div class="tpbt-inner">
            		<button  type="button"class="btn1 bg-ff tpc-cancel">Cancel</button>
            		<button class="btn2" type="submit" name="save"> Save</button>
            </div>
            </div>
            <?php echo form_close() ?>
              </div>
            </div>
            </div>
                    </div>
                    <div class="tab-pane" id="ex3-pills-3" role="tabpanel"
                        aria-labelledby="ex3-tab-3">
                        <div class="tpci-tab-con">
                          <div class="product-update-gallary">
                               <div class="puc-inner">
                                   <div class="tpi-title">
                                       <h4>Product Gallary</h4>
                                   </div>

                                   </div>
                                   <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doAddProductImages", array('method' => 'post', 'id' => 'ptype_search_form' , "name"=>"ptype_search_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

                                   <div class="tpi-filter-row">
                                       <div class="tfr-inner">
                                           <!-- <div class="tfr-box"> -->
                                           <div class="tfrb-search">
                                             <label class="upload__btn">
                                                 <p>Upload images</p>

                                                 <?
                                                 $value = set_value('image');
                                                 $attributes = array(
                                                 'name'  => 'image[]',
                                                 'id'  => 'image',
                                                 'class' => 'upload__inputfile',
                                                 'type' => 'file',
                                                 'multiple' => 'multiple',
                                                 // 'required' => 'required'
                                                 );
                                                 echo form_input($attributes);?>
                                                 <?echo form_hidden('product_id',$id)?>
                                                   </label>
                                           </div>
                                           <div class="tfrb-btn">
                                             <?php
                                             $data = [
                                                 'name'    => 'search_report_btn',
                                                 'id'      => 'search_report_btn',
                                                 'value'   => '1',
                                                 'type'    => 'submit',
                                                 'content' => 'Add Images',
                                                 'class' => 'btn2'
                                               ];

                                               echo form_button($data);
                                             ?>

                                           </div>
                                           <!-- </div> -->
                                       </div>
                                   </div>
                                   <?php echo form_close() ?>
                                 </div>
                                 <div class="tpi-product-table">
                                     <div class="tpt-inner">
                                         <table>
                                             <thead>
                                                 <tr>
                                                     <td class="px-4 py-2">Image</td>
                                                     <!-- <td class="px-4 py-2">Position</td> -->
                                                     <td class="px-4 py-2 text-center">ACTIONS</td>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                               <?
                                               //print_r($product_image_detail);
                                               if(isset($product_image_detail) && !empty($product_image_detail)){
                                                 ?>
                                                 <?php foreach ($product_image_detail as $row ): ?>
                                                   <tr>
                                                       <td class="px-4 py-2">
                                                           <div class="">

                                                             <a href="<?=_uploaded_files_.'product/small/'.$row->product_image_name ?>" target="_blank">
                                                               <img src="<?=_uploaded_files_.'product/small/'.$row->product_image_name?>" alt="product">

                                                             </a>

                                                           </div>
                                                       </td>
                                                          <!-- <td class="px-4 py-2">
                                                          </td> -->
                                                       <td class="px-4 py-2">
                                                           <div class="tpt-action-btn">
                                                               <div class="cup-edit">
                                                                 <a href="<?=_uploaded_files_.'product/small/'.$row->product_image_name ?>" target="_blank">
                                                                   <i class="fa-solid fa-eye"></i>
                                                                 </a>
                                                                   <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doDeleteImage", array('method' => 'post', 'id' => 'ptype_search_form' , "name"=>"ptype_search_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                                                                      <?php echo form_hidden('product_image_id',$row->product_image_id) ?>
                                                                      <?php echo form_hidden('product_id',$id) ?>
                                                                      <button type="submit" name="button"><i class="fa fa-trash"></i>Delete</button>
                                                                    <?php echo form_close() ?>
                                                               </div>
                                                           </div>
                                                       </td>
                                                   </tr>
                                                 <?php endforeach; ?>
                                                 <?
                                               }

                                               ?>


                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                               </div>
                             </div>
                             <div class="tab-pane" id="ex3-pills-2" role="tabpanel"
                                 aria-labelledby="ex3-tab-2">
                                 <div class="tpci-tab-con">
                                  <div class="product-update-combination">
                                       <div class="puc-inner">
                                           <div class="tpi-title">
                                               <h4>Product Combination</h4>
                                           </div>
                                           <div class="tpi-product-row">
                                               <div class="tpi-pr-inner justify-content-end">

                                                   <div class="tpi-pri-r">
                                                       <div class="tpi-cate-add">
                                                           <a href="#" class="btn2 category-add apc-add" onclick="editCombination('<?=MAINSITE_Admin.$user_access->class_name?>',0,<?=$id?>)"><i class="fa-solid fa-plus"></i>
                                                               Add Product Combinations</a>
                                                       </div>

                                                   </div>
                                               </div>
                                           </div>
                                           <div class="tpi-product-table">
                                               <div class="tpt-inner">
                                                   <table>
                                                       <thead>
                                                           <tr>
                                                               <td class="px-4 py-2">PRODUCT NAME</td>
                                                               <td class="px-4 py-2">COMBINATION</td>
                                                               <td class="px-4 py-2">PRICE</td>
                                                               <td class="px-4 py-2">SALE PRICE</td>
                                                               <td class="px-4 py-2">Quantity</td>
                                                               <td class="px-4 py-2">STATUS</td>
                                                               <td class="px-4 py-2 text-center">ACTIONS</td>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                         <?
                                                        //  echo "<pre>";
                                                        //  print_r($product_combination_detail);
                                                        // echo "</pre>";
                                                         if(isset($product_combination_detail) && !empty($product_combination_detail)){
                                                           ?>
                                                           <?php foreach ($product_combination_detail as $row ): ?>
                                                             <tr>
                                                                 <td class="px-4 py-2">
                                                                     <div class="tpi-pdd">
                                                                       <?
                                                                       foreach($product_image_detail as $col){if($col->product_image_id == $row->product_image_id){$img_name=$col->product_image_name;}}
                                                                       ?>
                                                                       <a href="<?=_uploaded_files_.'product/small/'.$img_name ?>" target="_blank"></a>
                                                                         <img src="<?=_uploaded_files_.'product/small/'.$img_name ?>" alt="product">
                                                                         <span><?=$row->product_display_name?></span>
                                                                     </div>
                                                                 </td>
                                                                 <?
                                                                 $show = '';
                                                                 foreach($product_combination_attribute_detail as $col)
                                                                   {
                                                                     if($col->product_combination_id==$row->id)
                                                                     {
                                                                       $attribute = '';
                                                                       $attribute_val = '';
                                                                       foreach($product_attribute_list as $col1){if($col1->product_attribute_id==$col->product_attribute_id){$attribute=$col1->name;}}
                                                                       foreach($attribute_value_list as $col1){if($col1->product_attribute_value_id==$col->product_attribute_value_id){$attribute_val=$col1->name;}}
                                                                       $show.="$attribute : $col->combination_value $attribute_val<br>";
                                                                     }
                                                                   }
                                                                 ?>
                                                                 <td class="px-4 py-2">
                                                                     <span class="tpt-categories">
                                                                         <?=$show?>
                                                                     </span>
                                                                 </td>
                                                                 <td class="px-4 py-2">
                                                                     <span class="tpt-price">
                                                                         <b><?=$row->price?></b>
                                                                     </span>
                                                                 </td>
                                                                 <td class="px-4 py-2">
                                                                     <span class="tpt-sale-price">
                                                                         <b><?=$row->final_price?></b>
                                                                     </span>
                                                                 </td>
                                                                 <td class="px-4 py-2">
                                                                     <span class="tpt-stock"><?=$row->quantity?></span>
                                                                 </td>
                                                                 <td class="px-4 py-2">
                                                                     <div class="tpt-publishd-btn">
                                                                         <label class="switch">
                                                                             <input type="checkbox" disabled  <? echo ($row->status == 1)?'checked': '' ?>>
                                                                             <span class="slider round"></span>
                                                                         </label>
                                                                     </div>
                                                                 </td>
                                                                 <td class="px-4 py-2">
                                                                     <div class="tpt-action-btn">
                                                                         <div class="cup-edit">
                                                                             <a onclick="editCombination('<?=MAINSITE_Admin.$user_access->class_name?>',<?=$row->id?>,<?=$row->product_id?>)"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                         </div>
                                                                     </div>
                                                                 </td>
                                                             </tr>
                                                           <?php endforeach; ?>
                                                           <?
                                                         }

                                                         ?>


                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                       </div>
                                  </div>
                                 </div>
                               </div>
                           </div>

                    </div>

                    </div>


</div>
</div>
<div class="apc-conp">

</div>

<script type="text/javascript">

	$(document).on("click",".apc-conp-close",function() {

  $(".apc-conp").removeClass("apc-conp-b");
});
	$(document).on("click",".apc-cancel",function() {
  $(".apc-conp").removeClass("apc-conp-b");
});
$(document).on("change", ".is_google_product" , function(){
 setGtin();

})


$(document).on("change", "#is_seo_tag" , function(){

	if($(this).is(":checked"))
 {
		 $(".auto_seo_combi_tags").show();

		 $(".auto_seo_combi_tags_input").attr("required",true);

	 }

	 else  {

		 $(".auto_seo_combi_tags").hide();

		 $(".auto_seo_combi_tags_input").attr("required",false);

	 }

 });


 function checkProductRefCode() {
    	$.ajax({
    	   type: "POST",

    		url:'<? echo MAINSITE_Admin ?>catalog/Product-Module/checkProductRefCode',
    	   dataType : "json",
    	   data : {"product_id" : <?=$id?> , "ref_code" : document.getElementById('ref_code').value, "<?=$csrf['name']?>":"<?=$csrf['hash']?>" },
    	   success : function(result){
    			//alert(result);
    			if(result.response==1)
    			{
    				//document.product_form.submit();

    			}
    			else{
    				alert("The Product Reference Code already in database");
    				document.getElementById('ref_code').focus();
    			}
    			}
    	   });
 }
 function setLongdescription() {
   alert('asas');
 }

</script>
