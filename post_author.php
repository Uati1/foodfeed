<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

    <!-- Page Content -->
    <div class="container">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
				<?php
					if(isset($_GET['a_id'])){
						$author = escape($_GET['a_id']);
						if(isset($_SESSION['username'])){
							
							$username = $_SESSION['username'];
							$path = $_SERVER['REQUEST_URI'];
							$query = "SELECT * from users WHERE username = '{$username}' AND post_status = 'published' ";
							$get = mysqli_query($connection, $query);
							$row = mysqli_fetch_assoc($get);
							$string = $row['us_authors'];
							$ids = explode(',', $string);

							if(isset($_SESSION['username'])){
								$username = $_SESSION['username'];
								if(isset($_GET['page'])){
									if( isset($_GET['add'])){
										$trim = str_replace('&add='.$_GET['add'], '', $path);
										delete($author,$trim,$ids,$string,$username);
										echo $trim;
									}elseif (isset($_GET['dislike'])) {
										$trim = str_replace('&dislike='.$_GET['dislike'], '', $path);
										add($author,$trim,$ids,$string,$username);
										echo $trim;
									}
								}else{
									if(isset($_GET['dislike'])){
										$trim = str_replace('&dislike='.$_GET['dislike'], '', $path);
										delete($author,$trim,$ids,$string,$username);
										echo $trim;
									}elseif (isset($_GET['add'])) {
										$trim = str_replace('&add='.$_GET['add'], '', $path);
										add($author,$trim,$ids,$string,$username);
										echo $trim;
									}
								}
							}
						}
						$query = "SELECT * FROM users WHERE us_id = '{$author}' ";
						$get = mysqli_query($connection, $query);
							$row = mysqli_fetch_assoc($get);
							$usr = $row['username'];
						?>
						<h1 class="page-header">
							
							<?php 
								if(isset($username)){
									?>Przepisy <?php echo $usr." "; 
									if(in_array($author,$ids) ){
										?><a href="post_author.php?a_id=<?php echo $author;?>&dislike=true" class= "addTo" > usuń z ulubionych</a><?php
									}else{
										?><a href="post_author.php?a_id=<?php echo $author;?>&add=true" class= "addTo" > dodaj do ulubionych</a><?php
									}
									
								}
							?>
						</h1>
						<?php
						
						$query = "SELECT * FROM posts WHERE post_author = '{$usr}' ";
						$count = posts($query,"","");
					}
				?>
				


            </div><!-- /.col-md-12 -->


        <hr>
		<ul class="pager">
					<?php
						pager($count->count, $count->page);
					?>

				</ul>	
				
<?php include("inc/footer.php"); ?>
