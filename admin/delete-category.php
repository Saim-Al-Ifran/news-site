<?php

 

include 'config.php';

$sql = "DELETE FROM category WHERE category_id = {$_GET['cid']}";
$result = mysqli_query($conn, $sql);

if($result){
     header("Location: http://localhost/news-site/admin/category.php");
}else{
    echo "Query Failed";
}
 



?>



 