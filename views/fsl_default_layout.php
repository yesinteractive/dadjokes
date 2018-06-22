<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style css>
      .navbar-custom {
          background-color: #dddddd;
       }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-light navbar-custom ">
  <a class="navbar-brand" href="#">
       <img src="<?php echo url_for('/public/fsl_logo.png')?>" class="img-responsive d-inline-block align-top" alt="Responsive image" style="max-height: 75px;">

  </a>
      <span class="navbar-text">
    FSL: A refreshing micro PHP framework
  </span>
</nav>  
    
   
  <div class="container">
   
    <BR>
    
    <?php echo $content ?>
      <BR><BR>
        <center><img src="<?php echo url_for('/public/fsl.jpeg')?>"></center> <hr>
    <a href="<?php echo url_for('/')?>">Home - Start Session</a> |
    <a href="<?php echo url_for('/showip/', $name)?>">Show IP - Show Session</a> | 
    <a href="<?php echo url_for('/hello/', $name)?>">Hello - Kill Session</a> | 
    <a href="<?php echo url_for('/welcome/', $name)?>">Welcome !</a> | 
    <a href="<?php echo url_for('/are_you_ok/', $name)?>">Are you ok ?</a> | 
    <a href="<?php echo url_for('/how_are_you/', $name)?>">How are you ?</a>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </div> <!-- container end -->
  </body>
</html>
    
