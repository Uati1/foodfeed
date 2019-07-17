<?php 

	if(isset($_GET['edit_user'])){
		$id = escape($_GET['edit_user']);

		$query= "SELECT * FROM users WHERE us_id = {$id} ";
		$user_edit = mysqli_query($connection, $query);

		while($row= mysqli_fetch_assoc($user_edit)){
			$username= $row['username'];
			$password= $row['us_pass'];
			$firstname= $row['us_firstname'];
			$lastname= $row['us_lastname'];
			$email= $row['us_email'];
			$img= $row['us_img'];
			$role= $row['us_role'];
			
		}


		if(isset($_POST['edit_user'])){
		
			$id = escape($_GET['edit_user']);
			$img = escape($_FILES['img']['name']);
			$img_temp = escape($_FILES['img']['tmp_name']);
			$username= escape($_POST['username']);
			$passy= escape($_POST['pass']);
			$firstname= escape($_POST['firstname']);
			$lastname= escape($_POST['lastname']);
			$email= escape($_POST['email']);
			$role= escape($_POST['role']);

			move_uploaded_file($img_temp, "../img/$img");

			if(!empty($passy)){
				$query_pass = "SELECT us_pass FROM users WHERE user_id = {$id}";
				$get_user = mysqli_query($connection, $query_pass);
				$row = mysqli_fetch_array($get_user);

				$db_pass = $row['us_pass'];
			}
			if($db_pass != $passy){
				$hash = password_hash($passy, PASSWORD_BCRYPT, array('cost' => 12));
			}

			$query = "UPDATE users SET ";
			$query .= "username = '{$username}', ";
			$query .= "us_pass = '{$hash}', ";
			$query .= "us_firstname = '{$firstname}', ";
			$query .= "us_img = '{$img}', ";
			$query .= "us_lastname = '{$lastname}', ";
			$query .= "us_email = '{$email}', ";
			$query .= "us_role = '{$role}' ";
			$query .= "WHERE us_id = {$id}";

			$user_update_query = mysqli_query($connection, $query);

			check($user_update_query);

		}
	}else{
	
		header("Location: index.php");

	}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Imię</label>
         <input  type="text" class="form-control" name="firstname" value= "<?php echo $firstname; ?>">
      </div>

      <div class="form-group">
		<label for="author">Nazwisko</label>
		<input  type="text" class="form-control" name="lastname" value= "<?php echo $lastname; ?>">
      </div>

	  <div class="form-group">
         <label for="status">Nick</label>
          <input  type="text" class="form-control" name="username" value= "<?php echo $username; ?>">
      </div>

	  <div class="form-group">
         <label for="tags">Hasło</label>
          <input  autocomplet ="off" class="form-control" name="pass">
      </div>
	  
	  <div class="form-group">
         <label for="tags">Email</label>
          <input  type="text" class="form-control" name="email" value= "<?php echo $email; ?>">
      </div>

	  <div class="form-group">
         <label for="tags">Rola</label>
          <select name= "role" id=""  class="form-control">
			<?php
				if($role == 'admin'){
					echo '<option value="admin">'. $role .'</option>';
					echo '<option value="user">user</option>';
				}else{
					echo '<option value="user">'. $role .'</option>';
					echo '<option value="admin">admin</option>';
				}
			 ?>
		  </select>
      </div>

    <div class="form-group">
		<label for="img">Avatar</label>
       <img width="100" src="../img/<?php echo $img ?>" alt=""> 
       <input  type="file" name="img">
    </div>

	<div class="form-group">
         <input class="btn btn-primary" type="submit" name="edit_user" value="Wyślij">
     </div>

</form>