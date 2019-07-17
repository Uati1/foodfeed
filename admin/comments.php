<?php include "inc/header.php" ?>
    <div id="wrapper">

        <?php include"inc/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
						<h1 class="page-header">
                            Komentarze
                        </h1>

						
						<?php

							if(isset($_GET['source'])){
								$source = escape($_GET['source']);


								switch($source){
									case 'add':
									 include "inc/add.php";
									break;

									case 'edit':
									 include "inc/edit_post.php";
									break;

									default:
									include "inc/show_comments.php";
									break;
								}
							}else{
								include "inc/show_comments.php";
							}

						?>
						

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"inc/footer.php" ?>
