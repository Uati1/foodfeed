<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
<?php include("inc/functions.php"); ?>
<?php 

	if(isset($_POST['add_post'])){
		$cat = escape($_POST['post_category']);
		$title = escape($_POST['title']);
		$author = $_SESSION['username'];

		$img = $_FILES['img']['name'];
		$img_temp = $_FILES['img']['tmp_name'];

		$status = 'published';
		$content = escape($_POST['content']);
		$tags = escape($_POST['tag']);
		$ingridients = escape($_POST['ing']);
		$date = date('d-m-y');


		move_uploaded_file($img_temp, "../img/$img");




		$query = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status, post_ingridients)";
		$query .= "Values('{$cat}','{$title}','{$author}',now(),'{$img}','{$content}','{$tags}', '{$status}', '{$ingridients}')";

		$post_query = mysqli_query($connection, $query);

	

		$id = mysqli_insert_id($connection);

		echo "<p class='bg-success'>Post został dodany !";
	}

?>

<div class="container">

	<h1 class="page-header">
		Dodaj przepis
	</h1>

	<form action="" method="post" enctype="multipart/form-data">    
		
		
		<div class="form-group">
			<label for="title">Tytuł</label>
			<input  type="text" class="form-control" name="title">
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
			<label for="img">Zdjęcie</label>
		<?php //<img width="100" src="../images/" alt=""> ?>
		<input  type="file" name="img">

		</div>

		<div class="form-group">
			<label for="tags">Tagi</label><small> aby zatwierdzić naciśnij enter</small><br>
				<input  type="text" class="form-control ingr" data-role="tagsinput"  name = "tag">
		</div>

		<div class="form-group">
			<label for="content">Składniki</label><small> aby zatwierdzić naciśnij enter</small><br>
			<input  type="text" class="form-control ingr" data-role="tagsinput"  name = "ing">
		</div>
		
		<div class="form-group">
			<label for="content">Tekst</label>
			<textarea  class="form-control "name="content" id="body" cols="30" rows="10"></textarea>
		</div>
		
		

		<div class="form-group">
			<input class="btn btn-primary" type="submit" name="add_post" value="Add Post">
		</div>


	</form>
<?php include("inc/footer.php"); ?>
