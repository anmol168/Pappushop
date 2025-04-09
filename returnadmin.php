<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');

function returndata() {
    global $con;
    $query = "SELECT * FROM returndata WHERE status = '0'";
    return mysqli_query($con, $query);
}

?>



<div class="container">
<div class="row">
<div class="col-md-12">
  <div class="card">
  <div class="card-header bg-danger">
      <h4 class="text-white">Products
        <a href="return-history.php" class="btn btn-warning float-end m-2">History</a>
      </h4>
    </div>
  
    <div class="card-body">
      <table class="table  table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Order Date</th>
            <th>Reason</th>
            <th>Price</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Accept</th>
            <th>Reject</th>


          </tr>
        </thead>
        <tbody>
            <?php
            $returndata = returndata();

              if(mysqli_num_rows($returndata) >0)
              {
                foreach($returndata as $item)
                {
                    ?>

                    <tr>
                    <td><?= $item['id'];  ?>            </td>
                    <td><?= $item['customername'];  ?>  </td>
                    <td><?= $item['orderdate'];  ?>     </td>
                    <td><?= $item['reason'];  ?>        </td>
                    <td><?= $item['price'];  ?>         </td>
                    <td><?= $item['address'];  ?>       </td>
                    <td><?= $item['contact'];  ?>       </td>
                    <td>
                    <form action="code.php" method="POST"  >
                          <input type="hidden" name="rstatus" value="<?= $item['id'];  ?> " >
                        <button type="submit" class="btn btn-sm btn-primary " name="accept_btn"  >Accept</button>
                        </form>
                    </td>  <td>
                    <form action="code.php" method="POST"  >
                          <input type="hidden" name="product_id" value="<?= $item['id']; ?>" >
                        <button type="submit" class="btn btn-sm btn-danger " name="reject_btn"  >Delete</button>
                        </form>
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