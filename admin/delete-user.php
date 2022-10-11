<?php
  
 

   include 'config.php';
   $sql = "DELETE FROM user WHERE user_id = {$_GET['uid']}";
   $result = mysqli_query($conn, $sql);

   if($result){
       header("Location: http://localhost/news-site/admin/users.php");
   }else{
      echo("Query Failed");
   }

?>