<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?=base_url()?>" rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
                    <span></span> Cart
                    <span></span>
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-12 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand"><?echo (isset($products_list) ) ? count($products_list) : '0';?></span> products in your cart</h6>
                    </div>
                </div>
            </div>
            <div class="row cartPage">
              	<?=$message?>
                              <? $this->load->view('template/cart' , $this->data); ?>

            </div>
        </div>
    </main>
<script>
function getPincodeDetail(){

$('#PincodeData').html('');
var pincode_d =  document.getElementById('pincode_d');
if(pincode_d.value == '')
{
  return false;
}
if(pincode_d.value.length !=6)
{
  $('#PincodeData').html('<span style="color:red">Enter 6 Digit Pincode</span>');
  pincode_d.focus();
  return false;
}
if(!number_only (pincode_d.value))
{
  $('#PincodeData').html('<span style="color:red">Enter 6 Digit Pincode</span>');
  pincode_d.focus();
  return false;
}

$('#PincodeData').html('Checking Availability...');
$.ajax({
  type: "POST",
  url:'<?=MAINSITE?>Products/getPincodeDetail/',
  data : {   'pincode' : pincode_d.value, 'page' : 'cart'},
  success : function(result){
    $('#PincodeData').html(result);

  }
});
}
</script>
