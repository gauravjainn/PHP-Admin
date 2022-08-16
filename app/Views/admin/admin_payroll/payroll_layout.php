<table class="table">
<thead>
<?php

foreach($month as $months)
{
   echo "<th>".$months."</th>";
}

?>
</thead>
<tbody>
<tr>
    <?php
        $year =  date("Y");
        for($i=0;$i<12;$i++)
        {
            if(isset($pay_roll) && count($pay_roll)>0)
            {
               foreach($pay_roll as $pay_rolls)
               {

                   if($pay_rolls['user_id'] == $emp_id && $pay_rolls['month'] == $month[$i] && $pay_rolls['year'] == $year)
                   {
                       $user_id = $pay_rolls['user_id'];
                       $user_month = $pay_rolls['month'];
                       $user_year = $pay_rolls['year'];
                       
                      $attr = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShvvTCG4YnTXnlcU_e6cHLARgVzfT4rfhMiw&usqp=CAU';
                      $path = $pay_rolls['file_path'];
                      $an_html = "<a href='$path' data-month='$user_month' target='_blank' id='download'> Download </a>";
                      $del_btn = "<a href='javascript:void(0)' data-id='$user_id' data-month='$user_month' data-year='$user_year' id='delete'> Delete </a>";
                      break;
                   }
                   else
                   {
                      $attr = 'https://www.freeiconspng.com/thumbs/upload-icon/upload-icon-22.png';
                      $an_html = "";
                      $del_btn = "";
                   }

               }
            }
            else
            {
                $attr = 'https://www.freeiconspng.com/thumbs/upload-icon/upload-icon-22.png';
                $an_html = "";
                $del_btn = "";
            }
            echo"<td>";
            echo "<img src=$attr data-id='$emp_id' data-month='$month[$i]' data-year='$year' id='upload_img' width='80%' style='cursor: pointer;' />";
            echo "<a href='' id='after_upload' data-month='$month[$i]' style='display:none;'>Download</a>";
            echo "<a href='javascript:void(0)' data-id='$emp_id' data-month='$month[$i]' data-year='$year' style='display:none;' id='delete'> Delete </a>";
            echo $an_html;
            echo "<br/>";
            echo $del_btn;
            echo "</td>";
        }

        echo "<form method='post' enctype='multipart/form-data' id='myform' >";
        
        echo "<input type='hidden' name='month' id='month' value='' style='display: none;' />";
        echo "<input type='hidden' name='year' id='year' value='' style='display: none;' />";
        echo "<input type='hidden' name='emp_id' id='employee' value='' style='display: none;' />";

        echo "<input type='file' id='my_file' style='display: none;' />";
        echo "</form>";
    ?>
</tr>
</tbody>
</table>