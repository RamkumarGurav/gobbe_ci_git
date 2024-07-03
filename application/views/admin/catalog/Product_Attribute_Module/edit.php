<?
$name = $user_image =   $condition_per_product = "";
$id= $attributes_input_id = 0;
$status= $list_page= $details_page = $search = 1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$attributes_input_id = $list_data->attributes_input_id;
	$search = $list_data->search;
	$list_page= $list_data->list_page;
	$details_page = $list_data->details_page;
	$condition_per_product = $list_data->condition_per_product;
	$name = $list_data->name;
	$status = $list_data->status;

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
'id'    => 'condition_per_product',
);
echo form_label('No. Of Attributes Per Product', 'condition_per_product', $flattributes);
$value = set_value('condition_per_product');
if(empty($value)){$value = $condition_per_product;}
$attributes = array(
'name'  => 'condition_per_product',
'id'  => 'condition_per_product',
'value' => $value,
'placeholder' => "No. Of Attributes Per Product",
'class' => 'form-control form-control-sm',
'type' => 'number',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('condition_per_product', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>


		<div class="form-group">
			<?php
								echo form_label('Attribute Display Type', 'attributes_input_id');
								?>
								<?php
								$value = set_value('attributes_input_id');
												if(!empty($value)){$attributes_input_id = $value; }
												if(empty($value)){$value = $attributes_input_id;}
									$attributes = array(
									'name'	=> 'attributes_input_id',
									'id'	=> 'attributes_input_id',
									'title' => "Select Role",
									'class' => 'form-control form-control-sm',
									'required' => 'required',

									);
									echo form_dropdown($attributes , $attributes_inputs , $value );
								?>
								<span>
												<?php echo form_error('attributes_input_id', '<div class="error" style="color: red">', '</div>'); ?>
										</span>
		</div>

<div class="form-group">

	<?php
	$attributes = array('class'=>'form-label');
	echo form_label('Display On List Page', 'list_page1', $attributes);
	?>
	<div class="cupn-pubished-btn">
		<label class="switch">
		<?
			$value = set_value('list_page');
			if(empty($value)){$value = $list_page;}

			//echo $value;
			$attributes = array(
			'name'	=> 'list_page',
			'id'	=> 'Active',

			'value'	=> "1",

			"checked" => ($value == "1") ? "checked" : false
			);
			echo form_checkbox($attributes);?>
			<span class="slider round"></span>
			<span>
			<?php echo form_error('list_page', '<div class="error" style="color: red">', '</div>'); ?>
			</span>
			</label>
		</div>

</div>
<div class="form-group">

	<?php
	$attributes = array('class'=>'form-label');
	echo form_label('Details Page', 'details_page', $attributes);
	?>
	<div class="cupn-pubished-btn">
		<label class="switch">
		<?
			$value = set_value('details_page');
			if(empty($value)){$value = $details_page;}

			//echo $value;
			$attributes = array(
			'name'	=> 'details_page',
			'id'	=> 'Active',

			'value'	=> "1",

			"checked" => ($value == "1") ? "checked" : false
			);
			echo form_checkbox($attributes);?>
			<span class="slider round"></span>
			<span>
			<?php echo form_error('details_page', '<div class="error" style="color: red">', '</div>'); ?>
			</span>
			</label>
		</div>

</div>
<div class="form-group">

	<?php
	$attributes = array('class'=>'form-label');
	echo form_label('Search', 'search', $attributes);
	?>
	<div class="cupn-pubished-btn">
		<label class="switch">
		<?
			$value = set_value('search');
			if(empty($value)){$value = $search;}

			//echo $value;
			$attributes = array(
			'name'	=> 'search',
			'id'	=> 'Active',

			'value'	=> "1",

			"checked" => ($value == "1") ? "checked" : false
			);
			echo form_checkbox($attributes);?>
			<span class="slider round"></span>
			<span>
			<?php echo form_error('search', '<div class="error" style="color: red">', '</div>'); ?>
			</span>
			</label>
		</div>

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
