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


																				<div class="" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
																						<div class="card">
																								<div class="card-header">
																										<h5>Account Details</h5>
																								</div>
																								<div class="card-body">

																										<form method="post" action="<?=MAINSITE.'update-profile'?>" name="enq">
																											<?echo $message;
																											ECHO $this->session->flashdata('message');
																											 ?>
																												<div class="row">
																														<div class="form-group col-md-6">
																																<label>First Name <span class="required">*</span></label>
																																<?php
																																$value = set_value('first_name');
																																if(empty($value)){$value = $profile->name;}
																													$attributes = array(
																													'name'  => 'first_name',
																													'id'  => 'first_name',
																													'value' => $value ,
																													'autofocus' => 'autofocus',
																													'placeholder' => 'Name',
																													'class'=>"form-control",
																													'type' => 'text',
																													'required' => 'required'
																													);

																													echo form_input($attributes);?>
																													<span>
																												 <?php echo form_error('username', '<div class="error" style="color: red">', '</div>'); ?>
																												 </span>
																														</div>
																														<div class="form-group col-md-6">
																																<label>Phone <span class="required">*</span></label>
																																<?php
																																$value = set_value('number');
																																if(empty($value)){$value = $profile->number;}
 																													 $attributes = array(
 																													 'name'	=> 'number',
 																													 'id'	=> 'number',
 																													 'value'	=> $value,
																													 	'class'=>"form-control",
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

																														<div class="form-group col-md-12">
																																<label>Email Address <span class="required">*</span></label>
																																<?php
																																$value = set_value('email');
																																if(empty($value)){$value = $profile->email;}
																													$attributes = array(
																													'name'  => 'email',
																													'class'=>"form-control",
																													'id'  => 'email',
																													'value' => $value,
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
																														<div class="form-group col-md-12">
																																<label>Current Password <span class="required">*</span></label>
																																<?php
																																$value = set_value('old_password');
																																if(empty($value)){$value = $profile->show_password;}
																													$attributes = array(
																													'name'  => 'old_password',
																													'id'  => 'old_password',
																													'class'=>"form-control",
																													'value' => $value,
																													'autofocus' => 'autofocus',
																													'placeholder' => 'Password',
																													'type' => 'password',
																													'required' => 'required'
																													);

																													echo form_input($attributes);?>
																													<span>
																												 <?php echo form_error('current_password', '<div class="error" style="color: red">', '</div>'); ?>
																												 </span>
																														</div>
																														<div class="form-group col-md-12">
																																<label>New Password <span class="required">*</span></label>
																																<?php

																													$attributes = array(
																													'name'  => 'password',
																													'id'  => 'password',
																													'class'=>"form-control",
																													'value' => set_value('current_password'),
																													'autofocus' => 'autofocus',
																													'placeholder' => 'Password',
																													'type' => 'password',
																													//'required' => 'required'
																													);

																													echo form_input($attributes);?>
																													<span>
																												 <?php echo form_error('password', '<div class="error" style="color: red">', '</div>'); ?>
																												 </span>
																														</div>
																														<div class="form-group col-md-12">
																																<label>Confirm Password <span class="required">*</span></label>
																																<?php
																													$attributes = array(
																													'name'  => 'confirm_password',
																													'id'  => 'confirm_password',
																													'class'=>"form-control",
																													'value' => set_value('confirm_password'),
																													'autofocus' => 'autofocus',
																													'placeholder' => 'Password',
																													'type' => 'password',
																													//'required' => 'required'
																													);

																													echo form_input($attributes);?>
																													<span>
																												 <?php echo form_error('confirm_password', '<div class="error" style="color: red">', '</div>'); ?>
																												 </span>
																														</div>
																														<div class="col-md-12">
																																<button type="submit" class="btn btn-fill-out submit font-weight-bold" name="addUserInfoBTN" value="Submit">Save Change</button>
																														</div>
																												</div>
																										</form>
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
