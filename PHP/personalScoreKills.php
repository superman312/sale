<?php
if(!isset($_COOKIE["difficulty"])){
	$diff = 1;
}else{
	$diff = $_COOKIE["difficulty"];
}

if(!isset($_COOKIE["currentUser"])){
	echo '<p>No user logged in.</p>';
	return;
}else{
	$account = $_COOKIE["currentUser"];
}

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername,$username, $password, $dbname);
if(!$conn){
	die("Connection Fails: ");
}

$sql = "SELECT Username, Enemies_Killed from highscores WHERE (Username, Difficulty) = ('" . $account . "', '" . $diff . "')";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
	//output data from every row selected
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		echo "<p>" . $row["Username"] . ": " . $row["Enemies_Killed"] . "</p>";
	}
}else {
	echo "0 results";
}

?>