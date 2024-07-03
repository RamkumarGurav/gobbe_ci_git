<main class="main">
  <?php if (!empty($banners)) { ?>
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-3">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                  <?
          $img_count = 0;
          foreach ($banners as $b) {
            ?>
            <div class="single-hero-slider single-animation-wrap" style="background-image: url( <?= _uploaded_files_ ?>banner/<?= $b->image ?>)">
                <div class="slider-content">
                    <h1 class="display-2 mb-40 text-white">
                        <?=$b->name?>

                    </h1>
                     <p class="mb-65 text-white">  <?=$b->title1?></p>
                   <!--  <form class="form-subcriber d-flex">
                        <input type="email" placeholder="Your emaill address" />
                        <button class="btn" type="submit">Subscribe</button>
                    </form> -->
                </div>
            </div>
            <?
          }
          ?>


                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>
    <?
    }
    ?>
    <?php

    if(!empty($index_category)){
      ?>
<section class="popular-categories section-padding">
            <div class="container wow animate__animated animate__fadeIn">
                <div class="section-title">
                    <div class="title">
                        <h3>Featured Categories</h3>
                        <ul class="list-inline nav nav-tabs links">
                          <?
                           foreach ($index_category as $homepage_category_list) {
                             ?>
                             <li class="list-inline-item nav-item"><a class='nav-link' href="<?= $homepage_category_list->slug_url; ?>"><?= $homepage_category_list->name; ?></a></li>

                             <?
                              }
                             ?>

                        </ul>
                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                </div>
                <div class="carausel-4-columns-cover position-relative">
                    <div class="carausel-4-columns" id="carausel-10-columns">
                      <?
                      $count = 0;
                       foreach ($index_category as $homepage_category_list) {
                           $count++;
                         ?>
                        <div class="card-2 <?=($count%2 == 0)?'bg-9':'bg-10'?> wow animate__animated animate__fadeInUp" data-wow-delay=".<?=$count?>s">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="<?= $homepage_category_list->slug_url; ?>"><img src="<?= _uploaded_files_ ?>category/<?= $homepage_category_list->cover_image; ?>" alt="<?= $homepage_category_list->name; ?>" /></a>
                            </figure>
                            <h6><a href="<?= $homepage_category_list->slug_url; ?>"><?= $homepage_category_list->name; ?></a></h6>
                            <span><?= $homepage_category_list->product_count?> items</span>
                        </div>
                        <?
                         }
                        ?>


                    </div>
                </div>
            </div>
        </section>
        <?php
        }
          ?>
         <!--End 4 columns-->



<section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="<?=IMAGE?>bg3.jpg" alt="" />
                        <div class="banner-text">
                            <h4>
                                Everyday Fresh & <br />Clean with Our<br />
                                Products
                            </h4>
                            <a class='btn btn-lg' href="<?=MAINSITE.'all-products'?>">Shop Now <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn popular_products_category">

            </div>
            <!--End nav-tabs-->
            <div class="tab-content popular_products_category_content " id="myTabContent">


            </div>
            <!--End tab-content-->
        </div>
    </section>
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="<?=IMAGE?>bb4.png" alt="" />
                        <div class="banner-text">
                            <h4>
                                Everyday Fresh & <br />Clean with Our<br />
                                Products
                            </h4>
                            <a class='btn btn-lg' href="<?=MAINSITE.'all-products'?>">Shop Now <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class="">Daily Best Sells</h3>

            </div>
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                    <div class="banner-img style-2">
                        <div class="banner-text">
                            <h2 class="mb-100">Bring nature into your home</h2>
                            <a class='btn btn-lg' href="<?=MAINSITE.'all-products'?>">Shop Now <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">

                            <div class="slider_best_sellers-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 slider_best_sellers-arrow" id="slider_best_sellers-arrows"></div>
                                <div class="carausel-arrow-center slider_best_sellers" id="slider_best_sellers">

                                </div>
                            </div>

                    <!--End tab-content-->
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
     <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                Stay home & get your daily <br />
                                needs from our shop
                            </h2>
                            <p class="mb-45">Start You'r Daily Shopping with <span class="text-brand">GOBBE</span></p>
                            <form class="form-subcriber d-flex">
                                <input type="email" name="newsletter_email" id="newsletter_email"placeholder="Your emaill address" />
                                <button class="btn" type="button" onclick="validate_newsletter_email()">Subscribe</button>

                            </form>
                            <div id='newsletter_email_msg'></div>
                            <div class="alert alert-danger hidden" role="alert" id='newsletter_email_err'></div>
                        </div>
                        <img src="<?=IMAGE?>cat1.webp" alt="newsletter" />
                    </div>
                </div>
            </div>
        </div>
    </section>
     <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp " data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
                    <div class="product-list-small animated animated slider_best_sellers_list">


                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp " data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
                    <div class="product-list-small animated animated slider_trending_now">

                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6 mb-sm-5 mb-md-0  wow animate__animated animate__fadeInUp "  data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                    <div class="product-list-small animated animated slider_new_product">

                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp "  data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
                    <div class="product-list-small animated animated slider_hot_selling_now">

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
