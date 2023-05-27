<?php
  include 'header.php'
?>

<div class="popup">
    <div class="close-btn">&times;</div>
    <div class="form">
        <h2 id="popup-heading">Create New Car</h2>
        <form action="../backend/action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="car_id" id="car_id" value="">
            <div class="form-element">
                <label for="car">Car Name</label>
                <input type="text" name="car_name" id="car" placeholder="Enter Car Name" required>
            </div>
            <div class="form-element">
                <label for="brand">Car Brand</label>
                <?php
                $config = new Config();
                $connection = $config->getConnection();
                $brand = new Brand($connection);
                $brands = $brand->getBrands();
                ?>
                <select name="car_brand" id="brand" required>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-element">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" rows="4" cols="40" placeholder="Enter Description" required>
            </div>
            <div class="form-element">
                <label for="price_hour">Price Per Hour</label>
                <input type="text" name="price_hour" id="price_hour" placeholder="Enter Price per Hour" required>
            </div>
            <div class="form-element">
                <label for="price_daily">Price Daily</label>
                <input type="text" name="price_daily" id="price_daily" placeholder="Enter Price per Day" required>
            </div>
            <div class="form-element">
                <label for="price_monthly">Price Monthly</label>
                <input type="text" name="price_monthly" id="price_monthly" placeholder="Enter Price per Month" required>
            </div>
            <div class="form-element">
                <label for="img">Photo</label>
                <input type="file" name="img" id="img" required>
            </div>
            <div class="form-element">
                <button type="submit" name="submit_car">Confirm</button>
            </div>
        </form>
    </div>
</div>

	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>

    <button class="button" type="button" id="addNewCar"><i class="bi bi-plus-circle-dotted"></i>Create</button>

	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-12">
		<div class="box-8">
      <div class="content-box">
        <p>Cars List</p>
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
                <th>Car Name</th>
                <th>Car Brand</th>
                <th>Description</th>
                <th>Price per Hour</th>
                <th>Price per Day</th>
                <th>Price per Month</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>

            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?= $idCounter ?></td>
                    <td class="image"><img src="<?= $car['image_path'] ?>" alt="Car Image" width="100"></td>
                    <td><?= $car['car_name'] ?></td>
                    <td><?= getBrandName($brands, $car['car_brand']) ?></td>
                    <td><?= $car['description'] ?></td>
                    <td>$<?= $car['price_hour'] ?></td>
                    <td>$<?= $car['price_daily'] ?></td>
                    <td>$<?= $car['price_monthly'] ?></td>
                    <td style="color: #86dc3d;">Available</td>
                    <td>
                        <a href="?car_id=<?= $car['car_id'] ?>" class="edit_button"><i class="bi bi-pencil-square"></i>Edit</a>
                        <a href="?delete_car=<?= $car['car_id'] ?>" class="delete_button"><i class="bi bi-trash"></i>Delete</a>
                    </td>
                </tr>
                <?php $idCounter++; ?>
            <?php endforeach; ?>

            <?php if ($totalCars == 0): ?>
                <tr>
                    <td colspan="10" style="text-align: center;">No Data Found in the Database!</td>
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