<?php
    include("header.php");
?>

    <!-- form -->
    <div class="wrapper">
        <!-- close -->
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <!-- log-in -->
        <div class="form-box login">
            <h2>Login</h2>
            <form action="backend/action.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>
                <input type="submit" name="submit_login" value="Login" class="btn">
                <div class="login-register">
                    <p>Don't have an account?<a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <!-- sign-up -->
        <div class="form-box register">
            <h2>Signup</h2>
            <form action="backend/action.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="name" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="cpassword" required>
                    <label>Repeat Password</label>
                </div>
                <select name="user_type" hidden>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <input type="submit" name="submit_signup" value="Signup" class="btn">
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Home -->
    <section class="home container" id="home">
        <div class="home-content">
            <h1>Juan<span>Rental</span></h1>
            <p>Discover the Freedom of the Open Road, Journey with JuanRental – Your Reliable Companion for Memorable Adventures</p>
            <form action="#" method="post" class="emailForm">
            <div>
                <input placeholder="Search your location" type="text" name="address">
                <button type="submit">Search</button>
            </div>
            </form>
        </div>
    </section>

    <!-- flexing card -->
    <section class="cards container">
        <div class="cards-content">
            <div class="panel active"
                style="background-image: url(http://www.isrtv.com/wp-content/uploads/2016/03/Project-CARS-ATS-VR-GT3.jpg);">
                <h3>Unleash Your Adventure</h3>
            </div>
            <div class="panel"
                style="background-image: url(https://i.pinimg.com/originals/e8/0c/1c/e80c1c60966c14fc70023fc97f4e323f.jpg);">
                <h3>Drive Your Dreams</h3>
            </div>
            <div class="panel"
                style="background-image: url(https://capitalcustomslasvegas.com/imgs/lighting-page/IMG_6689b.jpg);">
                <h3>Experience the Thrill of the Open Road</h3>
            </div>
            <div class="panel"
                style="background-image: url(http://www.isrtv.com/wp-content/uploads/2016/03/Project-CARS-ATS-VR-GT3-3.jpg);">
                <h3>Discover Your Perfect Ride</h3>
            </div>
        </div>
    </section>


    <?php
        $config = new Config();
        $db = $config->getConnection();

        $brand = new Brand($db);
        $brands = $brand->getBrands();
        $totalBrands = count($brands);

        $car = new Car($db);
        $cars = $car->getCars();
        $totalCars = count($cars);

        $idCounter = 1;


    ?>

    <!-- Cars card -->
    <section class="cars container" id="cars">
        <h2 class="heading">Cars</h2>
        <div class="card-container">
                    <?php foreach ($cars as $car): ?>
                        <div class="card">
            <div class="image"><img src="admin/<?= $car['image_path'] ?>" alt="Car Image"></div>
            <span class="title"><?= $car['car_name'] ?></span>
            <span class="desc"><?= $car['description'] ?></span>
            <span class="price">$<?= $car['price_hour'] ?>/hour</span>
            <p class="rate">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </p>
            <a href="#" onclick="addToCart(<?= $car['car_id'] ?>)" class="add-to-cart-button">Add to Cart</a>
        </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        function addToCart(carId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'backend/action.php?car_id=' + carId, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (<?php echo isset($_SESSION['user_name']) ? 'true' : 'false'; ?>) {
                        alert('Item successfully added to the cart.');
                    } else {
                        alert('Please log in to add items to the cart.');
                    }
                } else {
                    alert('Error adding item to the cart. Please try again.');
                }
            };

            xhr.send();

            // Prevent the default link behavior
            event.preventDefault();
        }
    </script>




<?php
    include("footer.php");
?>