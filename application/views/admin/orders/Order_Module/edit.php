<?
$name=$link=$title1 =$title2 = $image = $title3 =$title4 = $banner_for = "";
$id=0;
$status=1;
$record_action = "Add New Record";
if(!empty($list_data))
{
	$record_action = "Update";
	$id = $list_data->id;
	$name = $list_data->name;
	$link = $list_data->link;
	$title1 = $list_data->title1;
	$title2 = $list_data->title2;
	$title3 = $list_data->title3;
	$title4 = $list_data->title4;
	$image = $list_data->image;
	$banner_for = $list_data->banner_for;
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
echo form_label('Banner Link', 'Banner link', $flattributes);
$value = set_value('link');
if(empty($value)){$value = $link;}
$attributes = array(
'name'  => 'link',
'id'  => 'link',
'value' => $value,
'placeholder' => "Banner Link",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);
?>
<span>
<?php echo form_error('link', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>


		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
);
echo form_label('Title 1', 'Title 1', $flattributes);
$value = set_value('title1');
if(empty($value)){$value = $title1;}
$attributes = array(
'name'  => 'title1',
'id'  => 'title1',
'value' => $value,
'placeholder' => "Title 1",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
'required' => 'required'
);
echo form_input($attributes);
?>
<span>
<?php echo form_error('title1', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>

		<div class="form-group">
				<?php
				$flattributes = array(
'class' => 'form-label',
);
echo form_label('Title 2', 'Title 2', $flattributes);
$value = set_value('title2');
if(empty($value)){$value = $title2;}
$attributes = array(
'name'  => 'title2',
'id'  => 'title2',
'value' => $value,
'placeholder' => "Title 2",
'autofocus' => 'autofocus',
'class' => 'form-control form-control-sm',
'type' => 'text',
);
echo form_input($attributes);
?>
<span>
<?php echo form_error('title2', '<div class="error" style="color: red">', '</div>'); ?>
</span>
		</div>

				<div class="form-group">
						<?php
						$flattributes = array(
		'class' => 'form-label',
		);
		echo form_label('Title 3', 'Title 3', $flattributes);
		$value = set_value('title3');
		if(empty($value)){$value = $title3;}
		$attributes = array(
		'name'  => 'title3',
		'id'  => 'title3',
		'value' => $value,
		'placeholder' => "Title 3",
		'autofocus' => 'autofocus',
		'class' => 'form-control form-control-sm',
		'type' => 'text',
		);
		echo form_input($attributes);
		?>
		<span>
		<?php echo form_error('title3', '<div class="error" style="color: red">', '</div>'); ?>
		</span>
				</div>

				<div class="form-group">
						<?php
						$flattributes = array(
		'class' => 'form-label',
		);
		echo form_label('Title 4', 'Title 4', $flattributes);
		$value = set_value('title4');
		if(empty($value)){$value = $title4;}
		$attributes = array(
		'name'  => 'title4',
		'id'  => 'title4',
		'value' => $value,
		'placeholder' => "Title 4",
		'autofocus' => 'autofocus',
		'class' => 'form-control form-control-sm',
		'type' => 'text',
		);
		echo form_input($attributes);
		?>
		<span>
		<?php echo form_error('title4', '<div class="error" style="color: red">', '</div>'); ?>
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
	$attributes = array('class'=>'form-label');
	echo form_label('Banner For', 'banner_for', $attributes);
	?>
	<div class="cupn-pubished-btn">
		<label class="switch">
		<?
			$value = set_value('banner_for');
			if(empty($value)){$value = $banner_for;}

			//echo $value;
			$attributes = array(
			'name'	=> 'banner_for',
			'id'	=> 'banner_for1',

			'value'	=> "1",

			"checked" => ($value == "1") ? "checked" : false
			);
			echo form_radio($attributes);?>
			<span class="slider round"></span>

			Desktop
			</label>
		</div>
		<div class="cupn-pubished-btn">
			<label class="switch">
			<?
				$value = set_value('banner_for');
				if(empty($value)){$value = $banner_for;}

				//echo $value;
				$attributes = array(
				'name'	=> 'banner_for',
				'id'	=> 'banner_for2',

				'value'	=> "0",

				"checked" => ($value == "0") ? "checked" : false
				);
				echo form_radio($attributes);?>
				<span class="slider round"></span>
				<span>
				<?php echo form_error('banner_for', '<div class="error" style="color: red">', '</div>'); ?>
				</span>
				Mobile
				</label>
			</div>

</div>
<div class="form-group">
	<?php
	$flattributes = array(
		'class' => 'form-label',
		'id' => 'cover_image',
	);
	echo form_label('Banner Image', 'cover_image', $flattributes);
	?>
	<div class="upload__box">
		<div class="upload__btn-box">
			<label class="upload__btn">
				<p>Banner image</p>
				<?
				$value = set_value('image');

				$attributes = array(
					'name' => 'image',
					'id' => 'image',
					'class' => 'upload__inputfile',
					'type' => 'file',
					//'multiple' => 'multiple',
					 'required' => 'required'
				);
				echo form_input($attributes); ?>
				<!-- <input type="file" data-max_length="20" class="upload__inputfile"> -->
			</label>
		</div>
		<div class="upload__img-wrap"></div>
		<?
		if(!empty($image)){
			?>
			<span>
				<a href="<?=MAINSITE.'assets/uploads/banner/'.$image?>" target="_blank"> View</a>
			</span>
			<?
		}
		?>

	</div>

	<span>
		<?php echo form_error('image', '<div class="error" style="color: red">', '</div>'); ?>
	</span>

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
