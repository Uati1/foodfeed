<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nazwa</th>
			<th>Hasło</th>
			<th>Imię</th>
			<th>Nazwisko</th>
			<th>Email</th>
			<th>Zdjęcie</th>
			<th>Rola</th>
			<th>Dodaj do</th>
			<th>Dodaj do</th>
			<th>Usuń</th>
			<th>Edytuj</th>
		</tr>
	</thead>
	<tbody>
		<?php

			$query= "SELECT * FROM users ";
			$select_comments = mysqli_query($connection, $query);

			while($row= mysqli_fetch_assoc($select_comments)){
				$id= $row['us_id'];
				$username= $row['username'];
				$pass= $row['us_pass'];
				$firstname= $row['us_firstname'];
				$lastname= $row['us_lastname'];
				$email= $row['us_email'];
				$img= $row['us_img'];
				$role= $row['us_role'];
										
				echo "<tr>";
					
					echo "<td>{$id}</td>";
					echo "<td>{$username}</td>";

					echo "<td>{$pass}</td>";
					echo "<td>{$firstname}</td>";
					echo "<td>{$lastname}</td>";

					//$query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
					//$get_title = mysqli_query($connection, $query);
					//while($row= mysqli_fetch_assoc($get_title)){
					//	$post_id = $row['post_id'];
					//	$title = $row['post_title'];
					//}

					echo "<td>{$email}</td>";
					echo "<td>{$img}</td>";
					echo "<td>{$role}</td>";
					echo "<td><a href='users.php?change_adm=$id'>Admin</a></td>";
					echo "<td><a href='users.php?change_sub=$id'>Subscriber</a></td>";
					echo "<td><a href='users.php?delete=$id'>usuń</a></td>";
					echo "<td><a href='users.php?source=edit&edit_user=$id'>edytuj</a></td>";
				echo "</tr>";
			}

		?>
	</tbody>
</table>

<?php if(isset($_GET['delete'])){

	if(isset($_SESSION['user_role'])){
		if($_SESSION['user_role']=="admin"){

			$us_id = escape($_GET['delete']);
			$query = "DELETE FROM users WHERE us_id = {$us_id} ";
			$delete_us_query = mysqli_query($connection, $query);

			check($delete_us_query);
			header("Location: users.php");
		}
	}
}
?>
<?php if(isset($_GET['change_adm'])||isset($_GET['change_sub'])){
	
	if(isset($_GET['change_sub'])){
		$us_id = $_GET['change_sub'];
		$query = "UPDATE users SET us_role = 'subscriber' WHERE us_id = {$us_id} ";
	}
	if(isset($_GET['change_adm'])){
		$us_id = $_GET['change_adm'];
		$query = "UPDATE users SET us_role = 'admin' WHERE us_id = {$us_id} ";
	}

	$approve_us_query = mysqli_query($connection, $query);

	check($approve_us_query);
	header("Location: users.php");

}
?>