
 <main class="main">
  <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header1">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <!-- <h1 class="mb-15">Dry Fruits & Nuts</h1> -->
                            <div class="breadcrumb">
                                <a href='#' rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
                                <span></span>Login<span></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="page-content ">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto box-bck">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="<?=IMAGE?>login-1.png" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all ">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            <p class="mb-30">Don't have an account? <a href=<?=base_url('sign-up')?>>Create here</a></p>
                                        </div>
																				<?php echo $message; ?>

																				<?php echo form_open(base_url(__login__).'/loginAuth', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>
                                            <div class="form-group">
																							<?
																							$attributes = array(
																							'name'	=> 'username',
																							'id'	=> 'username',
																							'value'	=> set_value('username'),
																							'placeholder' => 'Email',
																							'autofocus' => 'autofocus',
																							'type' => 'email',
																							'required' => 'required'
																							);
																							echo form_input($attributes);?>

                                            </div>
                                            <div class="form-group">
																							<?php
						                                    $attributes = array(
						                                    'name'	=> 'password',
						                                    'id'	=> 'password',
						                                    'value'	=> set_value('password'),
																								'placeholder' => 'Password',
						                                    'class' => 'form',
						                                    'type' => 'password',
						                                    'required' => 'required'
						                                    );
						                                    echo form_input($attributes);?>
                                            </div>

                                            <div class="login_footer form-group mb-50">

                                                <a class="text-muted" href="forgot-password.html">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="doLoginBTN" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                            </div>
                                      <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
