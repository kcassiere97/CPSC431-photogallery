<!DOCTYPE html>
<?php

/*$photoname = $_POST['photoname'];
$date = $_POST['date'];
$photographer = $_POST['photographer'];
$location = $_POST['location'];
$file = $_POST['file'];

 if(empty($photoname) || empty($date) || empty($photographer) || empty($location) || empty($file)) {
  header("Location: ../assignment2/index.php?gallery=empty");
  exit();
} else {
  header("Location: ../assignment2/gallery.php");
  exit();
}*/

?>
<html lang = "en"> 
  <head>
    <title>Viewing Your Photos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=dvice-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="color.css">
</head>
 
  <body>
 
  <!-- Page Content -->
  <div class="container">
    <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">View all photos</h1>
    <form action="gallery.php">
        <label for="sorting">Sort By:</label>
        <select name="sortby" id="sorting">
          <option value="NAME">Name</option>
          <option value="DATE_TAKEN">Date Taken</option>
          <option value="LOCATION">Location</option>
          <option value="PHOTOGRAPHER">Photographer</option>
        </select>          
        <button type="submit" value="Submit"> Submit </button>
      </form> 
    <div class="float-right pt-3 ">
      <a href="index.html" class="btn btn-primary">Upload Photo</a>
    </div>
 
    <hr class="mt-2 mb-5">
    
    <div class="row text-center text-lg-left">
    
    <?php

     // Allows database credentials to be used from separate file
     include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/assignment2/credentials.php');
     $document_root = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
     $document_root = $document_root.'/assignment2/uploads/';
     $uploadOK = true;
     $dsn = "mysql:host=$dbServer;dbname=$dbName";
 
     // Sorting variable
     $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';
 
     // Variable for uploads folder
     $user_uploads = "uploads/";
     if (!file_exists($user_uploads)) {
       mkdir($user_uploads, 0777);
     }
 
     // Setting the POST of user input into data fields into associated variables
     if (isset($_POST['submit'])) {
  
       $file = $_FILES['file'];
       $fileTmpName = $_FILES['file']['tmp_name'];
       $file_type = $_FILES['foreign_character_upload']['type']; //returns the mimetype
  
       $check = getimagesize($fileTmpName);
  
       $photoname = isset($_POST['photoname']) ? $_POST['photoname'] : '';
       $date = isset($_POST['datetaken']) ? $_POST['datetaken'] : '';
       $photographer = isset($_POST['photographer']) ? $_POST['photographer'] : '';
       $location = isset($_POST['location']) ? $_POST['location'] : '';
  
       // Writing image into uploads folder 
       if ($check !== false) {
           move_uploaded_file($_FILES['file']['tmp_name'], $user_uploads . $_FILES['file']['name']);
          $img = "uploads/" . $_FILES['file']['name'];

         /*
          * Insert image data into database
          */

         try{

          $db = new PDO($dsn, $dbUsername, $dbPassword);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          //Insert image content into database
          $insert = $db->query("INSERT into Images (Image_File, Image_Name, Date_Taken, Photographer, Location_Taken) 
          VALUES ('$img', '$photoname', '$date', '$photographer', '$location')");
          
        }catch(PDOException $e){
          echo "ERROR: ".$e->getMessage();
        }
        unset($db);
      }
     }
 
     // Create connection
     $conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);
     try {
      $db = new PDO($dsn, $dbUsername, $dbPassword); 
 
     // Check connection
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
      }
             
        // Sorting by Name
        if ($sortby == 'NAME'){
          $sql = "SELECT * FROM Images ORDER BY Image_Name";
        }
        // Sorting by Date 
        else if ($sortby == 'DATE_TAKEN') {
          $sql = "SELECT * FROM Images ORDER BY Date_Taken";
        } 
        // Sorting by Photographer
        else if ($sortby == 'PHOTOGRAPHER') {
          $sql = "SELECT * FROM Images ORDER BY Photographer";
        } 
        // Sorting by location
        else if ($sortby == 'LOCATION') {
          $sql = "SELECT * FROM Images ORDER BY Location_Taken";
        }
        else {
          $sql = "SELECT * FROM Images";
        }
 
        $result = $conn->query($sql);
 
      if ($res = mysqli_query($conn,$sql)){
        if(mysqli_num_rows($res)){

        // Outputting the user's input into the gallery
        while($row = $result->fetch_assoc()) {
          echo '<div class="col-lg-3 col-md-4 col-6">';
          echo '<a class="d-block mb-4 h-100">';
          echo '<img class="img-fluid img-thumbnail" src="' . $row['Image_File'] . '" /><br />';
          echo '<h4>Name: ' . $row['Image_Name'] . ' </h4>';
          echo '<h4>Date: ' . $row['Date_Taken'] . ' </h4>';
          echo '<h4>Photographer: ' . $row['Photographer'] . ' </h4>';
          echo '<h4>Location: ' . $row['Location_Taken'] . ' </h4>';
          echo '</a>';
          echo '</div>';
        }
        mysqli_free_result($res);
      } else {
        echo "0 results";
      }
    }
      // disconnect from database
      $db = NULL;
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      exit;
    }

      ?>
    </div>
  </div>
</body>
</html>