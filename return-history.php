<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');
function getAllreturndata()
{
    global $con;
    $query = "SELECT * FROM returndata WHERE status = '1' ";
    return $query_run = mysqli_query($con, $query);
}
function getreturnHistory()
{
    global $con;
    $query = "SELECT * FROM returndata WHERE status != '0' ";
    return mysqli_query($con, $query);

}
?>


<div class="container">
<div class="row">
<div class="col-md-12">
  <div class="card">
    <div class="card-header bg-danger">
      <h4 class="text-white">Orders History
        <a href="returnadmin.php" class="btn btn-warning float-end">Back</a>
      </h4>
    </div>
    <div class="card-body" id="">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Order Date</th>
                <th>Reason</th>
                <th>Price</th>
                <th>Address</th>
                <th>Contact</th>
               
              </tr>
            </thead>
            <tbody>
              <?php
                $data = getreturnHistory();

                if(mysqli_num_rows($data) > 0)
                {
                    foreach ($data as $item) {
              ?>
                <tr>
                    <td><?= $item['id'];  ?>            </td>
                    <td><?= $item['customername'];  ?>  </td>
                    <td><?= $item['orderdate'];  ?>     </td>
                    <td><?= $item['reason'];  ?>        </td>
                    <td><?= $item['price'];  ?>         </td>
                    <td><?= $item['address'];  ?>       </td>
                    <td><?= $item['contact'];  ?>       </td>
                </tr>
              <?php
                    }
                }else{
              ?>
                <tr>
                  <td colspan="5"> No Orders Yet </td>
                </tr>
              <?php
                }
              ?>
             
            </tbody>
          </table>
           
        </div>
      </div>
    </div>
  </div>
</div>
   

    <?php
     include('includes/footer.php');
    ?>
