<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo _project_complete_name_ ?> | Log in</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">

</head>

<body class="lg-bg">
  <section class="login-page">
    <div class="container">
      <div class="lgp-inner">
        <div class="lgpbr-logo">
          <img src="<?= base_url() ?>assets/admin/img/logo.png" alt="login-img">
        </div>
        <div class="lgp-box">
          <div class="lgpb-l">
            <img src="<?= base_url() ?>assets/admin/img/login.jpg" alt="login-img">
          </div>
          <div class="lgpb-r">
            <div class="lgpbr-inner">
              <ul class="nav nav-pills mb-3" id="ex1" role="tablist">
                <li class="nav-item nav-item-active" role="presentation">
                  <a class="nav-link active" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab"
                    aria-controls="ex1-pills-1" aria-selected="false" tabindex="-1"><span>Login</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab"
                    aria-controls="ex1-pills-2" aria-selected="false" tabindex="-1"><span>Login With OTP</span></a>
                </li>
                <li class="nav-item d-none" role="presentation">
                  <a class="nav-link" id="ex1-tab-3" data-bs-toggle="pill" href="#ex1-pills-3" role="tab"
                    aria-controls="ex1-pills-3" aria-selected="false" tabindex="-1"><span>Login With OTP</span></a>
                </li>
              </ul>
              <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade active show" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                  <div class="login-tab-inner">
                    <div class="login-box">
                      <!-- <div class="lgpbr-title">
                                                <h4>Login</h4>
                                            </div> -->
                      <div class="lgpbr-field">
                        <?php echo $alert_message; ?>
                        <?php echo form_open(MAINSITE_Admin . 'Login', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>

                        <div class="form-group">
                          <label for="lg-email">Email / Phone Number</label>
                          <?php
                          $attributes = array(
                            'name' => 'username',
                            'id' => 'username',
                            'value' => set_value('username'),
                            'class' => 'form-control',
                            'placeholder' => "Email / User Name",
                            'autofocus' => 'autofocus',
                            'type' => 'text',
                            'required' => 'required'
                          );
                          echo form_input($attributes);
                          echo form_hidden('login_type', 'password');
                          ?>

                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <?php
                          $attributes = array(
                            'name' => 'password',
                            'id' => 'password',
                            'value' => set_value('password'),
                            'class' => 'form-control',
                            'placeholder' => "Password",
                            'type' => 'password',
                            'required' => 'required'
                          );
                          echo form_input($attributes); ?>
                          <a href="#ex1-pills-3" class="tab-redirect loo-btn lfb-btn">Forgot Your Password</a>
                        </div>
                        <button type="submit" name="login_btn" value="1" class="lg-btn">Log In</button>
                        <?php echo form_close() ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                  <div class="login-tab-inner">
                    <div class="login-otp-box">
                      <!-- <div class="lgpbr-title">
                                                    <h4>Login with OTP</h4>
                                                </div> -->
                      <div class="lgpbr-field">
                        <?php echo $alert_message; ?>
                        <?php echo form_open(MAINSITE_Admin . 'Login', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>
                        <div class="form-group">
                          <label for="lg-email">Phone Number</label>
                          <?php
                          $attributes = array(
                            'name' => 'contact_no',
                            'id' => 'contact_no',
                            'value' => set_value('user_name'),
                            'class' => 'form-control',
                            'placeholder' => "Enter Phone Number",
                            'autofocus' => 'autofocus',
                            'pattern' => "[789][0-9]{9}",
                            'type' => 'tel',
                            'required' => 'required'
                          );
                          echo form_input($attributes);
                          echo form_hidden('login_type', 'otp');
                          ?>
                        </div>
                        <div class="otp-field">
                          <div class="form-group">
                            <!-- <label for="exampleInputPassword1">Password</label> -->
                            <!-- <input type="password" class="form-control" id="exampleInputPassword1"
                                                                    placeholder="Enter Your OTP"> -->
                            <?php

                            $attributes = array(

                              'name' => 'otp',

                              'id' => 'otp',

                              'value' => set_value('otp'),

                              'class' => 'form-control',

                              'type' => 'text',

                              'placeholder' => 'Enter OTP',

                              'required' => 'required'

                            );

                            echo form_input($attributes); ?>
                          </div>

                          <div class="fg-otp-btn">
                            <button type="button " onClick="login_otp_func()">Get OTP</button>
                          </div>
                        </div>
                        <p class="message"></p>
                        <button type="submit" name="login_btn" class="lg-btn">Log In</button>
                        <?php echo form_close() ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                  <div class="login-tab-inner">
                    <div class="login-otp-box">
                      <!-- <div class="lgpbr-title">
                                                    <h4>Login with OTP</h4>
                                                </div> -->
                      <div class="lgpbr-field">
                        <form>
                          <div class="form-group">
                            <label for="lg-email">Enter Your Email</label>
                            <?php
                            $attributes = array(
                              'name' => 'username',
                              'id' => 'fusername',
                              'value' => set_value('username'),
                              'class' => 'form-control',
                              'placeholder' => "Email / User Name",
                              'autofocus' => 'autofocus',
                              'type' => 'text',
                              'required' => 'required'
                            );
                            echo form_input($attributes);
                            ?>
                          </div>


                          <button type="button" onclick="forgot_password_func()" class="lg-btn">Forgot Password</button>
                          <p class="message"></p>
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
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="<?= base_url() ?>assets/admin/js/script.js"></script>

  <script type="text/javascript">

    function login_otp_func() {
      $(this).text('Resend OTP');
      $('.message').text('');
      var contact_no = $('#contact_no').val();
      if (contact_no != '') {
        $(".loader").css("display", "block");
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>secureRegions/Login/resend_otp',
          dataType: "json",
          data: { 'contact_no': contact_no },
          success: function (result) {
            $(".loader").css("display", "none");
            if (result.status) {
              //$('.MobOTPField').show();
              //time_sec = 300;
              //	$('#otp_func').hide();
              //	myOTPTimer = setInterval(resend_otp_time, 1000);
              if (result.status) {
                $('.message').css('color', 'green');
              } else {
                $('.message').css('color', 'red');
              }
              $('.message').text(result.message);

              $('.message').text(result.message);
            } else if (result == 'blocked') {
              location.reload();
            }
            else {
              alert(result.message)
            }
          }
        });
      }
      else {
        alert("Please Enter ontact No");
        $('#contact_no').focus();
      }
    }
    function forgot_password_func() {

      var username = $('#fusername').val();

      if (username != '') {
        $('.message').text('');
        $(".loader").css("display", "block");

        $.ajax({

          type: "POST",

          url: '<?= MAINSITE_Admin ?>Login/reset_password',

          dataType: "json",

          data: { 'username': username },

          success: function (result) {

            $(".loader").css("display", "none");

            if (result) {

              if (result.status) {
                $('.message').css('color', 'green');
              } else {
                $('.message').css('color', 'red');
              }

              $('.message').text(result.message);
            }

            else {

              alert(result.message)

            }

          }

        });



      }

      else {

        alert("Please Enter Username");

        $('#fusername').focus();

      }

    }
    window.addEventListener('load', function () {
      <?
      if (set_value('login_type') == 'otp') {
        ?>
        $('.otp_login').trigger('click');
        <?
      }
      ?>
    });
  </script>
</body>

</html>