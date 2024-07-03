
 <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href='index.html' rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
                    <span></span> Wishlist <span></span>
                </div>
            </div>
        </div>
        <div class=" mb-30 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto wishlistPage">
                  
                    <? if(!empty($products_list)){ ?>

                                <?

                                $this->load->view('template/wishlist' , $this->data);
                                ?>

                <? }else{ ?>
                          <div class=" col-md-12 wishlistPage wishlistPageEmpty">


                <a class="btn " href="<?=base_url()?>all-products" style="background: #fdc040 !important"><i class="fa fa-arrow-right mr-10"></i>Continue Shopping</a>

      <br><br>
                          </div>
                <? } ?>
                </div>
            </div>
        </div>
    </main>
