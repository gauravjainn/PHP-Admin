<div class="panel-footer row "><!-- panel-footer -->

    <div class="col-md-6 ">

         <div class="previous d-flex align-items-baseline">

                <a href="<?=  base_url('admin/user-checkin') ?>" class="btn   btn-block <?= (current_url() == base_url('admin/user-checkin'))  ?   'btn-primary' : 'btn-secondary' ?>">Checkin</a>

                <a href="<?= base_url('admin/user-leaves')  ?>" type="button" class="btn   btn-block <?= (current_url() == base_url('admin/user-leaves'))  ?   'btn-primary' : 'btn-secondary' ?>" style="margin-left: 5px;">Leaves</a>    
                <div class="form-group  " style="text-align:right; margin-left:37px; display:flex; width:100%; ">
                <div   style="width:130px" ><button  style="width:130px; margin-bottom:5px;" type="submit" class="btn btn-success" name="btn" id="excel-btn" value="excel"><i class="fas fa-file-csv"></i>  Export CSV  </button></div>
                <div style="width:130px"><button  style="width:130px; margin-bottom:5px; margin-left:6px; " type="submit"  class="btn btn-primary" name="btn" id="pdf-btn" value="pdf"><i class="fas fa-file-pdf" aria-hidden="true"></i> Export PDF</button></div>
   
   
  </div>
    </div>

   

</div>



<div class="col-md-6">



<div class="date-pick d-flex justify-content-end" style="margin-left: 8px;">

                <!-- <input type="submit" id="filter" class="btn-inline btn btn-danger ml-2" value="Filter" name="search" > -->

                <?php

                if(current_url() == base_url('admin/user-checkin'))
                {
                   echo "<div>";
                    echo '<a href="javascript:void(0);" id="not_checkin" style="width: 128px; margin-left: 7px;"> <i class="fas fa-eye" style="padding-top: 17px; padding-right: 18px;
    font-size: 25px;"></i></a>';
                    echo "</div>";
                }

                ?>


                <a href="javascript:void(0);" id="calendar-btn"><i style="font-size: 25px;" class="fa fa-calendar mt-3 text-primary" aria-hidden="true"></i></a>

                    <!-- <input type="hidden" id="test" data-block=""  value="">

                    <input type="date" name="date" value="" class="form-control" id="def_value" > -->

    </div>



</div>







</div>
