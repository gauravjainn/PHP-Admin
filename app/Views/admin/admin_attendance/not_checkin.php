  <table class="table">
        <thead style="white-space: nowrap;">
          <tr>
            <th scope="col">S.no</th>
            <th scope="col">Employee Code</th>
            <th scope="col">Employee Name</th>
          </tr>
        </thead>
        <tbody>

        <?php
                if(is_countable($fetch_notcheckin) && count($fetch_notcheckin)>0){
                     $n =0;
                    foreach($fetch_notcheckin as $results){
                         $n++;
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $results['employeecode'] ?></td>
                            <td><?= $results['name'] ?></td>
                        </tr>
                        <?php

                        
                    }
                }
                else
                {
                      echo "<tr class='text-center'>";
                      echo "<td colspan='3'>".'No Record Found'."</td>";
                      echo "</tr>";
                }
               
            ?>
          

        </tbody>
     </table>