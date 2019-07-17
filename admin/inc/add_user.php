<?php 

	if(isset($_POST['add_user'])){

		$img = escape($_FILES['img']['name']);
		$img_temp = escape($_FILES['img']['tmp_name']);
		$username= escape($_POST['username']);
		$pass= escape($_POST['pass']);
		$firstname= escape($_POST['firstname']);
		$lastname= escape($_POST['lastname']);
		$email= escape($_POST['email']);
		$role= escape($_POST['role']);

		$pass= password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

		move_uploaded_file($img_temp, "../img/$img");

		$query = "INSERT INTO users (username, us_pass, us_firstname, us_lastname, us_email, us_img, us_role)";
		$query .= "Values('{$username}','{$pass}','{$firstname}','{$lastname}', '{$email}', '{$img}', '{$role}')";

		$post_query = mysqli_query($connection, $query);

		check($query);

		echo "User Created: ". "<a href= 'users.php'>View Users</a>";
	}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Firstname</label>
         <input  type="text" class="form-control" name="firstname">
      </div>

      <div class="form-group">
		<label for="author">Lastname</label>
		<input  type="text" class="form-control" name="lastname">
      </div>

	  <div class="form-group">
         <label for="status">Username</label>
          <input  type="text" class="form-control" name="username">
      </div>

	  <div class="form-group">
         <label for="tags">Password</label>
          <input  type="password" class="form-control" name="pass">
      </div>
	  
	  <div class="form-group">
         <label for="tags">Email</label>
          <input  type="text" class="form-control" name="email">
      </div>

	  <div class="form-group">
         <label for="tags">Role</label>
          <select name= "role" id="">
			<option value="user">Select option</option>
			<option value="admin">admin</option>
			<option value="user">user</option>
		  </select>
      </div>

    <div class="form-group">
		<label for="img">Avatar</label>
       <?php //<img width="100" src="../images/" alt=""> ?>
       <input  type="file" name="img">
    </div>

	<div class="form-group">
         <input class="btn btn-primary" type="submit" name="add_user" value="Register">
     </div>

</form>