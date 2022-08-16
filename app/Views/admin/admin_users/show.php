<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>



<?= $this->section('header-cont') ?>

     All Users

<?= $this->endSection() ?>



<?=  $this->section('content-header') ?>



<div class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<!-- <div class="col-sm-6">

<h1 class="m-0">Users Details</h1>

</div> -->

<!-- <div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item"><a href="#">Home</a></li>

<li class="breadcrumb-item active">UsersDetails</li>

</ol>

</div> -->

</div>

</div>

</div>



<?= $this->endSection() ?>



<?= $this->section('section-content') ?>

<section class="content">

  <div class="container-fluid">

    <div class="row">

       <div class="col-sm-8">

          <div class="card">

             <div class="card-body">

              <table class="table table-bordered" id="tbl-students-data">

               <tbody>

                <tr>

                    <th>Employee Code</th>

                    <td><?= $fetch_user[0]['employee_code'] ?></td>

                </tr>

                <tr>

                    <th>Employee Email</th>

                    <td><?= $fetch_user[0]['email'] ?></td>

                </tr>

                <tr>

                    <th>Employee Name</th>

                    <td><?= $fetch_user[0]['name'] ?></td>

                </tr>

                <tr>

                    <th>Employee Designation</th>

                    <td><?= $fetch_user[0]['role_name'] ?></td>

                </tr>

                <tr>

                    <th>Registration Date</th>

                    <td><?= date('d-m-Y', strtotime($fetch_user[0]['created_at']))  ?></td>

                </tr>

               </tbody>

              </table>

            </div>

         </div>

       </div>

    </div>

   </div>

</section>

<?=  $this->endSection() ?>