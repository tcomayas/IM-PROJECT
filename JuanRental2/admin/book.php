<?php
  include 'header.php'
?>

	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>

	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-12">
		<div class="box-8">
      <div class="content-box">
        <p>Booking List</p>
        <br/>

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

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>User Name</th>
                <th>Car Name</th>
                <th>Car Brand</th>
                <th>Description</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            <?php if (count($bookings) > 0) : ?>
                <?php $idCounter = 1; ?>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?= $idCounter ?></td>
                        <td class="image"><img src="<?= $booking['image_path'] ?>" alt="Car Image" width="100"></td>
                        <td><?= $booking['user_name'] ?></td>
                        <td><?= $booking['car_name'] ?></td>
                        <td><?= $bookingManager->getBrandName($brands, $booking['car_brand']) ?></td>
                        <td><?= $booking['description'] ?></td>
                        <td>$<?= $booking['subtotal'] ?></td>
                        <td>
                            <a href="?delete_booking=<?= $booking['id'] ?>" class="delete_button" onclick="return confirm('Are you sure you want to delete this booking?')">
                                <i class="bi bi-trash"></i>Delete
                            </a>
                        </td>
                    </tr>
                    <?php $idCounter++; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" style="text-align: center;">No Bookings Found!</td>
                </tr>
            <?php endif; ?>
        </table>

        <?php
        function getBrandName($brands, $brandId) {
            foreach ($brands as $brand) {
                if ($brand['brand_id'] == $brandId) {
                    return $brand['brand_name'];
                }
            }
            return '';
        }
        ?>


      </div>
	  </div>
	</div>

<?php
  include 'footer.php'
?>


