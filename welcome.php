<?php
include('config.php');
   //include('session.php');
   session_start();
   //$_SESSION['cur_user_id'];  USER ID NUMBER
   //QUERY FOR CUSTOMER DATA
   $sql_CUST = "SELECT CUST_FNAME, CUST_LNAME, CUST_ADDRESS, CUST_CITY, CUST_ZIP, CUST_EMAIL FROM CUSTOMER WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
   $result_CUST = mysqli_query($connection,$sql_CUST);
   $cust = mysqli_fetch_array($result_CUST, MYSQLI_ASSOC);
   
   //GET CUSTOMER INFO
   $_SESSION['first_name'] = $cust['CUST_FNAME'];
   $_SESSION['last_name'] = $cust['CUST_LNAME'];
   $_SESSION['street'] = $cust['CUST_ADDRESS'];
   $_SESSION['city'] = $cust['CUST_CITY'];
   $_SESSION['zip'] = $cust['CUST_ZIP'];
   $_SESSION['email'] = $cust['CUST_EMAIL'];
   
   //QUERY FOR CAR DATA
   $sql_CAR = "SELECT CAR_VIN, VEH_ID FROM CAR WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
   $result_CAR = mysqli_query($connection, $sql_CAR);
   $car = mysqli_fetch_array($result_CAR, MYSQLI_ASSOC);
   
   //GET CAR INFO
   $_SESSION['car_vin'] = $car['CAR_VIN'];
   $_SESSION['veh_id'] = $car['VEH_ID'];
   
   //QUERY FOR VEHICLE DATA
   $sql_VEH = "SELECT VEH_MAKE, VEH_MODEL, VEH_YEAR FROM VEHICLE WHERE VEH_ID = '".$_SESSION['veh_id']."'";
   $result_VEH = mysqli_query($connection, $sql_VEH);
   $veh = mysqli_fetch_array($result_VEH, MYSQLI_ASSOC);
   
   $_SESSION['veh_make'] = $veh['VEH_MAKE'];
   $_SESSION['veh_model'] = $veh['VEH_MODEL'];
   $_SESSION['veh_year'] = $veh['VEH_YEAR'];
   

?>
       
        
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Car Service</title>

    <!-- Bootstrap Core CSS -->
    <link href="startbootstrap-sb-admin-gh-pages/startbootstrap-sb-admin-gh-pages/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="startbootstrap-sb-admin-gh-pages/startbootstrap-sb-admin-gh-pages/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="startbootstrap-sb-admin-gh-pages/startbootstrap-sb-admin-gh-pages/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="welcome.php">Welcome to Car Service!</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <?php if($_SESSION['cur_user_id']): ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['first_name']," ", $_SESSION['last_name']?></a>
                    <?php else: ?>
                        <a href="login.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Login / Sign up</a>
                    <?php endif; ?>
                    
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="welcome.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="specifyVehicle.php"><i class="fa fa-fw fa-car"></i> Add a car</a>
                    </li>
                    <li>
                        <a href="viewEditAppointments.php"><i class="fa fa-fw fa-calendar-o"></i> View/Edit Appointments</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-close"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <i class="fa fa-car fa-5x"></i>
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="huge">Vehicles</div>
                                        <div>Here are your Vehicles!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Year</th>
                                        <th>Vin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php include("config.php");
                                        	$username = "christopherderma";
                                        	$password = "";
                                        	$hostname = "127.0.0.1";
                                        	
                                        	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
                                        	$selected = mysql_select_db("c9", $dbhandle) or die("Could not select examples");
                                        	$choice = mysql_real_escape_string($_GET['choice']);
                                        
                                        	$whichAreMine = "SELECT * FROM (SELECT CAR.CUST_ID, CAR.VEH_ID, VEHICLE.VEH_MAKE, VEHICLE.VEH_MODEL, VEHICLE.VEH_YEAR, CAR.CAR_VIN
                                        	FROM VEHICLE 
                                        	INNER JOIN CAR
                                        	ON CAR.VEH_ID = VEHICLE.VEH_ID) a WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
                                        	
                                        	$result = mysql_query($whichAreMine);
                                        	
                                        while($row = mysql_fetch_array($result)){
                                            if ($row['VEH_YEAR'] <= 2000):
                                                echo "<tr class = 'danger'>";
                                            elseif ($row['VEH_YEAR'] > 2000 and $row['VEH_YEAR'] < 2008):
                                                echo "<tr class = 'warning'>";
                                            else:
                                                echo "<tr class = 'success'>";
                                            endif;
                                            echo "<td>" . $row['VEH_MAKE'] . "</td>";
                                            echo "<td>" . $row['VEH_MODEL'] . "</td>";
                                            echo "<td>" . $row['VEH_YEAR'] . "</td>";
                                            echo "<td>" . $row['CAR_VIN'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-lg-8">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <i class="fa fa-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="huge">Appointments</div>
                                        <div>These are your appointments!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Service Type</th>
                                        <th>Technician</th>
                                        <th>Vin Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php include("config.php");
                                        	$username = "christopherderma";
                                        	$password = "";
                                        	$hostname = "127.0.0.1";
                                        	
                                        	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
                                        	$selected = mysql_select_db("c9", $dbhandle) or die("Could not select examples");
                                        	$choice = mysql_real_escape_string($_GET['choice']);
                                        
                                        	$whichAreMine = "SELECT * FROM (SELECT CAR.CUST_ID, APPOINTMENT.DATE, APPOINTMENT.SERV_ID, APPOINTMENT.TECH_ID, APPOINTMENT.CAR_VIN
                                        	FROM APPOINTMENT 
                                        	INNER JOIN CAR
                                        	ON CAR.CAR_VIN = APPOINTMENT.CAR_VIN) a WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
                                        	
                                        	$result = mysql_query($whichAreMine);
                                        	
                                        	
                                        while($row = mysql_fetch_array($result)){
                                               $sql2 = "SELECT TECH_FNAME FROM TECHNICIAN WHERE TECH_ID = '".$row['TECH_ID']."'"; 
                                               $query2 = mysqli_query($connection, $sql2);
                                               $tech = mysqli_fetch_assoc($query2);
                                               
                                               $sql_service = "SELECT SERV_DESCRIPTION FROM SERVICE_TYPE WHERE SERV_ID = '".$row['SERV_ID']."'";
                                               $query_service = mysqli_query($connection, $sql_service);
                                               $serv = mysqli_fetch_assoc($query_service);
                                            echo "<tr>";
                                            echo "<td>" . $row['DATE'] . "</td>";
                                            echo "<td>" . $serv['SERV_DESCRIPTION'] . "</td>";
                                            echo "<td>" . $tech['TECH_FNAME'] . "</td>";
                                            echo "<td>" . $row['CAR_VIN'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>