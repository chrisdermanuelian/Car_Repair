<?php
include("config.php");
    
    session_start();
    $_SESSION['cur_user_id'];

	$username = "christopherderma";
	$password = "";
	$hostname = "127.0.0.1";
	
	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	$selected = mysql_select_db("c9", $dbhandle) or die("Could not select examples");
	$choice = mysql_real_escape_string($_GET['choice']);
	
	$query = "SELECT * FROM SERVICE_TYPE";
	$result = mysql_query($query);
	
	$queryTech = "SELECT * FROM TECHNICIAN";
	$resultTech = mysql_query($queryTech);
	
	$queryVehicle = "SELECT * FROM VEHICLE";
	$resultVehicle = mysql_query($queryVehicle);
	
	
	
	$whichMakeAreMine = "SELECT * FROM (SELECT CAR.CUST_ID, CAR.VEH_ID, VEHICLE.VEH_MAKE
	FROM VEHICLE 
	INNER JOIN CAR
	ON CAR.VEH_ID = VEHICLE.VEH_ID) a WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
	
	$resultMake = mysql_query($whichMakeAreMine);
	
	

	$whichModelAreMine = "SELECT * FROM (SELECT CAR.CUST_ID, CAR.VEH_ID, VEHICLE.VEH_MODEL
	FROM VEHICLE 
	INNER JOIN CAR
	ON CAR.VEH_ID = VEHICLE.VEH_ID) a WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
  
  $resultModel = mysql_query($whichModelAreMine);
  
  $whichVinAreMine = "SELECT * FROM CAR WHERE CUST_ID = '".$_SESSION['cur_user_id']."'";
  $resultVin = mysql_query($whichVinAreMine);
	
	

?><!DOCTYPE html>
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
                            Schedule an Appointment!
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <i class="fa fa-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="huge">Appointments</div>
                                        <div>Put your info below!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-lg-8">
                    <div align = "center">
                        <form action="appointmentPUSH.php" id="appointmentForm" method = "post">
                            
						    <div class="form-group row">
						        <label class="col-xs-2 col-form-label">Date</label>
						        <div class="col-xs-10 selectContainer">
									<input type="date" name="date"/>
						        </div>
						    </div>
						    
						    <div class="form-group row">
						        <label class="col-xs-2 col-form-label">Vin</label>
						        <div class="col-xs-10 selectContainer">
									<select class="form-control" id="vin-choice" name="vin-choice" form="appointmentForm">
									  <?php
									  while ($row = mysql_fetch_array($resultVin)) {
									   		echo "<option>" . $row{'CAR_VIN'} . "</option>";
										}
									
										?>
									</select>
						        </div>
						    </div>
						    
						    <div class="form-group row">
						        <label class="col-xs-2 col-form-label">Service</label>
						        <div class="col-xs-10 selectContainer">
									<select class="form-control" id="service-choice" name="service-choice" form="appointmentForm">
									  <?php
									  while ($row = mysql_fetch_array($result)) {
									   		echo "<option>" . $row{'SERV_DESCRIPTION'} . "</option>";
										}
										?>
									</select>
						        </div>
						    </div>
						    
						    <div class="form-group row">
						        <label class="col-xs-2 col-form-label">Technician</label>
						        <div class="col-xs-10 selectContainer">
									<select class="form-control" id="tech-choice" name="tech-choice" form="appointmentForm">
									  <?php
									  while ($row = mysql_fetch_array($resultTech)) {
									   		echo "<option>" . $row{'TECH_FNAME'} . "</option>";
										}
									
										?>
									</select>
						        </div>
						    </div>
                            <input type = "submit" class ="btn btn-default"/><br />
                        </form>
            
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