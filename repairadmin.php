<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');

function repairdata() {
    global $con;
    $query = "SELECT * FROM repair";
    return mysqli_query($con, $query);
}

?>



<div class="container">
<div class="row">
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4>Products</h4>
    </div>
    <div class="card-body">
      <table class="table  table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Defect</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Defect Description</th>
            <th>Address</th>
            <th>Product Image</th>

           


          </tr>
        </thead>
        <tbody>
            <?php
            $repairing = repairdata();

              if(mysqli_num_rows($repairing) >0)
              {
                foreach($repairing as $item)
                {
                    ?>

                    <tr>
                    <td><?= $item['id'];  ?>            </td>
                    <td><?= $item['productDefect'];  ?>  </td>
                    <td><?= $item['customerName'];  ?>     </td>
                    <td><?= $item['contactNo'];  ?>        </td>
                    <td><?= $item['defectDescription'];  ?>         </td>
                    <td><?= $item['address'];  ?>      </td>
                    <td>
                        <img src="../uploads/<?= $item['productImage'];  ?>" width="50px" height="50px" alt="<?= $item['productImage'];  ?> ">
                    </td>

                  </tr>
                  <?php
                }
                  
              }
              else
              {
                echo "No records Found";


              }
             

                 ?>
         
        </tbody>

      </table>
    </div>
  </div>
       





</div>
</div>

<?php include('includes/footer.php'); ?>