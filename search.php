<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                <?php
                 include 'config.php';
                 $search_item = $_GET['search']
                ?>

                  <h2 class="page-heading">Search : <?php echo $search_item ?></h2>

                      <?php

                         $limit = 3;
                         
                         if(isset($_GET['page'])){
                             $page= $_GET['page'];
                         }else{
                              $page = 1; 
                         }
                        
                           $offset =($page -1) * $limit;
                            include 'config.php';

                            $search_term = $_GET['search'];

                            $sql = "SELECT * FROM post
                                    LEFT JOIN category ON post.category = category.category_id
                                    LEFT JOIN user ON post.author = user.user_id
                                    WHERE post.title LIKE '%$search_term%' OR category.category_name LIKE '%$search_item%' OR post.description LIKE '%$search_term%' OR user.username LIKE '%$search_term%' OR post.post_date LIKE '%$search_term%'
                                    LIMIT {$offset},{$limit}";

                            $result = mysqli_query($conn,$sql);
            
                            
                            if(mysqli_num_rows($result)){
                                     
                                      while($row= mysqli_fetch_assoc($result)){
                            
                            ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?sid=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?sid=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category_id']?>'><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['user_id']?>'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['description'],0,130)."....." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?sid=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        }else{
                            echo "<h1>No Record Found</h1>";
                        }
                        ?>
                      
                      <?php
                    

                    $sql1 = "SELECT * FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE post.title LIKE '$search_term%' OR post.description LIKE '%$search_term%' OR user.username LIKE '%$search_term%' OR category.category_name LIKE '%$search_term%'OR post.post_date LIKE '%$search_term%' ";

                    $result1 = mysqli_query($conn,$sql1) or die ("Query Failed");
                    
                    if(mysqli_num_rows($result1) > 0){

                            $total_record = mysqli_num_rows($result1);

                            $total_page = ceil($total_record / $limit);

                            echo "<ul class='pagination admin-pagination'>";
                            if($page > 1){
                                  echo "<li><a href='search.php?search=".$search_term."&page=".($page-1)."'>prev</a></li>";
                            }
                            for($i = 1; $i <= $total_page; $i++){

                                    if($i == $page){
                                        $actives = "actives";
                                    }else{
                                        $actives = "";
                                    }
                                   
                                   echo"<li class='".$actives."'><a href='search.php?search=".$search_term."&page=  ".$i."'> ".$i."</a></li>";

                            };

                            if($total_page > $page){
                                echo "<li><a href='search.php?search=".$search_term."&page= ".($page + 1)." '>next</a></li>";
                             }
                           
                            echo "</ul>";
                           
                    }
                  ?>
                  
             
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
