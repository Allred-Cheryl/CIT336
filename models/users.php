<?php
/**
 * A collection of functions related to Users and Passwords.
 **/

/// Define the User object.
class User
{
	var $id;
	var $email;
	var $passwordHash;
	var $firstName;
	var $lastName;
	var $roleId;
}


/// Calculate the password hash.
/// We don't want to store the plain text password in the database.
function CalculatePasswordHash($password) {
	return sha1($password . 'addSomeExtraSalt123');
}

/// Check the session to see if the user is logged in.
/// If logged in, this will return TRUE.
function CheckSession()
{
	return(GetLoggedInUserId() != null);
}


/// Deletes a user from the database.
/// $id - the Id of the user to delete.
function DeleteUser($id)
{
	$query = 'DELETE FROM users WHERE ID=:id';
	DbExecute($query, array(':id' => $id));
}


/// Retrieves all users from the database.
/// Returns an array of User objects.
function GetAllUsers()
{
	$users = array();
	$query = 'SELECT * FROM users';
	$result = DbSelect($query);
	
	foreach ($result as $item)
	{
		$user = new User();
		$user->id = $item['Id'];
		$user->email = $item['email'];
		$user->firstName = $item['firstname'];
		$user->lastName = $item['lastname'];
		$user->roleId = $item['roleId'];
		
		$users[] = $user;
	}
	
	return $users;
}


/// Get the Id of the logged in user.
/// Returns the Id if the user is logged in, otherwise returns null.
function GetLoggedInUserId()
{
	return (array_key_exists('UserId', $_SESSION)) ? $_SESSION['UserId'] : null;
}


/// Retrieves information about a user from the database.
/// Returns a User object if the user is found or FALSE if the user is not found.
/// $userId - the Id of the user to look up.
function GetUser($userId) {
	$query = 'SELECT * FROM users WHERE ID=:id';
	$result = DbSelect($query, array(':id' => $userId));
	
	if (array_key_exists(0, $result))
	{
		$user = new User();
		$user->id = $result[0]['Id'];
		$user->email = $result[0]['email'];
		$user->firstName = $result[0]['firstname'];
		$user->lastName = $result[0]['lastname'];
		$user->roleId = $result[0]['roleId'];
		
		return $user;
	}
	
	return false;
}


/// A helper function to determine if the logged in user is an admin.
/// Returns TRUE if they are an admin, FALSE if not.
function LoggedInUserIsAdmin()
{
	return array_key_exists('UserRole', $_SESSION) && $_SESSION['UserRole'] == ROLE_ID_ADMIN;
}


/// Validates the credentials for a user.
/// If the credentials are correct, then the Sessions variables get set.
/// Returns TRUE on valid credentials, FALSE for invalid credentials.
/// $email - the user's email address.
/// $password - the user's password
function LoginUser($email, $password) {
	$loggedIn = false;
	
	if ($email && $password) {
		$hash = CalculatePasswordHash($password);
		$query = "SELECT * FROM users WHERE email=:email AND passwordhash=:hash";
		$result = DbSelect($query, array(':email' => $email, ':hash' => $hash));
		
		if (is_array($result) && array_key_exists(0, $result)) {
			$user = new User();
			$user->id = $result[0]['Id'];
			$user->roleId = $result[0]['roleId'];
			SetUserSessionVariables($user);
			$loggedIn = true;
		}
	}
	
	return $loggedIn;
}


/// Adds a new user to the database.
/// $first - the user's first name
/// $last - the user's last name
/// $email - the user's email address
/// $pass1 - the user's password
/// $pass2 - the user's password again, for verification.
/// Returns TRUE if the user was saved, FALSE if not.
function RegisterUser($first, $last, $email, $pass1, $pass2, &$message) {
	$registered = false;
	
	if (ValidateNames($first, $message) &&
		ValidateNames($last, $message) &&
		ValidateEmail($email, $message) &&
		ValidatePasswordLength($pass1, $message)) {
		if ($pass1 == $pass2) {
			$query = "SELECT * FROM users WHERE email=':email'";
			$result = DbSelect($query, array(':email' => $email));
			
			if (is_array($result) && count($result) == 0) {
				$hash = CalculatePasswordHash($pass1);
				$query = "INSERT INTO users(firstname, lastname, email, passwordhash, roleId)";
				$query .= " VALUES(:first, :last, :email, :pass, :role)";
				
				$id = DbInsert($query, array(':first' => $first, ':last' => $last, ':email' => $email, ':pass' => $hash, ':role' => ROLE_ID_USER));
				$u = new User();
				$u->id = $id;
				$u->roleId = null;
				SetUserSessionVariables($u);
				$registered = true;
			}
		}
		else
		{
			$message .= "Password and Verify Password must match.";
		}
	}
	
	return $registered;
}

// check that names are at least 5 characters long
function ValidateNames($name, &$message) {
	if (strlen($name) >= 5) {
		return true;	
	} else {
		$message .= "Name must be at least 5 characters long";
		return false;
	} 
}

function ValidateEmail($email, &$message) {
	// hi@something.co.uk
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	
	$message .= "Invalid Email address";
	return false;
}

function ValidatePasswordLength($name, &$message) {
	// TODO: make sure password contains UPPERCASE, lowercase, numbers, and special chars.
	
	if (strlen($name) >= 5) {
		return true;	
	} else {
		$message .= "Password must be at least 5 characters long";
		return false;
	} 
}

/// Saves the session variables for a User.
/// If the variables are set, that indicates that the user is logged in.
/// $user - a User object.
function SetUserSessionVariables(User $user) {
	$_SESSION['UserId'] = $user->id;
	$_SESSION['UserRole'] = $user->roleId;
}


/// Update the user information in the database.
/// $id - the Id of the user to update.
/// $email - the updated email address.
/// $firstname - the updated first name.
/// $lastname - the updated last name.
function UpdateUserInfo($id, $email, $firstname, $lastname)
{
	$query = 'UPDATE users SET email=:email, firstName=:firstname, lastname=:lastname WHERE ID=:id';
	DbExecute($query, array(':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':id' => $id));
}

/// Update the User password.
/// $password - the updated password.
/// $id - the Id of the user to update - if null, update the currently logged-in user.
function UpdateUserPassword($password, $id = null)
{
	$id = ($id == null) ? GetLoggedInUserId() : $id;
	$hash = CalculatePasswordHash($password);
	
	$query = 'UPDATE users SET passwordhash=:hash WHERE ID=:id';
	DbExecute($query, array(':hash' => $hash, ':id' => $id));
}


/// Update the role of a user.
/// $id - the Id of the user to update.
/// $roleName - the Role to update to.
function UpdateUserRole($id, $roleName)
{
	if ($id && $roleName)
	{
		$roleId = (strtolower($roleName) == 'admin') ? ROLE_ID_ADMIN : ROLE_ID_USER;
		
		$query = 'UPDATE users SET roleId=:roleId where Id=:id';
		DbExecute($query, array(':roleId' => $roleId, ':id' => $id));	
	}
}

/// Validates that a password matches what is in the database.
/// Only checks the password of the currently logged in user.
/// $password - the password to validate.
/// Returns TRUE on match, FALSE on no match.
function ValidateOldPassword($password)
{
	$return = false;
	$id = GetLoggedInUserId();
	$hash = CalculatePasswordHash($password);
	$query = 'SELECT * FROM users WHERE ID=:id AND passwordhash=:hash';
	
	$result = DbSelect($query, array(':id' => $id, ':hash' => $hash));
	
	if ($result && count($result) > 0)
	{
		$return = true;
	}
	
	return $return;
}


/// A helper method to validate that the password meets complexity requirements.
/// $password - the password.
/// $message - after a call, will contain a message if there was an error.
/// Returns TRUE on success, FALSE on failure.
function ValidatePassword($password, &$message)
{
	$valid = false;
	
	if (strlen($password) >= 3)
	{
		$valid = true;
	}
	else
	{
		$message = "The password must be at least 3 characters long.";
	}
	
	return $valid;
}
