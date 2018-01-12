<?php
require_once 'lib/limonade.php';


##############################################################################
#  configurations
##############################################################################
# 

function configure()
{
  option('env', ENV_DEVELOPMENT);
  option('base_uri', "/gitprojects/limonade/");
  option('session', true); // enable
  option('session', 'yellowlemons'); // enable with a specific session name
  
  
  #Initiate a DB connection (using PDO)
  #
  #  Example PDO Usage for data models
  #   function post_find_all()
  #      {
  #          $db = option('db_conn');
  #          $sql = "SELECT * FROM posts ORDER BY modified_at DESC SQL;"
  #          $result = array();
  #          $stmt = $db->prepare($sql);
  #          if ($stmt->execute())
  #          {
  #              return $stmt->fetchAll(PDO::FETCH_ASSOC);
  #          }
  #          return false;
  #      }
  # uncomment this section below if going to use a DB
  /*
    $host = 'localhost';
    $db   = 'pdotest';
    $user = 'root';
    $pass = 'qwerty';
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try
    {
       $db = new PDO($dsn, $user, $pass, $opt);
    }
    catch(PDOException $e)
    {
      halt("Connexion failed: ".$e); # raises an error / renders the error page and exit.
    }
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
  option('db_conn', $db);
  */
  
 
}






##############################################################################
#  code to run before route execution
##############################################################################
# 


function before($route)
{
  header("X-LIM-route-function: ".$route['callback']);
  layout('html_my_layout');
}

##############################################################################
#  routes and controllers
##############################################################################
# 
#  routes and controllers
# ----------------------------------------------------------------------------
# RESTFul map:
#
#  HTTP Method |  Url path         |  Controller function
# -------------+-------------------+-------------------------------------------
#   GET        |  /posts           |  blog_posts_index
#   GET        |  /posts/:id       |  blog_posts_show 


dispatch('/', 'hello_world');
  function hello_world()
  {
    $_SESSION['crop'] = 'test';  
    set_or_default('name', params('who'), "everybody");

    return html("Hellowwww world!");
  }
  
dispatch('/showip/:what/:who', 'showip');
  function showip()
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    set_or_default('name', params('who'), "everybody");
    
    if (isset($_SESSION['crop'])) $session = $_SESSION['crop'];
    else $session = "nada";
    return html("IP of the client is $ip and session is $session");
  }  
  
dispatch('/hi/', 'hello_world2');
  function hello_world2()
  {
    return "Hellowwww world!";
  }

dispatch('/hello/:who', 'hello');
  function hello()
  {
    set_or_default('name', params('who'), "everybody");
    session_destroy();
    return html("Hello %s!");
  }
  
dispatch('/welcome/:name', 'welcome');
  function welcome()
  {
    set_or_default('name', params('name'), "everybody");    
    return html("html_welcome");
  }

dispatch('/are_you_ok/:name', 'are_you_ok');
  function are_you_ok($name = null)
  {
    if(is_null($name))
    {
      $name = params('name');
      if(empty($name)) halt(NOT_FOUND, "Undefined name.");

    }
    set('name', $name);
    return html("Are you ok $name ?");
  }
    
dispatch('/how_are_you/:name', 'how_are_you');
  function how_are_you()
  {
    $name = params('name');
    if(empty($name)) halt(NOT_FOUND, "Undefined name.");
    # you can call an other controller function if you want
    if(strlen($name) < 4) return are_you_ok($name);
    set('name', $name);
    return html("I hope you are fine, $name.");
  }
  

  
dispatch('/images/:name/:size', 'image_show');
  function image_show()
  {
    $ext = file_extension(params('name'));
    $filename = option('public_dir')."/".basename(params('name'), ".$ext");
    if(params('size') == 'thumb') $filename .= ".thb";
    $filename .= '.jpg';
 
    if(!file_exists($filename)) halt(NOT_FOUND, "$filename doesn't exists");
    render_file($filename);
  }

dispatch('/*.jpg/:size', 'image_show_jpeg_only');
  function image_show_jpeg_only()
  {
    $ext = file_extension(params(0));
    $filename = option('public_dir').params(0);
    if(params('size') == 'thumb') $filename .= ".thb";
    $filename .= '.jpg';
  
    if(!file_exists($filename)) halt(NOT_FOUND, "$filename doesn't exists");
    render_file($filename);
  }

##############################################################################
#  run after function
##############################################################################
# 
 
  
function after($output, $route)
{
  $time = number_format( microtime(true) - LIM_START_MICROTIME, 6);
  $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
  $output .= "<!-- for route\n";
  $output .= print_r($route, true);
  $output .= "-->";
  return $output;
}


run();

##############################################################################
#  Data Models
##############################################################################
# 

##############################################################################
#  layouts (views) and html templates
##############################################################################
# 

function html_my_layout($vars){ extract($vars);?> 


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo option('base_uri'); ?>/public/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container">
    <BR><div class="jumbotron">
        <h1>My Limonade Bootstrap template</h1>
    </div>
    
    <?php echo $content?>
      <BR><BR>
        <img src="<?php echo url_for('/public/fsl.jpeg')?>"> <hr>
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
    <script src="<?php echo option('base_uri'); ?>/public/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </div> <!-- container end -->
  </body>
</html>


<?php }

function html_welcome($vars){ extract($vars);?> 
<h3>Hello <?php echo $name?>!</h3>
<p><a href="<?php echo url_for('/how_are_you/', $name)?>">How are you <?php echo $name?>?</a></p>
<hr>
<p><a href="<?php echo url_for('/images/soda_glass.jpg')?>">
   <img src="<?php echo url_for('/images/soda_glass.jpg/thumb')?>"></a></p>
<?php }   

// Custom 404 error
function not_found($errno, $errstr, $errfile, $errline){ 
     
 echo "<center><img src=" . url_for('//_lim_public/img/404.gif') . " border=0><BR><BR>Your request for" . $errstr . " came up ghosts.</center>"  ;  
}


?>
