<?php
// Retreiving user's image
  if (isset($_POST['submit'])) {
        // initializing variables
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileDestination ="user_uploads/".$fileName;

        move_uploaded_file($fileTmpName, $fileDestination);
        /*$fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // files allowed to upload
        $allowed = array('jpg', 'jpeg', 'png');

        // check if file has proper extentions 
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0) {
                if ($fileSize < 100000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'user_uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: gallery.php?uploadsuccess");
                } else {
                    echo "File too thicc";
                }
            } else { 
                echo "There was an error uploading your file. rip";
            }
        } else {
            echo "Sorry Bruv, you can't upload files of this type";
        }*/

    // Storing user's image details to data.txt
    extract($_REQUEST);
    $file=fopen("data.txt","a");
    
    //fwrite($file, $fileNameNew);
    fwrite($file,"Photo Name: ");
    fwrite($file, $photoname ."\n");
    fwrite($file, "Date Taken: ");
    fwrite($file, $datetaken . "\n");
    fwrite($file, "Photographer: ");
    fwrite($file, $photographer ."\n");
    fwrite($file, "Location: ");
    fwrite($file, $location ."\n");
    fclose($file);

    //$user_data = array($photoname, $datetaken, $photographer, $location, "user_uploads/'.$file.'");
    $user_data = array($photoname);
    }
?>  

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
  
  <body class="container">
    <div class="center">
      <h1 class ="p1">View All Photos</h1>
      <form action="gallery.php">
        <label for="sorting" class ="p1">Sort By:</label>
        <select name="sorting" id="sorting">
          <option value="name">Name</option>
          <option value="dateTaken">Date Taken</option>
          <option value="location">Location</option>
          <option value="Photographer">Photographer</option>
        </select>          
        <input type="submit" value="Submit">
      </form>  
      <form action="index.php" method = "POST">
        <button type="uploadPhoto" class= "btn btn-primary" name="uploadPhoto">Upload Photo</button> 
      </form> 
      <table style = "width:100%">
      <tr>
      <td>
      <!-- printing out the user's input into table -->
        <?php
        /*foreach($user_data as $x){
          $folder = "user_uploads/";
          if (is_dir($folder)) {
            if ($open = opendir($folder)) {
              while ($file = readdir($open)) {
                if ($file == '.' || $file == '..') continue;
                echo ' <img src = "user_uploads/'.$file.'" width = "150" height = 150 >';
              }
             closedir($open);
            }
          } 
*/
          $file = "data.txt";
          $document = file_get_contents($file);
          $lines = explode("\n",$document);
         // foreach($lines as $newline){
            foreach($user_data as $newline){
            $folder = "user_uploads/";
            if (is_dir($folder)) {
              if ($open = opendir($folder)) {
                while ($file = readdir($open)) {
                  if ($file == '.' || $file == '..') continue;
                  echo ' <img src = "user_uploads/'.$file.'" width = "150" height = 150 >';
                  echo '<br>'. "Photo Name: " .  $photoname . '<br>';
                  echo '<br>'. "Date Taken: " . $datetaken . '<br>';
                  echo '<br>'. "Photographer: " . $photographer . '<br>';
                  echo '<br>'. "Location: " . $location . '<br>';
                }
               closedir($open);
              }
            } 
          //  echo $lines;
            
           // echo '<br>'. $newline . '<br>';
          }
        
        ?>
        </td>
            </tr>
      </table>
    </div>
</body>
</html> 

<!-- Sort strings from the file and output them to html -->

<?php
/*
  $user_data = array($name, $datetaken, $photographer, $location);
  class gallery {
      function compare($user_data){
        while(count($user_data) != NULL){
          if($user_data[i] == 'name'){
            array_sort($user_data, 'name', SORT_ASC);
          }
          if($user_data[i] == 'location'){
            array_sort($user_data, 'location', SORT_ASC);
          }
          if($user_data[i] == 'dateTaken'){
            array_sort($user_data, 'dateTaken', SORT_ASC);
          }
          if($user_data[i] == 'photographer'){
            array_sort($user_data, 'photographer', SORT_ASC);
          }
        }
      }
    }*/
  ?>

<?php
/*
    if (isset($_POST['submit'])) {
        // initializing variables
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // files allowed to upload
        $allowed = array('jpg', 'jpeg', 'png');

        // check if file has proper extentions and storing the file into user_uploads folder
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0) {
                if ($fileeSize < 100000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'user_uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: gallery.php?uploadsuccess");
                } else {
                    echo "File too thicc";
                }
            } else { 
                echo "There was an error uploading your file. rip";
            }
        } else {
            echo "Sorry Bruv, you can't upload files of this type";
        }
    }

    // Storing user's input to data.txt 
    extract($_REQUEST);
    $file=fopen("data.txt","a");

    fwrite($file,"Photo Name: ");
    fwrite($file, $photoname ."\n");
    fwrite($file, "Date Taken: ");
    fwrite($file, $datetaken . "\n");
    fwrite($file, "Photographer: ");
    fwrite($file, $photographer ."\n");
    fwrite($file, "Location: ");
    fwrite($file, $location ."\n");
    fclose($file);
    header("Location: gallery.php");
?>  

<!DOCTYPE html>
<html lang = "en">
  <head>
    <title>Viewing Your Photos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="color.css">
  </head>
  
  <body class="container">
    <div class="center">
      <h1 class ="p1">View All Photos</h1>
      <form action="gallery.php">
        <label for="sorting" class ="p1">Sort By:</label>
        <select name="sorting" id="sorting">
          <option value="userName">Name</option>
          <option value="dateTaken">Date Taken</option>
          <option value="location">Location</option>
          <option value="photographer">Photographer</option>
        </select>          
        <input type="submit" value="Submit">
      </form>  
      <form action="index.html" method = "POST">
        <button type="uploadPhoto" class= "btn btn-primary" name="uploadPhoto">Upload Photo</button> 
      </form> 
    </div>
  </body>
</html>   */ 
