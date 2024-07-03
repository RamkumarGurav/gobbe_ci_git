<main class="main">

			 <div class="page-header mt-30 mb-50">
					 <div class="container">
							 <div class="archive-header1">
									 <div class="row align-items-center">
											 <div class="col-md-12">
													 <!-- <h1 class="mb-15">Dry Fruits & Nuts</h1> -->
													 <div class="breadcrumb">
															 <a href='#' rel='nofollow'><i class="fa fa-home mr-5"></i>Home</a>
															 <span></span>Register<span></span>
													 </div>
											 </div>

									 </div>
							 </div>
					 </div>
			 </div>
			 <div class="page-content pb-3">

					 <div class="container">
							 <div class="row">
									 <div class="col-lg-10 m-auto box-bck">
											 <div class="row">
													 <div class="col-lg-6 col-md-6">
															 <div class="login_wrap widget-taber-content background-white">
																	 <div class="padding_eight_all">
																			 <div class="heading_s1">
																					 <h1 class="mb-5">Create an Account</h1>
																					 <p class="mb-30">Already have an account? <a href=<?=base_url('Login')?>>Login</a></p>
																			 </div>
																			   <?php echo $message; ?>
																			 <?php echo form_open(base_url().'Register/addUser', array('method' => 'post', 'id' => 'registration_form', 'style' => '', 'accept-charset' => 'utf-8', 'class' => 'registration_form', 'autocomplete' => 'off')); ?>
																					 <div class="form-group">
																						 <?php
																			 $attributes = array(
																			 'name'  => 'username',
																			 'id'  => 'username',
																			 'value' => set_value('username'),
																			 'autofocus' => 'autofocus',
																			 'placeholder' => 'Name',
																			 'type' => 'text',
																			 'required' => 'required'
																			 );

																			 echo form_input($attributes);?>
																			 <span>
 																			<?php echo form_error('username', '<div class="error" style="color: red">', '</div>'); ?>
 																			</span>
																					 </div>
																					 <div class="form-group">
																						 <?php
																			 $attributes = array(
																			 'name'  => 'email',
																			 'id'  => 'email',
																			 'value' => set_value('email'),
																			 'autofocus' => 'autofocus',
																			 'placeholder' => 'Email',
																			 'type' => 'email',
																			 'required' => 'required'
																			 );

																			 echo form_input($attributes);?>
																			 <span>
																			 <?php echo form_error('email', '<div class="error" style="color: red">', '</div>'); ?>
																			 </span>
																					 </div>
																					 <div class="form-group">
																						 <?php
																				 $attributes = array(
																				 'name'	=> 'number',
																				 'id'	=> 'number',
																				 'value'	=> set_value('number'),

																				 'type' => 'number',
																				 'placeholder' => 'Mobile',
																				 'pattern' => '[0-9]{8,15}',
																				 'title' => 'Enter only number between 0-9',
																				 'required' => 'required'
																				 );
																				 echo form_input($attributes);?>
																				 <span>
																				 <?php echo form_error('number', '<div class="error" style="color: red">', '</div>'); ?>
																				 </span>
																					 </div>
																					 <div class="form-group">
																						 <?php
																			 $attributes = array(
																			 'name'  => 'password',
																			 'id'  => 'password',
																			 'value' => set_value('password'),
																			 'autofocus' => 'autofocus',
																			 'placeholder' => 'Password',
																			 'type' => 'password',
																			 'required' => 'required'
																			 );

																			 echo form_input($attributes);?>
																			 <span>
																			 <?php echo form_error('Password', '<div class="error" style="color: red">', '</div>'); ?>
																			 </span>
																					 </div>
																					 <div class="form-group">
																						 <?php
																			 $attributes = array(
																				 'name'	=> 'confirm_password',
						                            'id'	=> 'confirm_password',
						                            'value'	=> set_value('confirm_password'),
						                            'type' => 'password',
																				'placeholder' => 'Re-Enter Password',
																				'autofocus' => 'autofocus',
						                            'required' => 'required'
																			 );

																			 echo form_input($attributes);?>
																			 <span>
																			 <?php echo form_error('confirm_password', '<div class="error" style="color: red">', '</div>'); ?>
																			 </span>
																					 </div>
																					 <div class="login_footer form-group">
																							 <div class="chek-form">
																									 <div class="custome-checkbox">
																											 <input required class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
																											 <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
																									 </div>
																							 </div>
																							 <a href="<?=base_url(__privacy_policy__);?>"><i class="fa fa-book mr-5 text-muted"></i>Lean more</a>
																					 </div>
																					 <div class="form-group mb-30">
																							 <button name="addUserInfoBTN" type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
																					 </div>
																					 <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
																					 <?php echo form_close() ?>
																	 </div>
															 </div>
													 </div>
													  <div class="col-lg-6 col-md-6">
													 <img class="border-radius-15" src="<?=IMAGE?>login-1.png" alt="" />
													</div>
											 </div>
									 </div>
							 </div>
					 </div>

			 </div>

	 </main>
