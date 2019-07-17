<table class="table table-bordered table-hover">
<thead>
		<tr>
			<th>Id</th>
			<th>Autor</th>
			<th>Komentarz</th>
			<th>Email</th>
			<th>Status</th>
			<th>W odpowiedzi do</th>
			<th>Data</th>
			<th>Zatwierdź</th>
			<th>Odrzuć</th>
			<th>Usuń</th>
		</tr>
	</thead>
	<tbody>
		<?php

			$query= "SELECT * FROM comments ";
			$select_comments = mysqli_query($connection, $query);

			while($row= mysqli_fetch_assoc($select_comments)){
				$id= $row['com_id'];
				$post_id= $row['com_post_id'];
				$author= $row['com_author'];
				$email= $row['com_email'];
				$date= $row['com_date'];
				$content= $row['com_content'];
				$status= $row['com_status'];
										
				echo "<tr>";
					
					echo "<td>{$post_id}</td>";
					echo "<td>{$author}</td>";

					//$query= "SELECT * FROM category WHERE cat_id = {$cat} ";
					//$select_category = mysqli_query($connection, $query);

					//while($row= mysqli_fetch_assoc($select_category)){
					//	$catt= $row['cat_title'];
					//	echo "<td>{$catt}</td>";
					//}

					echo "<td>{$content}</td>";
					echo "<td>{$email}</td>";
					echo "<td>{$status}</td>";

					$query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
					$get_title = mysqli_query($connection, $query);
					while($row= mysqli_fetch_assoc($get_title)){
						$post_id = $row['post_id'];
						$title = $row['post_title'];
					}


					echo "<td><a href='../post.php?p_id=$post_id'>{$title}</a></td>";
					echo "<td>{$date}</td>";
					echo "<td><a href='comments.php?approve=$id'>Zatwierdź</a></td>";
					echo "<td><a href='comments.php?disapprove=$id'>Odrzuć</a></td>";
					echo "<td><a href='comments.php?delete=$id'>Usuń</a></td>";
				echo "</tr>";
			}

		?>
	</tbody>
</table>

<?php if(isset($_GET['delete'])){

	$com_id = $_GET['delete'];

	$query = "DELETE FROM comments WHERE com_id = {$com_id} ";
	$delete_com_query = mysqli_query($connection, $query);

	check($delete_com_query);
	header("Location: comments.php");

}
?>
<?php if(isset($_GET['approve'])||isset($_GET['disapprove'])){
	
	if(isset($_GET['approve'])){
		$com_id = $_GET['approve'];
		$query = "UPDATE comments SET com_status = 'approved' WHERE com_id = {$com_id} ";
	}
	if(isset($_GET['disapprove'])){
		$com_id = $_GET['disapprove'];
		$query = "UPDATE comments SET com_status = 'disapproved' WHERE com_id = {$com_id} ";
	}

	$approve_com_query = mysqli_query($connection, $query);

	check($approve_com_query);
	header("Location: comments.php");

}
?>