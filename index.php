<?php

ini_set('output_buffering', 'On');
error_reporting(E_ALL);

session_start();

require 'models/database.php';
require 'models/db.php';
require 'models/navigation.php';
require 'models/users.php';
require 'models/comments.php';
require 'models/roles.php';

include 'views/header.php';

$action = strtolower(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));

switch ($action) {

    case 'home' :
        include 'views/home.php';
        break;
    case 'about' :
        include 'views/about.php';
        break;

    case 'video' :
        include 'views/video.php';
        break;

    case 'audio' :
        include 'views/audio.php';
        break;

    case 'links' :
        include 'views/links.php';
        break;
    case 'comment' :
        $comments = GetOrderedComments();
        include 'views/comment.php';
        break;

    case 'changerole':
        $userid = (int) filter_input(INPUT_GET, 'userid', FILTER_SANITIZE_NUMBER_INT);
        $role = filter_input(INPUT_GET, 'role', FILTER_SANITIZE_STRING);

        if (LoggedInUserIsAdmin() && $userid && $role) {
            UpdateUserRole($userid, $role);
        }

        header('Location: /?action=editusers');
        exit();

    case 'contact':
        include 'views/contact.php';
        break;

    case 'deletecomment':
        $id = (int) filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (LoggedInUserIsAdmin() && $id) {
            DeleteComment($id);
        }

        header('Location: /?action=editcomments');
        exit();

    case 'deleteuser':
        $id = (int) filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (LoggedInUserIsAdmin() && $id) {
            DeleteUser($id);
        }

        header('Location: /?action=editusers');
        exit();

    case 'editcomments':
        $page = (LoggedInUserIsAdmin()) ? 'views/editcomments.php' : 'views/login.php';
        $comments = GetAllComments();
        include $page;
        break;

    case 'editusers':
        $page = (LoggedInUserIsAdmin()) ? 'views/editusers.php' : 'views/login.php';
        $users = GetAllUsers();
        include $page;
        break;



    case 'login' :
        include 'views/login.php';
        break;

    case 'loginsubmit':
        $email = filter_input(INPUT_POST, 'emaillogin', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'passwordlogin', FILTER_SANITIZE_STRING);
        if (LoginUser($email, $password)) {
            header('Location: /?action=menu');
            exit();
        }

        include 'views/login.php';
        break;

    case 'logout':
        session_destroy();
        $_SESSION = array();
        ob_start();
        header('Location: /');
        exit();
        break;

    case 'menu':
        $page = (CheckSession()) ? 'views/menu.php' : 'views/login.php';
        include $page;
        break;

    case 'myinfo':
        $page = 'views/login.php';

        if ($userId = GetLoggedInUserId()) {
            $page = 'views/myinfo.php';
            $user = GetUser($userId);
        }

        include $page;
        break;

    case 'postcomment':
        if ($userId = GetLoggedInUserId()) {
            $text = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

            if ($text) {
                SaveComment($userId, $text);
                header('Location: /?action=comment');
                exit();
            }
        }
        include 'views/comment.php';
        break;

    case 'registersubmit':
        $regFirst = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $regLast = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $regmail = filter_input(INPUT_POST, 'emailreg', FILTER_SANITIZE_EMAIL);
        $regpass1 = filter_input(INPUT_POST, 'passwordreg1', FILTER_SANITIZE_STRING);
        $regpass2 = filter_input(INPUT_POST, 'passwordreg2', FILTER_SANITIZE_STRING);
        $message = '';

        if (RegisterUser($regFirst, $regLast, $regmail, $regpass1, $regpass2, $message)) {
            header('Location: /?action=menu');
            exit();
        }

        include 'views/login.php';
        break;

    case 'siteplan' :
        include 'views/siteplan.php';
        break;
    
    case 'submissions' :
        include 'views/submissions.php';
        break;
    
    case 'teachingpresentation':
        include 'views/assessments/CIT336 Teaching Presentation.php';
        break;

    case 'updateinfo':
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $regFirst = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $regLast = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

        if ($userId = GetLoggedInUserId()) {
            $page = 'views/myinfo.php';

            if ($email && $regFirst && $regLast) {
                UpdateUserInfo($userId, $email, $regFirst, $regLast);
                $user = GetUser($userId);
                $message = 'User Info Updated.';
            } else {
                $message = 'Please fill in all information to update.';
            }
        } else {
            $page = 'views/login.php';
        }

        include $page;
        break;

    case 'updatepassword':
        $oldpassword = $_POST['currentpassword'];
        $newpassword = $_POST['newpassword'];
        $newpassword2 = $_POST['repeatpassword'];
        $message = '';

        if ($newpassword == $newpassword2) {
            $validMessage = '';
            if (ValidatePassword($newpassword, $validMessage)) {
                if (ValidateOldPassword($oldpassword)) {
                    UpdateUserPassword($newpassword);
                    $message = 'Password Updated';
                } else {
                    $message = 'The old password did not match.';
                }
            } else {
                $message = $validMessage;
            }
        } else {
            $message = "The new passwords do not match";
        }

        if ($userId = GetLoggedInUserId()) {
            $page = 'views/myinfo.php';
            $user = GetUser($userId);
        }

        include 'views/myinfo.php';
        break;

    case 'upload' :
        include 'views/uploads.php';
        break;
    
    case 'cowboys' :
        include 'views/audio/CowboysOverture.php';
        break;
   
    case 'et' :
        include 'views/audio/ET.php';
        break;
   
    case 'fiddler' :
        include 'views/audio/FiddlerontheRoof.php';
        break;
   
    case 'foralways' :
        include 'views/audio/ForAlways.php';
        break;
   
    case 'harrypotter' :
        include 'views/audio/HarryPotter.php';
        break;
   
    case 'indianajones' :
        include 'views/audio/IndianaJones.php';
        break;
   
    case 'jaws' :
        include 'views/audio/Jaws.php';
        break;
   
    case 'jurassicpark' :
        include 'views/audio/JurassicPark.php';
        break;
   
    case 'olymicfanfare' :
        include 'views/audio/OlympicFanfare.php';
        break;
   
    case 'schindlerslist' :
        include 'views/audio/SchindlersList.php';
        break;
   
    case 'spiderman' :
        include 'views/audio/Spiderman.php';
        break;
   
    case 'starwars' :
        include 'views/audio/StarWars.php';
        break;
   
    case 'stillalive' :
        include 'views/audio/StillAlive.php';
        break;
   
    case 'warhorse' :
        include 'views/audio/WarHorse.php';
        break;

    default :
        include 'views/home.php';
}

include 'views/footer.php';

