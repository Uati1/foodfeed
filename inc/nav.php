<!-- Navigation -->
<?php include("inc/data.php"); ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="./index.php">FoodFeed</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<?php 

						$query= "SELECT * FROM category";
						$select_cat= mysqli_query($connection, $query);

						while($row= mysqli_fetch_assoc($select_cat)){
							$catt= $row['cat_title'];
							$id= $row['cat_id'];

							echo "<li><a href='category.php?category=$id'>{$catt}</a></li>";
						}
                        if(isset($_SESSION['role'])=='admin'){
                            echo "<li><a style='color: #000;' href='./admin/index.php'>admin</a></li>";
                        }
                    ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['username'])){
                            echo "<li><a  href='./add.php'><i class='fas fa-plus'></i> dodaj przepis</a></li>";
                        }
                    ?>
                    <li class="nav-item">
                        <form action="search.php" method="post">
                            <div class="input-group marg">
                                <div class="input-group-btn search-panel">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span id="search_concept">Szukaj w</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    <li><a href="#ingridients">składniki</a></li>
                                    <li><a href="#titles">tytuły</a></li>
                                    <li><a href="#users">użytkownicy</a></li>
                                    <li><a href="#tags">tagi</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#all">wszystko</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">         
                                <input type="text" class="form-control" name="search" placeholder="Wyszukiwana fraza">
                                <span class="input-group-btn">
                                    <button name="submit" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </form>
                    </li>
                
				
                    <li class="dropdown nav-item">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <?php 
                               
                                if(isset($_SESSION['username'])){
                                    echo $_SESSION['username'];
                                    
                                }else{
                                    ?>zaloguj się<?php
                                }
                            ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <?php 
                                $logged=false;
                                if(isset($_SESSION['username'])){
                                    ?>
                                    <li>
                                        <a href="./my_posts.php"><i class="fas fa-user"></i> Moje przepisy</a>
                                    </li>
                                    <li>
                                        <a href="./my_comments.php"><i class="fas fa-comment"></i> Moje Komentarze</a>
                                    </li>
                                    <li>
                                        <a href="./favourite.php"><i class="fas fa-heart"></i> Ulubione</a>
                                    </li>
                                    <li>
                                        <a href="./settings.php"><i class="fas fa-wrench"></i> Ustawienia</a>
                                    </li>
                                    <li>
                                        <a href="inc/logout.php"><i class="fas fa-power-off"></i> Wyloguj</a>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                        <form action="inc/login.php" method="post">
                                            <li>
                                                <input name="username" type="text" class="form-control" placeholder= "username"> 
                                            </li>
                                            <li>
                                                <input name="password" type="password" class="form-control" placeholder= "password">
                                            </li>            
                                                <button class="btn btn-primary nav-btn" name="login" type="submit">zaloguj się</button>
                                        </form>
                                        <li>
                                            <a href="./registration.php" class="btn">zarejestruj się</a>
                                        </li>
                                    <?php
                                }
                            ?>

                        </ul>
                    </li>
                    
                
					

                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
    