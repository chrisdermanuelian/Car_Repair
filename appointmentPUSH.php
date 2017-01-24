<?php
include("config.php");
    
    session_start();


$vin = mysqli_real_escape_string($connection, $_POST['vin-choice']);
$service = mysqli_real_escape_string($connection, $_POST['service-choice']);
$technician = mysqli_real_escape_string($connection, $_POST['tech-choice']);
$date = mysqli_real_escape_string($connection, $_POST['date']);



//attempt insert query execution

$sql2 = "SELECT TECH_ID FROM TECHNICIAN WHERE TECH_FNAME = '$technician'"; 
$query2 = mysqli_query($connection, $sql2);
$row = mysqli_fetch_assoc($query2);

$sql_service = "SELECT SERV_ID FROM SERVICE_TYPE WHERE SERV_DESCRIPTION = '$service'";
$query_service = mysqli_query($connection, $sql_service);
$serv = mysqli_fetch_assoc($query_service);




$sql = "INSERT INTO APPOINTMENT (APT_ID, DATE, SERV_ID, TECH_ID, CAR_VIN) VALUES (DEFAULT, '$date', '".$serv['SERV_ID']."', '".$row['TECH_ID']."', '$vin')";
$query = mysqli_query($connection, $sql);

if($query){

    header("location: welcome.php");

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);

}
   
  mysqli_close($connection);
?>