<?php
// include('../include/connect.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "preww_pixxel";

$con=mysqli_connect($servername, $username, $password, $dbname);


 if($con){

}else{
	echo "Not access";
}
?>