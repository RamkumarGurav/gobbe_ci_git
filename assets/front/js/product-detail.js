(function ($) {
    'use strict';
    /*Product Details*/
    var productDetails = function () {
        $('.product-image-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.slider-nav-thumbnails',
        });

        $('.slider-nav-thumbnails').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.product-image-slider',
            dots: false,
            focusOnSelect: true,

            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>'
        });

        // Remove active class from all thumbnail slides
        $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

        // Set active class to first thumbnail slides
        $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

        // On before slide change match active thumbnail to current slide
        $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var mySlideNumber = nextSlide;
            $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
            $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
        });

        $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var img = $(slick.$slides[nextSlide]).find("img");
            $('.zoomWindowContainer,.zoomContainer').remove();
            if ($(window).width() > 768) {
                $(img).elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
            }
        });
        //Elevate Zoom
        if ( $(".product-image-slider").length ) {
            if ($(window).width() > 768) {
                $('.product-image-slider .slick-active img').elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
            }
        }
        //Filter color/Size
        $('.list-filter').each(function () {
            // $(this).find('a').on('click', function (event) {
            //     event.preventDefault();
            //     $(this).parent().siblings().removeClass('active');
            //     $(this).parent().toggleClass('active');
            //     $(this).parents('.attr-detail').find('.current-size').text($(this).text());
            //     $(this).parents('.attr-detail').find('.current-color').text($(this).attr('data-color'));
            // });
        });

        //Qty Up-Down
        $('.detail-qty').each(function () {
            var qtyval = parseInt($(this).find(".qty-val").val(), 10);
            var $qtyInput = $(this).find(".qty-val");

            $(this).find('.qty-up').on('click', function (event) {
                event.preventDefault();
                qtyval = qtyval + 1;
                $qtyInput.val(qtyval);
            });

            $(this).find(".qty-down").on("click", function (event) {
                event.preventDefault();/*  */
                qtyval = Math.max(1, qtyval - 1);
                $qtyInput.val(qtyval);
            });
        });

        $('.dropdown-menu .cart_list').on('click', function (event) {
            event.stopPropagation();
        });
    };

    //Load functions
    $(document).ready(function () {
        productDetails();
    });
    if($("*").hasClass("slider_related_products_now"))
    {
    	getProducts('slider_related_products_now' , 'sr4' , 10);
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
	$.ajax({
		type: "POST",
		async: true,
		 headers: {
			'Content-Type':'application/x-www-form-urlencoded'
		},
		url:$('.siteUrl').val()+"Products/loadProductIndex",
		//dataType : "json",
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
function setSlickCarousel(id , d_items=4)
{
      var sliderID = "#" + id;
      var appendArrowsClassName = "#" + id + "-arrows";
      //$(sliderID).slick('refresh'); //Working for slick 1.8.1

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


})(jQuery);
