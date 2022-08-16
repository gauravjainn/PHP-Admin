

<!DOCTYPE html>

<html lang="en">

<head><script nonce="84cadb21-2c8e-460c-b461-2c1705179cad">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]},a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),z.defer=!0,z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin | Dashboard</title>



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<!--

<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->

<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

<!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->

<!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/jqvmap/jqvmap.min.css"> -->

<!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->

<!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->

<!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">  -->



<link rel="stylesheet" href="<?= base_url('public/admin/dashboard_assetes/dashboard.min.css')  ?>">



<!-- datatables link -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>



<!-- datepicker-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">



<?=  $this->renderSection('style')  ?>



</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">



<div class="preloader flex-column justify-content-center align-items-center">

<img class="animation__shake" src="<?= base_url('public/admin/images/test.png') ?>" width="200px" alt="AdminLTELogo" >

</div>



<!-- header include -->

<?= $this->include('admin/admin_layouts/partials/header'); ?>





<aside class="main-sidebar sidebar-dark-primary elevation-4">



<a href="#" class="brand-link">

<img src="<?= base_url('public/admin/images/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">

<span class="brand-text font-weight-light"><small style="color: #343a40" >Code-Town</small</span>

</a>



<div class="sidebar">



<div class="user-panel mt-3 pb-3 mb-3 d-flex">

<!-- <div class="image">

<img src="<?= base_url('public/admin/images/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">

</div> -->

<!-- <div class="info">

 <a href="#" class="d-block"><?=   session()->get('name');   ?></a>

</div> -->

</div>



<!-- sidebar include -->

<?= $this->include('admin/admin_layouts/partials/sidebar'); ?>



<div class="content-wrapper">



<?= $this->renderSection('content-header') ?>

<?=  $this->renderSection('section-content') ?>





</div>



<!-- footer include -->

<?= $this->include('admin/admin_layouts/partials/footer'); ?>



</div>



<script src="<?= base_url('public/admin/dashboard_assetes/jquery.min.js') ?>"></script>

<script src="<?= base_url('public/admin/dashboard_assetes/jquery-ui.min.js') ?>"></script>

<script src="<?= base_url('public/admin/dashboard_assetes/adminlte.js') ?>"></script>

<script src="<?= base_url('public/admin/dashboard_assetes/dashboard.js') ?>"></script>

<script src="<?= base_url('public/admin/dashboard_assetes/bootstrap.bundle.min.js')  ?>"></script>



<!-- Datatable script -->

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>



<script>

    $(function () {

    $('ul').find('.nav-link.active').parentsUntil(".nav-sidebar > .nav-treeview")

        .css({'display': 'block'})

        .addClass('menu-open').prev('a')

        .addClass('active'); 

});

</script>





<!-- datepicker-->

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<!-- plugin validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<?=  $this->renderSection('scripts') ?>

<!-- <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/sparklines/sparkline.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/jqvmap/jquery.vmap.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.js"></script>-->

<!-- <script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->

<!-- <script src="dist/js/demo.js"></script> -->



</body>

</html>

