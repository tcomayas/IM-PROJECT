<?php
  include 'header.php'
?>

<div class="popup">
    <div class="close-btn">&times;</div>
    <div class="form">
        <h2>Add Car Brand</h2>
        <form action="../backend/action.php" method="post">
          <div class="form-element">
              <label for="">Brand Name</label>
              <input type="text" name="brand_name" id="car" placeholder="Enter brand Name">
          </div>
          <div class="form-element">
              <button name="submit_brand">Confirm</button>
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
        <p>Car Brand List</p>
        <br/>
        <?php
        $brand = new Brand($db); // Assuming $db is your database connection
        $brands = $brand->getBrands();
        $totalBrands = count($brands);
        
        $idCounter = 1;
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Car Brand</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
            <?php if ($totalBrands > 0): ?>
                <?php foreach ($brands as $brand): ?>
                    <tr>
                        <td><?= $idCounter ?></td>
                        <td><?php echo $brand['brand_name']; ?></td>
                        <td style="color: #86dc3d;">Available</td>
                        <td>
                            <a href="?delete_brand=<?php echo $brand['brand_id']; ?>" class="delete_button"><i class="bi bi-trash"></i>Delete</a>
                        </td>
                    </tr>
                    <?php $idCounter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No Data Found in the Database!</td>
                </tr>
            <?php endif; ?>
        </table>


      </div>
	  </div>
	</div>

<?php
  include 'footer.php'
?>