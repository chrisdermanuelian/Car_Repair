<?php
include("config.php");
    
    session_start();
   
$first_name = mysqli_real_escape_string($connection, $_POST['fname']);
$last_name = mysqli_real_escape_string($connection, $_POST['lname']);
$address = mysqli_real_escape_string($connection, $_POST['address']);
$city = mysqli_real_escape_string($connection, $_POST['city']);
$state = mysqli_real_escape_string($connection, $_POST['state']);
$zip = mysqli_real_escape_string($connection, $_POST['zip']);
$email_address = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);

/*Firstname: <input type="text" name="fname" /><br><br>
Lastname: <input type="text" name="lname" /><br><br>
Address: <input type="text" name="address" /><br><br>
City: <input type="text" name="city" /><br><br>
State: <input type="text" name="state" /><br><br>
ZIP: <input type="text" name="zip" /><br><br>
Email: <input type="text" name="email" /><br><br>
Password: <input type="text" name="password" /><br><br>*/

 

// attempt insert query execution

$sql = "INSERT INTO CUSTOMER (CUST_FNAME, CUST_LNAME, CUST_ADDRESS, CUST_CITY, CUST_STATE, CUST_ZIP,
CUST_EMAIL, CUST_PASSWORD) VALUES ('$first_name', '$last_name','$address', '$city', '$state',
'$zip', '$email_address', '$password')";

if(mysqli_query($connection, $sql)){

    header("location: login.php");

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);

}
   
   mysqli_close($connection);
?>