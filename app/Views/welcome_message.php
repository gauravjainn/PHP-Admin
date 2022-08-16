<!-- <!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title>Login</title>
      <meta content="Admin Dashboard" name="description">
      <meta content="AMS" name="Coexis Tech">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
      <link rel="shortcut icon" href="https://eams.infovistar.com/assets/images/favicon.ico">
   
      <link href="<?= base_url('public/frontend/login_assets/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
      <link href="<?= base_url('public/frontend/login_assets/metismenu.min.css') ?> " rel="stylesheet" type="text/css">
      <link href="<?= base_url('public/frontend/login_assets/icons.css') ?>" rel="stylesheet" type="text/css">
      <link href="<?= base_url('public/frontend/login_assets/style.css') ?>" rel="stylesheet" type="text/css">
   </head>
   <body class="fixed-left">
    
      <div class="accountbg"></div>
  
      
       <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
  
   </body>
</html> -->



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CodeTown|Attendance</title>
        <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="<?=   base_url('public/frontend/style.css')  ?>" />
  </head>
  <body>
    
    <?= $this->renderSection('login-page')  ?>

<script src="<?=  base_url('public/frontend/script.js')  ?>"></script>
    <!-- <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script> -->
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
     <?= $this->renderSection('scripts')  ?>
  </body>
</html>