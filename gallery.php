<?php
  // create short variable names
  $name = $_POST['photoname_'];
  $date = (int) $_POST['date_'];
  $date = date('H:i, jS F Y');
  $photographer = $_POST['photographer_'];
  //$location = $_POST['location_']
  $location = preg_replace('/\t|\R/',' ',$_POST['location_']);
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>


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
            <form action="index.html" method = "post">
            <button type="uploadPhoto" class= "btn btn-primary" name="uploadPhoto">Upload Photo</button> 
            </form>  
      </div>
      </body>
      </html>




<!-- Store data from text-box to a file -->
<?php

  $outputstring = $name." ".$date."\t".$photographer." ". $address."\n";
  @$fp = fopen("$document_root/data.txt", 'ab');

  

  if (!$fp) {
    echo "<p><strong> Your request could not be processed at this time.
          Please try again later.</strong></p>";
    exit;
  }

  flock($fp, LOCK_EX);
  fwrite($fp, $outputstring, strlen($outputstring));
  flock($fp, LOCK_UN);
  fclose($fp);

  echo "<p>data written.</p>";

?>



<!-- Sort strings from the file and output them to html -->

<?php
    $path = "data.txt";
    // $photoname_ = trim($_POST['photoname_']);
    // $email = trim($_POST['date_']);
    // $name = trim($_POST['photographer_']);
    // $location = trim($_POST['location_']);

    $counter = 1;

    $strings = file("data.txt")

    // count the number of photos in the array
    $number_of_photos = count($strings);


    // Check if number of photos are empty
    if ($number_of_photos == 0) {
      echo "<p><strong>No photos.<br />
            Please try again later.</strong></p>";
    } else {
      
      $counter = 1;

    }


  ?>
   
<?php
    //Add each lines from data file to an array
    $filename = "data.txt";
    $fp = @fopen($filename, "r");
    if ($fp) {
      $arr = explode("\n", fread($fp, filesize($filename)));
    }
?>

  <?php
    //Sorting by id
    // $('.sorting').click(function()){

    //   $('#id').text($(this).text())

    //   var i = $this.text;


    $dom = new DomDocument();
    @$dom->loadHTML($dom);

    

      if(i == 'name'){

        array_sort($arr, 'name', SORT_ASC));

      }
      if(i == 'location'){

        array_sort($arr, 'location', SORT_ASC));

      }

      if(i == 'dateTaken'){

        array_sort($arr, 'dateTaken', SORT_ASC));


      }

      if(i == 'photographer'){

        array_sort($arr, 'photographer', SORT_ASC));


      }


    }
    
 echo "I think it works"
 
?>