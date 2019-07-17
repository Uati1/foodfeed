<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>

    <!-- Page Content -->
    <div class="container">

		<h1 class="page-header">
		Ulubione 
		</h1>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

				<?php
                if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];
                    $liked = likes($username);
                    $liked=array_filter($liked);
                    $query = "SELECT * FROM posts WHERE `post_id` IN (".implode(',',$liked).")";
                    $count = posts($query,"","");
                }else{
                    echo "login";
                }
                   
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