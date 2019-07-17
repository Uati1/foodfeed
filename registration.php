
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>
 
 <?php
	
	if(isset($_POST['submit'])){
		$username= escape($_POST['username']);
		$email= escape($_POST['email']);
		$pass= escape(_POST['password']);

		if(!empty($email)&&!empty($username)&&!empty($pass)){

			$pass= password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

			$query = "INSERT INTO users (username, us_email, us_pass, us_role ) ";
			$query .= "VALUES ('{$username}', '{$email}', '{$pass}', 'subscriber' ) ";
			$register_query = mysqli_query($connection, $query);
			check($register_query);
			$message = "registration compleated";
		}else{
			$message = "Fill all the fileds";
		}	
	}else{
		$message = "";
	}
 ?>

    <!-- Page Content -->
    <div class="container">
		<h1 class= "page-header">Zarejestruj się</h1>
		<section id="login">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3">
						<div class="form-wrap">
						
							<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
								<h6 class="text-center"><?php echo $message; ?></h6>
								<div class="form-group">
									<label for="username" class="sr-only">username</label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
								</div>
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
								</div>
								<div class="form-group">
									<label for="password" class="sr-only">Password</label>
									<input type="password" name="password" id="key" class="form-control" placeholder="Password">
								</div>
                
								<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Zarejestruj się">
							</form>
							<div class="login">
								Masz już konto? <a href="./index.php">zaloguj się</a> 
							</div>

						</div>
					</div> <!-- /.col-xs-12 -->
				</div> <!-- /.row -->
			</div> <!-- /.container -->
		</section>


        <hr>
<?php include("inc/footer.php"); ?>