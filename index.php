<?php
##############################################################################
#  requirements - must be included in your index.php
##############################################################################
# 

require_once 'lib/limonade.php';


##############################################################################
#  configurations
##############################################################################
#  All in config directory

##############################################################################
#  code to run before route execution
##############################################################################
# 

function before($route)
{
  header("X-LIM-route-function: ".$route['callback']);
  layout('fsl_default_layout.php');
}

##############################################################################
#  sample routes
##############################################################################
# 
#  routes and controllers
# ----------------------------------------------------------------------------
# Sample RESTFul map:
#
#  HTTP Method |  Url path         |  Controller function
# -------------+-------------------+-------------------------------------------
#   GET        |  /                |  hello_world


//basic hello world
dispatch('/', 'hello_world');

//example showing a json REST response
dispatch('/api', 'api');

  
dispatch('/showip/:what/:who', 'showip');
   
  
dispatch('/hello/:who', 'hello');
 
  
dispatch('/welcome/:name', 'welcome');
 

dispatch('/are_you_ok/:name', 'are_you_ok');
 
    
dispatch('/how_are_you/:name', 'how_are_you');
 
  
dispatch('/images/:name/:size', 'image_show');
 

dispatch('/*.jpg/:size', 'image_show_jpeg_only');
 

##############################################################################
#  run after function
##############################################################################
# 
 
  
function after($output, $route)
{
  // Uncomment to show request params and response timing
  // Helpful for debuggin
  /*
  $time = number_format( microtime(true) - LIM_START_MICROTIME, 6);
  $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
  $output .= "<!-- for route\n";
  $output .= print_r($route, true);
  $output .= "-->";
  
  */
  
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
#  Layouts are autoloaded from views directory or can be referended
#  as a function like below.

function html_my_layout($vars){ extract($vars);?> 

<!doctype html>
<html lang="en">
  <body>
    Hello world!
  </body>
</html>

<?php  }

function html_welcome($vars){ extract($vars);?> 
<h3>Hello <?php echo $name?>!</h3>
<p><a href="<?php echo url_for('/how_are_you/', $name)?>">How are you <?php echo $name?>?</a></p>
<hr>
<p><a href="<?php echo url_for('/images/soda_glass.jpg')?>">
   <img src="<?php echo url_for('/images/soda_glass.jpg/thumb')?>"></a></p>
<?php }  

##############################################################################
# custom error declaration
##############################################################################
# 
// Custom 404 error example
/*function not_found($errno, $errstr, $errfile, $errline){ 
     
 echo "<center><img src=" . url_for('//_lim_public/img/404.gif') . " border=0><BR><BR>Your request for" . $errstr . " came up ghosts.</center>"  ;  
} 
*/


?>
