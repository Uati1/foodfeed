<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12 single">

				<?php

					if(isset($_GET['p_id'])){
						$path = $_SERVER['REQUEST_URI'];
						$p_id = escape($_GET['p_id']);
						if(isset($_SESSION['username'])){
							$username = $_SESSION['username'];
						}
						$views_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = '{$p_id}' " ;
						$update_views= mysqli_query($connection, $views_query);

						$query= "SELECT * FROM posts WHERE post_id = $p_id ";
						$one_posts= mysqli_query($connection, $query);

						$row= mysqli_fetch_assoc($one_posts);
							$post_id = $row['post_id'];
							$post_title= $row['post_title'];
							$post_author= $row['post_author'];
							$post_date= $row['post_date'];
							$post_img= $row['post_img'];
							$post_content= $row['post_content'];
							$post_ingridients= $row['post_ingridients'];
						$query1= "SELECT * FROM users WHERE username = '{$post_author}' ";
						$auth= mysqli_query($connection, $query1);
						$row= mysqli_fetch_assoc($auth);
						$id = $row['us_id'];
							?>
							<h1 class="page-header">
								<?php echo $post_title; ?>
							</h1>
							<div class="secondary">
								<p class="lead">
									przepis dodany przez: <a href="post_author.php?a_id=<?php echo $id; ?>"><?php echo $post_author; ?></a>
								</p>
								<p class="lead"><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
							</div>
							<?php 
								if(isset($username) && $username == $post_author){
								?><div class = "post-box">
									<a class="edit" href = "./edit.php?p_id=<?php echo $post_id; ?>">Edytuj</a>
									<a class="delete" onClick="javascript: return confirm('Are you sure you wat to delete ?'); " 
									href='<?php if(strpos($path, '?') !== false){
											echo $path."&";
										}else{
											echo $path."?";
										} 
									?>delete=<?php echo $post_id?>'>Usuń</a>
								</div><?php
								}
							?>
							<div class="background">
								<img class="img-responsive img-single" src="img/<?php echo $post_img; ?>" alt="">
							</div>
							<hr>

							<div class="ingridients">
								<h3>Składniki: </h3>
								<ul>
									<?php
										$arr = explode(',', $post_ingridients);
										foreach( $arr as $ing){
											?><li><?php echo $ing;?></li><?php
										}

									?>
								</ul>
								<div class="socials">
									<div class="item col-xs-6 print"><a href="#" onclick="window.print();return false;"><i class="fas fa-print"></i></a></div>
									<div class="item col-xs-6 fb"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $path;?>  " target="_blank"><i class="fab fa-facebook-square"></i></a></div>
								</div>
								
							</div>
							
							<p class="recipe"><?php echo $post_content; ?></p>
							<div style="clear:both;" ></div>
							
				<?php	
				
					}else{
					
						header("Location: index.php");

					}
				 ?>

                <?php include "inc/comments.php"; ?>

            </div><!-- /.col-md-8 -->


        </div><!-- /.row -->

<?php include("inc/footer.php"); ?>
