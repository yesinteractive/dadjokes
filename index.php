<?php
##############################################################################
#  requirements - must be included in your index.php
##############################################################################
# 

require_once 'lib/fsl.php';


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
  option('routecallback', $route['callback']);
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
#   GET        |  /                |  api


dispatch('/', 'api');

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


##############################################################################
# custom error declaration
##############################################################################
# 
// Custom 404 
function not_found($errno, $errstr, $errfile, $errline){ 
     
     $arr = array('Error' => "$errno $errstr Not Found");
   // status(202); //returns HTTP status code of 202
    status(404); //returns HTTP status code of 202
    return json($arr);
} 
// Custom 500
function server_error($errno, $errstr, $errfile, $errline){ 
 
     $arr = array('Error' => "$errno $errstr ");
   // status(202); //returns HTTP status code of 202
    status(500); //returns HTTP status code of 202
    return json($arr);
} 



?>
