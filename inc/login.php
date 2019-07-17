<?php include "data.php"; ?>
<?php include "../admin/inc/functions.php"; ?>

<?php session_start(); ?>

<?php 

	if(isset($_POST['login'])){
		$user = escape($_POST['username']);
		$pass = escape($_POST['password']);

		$query = "SELECT * FROM  users WHERE username = '{$user}' ";
		$select_us_query = mysqli_query($connection, $query);
		check($select_us_query);

		while($row = mysqli_fetch_array($select_us_query)){
			$id = $row['us_id'];
			$username= $row['username'];
			$password = $row['us_pass'];
			$firstname= $row['us_firstname'];
			$lastname= $row['us_lastname'];
			$role= $row['us_role'];
		}

		if(password_verify($pass,$password)){
			echo "nie";
			$_SESSION['username'] = $username;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['role'] = $role;

			header("Location: ../index.php");
		}else {
			header("Location: ../index.php");
		}


	}

?>