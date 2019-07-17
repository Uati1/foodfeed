
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

    <!-- Page Content -->
    <div class="container">

		<h1 class="page-header">
		Na co masz ochotę ?  
		</h1>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

				<?php
					$query = "SELECT * FROM posts WHERE post_status = 'published'";
					$count = posts($query,"","");
				?>

                
            </div><!-- /.col-md-10 -->

        </div><!-- /.row -->

        <hr>

		<ul class="pager">
			<?php
				pager($count->count, $count->page);
			?>

		</ul>
		
<?php include("inc/footer.php"); ?>
