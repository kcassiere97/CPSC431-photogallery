<?php

//Gets the credentials from the other file
include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/assignment2/creds.php');

//Initialization and getting data from POST
$name = trim($_POST['name']);
$date = trim($_POST['date']);
$photographer = trim($_POST['photographer']);
$location = trim($_POST['location']);

$document_root = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
$document_root = $document_root.'/assignment2/uploads/';
$uploadOK = true;
$dsn = "mysql:host=$dbServer;dbname=$dbName";

//Saves the selected dropdown menu index if applicable
$selectedDropbox = trim($_POST['dropbox']);
if($selectedDropbox != ""){

	try{

		$db = new PDO($dsn, $dbUsername, $dbPassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dropdownQuery = "UPDATE Images SET name = :myValue WHERE id = 1";
		$stmt = $db->prepare($dropdownQuery);
		switch ($selectedDropbox) {
			case 'Name':
				$selectedDropbox = "1";
				break;
			case 'Date':
				$selectedDropbox = "2";
				break;
			case 'Location':
				$selectedDropbox = "3";
				break;
			case 'Photographer':
				$selectedDropbox = "4";
				break;
		}
		$stmt->bindParam(':myValue', $selectedDropbox);
		$stmt->execute();

	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
	}
	unset($db);

}

$tableSortValue = 0;

//Checks and runs if the gallery page was opened via the upload page, else, skip over saving data
if($name != "" and $date != "" and $location != "" and $photographer != ""){

	$filecontents = $document_root . basename($_FILES['filecontents']['name']);
	$imageFileType = strtolower(pathinfo($filecontents, PATHINFO_EXTENSION));

	//Check if file is real
	if(isset($_POST["submit"])){

		$check = getimagesize($_FILES["filecontents"]["tmp_name"]);

		if($check !== false){
			$uploadOK = true;
			$img = imagecreatefromjpeg($filecontents);
			$imgResized = imagescale($img , 300, 300);
			imagejpeg($imgResized, $filecontents);

		}
		else
			$uploadOK = false;

	}

	//If legit file and doesnt exist in server directory, save image and meta data
	$before = count(scandir($document_root));
	if($uploadOK and move_uploaded_file($_FILES["filecontents"]["tmp_name"], $filecontents) and $before != count(scandir($document_root))){

		//Save meta data to the database
		try{

			$db = new PDO($dsn, $db_user, $db_pass);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "INSERT INTO Images (fileName, name, date, location, photographer) VALUES (:fileNameTerm, :nameTerm, :dateTerm, :locationTerm, :photographerTerm)";
			$stmt = $db->prepare($query);
			$tmp = basename($_FILES['filecontents']['name']);
			$stmt->bindParam(':fileNameTerm', $tmp);
			$stmt->bindParam(':nameTerm', $name);
			$stmt->bindParam(':dateTerm', $date);
			$stmt->bindParam(':locationTerm', $location);
			$stmt->bindParam(':photographerTerm', $photographer);
			$stmt->execute();

		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
			exit;
		}
		unset($db);
		
	}

}

//Get $tableSortValue from the database
try{

	$db = new PDO($dsn, $dbUsername, $dbPassword);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sortValueQuery = "SELECT name FROM Images WHERE id = 1";
	$stmt = $db->query($sortValueQuery);
	if($stmt->rowCount() > 0){
		$tableSortValue = intval($stmt->fetch()[0]);
	}
	else{
		$tableSortValue = 1;
	}

}catch(PDOException $e){
	echo "Error: ".$e->getMessage();
	exit;
}
unset($db);

//Get meta data from DB and puts it into $allMetaData
$allMetaData = array();
try{

	$db = new PDO($dsn, $dbUsername, $dbPassword);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$metaDataQuery = "SELECT * FROM Images WHERE id <> 1";
	$stmt = $db->query($metaDataQuery);

	$counter = 0;
	while($result = $stmt->fetch(PDO::FETCH_OBJ)){

		$allMetaData[$counter] = array($result->fileName, $result->name, $result->date, $result->location, $result->photographer);
		$counter++;

	}

} catch(PDOException $e){
	echo "Error: ".$e->getMessage();
	exit;
}
unset($db);

?>
<!-- Create Gallery UI -->
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body style="margin: center;"><h1>
  	<th style="font-size: 24px;">View All Photos</th></h1>
  </br>
  	<table style="border: 1px solid black;">
  		<tr></tr>
  		<tr>Sort By: 
  			<form action="gallery.php" method="post">
  		<select name="dropbox" id="dropbox">  
  			<option value="Name" <?=$tableSortValue == 1 ? 'selected="selected"': ''; ?>>Name</option>  
  			<option value="Date" <?=$tableSortValue == 2 ? 'selected="selected"': ''; ?>>Date</option>  
  			<option value="Location" <?=$tableSortValue == 3 ? 'selected="selected"': ''; ?>>Location</option>  
  			<option value="Photographer" <?=$tableSortValue == 4 ? 'selected="selected"': ''; ?>>Photographer</option>  
		</select>
    		<input type="submit" value="Sort" />
    		<a href="index.html">
    		<input id="upload" value = "Upload Image" type="button" onClick="Javascript:window.location.href='http://ecs.fullerton.edu/~cs431s30/assignment2/index.html'" name="Upload Image"></input></a>
    		<input type="hidden" name="name" value="">
    		<input type="hidden" name="date" value="">
    		<input type="hidden" name="photographer" value="">
    		<input type="hidden" name="location" value="">
			</form>
		</tr><tr><br></tr>
		<?php
		//Start printing the images with their metadata. Images will be in rows of 3 elements
		echo "<div class=\"row\">";
		$counter = 0;

		//Sort the metadata based on the selected $tableSortValue
		array_multisort(array_column($allMetaData, $tableSortValue), SORT_ASC, $allMetaData);

		foreach ($allMetaData as $pic) {

			if($counter % 3 == 0){
				echo "<tr>";
			}
			echo "<div class=\"box\"><td><img src= \"uploads/";
			echo trim($pic[0]);
			echo "\" alt =\"img\" class =\"img-responsive\">";

			echo "<h2 style=\"text-align: center;\">".$pic[1]."</h2>";
			echo "<p style=\"text-align: center;\">".$pic[2]."</p>";
			echo "<p style=\"text-align: center;\">".$pic[3]."</p>";
			echo "<p style=\"text-align: center;\">".$pic[4]."</p>";
			
			echo "</td></div>";
			if($counter % 3 == 2)
				echo "</tr>";
			$counter++;
		}
		echo "</div>";

		?>

  	</table>
  </body>
 </html>