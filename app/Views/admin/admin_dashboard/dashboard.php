<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>



<?= $this->section('header-cont') ?>

     Dashboard

<?= $this->endSection() ?>



<?=  $this->section('content-header') ?>





<div class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<!-- <div class="col-sm-6">

<h1 class="m-0">Dashboard</h1>

</div> -->

<!-- <div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item"><a href="#">Home</a></li>

<li class="breadcrumb-item active">Dashboard</li>

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

    

<div class="col-lg-3 col-6">

<div class="small-box bg-primary">

<div class="inner">

<h3><?= $count ?></h3>

<p>Users</p>

</div>

<div class="icon">

<i class="ion ion-person-add"></i>

</div>

<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

</div>

</div>



</div>

</div>

</section>

<?=  $this->endSection() ?>