<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href='index.html' rel='nofollow'><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Dashboard <span></span>
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
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                     <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Hello <?=$profile->first_name?>!</h3>
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    From your account dashboard. you can easily check &amp; view your <a href="<?=base_url(__orderHistory__)?>">recent orders</a>,<br />
                                                    manage your <a href="<?=base_url(__shippingAddress__)?>">shipping and billing addresses</a> and <a href="<?=base_url(__dashboard__)?>">edit your password and account details.</a>
                                                </p>
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
