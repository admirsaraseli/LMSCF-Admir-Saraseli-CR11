<?php
	$conn = mysqli_connect("localhost","root","","ajax");
​
	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"
​
	$sql = "SELECT * FROM ajax WHERE name LIKE '%$search%'";
​
	$result = mysqli_query($conn, $sql);
​
	if($result->num_rows == 0){
		echo "No result";
	}elseif($result->num_rows == 1){
		$row = $result->fetch_assoc();
		echo $row["name"];
	}else {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			echo $row["name"] . "<br>";
		}
	}
​
?>