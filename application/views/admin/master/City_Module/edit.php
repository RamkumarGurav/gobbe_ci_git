<?
$name="";
$code="";
$id=0;
$country_id=0;
$state_id=0;
$is_display = 1;
$status=1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$name = $list_data->name;
	$code = $list_data->code;
	$status = $list_data->status;
	$country_id = $list_data->country_id;
	$state_id = $list_data->state_id;


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
								echo form_label('Select Country', 'country_id');
								?>
								<?php
								$value = set_value('country_id');
												if(!empty($value)){$country_id = $value; }
												if(empty($value)){$value = $country_id;}
													$js = 'onChange="getState(this.value ,0)"';
									$attributes = array(
									'name'	=> 'country_id',
									'id'	=> 'country_id',
									'title' => "Select Country",
									'class' => 'form-control form-control-sm',
									'required' => 'required',

									);
									echo form_dropdown($attributes , $country_data , $value,$js );
								?>
								<span>
												<?php echo form_error('country_id', '<div class="error" style="color: red">', '</div>'); ?>
										</span>
		</div>
		<div class="form-group">
			<?php
											echo form_label('State', 'state_id ');
											?>
											<?php
										 $value = set_value('state_id');
											if(!empty($value)){$state_id = $value; }

											if(empty($value)){$value = $state_id ;}
											$options = array('' => 'Select State');
											$attributes = array(
											'name'	=> 'state_id',
											'id'	=> 'state_id',
											'title' => "Select State",
											'class' => 'form-control form-control-sm',
											'required' => 'required',

											);
											echo form_dropdown($attributes , $options , $value );
											?>
											<span>
											<?php echo form_error('state_id ', '<div class="error" style="color: red">', '</div>'); ?>
											</span>
		</div>
		<div class="form-group">
			<?php
						echo form_label('City', 'name');
						$value = set_value('name');
										if(empty($value)){$value = $name;}
						?>
						<?php
							$attributes = array(
							'name'	=> 'name',
							'id'	=> 'name',
							'title' => "State",
							'class' => 'form-control form-control-sm',
							'value'	=> $value,
							'required' => 'required',
							);
							echo form_input($attributes);
						?>
						<span>
										<?php echo form_error('name', '<div class="error" style="color: red">', '</div>'); ?>
								</span>
		</div>

			<div class="form-group">

				<?php
								echo form_label('City Code', 'name');
								$value = set_value('code');
								if(empty($value)){$value = $code;}
								?>
								<?php
									$attributes = array(
									'name'	=> 'code',
									'id'	=> 'code',
									'title' => "State Code",
									'class' => 'form-control form-control-sm',
									'value'	=> $value,
									'required' => 'required',
									);
									echo form_input($attributes);
								?>
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
<script>

<? if(!empty($country_id) && !empty($state_id)){ ?>

	getState(<?=$country_id?> , <?=$state_id?>)

<? } ?>
</script>
