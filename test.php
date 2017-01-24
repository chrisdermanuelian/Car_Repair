<?php
    
    //Connect to the database
    $host = "127.0.0.1";
    $user = "christopherderma";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "c9";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());



    //And now to perform a simple query to make sure it's working
$sql = "SELECT * FROM CUSTOMER";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["CUST_ID"]. " - Name: " . $row["CUST_FNAME"]. " " . $row["CUST_LNAME"]. "<br>";
    }
} else {
    echo "0 results";
}

?>