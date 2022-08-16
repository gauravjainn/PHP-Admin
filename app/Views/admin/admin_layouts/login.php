<?= $this->extend('admin/admin_layouts/login_layout') ?>



<?= $this->section("content") ?>



<?php

    if(session()->has("message")){

      echo "<div class='alert alert-danger mt-2'>";

      echo session("message");

      echo "</div>";

    }

?>





<form action="<?= base_url('admin/auth'); ?>" id="admin_form" method="post" >
 <div class="input-group mb-3">

<input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
<br>
<div class="input-group-append">

<div class="input-group-text">
    <span class="fas fa-envelope"></span>
    
</div>

</div>

</div>
<div>  <label id="email-error" class="error mahilex123" for="email"></label> </div>
 

<?php if (isset($validation)) : ?>

<?php if($validation->getError('email')) {?>

            <div class='alert alert-danger mt-2'>

              <?= $error = $validation->getError('email'); ?>

            </div>

<?php }?>



<?php endif; ?>

<div class="input-group mb-3">

<input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
<br>

 

<div class="input-group-append">

<div class="input-group-text">

<span class="fas fa-lock"></span>

</div>

</div>

</div>
<div> <label id="password-error"  class="error mahilex123" for="password"></label></div>

<?php if (isset($validation)) : ?>

<?php if($validation->getError('password')) {?>

            <div class='alert alert-danger mt-2'>

              <?= $error = $validation->getError('password'); ?>

            </div>

<?php }?>

<?php endif; ?>

<div class="row">

<div class="col-8">

<div class="icheck-primary">

<input type="checkbox" id="remember">

<label for="remember">

Remember Me

</label>

</div>

</div>



<div class="col-4">

<button type="button" id="sing_btn" class="btn btn-primary btn-block">Sign In</button>

</div>



</div>

</form>



<?= $this->endSection() ?>



<?= $this->section('scripts') ?>

<script>



$(document).ready(function(){



  

$('#admin_form').validate({ // initialize the plugin

    rules: {

      email: {

            required: true,

        },

        password: {

            required: true,

        }

    },

    messages :{

      email:{

            required : 'The email field is required.'

        },

        password:{

            required : 'The Password Field is required.'

        }

    }

});



$('#sing_btn').on('click',function(){



  if($("#admin_form").valid())

  {

    $("#admin_form").submit();

  }





});



});

</script>

<?=  $this->endSection() ?>