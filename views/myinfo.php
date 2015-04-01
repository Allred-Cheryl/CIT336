<?php
// $user set by the controller.
$message = isset($message) ? $message : null;
?>
<main>
    <div id="message">
        <p>
            <?php echo $message; ?>
        </p>
    </div>

    <div id="infoupdate">
        <form id="infoupdateform" method="POST" action="/?action=updateinfo">
            <fieldset>
                <legend>Update my information</legend>
                First Name: <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstName; ?>" required /><br /><br />
                Last Name: <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastName; ?>" required /><br /><br />
                Email Address: <input type="email" name="email" id="email" value="<?php echo $user->email; ?>" required /><br /><br />
                <input type="submit" name="Submit" value="Submit" />
            </fieldset>
        </form>
        <form id="passwordupdateform" method="POST" action="/?action=updatepassword">
            <fieldset>
                <legend>Update your password</legend>
                Current Password: <input type="password" name="currentpassword" id="currentpassword" /><br /><br />
                New Password: <input type="password" name="newpassword" id="newpassword" /><br /><br />
                Repeat New Password: <input type="password" name="repeatpassword" id="repeatpassword" /><br /><br />
                <input type="submit" name="Submit" value="Submit" />
            </fieldset>
        </form>
    </div>
</main>