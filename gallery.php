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

<!-- read files from text file -->
<?php
    //Add each lines from data file to an array
    $filename = "data.txt";
    $fp = @fopen($filename, "r");
    if ($fp) {
      $my_arr = explode("\n", fread($fp, filesize($filename)));
    }
    // Sort array 
    rsort($my_arr);
    display()
    
?>

<!-- //display to html -->
<script>
function display(){
                for (var i = 0; i < $my_arr.length; i++) {
                        var all = document.querySelectorAll("[id='container']");
              
                         // get the size of the inner array
                         var innerArrayLength = Object.keys(my_arr[i]).length;
             
                
                        // loop the inner array
                        for (var j = 0; j < innerArrayLength; j++) {
                            
                            var imgValue = my_arr[i].img;
                            var nameValue = my_arr[i].name;
                            var photographerValue = my_arr[i].photographer;
                            var dateValue = my_arr[i].date;
                            var locationValue = my_arr[i].location;

                    
                            all[i].querySelector("#name").innerHTML = nameValue;
                            all[i].querySelector("#date").innerHTML = dateValue;
                            all[i].querySelector("#location").innerHTML = locationValue;
                            all[i].querySelector("#photographer").innerHTML = photographerValue;
                            all[i].querySelector("#img").src = 'uploads/' + imgValue;
                        
                        }
               
                
                  }
            }
</script>




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
                <option value="date">Date Taken</option>
                <option value="location">Location</option>
                <option value="Photographer">Photographer</option>
              </select>           
              <input type="submit" value="Submit">
            </form>  
            <form action="index.html" method = "post">
            <button type="uploadPhoto" class= "btn btn-primary" name="img">Upload Photo</button> 
            </form>  
      </div>
      </body>
      </html>



<!-- made made a photo class, put all the photo objs in an array and wrote a 
function using the php usort function that sorts by properties of those objects,
 passed it the array and boom sorted -->

<!-- Sort strings from the file and output them to html -->

<!--  -->



<!-- extra -->

<!-- // $path = "data.txt";
    // // $photoname_ = trim($_POST['photoname_']);
    // // $email = trim($_POST['date_']);
    // // $name = trim($_POST['photographer_']);
    // // $location = trim($_POST['location_']);

    // $counter = 1;

    // $strings = file("data.txt")

    // // count the number of photos in the array
    // $number_of_photos = count($strings);


    // // Check if number of photos are empty
    // if ($number_of_photos == 0) {
    //   echo "<p><strong>No photos.<br />
    //         Please try again later.</strong></p>";
    // } else {
      
    //   $counter = 1;

    // } -->

