<?php include "inc/header.php" ?>
<?php include "inc/nav.php" ?>
<?php include "inc/functions.php" ?>
<!-- Custom CSS -->


<!-- Custom Fonts -->


<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-file-text fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<?php 
								$username = $_SESSION['username'];
								$query = "SELECT * FROM posts WHERE post_author = '{$username}' ";
								$num_post = quantity($query);

								echo "<div class='huge'>". $num_post ."</div>";
							?>

							<div>Przepisów</div>
						</div>
					</div>
				</div>
				<a href="my_posts.php">
					<div class="panel-footer">
						<span class="pull-left">Zobacz przepisy</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div><!-- /.panel -->
		</div><!-- /.col-lg-3 col-md-6 -->

		<div class="col-md-4">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
						<?php 
							$query = "SELECT * FROM comments WHERE com_author = '{$username}'";
							$num_com = quantity($query);

							echo "<div class='huge'>". $num_com ."</div>";
						?>
						<div>Komentarzy</div>
						</div>
					</div>
				</div>
				<a href="my_comments.php">
					<div class="panel-footer">
						<span class="pull-left">Zobacz komentarze</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div><!-- /.panel -->
		</div><!-- /.col-lg-3 col-md-6 -->

		<div class="col-md-4">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
						<?php 
							// $query = "SELECT * FROM videos WHERE vid_author = '{$username}' ";
							// $num_vid = quantity($query);

							// echo "<div class='huge'>". $num_vid ."</div>";
						?>
							<div> Nagrań</div>
						</div>
					</div>
				</div>

				<a href="my_videos.php">
					<div class="panel-footer">
						<span class="pull-left">Zobacz nagrania</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div><!-- /.panel -->
		</div><!-- /.col-lg-3 col-md-6 -->

	<?php

		// $query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_author = '{$username}' ";
		// $num_draft = quantity($query);
		
		// $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_author = '{$username}' ";
		// $num_published = quantity($query);

		// $query = "SELECT * FROM comments WHERE com_status = 'disapproved' AND com_author = '{$username}'";
		// $num_dis = quantity($query);
		if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
	
			$query = "SELECT * FROM users WHERE username = '{$username}' ";
	
			$profile_query = mysqli_query($connection, $query);
	
			while($row = mysqli_fetch_array($profile_query)){
				$id= $row['us_id'];
				$username= $row['username'];
				$pass= $row['us_pass'];
				$firstname= $row['us_firstname'];
				$lastname= $row['us_lastname'];
				$email= $row['us_email'];
				$img= $row['us_img'];
				$role= $row['us_role'];
			}
	
			if(isset($_POST['edit_user'])&&escape($_POST['pass']) == escape($_POST['pass-again'])){
			
			$img = $escape(_FILES['img']['name']);
			$img_temp = escape($_FILES['img']['tmp_name']);
			$username= escape($_POST['username']);
			$pass= escape($_POST['pass']);
			$firstname= escape($_POST['firstname']);
			$lastname= escape($_POST['lastname']);
			$email= escape($_POST['email']);
			$role= escape($_POST['role']);
	
			move_uploaded_file($img_temp, "/img/$img");
	
			$query = "UPDATE users SET ";
			$query .= "us_pass = '{$pass}', ";
			$query .= "us_firstname = '{$firstname}', ";
			$query .= "us_img = '{$img}', ";
			$query .= "us_lastname = '{$lastname}', ";
			$query .= "us_email = '{$email}', ";
			$query .= "us_role = '{$role}' ";
			$query .= "WHERE username = '{$username}'";
	
			$user_update_query = mysqli_query($connection, $query);
	
		}
	
		}

	?>
	<div class="row">
	<div class="col-lg-12 settings">
                        
						<h1 class="page-header">
								Uaktualnij profil <?php echo $username; ?> 
						</h1>

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
								 <label for="tags">Hasło</label>
								  <input  type="password" class="form-control" name="pass" value= "<?php echo $pass; ?>">
							  </div>

							  <div class="form-group">
								 <label for="tags">Powtórz hasło</label>
								  <input  type="password" class="form-control" name="pass-again" value= "<?php echo $pass; ?>">
							  </div>
							  <?php 
								if(isset($_POST['pass'])&&isset($_POST['pass-again'])&& escape($_POST['pass']) != escape($_POST['pass-again'])){
									echo "<div class='warning'>Powtórzone hasło musi być identyczne</div>";
								}
							  ?>
	  
							  <div class="form-group">
								 <label for="tags">Email</label>
								  <input  type="text" class="form-control" name="email" value= "<?php echo $email; ?>">
							  </div>

							<div class="form-group">
								<label for="img">Avatar</label><br/>
							   <img width="100" src="../img/<?php echo $img ?>" alt=""> 
							   <input class="btn btn-primary float"  type="file" name="img">
							</div>

							<div class="form-group">
								 <input class="btn btn-primary" type="submit" name="edit_user" value="Zaktualizuj profil">
							 </div>

						</form>
						

                    </div>
	</div>
</div>
<?php include "inc/footer.php"?>
