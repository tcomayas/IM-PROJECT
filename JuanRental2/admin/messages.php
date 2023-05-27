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
        <p>Cars List</p>
        <br/>

        <?php
            $config = new Config();
            $message = new Message($config);
            $messages = $message->getAllMessages();

            $config = new Config();
            $message = new Message($config);
            $messages = $message->getAllMessages();

            // Check if delete message action is triggered
            if (isset($_GET['delete_message'])) {
                $message_id = $_GET['delete_message'];
                $message->deleteMessage($message_id);
            }

            //id counter
            $config = new Config();
            $message = new Message($config);
            $messages = $message->getAllMessages();
            $totalMessages = count($messages);

            $idCounter = 1;
        ?>
        <?php

?>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>

            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                    <td><?= $idCounter++ ?></td>
                    <td><?php echo $msg['name']; ?></td>
                    <td><?php echo $msg['email']; ?></td>
                    <td><?php echo $msg['message']; ?></td>
                    <td>
                        <a href="?delete_message=<?php echo $msg['id']; ?>" class="delete_button"><i class="bi bi-trash"></i>Delete</a>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No Messages Found!</td>
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