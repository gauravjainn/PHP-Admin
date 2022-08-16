<?= $this->extend('welcome_message') ?>



<?= $this->section('login-page') ?>

<!-- <div class="wrapper-page">

         <div class="card">

            <div class="card-body">

             <div class="p-3">

                  <h5 class="text-center">Daily Working Status</h5>

               </div>

               <div class="p-3">

             <form  class="form-horizontal&#x20;m-t-10" id="my-login-form" autocomplete="off" method="post" accept-charset="utf-8">

                     <div class="form-group">

                           <label for="username">Employee Code</label> 

                           <input type="text" class="form-control" name="emp_code" id="emp_code" placeholder="Enter employee code" >

                     </div>

                    

                        <div class="form-group">

                           <label for="userpassword">Password</label> 

                           <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" >

                        </div>

                        <div class="form-group row m-t-30">

                           <div class="col-sm-6">

                        <button class="btn btn-block btn-info w-md waves-effect waves-light" type="button" id="check_in">Check In</button>

                     </div>

                     <div class="col-sm-6">

                     <button class="btn btn-block btn-info w-md waves-effect waves-light" type="button" id="leave_btn"> On Leave Today</button>

                     </div>

                        </div>

                        <div class="form-group m-t-30 mb-0 row">

                         

                        </div>

                  </form>              

              </div>



              <div id="message"></div>

              <div id="leave_message"></div>



            </div>

         </div>

      </div> -->


<div class="container-fluid1">



  <div class="main-container">

    <div class="right-main-container">

      <img class="right-image1" src="<?= base_url('public/frontend/images/illustration.png') ?>" alt="" srcset="" />

    </div>

    <div class="left-main-container">


<?php

if(session()->has("message")){

  echo "<div class='alert alert-danger mt-2'>";

  echo session("message");

  echo "</div>";

}

?>


      <div class="left-side-main-container">
        <div class="mahilex">
          <div id="message"></div>
          <div class="mahi">
            <div id="leave_message"></div>
          </div>
        </div>


        <img class="logo" src="<?= base_url('public/frontend/images/Logo.png')  ?>" alt="logo" />

        <div class="input-box-container">

          <h5 class="heading">Daily Working Status</h5>



          <div class="input-section">

            <form class="flex-c" id="my-login-form" autocomplete="off" method="post" accept-charset="utf-8">

              <div class="input-box">

                <span class="label">Employee Code</span>

                <div class="flex-r input">

                  <input type="text" name="emp_code" value="<?php $emp_code = session()->get("emp_code"); if(isset($emp_code)){echo$emp_code;}else{}  ?>" id="emp_code" placeholder="Enter employee code" required>

                  <!--  <input type="text" placeholder="Enter your employee code" required /> -->


                </div>
                <label id="emp_code-error" class="error" for="emp_code"></label>

              </div>



              <div class="input-box">

                <span class="label">Password</span>

                <div class="flex-r input">

                  <input type="password" placeholder="Enter Password" autocomplete="current-password" required id="password" name="password" />


                  <i id="togglePassword" style="cursor: pointer; color: grey" class="bi bi-eye-slash"></i>

                </div>
                <label id="password-error" class="error" for="password"></label>

              </div>



              <div class="button-section">

                <button type="submit" class="btn btn-primary button11 " id="check_in">

                  Check In

                </button>

                <button type="submit" class="btn btn-secondary button12" id="leave_btn">

                  On Leave Today

                </button>

              </div>

              <?php

              $name = session()->get('user_name');

              if(isset($name))
              {
                // echo $name;
                // die;
                $url = base_url('users/user-profile');
                $btn = "<a href=$url id='profile_btn' class='btn btn-success btn-lg btn-block' ?>";
                $btn.= "Go to my Profile";
                $btn.= "</a>";
              }
              else
              {
                $btn = "";
              }

              ?>

             

              <div class="button-section2">
                  <?php  echo $btn;  ?>
                    <a href="<?= base_url('users/user-profile')   ?>" class="btn btn-success btn-lg btn-block" id="profile_btn" style="display: none;">Go to my Profile</a>
              </div>

            </form>

          </div>

        </div>

      </div>

    </div>


  </div>

</div>













<?= $this->endSection() ?>



<?= $this->section('scripts') ?>

<script>
  $(document).ready(function() {



    $('#my-login-form').validate({ // initialize the plugin

      rules: {

        emp_code: {

          required: true,

        },

        Password: {

          required: true,

        }

      },

      messages: {

        emp_code: {

          required: 'The Employee Code field is required.'

        },

        Password: {

          required: 'The Password Field is required.'

        }

      }

    });



    $('#check_in').on('click', function() {



      //This will check validation of form depending on rules

      if ($("#my-login-form").valid())

      {

        var form_data = $("#my-login-form").serialize();

        var url = "<?php echo base_url(); ?>";

        var site_url = url + '/';



        $.ajax({

          url: site_url + "check-in",

          type: 'post',

          dataType: 'json',

          data: form_data,

          success: function(data) {

            if (data.status == true)

            {

              $('#message').html('<table class="table table-borderless" style="line-height:2%;padding:5px 3px 3px 3px"; border="1" cellpadding="0" cellspacing="0"  background: #F5F5F5; border-radius: 8px; width="95%"><tbody><tr height="25"><td align="LEFT" valign="top" style="font-size:13px; text-align:center; background: #F5F5F5 ; color:green"><b><br>&nbsp; Dear ' + data.data.name + ' <br><br></b></td></tr><tr height="25"> <td align="LEFT" valign="top" style="font-size:11px; text-align:center;  background: #F5F5F5 ; color:green" border-radius: 8px;><b><br>&nbsp; ' + data.message + ' <br><br></b></td></tr></tbody></tbody></table>').fadeIn(1000).fadeOut(3000);

              $('#Password').val('');
              $('#profile_btn').css('display','block');

            } else

            {

              $('#message').html('<table style="line-height:130%;padding:5px 3px 3px 3px ;  background: #F5F5F5 ; color:"white" cellpadding="0" cellspacing="0" width="95%"><tbody><tr height="25"><td align="CENTER" valign="top" style="font-size:14px; border="0"; background: #F5F5F5 ; color:"white"><b><br> ' + data.message + ' <br><br></b></td></tr></tbody></table>').fadeIn(1000).fadeOut(3000);
              $('#Password').val('');

            }

          }

        });



      }



    });



    $('#leave_btn').on('click', function() {

      if ($("#my-login-form").valid())

      {

        var form_data = $("#my-login-form").serialize();

        var url = "<?php echo base_url(); ?>";

        var site_url = url + '/';



        $.ajax({

          url: site_url + "leaves",

          type: 'post',

          dataType: 'json',

          data: form_data,

          success: function(data) {

            if (data.status == true)

            {

              $('#leave_message').html('<table class="table table-borderless" style="line-height:2%;padding:5px 3px 3px 3px"  border="none"   background: #F5F5F5 ;	 cellpadding="0" cellspacing="0";text-align:center; font-size:12px;width="145%"><tbody><tr height="25"><td align="CENTER" valign="top" style="font-size:12px; background: #F5F5F5 ;  color:green"><b><br>&nbsp; Dear ' + data.data.name + ' <br><br></b></td></tr><tr height="25"> <td align="CENTER"  valign="top" style="font-size:11px; background: #F5F5F5 ; color:green"><b><br> ' + data.message + ' <br><br></b></td></tr></tbody></tbody></table>').fadeIn(1000).fadeOut(3000);

              $('#Password').val('');

            } else

            {

              $('#leave_message').html('<table style="line-height:130%;padding:5px 3px 3px 3px ;  background: #F5F5F5 ; color:"white" cellpadding="0" cellspacing="0" width="95%"><tbody><tr height="25"><td align="CENTER" valign="top" style="font-size:14px; border="0"; background: #F5F5F5 ; color:"white"><b><br> ' + data.message + ' <br><br></b></td></tr></tbody></table>').fadeIn(1000).fadeOut(3000);

              $('#Password').val('');

            }

          }

        });



      }

    });





  });
</script>

<?= $this->endSection() ?>