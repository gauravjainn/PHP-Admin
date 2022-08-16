<!DOCTYPE html>
<html lang="en">
<head>
  <title>Generate PDF in Codeigniter 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h2 style="text-align: center;"></h2>
  <div class="panel panel-primary">
    <div class="panel-heading">
        Leaves
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Code</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
           <?php
                if(count($result) > 0){
                     $n =0;
                    foreach($result as $results){
                         $n++;
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $results['emp_code'] ?></td>
                            <td><?= $results['name'] ?></td>

                            <?php
                                if($results['checkstatus'] == 1)
                                {
                                   $status = 'leave';
                                }
                            ?>

                            <td><?= $status ?></td>
                        
                            <td><?= date('d-m-Y h:i:s', strtotime($results['date'])) ?></td>
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

</body>
</html>