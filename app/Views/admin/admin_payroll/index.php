<?=  $this->extend('admin/admin_layouts/dashboard_layout'); ?>

<?= $this->section('header-cont') ?>
     Payroll
<?= $this->endSection() ?>

<?= $this->section('section-content') ?>

<section class="content">

<!-- <a href="<?= base_url('admin/add-users') ?>" class="btn btn-primary" role="button" aria-pressed="true">Add Users</a> -->

<br/>

<br/>

<div class="container-fluid">


<div class="row">

<div class="col-sm-12">

<div class="card" >

  <div class="card-body" >

   <select id="emp_id" class="form-control" style="width: 25%;">
       <option value="">Select Employee Id</option>
       <?php
       
       if(isset($user) && count($user)>0)
       {
          foreach($user as $users)
          {
               echo "<option value='".$users["id"]."'>". $users['employee_code']."</option>";
          }
       }

       ?>
   </select>

   <span id="hid_btn" data-id="" style="display: none;"><a href="javascript:void(0)" id="excel_upload" class="btn btn-success mt-2 mb-2">Upload</a> <a href="javascript:void(0)" id="down_excel" class="btn btn-primary mt-2 mb-2">Download</a></span>

   <input type='file' id='excel_file' style="display: none;">


   <br/>

   <div id="message"></div>

   <div id="table"></div>

  </div>

  

</div>

</div>

</div>

</div>

</section>

<?=  $this->endSection() ?>

<?=  $this->section('scripts')  ?>
<script>



$(document).on('change','#emp_id',function(){

    var url = "<?php echo base_url(); ?>";
    var site_url = url+'/admin/';
    var emp_id = $(this).val();

    

    // alert(emp_id);

    if(emp_id == "")
    {
          $('#table').css('display','none')
          $('#hid_btn').css('display','none');
    }
    else
    {
        $('#hid_btn').css('display','block');

        $('#hid_btn').attr('data-id',emp_id);

        $('#table').css('display','block')

        $.ajax({  
        url: site_url+"payroll-layout",
        type: 'post',
        dataType:'json',
        data:{emp_id:emp_id},
        success:function(data){
            if(data.status == true)
            {

                $('#table').html(data.view_html);

            }
        }  
        });

    }

 


});

$(document).on('click','#upload_img',function(){

    var emp_id = $(this).data('id');
    console.log(emp_id);
    var month = $(this).data('month');
    var year =   $(this).data('year');
    
    $('#employee').val(emp_id);
    $('#month').val(month);
    $('#year').val(year);

    $("input[id='my_file']").trigger('click');

});

$(document).on('change','#my_file',function(){

    var fileExtension = ['xlsx','pdf'];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
    }
    else
    {
        var url = "<?php echo base_url(); ?>";
        var site_url = url+'/admin/';

         var fd = new FormData();
         var file = $('#my_file')[0].files;

         $('#month').val;

         if(file.length>0)
         {
            fd.append('file',file[0]);
            fd.append('emp_id',$('#employee').val());
            fd.append('month',$('#month').val());
            fd.append('year',$('#year').val());

            $.ajax({  

            url: site_url+"upload-payslip",
            type: 'post',
            dataType:'json',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,

            success:function(data){

                if(data.status == true)
                {
                    $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)
                   
                    $('.table').find("#upload_img[data-month='" + data.month + "']").attr('src','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShvvTCG4YnTXnlcU_e6cHLARgVzfT4rfhMiw&usqp=CAU')
                    $('.table').find("#after_upload[data-month='" + data.month + "']").css('display','block');
                    $('.table').find("#after_upload[data-month='" + data.month + "']").attr("href",data.data);
                    $('.table').find("#delete[data-month='" + data.month + "']").css('display','block');
                }

            }  

            });
         }
         else
         {
            alert("Please select a file.");
         }

    }

});

$(document).on('click','#delete',function(){

    var emp = $(this).data('id');
    var month = $(this).data('month');
    var year = $(this).data('year');

    var url = "<?php echo base_url(); ?>";
    var site_url = url+'/admin/';

    if(confirm('Are you sure want to perform this action ?')) 
    {
            $.ajax({  
            url: site_url+"delete-payslip",
            type: 'post',
            dataType:'json',
            data:{emp_id:emp,month:month,year:year},
            success:function(data){
                if(data.status == true)
                {
                    $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)
                    $('.table').find("#upload_img[data-month='" + data.data + "']").attr('src','https://www.freeiconspng.com/thumbs/upload-icon/upload-icon-22.png')
                    $('.table').find("#download[data-month='" + data.data + "']").css('display','none');
                    $('.table').find("#delete[data-month='" + data.data + "']").css('display','none');
                    $('.table').find("#after_upload[data-month='" + data.data + "']").css('display','none');
                }
            }  
            });
           
    } 

});

// click on excel upload button 
$(document).on('click','#excel_upload',function(){

    $("input[id='excel_file']").trigger('click');

});

$(document).on('change','#excel_file',function(){

    var fileExtension = ['xlsx'];

    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
    }
    else
    {
        var url = "<?php echo base_url(); ?>";
        var site_url = url+'/admin/';
        var user_id = $('#hid_btn').attr('data-id');

         var fd = new FormData();
         var file = $('#excel_file')[0].files;

         
         if(file.length>0)
         {
            fd.append('file',file[0]);
            fd.append('emp_id',user_id);

            $.ajax({  

            url: site_url+"upload-excel-payslip",
            type: 'post',
            dataType:'json',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,

            success:function(data){

                if(data.status == true)
                {
                    $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)
                }

            }  

            });
         }
         else
         {
            alert("Please select a file.");
         }
    }

});

// clicking on download button excel file download
$(document).on('click','#down_excel',function(){

    var user_id = $('#hid_btn').attr('data-id');
    var url = "<?php echo base_url(); ?>";
    var site_url = url+'/admin/';

    $.ajax({

        url: site_url+"download-excel-sample",
        type: 'post',
        dataType:'json',
        data:{emp_id:user_id},
        success:function(data){
            if(data.status == true)
            {
                window.location.href=""+data.data;
            }
            else
            {
                $('#message').html('<div class="alert alert-danger mt-2">'+data.message+'</div>').fadeIn(5000).fadeOut(5000)
            }
        } 

    });

});


</script>
<?=  $this->endSection() ?>