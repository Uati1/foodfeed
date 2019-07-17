<?php include "inc/header.php" ?>

    <div id="wrapper">

	<?php $online_count = online_users(); ?>

        <?php include"inc/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Witaj <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?>
                        </h1>
                        
                    </div>
                </div><!-- /.row -->
                
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-file-text fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">

									<?php 
										$query = "SELECT * FROM posts ";
										$select_posts = mysqli_query($connection, $query);
										$num_post = mysqli_num_rows($select_posts);

										echo "<div class='huge'>". $num_post ."</div>";
									?>

										<div>Posty</div>
									</div>
								</div>
							</div>
							<a href="posts.php">
								<div class="panel-footer">
									<span class="pull-left">Zobacz więcej</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div><!-- /.panel -->
					</div><!-- /.col-lg-3 col-md-6 -->

					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-comments fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
									 <?php 
										$query = "SELECT * FROM comments ";
										$select_comments = mysqli_query($connection, $query);
										$num_com = mysqli_num_rows($select_comments);

										echo "<div class='huge'>". $num_com ."</div>";
									 ?>
									  <div>Komentarze</div>
									</div>
								</div>
							</div>
							<a href="comments.php">
								<div class="panel-footer">
									<span class="pull-left">Zobacz więcej</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div><!-- /.panel -->
					</div><!-- /.col-lg-3 col-md-6 -->

					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-user fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
									<?php 
										$query = "SELECT * FROM users ";
										$select_users = mysqli_query($connection, $query);
										$num_us = mysqli_num_rows($select_users);

										echo "<div class='huge'>". $num_us ."</div>";
									 ?>
										<div> Użytkownicy</div>
									</div>
								</div>
							</div>

							<a href="users.php">
								<div class="panel-footer">
									<span class="pull-left">Zobacz więcej</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div><!-- /.panel -->
					</div><!-- /.col-lg-3 col-md-6 -->

					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">

							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-list fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
									<?php 
										$query = "SELECT * FROM category ";
										$select_categories = mysqli_query($connection, $query);
										$num_cat = mysqli_num_rows($select_categories);

										echo "<div class='huge'>". $num_cat ."</div>";
									 ?>
										 <div>Kategorie</div>
									</div>
								</div>
							</div>

							<a href="categories.php">
								<div class="panel-footer">
									<span class="pull-left">Zobacz więcej</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>

						</div><!-- /.panel -->
					</div><!-- /.col-lg-3 col-md-6 -->
				</div><!-- /.row -->

				<?php

					$query = "SELECT * FROM posts WHERE post_status = 'draft' ";
					$select_posts_query = mysqli_query($connection, $query);
					$num_draft = mysqli_num_rows($select_posts_query);
					
					$query = "SELECT * FROM posts WHERE post_status = 'published' ";
					$select_published_query = mysqli_query($connection, $query);
					$num_published = mysqli_num_rows($select_published_query);

					$query = "SELECT * FROM comments WHERE com_status = 'disapproved' ";
					$select_comments_query = mysqli_query($connection, $query);
					$num_dis = mysqli_num_rows($select_comments_query);

					$query = "SELECT * FROM users WHERE us_role = 'admin' ";
					$select_users_query = mysqli_query($connection, $query);
					$num_sub = mysqli_num_rows($select_users_query);

				?>
				<div class="row">
					<script type="text/javascript">
						  google.charts.load('current', {'packages':['bar']});
						  google.charts.setOnLoadCallback(drawChart);

						  function drawChart() {
							var data = google.visualization.arrayToDataTable([
							  ['Date', 'Count'],

							  <?php 

								$elements = ['Wszystkie posty', 'Aktywne posty', 'Oczekujące posty', 'Komentarze', 'Odrzucone', 'Użytkownicy', 'Admini', 'Kategorie'];
								$element_count = [$num_post, $num_published, $num_draft, $num_com, $num_dis, $num_us, $num_sub, $num_cat];

								for($i = 0; $i< 8; $i++){
									echo "['{$elements[$i]}'". ",". "{$element_count[$i]}], ";
								}

							  ?>
							  
							]);

							var options = {
							  chart: {
								title: '',
								subtitle: '',
							  }
							};

							var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

							chart.draw(data, google.charts.Bar.convertOptions(options));
						  }
					</script>
					<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
				</div>

            </div><!-- /.container-fluid -->

        </div><!-- /#page-wrapper -->

<?php include"inc/footer.php" ?>
