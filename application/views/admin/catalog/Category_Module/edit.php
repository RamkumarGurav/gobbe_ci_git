<?
$name =    $slug_url = $meta_title = $banner_image=  $short_description =  $meta_keyword = $meta_description =  $condition_per_product = "";
$id= $product_attribute_id = $super_category_id = $cover_image =  0;
$status= $is_display_home_page =  1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	//$product_attribute_id = $list_data->product_attribute_id;
	$name = $list_data->name;
	$status = $list_data->status;
	$slug_url = $list_data->slug_url;
	$meta_title = $list_data->meta_title;
	$meta_keyword = $list_data->meta_keyword;
	$meta_description = $list_data->meta_description;
	$short_description = $list_data->short_description;
	$is_display_home_page = $list_data->is_display_home_page;
	$super_category_id = $list_data->super_category_id;
	$cover_image = $list_data->cover_image;
	$banner_image = $list_data->banner_image;

}
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<div class="tpi-add-attr">
    <div class="tpa-conp-inner">
			<?php echo form_open(MAINSITE_Admin."$user_access->class_name/doEdit", array('method' => 'post', 'id' => 'form' , 'onsubmit'=>'return  saveModule(this)', "name"=>"form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

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
        </div>
        <div class="tpci-tab-con">
            <div class="ttc-pro-inner ">
  <div class="ttc-pro-inner">
		<?php $value = set_value('id'); if(empty($value)){$value = $id;}$attributes = array('name'  => 'id', 'id'  => 'id', 'value' => $value, 'type' => 'hidden' ); echo form_input($attributes);?>

		<?php $attributes = array('name'  => 'redirect_type', 'id'  => 'redirect_type', 'value' => '', 'type' => 'hidden' ); echo form_input($attributes);?>


		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
'id'    => 'name',
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
				$flattributes = array(
'class' => 'form-label',
'id'    => 'name',
);
echo form_label('Category Description', 'short_description', $flattributes);
$value = set_value('short_description');
if(empty($value)){$value = $short_description;}
$attributes = array(
'name'  => 'short_description',
'id'  => 'short_description',
'value' => $value,
'placeholder' => "Category Description",
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
echo form_label('Super Category Name', 'is_display_home_page', $flattributes);
?>

<div class="tcp-ctg">
<ul class="tree">
	<li >
			<details open>

					<summary><input type="radio" style="width:20%" name="super_category_id" <? if($super_category_id==0)echo "checked";else echo ""; ?> value="" id="" class="tree-cb">New Parent Category</summary>

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

					if($super_category_id==$row2->id)
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
								<summary><input type="radio" style="width:20%" name="super_category_id" value="<? echo $row1->id; ?>" <? if($super_category_id==$row1->id)echo "checked";else echo ""; ?> id="" class="tree-cb"><? echo $row1->name; ?>
									</summary>
									<? foreach($category_list as $row3){

														if($row3->super_category_id==$row1->id){

														 ?>

														<? $liClassExpend='';$liClass = ''; $liFolderCount=0;foreach($category_list as $row4){if($super_category_id==$row4->id)$liClassExpend = 'open';if($row4->super_category_id==$row3->id)$liFolderCount++;}if($liFolderCount>0){$liClass = 'isFolder';} ?>
														<?
														if($liClass == 'isFolder'){
															?>
															<ul>
																	<li>
														<details <?=$liClassExpend?>>
																		<summary><input type="radio" style="width:20%" value="<? echo $row3->id; ?>"<? if($super_category_id==$row3->id)echo "checked";else echo ""; ?> name="super_category_id" id="" class="tree-cb"><? echo $row3->name; ?>
																			</summary>
																			<?
														}

														?>
															 <ul>

																	<? foreach($category_list as $row5){ //echo "<pre>"; print_r($category_list); echo "</pre>";

																		 if($row5->super_category_id==$row3->id){

																			 ?>

																	<li><input type="radio" style="width:20%" value="<? echo $row5->id; ?>" name="super_category_id" id="" <? if($super_category_id==$row5->id)echo "checked";else echo ""; ?> class="tree-cb"><? echo $row5->name; ?></li>

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
																	 <input type="radio" value="<? echo $row3->id; ?>" <? if($super_category_id==$row3->id)echo "checked";else echo ""; ?> style="width:20%" name="super_category_id" id="" class="tree-cb"><? echo $row3->name; ?>

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
						<input type="radio" style="width:20%" value="<? echo $row1->id; ?>" <? if($super_category_id==$row1->id)echo "checked";else echo ""; ?> name="super_category_id" id="" class="tree-cb"><? echo $row1->name; ?>

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
<?
// echo "<pre>";
// print_r($category_list);
// echo "</pre>";
?>
<span>
<?php echo form_error('super_category_id', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>

<div class="form-group">

	<?php
	$attributes = array('class'=>'form-label');
	echo form_label('Display On Home Page', 'is_display_home_page', $attributes);
	?>
	<div class="cupn-pubished-btn">
		<label class="switch">
		<?
			$value = set_value('is_display_home_page');
			if(empty($value)){$value = $is_display_home_page;}

			//echo $value;
			$attributes = array(
			'name'	=> 'is_display_home_page',
			'id'	=> 'Active',

			'value'	=> "1",

			"checked" => ($value == "1") ? "checked" : false
			);
			echo form_checkbox($attributes);?>
			<span class="slider round"></span>
			<span>
			<?php echo form_error('is_display_home_page', '<div class="error" style="color: red">', '</div>'); ?>
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
								$value = set_value('cover_image');

								$attributes = array(
								'name'  => 'cover_image',
								'id'  => 'cover_image',
								'class' => 'upload__inputfile',
								'type' => 'file',
								// 'required' => 'required'
								);
								echo form_input($attributes);?>
								<!-- <input type="file" data-max_length="20" class="upload__inputfile"> -->
							</label>
				</div>
	<div class="upload__img-wrap"></div>
</div>

<span>
<?php echo form_error('cover_image', '<div class="error" style="color: red">', '</div>'); ?>
</span>
<?
	if(!empty($cover_image)){
	 ?>
	 <div class="">
		 <a target="_blank" href="<?=MAINSITE?>assets/uploads/category/<?=$cover_image?>"> View Image</a>

	 </div>
	 <?
	}
?>
</div>
<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',

);
echo form_label('Banner Image', 'banner_image',$flattributes);
?>
<div class="upload__box">
					<div class="upload__btn-box">
						<label class="upload__btn">
								<p>Upload image</p>
								<?
								$value = set_value('banner_image');

								$attributes = array(
								'name'  => 'banner_image',
								'id'  => 'banner_image',
								'class' => 'upload__inputfile',
								'type' => 'file',
								// 'required' => 'required'
								);
								echo form_input($attributes);?>
								<!-- <input type="file" data-max_length="20" class="upload__inputfile"> -->
							</label>
				</div>
	<div class="upload__img-wrap"></div>
</div>

<span>
<?php echo form_error('banner_image', '<div class="error" style="color: red">', '</div>'); ?>
</span>
<?
	if(!empty($banner_image)){
	 ?>
	 <div class="">
		 <a target="_blank" href="<?=MAINSITE?>assets/uploads/category/<?=$banner_image?>"> View Image</a>

	 </div>
	 <?
	}
?>
</div>

<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',
'id'    => 'slug_url',
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
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('slug_url', '<div class="error" style="color: red">', '</div>'); ?>
</span>
</div>
<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',
'id'    => 'meta_title',
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
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('meta_title', '<div class="error" style="color: red">', '</div>'); ?>
</span>
</div>
<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',
'id'    => 'meta_description',
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
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('meta_description', '<div class="error" style="color: red">', '</div>'); ?>
</span>
</div>
<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',
'id'    => 'meta_keyword',
);
echo form_label('Meta Keyword', 'meta_keyword', $flattributes);
$value = set_value('meta_keyword');
if(empty($value)){$value = $meta_keyword;}
$attributes = array(
'name'  => 'meta_keyword',
'id'  => 'meta_keyword',
'value' => $value,
'placeholder' => "Meta Keyword",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('meta_keyword', '<div class="error" style="color: red">', '</div>'); ?>
</span>
</div>
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

	</div>
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
