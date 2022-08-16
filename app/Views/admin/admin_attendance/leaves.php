<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>

<?=  $this->section('content-header') ?>

<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<!-- <h1 class="m-0">Leaves</h1> -->
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Leaves</li> -->
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

<table class="table table-striped" id="leaves">
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
  <form action="<?= base_url('admin/export-leave-data'); ?>" id="export-leaves" method="POST">
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

  <!-- <div class="form-group">
  <button type="submit" class="btn btn-primary" name="btn" value="excel">Export Csv</button>
  <button type="submit"  class="btn btn-primary" name="btn" value="pdf">Export Pdf</button>
  </div> -->

  <button type="button" id="search_btn" class="btn btn-primary">Search</button>
</form>
				</div>   
				<div class="modal-footer">
					<button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>                               
				</div>
			</div>                                                                       
		</div>                                          
	</div>

<?=  $this->endSection() ?>

<?=  $this->section('scripts')  ?>
<script>

$(document).ready(function(){

  
var url = "<?php echo base_url(); ?>";
var site_url = url+'/admin/';

var leave_table = $('#leaves').DataTable({
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
  url: site_url+"ajax-load-leaves", 
  type: "post",
  data: function (d) {
                    return $.extend({}, d, {
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


$('#search_btn').click(function(e){
  $('#Mymodal').modal('hide');
  leave_table.ajax.reload();
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

// clicking on calendar btn model will open
$(document).on('click','#calendar-btn',function(){
  $('#Mymodal').modal('show');
});

// import excel
$('#excel-btn').on('click',function(){
  $('#exp-val').val('excel');
  $('#export-leaves').submit();
});

// import pdf
$('#pdf-btn').on('click',function(){
  $('#exp-val').val('pdf');
  $('#export-leaves').submit();
});


//click on move to checkin button
$(document).on('click','#move_leave',function(){

  var user_id = $(this).data('id');

  if(confirm("Are you sure want to perform this action?"))
  {
    var url = "<?php echo base_url(); ?>";
    var site_url = url+'/admin/';
    var user_id = $(this).data('id');

    $.ajax({
        url: site_url+"move-checkin",
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