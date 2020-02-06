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
    $arr = array('Joke' => array('Opener' => $line[0], 'Punchline' => $line[1], 'Processing Time' => process_time()));
    status(202); //returns HTTP status code of 202
    return json($arr);
  }



?>