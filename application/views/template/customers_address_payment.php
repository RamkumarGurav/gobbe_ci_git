 <? //=$message?>
<? if(!empty($user->address)){$customer_address_data = $user;} ?>
<? if(!empty($customer_address_data)){ ?>
<? foreach($customer_address_data->address as $address){
//	print_r($address);
	 ?>

<div class="hide-div-label mt-30">
		                      			<label class="row "><br>
		                      				<div class="col-lg-1 col-1 address_label" data-id='<?=$address->customers_address_id?>'>

		                      				<input type="radio" class="hide-div-radio address_radio mt-10" data-id='<?=$address->customers_address_id?>' id="address_radio_<?=$address->customers_address_id?>" name="address" readonly="" <? 	if($address->billing_status ==1){?> checked <? } ?>>
		                      				</div>
		                      				<div class="col-lg-8 col-8">
		                      					<div  class="hide-div-address">
		                      							<p class="hide-div-address-content">
		                      								<span class="span1" style="font-size: 20px" ><?=$address->name?></span>
		                      								<span class="span2" style="font-size: 20px"><?=$address->address_type?></span>
		                      								<span class="span3" style="font-size: 20px"><?=$address->number?></span>
		                      							</p>

		                      								<span class="span4" style="font-size: 20px"><?=$address->address?>, <?=$address->city_name?>, <?=$address->state_name?>
		                      									<span class="span5" style="font-size: 20px"><?=$address->zipcode?></span>
		                      							</span><br>
		                      							<button data-id="<?=$address->customers_address_id?>" id="deliver_btn_<?=$address->customers_address_id?>" <? 	if($address->billing_status !=1){?> style="display:none" <? } ?> class="theme-btn hide-div-delever-here setDeliverHereAddress mt-10 deliver_btn">Deliver Here</button>
		                      							</div>


		                      					</div>
		                      					<div class="col-lg-3 col-3">
		                      						<div class="hide-div-edit">
		                      								<button type="button" class="theme-btn1 hide-div-edit-btn manageAddress edit_btn_cl" id="edit_btn_cl_<?=$address->customers_address_id?>" data-id="<?=$address->customers_address_id?>"  <? 	if($address->billing_status !=1){?> style="display:none" <? } ?>>EDIT</button>
		                      							</div>
		                      					</div>
		                      				</label>
                                            <div class="mt-30 add_edit_address_cl add_edit_address_<?=$address->customers_address_id?>" ></div>
                      			      </div>






<? } ?>

<? if(count($customer_address_data->address)==1){ ?>
<script>
window.addEventListener("load", function(){
	//$("#deliver_btn_<?=$address->customers_address_id?>").trigger("click");
	editDeliverHereAddress(<?=$address->customers_address_id?>);
})
</script>
<? } ?>

<? } ?>

<div class="card">

  <div class="card-body">
    <h5 class="card-title manageAddress font-sz-16" data-id="0"><i class="fa fa-plus"></i> Add New Address</h5>
    <div class="add_edit_address_0 add_edit_address_cl" ></div>
  </div>
</div>
