<?php
if ($_POST['submit']) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comments'])) {
        $error = true;
    } else {
        $to = "cherylrallredshirt@gmail.com";

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $comments = trim($_POST['comments']);

        $subject = "Contact Form";

        $messages = "Name: $name \r\n Email: $email \r\n Comments: $comments";
        $headers = "From: " . $name;
        $mailsent = mail($to, $subject, $messages, $headers);

        if ($mailsent) {
            $sent = true;
        }
    }
}
?>
<?php if ($error == true) { ?>
    <p class="error">There was a missing field on the form. Please make sure you enter your details and comments in all the boxes provided.</p>
<?php }if ($sent == true) { ?>
    <p class="sent"> Thank you, your email has been sent successfully.</p>
<?php } ?>
<main>
    <form id="form" name="form" method="post" action="http://padawancomposer.com/index.php?action=contact">
        <fieldset>
            <legend>Contact Us</legend>
            Name:<input type="text" name="name"/><br/><br/>

            Email:<input type="text" name="email"/><br/><br/>

            Comments:<textarea name="comments" cols="20" rows="10"></textarea><br/><br/>

            <input type="submit" name="submit" class="submit" value="submit"/>

        </fieldset>
    </form>

    <div style="clear:both;"></div>
</main>