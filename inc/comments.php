<!-- Blog Comments -->

				<?php

					if(isset($_POST['create_com'])){

						$p_id = escape($_GET['p_id']);
						$author = escape($_POST['com_author']);
						$email = escape($_POST['com_email']);
						$content = escape($_POST['com_content']);

						if(!empty($author)&&!empty($email)&&!empty($content)){
							$query = "INSERT INTO comments (com_post_id, com_author, com_email, com_content, com_status, com_date) ";
							$query .= "VALUES ({$p_id}, '{$author}', '{$email}', '{$content}','disapproved', now())";
							$add_com_query = mysqli_query($connection, $query);

							$query = "UPDATE posts SET post_com_count = post_com_count + 1 WHERE post_id = $p_id";
							$increment_query = mysqli_query($connection, $query);
						}else{
							echo "<script>alert('Fields cannot be empty');</script>";
						}

					}

				?>
				
			
                <!-- Comments Form -->
                <div class="well">
                    <h4 class="center">Dodaj komentarz:</h4>
					<?php
						if(isset($_SESSION['username'])){
							$username = $_SESSION['username'];
							$query = "SELECT * FROM users WHERE username = '{$username}' ";
							$send = mysqli_query($connection, $query);
							$row = mysqli_fetch_assoc($send);
							$email = $row['us_email'];
							?>
								<form action="" method="post" role="form">
									<div class="form-group com-name">
									<label for"com_author">Author</label> <?php echo $username;?>
									</div>
									<div class="form-group com-name">
									<label for"com_email">Email</label> <?php echo $email;?>
									</div>
									<div class="form-group">
										<label for"com">Your Comment</label>
										<textarea class="form-control" rows="3" name="com_content"></textarea>
									</div>
									<button type="submit" name="create_com" class="btn btn-primary btn-block">Dodaj komentarz</button>
								</form>
							<?php
						}else{
							?>
							<form action="" method="post" role="form">
								<div class="form-group">
									<label for"com_author">Nick</label>
									<input class="form-control" type="text" name="com_author">
								</div>
								<div class="form-group">
									<label for"com_email">Email</label>
									<input class="form-control" type="email" name="com_email">
								</div>
								<div class="form-group">
									<label for"com">Twój komentarz</label>
									<textarea class="form-control" rows="3" name="com_content"></textarea>
								</div>
								<button type="submit" name="create_com" class="btn btn-primary btn-block">Dodaj komentarz</button>
							</form>
							<?php
						}
					?>
                    
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
				<?php

					if(isset($_GET['p_id'])){
						
						$id = escape($_GET['p_id']);
						$query = "SELECT * FROM comments WHERE com_post_id = $id ";
						$query .= "AND com_status = 'approved' ";
						$query .= "ORDER BY com_id DESC ";
						$show_post_comments = mysqli_query($connection, $query);
						while($row= mysqli_fetch_assoc($show_post_comments)){
							$author= $row['com_author'];
							$email= $row['com_email'];
							$date= $row['com_date'];
							$content= $row['com_content'];
							$status = $row['com_author_status'];
						?>
							<div class="media">
								<a class="pull-left" href="#">
									<img class="media-object" src="img/avatar.png" alt="" width="60px" height="60px;">
								</a>
								<div class="media-body">
									<h4 class="media-heading">
									<?php 
										if($status == 1){
											?><a href = "post_author.php"><?php echo $author; ?></a><?php
										}else{
									?>
											<?php echo $author; ?>
									<?php }?>
										<small><?php echo $date; ?></small>
									</h4>
									<p><?php echo $content; ?></p>
								</div>
							</div>
						<?php }
					}
				?>