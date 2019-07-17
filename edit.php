<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>
<?php
	
	if(isset($_GET['p_id'])){
		$p_id = escape($_GET['p_id']);
	}

	$query= "SELECT * FROM posts WHERE post_id = $p_id ";
	$select_posts_edit = mysqli_query($connection, $query);

	while($row= mysqli_fetch_assoc($select_posts_edit)){
		$id= $row['post_id'];
		$cat= $row['post_cat_id'];
		$title= $row['post_title'];
		$author= $row['post_author'];
		$date= $row['post_date'];
		$img= $row['post_img'];
		$tags= $row['post_tags'];
		$content= $row['post_content'];
		$com= $row['post_com_count'];
		$status= $row['post_status'];
		$ingridients= $row['post_ingridients'];

	}

	if(isset($_POST['update_post'])){
		
		$cat = escape($_POST['post_category']);
		$title = escape($_POST['title']);
		$author = $_SESSION['username'];

		$img = escape($_FILES['img']['name']);
		$img_temp = escape($_FILES['img']['tmp_name']);

		$tags = escape($_POST['tag']);
		$status = escape($_POST['status']);
		$ingridients = escape($_POST['ingridients']);
		$content = escape($_POST['content']);

		move_uploaded_file($img_temp, "../img/$img");

		if(empty($img)){
			$query = "SELECT * FROM posts WHERE post_id = $p_id";
			$select_image = mysqli_query($connection, $query);

			while($row= mysqli_fetch_assoc($select_image)){
				$img= $row['post_img'];
			}
		}

		$query = "UPDATE posts SET ";
		$query .= "post_cat_id = '{$cat}', ";
		$query .= "post_title = '{$title}', ";
		$query .= "post_author = '{$author}', ";
		$query .= "post_date = now(), ";
		$query .= "post_img = '{$img}', ";
		$query .= "post_content = '{$content}', ";
		$query .= "post_tags = '{$tags}', ";
		$query .= "post_ingridients = '{$ingridients}' ";
		$query .= "WHERE post_id = {$p_id}";

		$post_update_query = mysqli_query($connection, $query);

		check($post_update_query);

		echo "<p class='bg-success'>Post zaktualizowany";
	}


?>

<div class="container">

	<h1 class="page-header">
		Dodaj przepis
	</h1>


	<form action="" method="post" enctype="multipart/form-data">    
		
		
		<div class="form-group">
			<label for="title">Post Title</label>
			<input value="<?php echo $title; ?>"  type="text" class="form-control" name="title">
		</div>


		<div class="form-group">
			<label for="categories">Kategorie </label> <br>
			<select multiple="multiple" class="form-control"  name="post_category" id="post_category">
				<?php
					
					$query= "SELECT * FROM category ";
					$select_categories = mysqli_query($connection, $query);

					while($row= mysqli_fetch_assoc($select_categories)){
						$cat_id= $row['cat_id'];
						$catt= $row['cat_title'];

						echo "<option value='{$cat_id}'>{$catt}</option>";
						
					}

				?>
			</select>
		</div>
		
		
		<div class="form-group">
			<label for="img">Post Image</label><br>
			<img width="100" src="../img/<?php echo $img; ?>" alt=""> 
			<input  type="file" name="img">
		</div>

		<div class="form-group">
			<label for="tags">Tagi</label><small> aby zatwierdzić naciśnij enter</small><br>
				<input value="<?php echo $tags; ?>"  type="text" class="form-control ingr" data-role="tagsinput"  name = "tag">
		</div>

		<div class="form-group">
			<label for="content">Składniki</label><small> aby zatwierdzić naciśnij enter</small><br>
			<input value="<?php echo $ingridients; ?>"  type="text" class="form-control ingr" data-role="tagsinput"  name = "ing">
		</div>
		
		<div class="form-group">
			<label for="content">Post Content</label>
			<textarea  class="form-control "name="content" id="body" cols="30" rows="10"><?php echo $content; ?>
			</textarea>
		</div>

		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
		</div>


	</form>

<?php include("inc/footer.php"); ?>