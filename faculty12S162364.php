<!-- user registration -->
<?php

//register.php
 
/**
 * Start the session.
 */
session_start();
 
/**
 * Include ircmaxell's password_compat library.
 */
require 'lib/password.php';
 
/**
 * Include our MySQL connection.
 */
require 'dbconnection.php';
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['submit'])){

    
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
   // $picture = !empty($_POST['picture']) ? trim($_POST['picture']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $confirmpassword = !empty($_POST['confirmpassword']) ? trim($_POST['confirmpassword']) : null;

    

	 $target_dir = "pics/";
	 $file = $_FILES['my_file']['name'];
	 $path = pathinfo($file);
	 $filename = $path['filename'];
	 $ext = $path['extension'];
	 $temp_name = $_FILES['my_file']['tmp_name'];
	 $path_filename_ext = $target_dir.$filename.".".$ext;



    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(email) AS num FROM faculty WHERE email = :email";
    $stmt = $conn->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO faculty (email,gender, picture, password) VALUES (:email, :gender, :picture, :password)";
    $stmt = $conn->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':picture', $path_filename_ext);
    $stmt->bindValue(':password', $passwordHash);
 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();

     // Upload file
     move_uploaded_file($temp_name,$path_filename_ext);

    var_dump($conn->errorInfo());
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
         echo 'Thank you for registering with our website.';
         header('Location: login12S162364.php');
            exit;
    }
    
}



?> 
<html>
</!DOCTYPE html>
<html>
<head>
<title>User | Registration</title>
<link rel="stylesheet" type="text/css" href="css/user_registration.css">
</head>

	<body>

		<div class="login-box">
		  <h2>User Registration *</h2>
		  <form method="post" action="" enctype="multipart/form-data">
		    <div class="user-box">
		      <input type="email" name="email" autocomplete="off" required="">
		      <label>Email *</label>
		    </div>
		     <div class="select_div">
		     	<label>Select Gender *</label>
		     <select id="reg_select" name="gender">
		     	<option value="male">Male</option>
		     	<option value="female">Female</option>
		     </select>
		    </div>
		    <div class="user-box">
		     <!-- <input type="file" name="image" autocomplete="off" required=""><br>-->
		          <input name="my_file" type="file" />
		    </div>
		     <div class="user-box">
		      <input type="password" name="password" autocomplete="off" required="">
		      <label>Password *</label>
		    </div>
		      <div class="user-box">
		      <input type="password" name="confirmpassword" autocomplete="off" required="">
		      <label>Confirm *</label>
		    </div>
		    
		   <div align="center">
		   	<button type="submit" name="submit" value="Upload" class="register_button">Register</button>
		   </div>
		  </form>
           <div align="center"> 
            <p text-center style="color:white">Already Registered ?</p>
           <a href="login12S162364.php">Login<a>
           </div>
        </div>

		

</body>
</html>