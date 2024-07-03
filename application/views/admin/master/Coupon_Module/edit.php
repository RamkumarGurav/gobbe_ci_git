<?
$name=$discount_in =$discount_value= "";
$id=0;
$status=1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$name = $list_data->name;
	$discount_in = $list_data->discount_in;
	$discount_value = $list_data->discount_value;
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
);
echo form_label('Discout Type','name',  $flattributes);
$value = set_value('discount_in');
$discount_types = array(
	''=>'Select',
	'1'=>'Rs',
	'0'=>'%',
);
if(empty($value)){$value = $name;}
$attributes = array(
'name'  => 'discount_in',
'id'  => 'discount_in',
'value' => $value,
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_dropdown($attributes,$discount_types,$discount_in);?>
<span>
<?php echo form_error('discount_value', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>
		<div class="form-group">
				<?php
				$flattributes = array(
					'class' => 'form-label',
					'id'    => 'name',
				);
echo form_label('Discount Value', 'name', $flattributes);
$value = set_value('name');
if(empty($value)){$value = $discount_value;}
$attributes = array(
'name'  => 'discount_value',
'id'  => 'discount_value',
'value' => $value,
'placeholder' => "Discount Value",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('discount_value', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>

		<?php

?>

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
