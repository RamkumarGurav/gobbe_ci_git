<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href='index.html' rel='nofollow'><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                      <?php $this->load->view('template/left-menu', $this->data);?>
                        <div class="col-md-9">
                          <div class="tab-pane " id="address" role="tabpanel" aria-labelledby="address-tab">
                            <button type="button" class="btn btn-primary manageAddress " data-id="0"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: max-content !important;margin-bottom: 30px">
Add Address
</button><br>
                              <div class="row customers_address allAddressCl mt-5">
<br>

                                    <? if(!empty($customer_address_data->address)){ ?>
<? $this->load->view('template/customers_address' , $this->data); ?>
<? }else{
  ?>

  <?
} ?>

                              </div>
                          </div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Address</h1>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body add_edit_address_0" >

</div>
<div class="modal-footer">
  <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
<!-- <script>
$(document).ready(function(){
$(document).on("click","#hide",function() {
  $(this).text('Cancel');
  $(this).attr('id','show');
     $('#show1').show();
      $('#hide1').hide();
  });
$(document).on("click","#show",function() {
    $(this).text('Edit');
  $(this).attr('id','hide');
  $('#show1').hide();
      $('#hide1').show();
  });
});
</script> -->
<script type="text/javascript">
function getState(country_obj , state_element_id , state_id)
{
//var country_id = country_obj.value;
var country_id = 1;
	$.ajax({
   type: "POST",
	url:'<?=base_url()?>getState',
   //dataType : "json",
   data : {'country_id' : country_id , 'state_id' : state_id},
   success : function(result){
	 	$('#'+state_element_id).html(result);
	   }
   });
}

function getCity(state_id , city_element_id , city_id , state_id_n='')
{
	console.log();

if(state_id=='')
{
	state_id = state_id_n;
}
	$.ajax({
   type: "POST",
	url:'<?=base_url()?>getCity',
   //dataType : "json",
   data : {'state_id' : state_id , 'city_id' : city_id},
   success : function(result){
	 	$('#'+city_element_id).html(result);
	   }
   });
}
var id = 0;
window.addEventListener('load', function(){

	$(document).on("click", '.manageAddress', function(){
		id = $(this).data('id');

		editAddress(id);
	})
})
function editAddress(id)
{
	$(".add_edit_address_cl").html("");
	$.ajax({
   type: "POST",
	url:'<?=base_url()?>dashboard/editUpdateAddress',
   //dataType : "json",
   data : {'customers_address_id' : id},
   success : function(result){
     console.log(result);

	 	$('.add_edit_address_0').html(result);

		do_ship_address(id);
		$(document).on("click", ".cancelBTN", function(){
			$(".add_edit_address_"+$(this).data('id')).html('');
		})

		if($("*").hasClass("noAddress"))
		{
			$(".cancelBTN").remove();
		}
	   }
   });
}

function do_ship_address(id)
{

	$("#ship_address").submit(function(){
		event.preventDefault();
		$.ajax({
	   type: "POST",
		url:'<?=base_url()?>dashboard/do_ship_address',
	   dataType : "json",
	   data : $("#ship_address").serialize(),
	   success : function(result){

			if(result.status==0)
			{
				$('.add_edit_address_0').html(result.data_html);
				do_ship_address(id);
			}
			else
			{
        $('#exampleModal').modal('hide');
				$(".noAddressCl").html('');
				$('.allAddressCl').html(result.data_html);
			}
		   }
	   });

	});

}


</script>
