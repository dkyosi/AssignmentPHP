<?php

require 'dbconnection.php';

  if (isset($_GET['id'])) {
     $id=$_GET['id'];
       $count=$conn->prepare("DELETE FROM courses WHERE id=:id");
			$count->bindParam(":id",$id,PDO::PARAM_INT);
			$count->execute();
			header('location:main.php');
  }
		
?>