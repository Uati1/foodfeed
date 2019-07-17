<?php

function escape($string){
	global $connection;
	return mysqli_real_escape_string($connection, trim($string));
}

function check($query){
	global $connection;

	if(!$query){
		die("Query failed" . mysqli_error($connection));
	}


}

function online_users(){
	
	if(isset($_GET['online'])){

		global $connection;
		if(!$connection){
			session_start();

			$connection= mysqli_connect('localhost','root','','foodfeed');
			if(!$connection){
				echo 'not connected';
			}

			$session = session_id();
			$time = time();
			$time_sec = 30;
			$time_out = $time - $time_sec;

			$query = "SELECT * FROM online_users WHERE session = '$session' ";
			$send_query = mysqli_query($connection, $query);
			$counts = mysqli_num_rows($send_query);

			if($counts == NULL){
				mysqli_query($connection, "INSERT INTO online_users(session, time) VALUES('{$session}','{$time}')");
			}else{
				mysqli_query($connection, "UPDATE online_users SET time = '$time' WHERE session = '$session' ");
			}

			$online_query = mysqli_query($connection, "SELECT * FROM online_users WHERE time > '$time_out' ");
			echo $count_users = mysqli_num_rows($online_query);
		}
	}
}

online_users();

function insert_categories(){

	global $connection;

	if(isset($_POST['submit'])){
		$cat_title = $_POST['cat_title'];

		if($cat_title == "" || empty($cat_title)){
			echo "Type sth";
		}else{
			$query = "INSERT INTO category (cat_title) ";
			$query .= "VALUE('{$cat_title}')";

			$create_query = mysqli_query($connection, $query);
			if(!$create_query){
				die('Query failed') . mysqli_error($connection);
			}
		}
	}
}

function find_categories(){
	global $connection;

	$query= "SELECT * FROM category ";
	$select_cat = mysqli_query($connection, $query);

	while($row= mysqli_fetch_assoc($select_cat)){
		$catt= $row['cat_title'];
		$id= $row['cat_id'];
		echo "<tr>";
		echo "<td>{$id}</td>";
		echo "<td>{$catt}</td>";
		echo "<td><a href='categories.php?delete={$id}'>Usuń</a></td>";
		echo "<td><a href='categories.php?edit={$id}'>Edytuj</a></td>";
		echo "</tr>";
	}

}

function delete_categories() {

global $connection;
	if(isset($_GET['delete'])){
											
		$cat_id = $_GET['delete'];
		$query= "DELETE FROM category WHERE cat_id = {$cat_id} ";
		$delete_cat = mysqli_query($connection, $query);
		header("Location: categories.php");
	}
}

?>