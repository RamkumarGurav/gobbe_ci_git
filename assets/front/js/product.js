function lazy_product_func()
{

	var lazyImages = [].slice.call(document.querySelectorAll("img.lazy_product"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
		  var callfor = lazyImage.dataset.callfor;
		  var temp = lazyImage.dataset.page_count;
		  if(temp==5 && callfor != 'slider')
		  {
        console.log('test');
			  loadMoreProductFunc();
		  }
		  console.log(temp);
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
lazy_product_func();



var offset=0;
function loadMoreProductFunc()
{

	//$(".loadMoreProduct").addClass('btn-primary').removeClass('no-more-pdts').html('Load More Products');
	/*offset = Number(offset)+Number(1);
	console.log("offset : "+offset);
	document.getElementById('offset').value = offset;*/
	var offset='';
	if(document.getElementById('offset'))
	{
	offset = document.getElementById('offset').value ;
		offset++;
		document.getElementById('offset').value = offset;
	}
	main_cat_search = document.getElementById('main_cat_search').value
	sub_cat_search = document.getElementById('sub_cat_search').value
	//if(Number($(".products_list_count").html())>Number($(".DisplayMoreProd .prodDiv").length))

	{
		//$(".loader").show();
		$("#list_loder").show();

		$.ajax({
			type: "POST",
			//url:$('.siteUrl').val()+'products/loadMoreProduct',

			url:$('.siteUrl').val()+'products/loadMoreProduct/'+main_cat_search+'/'+sub_cat_search,
			/*dataType : "json",*/
			data : $('#prd_search_form').serialize(),
			success : function(result){
				if(result=='NoMoreProducts')
				{
					//$(".loadMoreProduct").addClass('no-more-pdts').removeClass('btn-primary').html('No more products to display.');
					$(".loadMoreProductText").html('No More Products...');
					showPOpOver("No more products to display." , 4000);
				}
				else
				{

					$(".loadMoreProduct").addClass('btn-primary').removeClass('no-more-pdts');
					$(".DisplayMoreProd").append(result);
					afterLoadProduct(offset);
				}
				lazy_product_func();
				//$(".loader").css("display","none");
				//$(".loader").hide();
				$("#list_loder").hide();

			}
		});
	}
	/*else
	{
		$(".loadMoreProduct").html('No More Products To Display.');
		showPOpOver("No More Products To Display." , 4000);
	}*/
}
function afterLoadProduct(ids)
{
	ids = ids * 12;
	afterLoadProductById(ids);
}
function afterLoadProductById(ids)
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
function addToWishlistList(pis_id, p_id , pc_id , task , page='')
{
	$(".loader").show();
	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/wishlistTask',
		dataType : "json",
	   data : {'qty':$(".cart_increment_"+pis_id).val() , "pis_id":pis_id, "p_id":p_id, "pc_id":pc_id, "task":task},
	   success : function(result){
		showPOpOver(result.msg , 3000);
		$('.sess_wishlist_count').html(result.in_wishlist);
		$('.sess_cart_count').html(result.in_cart);
		if(result.status)
		{

			if(result.task==1)
			{
				$(".cart_wishlist_y_"+pis_id).show();
				$(".cart_wishlist_n_"+pis_id).hide();
			}
			else
			{
				$(".cart_wishlist_y_"+pis_id).hide();
				$(".cart_wishlist_n_"+pis_id).show();
			}
			if(result.task==3)
			{
				getCartPageDetail();
			}
		}
		getWishlistPageDetail();
		$(".loader").css("display","none");
		setAllAnchorFunc();
		}
   });
}
function getWishlistPageDetail(){
	$(".loader").show();
	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'Products/my_wishlist_page_detail',
		/*dataType : "json",*/
		data : '',
		success : function(result){
			$(".wishlistPage").html(result);
			setWishlistBtn();
			$(".loader").css("display","none");
			setAllAnchorFunc();
		}
	});
}
function searchProduct()
{
	main_cat_search = document.getElementById('main_cat_search').value;
	sub_cat_search = document.getElementById('sub_cat_search').value;
	p_search_by = document.getElementById('p_search_by').value;
	var is_max_price = false;
	if(document.getElementById('max_price').value == $("#c_max_final_price").val())
	{
		is_max_price = true;
		//document.getElementById('max_price').value = 0;
	}

	var is_min_price = false;
	if(document.getElementById('min_price').value == $("#r_min_final_price").val())
	{
		is_min_price = true;
		//document.getElementById('min_price').value = 0;
	}

//	console.log(c_max_final_price + " : " +document.getElementById('max_price').value);
//	console.log(r_min_final_price + " : " +document.getElementById('min_price').value);

	document.getElementById('offset').value = 0;
	$(".loadMoreProduct").addClass('btn-primary').removeClass('no-more-pdts').html('Load More Products');
	$(".loader").show();
	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/all_products_search/'+main_cat_search+'/'+sub_cat_search,
		/*dataType : "json",*/
		data : $('#prd_search_form').serialize(),
		success : function(result){
			$('#p_search_by').val('');
			$(".loader").css("display","none");
			$(".DisplayMoreProd").html(result);
			lazy_product_func();
			$(".loadMoreProductText").html('');
			if(result=='NoMoreProducts')
			{
				//$(".loadMoreProduct").addClass('no-more-pdts').removeClass('btn-primary').html('No more products to display.');
				//$(".loadMoreProductText").html('Thats all Folks...');
				//showPOpOver("No more products to display." , 3000);

			}

			if(is_max_price)
			{
				document.getElementById('max_price').value = c_max_final_price;
			}

			if(is_min_price)
			{
				document.getElementById('min_price').value = r_min_final_price;
			}

			$(".addToCartListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				addToCartList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});

			$(".addToWishlistListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				addToWishlistList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});

			$(".incToCartListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				AddToCart(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});
			//StarRatingJs();
			//setAllAnchorFunc();

		}
	});
}

var toClearTimeout='';
function showPOpOver(msg , time){

$('#fix-content').css("display","block");
//$('.message').slideDown(300).delay(4000).slideUp(300);

$('#popMsg').html(msg);
clearTimeout(toClearTimeout);
toClearTimeout = setTimeout(function(){ hidePOpOver(); }, time);
}
function hidePOpOver(){
$('#fix-content').css("display","none");
}


//add to cart


$(document).on("click",".addToCartListBTN",function() {
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				addToCartList(idsarr[0] , idsarr[1] , idsarr[2] ,idsarr[3])
});
$(document).on("click",".addToWishlistListBTN",function() {

	var ids = $(this).data('val');
	var idsarr = ids.split(',');
	addToWishlistList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
});
$(document).on("click",".incToCartListBTNCART",function() {

	var ids = $(this).data('val');
	var idsarr = ids.split(',');
	AddToCartCK(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3],idsarr[4])
});

function AddToCartCK(pis_id , p_id , pc_id , task , page='')
{

	//alert(input_obj.length);
	//alert($(".cart_increment_"+pis_id).html())
	if(task==1)
	{/*remove from cart*/
    if($(".cart_increment_"+pis_id).html() == '1'){
      //alert('Atleast one Quantity Should be There');
      //return false;
      location.reload();
    }
		$(".cart_increment_"+pis_id).html();
		if(Number($(".cart_increment_"+pis_id).val())-Number(1)==0)
		{
			$('.productAddShow_'+pis_id).show();
			$('.productInCartShow_'+pis_id).hide();
			$(".qty_increDecre_"+pis_id).removeClass('showing');
			//document.getElementById("cart_increment_"+pis_id).value=1;
		}
	}
	if(task==2)
	{/*add in cart*/
		/*$(".cart_increment_"+pis_id).html(Number($(".cart_increment_"+pis_id).html())+Number(1));*/
	}
	$(".loader").show();

	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/cartTask',
		dataType : "json",
   data : {'qty':$(".cart_increment_"+pis_id).html() , "pis_id":pis_id, "p_id":p_id, "pc_id":pc_id, "task":task},
   //data : {'qty':1 , "pis_id":pis_id, "p_id":p_id, "pc_id":pc_id, "task":task},
   success : function(result){
	   showPOpOver(result.msg , 3000 , result.message_alert_type);
	   $("body").append(result.script);
	   	$(".cart_increment_"+pis_id).html(result.cart_qty);
	   	$(".cart_increment_"+pis_id).val(result.cart_qty);
		$(".sess_cart_count").html(result.getCartItemCount);
		update_head_cart();
		if(page=='cart')
		{

			getCartPageDetail();
		}
		else
		{
			getCartDetail();
		}

		//alert(result.cart_qty);
		if(result.cart_qty==0){$('.qty_increDecre_'+pis_id).hide();}
		$(".loader").css("display","none");
		setAllAnchorFunc();
    refreshCheckoutPrices();
		}
   });
}
function refreshCheckoutPrices(){
  $.ajax({
    type: "POST",
    url:$('.siteUrl').val()+'Payment_Checkout/refreshCheckoutPrices',
    dataType : "json",
    data : '',
    success : function(result){
      $(".loader").css("display","none");
      $('.summary-price').html(result.html);
      $('#pay-now').html(result.html2);
    }
  });
}

function addToCartList(pis_id, p_id , pc_id , task , page='')
{
	if($(".cart_increment_page_"+pis_id).html()=='undefined' || $(".cart_increment_page_"+pis_id).html()<=0)
	{
		alert("Please Enter Quantity");
		return false;
	}
	$('.productAddShow_'+pis_id).hide();
	$('.productInCartShow_'+pis_id).show();
	$(".qty_increDecre_"+pis_id).addClass('showing');
	$(".loader").show();

	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/cartTask',
		dataType : "json",
	   data : {'qty':$(".cart_increment_page_"+pis_id).html() , "pis_id":pis_id,"p_id":p_id, "pc_id":pc_id, "task":task },
	   success : function(result){
		$("body").append(result.script);
		   $('.sess_wishlist_count').html(result.in_wishlist);
		showPOpOver(result.msg , 3000 , result.message_alert_type);
		$(".cart_increment_"+pis_id).html(result.cart_qty);
		$(".cart_increment_"+pis_id).val(result.cart_qty);
		$(".sess_cart_count").html(result.getCartItemCount);
		update_head_cart();

		if(result.redirect!='')
		{
			window.location.href=result.redirect;
		}
		if(page=='cart')
		{
			getCartPageDetail();
		}
		else
		{

		}
		getCartDetail();
		getCartPageDetail();
		//alert(result.cart_qty);
		if(result.cart_qty==0){$('.qty_increDecre_'+pis_id).hide();}
		if(result.cart_qty>=1){$('.qty_increDecre_'+pis_id).show();}
		//$(".cart_in_detail_"+pis_id).html(result.cart_qty + "  SQ. FT. In Cart")
		$(".cart_in_detail_"+pis_id).html(result.cart_qty_msg)

		$(".loader").css("display","none");
		setAllAnchorFunc();
		}
   });

}

var anchor_class = 0;
function setAllAnchorFunc()
{
	//return true;
	//$('.aClick_'+anchor_class).unbind("click");
	$('a').removeClass('aClick_'+anchor_class);
	//$('a').unbind("click");
	anchor_class++;
	$('a').addClass('aClick_'+anchor_class);
	//$("a").bind("click", (function () {
	$('.aClick_'+anchor_class).click(function(){
			var $this = $(this);
			var location_href = ($this).attr('href');
			var title1 = ($this).attr('title');
			var title2 = $this.text().trim();
			var title3 = $('img', $this).attr('title');
				//console.log($this.text().trim());
				//console.log($($this+' img').attr('title'));
				//console.log($('img', $this).attr('title'));
			var tag_label='unknown';
			if(title1 != '' && title1 != undefined  && title1 != 'undefined' ){ var tag_label=title1; }
			else if(title3 != '' && title3 != undefined  && title3 != 'undefined' ){ var tag_label=title3; }
			if(title2 != '' && title2 != undefined  && title2 != 'undefined' ){ var tag_label=title2; }

			/*gtag('event', 'anchor_click', {
			  'event_label':tag_label,
			  //'event_category':location_href
			});*/

	});
	return true;
}
function getCartPageDetail(){
	if($("*").hasClass("cartPage"))
	{
		$(".loader").show();
		$.ajax({
			type: "POST",
			url:$('.siteUrl').val()+'products/my_cart_page_detail',
			/*dataType : "json",*/
			data : '',
			success : function(result){

				$(".cartPage").html(result);

				afterCartSlide();
				$(".loader").css("display","none");
				setAllAnchorFunc();
			}
		});
	}
}
function update_head_cart(){
	//$(".loader").show();

	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/update_head_cart',
		/*dataType : "json",*/
		data : '',
		success : function(result){
			$(".head_dropdown_cart_d").html(result);

			lazy_images();
			//$(".loader").css("display","none");
			setAllAnchorFunc();
		}
	});
}
function lazy_images()
{
  var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.classList.remove("lazy");
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
lazy_images();
function afterGetDetail()
{
	$(".addToCartListBTNC").click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		addToCartList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});

	$(".addToWishlistListBTNC").click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		addToWishlistList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});

	$(".incToCartListBTNC").click(function(){
		var ids = $(this).data('val');
		var idsarr = ids.split(',');
		AddToCart(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
	});
}
function afterCartSlide(){
	return false;
	$('.cartSideOpen').click(function(){
		$('.cart-pop-p').addClass('right-display');
		$('.cart-overlay').addClass('bg-display');
		$('body').addClass('scroll-fixed');
	});
	$('.cart-p-head-icon').click(function(){
		$('.cart-pop-p').removeClass('right-display');
		$('.cart-overlay').removeClass('bg-display');
		$('body').removeClass('scroll-fixed');
	});
	$('.cart-overlay').click(function(){
		$('.cart-pop-p').removeClass('right-display');
		$(this).removeClass('bg-display');
	});
	$('[data-toggle="tooltip"]').tooltip()
}

function getCartDetail(){
	//$(".loader").show();
	$.ajax({
		type: "POST",
		url:$('.siteUrl').val()+'products/getCartDetail',
		/*dataType : "json",*/
		data : '',
		success : function(result){
			$(".float_cart").html(result);
			$(".loader").hide();
			afterGetDetail();
			afterCartSlide();
			$(".loader").css("display","none");
			setAllAnchorFunc();
		}
	});
}
function product_quick_view_func(product_id , product_combination_id)
{
	$(".loader").css("display","block");
	$.ajax({
		type: "POST",
		//url:$('.siteUrl').val()+'products/loadMoreProduct',
		url:$('.siteUrl').val()+'products/product_detail_quick_view',
		/*dataType : "json",*/
		data : {'product_id':product_id , 'product_combination_id' : product_combination_id},
		success : function(result){
			$('#product_quick_view_body').html(result);

			$(".addToCartListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				addToCartList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});

			$(".addToWishlistListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				addToWishlistList(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});

			$(".incToCartListBTN").click(function(){
				var ids = $(this).data('val');
				var idsarr = ids.split(',');
				AddToCart(idsarr[0] , idsarr[1] , idsarr[2] , idsarr[3])
			});

			$('#product_quick_view').modal('show');
			$(".loader").css("display","none");
			//StarRatingJs();
			setAllAnchorFunc();
		}
	});

}
