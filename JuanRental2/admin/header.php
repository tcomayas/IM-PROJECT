<?php
	require_once("../backend/action.php");
?>

<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../assets/admin/css/mystyle.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>J</span>-Rental</p>
  <a href="index.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
  <a href="brand.php"class="icon-a"><i class="fa fa-briefcase icons"></i> &nbsp;&nbsp;Brands</a>
  <a href="cars.php"class="icon-a"><i class="fa fa-car icons"></i> &nbsp;&nbsp;Cars</a>
  <a href="book.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Booking</a>
  <a href="messages.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Messages</a>
  <a href="#"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
			<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Dashboard</span>
			<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Dashboard</span>
	</div>

<div class="col-div-6">
	<div class="logout">
		<?php if(isset($_SESSION['admin_name'])){ ?>
		<li><a href="">Hi admin<span><?php echo $_SESSION['admin_name']?></span></a>
			<ul>
				<li><a href="../logout.php"><i class="bi bi-box-arrow-left"></i>LOGOUT</a></li>
			</ul>
		</li>
		<?php } else {
			header('location:../index.php?pleaseLogInFirst');
			exit();
		}?>
	</div>
</div>