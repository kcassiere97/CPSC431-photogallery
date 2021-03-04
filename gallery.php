<!DOCTYPE html>
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

    <!--<div class="dropdown d-inline-block pt-3 ">
      <span>Sort by: </span>
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Select
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" name="photoName" href="#">Name</a>
        <a class="dropdown-item" name="dateTaken" href="#">Date Taken</a>
        <a class="dropdown-item" name="photographerName" href="#">Photographer</a>
        <a class="dropdown-item" name="locationTaken" href="#">Location</a>
      </div>
    </div> -->
    <form action="gallery.php">
        <label for="sorting" class ="p1">Sort By:</label>
        <select name="sortby" id="sorting">
          <option value="NAME">Name</option>
          <option value="DATE_TAKEN">Date Taken</option>
          <option value="LOCATION">Location</option>
          <option value="PHOTOGRAPHER">Photographer</option>
        </select>          
        <input type="submit" value="Submit">
      </form> 
    <div class="float-right pt-3 ">
      <a href="index.html" class="btn btn-primary">Upload</a>
    </div>

    <hr class="mt-2 mb-5">
    <?php
    $user_uploads = "uploads/";
    if (!file_exists($user_uploads)) {
      mkdir($user_uploads, 0777);
    }
   
    $target_dir = $user_uploads;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if (isset($_POST['submit'])) {
      $file = $_FILES['file'];
      $fileTmpName = $_FILES['file']['tmp_name'];

      $check = getimagesize($fileTmpName);

      $photoname = isset($_POST['photoname']) ? $_POST['photoname'] : '';
      $date = isset($_POST['datetaken']) ? $_POST['datetaken'] : '';
      $photographer = isset($_POST['photographer']) ? $_POST['photographer'] : '';
      $location = isset($_POST['location']) ? $_POST['location'] : '';

      if ($check !== false) {
    
        move_uploaded_file($_FILES['file']['tmp_name'], $user_uploads . $_FILES['file']['name']);
        $uploadOk = 1;

        $img = "uploads/" . $_FILES['file']['name'];
        $filename = "info.txt";
        $photoInfo = $img . '|' . $photoname . '|' . $date . '|' . $photographer . '|' . $location . "\n";

        file_put_contents($filename, $photoInfo, FILE_APPEND);
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    ?>

    <div class="row text-center text-lg-left">
      <?php
      $file = explode("\n", file_get_contents("info.txt"));
     
      foreach ($file as $line) {

        /*if( ! isset($image)){
          $image = null;
        }
        if( ! isset($photoname)){
          $photoname = null;
        }
        if( ! isset($date)){
          $date = null;
        }
        if( ! isset($photographer)){
          $photographer = null;
        }
        if( ! isset($location)){
          $location = null;
        }*/

        list($image, $photoname, $date, $photographer, $location) = explode("|", $line);

        if (!empty($image) && !empty($photoname) && !empty($date) && !empty($photographer) && !empty($location)) {

          echo '<div class="col-lg-3 col-md-4 col-6">';
          echo '<a class="d-block mb-4 h-100">';

          echo '<img class="img-fluid img-thumbnail" src="' . $image . '" /><br />';
          echo '<h2>Name: ' . $photoname . ' </h2>';
          echo '<h2>Date Taken: ' . $date . ' </h2>';
          echo '<h2>Photographer: ' . $photographer . ' </h2>';
          echo '<h2>Location: ' . $location . ' </h2>';
          echo '</a>';
          echo '</div>';
        }
      }

      ?>
    </div>

  </div>
 
</body>
</html>