<main class="main">
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?=base_url()?>" rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
                    <span></span> Checkout <span></span>
                </div>
            </div>
        </div>
        <div class=" mb-30 mt-50">
            <div class="container mb-80 mt-50">
           <!--  <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Checkout</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand"><?=count($products_list)?></span> products in your cart</h6>
                    </div>
                </div>
            </div> -->
              <div class="row">
                <div class="col-lg-7">
                   <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Checkout</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand"><?=count($products_list)?></span> products in your cart</h6>
                    </div>
                </div>

                    <? if(!empty($temp_name)){
                      ?>
                      <div class="l-c-head changeAddress box-bg tab2_selected" style="display:none">
                            <h3 class="l-c-h3">
                              <span class="l-c-span"></span></h3>
                              <div class="l-c-div">
                                <div class="l-c-login">
                                  <h4>DELIVERY ADDRESS
                                  <svg height="10" width="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="_1t8m48"><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" stroke="#859212"></path></svg></h4>
                                </div>
                                <div class="l-c-phone mt-10"><div>
                                  <span class="l-c-phone-span allAddressSelectedCl">
                                              <? $this->load->view('template/selected_customers_address_payment' , $this->data); ?>
                                              </span>
                                </div>
                              </div>
                            </div>
                            <div class=" mt-10 d-flex justify-content-between">
                            <button class="l-c-change-btn changeAddressDivBtn theme-btn" id="show">Change</button>
                            <button class="proccedtoPayment theme-btn1">Proceed To Payment</button>
                          </div>
                          </div>
                    <div class="hide-div changeAddressDiv box-bg tab2_selection" >
                    <h4>Delivery Address
                    </h4>
                    <div class="hide-div-content1 allAddressCl">


                  <? $this->load->view('template/customers_address_payment' , $this->data); ?>

                  <!--  </div> -->
                    </div>
                    </div>
                    <? } ?>
                    <div class="payment  proccedtoPaymentTab box-bg"  style="display:none;">
                      <form action="<?=base_url().'pay-now'?>" id="pay-now" onsubmit="doPay()"  method="post">

                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_type" id="payment_type_1" value="1"  checked>
                                <label class="form-check-label" for="payment_type_1" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Online Payment</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_type" id="payment_type_2" value="2"   >
                                <label class="form-check-label" for="payment_type_2" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                            </div>

                        </div><br>
                        <div class="payment-logo mt-5 d-flex">
                            <img class="mr-15" src="<?=MAINSITE?>assets/front/images/theme/payment-paypal.svg" alt="">
                            <img class="mr-15" src="<?=MAINSITE?>assets/front/images/theme/payment-visa.svg" alt="">
                            <img class="mr-15" src="<?=MAINSITE?>assets/front/images/theme/payment-master.svg" alt="">
                            <img src="<?=MAINSITE?>assets/front/images/theme/payment-zapper.svg" alt="">
                        </div>
                        <button type="submit" id="payNowBTN" name="orderBTN" value="1" class="btn btn-fill-out btn-block mt-30 subscribe_btn proceed_ckt">  <i class="fa fa-sign-out ml-15"></i>&nbsp; Place an Order</button>

                      </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>

                        </div>
                        <div class="divider-2 mb-30"></div>
                       <? $this->load->view('template/cart-checkout' , $this->data); ?>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <div id="paydata"></div>

<form action="<?=base_url().'payment_verify'?>" name="payment_verify_form" id="payment_verify_form" method="post">
<input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="" />
<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="" />
<input type="hidden" name="razorpay_signature" id="razorpay_signature" value="" />
</form>

<script type="application/javascript" src="https://checkout.razorpay.com/v1/checkout.js"></script>
    </main>
    <script type="text/javascript">
    function demoSuccessHandler(transaction) {
	$(".loader").show();
	//console.log(transaction);
	$('#razorpay_order_id').val(transaction.razorpay_order_id);
	$('#razorpay_payment_id').val(transaction.razorpay_payment_id);
	$('#razorpay_signature').val(transaction.razorpay_signature);
	document.getElementById('payment_verify_form').submit();

}

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
      $(document).on("click", '.setDeliverHereAddress', function(){
        id = $(this).data('id');

        editDeliverHereAddress(id);
      })

    })
    function editDeliverHereAddress(id)
    {
      $(".add_edit_address_cl").html("");
      $.ajax({
       type: "POST",
      url:'<?=base_url()?>dashboard/editDeliverHereAddress',
       dataType : "json",
       data : {'customers_address_id' : id},
       success : function(result){
        if(result.status==0)
          {
            //$('.add_edit_address_'+id).html(result.data_html);
            //do_ship_address(id);
          }
          else
          {
            //$(".noAddressCl").html('');
            //$('.allAddressCl').html(result.data_html);
            $('.allAddressSelectedCl').html(result.data_selected_html);
            $(".changeAddressDiv").hide();
            $(".proccedtoPaymentTab").hide();
            $(".changeAddress").show();


          }
         }
       });
    }

    function editAddress(id)
    {
      $('.loader').show();
      $(".add_edit_address_cl").html("");
      $.ajax({
       type: "POST",
      url:'<?=base_url()?>dashboard/editUpdateAddressPayment',
       //dataType : "json",
       data : {'customers_address_id' : id},
       success : function(result){
         $('.loader').hide();
        $('.add_edit_address_'+id).html(result);
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
        $('.loader').show();
        $.ajax({
         type: "POST",
        url:'<?=base_url()?>dashboard/do_ship_address_payment',
         dataType : "json",
         data : $("#ship_address").serialize(),
         success : function(result){
           $('.loader').hide();

          if(result.status==0)
          {
            $('.add_edit_address_'+id).html(result.data_html);
            do_ship_address(id);
          }
          else
          {
            $(".noAddressCl").html('');
            $('.allAddressCl').html(result.data_html);
            $('.allAddressSelectedCl').html(result.data_selected_html);
            $(".changeAddressDiv").hide();
            $(".proccedtoPaymentTab").hide();
            $(".changeAddress").show();


          }
           }
         });

      });

    }
window.addEventListener("load", function(){
    $(document).on("click", ".changeAddressDivBtn", function(e){
  $(".changeAddressDiv").show();
  $(".changeAddress").hide();


});
  $(document).on("click", ".proccedtoPayment", function(e){
  $(".proccedtoPaymentTab").show();
  $(".changeAddressDiv").hide();
  $(".changeAddress").hide();
  });
  $(document).on("change", ".address_radio", function(){
  id = $(this).data('id');
  $(".deliver_btn").hide();
  $("#deliver_btn_"+id).show();

  $(".edit_btn_cl").hide();
  $("#edit_btn_cl_"+id).show();
})
});
    </script>

    <script>
    function doPay(){

      $('.errorInfo').html('');
      event.preventDefault();
      var payment_type = $('input[name="payment_type"]:checked').val();
       if(payment_type==2)
       {
        // order_cod_func();
        var form_url =  "<?=base_url().'place-cod-order'?>";
        $('#pay-now').attr('action',form_url);
        //$('#pay-now').trigger('submit');
        document.getElementById('pay-now').submit();
      }else if(payment_type==1)
      {
        var form_url =  "<?=base_url().'pay-now'?>";
      $("#payNowBTN").prepend('<i class="fa fa-spinner fa-spin"></i>  ');
      $("#payNowBTN").attr('disabled', true);
        var data = $("#micro_chipForm").serialize();

      $.ajax({
       type: "POST",
      url:"<?=base_url('pay-now')?>",
       // dataType : "json",
       data : $("#micro_chipForm").serialize(),
       success : function(result)
       {
         var text = $("#payNowBTN").html()
         text = text.replace('<i class="fa fa-spinner fa-spin"></i>', '');
         $("#payNowBTN").html(text);
         $("#paydata").html(result);
          if(result.status==1)
          {


            window.location.href = result.url;
          }
          else
          {

            $('.errorInfo').html(result.message);
          }

        }
       });
      }
      else
      {
        $('.errorInfo').html("Please select Payment type");
      }
    }
    </script>
