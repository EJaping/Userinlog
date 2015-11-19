<!DOCTYPE html>
<!--
User login and update user data
To do:
* Rethink login/logout
* Use bootstrap to make everything look better...
-->
<?php
    // start the session
    session_start();
    
    // include class User
    include_once "Classes/UserClass.php";
    include_once 'init.php';
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  
        <title>User login</title>

        <!-- Bootstrap core CSS -->
        <link href="support/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="support/signin.css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="support/other.css"  />
        
        <script src="/support/jquery-2.1.4.js"></script>
        <script src="/support/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            
            // create user object
            $user = new User();                    
        
            if (isset($_POST['submit'])) {
                
                // set value of submit to action variable
                $action = $_POST['submit'];
                
                switch ($action) {
                    
                    // user wants to log in
                    case "Login":
                        
                        // set username and password
                        /*$user->setUsername($username);
                        $user->setPassword($password);*/
                        
                        // try to login
                        $login = $user->login($username, $password);
                        
                        if ($login) {
                            // login successful, show userpage
                            include "Userpage.html";
                            
                        } else {
                            // login failed, show appropriate message
                            include "Failedlogin.html";
                        }
                        break;
                    
                    // user wants to register
                    case "Register here":
                        // go to register page
                        include "Register.html";
                        break;
                    
                    // register user data
                    case "Register":
                        $user->register($name, $email, $username, $password);
                        
                        // go to user page
                        include "Userpage.html";
                        break;
                        
                    // try again to login
                    case "Try Again":
                        include "Inloggen.html";
                        break;
                        
                    // user wants to see his/her data
                    case "Show data":
                        // get user data from database
                        $user->getUserData($_SESSION["id"]);
                        
                        // show userdata page
                        include "Userdata.php";
                        break;
                    
                    // user wants to change his/her data
                    case "Change data":
                        // get user data from database
                        $user->getUserData($_SESSION["id"]);
                        
                        // show userupdate form
                        include "Userupdate.php";
                        break;
                    
                    // user wants to update his/her data
                    case "Update":
                        // update user data in database
                        $user->updateUserData($name, $email, $username, $password, $_SESSION["id"]);
                        
                        // back to userpage
                        include "Updateresults.html";
                        break;
                    
                    // back to userpage
                    case "Back":
                        include "Userpage.html";
                        break;
                        
                    // user wants to log out
                    case "Logout":
                        // unset user id
                        /*unset($_SESSION["id"]);
                        unset($_SESSION["message"]);*/
                        session_destroy();
                        
                        // back to login page
                        include "Inloggen.html";
                        break;
                }
                
            } else {
                // show starting page
                include "Inloggen.html";
            }
            
        ?>
    </body>
</html>
