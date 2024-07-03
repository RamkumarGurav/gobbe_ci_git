<div class="dsm-main-content">
    <div class="cmc-tab">
        <div class="tab-pane-inner">
            <div class="tpi-title">
                <h4><?=$page_module_name?></h4>
            </div>

            <?php echo form_open(MAINSITE_Admin."$user_access->class_name/listing", array('method' => 'post', 'id' => 'ptype_search_form' , "name"=>"ptype_search_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

            <div class="tpi-filter-row">
              <div class="tfr-inner">
                
                    <!-- <div class="tfr-box"> -->
                    <div class="tfrb-search">
                    <label for="todsd">Customer Name</label>
                      <?php
                      $attributes = array(
                        'name'	=> 'field_value',
                        'id'	=> 'field_value',
                        'title' => "Field Value",
                          'class' => 'form-control',
                        'placeholder'=>"Search by Customer Name",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_input($attributes);
                      ?>
                    </div>
                    <?
                    $status_options = array(
                      ''=>'Select',
                      '1'=>'Order Placed',
                      '2'=>'InProcess',
                      '3'=>'Out For Delivery',
                      '4'=>'Delivered',
                      '5'=>'Not Delivered',
                      '6'=>'Cancelled',
                    );
                    ?>
                    <div class="tfrb-status">
                        <label for="todsd">Orders Status</label>
                      <?php
                      $attributes = array(
                        'name'	=> 'order_status_id',
                        'id'	=> 'order_status_id',
                        'class' => 'form-control',
                        'placeholder'=>"Search by Status",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_dropdown($attributes,$status_options);
                      ?>

                    </div>
                    <div class="tfrb-order-limit">
                        <label for="todsd">Orders From Date</label>
                      <?
                      $attributes = array(
                        'name'	=> 'start_date',
                        'id'	=> 'start_date',
                        'type'	=> 'date',
                        'class' => 'form-control',
                        'placeholder'=>"From Date",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_input($attributes);
                      ?>
                    </div>
                    <div class="tfrb-order-limit">
                      <label for="todsd">Orders To Date</label>
                      <?
                      $attributes = array(
                        'name'	=> 'end_date',
                        'id'	=> 'end_date',
                        'type'	=> 'date',
                        'class' => 'form-control',
                        'placeholder'=>"To Date",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_input($attributes);
                      ?>
                    </div>
                    <div class="tfrb-order-method">
                      <label for="todsd">Payment Method</label>
                      <?php
                      $modes = array(
                        ''=>'Payment Method',
                        '1'=>'Yes',
                        '2'=>'No'
                      );
                      $attributes = array(
                        'name'	=> 'is_cod',
                        'id'	=> 'is_cod',
                        'class' => 'form-control',
                        'placeholder'=>"Search by Status",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_dropdown($attributes,$modes);
                      ?>

                    </div>

                </div>
                    <div class="tfrb-btn">
                      <?php
                      $data = [
                          'name'    => 'search_report_btn',
                          'id'      => 'search_report_btn',
                          'value'   => '1',
                          'type'    => 'submit',
                          'content' => 'Filter',
                          'class' => 'btn2'
                        ];

                        echo form_button($data);
                      ?>
                      <?php
                      $data = [
                          'type'    => 'reset',
                          'content' => 'Reset',
                          'class' => 'btn1'
                        ];
                        echo form_button($data);
                      ?>
                    </div>
                    <!-- </div> -->

            </div>
            <?php echo form_close() ?>
            <?php
    if($user_access->view_module==1)	{
  ?>
            <div class="tpi-product-table">

                <div class="tpt-inner">
                  <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doUpdateStatus", array('method' => 'post', 'id' => 'ptype_list_form' , "name"=>"ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                  <input type="hidden" name="task" id="task" value="" />
                    <? echo $this->session->flashdata('alert_message'); ?>
                    <table  id="moduledatatable">
                        <thead>
                            <tr>
                                <td class="px-4 py-2 "><input class="selectAll" onclick="check_uncheck_All_records()" name="main_check" id="main_check"
                                        type="checkbox"></td>
                                        <td class="px-4 py-2 ">Order No</td>
                                        <td class="px-4 py-2 ">Order Time</td>
                                        <td class="px-4 py-2 ">Customer Name</td>
                                        <td class="px-4 py-2 ">Method</td>
                                        <td class="px-4 py-2 ">Amount</td>
                                        <td class="px-4 py-2 ">Status</td>
                                        <td class="px-4 py-2 text-center">Action</td>
                            </tr>
                        </thead>
                        <? if(!empty($list_data)){ ?>
                        <tbody>
                          <?
                          $offset_val = (int)$this->uri->segment(5);
                          $count=$offset_val;

                          foreach($list_data as $urm) {
                            $count++;
                              ?>
                              <tr>
                                  <td class="px-4 py-2"><input class="selectAll" name="sel_recds[]"
                                          type="checkbox" id="sel_recds<?php echo $count; ?>"
                                          value="<?php echo $urm->id; ?>"></td>
                                          <input type="hidden" name="sel_exrecds" value="<?php echo $urm->id; ?>">

                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <?=$urm->order_number	?>
                                      </span>
                                  </td>

                                  <td class="px-4 py-2">
                                      <span class="tpt-adrp">
                                              <?=date("d-m-Y h:i:s A" , strtotime($urm->added_on))?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <?=$urm->name	?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <?=$urm->mode	?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                <?=$urm->symbol	?>  <?=$urm->amount	?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <span class="od-action">

                                          <?php
                                          $attributes = array(
                                            'name'	=> 'order_status_id1',
                                            'id'	=> 'order_status_id1',
                                            'class' => 'form-control',
                                            'onchange'=>"updateOrderStatus(this.value,'$urm->id','$urm->order_number')",
                                            'placeholder'=>"Search by Status",
                                            'value'	=> set_value('field_value'),
                                            );
                                            echo form_dropdown($attributes,$status_options,$urm->order_status_id);
                                          ?>
                                    </span>
                                  </td>


                                  <td class="px-4 py-2">
                                      <div class="tpt-action-btn">
                                        <?php
                              if($user_access->view_module==1)	{
                            ?>
                            <div class="tpt-action-btn">
                                <div class="ro-print">
                                    <a href="#"><i class="fa-solid fa-print"></i></a>
                                </div>
                                <div class="ro-magnify order-details-pp" onclick="getOrdersDetails(<?=$urm->id?>)">
                                    <a href="#"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                                </div>
                            </div>
                                          <?
                                          }
                                          ?>
                                      </div>
                                  </td>


                              </tr>
                              <?
                          }
                          ?>

                        </tbody>
                        <?
                        }
                        ?>
                    </table>
                    	<?php echo form_close() ?>
                      <center><div class="pagination_custum"><? echo $this->pagination->create_links(); ?></div></center>

                </div>
            </div>
            <?
          }else{
  $this->data['no_access_flash_message']="You Dont Have Access To View ".$page_module_name;
  $this->load->view('admin/template/access_denied' , $this->data);
} ?>


        </div>

    </div>


</div>
</div>
<div class="module_data">

</div>
<script type="text/javascript">
function getOrdersDetails(orders_id) {
  $.ajax({
    url: '<?=MAINSITE_Admin.'orders/Orders_Module/details/'?>'+orders_id,
    type: 'post',
    dataType: "json",
    success: function( response ) {
      $(".module_data").html( response.module_data );
      $(".tpi-add-attr").toggleClass("tpi-add-attr-b");

    },
    error: function (request, error) {
      toastrDefaultErrorFunc("Unknown Error. Please Try Again");
      $("#quick_view_model").html( 'Unknown Error. Please Try Again' );
    }
  });
}
</script>
<script type="text/javascript">

function CalculateShippingPrice(){
$("#shipRicketResponseDiv").html('');
//var service = $("input[name='service']:checked").val();

var total_package_weight = $('#total_package_weight').val();
var box_l = $('#box_l').val();
var box_b = $('#box_b').val();
var box_h = $('#box_h').val();
var orders_id = $('#orders_id').val();

if(total_package_weight == '' || total_package_weight <=0)
{
  alert("Please Enter Product weight.");
  $('#total_package_weight').focus();
  return false;
}
if(box_l == '' || box_l <=0)
{
  alert("Please Enter Shipping Box Length.");
  $('#box_l').focus();
  return false;
}
if(box_b == '' || box_b <=0)
{
  alert("Please Enter Shipping Box Breadth.");
  $('#box_b').focus();
  return false;
}
if(box_h == '' || box_h <=0)
{
  alert("Please Enter Shipping Box height.");
  $('#box_h').focus();
  return false;
}
 var $this = $('.CalculateShippingBtn');
$this.button('loading');

$("#shipRicketResponseDiv").html("<div class=' alert alert-info'>Getting Rate for Courier Service.</div>");


$.ajax({
  type: "POST",
  url:'<?=MAINSITE?>secureRegions/orders/Orders-Module/shipping_service_api/',
  data : {  'orders_id' : orders_id , 'insurance' : 0 , 'total_package_weight' : total_package_weight , 'box_l' : box_l, 'box_b' : box_b , 'box_h' : box_h },
  success : function(result){
    $("#shipRicketResponseDiv").html("");
    $this.button('reset');
    //$('#shipRicketRateServiceData').html(result);
    $('#shipRicketResponseDiv').html(result);
    //$('#shipRicketRateServiceDataDiv').show();
  }
});
}
function assignShiprocketOrderAWB(courier_company_id , shipping_rate){
	if(courier_company_id=='')
	{
		alert("Something went wrong please try again");
		window.location.reload();
		return false;
	}
	if(confirm('Do you really want to assign Docket No.'))
	{
		// do nothing
	}
	else
	{
		return false;
	}


	$("#shipRicketResponseDiv").html('');
	//var service = $("input[name='service']:checked").val();
	var insurance = $("input[name='insurance']:checked").val();
	var total_package_weight = $('#total_package_weight').val();
	var box_l = $('#box_l').val();
	var box_b = $('#box_b').val();
	var box_h = $('#box_h').val();
	var orders_id = $('#orders_id').val();

	if(total_package_weight == '' || total_package_weight <=0)
	{
		alert("Please Enter Product weight.");
		$('#total_package_weight').focus();
		return false;
	}
	if(box_l == '' || box_l <=0)
	{
		alert("Please Enter Shipping Box Length.");
		$('#box_l').focus();
		return false;
	}
	if(box_b == '' || box_b <=0)
	{
		alert("Please Enter Shipping Box Breadth.");
		$('#box_b').focus();
		return false;
	}
	if(box_h == '' || box_h <=0)
	{
		alert("Please Enter Shipping Box height.");
		$('#box_h').focus();
		return false;
	}
	 var $this = $('.CalculateShippingBtn');
 	$this.button('loading');
	$(".assignShiprocketOrderAWBBTN").prop('disabled', true);
	$("#shipRicketResponseDiv").html("<div class=' alert alert-info'>Assigning Docket For Order.</div>");

	$.ajax({
		type: "POST",
		url:'<?=MAINSITE?>secureRegions/orders/Orders-Module/assign_order_awb_api/',
		data : {  'orders_id' : orders_id , 'insurance' : insurance , 'total_package_weight' : total_package_weight , 'box_l' : box_l, 'box_b' : box_b , 'box_h' : box_h  , 'courier_company_id' : courier_company_id , 'shipping_rate' : shipping_rate },
		success : function(result){
			$(".assignShiprocketOrderAWBBTN").prop('disabled', false);
			$("#shipRicketResponseDiv").html("");
			$(".shipping-price").html("");
			$this.button('reset');
			
			console.log(result);
			//$('#shipRicketRateServiceData').html(result);
			$('.label_data').html(result);
		}
	});
}
function assignShiprocketGenerateManifests(){
	if(confirm('Do you really want to Generate Manifest of Order.'))
	{
		// do nothing
	}
	else
	{
		return false;
	}

	var orders_id = $('#orders_id').val();

	$("#shipRicketResponseDiv").html('');

	$(".assignShiprocketGenerateManifestsBTN").prop('disabled', true);
	$("#shipRicketResponseDiv").html("<div class=' alert alert-info'>Generate Manifest For Order.</div>");

	$.ajax({
		type: "POST",
		url:'<?=MAINSITE?>secureRegions/orders/Orders-Module/assign_order_generate_manifest_api/',
		data : {  'orders_id' : orders_id },
		success : function(result){
			$(".assignShiprocketGenerateManifestsBTN").prop('disabled', false);
			$("#shipRicketResponseDiv").html("");
			//$('#shipRicketRateServiceData').html(result);
			$('#shipRicketResponseDiv').html(result);
		}
	});
}
function updateOrderStatus(order_status_id,orders_id,order_number) {
	if(confirm('Do you really want to Update Order Status.'))
	{
		// do nothing
	}
	else
	{
		return false;
	}
  if(order_status_id != ''){
    $.ajax({
      type: "POST",
      dataType:'json',
      url:'<?=MAINSITE?>secureRegions/orders/Orders-Module/update/',
      data : {  'orders_id' : orders_id , 'order_status' : order_status_id,'order_number':order_number  },
      success : function(result){
        if(result.return_code==1)
  			{
          toastr.success(result.message);

        }
        if(result.return_code==3)
  			{
          toastr.error(result.message);
        }
      },error: function (error) {
        console.log(error);
      alert('error; ' + eval(error));
    }
    });
  }
}
function trackShiprocketOrder(){

	var orders_id = $('#orders_id').val();

	$("#shipRicketResponseDiv").html('');

	$(".trackShiprocketOrderBTN").prop('disabled', true);
	$("#shipRicketResponseDiv").html("<div class=' alert alert-info'>Trackin Shipment.</div>");

	$.ajax({
		type: "POST",
    dataType: "json",
		url:'<?=MAINSITE?>secureRegions/orders/Orders-Module/track_order_api/',
		data : {  'orders_id' : orders_id },
		success : function(result){
			$(".trackShiprocketOrderBTN").prop('disabled', false);
			$("#shipRicketResponseDiv").html("");
			//$('#shipRicketRateServiceData').html(result);
      //console.log(result.result.data)
			$('#shipRicketResponseDiv').html('<b>'+result.result.data.status+'</b>');

			//$('.track_order_modal_body').html(result)

			//$('#track_order_modal').modal({show:true})
			$('#user_pin_close').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>')


		}
	});
}
</script>
