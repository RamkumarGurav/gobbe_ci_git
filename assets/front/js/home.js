if($("*").hasClass("slider_best_sellers"))
{
	getProducts('slider_best_sellers' , 'sr4' , 10);
}
if($("*").hasClass("slider_new_product"))
{
	getProducts('slider_new_product' , 'sr4' , 10);
}
if($("*").hasClass("slider_best_sellers_list"))
{
	getProducts('slider_best_sellers_list' , 'sr4' , 10);
}
if($("*").hasClass("slider_trending_now"))
{
	getProducts('slider_trending_now' , 'sr4' , 10);
}
if($("*").hasClass("slider_hot_selling_now"))
{
	getProducts('slider_hot_selling_now' , 'sr4' , 10);
}
if($("*").hasClass("popular_products_category"))
{
	getCategoryPopularProducts('popular_products_category' , 'sr4' , 10);
}
function getProducts(displayClass , classOffset , limit)
{

	var callFor = 'slider';
	// trending_now hot_selling_now best_sellers new_product
	var trending_now = 0;
	var d_items = 3;
	var hot_selling_now = 0;
	var best_sellers = 0;
	var new_product = 0;
	var recent_viewed_products = 0;
	var is_related = 0;
	var product_id = '';
	var product_combination_id = '';

	if(displayClass == 'slider_related_products_now')
	{
		is_related = 1;
		d_items = 5;
		var ids = $('.slider_related_products_now').data('val');
		var idsarr = ids.split(',');
		product_id = idsarr[0];
		product_combination_id = idsarr[1];
		var callFor = 'slider';
	}
	if(displayClass == 'slider_trending_now')
	{ trending_now = 1;var callFor = 'list'; }
	if(displayClass == 'recent_viewed_products')
	{ recent_viewed_products = 1; }
	if(displayClass == 'slider_hot_selling_now')
	{ hot_selling_now = 1;var callFor = 'list'; }
	if(displayClass == 'slider_best_sellers')
	{ best_sellers = 1; }
	if(displayClass == 'slider_best_sellers_list')
	{ best_sellers = 1; var callFor = 'list';}
	if(displayClass == 'slider_best_sellers_pd_page')
	{ best_sellers = 1;callFor = 'non_slider_pd'; }
	if(displayClass == 'slider_new_product')
	{ new_product = 1;var callFor = 'list'; }
	//alert(displayClass);

	$.ajax({
		type: "POST",
		async: true,
		 headers: {
			'Content-Type':'application/x-www-form-urlencoded'
		},
		url:"Products/loadProductIndex",
	   data : {'callFor':callFor , 'classOffset':classOffset , 'limit':limit , 'trending_now':trending_now ,'recent_viewed_products':recent_viewed_products, 'hot_selling_now':hot_selling_now , 'best_sellers':best_sellers , 'new_product':new_product , 'is_related':is_related , 'order':'random' , 'product_id':product_id , 'product_combination_id':product_combination_id , 'in_stock':1},
	   success : function(result){
		$("."+displayClass).html(result);
    	if(displayClass == 'slider_best_sellers_pd_page')
    	{ }
    	else{

		if(callFor == 'slider')
		{

        setSlickCarousel(displayClass, d_items);
		}
    	}

		if(displayClass == 'slider_related_products_now')
		{
			if(result=='NoMoreProducts')
			{
				$('.slider_related_products_now_main').hide();
			}
		}

		lazy_product_func();
		afterLoadProductD(classOffset);
		}
   });

}
function getCategoryPopularProducts(displayClass , classOffset , limit)
{

	var callFor = 'slider';
	// trending_now hot_selling_now best_sellers new_product
	var trending_now = 0;
	var d_items = 3;
	var hot_selling_now = 0;
	var best_sellers = 0;
	var new_product = 0;
	var recent_viewed_products = 0;
	var is_related = 0;
	var product_id = '';
	var product_combination_id = '';

	if(displayClass == 'slider_related_products_now')
	{
		is_related = 1;
		d_items = 5;
		var ids = $('.slider_related_products_now').data('val');
		var idsarr = ids.split(',');
		product_id = idsarr[0];
		product_combination_id = idsarr[1];
		var callFor = 'slider';
	}
	if(displayClass == 'slider_trending_now')
	{ trending_now = 1;var callFor = 'list'; }
	if(displayClass == 'recent_viewed_products')
	{ recent_viewed_products = 1; }
	if(displayClass == 'slider_hot_selling_now')
	{ hot_selling_now = 1;var callFor = 'list'; }
	if(displayClass == 'slider_best_sellers')
	{ best_sellers = 1; }
	if(displayClass == 'slider_best_sellers_list')
	{ best_sellers = 1; var callFor = 'list';}
	if(displayClass == 'slider_best_sellers_pd_page')
	{ best_sellers = 1;callFor = 'non_slider_pd'; }
	if(displayClass == 'slider_new_product')
	{ new_product = 1;var callFor = 'list'; }
  if(displayClass == 'popular_products_category')
	{ best_sellers = 1;}	//alert(displayClass);
  var product_category = 1;
	$.ajax({
    type: 'post',
    dataType: "json",
		url:'Products/getCategoryPopularProducts',
	  data : {'callFor':callFor , 'product_category': product_category,'classOffset':classOffset , 'limit':limit , 'trending_now':trending_now ,'recent_viewed_products':recent_viewed_products, 'hot_selling_now':hot_selling_now , 'best_sellers':best_sellers , 'new_product':new_product , 'is_related':is_related , 'order':'random' , 'product_id':product_id , 'product_combination_id':product_combination_id , 'in_stock':1},
	   success : function(result){
		$("."+displayClass).html(result.tab_httml);
		$(".popular_products_category_content").html(result.tab_content_html_data);
    	if(displayClass == 'slider_best_sellers_pd_page')
    	{ }
    	else{

		if(callFor == 'slider')
		{
    //  setTimeout(myGreeting, 5000);
      // Call setSlickCarousel function after 3 seconds

           setSlickMultipleCarousel(displayClass, d_items);


	 		//setSlickCarousel(displayClass , d_items);
		}
    	}

		if(displayClass == 'slider_related_products_now')
		{
			if(result=='NoMoreProducts')
			{
				$('.slider_related_products_now_main').hide();
			}
		}

		lazy_product_func();
		afterLoadProductD(classOffset);
		}
   });

}

function afterLoadProductD(ids)
{
	//$('[data-toggle="tooltip"]').tooltip()
	$(".addToCartListBTN"+ids).click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		addToCartList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});

	$(".addToWishlistListBTN"+ids).click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		addToWishlistList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});

	$(".incToCartListBTN"+ids).click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		AddToCart(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});
}
function lazy_product_func()
{
	var lazyImages = [].slice.call(document.querySelectorAll("img.lazy_product"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
		  var temp = lazyImage.dataset.page_count;
		  lazyImage.classList.remove("lazy_product");
		  if(temp==5)
		  {
			  //loadMoreProductFunc();
		  }
		  //console.log(temp);
          lazyImage.classList.remove("lazy_product");
          lazyImageObserver.unobserve(lazyImage);
        }
      });
    });

    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  } else {
    // Possibly fall back to a more compatible method here
  }
}

function setSlickCarousel(id , d_items=4)
{
      var sliderID = "#" + id;
      var appendArrowsClassName = "#" + id + "-arrows";
      //$(sliderID).slick('refresh'); //Working for slick 1.8.1
      $(sliderID).slick('unslick');
      $(sliderID).slick({
          dots: false,
          infinite: true,
          speed: 1000,
          arrows: true,
          autoplay: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          loop: true,
          adaptiveHeight: true,
          responsive: [
              {
                  breakpoint: 1025,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                  }
              }
          ],
          prevArrow: '<span class="slider-btn slider-prev"><i class="fa fa-angle-left"></i></span>',
          nextArrow: '<span class="slider-btn slider-next"><i class="fa fa-angle-right"></i></span>',
          appendArrows: appendArrowsClassName
      });



}
function setSlickMultipleCarousel(displayClass, d_items) {
  $(".popular_products_category_content_slider").each(function (key, item) {
      var id = $(this).attr("id");
      var sliderID = "#" + id;
      var appendArrowsClassName = "#" + id + "-arrows";

      $(sliderID).slick({
          dots: false,
          infinite: true,
          speed: 1000,
          arrows: true,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          loop: true,
          adaptiveHeight: true,
          responsive: [
              {
                  breakpoint: 1025,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                  }
              }
          ],
          prevArrow: '<span class="slider-btn slider-prev"><i class="fa fa-angle-left"></i></span>',
          nextArrow: '<span class="slider-btn slider-next"><i class="fa fa-angle-right"></i></span>',
          appendArrows: appendArrowsClassName
      });
  });
}
function ValidateEmail(mail)
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}
function validate_newsletter_email()
{
	event.preventDefault();
	$('#newsletter_email_err').removeClass('hidden');
	$('#newsletter_email_err').hide();
	$('#newsletter_email_err').html('');
	$('#newsletter_email_msg').html('');
	var count=0;
	var err='';
	var email = document.getElementById("newsletter_email");

	if(email.value == '')
	{
		err = 'Email Should Not Be Empty';
		count++;
		email.focus();
	}
	else if(!ValidateEmail(email.value))
	{
		err = 'Please Enter Valid Email Id';
		count++;
		email.focus();
	}

	if(count>0)
	{
		$('#loader').hide();
		$('#newsletter_email_err').show();
		$('#newsletter_email_err').html(err);
		return false;
	}
	else
	{
		$('#loader').show();
		$.ajax({
			type: 'post',
			url: $('.siteUrl').html()+'User/newsletter_email/',
			data: {'email':email.value},
			dataType: "json",
			success: function (data) {
				if(data.status=='true')
				{
					$('#newsletter_email_msg').html(data.message);
					email.value='';
				}
				else
				{
					$('#newsletter_email_msg').html(data.message);

				}
				$('#loader').hide();
				setAllAnchorFunc();
			},
			error: function (data) {
				$('#loader').hide();
				alert('Unknown error occurred.');
			},
		});
	}
}
