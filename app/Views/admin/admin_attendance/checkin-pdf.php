<!DOCTYPE html>

<html lang="en">

<head>

  <title>Generate PDF in Codeigniter 4</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>

<body>



<div class="container mt-2">

  <h2 style="text-align: center;"> Employee Attendance Report</h2>

  <div class="panel panel-primary">

    <!-- <div class="panel-heading">

        Generate PDF in Codeigniter 4

        <a href="<?php echo base_url('generate-pdf') ?>" class="btn btn-info pull-right" style="margin-top:-7px">

        Download PDF

      </a>

    </div> -->
    <div style=" border:1px; border-color:black; width:800px; " class="panel-heading display: flex;
align-items: center;
justify-content: center;">
    <div style="width: 600px; margin-left:30px"  class="container mt-3 ">

        <table style="width:600px" class=" table  table-primary table-striped">

            <thead class="text-start" style="margin-right: 115px; background:black; color:white; padding:12px" >

                <tr class="text-start" style="  border:2px; border-color:black; border-inline-style: solid; margin-right:15px;";>

                    <th style="margin-right: 1px; text-align:start;">ID</th>

                    <th style="margin-right: 1px; text-align:start;">Employee Code</th>

                    <th style="margin-right: 1px; text-align:start;">Name</th>

                    <th style="margin-right: 1px; text-align:start;">Status</th>

                    <th style="margin-right: 1px; text-align:start;">Date/Time</th>

                </tr>

            </thead>

            <tbody style="margin-left: 27px; ">

           <?php

                if(count($result) > 0){

                     $n =0;

                    foreach($result as $results){

                         $n++;

                        ?>

                        <tr>

                            <td style="text-align: center;"><?= $n ?></td>

                            <td style="text-align: center;"><?= $results['emp_code'] ?></td>

                            <td style="text-align: center;"><?= $results['name'] ?></td>



                            <?php

                                if($results['checkstatus'] == 1)

                                {

                                   $status = 'checkin';

                                }

                            ?>



                            <td style="text-align: center;"><?= $status ?></td>

                        

                            <td style="text-align: center;"><?= date('d-m-Y h:i:s', strtotime($results['date'])) ?></td>

                        </tr>

                        <?php

                    }

                }

            ?>

            </tbody>

        </table>

    </div>
</div>
  </div>

</div>



</body>

</html>