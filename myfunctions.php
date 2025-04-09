<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    include('../config/dbcon.php');
}


function getAll($table)
{

    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con ,$query);
}

function getByID($table, $id)
{

    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($con ,$query);
}

function redirect($url , $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function getAllFeedback()
{
    global $con;
    $query = "SELECT * FROM feedback";
    return mysqli_query($con, $query);
}
function checkTrackingNoValid($trackingNo)
{
    global $con;
    $query = " SELECT * FROM orders WHERE tracking_no ='$trackingNo' ";
    return mysqli_query($con, $query);

}

?>