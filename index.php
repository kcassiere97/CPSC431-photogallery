<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>Photo Gallery </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="color.css">
    </head>

    <body class="container">
        <div class="center">
            <h1 class ="p1">Add Photo to Gallery</h1>
            <form action = "gallery.php" method ="POST" enctype="multipart/form-data">
                <section>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <p1>Photo Name: <input type ="text" name="photoname" value =""></p1>
                            </div>
                            <div class="form-group">                  
                                <p1>Date Taken: <input type="text" name="datetaken" value =""></p1>
                            </div>
                            <div class="form-group">
                                <p1>Photographer: <input type="text" name="photographer" value =""></p1>
                            </div>
                            <div class="form-group">            
                                <p1>Location: <input type="text" name="location" value =""></p1>
                            </div>
                            <div class="dropzone">
                                <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                                    <input type="file" name="file">
                                    <button type="submit" name="submit"> UPLOAD </button> 
                            </div>
                        </div>
                    </div>
                </section>
            </form>
    </body>
    </html>
    