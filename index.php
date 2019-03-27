

<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Graphic Novel Subtitles</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h1>Graphic Novel Subtitles</h1>

  <!--
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file"><span>Select your video file:</span></label>
    <label class="btn btn-default btn-file">
         Browse <input type="file" name="file" id="file" style="display: none"/>
    </label>
		<input type="submit" name="submit" value="Go" />

  </form>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file"><span>Select your video file:</span></label>
    <label class="btn btn-default btn-file">
         Browse <input type="file" name="file" id="file" style="display: none"/>
    </label>
		<input type="submit" name="submit" value="Go" />
  </form>
  -->

  <form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-6">
        <h4>Select your video file</h4>
        <div class="input-group">
          <label class="input-group-btn">
            <span class="btn btn-primary">
              Browse&hellip; <input type="file" name ="file" id="file" style="display: none;" multiple>
            </span>
          </label>
          <input type="text" class="form-control" readonly>
      </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-6">
        <h4>Select your subtitle file</h4>
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
  

  <div class="col-lg-6 col-sm-6 col-6" style="margin-top:20px">
  <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Go</button>
  </div>
  </form>


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



</body>
</html>
