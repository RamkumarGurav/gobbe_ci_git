
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
                                                      <?php echo $message; ?>
                                                      <?php echo form_open(base_url(__login__).'/loginAuth', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>

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
                                                        <!-- <a href="#ex1-pills-3" class="tab-redirect loo-btn lfb-btn">Forgot Your Password</a> -->
                                                      </div>
                                                      <button type="submit" name="doLoginBTN" value="1" class="lg-btn">Log In</button>
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
                                                      <?php echo $message; ?>
                                                      <?php echo form_open(base_url(__login__).'/loginAuth', array('method' => 'post', 'id' => '', 'style' => '', 'class' => '')); ?>
                                                      <div class="form-group">
                                                        <label for="lg-email">Phone Number</label>
                                                        <?php
                                                        $attributes = array(
                                                          'name' => 'contact_no',
                                                          'id' => 'contact_no',
                                                          'value' => set_value('contact_no'),
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
                                                            'autocomplete'=>"one-time-code",
                                                            'placeholder' => 'Enter OTP',

                                                            'required' => 'required'

                                                          );

                                                          echo form_input($attributes); ?>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                        <div class="fg-otp-btn">
                                                          <button type="button " class="get-otp"onClick="login_otp_func()">Get OTP</button>
                                                        </div>
                                                         <button type="submit" name="doLoginBTN" class="lg-btn">Log In</button>
                                                      <?php echo form_close() ?>
                                                    </div>


                                                      </div>
                                                      <p class="message"></p>
                                                     
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

      <script type="text/javascript">

        function login_otp_func() {
          $(this).text('Resend OTP');
          $('.message').text('');
          var contact_no = $('#contact_no').val();
          if (contact_no != '') {
            $(".loader").css("display", "block");
            $.ajax({
              type: "POST",
              url: '<?= base_url() ?>Login/verify_login_resend_otp',
              dataType: "json",
              data: { 'username': contact_no },
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
        </script>
        <script>
    if ('OTPCredential' in window) {
      window.addEventListener('DOMContentLoaded', e => {
    const input = document.querySelector('input[autocomplete="one-time-code"]');
    if (!input) return;
    const ac = new AbortController();
    const form = input.closest('form');
    if (form) {
      form.addEventListener('submit', e => {
        ac.abort();
      });
    }
    navigator.credentials.get({
      otp: { transport:['sms'] },
      signal: ac.signal
    }).then(otp => {
      input.value = otp.code;
      if (form) form.submit();
    }).catch(err => {
      console.log(err);
    });
  })
  }else {
        console.log('WebOTP API is not supported in this browser.');
    }
</script>
