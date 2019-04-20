

<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Graphic Novel Subtitles</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color: black;">

<div class="container-fluid">

  

  <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary mb-4">
        <a class="navbar-brand" href="#">GNS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link" href="help.php">Help</a>
                </div>
              </div>
      </nav>



  <div class="container">

    <h1 class="text-center mb-5 mt-5 pt-5" style="color: white;">Graphic Novel Subtitles</h1>

    

    




    <div class="container">
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8  col-sm-12 " style="float: none; margin: 0 auto;">
            <h4 style="color: white;">Select your video file</h4>
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary">
                  Browse&hellip; <input type="file" name ="file" id="file" style="display: none;" multiple>
                </span>
              </label>
              <input type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8 col-sm-12" style="float: none; margin: 0 auto;">
            <h4 style="color: white;">Select your subtitle file</h4>
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary">
                  Browse&hellip; <input type="file" name ="file2" id="file2" style="display: none;" multiple>
                </span>
              </label>
              <input type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">

          <div class="col-lg-2 col-sm-4 col-4" style=" float: none; margin: 0 auto; margin-top: 20px;">
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Go</button>
          </div>
        </div>
      </form>
    </div>
    <script>
      $(function() {

      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;
              if( input.length ) {
                input.val(log);
              } else {
                if( log ) alert(log);
              }
          });
        });
      });
    </script>
  </div>
</div>


<footer class="page-footer font-small blue">

  
  <p class="text-center mt-4" style="color:grey;">Created by Marcus Robertson-Jones<p>
  
  

</footer>





</body>
</html>
