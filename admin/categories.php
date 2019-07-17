<?php include "inc/header.php" ?>
    <div id="wrapper">

        <?php include"inc/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Kategorie
                        </h1>
						<div class="col-xs-6">

							<?php insert_categories(); ?>

							<form action="" method="post">
								<div class="form-group">
									<label for="cat_title">Dodaj kategorię</label>
									<input class="form-control" type="text" name="cat_title">
								</div>
								<div class="form-group">
									<input class="btn btn-primary" type="submit" name="submit" value="Dodaj kategorię">
								</div>
							</form>

							<?php

								if(isset($_GET['edit'])){
									$cat_id = $_GET['edit'];
									include 'inc/update.php' ;
								}

							?>

						</div>
						<div class="col-xs-6">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Id</th>
										<th>Nazwa kategorii</th>
									</tr>
								</thead>
								<tbody>
									<?php find_categories() ?>
									<?php delete_categories() ?>
								</tbody>
							</table>
						</div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"inc/footer.php" ?>
