<?php
include("config.php");
    
    session_start();
   
$veh_make = mysqli_real_escape_string($connection, $_POST['make']);
$veh_model = mysqli_real_escape_string($connection, $_POST['model']);
$veh_year = mysqli_real_escape_string($connection, $_POST['year']);
$vin_num = mysqli_real_escape_string($connection, $_POST['vin']);


//echo $_SESSION['cur_user_id'];


// attempt insert query execution

$sql = "INSERT INTO VEHICLE (VEH_ID, VEH_MAKE, VEH_MODEL, VEH_YEAR) VALUES (DEFAULT,'$veh_make','$veh_model','$veh_year')";
$query = mysqli_query($connection, $sql);
$getveh = "SELECT VEH_ID FROM VEHICLE WHERE VEH_MAKE = '$veh_make' and VEH_MODEL = '$veh_model' and VEH_YEAR = '$veh_year'";
$vehquery = mysqli_query($connection, $getveh);
$veh_id = mysqli_fetch_array($vehquery, MYSQLI_ASSOC);
$car = "INSERT INTO CAR (CAR_VIN, VEH_ID, CUST_ID) VALUES ('$vin_num','".$veh_id['VEH_ID']."','".$_SESSION['cur_user_id']."')";
$addcar = mysqli_query($connection, $car);

if($query){
    
    if($addcar){
        
            header("location: welcome.php");
        
        } else{
        
            echo "ERROR: Could not able to execute $car. " . mysqli_error($connection);
        
        }

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);

}


?>

