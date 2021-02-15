<?php
  // create short variable name
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  $file_name = $_FILES["fileToUpload"]["name"];
?>

<!-- Store data from text-box to a file -->
<?php
 $path = 'data.txt';
 if (isset($_POST['photoname_']) && isset($_POST['date_']) && isset($_POST['photographer_']) && isset($_POST['location_'])) {
    $fh = fopen($path,"a+");
    $string = $_POST['photoname_'].' - '.$_POST['data_'].' - '.$_POST['photographer_'].' - '.$_POST['location_'];
    fwrite($fh,$string); // Write information to the file
    fclose($fh); // Close the file
 }
?>

<!-- Sort strings from the file and output them to html -->

<?php
$path = "data.txt";
$photoname_ = trim($_POST['photoname_']);
$email = trim($_POST['date_']);
$name = trim($_POST['photographer_']);
$location = trim($_POST['location_']);)

function 



?> 