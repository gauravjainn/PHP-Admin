<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>


<?= $this->section('header-cont') ?>
     All Users
<?= $this->endSection() ?>

<?=  $this->section('content-header') ?>


<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<!-- <div class="col-sm-6">
<h1 class="m-0">Edit Users</h1>
</div> -->
<!-- <div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Edit Users</li>
</ol>
</div> -->
</div>
</div>
</div>

<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
	<div class="row">
      <div class="col-md-12">
        <form action="<?= base_url('admin/update-users/'.$fetch_user['id']) ?>" id="edit-form" method="POST" >   
         <?=  $this->include('admin/admin_users/form.php') ?>
         </form>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts')  ?>

<script>
$(document).ready(function(){

  $('#edit-form').validate({

    rules: {
      email: {
            required: true,
        },
        password: {
            required: true,
        },
        name: {
          required: true,
        },
        designation:{
           required: true,
        }
    },
    messages :{
      email:{
            required : 'The email field is required.'
        },
        password:{
            required : 'The Password Field is required.'
        },
        name:{
           required : 'The Name Field is required.'
        },
        designation:{
            required : 'The Designation Field is required.'
        }
    }


  });

  $('#sbt-btn').on('click',function(){

      if($("#edit-form").valid())
      {
        $("#edit-form").submit();
      }


  });




});



</script>


<?=  $this->endSection() ?>