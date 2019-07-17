
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

					if(isset($_POST['submit']) ){

						$search = $_POST['search'];
						$where = $_POST['search_param'];

						if($where == 'tags' ){
							 $query= "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ";
						}
						if($where == 'titles' ){
							$query= "SELECT * FROM posts WHERE post_title LIKE '%$search%' AND post_status = 'published' " ;
						}
						if($where == 'ingridients' ){
							$query= "SELECT * FROM posts WHERE post_ingridients LIKE '%$search%' AND post_status = 'published' ";
						}
						if($where == 'users' ){
							$query= "SELECT * FROM posts WHERE post_author LIKE '%$search%' AND post_status = 'published' ";
						}
						if( $where == 'all'){
							$query= "SELECT * FROM posts WHERE post_author LIKE '%$search%' OR  post_ingridients LIKE '%$search%' OR post_title LIKE '%$search%' OR post_tags LIKE '%$search%' AND post_status = 'published' ";
						}
						
						$count = posts($query,$search,$where);
					}elseif(isset($_GET['search'])&& isset($_GET['where'])){
						$search = $_GET['search'];
						$where = $_GET['where'];
						
						if($where == 'tags' ){
							$query= "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ";
					   }
					   if($where == 'titles' ){
						   $query= "SELECT * FROM posts WHERE post_title LIKE '%$search%' AND post_status = 'published' ";
					   }
					   if($where == 'ingridients' ){
						   $query= "SELECT * FROM posts WHERE post_ingridients LIKE '%$search%' AND post_status = 'published' ";
					   }
					   if($where == 'users' ){
						   $query= "SELECT * FROM posts WHERE post_author LIKE '%$search%' AND post_status = 'published' ";
					   }
					   if( $where == 'all'){
						   $query= "SELECT * FROM posts WHERE post_author LIKE '%$search%' OR  post_ingridients LIKE '%$search%' OR post_title LIKE '%$search%' OR post_tags LIKE '%$search%' AND post_status = 'published' ";
					   }
					   
					   $count = posts($query,$search,$where);
					}
					
					
				?>

                
            </div>


		</div>
		<ul class="pager">
			<?php
				pager($count->count, $count->page);
			?>

		</ul>
<?php include("inc/footer.php"); ?>