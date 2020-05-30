<!-- course registration -->
<?php
 
/**
 * Start the session.
 */
session_start();

 if(!isset($_SESSION['user_id'])){
     header("location:login12S162364.php");
}
 
/**
 * Include our DB connection.
 */
require 'dbconnection.php';
 
if(isset($_POST['submit'])){

    
    //Retrieve the field values from course field
    $coursecode = !empty($_POST['coursecode']) ? trim($_POST['coursecode']) : null;
    $coursename = !empty($_POST['coursename']) ? trim($_POST['coursename']) : null;
    $regfee = !empty($_POST['regfee']) ? trim($_POST['regfee']) : null;

    $expression = "A-Z"."-"."1-5";

    // preg_match($expression, $my_url);

    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(id) AS num FROM courses WHERE coursecode = :coursecode";
    $stmt = $conn->prepare($sql);
    
    // //Bind the provided coursecode to our prepared statement.
     $stmt->bindValue(':coursecode', $coursecode);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if($row['num'] > 0){
        die('That course already exists!');
    }

    //Remember: We are inserting a new row into our courses table.
    $sql = "INSERT INTO courses (coursecode,coursename, regfee) VALUES (:coursecode, :coursename, :regfee)";
    $stmt = $conn->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':coursecode', $coursecode);
    $stmt->bindValue(':coursename', $coursename);
    $stmt->bindValue(':regfee', $regfee);
 
    //Execute the statement and insert the new record
    $result = $stmt->execute();
    
    //If the process is successful.
    if($result){
        
         echo 'Course Added Successfully.';
         header('Location: main.php');
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
		  <h2>Add New Course</h2>
		  <form method="post" action="">
		    <div class="user-box">
		      <input type="text" name="coursecode" autocomplete="off" required="">
		      <label>Course Code * </label>
		    </div>
		     <div class="select_div">
		     	<label>Select Course *</label>
		     <select id="reg_select" name="coursename">
		     	<option value="graphic_design">Graphic Design</option>
		     	<option value="fundamentals_of_it">Fundamentals of IT</option>
                <option value="information_systems">Information Systems</option>
		     </select>
		    </div>
		     <div class="user-box">
		      <input type="text" name="regfee" autocomplete="off" required="">
		      <label>Reg Fee *</label>
		    
		   <div align="center">
		   	<button type="submit" name="submit" class="register_button">Add</button>
		   </div>
		  </form>
    
        </div>

		

</body>
</html>