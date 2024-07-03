<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?php echo _project_complete_name_ ?> | Log in</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

	<div class="box-form">
		<div class="left">
			<!-- <div class="overlay">
				<h1>Hello World.</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Curabitur et est sed felis aliquet sollicitudin</p>

			</div> -->
		</div>
		<div class="right text-center">
			<div class="cmc-tab">
				<!-- <ul class="nav nav-pills mb-3" id="ex1" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="false" tabindex="-1"><i class="fa-solid fa-boxes-stacked"></i>
							Overview</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false" tabindex="-1"><i class="fa-solid fa-circle-info"></i>
							Discription</a>
					</li>
					<li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ex1-tab-3" data-bs-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false" tabindex="-1"><i class="fa-solid fa-star-half-stroke"></i> Reviews</a>
                                    </li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="ex1-tab-4" data-bs-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4" aria-selected="false" tabindex="-1"><i class="fa-solid fa-chalkboard-user"></i> Gallery</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link " id="ex1-tab-5" data-bs-toggle="pill" href="#ex1-pills-5" role="tab" aria-controls="ex1-pills-5" aria-selected="true"><i class="fa-solid fa-question"></i>
							FAQ'S</a>
					</li>
				</ul> -->
				<div class="tab-content" id="ex1-content">
					<div class="tab-pane fade active show" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
						<div class="tabc-box">
							<div class="tabc-f">
								<img src="<?= base_url() ?>assets/front/images/logo.png" class="img-size">

							</div>
							<div class="tabc-s">
								<p>Sign in to start your session</p>
							</div>
								<?php echo $alert_message; ?>
							<?php echo form_open(MAINSITE_Admin . 'Login', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>

							<div class="tabc-t">

								<div class="tabc-form">
									<!-- <label for="si-email">Email address</label> -->
									<div class="form-group">
										<?php
										$attributes = array(
										  'name'	=> 'username',
										  'id'	=> 'username',
										  'value'	=> set_value('username'),
										  'class' => 'form-control',
										  'placeholder' => "Email / User Name",
										  'autofocus' => 'autofocus',
										  'type' => 'text',
										  'required' => 'required'
										);
										echo form_input($attributes);
										 ?>
									</div>
									<div class="form-group">
										<!-- <label for="exampleInputPassword1">Password</label> -->
										<?php
										$attributes = array(
											'name'	=> 'password',
											'id'	=> 'password',
											'value'	=> set_value('password'),
											'class' => 'form-control',
											'placeholder' => "Password",
											'type' => 'password',
											'required' => 'required'
										);
										echo form_input($attributes); ?>
										<!-- <input type="password" class="form-control" id="si-passwd" placeholder="Password"> -->
									</div>
								</div>

							</div>
							<div class="tabc-btn">
								<div class="tabc-btn-l">
									<!-- <button>Sign In</button> -->
									<button type="submit" name="login_btn" value="1" >Sign In</button>

								</div>
								<div class="tabc-btn-r">

									<ul class="nav nav-pills mb-3" id="ex1" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="ex1-tab-3" data-bs-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false" tabindex="-1"><button class="btn-orange">Sign In with Mobile</button></a>

										</li>
									</ul>
								</div>
							</div>
							 <?php echo form_close() ?>
							<div class="tabc-fp">
								<ul class="nav nav-pills mb-3" id="ex1" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false" tabindex="-1">Forgot Password <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
										<a class="nav-link active" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="false" tabindex="-1"><i class="fa-solid fa-boxes-stacked"></i>
											Overview</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
						<div class="tabc-box">
							<div class="tabc-f">
								<img src="<?= base_url() ?>assets/front/images/logo.png" class="img-size">

							</div>
							<div class="tabc-s">
								<p>Sign in to start your session</p>
							</div>
							<div class="tabc-t">
								<div class="tabc-form">
									<!-- <label for="si-email">Email address</label> -->
									<div class="form-group">
										<input type="email" class="form-control" id="si-email" aria-describedby="emaillogin" placeholder="Enter Email ID">
									</div>
									<!-- <div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" id="si-passwd" placeholder="Password">
									</div> -->
								</div>
							</div>
							<div class="tabc-btn">
								<div class="tabc-btn-l">
									<button>Forgot Password</button>
								</div>
								<div class="tabc-btn-r">

									<button class="btn-back"><a href="<?=MAINSITE_Admin?>">Back  <i class="fa fa-long-arrow-left" aria-hidden="true"></i></a></button>

								</div>
							</div>
							<div class="tabc-fp">
								<ul class="nav nav-pills mb-3" id="ex1" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false" tabindex="-1">Forgot Password <i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
					<div class="tabc-box">
							<div class="tabc-f">
								<img src="<?= base_url() ?>assets/front/images/logo.png" class="img-size">

							</div>
							<div class="tabc-s">
								<p>Sign in to start your session</p>
							</div>
							<div class="tabc-t tabc-t-cus">
								<div class="tabc-form">
									<!-- <label for="si-email">Email address</label> -->
									<div class="form-group">
										<input type="tel" class="form-control" id="si-mobile" aria-describedby="mobilelogin" placeholder="Enter Mobile No">
										<button>Sent OTP</button>
									</div>
									<div class="form-group">
										<!-- <label for="exampleInputPassword1">Password</label> -->
										<input type="text" class="form-control" id="si-passwd" placeholder="ENTER OTP">
										<button>Resend OTP</button>
									</div>
								</div>
							</div>
							<div class="tabc-btn">
								<div class="tabc-btn-l">
									<button>Sign In</button>
								</div>
								<div class="tabc-btn-r">

									<button class="btn-back"><a href="<?=MAINSITE_Admin?>">Back  <i class="fa fa-long-arrow-left" aria-hidden="true"></i></a></button>

								</div>
							</div>
							<!-- <div class="tabc-fp">
								<ul class="nav nav-pills mb-3" id="ex1" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false" tabindex="-1">Forgot Password <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
											<a class="nav-link" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="false" tabindex="-1"><i class="fa-solid fa-boxes-stacked"></i>
											BACK <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
									</li>
								</ul>
							</div> -->
						</div>

					</div>
				</div>
			</div>
			<!-- <div class="tab-content" id="pills-tabContent">

  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		<img src="<?= base_url() ?>assets/front/images/logo.png" class="img-size">
		<p>Sign in to start your session</p>
		<?php echo $alert_message; ?>
		<?php echo form_open(MAINSITE_Admin . 'Login', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>
		<div class="inputs">
		<?php
		$attributes = array(
			'name'	=> 'username',
			'id'	=> 'username',
			'value'	=> set_value('username'),
			'class' => 'form-control',
			'placeholder' => "Email / User Name",
			'autofocus' => 'autofocus',
			'type' => 'text',
			'required' => 'required'
		);
		echo form_input($attributes);
		 ?>
		<br>
		<?php
		$attributes = array(
			'name'	=> 'password',
			'id'	=> 'password',
			'value'	=> set_value('password'),
			'class' => 'form-control',
			'placeholder' => "Password",
			'type' => 'password',
			'required' => 'required'
		);
		echo form_input($attributes); ?>
		</div>
		<br><br>
		<div class="remember-me--forget-password">

		<label>
		<input type="checkbox" name="item" checked />
		<span class="text-checkbox">Remember me</span>
		</label>
		<a href="<?= MAINSITE_Admin . 'Login/forgot_password' ?>">Forgot password</a>
		</div>
		<br>
		<button type="submit" name="login_btn" value="1" class="btn btn-primary btn-block">Sign In</button>
		<?php echo form_close() ?>
		<button  class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30" id="pills-profile-tab1" data-bs-toggle="pill" data-bs-target="#pills-profile1" type="button" role="tab" aria-controls="pills-profile"  aria-selected="false">Forgot Password <i class="fa fa-long-arrow-right m-l-5"></i></button>

	</div>
	<div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile-tab">
		<img src="<?= base_url() ?>assets/front/images/logo.png" class="img-size">
		<p>Sign in to start your session</p>
		<?php echo $alert_message; ?>
		<?php echo form_open(MAINSITE_Admin . 'Login', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>
		<div class="inputs">
		<?php
		$attributes = array(
			'name'	=> 'username',
			'id'	=> 'username',
			'value'	=> set_value('username'),
			'class' => 'form-control',
			'placeholder' => "Email / User Name",
			'autofocus' => 'autofocus',
			'type' => 'text',
			'required' => 'required'
		);
		echo form_input($attributes); ?>
		<br>

		</div>
		<br>
		<button type="submit" name="login_btn" value="1" class="btn btn-primary btn-block">Sign In</button>
		<?php echo form_close() ?>

	</div>
</div> -->

		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'<?= $csrf['name'] ?>': '<?= $csrf['hash'] ?>'
			}
		});
	</script>
</body>

</html>
