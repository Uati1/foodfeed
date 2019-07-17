
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>
<?php $author = $_SESSION['username']; ?>

    <!-- Page Content -->
    <div class="container">

		<h1 class="page-header">
			Posts by <?php echo $author; ?>
		</h1>
        <div>
            
        </div>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

				<?php 
					
                    $query="SELECT * FROM posts WHERE post_status = 'published' AND post_author = '{$author}'  ";
					$count = posts($query,"","");
                ?>

                
            </div><!-- /.col-md-10 -->


        </div><!-- /.row -->

        <hr>

		<ul class="pager">
			<?php pager($count->count,$count->page); ?>

		</ul>

<?php include("inc/footer.php"); ?>