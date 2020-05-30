<?php

/**
 * Start the session.
 */
session_start();

if(!isset($_SESSION['user_id'])){
     header("location:login12S162364.php");
}

/**
 * Include our MySQL connection.
 */
require 'dbconnection.php';
    $query = "SELECT * FROM courses";
    $stmt = $conn->prepare("SELECT * FROM courses");
    $stmt->execute(array("%$query%"));
    // fetching rows into array
    $data = $stmt->fetchAll();


 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/user_registration.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<header style="align-items: right;">
     <p style="text-align: end; margin-top: 8px; margin-bottom: 8px;"><a href="logout.php" >LOGOUT</a></p>
</header>

<body>
    <div class="d-flex justify-content-center" >  <h3 style="color: white; " class="d-flex mt-3">All Registered Courses</h3>

       <div align="center" style="padding-left:50px;"><a href="course12S162364.php" class="btn btn-primary mt-3" style="color: white">Add New Course</a> </div>

    </div>

<div class="container d-flex justify-content-center mt-3">

<div class="col col-10 justify-content-center mt-3 d-flex">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="color: white">ID</th>
      <th scope="col" style="color: white">Course Code</th>
      <th scope="col" style="color: white">Course Name</th>
      <th scope="col" style="color: white">Registratio Fee</th>
      <th scope="col" style="color: white">Action</th>
    </tr>
  </thead>
  <tbody>
     <?php foreach($data as $row): ?>
        <tr>
          <td style="color: white"><?=$row['id']?></td>
          <td style="color: white"><?=$row['coursecode']?></td>
          <td style="color: white"><?=$row['coursename']?></td>
          <td style="color: white"><?=$row['regfee']?></td>
          <td><a href='delete.php?id=<?=$row['id']?>' class="btn btn-danger">Delete</a></td>
        </tr>
     <?php endforeach ?>
  </tbody>
</table>
    </div>
</div>

</body>
</html>