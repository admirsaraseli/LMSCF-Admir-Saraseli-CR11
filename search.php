<?php
	$conn = mysqli_connect("localhost","root","","cr11_admirsaraseli_petadoption");
​
	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"
​
	$sql = "SELECT * FROM animals WHERE name LIKE '%$search%'";
​
	$result = mysqli_query($conn, $sql);
​
	if($result->num_rows == 0){
		echo "No result";
	}elseif($result->num_rows == 1){
		$row = $result->fetch_assoc();
		echo $row["name"]. " " . $row["type"] . " " . $row["age"];
	}else {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			echo $row["name"] . " " . $row["type"] . " " . $row["age"]."<br>";
		}
	}
​
?>