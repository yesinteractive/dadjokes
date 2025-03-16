<?php

function process_time(){
    $time = number_format( microtime(true) - LIM_START_MICROTIME, 6);
    return($time);
}

function api()
{
    //get jokes
    $f_contents = file("controllers/jokes.txt");
    $line = $f_contents[rand(0, count($f_contents) - 1)];
    //explode line into array
    $line = explode("<>", $line);
    $arr = array('Joke' => array('Opener' => $line[0], 'Punchline' => trim($line[1]), 'Processing Time' => process_time()));
    $credits = array('DadJokesInfo' => array('SourceCode' => 'https://github.com/yesinteractive/dadjokes','Version' => option('release')));

    $headers = getallheaders();

    if (option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE") {
        if (isset($headers['X-Forwarded-Host'])) {
            $headers['HOST'] = $headers['X-Forwarded-Host'];
        }
    }

    if((!empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'echo') !== false) || getenv("DADJOKES_NOECHO") == "FALSE"){
        $request = ["RequestEcho"=>["Headers"=>$headers,
            "Method"=>$_SERVER['REQUEST_METHOD'],
            "Origin"=>$_SERVER['REMOTE_ADDR'],
            "URI"=>(option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE" ? $_REQUEST['uri'] : preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI'])),
            "HOST"=>(option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE" ? ($headers['X-Forwarded-Host'] ?? $_SERVER['HTTP_HOST']) : $_SERVER['HTTP_HOST']),
            "Arguments"=>$_REQUEST,
            "Data"=>file_get_contents('php://input'),
            "URL"=>(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://"
                . (option('behind_proxy') == TRUE || getenv("DADJOKES_BEHIND_PROXY") == "TRUE" ? ($headers['X-Forwarded-Host'] ?? $_SERVER['HTTP_HOST']).$_REQUEST['uri']: "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ),
        ]];
        status(200); //returns HTTP status code of 200
        return json(array_merge($arr,$request,$credits),JSON_UNESCAPED_SLASHES);
    } else{
        status(200); //returns HTTP status code of 200
        return json(array_merge($arr,$credits),JSON_UNESCAPED_SLASHES);
    }
}

?>