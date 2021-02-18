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
                      <option id="mer" value="name">Name</option>
                      <option id="mer" value="dateTaken">Date Taken</option>
                      <option id="mer" value="location">Location</option>
                      <option id="mer" value="Photographer">Photographer</option>
                    </select>
                    <br><br>
                    <input type="submit" value="Submit">
                  </form>
                   
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
    $string = $_POST['photoname_'].' - '.$_POST['date_'].' - '.$_POST['photographer_'].' - '.$_POST['location_'];
    fwrite($fh,$string); // Write information to the file
    fclose($fh); // Close the file
 }
?>

<!-- Sort strings from the file and output them to html -->

<?php
    $path = "data.txt";
    // $photoname_ = trim($_POST['photoname_']);
    // $email = trim($_POST['date_']);
    // $name = trim($_POST['photographer_']);
    // $location = trim($_POST['location_']);

    $counter = 1;

    $strings = file("$document_root/data.txt")

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
    $filename = 'data.txt'
    $fp = @fopen($filename, "r");
    if ($fp) {
      $arr = explode("\n", fread($fp, filesize($filename)));
    }
?>

  <?php
    //Sorting by id
    $('.sorting').click(function()){

      $('#id').text($(this).text())

      var i = $this.text;

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