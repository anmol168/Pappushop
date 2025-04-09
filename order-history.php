<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');
function getAllorders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status = '0' ";
    return $query_run = mysqli_query($con, $query);
}
function getordersHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status != '0' ";
    return mysqli_query($con, $query);

}
?>


<div class="container">
<div class="row">
<div class="col-md-12">
  <div class="card">
    <div class="card-header bg-danger">
      <h4 class="text-white">Orders History
        <a href="orders.php" class="btn btn-warning float-end">Back</a>
      </h4>
    </div>
    <div class="card-body" id="">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Tracking No</th>
                <th>Price</th>
                <th>Date</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $orders = getordersHistory();

                if(mysqli_num_rows($orders) > 0)
                {
                    foreach ($orders as $item) {
              ?>
                <tr>
                  <td> <?= $item ['id'] ?>          </td>
                  <td> <?= $item ['user_id'] ?>          </td>
                  <td> <?= $item ['name'] ?>          </td>
                  <td> <?= $item ['tracking_no'] ?> </td>
                  <td> <?= $item ['total_price'] ?>       </td>
                  <td> <?= $item ['created_at'] ?>  </td>
                  <td><a href="view-order.php?t=<?= $item ['tracking_no'] ?>" class="btn btn-danger">View Details</Details></a></td>
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
