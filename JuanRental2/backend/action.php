<?php
session_start();

require_once 'config.php';

class User {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function registerUser($name, $email, $password, $cpassword, $user_type) {
        $conn = $this->connection;

        $select = "SELECT * FROM users WHERE email = :email AND password = :pass";

        $stmt = $conn->prepare($select);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', md5($password));
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header('location:../index.php?userAlreadyExist');
        } else {
            if ($password != $cpassword) {
                header('location:../index.php?passwordDoesNotMatch');
            } else {
                $insert = "INSERT INTO users(name, email, password, user_type) VALUES (:name, :email, :pass, :user_type)";
                $stmt = $conn->prepare($insert);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pass', md5($password));
                $stmt->bindParam(':user_type', $user_type);
                $stmt->execute();

                header('location:../index.php?successfullyCreated');
            }
        }
    }

    public function loginUser($email, $password) {
        $conn = $this->connection;

        $select = "SELECT * FROM users WHERE email = :email AND password = :pass";

        $stmt = $conn->prepare($select);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', md5($password));
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('location:../admin/index.php?successfullyLoggedInAsAdmin');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                header('location:../index.php?successfullyLoggedIn');
            } else {
                header("location:../index.php?Error!");
            }
        } else {
            header("location:../index.php?IncorrectEmailOrPassword");
        }
    }
}

class Brand {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function addBrand($brand_name) {
        $conn = $this->connection;

        $select = "SELECT * FROM brands WHERE brand_name = :brand_name";

        $stmt = $conn->prepare($select);
        $stmt->bindParam(':brand_name', $brand_name);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header('location:../admin/brand.php?brandAlreadyExist');
        } else {
            $insert = "INSERT INTO brands(brand_name) VALUES (:brand_name)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(':brand_name', $brand_name);
            $stmt->execute();

            header('location:../admin/brand.php?brandSuccessfullyAdded');
        }
    }

    public function getTotalBrands() {
        $conn = $this->connection;

        $query = "SELECT COUNT(*) AS total FROM brands";
        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function deleteBrand($brand_id) {
        $conn = $this->connection;

        $query = "SELECT COUNT(*) AS car_count FROM cars WHERE car_brand = :brand_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['car_count'] > 0) {
            header('location: ../admin/brand.php?error=brand is currently used');
            exit();
        }

        $delete = "DELETE FROM brands WHERE brand_id = :brand_id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->execute();

        header('location:../admin/brand.php?brandDeleted');
    }

    public function getBrands() {
        $config = new Config();
        $conn = $config->getConnection();

        $query = "SELECT * FROM brands";
        $stmt = $conn->query($query);
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $brands;
    }
}

class Car {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function addCar($car_name, $car_brand, $description, $price_hour, $price_daily, $price_monthly) {
        $conn = $this->connection;

        $errors = array();

        if (empty($car_name)) {
            $errors[] = "Car name is required.";
        }

        if (empty($price_hour)) {
            $errors[] = "Price per hour is required.";
        } elseif (!is_numeric($price_hour) || $price_hour <= 0) {
            $errors[] = "Price per hour must be a positive number.";
        }

        if (empty($price_daily)) {
            $errors[] = "Price per day is required.";
        } elseif (!is_numeric($price_daily) || $price_daily <= 0) {
            $errors[] = "Price per day must be a positive number.";
        }

        if (empty($price_monthly)) {
            $errors[] = "Price per month is required.";
        } elseif (!is_numeric($price_monthly) || $price_monthly <= 0) {
            $errors[] = "Price per month must be a positive number.";
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                header('location:../admin/cars.php?' . $error);
            }
        } else {
            $insert = "INSERT INTO cars (car_name, car_brand, description, price_hour, price_daily, price_monthly) VALUES (:car_name, :car_brand, :description, :price_hour, :price_daily, :price_monthly)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(':car_name', $car_name);
            $stmt->bindParam(':car_brand', $car_brand);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price_hour', $price_hour);
            $stmt->bindParam(':price_daily', $price_daily);
            $stmt->bindParam(':price_monthly', $price_monthly);
            $stmt->execute();

            $car_id = $conn->lastInsertId();

            if ($_FILES['img']['error'] === 0) {
                $image_name = $_FILES['img']['name'];
                $image_tmp = $_FILES['img']['tmp_name'];
                $image_path = "../assets/uploads/" . $image_name;

                move_uploaded_file($image_tmp, $image_path);

                $update_image = "UPDATE cars SET image_path = :image_path WHERE car_id = :car_id";
                $stmt = $conn->prepare($update_image);
                $stmt->bindParam(':image_path', $image_path);
                $stmt->bindParam(':car_id', $car_id);
                $stmt->execute();
            }

            header('location:../admin/cars.php?carSuccessfullyAdded');
        }
    }

    public function getTotalCars() {
        $conn = $this->connection;

        $query = "SELECT COUNT(*) AS total FROM cars";
        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function deleteCar($car_id) {
        $conn = $this->connection;

        $select_image = "SELECT image_path FROM cars WHERE car_id = :car_id";
        $stmt = $conn->prepare($select_image);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image_path = $result['image_path'];

        $delete = "DELETE FROM cars WHERE car_id = :car_id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();

        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path);
        }

        header('location:../admin/cars.php?carSuccessfullyDeleted');
    }

    public function getCars() {
        $conn = $this->connection;
    
        $query = "SELECT * FROM cars";
        $stmt = $conn->query($query);
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $cars;
    }

    public function getCarDetails($car_id) {
        $conn = $this->connection;

        $query = "SELECT * FROM cars WHERE car_id = :car_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        return $car;
    }
}

class Cart {
    private $connection;
    private $car;

    public function __construct($db, $car) {
        $this->connection = $db;
        $this->car = $car;
    }

    public function addToCart($car_id, $user_name) {
        $conn = $this->connection;

        // Get car details from the Car class
        $carDetails = $this->car->getCarDetails($car_id);
        $car_name = $carDetails['car_name'];
        $car_brand = $carDetails['car_brand'];
        $description = $carDetails['description'];
        $price_hour = $carDetails['price_hour'];
        $price_daily = $carDetails['price_daily'];
        $price_monthly = $carDetails['price_monthly'];
        $image_path = $carDetails['image_path']; // Retrieve the image path

        $insert = "INSERT INTO cart (user_name, car_id, car_name, car_brand, description, price_hour, price_daily, price_monthly, image_path) VALUES (:user_name, :car_id, :car_name, :car_brand, :description, :price_hour, :price_daily, :price_monthly, :image_path)";
        $stmt = $conn->prepare($insert);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->bindParam(':car_name', $car_name);
        $stmt->bindParam(':car_brand', $car_brand);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price_hour', $price_hour);
        $stmt->bindParam(':price_daily', $price_daily);
        $stmt->bindParam(':price_monthly', $price_monthly);
        $stmt->bindParam(':image_path', $image_path); // Bind the image path
        $stmt->execute();
    }

    public function getCartItems($user_name) {
        $conn = $this->connection;

        $query = "SELECT * FROM cart WHERE user_name = :user_name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeCartItem($id) {
        $conn = $this->connection;
    
        $delete = "DELETE FROM cart WHERE id = :id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }    
}

$config = new Config();
$db = $config->getConnection();

$car = new Car($db);
$cart = new Cart($db, $car);

// Check if the car_id is provided
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    $user_name = $_SESSION['user_name'];

    // Add the item to the cart
    $cart->addToCart($car_id, $user_name);
    echo "<script>alert('Item successfully added to the cart.');</script>";
}

class SaveBooking {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function save($car_name, $car_brand, $description, $subtotal, $image_path) {
        $conn = $this->connection;
    
        $insert = "INSERT INTO bookings (car_name, car_brand, description, subtotal, image_path) VALUES (:car_name, :car_brand, :description, :subtotal, :image_path)";
        $stmt = $conn->prepare($insert);
        $stmt->bindParam(':car_name', $car_name);
        $stmt->bindParam(':car_brand', $car_brand);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->execute();
    }   

    public function getAllBookings() {
        $conn = $this->connection;

        $query = "SELECT * FROM bookings";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBrandName($brands, $brandId) {
        foreach ($brands as $brand) {
            if ($brand['brand_id'] == $brandId) {
                return $brand['brand_name'];
            }
        }
        return '';
    }

    public function getTotalBookings() {
        $conn = $this->connection;
    
        $query = "SELECT COUNT(*) AS total FROM bookings";
        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    
    public function deleteBooking($id) {
        $conn = $this->connection;

        $delete = "DELETE FROM bookings WHERE id = :id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('location:../admin/book.php?bookingSuccessfullyDeleted');
    }
}

$config = new Config();
$db = $config->getConnection();

$saveBooking = new SaveBooking($db);
$bookingManager = new SaveBooking($db);

$totalBookings = $bookingManager->getTotalBookings();
$bookings = $bookingManager->getAllBookings();
$brands = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carName = $_POST['car_name'];
    $carBrand = $_POST['car_brand'];
    $description = $_POST['description'];
    $subtotal = $_POST['subtotal'];
    $imagePath = $_POST['image_path'];

    $saveBooking->save($carName, $carBrand, $description, $subtotal, $imagePath);
    // Redirect the user to a success page or display a success message
    header('Location:../cart.php');
    exit;
}

class Message {
    private $connection;

    public function __construct($db) {
        $this->connection = $db->getConnection();
    }

    public function addMessage($name, $email, $message) {
        $conn = $this->connection;

        $insert = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $conn->prepare($insert);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            header('Location: ../contact.php?messageSuccessfullySent');
            exit();
        } else {
            header('Location: ../index.php?errorSending');
            exit();
        }
    }

    public function getTotalMessages() {
        $conn = $this->connection;
    
        $query = "SELECT COUNT(*) AS total FROM messages";
        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }    

    public function getAllMessages() {
        $conn = $this->connection;

        $query = "SELECT * FROM messages";
        $stmt = $conn->query($query);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }

    public function deleteMessage($message_id) {
        $conn = $this->connection;

        // Delete the message from the messages table
        $delete = "DELETE FROM messages WHERE id = :message_id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(':message_id', $message_id);
        $stmt->execute();

        header('Location: ../admin/messages.php?messageSuccessfullyDeleted');
        exit();
    }
}

$config = new Config();
$message = new Message($config);

if (isset($_POST['submit_message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    require_once 'config.php';
    $config = new Config();
    $messageObj = new Message($config);
    $messageObj->addMessage($name, $email, $message);
}

// Usage example:
$db = new Config();
$connection = $db->getConnection();

$user = new User($connection);
$brand = new Brand($connection);
$car = new Car($connection);

if (isset($_POST['submit_signup'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $user->registerUser($name, $email, $pass, $cpass, $user_type);
}

if (isset($_POST['submit_login'])) {
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['password'];

    $user->loginUser($email, $pass);
}

if (isset($_POST['submit_brand'])) {
    $brand_name = htmlspecialchars($_POST['brand_name']);

    $brand->addBrand($brand_name);
}

if (isset($_GET['delete_brand'])) {
    $brand_id = $_GET['delete_brand'];
    $brand->deleteBrand($brand_id);
}

if (isset($_POST['submit_car'])) {
    $car_name = htmlspecialchars($_POST['car_name']);
    $car_brand = htmlspecialchars($_POST['car_brand']);
    $description = htmlspecialchars($_POST['description']);
    $price_hour = htmlspecialchars($_POST['price_hour']);
    $price_daily = htmlspecialchars($_POST['price_daily']);
    $price_monthly = htmlspecialchars($_POST['price_monthly']);

    $car->addCar($car_name, $car_brand, $description, $price_hour, $price_daily, $price_monthly);
}

// Delete Car
if (isset($_GET['delete_car'])) {
    $car_id = $_GET['delete_car'];
    $car->deleteCar($car_id);
}

// Delete Booking
if (isset($_GET['delete_booking'])) {
    $booking_id = $_GET['delete_booking'];
    $saveBooking->deleteBooking($booking_id);
}
?>