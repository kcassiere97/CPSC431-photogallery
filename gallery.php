<!DOCTYPE html>

<?php
// Sorting variable
$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';

// Remove error reportings
error_reporting(0);
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
    // Variable for uploads folder
    $user_uploads = "uploads/";
    if (!file_exists($user_uploads)) {
      mkdir($user_uploads, 0777);
    }
    define('MB', 1048576);
    // Check if image file is a actual image or fake image
    if (isset($_POST['submit'])) {
      $file = $_FILES['file'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];

      $check = getimagesize($fileTmpName);

      $photoname = isset($_POST['photoname']) ? $_POST['photoname'] : '';
      $date = isset($_POST['datetaken']) ? $_POST['datetaken'] : '';
      $photographer = isset($_POST['photographer']) ? $_POST['photographer'] : '';
      $location = isset($_POST['location']) ? $_POST['location'] : '';

      // Writing image into uploads folder and data into info.txt
      if ($check !== false) {
        if ($fileSize < 20*MB){
          move_uploaded_file($_FILES['file']['tmp_name'], $user_uploads . $_FILES['file']['name']);

          $img = "uploads/" . $_FILES['file']['name'];
          $filename = "info.txt";
          $photoInfo = $img . '|' . $photoname . '|' . $date . '|' . $photographer . '|' . $location . "\n";

          file_put_contents($filename, $photoInfo, FILE_APPEND);
        } else {
          echo "File too thicc";
        } 
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
      };

      ?>
    </div>

  </div>
 
</body>
</html>