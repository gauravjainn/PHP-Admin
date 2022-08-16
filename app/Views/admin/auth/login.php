<?= $this->extend('admin/admin_layouts/login_layout') ?>



<?= $this->section("content") ?>



<?php

    if(session()->has("message")){

      echo "<div class='alert alert-danger mt-2'>";

      echo session("message");

      echo "</div>";

    }

?>

<?php

$pass = get_cookie("password",TRUE); 
$nam = get_cookie("username",TRUE);

if(isset($pass) && isset($nam))
{
   $check = "checked";
}
else
{
  $check = "";
}

?>





<form action="<?= base_url('admin/auth'); ?>" id="admin_form" method="post" >
 <div class="input-group mb-3">

<input type="text" name="name" id="name" value="<?php $data = get_cookie("username",TRUE); if(  isset($data)){echo $data;}else{} ?>" class="form-control" placeholder="Enter Username" autocomplete="off">

<br>
<div class="input-group-append">

<div class="input-group-text">
    <span class="fas fa-user"></span>
    
</div>

</div>

</div>

<label id="name-error" class="error mahilex123" for="name" style="color: red; font-size: 11px;"></label>
 

<?php if (isset($validation)) : ?>

<?php if($validation->getError('email')) {?>

            <div class='alert alert-danger mt-2'>

              <?= $error = $validation->getError('email'); ?>

            </div>

<?php }?>



<?php endif; ?>

<div class="input-group mb-3">

<input type="password" name="password" value="<?php $data = get_cookie("password",TRUE); if(  isset($data)){echo $data;}else{} ?>" class="form-control" placeholder="Password" autocomplete="off" >
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

<input type="checkbox" id="remember" name="remember" <?= $check ?> >

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

       name: {
            required: true,
        },
        password: {

            required: true,

        }

    },

    messages :{

      name:{
            required : 'The username field is required.'
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