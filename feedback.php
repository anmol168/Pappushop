<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<style>
   body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        margin-top: 20px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
    }

    .table {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th {
        background-color: #343a40;
        color: white;
        text-align: center;
        padding: 10px;
    }

    .table td {
        text-align: center;
        padding: 10px;
        vertical-align: middle;
    }

    .btn-danger {
        padding: 5px 10px;
        font-size: 14px;
    }

    /* Responsive */
    @media screen and (max-width: 992px) {
        .table th, .table td {
            font-size: 14px;
            padding: 8px;
        }

        .btn-danger {
            font-size: 12px;
            padding: 4px 8px;
        }
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Feedback</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">  <!-- Added this wrapper -->
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Experience</th>
                                    <th>Product Selection</th>
                                    <th>Mobile Repair</th>
                                    <th>Product Quality</th>
                                    <th>Payment Method</th>
                                    <th>Return Process</th>
                                    <th>Customer Service</th>
                                    <th>Suggestions</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $feedbacks = getAll("feedback");

                                if (mysqli_num_rows($feedbacks) > 0) {
                                    foreach ($feedbacks as $feedback) {
                                ?>
                                        <tr>
                                            <td><?= $feedback['id']; ?></td>
                                            <td><?= htmlspecialchars($feedback['name']); ?></td>
                                            <td><?= htmlspecialchars($feedback['email']); ?></td>
                                            <td><?= htmlspecialchars($feedback['experience']); ?></td>
                                            <td><?= htmlspecialchars($feedback['product_selection']); ?></td>
                                            <td><?= htmlspecialchars($feedback['mobile_repair']); ?></td>
                                            <td><?= htmlspecialchars($feedback['product_quality']); ?></td>
                                            <td><?= htmlspecialchars($feedback['payment_method']); ?></td>
                                            <td><?= htmlspecialchars($feedback['return_process']); ?></td>
                                            <td><?= htmlspecialchars($feedback['customer_service']); ?></td>
                                            <td><?= htmlspecialchars($feedback['suggestions']); ?></td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="feedback_id" value="<?= $feedback['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_feedback_btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='12' class='text-center'>No feedback found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- End Responsive Wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
