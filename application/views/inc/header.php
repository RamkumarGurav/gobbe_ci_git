<?
   $CI=&get_instance();
   if(empty($meta_title))
   {
    $meta_title = _project_name_;
   }

   if(empty($meta_description))
   {
    $meta_description = _project_name_;
   }

   if(empty($meta_keywords))
   {
    $meta_keywords = _project_name_;
   }

   if(empty($meta_others))
   {
    $meta_others = "";
   }


   ?>
   <!DOCTYPE html>
   <html class="no-js" lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
   <head>
       <meta charset="utf-8" />
       <title>Gobbe</title>
       <meta http-equiv="x-ua-compatible" content="ie=edge" />
       <meta name="description" content="" />
       <meta name="viewport" content="width=device-width, initial-scale=1" />

       <link rel="shortcut icon" type="image/x-icon" href="<?=IMAGE?>gobbe.png" />
       <link rel="stylesheet" href="<?=CSS?>header-footer.css" />
       <link rel="stylesheet" href="<?=CSS?>product-list.css" />
       <?php if (!empty($css)) { foreach ($css as $css) { echo '<link rel="stylesheet" href="'.CSS.$css.'"  crossorigin="anonymous">'; } } ?>

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>

   <body>
<div class="modal fade custom-modal" id="product_quick_view" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body" id="product_quick_view_body">

                </div>
            </div>
        </div>
    </div>
     <input type="hidden" class="siteUrl" value="<?=base_url()?>">
       <header class="header-area header-style-1 header-height-2">
           <div class="mobile-promotion">
               <span><strong>up to 15%</strong> off all items. Only </span>
           </div>
           <div class="header-top header-top-ptb-1 d-none d-lg-block">
               <div class="container">
                   <div class="row align-items-center">
                       <div class="col-xl-3 col-lg-4">
                           <!-- <div class="header-info">
                               <ul>
                                   <li><a href="#">About Us</a></li>
                                   <li><a href='#'>My Account</a></li>
                                   <li><a href='#'>Wishlist</a></li>
                                   <li><a href="#">Order Tracking</a></li>
                               </ul>
                           </div> -->
                       </div>
                       <div class="col-xl-6 col-lg-4">
                           <div class="text-center">
                               <div id="news-flash" class="d-inline-block">
                                   <ul>
                                       <li>100% Secure delivery without contacting the courier</li>
                                       <li>Supper Value Deals - Save more with coupons</li>
                                       <li>Trendy 25silver jewelry, save up 35% off today</li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-4">
                           <!-- <div class="header-info header-info-right">
                               <ul>
                                   <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>


                               </ul>
                           </div> -->
                       </div>
                   </div>
               </div>
           </div>
           <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
               <div class="container">
                   <div class="header-wrap">
                       <div class="logo logo-width-1">
                           <a href="<?=base_url()?>"><img src="<?=IMAGE?>gobbe.png" alt="logo" /></a>
                       </div>
                       <div class="header-right">
                           <div class="search-style-2">
                              <? if($check_screen == 'isdesktop'){ ?>
                             <form  name="searchSuggForm" id="autocomplete" method="get" action="" autocomplete="off">
                                   <select class="select-active">
                                     <option>All Categories</option>

                                     <? if(!empty($menu)){ ?>
                                        <? foreach($menu as $m){ ?>
                                          <li class="hot-deals"><img src="<?=IMAGE?>theme/icons/icon-hot.svg" alt="hot deals" /><a href="<?=$m->slug_url?>"><?=$m->name?></a></li>
                                          <option><?=$m->name?></option>

                                        <?}?>
                                      <?}?>


                                   </select>
                                   <input id="searchSugg" tabindex="0"   type="text" class="searchSugg" name="searchSugg"placeholder="Search for items..." />
                                    <button class="search_btn1" style="display:none" type="submit"></button>
                                    <span data-clear-input style="cursor: pointer; display:none" class="search_close_btn"><i class="fa fa-close"> </i></span>

                               </form>
                             <? } ?>
                           </div>
                           <div class=" dropdown-menu  getSuggestionDropdown" style="float:left;width:1000px;overflow-y: auto;height: 450px;display:none">
                           </div>
                           <div class="header-action-right">
                               <div class="header-action-2">

                                   <div class="header-action-icon-2">
                                       <a href='#'>
                                           <img class="svgInject" alt="Nest" src="<?=IMAGE?>theme/icons/icon-heart.svg" />
                                           <span class="pro-count blue sess_wishlist_count"><?=$this->session->userdata('application_sess_wishlist_count');?></span>
                                       </a>
                                       <a href="<?=base_url('wishlist')?>"><span class="lable">Wishlist</span></a>
                                   </div>
                                   <div class="header-action-icon-2">
                                       <a class='mini-cart-icon' href="<?=base_url('viewcart')?>">
                                           <img alt="Nest" src="<?=IMAGE?>theme/icons/icon-cart.svg" />
                                           <span class="pro-count blue sess_cart_count"><?=$this->session->userdata('application_sess_cart_count');?></span>
                                       </a>
                                       <a  href="<?=base_url('viewcart')?>"><span class="lable">Cart</span></a>
                                       <div class="cart-dropdown-wrap cart-dropdown-hm2 head_dropdown_cart_d">
                                         <? $this->load->view("template/head_dropdown_cart" , $this->data); ?>

                                       </div>
                                   </div>
                                   <div class="header-action-icon-2">
                                       <a href='#'>
                                           <img class="svgInject" alt="Nest" src="<?=IMAGE?>theme/icons/icon-user.svg" />
                                       </a>
                                       <a href="<? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ echo base_url(__dashboard__); } else {echo base_url(__login__);}?>"><span class="lable ml-0">Account</span></a>
                                       <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                           <ul>
                                             <?php if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){} else { ?>
                                              <li>
                                                <a  href="<?=base_url(__signup__);?>"> New Customer? Sign Up</a>
                                              </li>
                                              <?php } ?>
                                               <li>
                                                   <a href="<? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ echo base_url(__dashboard__); } else {echo base_url(__login__);}?>"><i class="fa fa-user mr-10"></i>My Account</a>
                                               </li>
                                               <li>
                                                   <a href="<? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ echo base_url(__orderHistory__); } else {echo base_url(__login__);}?>"><i class="fa fa-shopping-bag mr-10"></i>Order Tracking</a>
                                               </li>
                                               <li>
                                                   <a href="<? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ echo base_url(__dashboard__); } else {echo base_url(__login__);}?>"><i class=" fa fa-file mr-10"></i>My Voucher</a>
                                               </li>
                                               <li>
                                                   <a href="<? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ echo base_url(__wishlist__); } else {echo base_url(__login__);}?>"><i class=" fa fa-heart mr-10"></i>My Wishlist</a>
                                               </li>

                                                 <? if(!empty($temp_name) && !empty($temp_id) && $login_type != 'guest'){ ?>
                                               <li>
                                                   <a href="<?=base_url(__logout__)?>"><i class="fa fa-sign-out mr-10"></i>Sign out</a>
                                               </li>
                                               <?}?>
                                           </ul>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="header-bottom header-bottom-bg-color sticky-bar">
               <div class="container">
                   <div class="header-wrap header-space-between position-relative">
                       <div class="logo logo-width-1 d-block d-lg-none">
                           <a href="<?=base_url()?>"><img src="<?=IMAGE?>gobbe.png" alt="logo" /></a>
                       </div>
                       <div class="header-nav d-none d-lg-flex">
                           <div class="main-categori-wrap d-none d-lg-block">
                               <a class="categories-button-active" href="#">
                                   <span class="fa fa-apps"></span> <span class="et"></span> <img src="<?=IMAGE?>app-ico.png" style="width: 20px;">&nbsp; Browse All Categories
                                   <i class="fa fa-angle-down"></i>
                               </a>
                               <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                   <div class="d-flex categori-dropdown-inner">
                                       <ul>
                                       <? if(!empty($menu)){ ?>
                                          <? foreach($menu as $m){ ?>
                                            <li>
                                                <a href="<?=$m->slug_url?>"> <img src="<?=IMAGE?>theme/icons/icon-hot.svg" alt="" /><?=$m->name?></a>
                                            </li>
                                          <?}?>
                                        <?}?>


                                       </ul>

                                   </div>

                               </div>
                           </div>
                           <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                               <nav>
                                   <ul>
                                     <? if(!empty($menu)){ ?>
                                        <? foreach($menu as $m){ ?>
                                          <li class="hot-deals"><img src="<?=IMAGE?>theme/icons/icon-hot.svg" alt="hot deals" /><a href="<?=$m->slug_url?>"><?=$m->name?></a></li>

                                        <?}?>
                                      <?}?>
                                   </ul>
                               </nav>
                           </div>
                       </div>
                       <div class="hotline d-none d-lg-flex">
                           <img src="<?=IMAGE?>theme/icons/icon-headphone.svg" alt="hotline" />
                           <p><?=$company_profile_data->mobile_no?><span>24/7 Support Center</span></p>
                       </div>
                       <div class="header-action-icon-2 d-block d-lg-none">
                           <div class="burger-icon burger-icon-white">
                               <span class="burger-icon-top"></span>
                               <span class="burger-icon-mid"></span>
                               <span class="burger-icon-bottom"></span>
                           </div>
                       </div>
                       <div class="header-action-right d-block d-lg-none">
                           <div class="header-action-2">
                               <div class="header-action-icon-2">
                                   <a href='#'>
                                       <img alt="Nest" src="<?=IMAGE?>theme/icons/icon-heart.svg" />
                                       <span class="pro-count white sess_wishlist_count"><?=$this->session->userdata('application_sess_wishlist_count');?></span>
                                   </a>
                               </div>
                               <div class="header-action-icon-2">
                                   <a class="mini-cart-icon" href="<?=base_url('viewcart')?>">
                                       <img alt="Nest" src="<?=IMAGE?>theme/icons/icon-cart.svg" />
                                       <span class="pro-count white sess_cart_count"><?=$this->session->userdata('application_sess_cart_count');?></span>
                                   </a>
                                   <div class="cart-dropdown-wrap cart-dropdown-hm2 head_dropdown_cart_d">
                                     <? $this->load->view("template/head_dropdown_cart" , $this->data); ?>

                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </header>
        <? if($check_screen != 'isdesktop'){ ?>
          <div class="mobile-header-active mobile-header-wrapper-style">
              <div class="mobile-header-wrapper-inner">
                  <div class="mobile-header-top">
                      <div class="mobile-header-logo">
                          <a href='index.html'><img src="<?=IMAGE?>gobbe.png" alt="logo" /></a>
                      </div>
                      <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                          <button class="close-style search-close">
                              <i class="icon-top"></i>
                              <i class="icon-bottom"></i>
                          </button>
                      </div>
                  </div>
                  <div class="mobile-header-content-area">
                      <div class="mobile-search search-style-3 mobile-header-border">
                          <!-- <form action="#">
                              <input type="text" placeholder="Search for items…" />
                              <button type="submit"><i class="fa fa-search"></i></button>
                          </form> -->

                          <form  name="searchSuggForm" id="autocomplete" method="get" action="" autocomplete="off">

                                <input id="searchSugg" tabindex="0"   type="text" class="searchSugg" name="searchSugg"placeholder="Search for items..." />
                                 <button class="search_btn1" style="display:none" type="submit"></button>
                                 <span data-clear-input style="cursor: pointer; display:none" class="search_close_btn"><i class="fa fa-close"> </i></span>

                            </form>
                      </div>
                      <div class=" dropdown-menu  getSuggestionDropdown" style="float:left;width:1000px;overflow-y: auto;height: 450px;display:none">
                      </div>
                      <div class="mobile-menu-wrap mobile-header-border">
                          <!-- mobile menu start -->
                          <nav>
                              <ul class="mobile-menu font-heading">
                                <? if(!empty($menu)){ ?>
                                   <? foreach($menu as $m){ ?>
                                     <li ><a href="<?=$m->slug_url?>"><?=$m->name?></a></li>

                                   <?}?>
                                 <?}?>


                              </ul>
                          </nav>
                          <!-- mobile menu end -->
                      </div>
                      <div class="mobile-header-info-wrap">

                          <div class="single-mobile-header-info">
                              <a href=<?=base_url('Login')?>><i class="fa fa-user"></i>Log In / Sign Up </a>
                          </div>
                          <div class="single-mobile-header-info">
                              <a ><i class="fa fa-headphones"></i><?=$company_profile_data->mobile_no?></a>
                          </div>
                      </div>
                      <div class="mobile-social-icon mb-50">
                          <h6 class="mb-15">Follow Us</h6>
                          <?php if(_TWITTER_ != '') { ?><a href=<?=_TWITTER_?>><img src="<?=IMAGE?>theme/icons/icon-twitter-white.svg" alt="" /></a><?php } ?>
                          <?php if(_FACEBOOK_ != '') { ?><a href=<?=_FACEBOOK_?>><img src="<?=IMAGE?>theme/icons/icon-facebook-white.svg" alt="" /></a><?php } ?>
                          <?php if(_INSTAGRAM_ != '') { ?><a href=<?=_INSTAGRAM_?>><img src="<?=IMAGE?>theme/icons/icon-instagram-white.svg" alt="" /></a><?php } ?>
                          <?php if(_PININTEREST_ != '') { ?> <a href=<?=_PININTEREST_?>><img src="<?=IMAGE?>theme/icons/icon-pinterest-white.svg" alt="" /></a><?php } ?>
                          <?php if(_YOUTUBE_ != '') { ?><a href=<?=_YOUTUBE_?>><img src="<?=IMAGE?>theme/icons/icon-youtube-white.svg" alt="" /></a><?php } ?>


                      </div>
                      <div class="site-copyright">Copyright 2024 © Gobbe. All rights reserved. </div>
                  </div>
              </div>
          </div>
          <?}?>

       <!--End header-->
