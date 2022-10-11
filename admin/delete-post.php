<?php

include 'config.php';
$sql1 = "SELECT * FROM post WHERE post_id = {$_GET['pid']}";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);

unlink("upload/".$row['post_img']);


$sql = "DELETE FROM post WHERE post_id = {$_GET['pid']}";
$result = mysqli_query($conn,$sql);

if($result){
    header("location: http://localhost/news-site/admin/post.php");
}else{
    echo "Query Failed";
}


?>