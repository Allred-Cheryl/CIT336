<?php ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/login.js" ></script>

<?php
if ($message) {
    echo $message;
}
?>
<main>
    <div id="loginregister">
        <form action="/?action=registersubmit" method="POST" id="registerform">
            <input type="hidden" name="actiontype" id="actiontype" value="" />
            <fieldset>
                <legend>Register a new account</legend>
                First Name: <input type="text" name="firstname" id="firstname" /><br /><br />
                Last Name: <input type="text" name="lastname" id="lastname" /><br /><br />
                Email Address: <input type="email" name="emailreg" id="emailreg" /><br /><br />
                Password: <input type="password" name="passwordreg1" id="passwordreg1" /><br /><br />
                Verify Password: <input type="password" name="passwordreg2" id="passwordreg2" /><br /><br />
                <button name="register" id="buttonRegister">Register</button>
            </fieldset>
        </form>

        <br /><br />

        <form action="/?action=loginsubmit" method="POST" id="loginform">
            <fieldset>
                <legend>Login with existing account</legend>
                Email Address: <input type="text" name="emaillogin" id="emaillogin" /><br /><br />
                Password: <input type="password" name="passwordlogin" id="passwordlogin" /><br /><br />
                <button name="login" id="buttonLogin">Login</button>
            </fieldset>
        </form>
    </div>
</main>