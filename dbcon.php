<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pappushop";


//creating database connection 
$con = mysqli_connect($host , $username , $password , $database);


// chek database connection
if(!$con)
{
    die("Connection Failed : ".mysqli_connect_error());
}



?>


