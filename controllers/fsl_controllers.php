<?php

/*
*
*   Sample controller functions showcased on FSL Launch Page
*
*/

function process_time(){
   $time = number_format( microtime(true) - LIM_START_MICROTIME, 6);
  return($time);
}



/*
*
* This is the jokes function
*
*/

  function api()
  {
    //get jokes
    $f_contents = file("controllers/jokes.txt"); 
    $line = $f_contents[rand(0, count($f_contents) - 1)];
    //explode line into array
    $line = explode("<>", $line);
    $arr = array('Joke' => array('Opener' => $line[0], 'Punchline' => trim($line[1]), 'Processing Time' => process_time()));
    
    
    $headers = getallheaders();

    if((!empty(params('uri_param')))&& (params('uri_param')=="echo")){
          $request = ["Request"=>["Headers"=>$headers,
                  "Method"=>$_SERVER['REQUEST_METHOD'],
                  "Origin"=>$_SERVER['REMOTE_ADDR'],
                  "URI"=>(option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE" ? $_REQUEST['uri'] : preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI'])),
                  "Arguments"=>$_REQUEST,
                  "Data"=>file_get_contents('php://input'),
                  "URL"=>(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://"
                                  . (option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE" ? $headers['X-Forwarded-Host'].$_REQUEST['uri']: "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ),
                                 
                 ]];
          status(202); //returns HTTP status code of 202
    return json(array_merge($arr,$request),JSON_UNESCAPED_SLASHES);
    } else{
          status(202); //returns HTTP status code of 202
    return json(array_merge($arr),JSON_UNESCAPED_SLASHES);
    }
    
  }



?>