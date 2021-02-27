<?php

$file = "data.txt";

$current = file_get_contents($file);

$current .= $_POST['name'];
$current .= "\n";
$current .= $_POST['date'];
$current .= "\n";
$current .= $_POST['artist'];
$current .= "\n";
$current .= $_POST['location'];
$current .= "\n";

// Writing the contents back to the file
file_put_contents($file, $current);
$contents = file($file);

print_r($contents);

// Write the contents back to the file
if(isset($_FILES['fileToUpload'])){
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/".$_FILES["fileToUpload"]["name"]);
}

header("Location: gallery.php");
 ?>