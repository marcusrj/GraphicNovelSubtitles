
<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Graphic Novel Subtitles</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>




</head>

<div class="container-fluid">
  <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary mb-4">
        <a class="navbar-brand" href="#">GNS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link" href="index.php">Home</a>
                  <a class="nav-item nav-link" href="help.php">Help</a>
                </div>
              </div>
      </nav>




<body  style="background-color: black;">

<div class="container">


<?php

    //require __DIR__ . '/vendor/autoload.php';
    require_once 'vendor/autoload.php';
    use \Benlipp\SrtParser\Parser;
    //use \FFMpeg\FFMpeg;
    //use vendor\Benlipp\SrtParser\;
    
    $vidname;
    $subname;


    if(isset($_POST['submit'])){

        $vidname = $_FILES['file']['name'];
        $temp_name  = $_FILES['file']['tmp_name'];
        
      
        if(isset($vidname)){
            if(!empty($vidname)){
                $location = 'upload/';
                if(move_uploaded_file($temp_name, $location.$vidname)){
                    echo 'File uploaded successfully';
                }
            }
        }  else {
            echo 'You should select a file to upload !!';
        }
        //print_r($_FILES);
        $subname = $_FILES['file2']['name'];
        $temp_name  = $_FILES['file2']['tmp_name'];
        
        if(isset($subname)){
            if(!empty($subname)){
                $location = 'upload/';
                if(move_uploaded_file($temp_name, $location.$subname)){
                    echo 'File uploaded successfully';
                }
            }
        }  else {
            echo 'You should select a file to upload !!';
        }
        //print_r($_FILES);


    }

    $parser = new Parser();

    $parser->loadFile('upload/' . $subname);

    $captions = $parser->parse();   

    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open('upload/'. $vidname);

    $counter = 0;
    $imageName;
    ?>




    <h1 class="text-center mb-4 mt-5 pt-5" style="color: white;">Graphic Novel Subtitles</h1>

    
    <div class="row form-group">
    <?php
    foreach($captions as $caption){

      //  echo "Start Time: " . $caption->startTime;
     //       echo "End Time: " . $caption->endTime;
       // echo "Text: " . $caption->text;

     $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($caption->startTime + 0.2));
     $imageName = "images/number" . $counter . ".jpg";
     $frame->save($imageName);

     $numOfCols = 3;
     $rowCount = 0;
     $bootstrapColWidth = 12 / $numOfCols;
     ?>
    
     

       
    <div class="col-md-<?php echo $bootstrapColWidth; ?> mt-100">
            <div class="card bg-dark mb-4 pb-2 pt-2 pl-2 pr-2">
               <!-- <img class="card-img-top img-fluid" src="<?php// echo $imageName ?>" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"><?php //echo $caption->text?></p>
                </div>
            </div>
        </div> -->


        <div class="card bg-dark text-white" style="margin-bottom: 50">
            <img class="card-img" src="<?php echo $imageName ?>" alt="Card image">
            <div class="card-img-overlay h-100 d-flex flex-column justify-content-end">
                <!--<h5 class="card-title">Card title</h5>-->
                <p class="card-text" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;!important"><?php echo $caption->text?></p>
               
            </div>
        </div>
</div>
    </div>
    <?php



    
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
    
?>

    

<?php

     $counter = $counter + 1;
        if($counter == 200)
        {
            break;
        }
    }

    if($ffmpeg){
    echo "test 4";
    }

?>

<footer class="page-footer font-small blue">

  
  <p class="text-center mt-4" style="color:grey;">Created by Marcus Robertson-Jones<p>
  
  

</footer>


</div>
</div>




</body>
</html>


