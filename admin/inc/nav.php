<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="index.php">Foodfeed Admin</a>
</div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="../index.php">Główna</a></li>
                <li><a href="#">Użytkownicy online: <span class="onUsers"><?php online_users(); ?></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../inc/logout.php"><i class="fa fa-fw fa-power-off"></i> Wyloguj</a>
                        </li>

                    </ul>
                </li>
            </ul>
            


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fas fa-tachometer-alt"></i> Panel sterowania</a>
                    </li>
                    <li>
                        <a href="./categories.php"><i class="fas fa-th-large"></i> Kategorie</a>
                    </li>
                    <li>
                        <a href="./posts.php"><i class="fas fa-clipboard"></i> Posty</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fas fa-comments"></i> Komentarze</a>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fas fa-users"></i> Użytkownicy <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="./users.php?source=add">Dodaj</a>
                            </li>
                            <li>
                                <a href="./users.php">Zobacz wszystkich</a>
                            </li>
                        </ul>
                    </li>
					<li >
                        <a href="./profile.php"><i class="fas fa-user"></i> Profil</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>