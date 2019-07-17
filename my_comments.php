<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

<div class="container">

    <?php
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $query = "SELECT * FROM comments WHERE com_author = '{$username}' ";
            $per_page = 12;
            $i = 0;
            if(isset($_GET['page'])){
                $page = escape($_GET['page']);
            }else{
                $page = 1;
            }

            if($page == 0 || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ( $page * $per_page) - $per_page;
            }

            $num = quantity($query);
            $count = ceil($num / $per_page);

            $query1 = "{$query} LIMIT $page_1,{$per_page} ";
            $select_posts= mysqli_query($connection, $query1);

            while($row = mysqli_fetch_assoc($select_posts)){
                $com_post_id= $row['com_post_id'];
                $com_content= $row['com_content'];
                $com_date= $row['com_date'];
                $query = "SELECT *FROM posts WHERE post_id = '{$com_post_id}' ";
                $select_post= mysqli_query($connection, $query);
                while($row1 = mysqli_fetch_assoc($select_post)){
                    $post_img= $row1['post_img'];
                    $post_title= $row1['post_title'];
                }
                
                
                if($i==2){
                    ?> <div class="row " ><?php
                }

                ?>
                
                    
                <div class="col-sm-12 comment" >
                    <div  class="minature col-sm-4">
                        <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
                    </div>
                    <div class="right-decription col-sm-8">
                        <div class="row">
                            <a class="com-title col-xs-6" href="post.php?p_id=<?php echo $post_id; ?>" ><?php echo $post_title; ?></a>
                            <p class= "com-date col-xs-6">added:  <?php echo $com_date; ?></p>
                         </div>
                        <p class= "com-content"><?php echo $com_content; ?></p>
                        <a class= "com-right" href="post.php?p_id=<?php echo $com_post_id; ?>">Zobacz post</p>
                    </div>
                </div>
                <?php
                if($i===2){
                    ?></div><?php
                    $i=0;
                }	
            }
           
        }
        
    ?>
     <hr>
		<ul class="pager">
					<?php
						pager($count, $page);
					?>

				</ul>

</div>


<?php include("inc/footer.php"); ?>