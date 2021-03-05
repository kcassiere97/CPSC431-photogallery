<html>
    <meta charset="utf-8">
    <head>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="color.css">

    <style type="text/css">
    table, th, td {
      border-collapse: collapse;
      border: 1px solid black;
      padding: 6px;
    }

    th {
      background: #ccccff;      
    }
    </style>


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

  if (isset($_POST['submit'])) {
    // initializing variables
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileDestination ="uploads/".$fileName;




    //Extract photo files to $photoFileNames
      // $fileNames = array();
      // $photoFileNames = array();
      // $fileNames = scandir($document_root);
      // for($i = 0; $i < count($fileNames); $i++){

      //   if(preg_match('/^.+\.jpg|^.+\.png$/', $fileNames[$i], $matches))
      //   array_push($photoFileNames, $matches[0]);
    
      // }

      move_uploaded_file($fileTmpName, $fileDestination);

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

?>

<!-- made made a photo class, put all the photo objs in an array and wrote a 
function using the php usort function that sorts by properties of those objects,
 passed it the array and boom sorted -->

<!-- Sort strings from the file and output them to html -->

<?php
      //Read in the entire file
      //Each order becomes an element in the array
      $data= file("data.txt");
    
      // count the number of orders in the array
      $number_of_pics = count($data);
    
      if ($number_of_pics == 0) {
        echo "<p><strong>No Pictures.<br />
              Please try again later.</strong></p>";
      } 
      
                if($number_of_pics){

                  echo "<table>";

            foreach ($data as $data){

                  $mer = list($photoname, $datetaken, $photographer, $location, "uploads/'.$file.'") = explode(" ", $data);

                  $file = trim($file);
                  $ext = pathinfo($file,PATHINFO_EXTENSION)
                  $datetaken = trim($datetaken)
                  $location = trim($location)
                  $photographer = trim($photographer)

                

                  echo "<tr>";
                  echo "<th>Picture: </th>";
                  echo "<th>Date:</th>";
                  echo "<th>Location: </th>";
                  echo "<th>Photographer:</th>";
                  echo "</tr>";


                  echo "<tr>"
                  echo "<td><img src = "uploads/'.$file.'" width = 150 height = 150></td>"
                  echo "<td style=\"text-align: right;\">$datetaken</td>"
                  echo "<td style=\"text-align: right;\">$location</td>"   
                  echo "<td style=\"text-align: right;\">$photographer</td>"
                  echo "</tr>"

                  }

                  array_multisort(array_column($mer, 0), SORT_DESC, $mer);

                  echo "</table>";

            }
?>



