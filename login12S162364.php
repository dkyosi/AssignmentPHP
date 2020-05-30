<?php
//login.php

/**
 * Start the session.
 */
session_start();

require 'lib/password.php';

/**
 * Include our MySQL connection.
 */
require 'dbconnection.php';


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['submit'])){
    
    //Retrieve the field values from our login form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id, email, password FROM faculty WHERE email = :email";
    $stmt = $conn->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':email', $email);
 
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

   //var_dump($user);
    
    //If $row is FALSE.
    if($user === null){
        //Could not find a user with that username!
        die('Wrong username or password!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our faculty table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
         
            //Redirect to our protected page, which we called main.php
            header('location:main.php');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            //die('Incorrect username / password combination!');
        }
    }
    
}
 
?>
<!-- HTML BEGINS HERE -->
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/user_registration.css">
</head>
<body>


<div class="login-box">
  <h2>Login</h2>
  <form method="post" action="">
    <div class="user-box">
      <input type="text" name="email" required="">
      <label>Email *</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password *</label>
    </div>
   <div align="center">
		   	<button type="submit" name="submit" class="register_button">Login</button>
		   </div>
          
  </form>
  <div align="center"> 
    <p text-center style="color:white">Don't have an account ?</p>
   <a href="faculty12S162364.php">Register<a></div>
</div>
</body>
</html>