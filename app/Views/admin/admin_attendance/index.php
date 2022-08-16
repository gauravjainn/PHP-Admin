<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>



<?=  $this->section('content-header') ?>



<div class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<!-- <h1 class="m-0">Checkin</h1> -->

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>

<li class="breadcrumb-item active">Checkin</li> -->

</ol>

</div>

</div>

</div>

</div>



<?= $this->endSection() ?>



<?= $this->section('section-content') ?>



<section class="content">



<div class="container-fluid">

<div id="message"></div>

<div class="row">



<div class="col-sm-12">



<div class="card">



<div class="card-header">

    <?=    $this->include('admin/admin_attendance/tabs')    ?>

</div>



<div class="card-body">

 
<table class="table table-striped" id="checkin">
<!-- <div class="form-group" style="text-align:right;">
  <button type="submit" class="btn btn-success" name="btn" value="excel"><i class="fas fa-file-csv"></i>  Export CSV  </button>
  <button type="submit"  class="btn btn-primary" name="btn" value="pdf"><i class="fas fa-file-pdf" aria-hidden="true"></i> Export PDF</button>
  </div> -->

      <thead style="white-space: nowrap;">

        <tr>

          <th>ID</th>

          <th>Employee Code</th>

          <th>Name</th>

          <th>Status</th>

          <th>Date/Time</th>

          <th>Action</th>

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



<div class="modal fade" id="Mymodal">

		<div class="modal-dialog">

			<div class="modal-content">

		

				<div class="modal-body">

  <form action="<?= base_url('admin/export-data');   ?>" id="export-checkin" method="POST">

    <div class="form-group">

    <label >Employee Code</label>

    <input type="text" class="form-control" name="emp_code" id="emp_code"  placeholder="Enter Employee Code" >

  </div>



  <div class="form-group">

    <label >From</label>

    <input type="date" class="form-control" name="from_date" id="from_date"  >



    <input type="hidden" id="from_shadow" data-from="">

  </div>

  <div class="form-group">

    <label>To</label>

    <input type="date" class="form-control" name="to_date" id="to_date" >

    <input type="hidden" id="to_shadow" data-to="">

  </div>

  <input type="hidden" name="btn" id="exp-val" value="">

  <!--<div class="form-group">-->

  <!--<button type="submit" class="btn btn-primary" name="btn" value="excel">Export Csv</button>-->

  <!--<button type="submit"  class="btn btn-primary" name="btn" value="pdf">Export Pdf</button>-->

  <!--</div>-->



  <button type="button" id="search_btn" class="btn btn-primary">Search</button>

</form>

				</div>   

				<div class="modal-footer">

					<button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>                               

				</div>

			</div>                                                                       

		</div>                                          

	</div>
	
	
<div class="modal" tabindex="-1" role="dialog" id="not_checkin_mod">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="justify-content: center;">
        <h5 class="modal-title">Not Checkin Today</h5>
        
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
     
    
      <div class="modal-body" id="not_chekin_body">

      <!-- <span style="text-align: center;" id="message_info"><small class="text-info" style="font-size: 13px;">note -: Click on not checkin button to see the record of not checkin employee.</small>   </span> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_nt_checkin">Not Chekin</button>
        <button type="button" class="btn btn-secondary" id="close_btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<?=  $this->endSection() ?>



<?=  $this->section('scripts')  ?>

<script>



$(document).ready(function(){





    var new_val =  $('#def_value').val();

  

    var url = "<?php echo base_url(); ?>";

    var site_url = url+'/admin/';



  var checkintable =   $('#checkin').DataTable({

    // lengthMenu: [[ 10, 30, -1], [ 10, 30, "All"]], // page length options

    bProcessing: true,

    serverSide: true,

    searching: false,

    scrollY: "400px",

    scrollCollapse: true,

    "language": {

      "emptyTable": "No Record Found"

    },

    ajax: {

    

      url: site_url+"ajax-load-checkin", 

      type: "post",

      // data: {

      //     "date_pick" : $('#test').attr('data-block')

      // }

      data: function (d) {

                    return $.extend({}, d, {

                      // "date_pick" : $('#test').attr('data-block')

                      "from_date": $('#from_shadow').attr('data-from'),

                      "To_date": $('#to_shadow').attr('data-to'),

                      "emp_code": $('#emp_code').val()

                    });

                }

    },

    columns: [

      { data: "id" },

      { data: "employee_code"},

      { data: "name" },

      { data: "status" },

      { data: "date" },

      { data: "action" }

    ],

    columnDefs: [

      { orderable: false, targets: [0, 1, 2, 3] }

    ],

    bFilter: true, // to display datatable search

  });







  //   $('#filter').click(function (e) {

  //      checkintable.ajax.reload();

  // });



$('#search_btn').click(function(e){

  $('#Mymodal').modal('hide');

  checkintable.ajax.reload();

});





  $("#from_date").on("change", function () {

        var fromdate = $(this).val();

       $('#from_shadow').attr('data-from',fromdate);

  });



  $("#to_date").on("change",function(){

    var todate = $(this).val();

    $('#to_shadow').attr('data-to',todate);

  });







});



$(document).on('click','#calendar-btn',function(){

  $('#Mymodal').modal('show');

});

// import excel
$('#excel-btn').on('click',function(){
  $('#exp-val').val('excel');
  $('#export-checkin').submit();
});

// import pdf
$('#pdf-btn').on('click',function(){
  $('#exp-val').val('pdf');
  $('#export-checkin').submit();
});

//click not checkin button 
$(document).on('click','#not_checkin',function(){


  var url = "<?php echo base_url(); ?>";
  var site_url = url+'/admin/';

  $.ajax({  
      url: site_url+"not-checkin",
      type: 'post',
      dataType:'json',
      data:{},
      success:function(data){
         if(data.status == true)
         {
             $('#message_info').css("display", "none");
             $('#btn_nt_checkin').css("display", "none");
             $('#not_chekin_body').html(data.view_html);
             $('#not_checkin_mod').modal('show');
         }
      }  
      });



});

$(document).on('click','#close_btn',function(){

  location.reload(true);

});


// click on move to leave button
$(document).on('click','#move_checkin',function(){

  if(confirm("Are you sure want to perform this action?"))
  {
    var url = "<?php echo base_url(); ?>";
    var site_url = url+'/admin/';
    var user_id = $(this).data('id');

    $.ajax({
        url: site_url+"move-leave",
        type: 'post',
        dataType:'json',
        data:{'emp_id':user_id},
        success:function(data){
          if(data.status == true)
          {
            $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)

              // page reload after 5seconds
              setTimeout(function() { location. reload(); }, 5000);
          }
        } 


    });

  }

});

// click on trash button to delete the record
$(document).on('click','#delete_checkin',function(){

  
  if(confirm("Are you sure want to delete this record?"))
  {

      var url = "<?php echo base_url(); ?>";
      var site_url = url+'/admin/';
      var user_id = $(this).data('id');

      $.ajax({
        url: site_url+"delete-checkin",
        type: 'post',
        dataType:'json',
        data:{'emp_id':user_id},
        success:function(data){
          if(data.status == true)
          {
            $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)

              // page reload after 5seconds
              setTimeout(function() { location. reload(); }, 5000);
          }
        } 


    });

  }

});

</script>

<?=  $this->endSection() ?>