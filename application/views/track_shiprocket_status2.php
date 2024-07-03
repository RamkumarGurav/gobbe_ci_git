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
													<div class="" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
															<div class="card">
																	<div class="card-header">
																			<h3 class="mb-0">Orders tracking</h3>
																	</div>
																	<div class="card-body contact-from-area">
																			<p>To track your order please enter your Order Number in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
																			<div class="row">
																					<div class="col-lg-8">
																							<form class="contact-form-style mt-30 mb-50" action="#" method="post">
																									<div class="input-style mb-20">
																											<label>Order Number</label>
																											<input name="order_number" id="order_number" placeholder="Order Number" type="text" />
																									</div>
																									<div class="tracking_html">

																									</div>
																									<button class="submit submit-auto-width" onclick="track_order_api()" type="button">Track</button>

																							</form>

																					</div>
																			</div>
																	</div>
															</div>
													</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</main>

<script>
	function track_order_api(id)
	{
		var order_number = $('#order_number').val();
			event.preventDefault();
			$.ajax({
		   type: "POST",
			url:'<?=base_url()?>dashboard/track_order_api',
		   dataType : "json",
		   data : {'order_number':order_number},
		   success : function(result){
	       console.log(result.template);
				 $('.tracking_html').html(result.template.message);
		   }

		});

	}
</script>
