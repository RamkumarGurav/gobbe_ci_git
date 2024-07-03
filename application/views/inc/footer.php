<?
if (!empty($php_template)) {
	foreach ($php_template as $insert_page) {
			$this->load->view($insert_page, $this->data);
		}
}
?>
<footer class="main">

		 <section class="featured section-padding">
				 <div class="container">
						 <div class="row">
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-1.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Best prices & offers</h3>
														 <p>Orders more</p>
												 </div>
										 </div>
								 </div>
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-2.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Free delivery</h3>
														 <p>24/7 </p>
												 </div>
										 </div>
								 </div>
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-3.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Great daily deal</h3>
														 <p>When you sign up</p>
												 </div>
										 </div>
								 </div>
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-4.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Assortment</h3>
														 <p>Mega Discounts</p>
												 </div>
										 </div>
								 </div>
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-5.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Easy returns</h3>
														 <p>Within 30 days</p>
												 </div>
										 </div>
								 </div>
								 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
										 <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
												 <div class="banner-icon">
														 <img src="<?=IMAGE?>theme/icons/icon-6.svg" alt="" />
												 </div>
												 <div class="banner-text">
														 <h3 class="icon-box-title">Safe delivery</h3>
														 <p>Within 30 days</p>
												 </div>
										 </div>
								 </div>
						 </div>
				 </div>
		 </section>
		 <section class="section-padding footer-mid" style="background-image: url('<?=IMAGE?>footerbg.png'); background-color: #32f62433; background-blend-mode: overlay;">
				 <div class="container pt-15 pb-20">
						 <div class="row">
								 <div class="col-lg-3">
										 <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
												 <div class="logo mb-30">
														 <a class='mb-15' <?=base_url()?>><img src="<?=IMAGE?>gobbe.png" alt="logo" /></a>
														 <p class="font-sm">100% Pure Walnuts have an infinite number of health benefits and have high levels of proteins, omega-3 fatty acids, vitamins and poly-unsaturated fatty acids. </p>
												 </div>

										 </div>
								 </div>
								 <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
										 <h4 class="widget-title">Company</h4>
										 <ul class="footer-list mb-sm-5 mb-md-0">
												 <li><a href="<?=base_url()?>about-us">About Us</a></li>
												 <li><a href="<?=base_url()?>shipping-policy">Shipping Policy</a></li>
												 <li><a href="<?=base_url(__privacy_policy__)?>">Privacy Policy</a></li>
												 <li><a href="<?=base_url(__terms_conditions__)?>">Terms &amp; Conditions</a></li>
												 <li><a href="<?=base_url(__contactUs__)?>">Contact Us</a></li>
												 <li><a href="<?=base_url()?>return-policy">Return Policy</a></li>
										 </ul>
								 </div>
								 <div class="footer-link-widget col-lg-2 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
										 <h4 class="widget-title">Account</h4>
										 <ul class="footer-list mb-sm-5 mb-md-0">
												 <li><a href="<?=base_url(__login__)?>">Sign In</a></li>
												 <li><a href="<?=base_url(__cart__)?>">View Cart</a></li>
												 <li><a href="<?=base_url(__wishlist__)?>">My Wishlist</a></li>
												 <li><a href="<?=base_url('order_tracking')?>">Track My Order</a></li>
												 <!-- <li><a href="#">Help Ticket</a></li> -->
												 <li><a href="<?=base_url(__shippingAddress__)?>">Shipping Details</a></li>

										 </ul>
								 </div>
								 <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
										 <h4 class="widget-title">Categories</h4>
										 <ul class="footer-list mb-sm-5 mb-md-0">
											 <? if(!empty($menu)){ ?>
													<? foreach($menu as $m){ ?>
														<li>
																<a href="<?=$m->slug_url?>"> <?=$m->name?></a>
														</li>
													<?}?>
												<?}?>


										 </ul>
								 </div>
								 <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
										 <h4 class="widget-title">Contact Us</h4>
											<ul class="contact-infor">
														 <li><img src="<?=IMAGE?>theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span><?=$company_profile_data->address1?></span></li>
														 <li><img src="<?=IMAGE?>theme/icons/icon-contact.svg" alt="" /><strong>Call Us:</strong><span><?=$company_profile_data->mobile_no?></span></li>
														 <li><img src="<?=IMAGE?>theme/icons/icon-email-2.svg" alt="" /><strong>Email:</strong><span><?=$company_profile_data->email?></span></li>
														 <!-- <li><img src="<?=IMAGE?>theme/icons/icon-clock.svg" alt="" /><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span></li> -->
												 </ul>
													<h6 class="mt-4">Follow Us</h6>
											<div class="mobile-social-icon pt-3">

					 <?php if(_TWITTER_ != '') { ?><a href=<?=_TWITTER_?>><img src="<?=IMAGE?>theme/icons/icon-twitter-white.svg" alt="" /></a><?php } ?>
					 <?php if(_FACEBOOK_ != '') { ?><a href=<?=_FACEBOOK_?>><img src="<?=IMAGE?>theme/icons/icon-facebook-white.svg" alt="" /></a><?php } ?>
					 <?php if(_INSTAGRAM_ != '') { ?><a href=<?=_INSTAGRAM_?>><img src="<?=IMAGE?>theme/icons/icon-instagram-white.svg" alt="" /></a><?php } ?>
					 <?php if(_PININTEREST_ != '') { ?> <a href=<?=_PININTEREST_?>><img src="<?=IMAGE?>theme/icons/icon-pinterest-white.svg" alt="" /></a><?php } ?>
					 <?php if(_YOUTUBE_ != '') { ?><a href=<?=_YOUTUBE_?>><img src="<?=IMAGE?>theme/icons/icon-youtube-white.svg" alt="" /></a><?php } ?>


								 </div>
								 </div>

						 </div>
		 </section>
		 <section style="background: #383">
		 <div class="container pb-2 wow animate__animated animate__fadeInUp" data-wow-delay="0" >
				 <div class="row align-items-center">
						 <div class="col-12 mb-2">
								 <!-- <div class="footer-bottom"></div> -->
						 </div>
						 <div class="col-xl-12 col-lg-12 col-md-6">
								 <p class="font-sm mb-0" style="color: #fff !important;text-align: center;">&copy; 2024, <strong class="text-brand">GOBBE</strong> All rights reserved</p>
						 </div>

				 </div>
		 </div>
		 </section>
 </footer>
 <div class="message productUpdateShow" id="fix-content"><p id="popMsg"></p><span class="fa fa-times message-cross" onclick="hidePOpOver()"></span></div>
 <div class="loader" style="display:none">
  <div class="spinner-border text-primary " role="status">
      <span class="sr-only">Loading...</span>
  </div>
 </div>
 <script>
				const name_only = string => [...string].every(c => 'abcdefghijklmnopqrstuvwxyz-.ABCDEFGHIJKLMNOPQRSTUVWXYZ '.includes(c));
				const number_only = string => [...string].every(c => '0123456789'.includes(c));
		 </script>
 <script src="<?=JS?>common.min.js"></script>
<script src="<?=JS?>slider-range.js"></script>
<?php if (!empty($direct_js)) { foreach ($direct_js as $dj) { echo '<script src="'.$dj.'" type="text/javascript"></script>'; } } ?>

		<script src="<?=JS?>main-script.js"></script>
		<?php if (!empty($js)) { foreach ($js as $j) { echo '<script src="' . JS . $j . '" type="text/javascript"></script>'; } } ?>

<script type="text/javascript">
$('.getSuggestionDropdown').click(function(){

$(this).toggleClass('open');
});



$("#searchSugg").keyup(function(){
getsuggestion();
});

var currentSuggRequest = null;
var currentSuggString = null;
function getsuggestion(){
var q = document.getElementById('searchSugg').value;

if(currentSuggString != null && q =='')
{
 $(".getSuggestionDropdown").hide();
 $(".search_close_btn").hide();
 $('.searchSugg').val('');
 $(".search_btn1").show();
 $(".getSuggestionDropdown").html('');
 return false;
}
currentSuggString = q;
//var currentSuggRequest = null;
$(".getSuggestionDropdown").show();
currentSuggRequest = $.ajax({
 type: "POST",
 url:$('.siteUrl').val()+'Products/getsuggestion',
 //dataType : "json",
data : {'q':q},
beforeSend : function()    {
	 if(currentSuggRequest != null) {
	 currentSuggRequest.abort();
 }
},
success : function(result){

page_y_offset = window.pageYOffset;
	 $(".getSuggestionDropdown").html('');
 $(".search_btn1").hide();
 $(".getSuggestionDropdown").html(result);
 $(".search_close_btn").show();
	window.scrollTo(0, 0);
 console.log(page_y_offset);
 // afterLoadProductById('SS');
 lazy_product_func();

	 }

});
}

$('.search_close_btn').click(function(){
$(".getSuggestionDropdown").hide();
$(".search_close_btn").hide();
$('.searchSugg').val('');
$(".search_btn1").show();
$(".getSuggestionDropdown").html('');
});

</script>
</body>


</html>
