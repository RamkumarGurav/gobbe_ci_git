<?
$customers_address_id = (!empty($address_data[0]->customers_address_id))?$address_data[0]->customers_address_id:0;
?>


<!-- <span class="m-address">Manage Address</span>
 -->     <div class="manage-address mt-30">
      <div class="manage-address-inner">
        <?php echo form_open(base_url().__shippingAddress__, array('method' => 'post', 'id' => 'ship_address', 'style' => 'display:block;', 'class' => 'shping-add')); ?>
        <?php
                            $attributes = array(
                            'name'	=> 'customers_address_id',
                            'id'	=> 'customers_address_id',
                            'value'	=> $customers_address_id,
                            'type' => 'hidden'
                            );
                            echo form_input($attributes);?>
            <?php
                            $attributes = array(
                            'name'	=> 'country_id',
                            'id'	=> 'country_id',
                            'value'	=> '1',
                            'type' => 'hidden'
                            );
                            echo form_input($attributes);?>
          <!-- <span class="manage-add"><?=($customers_address_id>0)?"UPDATE ADDRESS":"ADD A NEW ADDRESS"?></span> -->
          <div class="manage-class-inner row">
          <?=$message?>
          <div class="form-group col-md-6">
              <label> Name <span class="required">*</span></label>
              <?php
    $value = set_value('name');
    if(empty($value)){
      $value = (!empty($address_data[0]->name))?$address_data[0]->name:'';
    }
                      $attributes = array(
                      'name'	=> 'name',
                      'id'	=> 'name0',
                      'value'	=> $value,
                      'class' => 'form-control',
                      'autofocus' => 'autofocus',
                      'type' => 'text',
                      'required' => 'required'
                      );
                      echo form_input($attributes);?>
          </div>


          <div class="form-group col-md-6">
              <label> Mobile <span class="required">*</span></label>
              <?php

              $value = set_value('number');
              if(empty($value)){
              $value = (!empty($address_data[0]->number))?$address_data[0]->number:'';
              }
                      $attributes = array(
                      'name'	=> 'number',
                      'id'	=> 'number0',
                      'value'	=> $value,
                      'class' => 'form-control',
                      'type' => 'number',
                      'pattern' => '[0-9]{10,10}',
                      'title' => 'Enter only number between 0-9',
                      'required' => 'required'
                      );
                      echo form_input($attributes);?>
          </div>

          <div class="form-group col-md-6">
              <label> Address <span class="required">*</span></label>
              <?php
      $value = set_value('address');
        if(empty($value)){
          $value = (!empty($address_data[0]->address))?$address_data[0]->address:'';
        }
                          $attributes = array(
                          'name'	=> 'address',
                          'id'	=> 'address0',
                          'value'	=> $value,
                          'class' => 'form-control mng-form-txt-area',
                          'rows' => '4',
                          'cols' => '10',
                          'title' => 'Address Line 1',
                          'required' => 'required'
                          );
                          echo form_textarea($attributes);?>
          </div>
          <div class="form-group col-md-6">
              <label> State <span class="required">*</span></label>

              <?php
                            $value = set_value('state_id');
      if(empty($value)){
        $value = (!empty($address_data[0]->state_id))?$address_data[0]->state_id:'';
      }
      $state_id = $value;
                            $attributes = array(
                            'name'	=> 'state_id',
                            'id'	=> 'state_id',
                            'title' => "Select State",
                            'class' => 'form-control',
                            'style' => 'width:100%',
                            'onchange' => "getCity(this.value , 'city_id' ,'0','')",
                            'required' => 'required'
                            );
                            echo form_dropdown($attributes , array(''=>'Select State') , $value );?>
                            <script>getState(document.getElementById('country_id<?=$customers_address_id?>') , 'state_id' , '<?=$value?>'  ,''); </script>

          </div>
          <div class="form-group col-md-6">
              <label> City <span class="required">*</span></label>

              <?php
                            $value = set_value('city_id');
      if(empty($value)){
        $value = (!empty($address_data[0]->city_id))?$address_data[0]->city_id:'';
      }
                            $attributes = array(
                            'name'	=> 'city_id',
                            'id'	=> 'city_id',
                           'title' => "Select City",
                            'class' => 'form-control',
                            'style' => 'width:100%',
                            'required' => 'required'
                            );
                            echo form_dropdown($attributes , array(''=>'Select City') , $value );?>
                            <script> getCity("<?=$state_id?>" , 'city_id' , <?=$value?>)</script>

          </div>
          <div class="form-group col-md-6">
              <label> Pincode <span class="required">*</span></label>

              <?php
    $value = set_value('pincode');
    if(empty($value)){
      $value = (!empty($address_data[0]->zipcode))?$address_data[0]->zipcode:'';
    }
                      $attributes = array(
                      'name'	=> 'pincode',
                      'id'	=> 'pincode0',
                      'value'	=> $value,
                      'class' => 'form-control',
                      'type' => 'number',
                      'required' => 'required'
                      );
                      echo form_input($attributes);?>
          </div>
          <div class="form-group col-md-12">
              <label> Locality <span class="required">*</span></label>
              <?php
        $value = set_value('locality');
        if(empty($value)){
        $value = (!empty($address_data[0]->locality))?$address_data[0]->locality:'';
        }
                      $attributes = array(
                      'name'	=> 'locality',
                      'id'	=> 'google_map_address',
                      'value'	=> $value,
                      'class' => 'form-control',
                      'type' => 'text',
                      'title' => 'Locality'
                      );
                      echo form_input($attributes);?>
          </div>
          <div class="form-group col-md-6">
              <label> Landmark <span class="required">*</span></label>
              <?php
      $value = set_value('landmark');
      if(empty($value)){
        $value = (!empty($address_data[0]->landmark))?$address_data[0]->landmark:'';
      }
                        $attributes = array(
                        'name'	=> 'landmark',
                        'id'	=> 'landmark0',
                        'value'	=> $value,
                        'class' => 'form-control',
                        'type' => 'text'
                        );
                        echo form_input($attributes);?>
          </div>
          <div class="form-group col-md-6">
              <label> Alternate Number <span class="required">*</span></label>
              <?php
      $value = set_value('alternate_number');
      if(empty($value)){
        $value = (!empty($address_data[0]->alternate_number))?$address_data[0]->alternate_number:'';
      }
                        $attributes = array(
                        'name'	=> 'alternate_number',
                        'id'	=> 'alternate_number0',
                        'value'	=> $value,
                        'class' => 'form-control',
                        'type' => 'number',
                        'pattern' => '[0-9]{10,10}',
                        'title' => 'Enter only number between 0-9'
                        );
                        echo form_input($attributes);?>
          </div>


           <div class="radio-btn-manage mt-10">
            <p >Address Type</p>
            <div class="inner-gap"><div>
              <?php
          $value = set_value('address_type');
					if(empty($value)){
						$value = (!empty($address_data[0]->address_type))?$address_data[0]->address_type:'';
					}
         //echo $value;
    $attributes = array(
    'name'	=> 'address_type',
    'id'	=> 'address_type1',
    'class'=>'form-check-input',
    'value'	=> "Home",
    'required' => 'required',
    "checked" => ($value == "Home") ? "checked" : false
    );
    echo form_radio($attributes);?>
                          <?php $attributes = array('for'=>'address_type'); echo form_label('', 'address_type', $attributes);?>
                          <?php $attributes = array('class' => 'inner-radio'); echo form_label('Home', 'home', $attributes);?>


          <?php
          $value = set_value('address_type');
					if(empty($value)){
						$value = (!empty($address_data[0]->address_type))?$address_data[0]->address_type:'';
					}
         //echo $value;
    $attributes = array(
    'name'	=> 'address_type',
    'id'	=> 'address_type2',
    'class'=>'form-check-input',
    'value'	=> "Work",
    'required' => 'required',
    "checked" => ($value == "Work") ? "checked" : false
    );
    echo form_radio($attributes);?>
                          <?php $attributes = array('for'=>'address_type'); echo form_label('', 'address_type', $attributes);?>
           <?php $attributes = array('class' => 'inner-radio'); echo form_label('Work', 'work', $attributes);?>

              </div>
            </div>
          </div>

          <div class="save-btns mt-20">
            <button type="submit" id="submit" name="AddressSaveBTN" value="1" class="theme-btn">Save </button>
            <button class="theme-btn1 btn cancelBTN" type="button" tabindex="11" data-id="<?=$customers_address_id?>">CANCEL</button></div>
          </div><br>
        <?php echo form_close() ?>
      </div>

     </div>
<div class="paddng-12"> </div>
<script type="text/javascript">
$("#google_map_address").each(function() {

var target = this;
var $collapse = $(this).parents('.form-group').next('.collapse');
var $map = $collapse.find('.another-map-class');
var placepicker = $(this).placepicker({

  map: $map.get(0),
  placeChanged: function(place) {
  console.log(place);
  if(place.url != undefined && place.url != ''){
    $('#google_map_url').val(place.url);
  }
    console.log("place changed: ", place.formatted_address, this.getLocation());
  }
}).data('placepicker');
});
</script>
