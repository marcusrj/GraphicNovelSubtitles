
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
<body  style="background-color: black;">

<div class="container">


<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Secondary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>


</div>


</body>
</html>




<?php

    //require __DIR__ . '/vendor/autoload.php';
    require_once 'vendor/autoload.php';
    use \Benlipp\SrtParser\Parser;
    //use \FFMpeg\FFMpeg;
    //use vendor\Benlipp\SrtParser\;

    if(isset($_POST['submit'])){
        $name       = $_FILES['file']['name'];
        $temp_name  = $_FILES['file']['tmp_name'];
        if(isset($name)){
            if(!empty($name)){
                $location = 'upload/';
                if(move_uploaded_file($temp_name, $location.$name)){
                    echo 'File uploaded successfully';
                }
            }
        }  else {
            echo 'You should select a file to upload !!';
        }
        print_r($_FILES);
        $name       = $_FILES['file2']['name'];
        $temp_name  = $_FILES['file2']['tmp_name'];
        if(isset($name)){
            if(!empty($name)){
                $location = 'upload/';
                if(move_uploaded_file($temp_name, $location.$name)){
                    echo 'File uploaded successfully';
                }
            }
        }  else {
            echo 'You should select a file to upload !!';
        }
        print_r($_FILES);


    }

    $parser = new Parser();

    $parser->loadFile('upload/blackadderTest.srt');

    $captions = $parser->parse();   

 // foreach($captions as $caption){
  //  echo "Start Time: " . $caption->startTime;
 //       echo "End Time: " . $caption->endTime;
 //       echo "Text: " . $caption->text;
 
  //}


   // $cmd = time ffmpeg -ss 1800 -i Video.mp4 -vframes 1 -vcodec png -an -y %d.png

    //shell_exec ( string $cmd ) : string




    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open('BlackadderVidTest.mp4');

    $counter = 0;
    $imageName;
    foreach($captions as $caption){

        echo "Start Time: " . $caption->startTime;
     //       echo "End Time: " . $caption->endTime;
        echo "Text: " . $caption->text;

     $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($caption->startTime));
     $imageName = "images/number" . $counter . ".jpg";
     $frame->save($imageName);

    // echo "<img src=" $frame />
     //echo '<img src="'. $imageName . '"/>';
       // echo "<img src=images/number0.jpg" >


       echo ' 
       
       <div class="card bg-dark mb-3" style="width: 40rem;">
       <img class="card-img-top" src="'. $imageName . '" alt="Card image cap">
       <div class="card-body">
         <p class="card-text">'. $caption->text . '</p>
       </div>
     </div>
     </div> ';

    
     $counter = $counter + 1;
        if($counter == 10)
        {
            break;
        }
    }




    //$frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(42));
    //$frame->save('image.jpg');
    if($ffmpeg){
    echo "test 4";
    }

?>

