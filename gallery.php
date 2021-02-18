<html>
    <meta charset="utf-8">
    <head>
    
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
                <option value="name">Name</option>
                <option value="dateTaken">Date Taken</option>
                <option value="location">Location</option>
                <option value="Photographer">Photographer</option>
              </select>           
              <input type="submit" value="Submit">
            </form>  
            <button type="uploadPhoto" class= "btn btn-primary" name="uploadPhoto">Upload Photo</button>   
      </div>
      </body>
      </html>

<?php
  // create short variable name
  //$document_root = $_SERVER['DOCUMENT_ROOT'];
  //$file_name = $_FILES["fileToUpload"]["name"];
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
/*$path = "data.txt";
$photoname_ = trim($_POST['photoname_']);
$email = trim($_POST['date_']);
$name = trim($_POST['photographer_']);
$location = trim($_POST['location_']);*/
?> 