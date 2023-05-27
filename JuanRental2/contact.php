<?php
    include("header.php");
?>
    
    <section class="contact container" id="contact">
        <!-- Heading -->
        <h2 class="heading">Contact</h2>
        <!-- Contact Content -->
        <form action="backend/action.php" method="POST" class="contact-form" id="contact-form">
            <input type="text" name="name" id="name" placeholder="Your Name" class="name" required>
            <input type="email" name="email" id="email" placeholder="Email address..." class="email" required>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Write a message here..." class="message" required></textarea>
            <input type="submit" name="submit_message" value="send" class="send-btn">
        </form>
    </section>

<?php
    include("footer.php");
?>