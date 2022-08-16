<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>



<?= $this->section('header-cont') ?>

     All Users

<?= $this->endSection() ?>



<?=  $this->section('content-header') ?>





<div class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<!-- <div class="col-sm-6">

<h1 class="m-0">Users</h1>

</div> -->

<!-- <div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item"><a href="#">Home</a></li>

<li class="breadcrumb-item active">Users</li>

</ol>

</div> -->

</div>

</div>

</div>



<?= $this->endSection() ?>



<?= $this->section('section-content') ?>

<section class="content">



<a href="<?= base_url('admin/add-users') ?>" class="btn btn-primary" role="button" aria-pressed="true">Add Users</a>



<br/>

<br/>



<div class="container-fluid">





<?php

    if(session()->has("message")){

      echo "<div class='alert alert-danger mt-2'>";

      echo session("message");

      echo "</div>";

    }

?>



<div id="message"></div>







<div class="row">



<div class="col-sm-12">



<div class="card">

  <div class="card-body">

    

<table class="table table-striped" id="tbl-students-data">

      <thead  class="mr-3" style="white-space: nowrap; padding-left:0; padding-right:0; ">

        <tr  class="mr-3" >

          <th  style="padding-left:4px; padding-right:0;" class="text-left">ID</th>

          <th style="padding-left:0; padding-right:0;" class="text-left">Employee Code</th>

          <th style="padding-left:14px; padding-right:0;" class="text-left">Employee Email</th>

          <th style="padding-left:0; padding-right:0;" class="text-left">Employee Name</th>

          <th style="padding-left:0; padding-right:0;" class="text-left">Employee Designation</th>

          <th class="text-left">Status</th>

          <th style="padding-left:6px; padding-right:0;" class="text-left">Action</th>

        </tr>

      </thead>

      <tbody></tbody>

    </table>

  </div>

</div>

</div>

</div>

</div>

</section>

<?=  $this->endSection() ?>



<?=  $this->section('scripts')  ?>

<script>



$(document).ready( function () {



  var url = "<?php echo base_url(); ?>";



  var site_url = url+'/admin/';



$('#tbl-students-data').DataTable({

  // lengthMenu: [[ 10, 30, -1], [ 10, 30, "All"]], // page length options

  bProcessing: true,

  serverSide: true,

  scrollY: "400px",

  scrollCollapse: true,

  ajax: {

    url: site_url+"ajax-load-data", // json datasource

    type: "post",

    data: {

      // key1: value1 - in case if we want send data with request

    }

  },

  columns: [

    { data: "id" },

    { data: "employee_code"},

    { data: "email" },

    { data: "name" },

    { data: "designation" },

    { data: "status" },

    { data: "action" }

  ],

  columnDefs: [

    { orderable: false, targets: [0, 1, 2, 3] }

  ],

  bFilter: true, // to display datatable search

});

});



$(document).on('change','#status',function(){



  if(confirm("Are you sure want to Update the Status?")){

     var user_id = $(this).data('id');

     var status = $(this).data('status');



     var url = "<?php echo base_url(); ?>";

     var site_url = url+'/admin/';



      $.ajax({  

      url: site_url+"change-user-status",

      type: 'post',

      dataType:'json',

      data:{user_id:user_id,user_status:status},

      success:function(data){

         if(data.status == true)

         {

          $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(3000).fadeOut(3000)

         }

      }  

      });

    }

    else{

        return false;

    }

});





</script>

<?=  $this->endSection() ?>