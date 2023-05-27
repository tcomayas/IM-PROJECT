<?php
  include 'header.php'
?>

	<div class="clearfix"></div>
</div>

	<div class="clearfix"></div>
	<br/>
	
	<div class="col-div-3">
		<div class="box">
			<a href="messages.php">
				<?php
				$totalMessages = $message->getTotalMessages();
				?>
				<p><?php echo $totalMessages; ?><br/><span>Total Messages</span></p>
				<i class="fa fa-users box-icon"></i>
			</a>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<a href="book.php">
				<p><?php echo $totalBookings; ?><br/><span>Total Booking</span></p>
				<i class="fa fa-list box-icon"></i>
			</a>
		</div>
	</div>

	<div class="col-div-3">
		<div class="box">
			<a href="brand.php">
				<?php
				$totalBrands = $brand->getTotalBrands();
				?>
				<p><?php echo $totalBrands; ?><br/><span>Total Brands</span></p>
				<i class="fa fa-shopping-bag box-icon"></i>
			</a>
		</div>
	</div>
	<div class="col-div-3">
		<div class="box">
			<?php
			$totalCars = $car->getTotalCars();
			?>
			<a href="cars.php">
				<p><?php echo $totalCars; ?><br/><span>Total Cars</span></p>
				<i class="fa fa-tasks box-icon"></i>
			</a>
		</div>
	</div>


	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-8">
		<div class="box-8">
		<div class="content-box">
			<p>Top Selling Projects</p>
			<br/>
			<table>
  <tr>
    <th>Customer Name</th>
    <th>Car Name</th>
    <th>Discription</th>
  </tr>
  <tr>
	<td colspan="3" style="text-align: center;">No Data Found in the Database!</td>
  </tr>
</table>
		</div>
	</div>
	</div>

	<div class="col-div-4">
		<div class="box-4">
		<div class="content-box">
			<p>Total Sale</p>

			<div class="circle-wrap">
    <div class="circle">
      <div class="mask full">
        <div class="fill"></div>
      </div>
      <div class="mask half">
        <div class="fill"></div>
      </div>
      <div class="inside-circle"> 0% </div>
    </div>
  </div>
		</div>
	</div>
	</div>
		
	<div class="clearfix"></div>
</div>

<?php
  include 'footer.php'
?>