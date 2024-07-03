
<style>
	.jumbotron {
  background: #6b7381;
  color: #bdc1c8;
}
.jumbotron h1 {
  color: #fff;
}
.example {
  margin: 4rem auto;
}
.example > .row {
  margin-top: 2rem;
  height: 5rem;
  vertical-align: middle;
  text-align: center;
  border: 1px solid rgba(189, 193, 200, 0.5);
}
.example > .row:first-of-type {
  border: none;
  height: auto;
  text-align: left;
}
.example h3 {
  font-weight: 400;
}
.example h3 > small {
  font-weight: 200;
  font-size: 0.75em;
  color: #939aa5;
}
.example h6 {
  font-weight: 700;
  font-size: 0.65rem;
  letter-spacing: 3.32px;
  text-transform: uppercase;
  color: #bdc1c8;
  margin: 0;
  line-height: 5rem;
}
.example .btn-toggle {
  top: 50%;
  transform: translateY(-50%);
}
.btn-toggle {
  margin: 0 4rem;
  padding: 0;
  position: relative;
  border: none;
  height: 1.5rem;
  width: 3rem;
  border-radius: 1.5rem;
  color: #6b7381;
  background: #bdc1c8;
}
.btn-toggle:focus,
.btn-toggle.focus,
.btn-toggle:focus.active,
.btn-toggle.focus.active {
  outline: none;
}
.btn-toggle:before,
.btn-toggle:after {
  line-height: 1.5rem;
  width: 4rem;
  text-align: center;
  font-weight: 600;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity 0.25s;
}
.btn-toggle:before {
  content: 'Off';
  left: -4rem;
}
.btn-toggle:after {
  content: 'On';
  right: -4rem;
  opacity: 0.5;
}
.btn-toggle > .handle {
  position: absolute;
  top: 0.1875rem;
  left: 0.1875rem;
  width: 1.125rem;
  height: 1.125rem;
  border-radius: 1.125rem;
  background: #fff;
  transition: left 0.25s;
}
.btn-toggle.active {
  transition: background-color 0.25s;
}
.btn-toggle.active > .handle {
  left: 1.6875rem;
  transition: left 0.25s;
}
.btn-toggle.active:before {
  opacity: 0.5;
}
.btn-toggle.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
  line-height: -0.5rem;
  color: #fff;
  letter-spacing: 0.75px;
  left: 0.4125rem;
  width: 2.325rem;
}
.btn-toggle.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
  display: none;
}
.btn-toggle:before,
.btn-toggle:after {
  color: #6b7381;
}
.btn-toggle.active {
  background-color: #29b5a8;
}
.btn-toggle.btn-lg {
  margin: 0 5rem;
  padding: 0;
  position: relative;
  border: none;
  height: 2.5rem;
  width: 5rem;
  border-radius: 2.5rem;
}
.btn-toggle.btn-lg:focus,
.btn-toggle.btn-lg.focus,
.btn-toggle.btn-lg:focus.active,
.btn-toggle.btn-lg.focus.active {
  outline: none;
}
.btn-toggle.btn-lg:before,
.btn-toggle.btn-lg:after {
  line-height: 2.5rem;
  width: 5rem;
  text-align: center;
  font-weight: 600;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity 0.25s;
}
.btn-toggle.btn-lg:before {
  content: 'Off';
  left: -5rem;
}
.btn-toggle.btn-lg:after {
  content: 'On';
  right: -5rem;
  opacity: 0.5;
}
.btn-toggle.btn-lg > .handle {
  position: absolute;
  top: 0.3125rem;
  left: 0.3125rem;
  width: 1.875rem;
  height: 1.875rem;
  border-radius: 1.875rem;
  background: #fff;
  transition: left 0.25s;
}
.btn-toggle.btn-lg.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-lg.active > .handle {
  left: 2.8125rem;
  transition: left 0.25s;
}
.btn-toggle.btn-lg.active:before {
  opacity: 0.5;
}
.btn-toggle.btn-lg.active:after {
  opacity: 1;
}
.btn-toggle.btn-lg.btn-sm:before,
.btn-toggle.btn-lg.btn-sm:after {
  line-height: 0.5rem;
  color: #fff;
  letter-spacing: 0.75px;
  left: 0.6875rem;
  width: 3.875rem;
}
.btn-toggle.btn-lg.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-lg.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-lg.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-lg.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-lg.btn-xs:before,
.btn-toggle.btn-lg.btn-xs:after {
  display: none;
}
.btn-toggle.btn-sm {
  margin: 0 0.5rem;
  padding: 0;
  position: relative;
  border: none;
  height: 1.5rem;
  width: 3rem;
  border-radius: 1.5rem;
}
.btn-toggle.btn-sm:focus,
.btn-toggle.btn-sm.focus,
.btn-toggle.btn-sm:focus.active,
.btn-toggle.btn-sm.focus.active {
  outline: none;
}
.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
  line-height: 1.5rem;
  width: 0.5rem;
  text-align: center;
  font-weight: 600;
  font-size: 0.55rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity 0.25s;
}
.btn-toggle.btn-sm:before {
  content: 'Off';
  left: -0.5rem;
}
.btn-toggle.btn-sm:after {
  content: 'On';
  right: -0.5rem;
  opacity: 0.5;
}
.btn-toggle.btn-sm > .handle {
  position: absolute;
  top: 0.1875rem;
  left: 0.1875rem;
  width: 1.125rem;
  height: 1.125rem;
  border-radius: 1.125rem;
  background: #fff;
  transition: left 0.25s;
}
.btn-toggle.btn-sm.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-sm.active > .handle {
  left: 1.6875rem;
  transition: left 0.25s;
}
.btn-toggle.btn-sm.active:before {
  opacity: 0.5;
}
.btn-toggle.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm.btn-sm:before,
.btn-toggle.btn-sm.btn-sm:after {
  line-height: -0.5rem;
  color: #fff;
  letter-spacing: 0.75px;
  left: 0.4125rem;
  width: 2.325rem;
}
.btn-toggle.btn-sm.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-sm.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-sm.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-sm.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm.btn-xs:before,
.btn-toggle.btn-sm.btn-xs:after {
  display: none;
}
.btn-toggle.btn-xs {
  margin: 0 0;
  padding: 0;
  position: relative;
  border: none;
  height: 1rem;
  width: 2rem;
  border-radius: 1rem;
}
.btn-toggle.btn-xs:focus,
.btn-toggle.btn-xs.focus,
.btn-toggle.btn-xs:focus.active,
.btn-toggle.btn-xs.focus.active {
  outline: none;
}
.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
  line-height: 1rem;
  width: 0;
  text-align: center;
  font-weight: 600;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity 0.25s;
}
.btn-toggle.btn-xs:before {
  content: 'Off';
  left: 0;
}
.btn-toggle.btn-xs:after {
  content: 'On';
  right: 0;
  opacity: 0.5;
}
.btn-toggle.btn-xs > .handle {
  position: absolute;
  top: 0.125rem;
  left: 0.125rem;
  width: 0.75rem;
  height: 0.75rem;
  border-radius: 0.75rem;
  background: #fff;
  transition: left 0.25s;
}
.btn-toggle.btn-xs.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-xs.active > .handle {
  left: 1.125rem;
  transition: left 0.25s;
}
.btn-toggle.btn-xs.active:before {
  opacity: 0.5;
}
.btn-toggle.btn-xs.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs.btn-sm:before,
.btn-toggle.btn-xs.btn-sm:after {
  line-height: -1rem;
  color: #fff;
  letter-spacing: 0.75px;
  left: 0.275rem;
  width: 1.55rem;
}
.btn-toggle.btn-xs.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-xs.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-xs.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-xs.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs.btn-xs:before,
.btn-toggle.btn-xs.btn-xs:after {
  display: none;
}
.btn-toggle.btn-secondary {
    color: #6b7381;
    background: #d2242d;
}
.btn-toggle.btn-secondary:before,
.btn-toggle.btn-secondary:after {
  color: #6b7381;
}
.btn-toggle.btn-secondary.active {
  background-color: #00b130;
}
</style>
<?
$name =    $condition_per_product = "";
$id= $product_attribute_id = 0;
$status=  1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	//$product_attribute_id = $list_data->product_attribute_id;
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
		<div class="tpi-product-table">
				<div class="tpt-inner">
						<table>
								<thead>
										<tr>
												<td class="px-4 py-2 ">#</td>
												<td class="px-4 py-2 ">Role</td>
												<td class="px-4 py-2 ">All</td>
												<td class="px-4 py-2 ">View</td>
												<td class="px-4 py-2 ">Add</td>
												<td class="px-4 py-2 ">Update</td>
												<td class="px-4 py-2 ">Import</td>
												<td class="px-4 py-2 ">Export</td>
												<td class="px-4 py-2 ">Delete</td>
										</tr>
								</thead>
								<tbody>

									<?
$count=0;

	foreach($module_data as $md)
	{
		$count++;
?>

<?
$all_checked = $view_checked = $add_checked = $update_checked = $delete_checked = $approval_checked = $import_checked = $export_checked ='';
if(!empty($module_permission_data)){
	foreach($module_permission_data as $mpd)
	{
		if($md->id == $mpd->module_id)
		{
			if(!empty($mpd->view_module))
			{ $view_checked = 'checked ';		 $all_checked = 'checked';}

			if(!empty($mpd->add_module))
			{ $add_checked = 'checked';			 $all_checked = 'checked';}

			if(!empty($mpd->update_module))
			{ $update_checked = 'checked';		 $all_checked = 'checked';}

			if(!empty($mpd->delete_module))
			{ $delete_checked = 'checked';		 $all_checked = 'checked';}

			if(!empty($mpd->approval_module	))
			{ $approval_checked = 'checked';	 $all_checked = 'checked';}

			if(!empty($mpd->import_data))
			{ $import_checked = 'checked';		 $all_checked = 'checked';}

			if(!empty($mpd->export_data))
			{ $export_checked = 'checked';		 $all_checked = 'checked';}
			if(!empty($mpd->delete_module))
			{ $delete_checked = 'checked';		 $all_checked = 'checked';}
		}

			}
		}




		?>


		<tr>
			<td class="px-4 py-2"><span class="rm-nmb">
					<?=$count?>
			</span></td>
			<td class="px-4 py-2">
					<span class="rm-role">
							<?=$md->name?> [ <?=$master_name[$md->is_master]?> ]
					</span>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value('module_ids');

								$attributes = array(
								'name'	=> 'module_ids[]',


								'class' => "module_all m_check_all_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $all_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("view_$md->id");

								$attributes = array(
								'name'	=> "view_$md->id",

								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $view_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("add_$md->id");

								$attributes = array(
								'name'	=> "add_$md->id",


								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $add_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("update_$md->id");

								$attributes = array(
								'name'	=> "update_$md->id",


								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $update_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("import_$md->id");

								$attributes = array(
								'name'	=> "import_$md->id",
								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $import_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("export_$md->id");

								$attributes = array(
								'name'	=> "export_$md->id",
								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $export_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>
			<td class="px-4 py-2">
					<div class="rmr-btn">
							<label class="switch">
								<?php
								$value = set_value("delete_$md->id");

								$attributes = array(
								'name'	=> "delete_$md->id",
								'class' => "module_field m_check_field_$md->id",
								'data-module_id'=>$md->id,

								'data-bootstrap-switch data-off-color'=>"danger",
								'data-on-color'=>"success",
								'data-on-text'=>"Yes",
								 'data-off-text'=>"No",
								 'checked' => $delete_checked,
								 'value'=>$md->id
								);
								echo form_checkbox($attributes );
								?>
									<span class="slider round"></span>
							</label>
					</div>
			</td>

		</tr>
			<? } ?>

								</tbody>
						</table>
				</div>
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
<!-- <script type="text/javascript">
$("input[data-bootstrap-switch]").each(function(){
	$(this).bootstrapSwitch('state', $(this).prop('checked'));
});
</script> -->
<script type="text/javascript">

	$(document).on("click",".module_all",function() {
	var module_id = $(this).attr("data-module_id");

    if ($(this).prop('checked')) {
      $( ".m_check_field_"+module_id ).prop('checked', true);
  } else {
      $( ".m_check_field_"+module_id ).prop('checked', false);
  }

});


  $(document).on("click",".module_field",function() {
	var module_id = $(this).attr("data-module_id");

  if ($(this).prop('checked')) {
    $( this).prop('checked', true);
} else {
    $(this).prop('checked', false);
}
var checkedLength = $(".m_check_field_"+module_id+":checked").length;

if(checkedLength > 0){
	$(".m_check_all_"+module_id).prop('checked', true);
}else{
	$(".m_check_all_"+module_id).prop('checked', false);

}
});

// })
</script>
