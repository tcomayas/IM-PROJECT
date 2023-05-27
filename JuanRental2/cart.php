<?php
    include("header.php");

    if (isset($_GET['remove_cart'])) {
        $cartId = $_GET['remove_cart'];
    
        $cart->removeCartItem($cartId);
    
        header('Location: cart.php');
        exit;
    }

    if (isset($_SESSION['id'])) {
        $cartId = $_SESSION['id'];
        $cart = new Cart($this->connection, null);
        $cart->removeCartItem($cartId);
    } 

    
?>

<!-- Cars card -->
<section class="cars container" id="cars">
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Car</th>
                <th>Payment Type</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="assets/<?= $item['image_path'] ?>" alt="">
                            <div>
                                <p><?= $item['car_name'] ?></p>
                                <small><?= $item['description'] ?></small>
                                <br><br>
                                <a href="?remove_cart=<?= $item['id'] ?>" class="remove">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="select">
                            <select name="payment_type" onchange="updateSubtotal(this, <?= $item['price_hour'] ?>, <?= $item['price_daily'] ?>, <?= $item['price_monthly'] ?>)">
                                <option selected disabled>Payment Type</option>
                                <option value="hourly">Hourly</option>
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <span class="subtotal">$<?= $item['price_hour'] ?></span>
                    </td>
                    <td>
                    <form method="POST" action="backend/action.php">
                        <input type="hidden" name="car_name" value="<?= $item['car_name'] ?>">
                        <input type="hidden" name="car_brand" value="<?= $item['car_brand'] ?>">
                        <input type="hidden" name="description" value="<?= $item['description'] ?>">
                        <input type="hidden" name="subtotal" id="subtotalInput" value="<?= $item['price_hour'] ?>">
                        <input type="hidden" name="image_path" value="<?= $item['image_path'] ?>">
                        <button type="submit" class="book_button">Book now</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>

<script>
    function updateSubtotal(selectElement, priceHour, priceDaily, priceMonthly) {
        var subtotalElement = selectElement.parentNode.parentNode.nextElementSibling.querySelector('.subtotal');
        var subtotalInput = document.getElementById('subtotalInput');
        var paymentType = selectElement.value;

        if (paymentType === 'hourly') {
            subtotalElement.textContent = '$' + priceHour.toFixed(2);
            subtotalInput.value = priceHour.toFixed(2);
        } else if (paymentType === 'daily') {
            subtotalElement.textContent = '$' + priceDaily.toFixed(2);
            subtotalInput.value = priceDaily.toFixed(2);
        } else if (paymentType === 'monthly') {
            subtotalElement.textContent = '$' + priceMonthly.toFixed(2);
            subtotalInput.value = priceMonthly.toFixed(2);
        }
    }
</script>

<?php
    include("footer.php");
?>