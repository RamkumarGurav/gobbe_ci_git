<?
$name= $mobile_no = $joining_date = $show_password = $user_image =  $password = $email = "";
$id= $role_id = 0;
$status=1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$role_id = $list_data->role_id;
	$joining_date = $list_data->joining_date;
	$mobile_no = $list_data->mobile_no;
	$password = $list_data->password;
	$show_password = $list_data->show_password;
	$email = $list_data->email;
	$name = $list_data->name;
	$user_image = $list_data->user_image;


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
'id'    => 'email',
);
echo form_label('Email', 'email', $flattributes);
$value = set_value('email');
if(empty($value)){$value = $email;}
$attributes = array(
'name'  => 'email',
'id'  => 'email',
'value' => $value,
'placeholder' => "Email",
'class' => 'form-control form-control-sm',
'type' => 'email',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('email', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>
		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
'id'    => 'password',
);
echo form_label('Password', 'password', $flattributes);
$value = set_value('password');
if(empty($value)){$value = $show_password;}
$attributes = array(
'name'  => 'password',
'id'  => 'password',
'value' => $value,
'placeholder' => "Password",
'class' => 'form-control form-control-sm',
'type' => 'password',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('password', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>
		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
'id'    => 'mobile_no',
);
echo form_label('Contact Number', 'mobile_no', $flattributes);
$value = set_value('mobile_no');
if(empty($value)){$value = $mobile_no;}
$attributes = array(
'name'  => 'mobile_no',
'id'  => 'mobile_no',
'value' => $value,
'placeholder' => "Contact No",
'class' => 'form-control form-control-sm',
'pattern'=>"[789][0-9]{9}",
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('mobile_no', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>
		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
'id'    => 'joining_date',
);
echo form_label('Joining Date', 'joining_date', $flattributes);
$value = set_value('joining_date');
if(empty($value)){$value = $joining_date;}
$attributes = array(
'name'  => 'joining_date',
'id'  => 'joining_date',
'value' => $value,
'class' => 'form-control form-control-sm',
'type' => 'date',
'required' => 'required'
);
echo form_input($attributes);?>
<span>
<?php echo form_error('joining_date', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>

		<div class="form-group">
			<?php
								echo form_label('Select Role', 'role_id');
								?>
								<?php
								$value = set_value('role_id');
												if(!empty($value)){$role_id = $value; }
												if(empty($value)){$value = $role_id;}
									$attributes = array(
									'name'	=> 'role_id',
									'id'	=> 'role_id',
									'title' => "Select Role",
									'class' => 'form-control form-control-sm',
									'required' => 'required',

									);
									echo form_dropdown($attributes , $staff_roles , $value );
								?>
								<span>
												<?php echo form_error('role_id', '<div class="error" style="color: red">', '</div>'); ?>
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
<div class="form-group">
		<?php
		$flattributes = array(
'class' => 'form-label',
'id'    => 'user_image',
);
echo form_label('Staff Image', 'user_image', $flattributes);
?>
<div class="upload__box">
					<div class="upload__btn-box">
						<label class="upload__btn">
								<p>Upload image</p>
								<?
								$value = set_value('user_image');
								if(empty($value)){$value = $name;}
								$attributes = array(
								'name'  => 'user_image',
								'id'  => 'user_image',
								'value' => $value,
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
<?php echo form_error('user_image', '<div class="error" style="color: red">', '</div>'); ?>
</span>
<?
	if(!empty($user_image)){
	 ?>
	 <div class="">
		 <a target="_blank" href="<?=MAINSITE?>assets/uploads/admin_user/user_image/<?=$user_image?>"> View Image</a>

	 </div>
	 <?
	}
?>
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
