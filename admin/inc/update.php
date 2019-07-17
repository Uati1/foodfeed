<form action="" method="post">
	<div class="form-group">
		<label for="cat_title">Edytuj kategorię </label>
		<?php
										
			if(isset($_GET['edit'])){
				$cat_id = escape($_GET['edit']);
				$query= "SELECT * FROM category WHERE cat_id = {$cat_id} ";
				$select_edit = mysqli_query($connection, $query);

				while($row= mysqli_fetch_assoc($select_edit)){
					$cat_id= $row['cat_id'];
					$catt= $row['cat_title'];
					?>

					<input class="form-control" type="text" name="cat_title" value="<?php if(isset($catt)){echo $catt;} ?>">

				<?php
				}
			}

			if(isset($_POST['update'])){
				$cat_title = escape($_POST['cat_title']);
				$query= "UPDATE category SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id} ";
				$update_cat = mysqli_query($connection, $query);
			}

		?>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update" value="Edytuj">
	</div>
</form>