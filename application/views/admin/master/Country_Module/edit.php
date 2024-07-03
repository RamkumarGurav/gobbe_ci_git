
<?
$name="";
$country_short_name="";
$code="";
$dial_code="";
$id=0;
$status=1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$name = $list_data->name;
	$country_short_name = $list_data->country_short_name;
	$status = $list_data->status;
	$code = $list_data->code;

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
echo form_label('Country', 'name', $flattributes);
$value = set_value('name');
if(empty($value)){$value = $name;}
$attributes = array(
'name'  => 'name',
'id'  => 'name',
'value' => $value,
'placeholder' => "Country Name",
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
		<?php

?>
			<div class="form-group">

				<?php
				$attributes = array('class'=>'form-label');
				echo form_label('Country Short Name', 'country_short_name', $attributes);

$value = set_value('country_short_name');
if(empty($value)){$value = $country_short_name;}
$attributes = array(
'name'  => 'country_short_name',
'id'  => 'country_short_name',
'value' => $value,
'placeholder' => "Country Short Name",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('country_short_name', '<div class="error" style="color: red">', '</div>'); ?>
</span>
</div>
<?php

?>
	<div class="form-group">
		<?php
		$attributes = array('class'=>'form-label');
		echo form_label('Country Code', 'code', $attributes);

$value = set_value('code');
if(empty($value)){$value = $code;}
$attributes = array(
'name'  => 'code',
'id'  => 'code',
'value' => $value,
'placeholder' => "Country Code",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'number',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('code', '<div class="error" style="color: red">', '</div>'); ?>
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
