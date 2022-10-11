<?php

 
      
  include 'config.php';
  $cat_name = mysqli_real_escape_string($conn,trim($_POST['cat_name']));
  $cat_id = $_POST['cat_id'];

   echo $sql1 = "UPDATE category SET category_name ='$cat_name' WHERE category_id = $cat_id";

  $result1 = mysqli_query($conn, $sql1);
  
  if($result1){
      header("Location: http://localhost/news-site/admin/category.php");
  }else{
    echo "Query Failed";
  }
 
 

?>

