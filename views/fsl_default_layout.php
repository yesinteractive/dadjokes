<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo url_for('/public/favicon.ico')?>" type="image/x-icon">
        <link rel="icon" href="<?php echo url_for('/public/favicon.ico')?>" type="image/x-icon"> 
        <title>FSL: Fresh Squeezed Limonade PHP Micro Framework for Microservices, REST API's, and Web apps</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <style css>.navbar-custom {
    background-color: #dddddd;
}

.demo {
    //: absolute;
    //: 0;
}

.demorow {
    margin-bottom: 25px;
    //: 200px;
}</style>
    </head>
    <body>
        <nav class="navbar navbar-light navbar-custom ">
            <a class="navbar-brand" href="https://github.com/yesinteractive/fsl">
                <img src="<?php echo url_for('/public/fsl_logo.png')?>" class="img-responsive d-inline-block align-top" alt="Responsive image" style="max-height: 75px;">
            </a>
            <span class="navbar-text">
    FSL: A refreshing micro PHP framework<BR>
        Version <?php echo option('fsl_version'); ?> </span>
        </nav>         
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="test jumbotron bg-white" style="margin-bottom: 0px; background-image: url(<?php echo url_for('/public/fsl.jpeg')?>);   background-position: right bottom;
  background-repeat: no-repeat;">
            <div class="container">
                <h1 class="display-3">Ahhhhh, refreshing!</h1>
                <p>Congratulations! Your Fresh Squeezed Limonade installation is up and running. <br>For documentation and updates, visit the project page on Github.</p>
                <p><a class="btn btn-primary btn-lg" href="https://github.com/yesinteractive/fsl" role="button">View Project On Github »</a></p>
            </div>
        </div>
        <div class="row bg-dark text-light" style="margin-bottom: 25px;">
            <div class="container">
                <pre class="text-white" style="margin-top: 15px;">
Output:

<?php echo $content ?></pre>
            </div>
        </div>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row demorow">
                <div class="col-md-4">
                    <h2>Start Session</h2>
              
                    <p>Launch page and starts a brand new session in FSL.</p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/')?>" role="button">Try It Now » </a></p>
                    
                </div>
                <div class="col-md-4">
                    <h2>Show Session</h2>
                    <p>Displays the current session info as well as the client's IP address. Also showcases the FSL Encrypt and Decrypt functions.</p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/showip')?>" role="button">Try It Now » </a></p>
                </div>
                <div class="col-md-4">
                    <h2>Kill Session</h2>
                    <p>Kills current session and also showcases use of URI parameterization.&nbsp;</p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/kill')?>" role="button">Try It Now » </a></p>
                </div>
            </div>
            <div class="row demorow">
                <div class="col-md-4">
                    <h2>Microservice (API)</h2>
                    <p>Showcases how FSL can be used to quickly create a microservice API. The example returns JSON as well as a custom HTTP response code.</p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/api')?>" role="button">Try It Now » </a></p>
                </div>
                <div class="col-md-4">
                    <h2>JWT Handling</h2>
                    <p>Showcases how FSL can be used to quickly encode, decode, and verify JWT tokens.</p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/jwt')?>" role="button">Try It Now » </a></p>
                </div>
                <div class="col-md-4">
                    <h2>URI Parameters</h2>
                    <p>Showcases basic functionality of dynamically using URI element as a variable. </p>
                    <p><a class="btn btn-outline-secondary btn-sm" href="<?php echo url_for('/how_are_you/Santa')?>" role="button">Try It Now » </a></p>
                </div>
            </div>
            <hr>
            <footer>
                <p>© <a href="http://www.yes-interactive.com">Yes Interactive, LLC</a> 2018</p>
            </footer>
        </div>         
        <!-- /container -->
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
