<?php
    require_once("backend/action.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link style -->
    <link rel="stylesheet" href="assets/css/mystylesss.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!--- Box Icons --->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>JuanRental</title>
</head>

<body>

    <!-- Nav -->
    <header>
        <div class="nav container">
            <!-- Logo -->
            <a href="#" class="logo">Juan<span class="color">Rental</span></a>
            <!-- Navbar -->
            <ul class="navbar">
                <li><a href="index.php#home" class="nav-link">Home</a></li>
                <li><a href="aboutUs.php" class="nav-link">About Us</a></li>
                <li><a href="index.php#cars" class="nav-link">Cars</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>

                <!-- Check if user is logged in -->
                <?php
                    if(isset($_SESSION['user_name'])){
                        $cartItems = $cart->getCartItems($_SESSION['user_name']);
                        ?>
                        <div class="logout">
                            <li><a href=""><span><?php echo $_SESSION['user_name']?></span></a>  
                                <ul>
                                    <li><a href="cart.php"><i class="bi bi-cart"></i>Cart</a></li>
                                    <li><a href="logout.php"><i class="bi bi-box-arrow-left"></i>LOGOUT</a></li>
                                </ul>
                            </li>
                        </div>
                    <?php
                    }
                    else{ ?>
                        <li><a href="index.php#home"><button class='btnLogin-popup'>Login</button></a></li>
                    <?php } ?>
                
            </ul>
            <!-- Menu Icon -->
            <div class="menu-icon">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
    </header>