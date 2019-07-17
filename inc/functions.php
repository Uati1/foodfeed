<?php
include("data.php");

class Obj{
    public $count;
    public $page;
}

function posts($query,$search,$where){
    global $connection;
    $per_page = 12;
    $i = 0;
    if(isset($_GET['page'])){
        $page = escape($_GET['page']);
    }else{
        $page = 1;
    }

    if($page == 0 || $page == 1){
        $page_1 = 0;
    }else{
        $page_1 = 12;
    }

    $num = quantity($query);
    $count = ceil($num / $per_page);

    $query1 = "{$query}  LIMIT $page_1,{$per_page} ";
    $select_posts= mysqli_query($connection, $query1);

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $path = $_SERVER['REQUEST_URI'];
        $ids = likes($username);
        if(isset($_GET['p_id'])){
            $po_id = escape($_GET['p_id']);
            if (strpos($path, '?p_id') !== false) {
                if(isset($_GET['dislike'])){
                    $dislike = escape($_GET['dislike']);
                    $trim = str_replace('?p_id='.$po_id.'&dislike='.$dislike, '', $path);
                    dislike($username,$ids,$trim);
                }else {
                    $trim = str_replace('?p_id='.$po_id, '', $path);
                    like($username,$ids,$trim);
                }
            }
            if(strpos($path, '&p_id') !== false){
                if(isset($_GET['dislike'])){
                    $trim = str_replace('&p_id='.$po_id.'&dislike='.$_GET['dislike'], '', $path);
                    dislike($username,$ids,$trim);
                }else{
                    $trim = str_replace('&p_id='.$po_id, '', $path);
                    like($username,$ids,$trim);
                }
            }
        
        }

    }
    
    

    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id= $row['post_id'];
        $post_title= $row['post_title'];
        $post_author= $row['post_author'];
        $post_date= $row['post_date'];
        $post_img= $row['post_img'];
        
        if($i==2){
            ?> <div class="row"><?php
        }

        ?>
        
            
        <div class="col-md-3 post" >
            <div class="helper">
            <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
            <?php if(isset($_SESSION['username'])){
                if(strpos($path, 'search') !== false){
                    if(strpos($path, '?') !== false){
                        if(in_array($post_id,$ids) ){
                            ?><div onclick="myhref('<?php echo $path.'&search='.$search.'&where='.$where.'&p_id='.$post_id.'&dislike=true'; ?>');" class="add liked"><i class="fas fa-heart"></i></div><?php
                        }else{
                            ?><div onclick="myhref('<?php echo $path.'&search='.$search.'&where='.$where.'&p_id='.$post_id; ?>');" class="add "><i class="far fa-heart"></i></div><?php
                        }
                    }else{
                        if(in_array($post_id,$ids) ){
                            ?><div onclick="myhref('<?php echo $path.'?search='.$search.'&where='.$where.'&p_id='.$post_id.'&dislike=true'; ?>');" class="add liked"><i class="fas fa-heart"></i></div><?php
                        }else{
                            ?><div onclick="myhref('<?php echo $path.'?&search='.$search.'&where='.$where.'&p_id='.$post_id; ?>');" class="add "><i class="far fa-heart"></i></div><?php
                        }
                    }
                    $trim = str_replace('&p_id='.$_GET['p_id'], '?search='.$search.'&where='.$where, $path);
                }else{
                    if(strpos($path, '?') !== false){
                        if(in_array($post_id,$ids) ){
                            ?><div onclick="myhref('<?php echo $path.'&p_id='.$post_id.'&dislike=true'; ?>');" class="add liked"><i class="fas fa-heart"></i></div><?php
                        }else{
                            ?><div onclick="myhref('<?php echo $path.'&p_id='.$post_id; ?>');" class="add "><i class="far fa-heart"></i></div><?php
                        }
                    }else{
                        if(in_array($post_id,$ids) ){
                            ?><div onclick="myhref('<?php echo $path.'?p_id='.$post_id.'&dislike=true'; ?>');" class="add liked"><i class="fas fa-heart"></i></div><?php
                        }else{
                            ?><div onclick="myhref('<?php echo $path.'?p_id='.$post_id; ?>');" class="add "><i class="far fa-heart"></i></div><?php
                        }
                    }
                }
                
                
                
            }
            ?>
            
            <div class="description" onclick="myhref('post.php?p_id=<?php echo $post_id; ?>');">
            
                <a class="title" href="post.php?p_id=<?php echo $post_id; ?>" ><?php echo $post_title; ?></a>
                
                
                <?php 
                    if(isset($_SESSION['username'])== $post_author){
                    ?><div class = "logged-box">
                        <a class="edit" href = "./edit.php?p_id=<?php echo $post_id; ?>">Edytuj</a>
                        <a class="delete" onClick="javascript: return confirm('Are you sure you wat to delete ?'); " 
                        href='<?php if(strpos($path, '?') !== false){
                                echo $path."&";
                            }else{
                                echo $path."?";
                            } 
                        ?>delete=<?php echo $post_id?>'>Usuń</a>
                    </div><?php
                    }
                ?>
                <div class="meta">
                    <p class="lead">
                        by <a href="post_author.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p class= "lead"><span class="glyphicon glyphicon-time"></span>added:  <?php echo $post_date; ?></p>
                </div>
            </div>
            </div>
        </div>
        <?php
        if($i===2){
            ?></div><?php
            $i=0;
        }	
    }
    if(isset($submit)){
        if(strpos($path, 'search') !== false){

        } 
    }
    
    $tmp = new Obj();
    $tmp -> count = $count;
    $tmp -> page = $page;

    

    return $tmp;			
}

function pager($count, $page){
    $path = $_SERVER['REQUEST_URI'];
    $sign = "?";
    if (strpos($path, '?') !== false) {
        $sign = "&";
    }
    if(isset($_GET['page'])){
        $trim = str_replace($sign.'page='.$page, '', $path);
    }else{
        $trim = $path;
    }
    
    
    if($page==1){
        $k = 1;
    }else{
        $k= $page-1;
    }

    for( $j =$k; $j <= $k+2 && $j<=$count; $j++){
        if($j == $page){

            echo "<li class='pager'><a class= 'active' href='".$trim.$sign."page={$j}' >{$j}</a></li>";
        }else{
            echo "<li><a href='".$trim.$sign."page={$j}' >{$j}</a></li>";
        }
    }
}
function quantity($query){
    global $connection;
    $posts = mysqli_query($connection, $query);
    $num = mysqli_num_rows($posts);
    return $num;
}

// ulubione

function like($username,$ids,$path){
    global $connection;
    $post_id = escape($_GET['p_id']);
    $string = "";
    
    if(in_array($post_id,$ids) ){

    }else{
        $string = implode(",",$ids);
        $string = $string . $post_id.',';
        $query1 = "UPDATE users SET us_liked = '{$string}' WHERE username = '{$username}' ";
        $update = mysqli_query($connection, $query1);
    }

    header("Location: $path");
}

function dislike($username,$ids,$path){
    global $connection;
    $post_id = escape($_GET['p_id']);
    $string = implode(",",$ids);
    $trim = str_replace($post_id.',', '', $string);
    $query1 = "UPDATE users SET us_liked = '{$trim}' WHERE username = '{$username}' ";
    $update = mysqli_query($connection, $query1);
    header("Location: $path");
}

function likes($username){
    global $connection;
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $liked = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($liked);
    $string= $row['us_liked'];
    $ids = explode(',', $string);
    
    return $ids;
}
function add($author,$trim,$ids,$string,$username){
    global $connection;
   
    if(in_array($author,$ids) ){
    }else{
        $string = $string . $author.',';
        $query1 = "UPDATE users SET us_authors = '{$string}' WHERE username = '{$username}' ";
        $update = mysqli_query($connection, $query1);
    }

    header("Location: $trim");

}
function delete($author,$trim,$ids,$string,$username){
    global $connection;
    
    if(in_array($author,$ids) ){
        $string = str_replace($author.",", '', $string);
        $query1 = "UPDATE users SET us_authors = '{$string}' WHERE username = '{$username}' ";
        $update = mysqli_query($connection, $query1);
    }else{
    }

    header("Location: $trim");

}
if(isset($_GET['delete'])){

    $path = $_SERVER['REQUEST_URI'];
    
    $post_id = escape($_GET['delete']);
    if(strpos($path, '&') !== false){
        $trim = str_replace('&delete='.$post_id, '', $path);
    }else{
        $trim = str_replace('delete='.$post_id, '', $path);
    }

	$query = "DELETE FROM posts WHERE post_id = {$post_id} ";
	$delete_query = mysqli_query($connection, $query);


	header("Location: {$trim}");

}

?>

