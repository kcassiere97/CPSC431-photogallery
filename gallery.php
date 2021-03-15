<!DOCTYPE html>

<?php
// Sorting variable
$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';
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
    
    <?php
    // Setting the POST of user input into data fields into associated variables
    if (isset($_POST['submit'])) {
      $file = $_FILES['file'];
      $fileTmpName = $_FILES['file']['tmp_name'];

      $check = getimagesize($fileTmpName);

      $photoname = isset($_POST['photoname']) ? $_POST['photoname'] : '';
      $date = isset($_POST['datetaken']) ? $_POST['datetaken'] : '';
      $photographer = isset($_POST['photographer']) ? $_POST['photographer'] : '';
      $location = isset($_POST['location']) ? $_POST['location'] : '';

      // Writing image into uploads folder and data into info.txt
      if ($check !== false) {
          move_uploaded_file($_FILES['file']['tmp_name'], $user_uploads . $_FILES['file']['name']);
          $img = "uploads/" . $_FILES['file']['name'];
        /*
         * Insert image data into database
         */

        //DB details
        $dbHost     = "mariadb";
        $dbUsername = "cs431s16";
        $dbPassword = "cieyieC4";
        $dbName     = "cs431s16";

        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        // Check connection
        if($db->connect_error){
          die("Connection failed: " . $db->connect_error);
        }

         //Insert image content into database
         $insert = $db->query("INSERT into Images (Image_File, Image_Name, Date_Taken, Photographer, Location_Taken) 
         VALUES ('$img', '$photoname', '$date', '$photographer', '$location')");
         if($insert){
           echo "File uploaded successfully.";
         }else{
           echo "File upload failed, please try again.";
         } 
       }else{
         echo "Please select an image file to upload.";
        }
    }
    $db->close();

    ?>
    <div class="row text-center text-lg-left">
    
    <?php
   /*
    // connect to database
    try {
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
      
      // perform query
      $query = "SELECT Image_File, Image_Name, Date_Taken, Photographer, Location_Taken FROM Images";  
      $stmt = $db->prepare($query);  
      $stmt->execute();   // display each returned row
    while($result = $stmt->fetch(PDO::FETCH_OBJ)) {                                                       
    echo $result->Image_File;                            
    echo "<br />Name: ".$result->Image_Name;                                              
    echo "<br />Date Taken: ".$result->Date_Taken;                                                  
    echo "<br />Photographer: ".$result->Photographer;
    echo "<br />Location: ".$result->Lcoation_Taken"</p>";                                         
  }   
  $stmt->free_result();
  $db->close();
    
}*/





      /*if (isset($_POST['submit'])) {
        $file = $_FILES['file'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        
        // create short variable names
        $img = "uploads/" . $_FILES['file']['name'];
        $name=$_POST['photoname'];
        $date=$_POST['datetaken'];
        $photog=$_POST['photographer'];
        $location=$_POST['location'];


      @$db = new mysqli("mariadb", "cs431s16", "cieyieC4", "cs431s16");

    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }

    $query = "INSERT INTO Images VALUES ($img, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssd', $img, $name, $date, $photog, $location);
    $stmt->execute();

     //Insert image content into database
     $insert = $db->query("INSERT into Images (Image_File, Image_Name, Date_Taken, Photographer, Location_Taken) 
     VALUES ('$img', '$name', '$date', '$photog', '$location')");
     if($insert){
         echo "File uploaded successfully.";
     }else{
         echo "File upload failed, please try again.";
     } 
 }else{
     echo "Please select an image file to upload.";
 }
    if ($stmt->affected_rows > 0) {
        echo  "<p>Book inserted into the database.</p>";
    } else {
        echo "<p>An error has occurred.<br/>
              The item was not added.</p>";
    }
  
    $db->close();
  }*/

    // Variable for uploads folder
    /*
    $user_uploads = "uploads/";
    if (!file_exists($user_uploads)) {
      mkdir($user_uploads, 0777);
    }

    // Setting the POST of user input into data fields into associated variables
    if (isset($_POST['submit'])) {
      $file = $_FILES['file'];
      $fileTmpName = $_FILES['file']['tmp_name'];

      $check = getimagesize($fileTmpName);

      $photoname = isset($_POST['photoname']) ? $_POST['photoname'] : '';
      $date = isset($_POST['datetaken']) ? $_POST['datetaken'] : '';
      $photographer = isset($_POST['photographer']) ? $_POST['photographer'] : '';
      $location = isset($_POST['location']) ? $_POST['location'] : '';

      // Writing image into uploads folder and data into info.txt
      if ($check !== false) {
          move_uploaded_file($_FILES['file']['tmp_name'], $user_uploads . $_FILES['file']['name']);

          $img = "uploads/" . $_FILES['file']['name'];
          $filename = "info.txt";
          $photoInfo = $img . '|' . $photoname . '|' . $date . '|' . $photographer . '|' . $location . "\n";

          file_put_contents($filename, $photoInfo, FILE_APPEND);
      }else {
        echo "File is not an image.";
      }
    }
    ?>

    <div class="row text-center text-lg-left">
      <?php
      // Ouputing the data
      $file = explode("\n", file_get_contents("info.txt"));
      $array = [];

      // Putting the data into an array
      foreach ($file as $line) {
        list($image, $photoname, $date, $photographer, $location) = explode("|", $line);
        $array[] = array(
          'image' => $image, 'photoname' => $photoname, 'date' => $date, 'photographer' => $photographer,
          'location' => $location
        );
      }

      // Sorting by Name
      if ($sortby == 'NAME'){
        usort($array, function ($a, $b) {
          return strcmp($a['photoname'], $b['photoname']);
        });
      }
      // Sorting by Date 
      else if ($sortby == 'DATE_TAKEN') {
        usort($array, function ($a, $b) {
          return strcmp($a['date'], $b['date']);
        });
      } 
      // Sorting by Photographer
      else if ($sortby == 'PHOTOGRAPHER') {
        usort($array, function ($a, $b) {
          return strcmp($a['photographer'], $b['photographer']);
        });
      } 
      // Sorting by location
      else if ($sortby == 'LOCATION') {
        usort($array, function ($a, $b) {
          return strcmp($a['location'], $b['location']);
        });
      }

      // Outputting the user's input into the gallery
      for($i = 0; $i < count($array); $i++){
        if (
          !empty($array[$i]['image']) && !empty($array[$i]['photoname'])
          && !empty($array[$i]['date']) && !empty($array[$i]['photographer']) && !empty($array[$i]['location'])
        ) {
          
          echo '<div class="col-lg-3 col-md-4 col-6">';
          echo '<a class="d-block mb-4 h-100">';

          echo '<img class="img-fluid img-thumbnail" src="' . $array[$i]['image'] . '" /><br />';
          echo '<h4>Name: ' . $array[$i]['photoname'] . ' </h4>';
          echo '<h4>Date Taken: ' . $array[$i]['date'] . ' </h4>';
          echo '<h4>Photographer: ' . $array[$i]['photographer'] . ' </h4>';
          echo '<h4>Location: ' . $array[$i]['location'] . ' </h4>';
          echo '</a>';
          echo '</div>';
        }
      };*/

      ?>
    </div>
  </div>
</body>
</html>