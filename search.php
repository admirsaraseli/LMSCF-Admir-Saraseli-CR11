<?php
	include "actions/db_connect.php";
	$search = $_POST["search"];
	$sql = "SELECT * FROM animals 
		WHERE `name` LIKE '%$search%'
		OR age LIKE '%$search%' 
	    OR `description` LIKE '%$search%' 
	    OR `type` LIKE '%$search%' 
	    OR `hobbies` LIKE '%$search%' 
	    OR `location` LIKE '%$search%' 
	    ";
	
	$result = mysqli_query($conn, $sql);
	if($result->num_rows == 0){
		echo "No result";
	}elseif($result->num_rows == 1){
		$row = $result->fetch_assoc();
		echo "
		<div class='col mb-4'>
			<div class='card px-1 py-1 bg-light h-100'>
				<h3 class='card-title'>Meet: ". $row['name']." </h3>
				<img src='" .$row['image']." ' class='card-img-top' alt='...' >
				<div class='card-body'>
					<p class='card-text'>". $row['description']."</p>
					<h6 class='card-text'>Type: <span class='text-info mr-3'>".$row['type'].",</span>
					Age:<span class='text-info'> ".$row['age']."</span></h6>
					<h6 class='card-text'>Hobbies: <span class='text-info'>".$row['hobbies']."</span> </h6>
					<h6 class='card-text'>Address: <span class='text-info'>".$row['location']."</span> </h6>      
				</div>
				<div class='card-footer text-center p-1'>
					<a href='adopt.php?id=".$row['animal_id']."' class='btn btn-outline-success  mx-auto '>Take me home</a>
				</div>
			</div>
		</div>";
	}else {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			echo "
			<div class='col mb-4'>
				<div class='card px-1 py-1 bg-light h-100'>
					<h3 class='card-title'>Meet: ". $row['name']." </h3>
					<img src='" .$row['image']." ' class='card-img-top' alt='...' >
					<div class='card-body'>
						<p class='card-text'>". $row['description']."</p>
						<h6 class='card-text'>Type: <span class='text-info mr-3'>".$row['type'].",</span>
						Age:<span class='text-info'> ".$row['age']."</span></h6>
						<h6 class='card-text'>Hobbies: <span class='text-info'>".$row['hobbies']."</span> </h6>
						<h6 class='card-text'>Address: <span class='text-info'>".$row['location']."</span> </h6>      
					</div>
					<div class='card-footer text-center p-1'>
						<a href='adopt.php?id=".$row['animal_id']."' class='btn btn-outline-success  mx-auto '>Take me home</a>
					</div>
				</div>
			</div>";
		}
	}
?>