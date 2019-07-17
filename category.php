<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

			

            <!-- Blog Entries Column -->
            <div class="col-md-12">

				<?php

					if(isset($_GET['category'])){
						$cat_id = escape($_GET['category']);
						$query = "SELECT * FROM category WHERE cat_id = $cat_id ";
						$send = mysqli_query($connection,$query);
						$row  = mysqli_fetch_assoc($send);
						$title = $row['cat_title']
						?>
						<h1 class="page-header">
							<?php echo $title; ?>
						</h1>
						<?php
						$query = "SELECT * FROM posts WHERE post_cat_id = $cat_id AND post_status = 'published'";
						$count = posts($query,"","");
					
					}

				?>
				

				

                
            </div><!-- /.col-md-12 -->


        </div><!-- /.row -->
		<hr>
		<ul class="pager">
					<?php
						pager($count->count, $count->page);
					?>

				</ul>
        <hr>
<?php include("inc/footer.php"); ?>
