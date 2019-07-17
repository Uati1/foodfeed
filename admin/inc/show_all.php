<?php

	if(isset($_POST['checkBoxArray']) && isset($_POST['bulk'])){
		foreach($_POST['checkBoxArray'] as $checkbox){
			
			$bulk = escape($_POST['bulk']);
			switch($bulk){
				case 'published':
					
					$query = "UPDATE posts SET post_status = '{$bulk}' WHERE post_id = {$checkbox} ";
					$update_status = mysqli_query($connection, $query);

				break;
				
				case 'draft':
					
					$query = "UPDATE posts SET post_status = '{$bulk}' WHERE post_id = {$checkbox} ";
					$update_status = mysqli_query($connection, $query);

				break;
				
				case 'clone':
					
					$query = "SELECT * FROM posts WHERE post_id = '{$checkbox}' ";
					$cloning_query = mysqli_query($connection, $query);

					while($row= mysqli_fetch_array($cloning_query)){
						$cat= $row['post_cat_id'];
						$title= $row['post_title'];
						$author= $row['post_author'];
						$date= $row['post_date'];
						$img= $row['post_img'];
						$tags= $row['post_tags'];
						$com= $row['post_com_count'];
						$status= $row['post_status'];
						$content= $row['post_content'];
					}

					$query = "INSERT INTO posts( post_cat_id, post_title, post_author, post_date, post_img, post_tags, post_com_count, post_status, post_content ) ";
					$query .= "VALUES('{$cat}', '{$title}', '{$author}', '{$date}', '{$img}', '{$tags}', '{$com}', '{$status}', '{$content}' ) ";

					$insert_query = mysqli_query($connection, $query);

				break;
				
				case 'delete':
					
					$query = "DELETE FROM posts WHERE post_id = {$checkbox} ";
					$deleting_query = mysqli_query($connection, $query);

				break;
			}

		}
	}

?>

<form method="post" action="">
	<table class="table table-bordered table-hover">

		<div id="bulkOptionsContainer" class="col-xs-4">
			<select class="form-control" name="bulk">
				<option value="">Wybierz</option>
				<option value="published">Publikuj</option>
				<option value="draft">Wycofaj</option>
				<option value="clone">Zklonuj</option>
				<option value="delete">Usuń</option>
			</select>
		</div>
		
		<div class="col-xs-4">
			<input type="submit" class="btn btn-success" value="Zastosuj"/>
		</div>

		<thead>
			<tr>
				<th><input type="checkbox" id="selectAll"></th>
				<th>Tytuł</th>
				<th>Autor</th>
				<th>Kategoria</th>
				<th>Status</th>
				<th>Zdjęcie</th>
				<th>Tagi</th>
				<th>Komentarze</th>
				<th>Odwiedzenia</th>
				<th>Data</th>
				<th>Edytuj</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody>
			<?php

				$query= "SELECT * FROM posts ORDER BY post_id DESC ";
				$select_posts = mysqli_query($connection, $query);

				while($row= mysqli_fetch_assoc($select_posts)){
					$id= $row['post_id'];
					$cat= $row['post_cat_id'];
					$title= $row['post_title'];
					$author= $row['post_author'];
					$date= $row['post_date'];
					$img= $row['post_img'];
					$tags= $row['post_tags'];
					$com= $row['post_com_count'];
					$status= $row['post_status'];
					$views= $row['post_views'];
						
					echo "<tr>";
						
						?>
						
						<td><input type='checkbox' class='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>

						<?php
						echo "<td><a class='btn' href= '../post.php?p_id={$id}'>{$title}</a></td>";
						echo "<td>{$author}</td>";

						$query= "SELECT * FROM category WHERE cat_id = {$cat} ";
						$select_category = mysqli_query($connection, $query);

						while($row= mysqli_fetch_assoc($select_category)){
							$catt= $row['cat_title'];
							echo "<td>{$catt}</td>";
						}

						echo "<td>{$status}</td>";
						echo "<td><img class='img-responsive' src ='../img/{$img}'></td>";
						echo "<td>{$tags}</td>";

						$query = "SELECT * FROM comments WHERE com_post_id = {$id} ";
						$com_query = mysqli_query($connection, $query);

						$row = mysqli_fetch_array($com_query);
						$comment = $row['com_id'];
						$com_count = mysqli_num_rows($com_query);

						echo "<td><a href='post_comments.php?id={$id}'>{$com_count}</a></td>";
						echo "<td>{$views}</td>";
						echo "<td>{$date}</td>";
						
						echo "<td><a href='posts.php?source=edit&p_id={$id}'>Edytuj</a></td>";
						echo "<td><a onClick=\"javascript: return confirm('Are you sure you wat to delete ?'); \" href='posts.php?delete={$id}'>Usuń</a></td>";
					echo "</tr>";
				}

			?>
		</tbody>
	</table>
</form>

<?php if(isset($_GET['delete'])&&$_SESSION['user_role'] == 'admin'){

	$post_id = escape($_GET['delete']);

	$query = "DELETE FROM posts WHERE post_id = {$post_id} ";
	$delete_query = mysqli_query($connection, $query);

	check($query);
	header("Location: posts.php");

}?>