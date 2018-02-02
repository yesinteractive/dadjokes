<?php

  function hello_world()
  {
  //  $_SESSION['crop'] = 'test';  
    fsl_session_set('crop','My session data.');
    set_or_default('name', params('who'), "everybody");
    //$mail = new PHPMailer(true);
    return html("<h1>Ahhhhhhh! It works.</h1>");
  }

function showip()
  {
    $ip = $_SERVER['REMOTE_ADDR'];
    set_or_default('name', params('who'), "everybody");

    //session data example

    $session = (empty(fsl_session_check('crop'))) ? "No session data." : fsl_session_check('crop');

    //Encryption Example
    $estring = fsl_encrypt("this is a test");
    $dstring = fsl_decrypt($estring);
    
    
    return html("IP of the client is $ip.<BR>Your session is $session. <BR><BR>Encrypt string is $estring<BR><BR>Decrypted is $dstring ");
  } 

 function hello()
  {
    set_or_default('name', params('who'), "everybody");
    session_destroy();
    return html("Hello %s!");
  }

 function welcome()
  {
    set_or_default('name', params('name'), "everybody");    
    return html("html_welcome");
  }

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

 function how_are_you()
  {
    $name = params('name');
    if(empty($name)) halt(NOT_FOUND, "Undefined name.");
    # you can call an other controller function if you want
    if(strlen($name) < 4) return are_you_ok($name);
    set('name', $name);
    return html("I hope you are fine, $name.");
  }

 function image_show()
  {
    $ext = file_extension(params('name'));
    $filename = option('public_dir')."/".basename(params('name'), ".$ext");
    if(params('size') == 'thumb') $filename .= ".thb";
    $filename .= '.jpg';
 
    if(!file_exists($filename)) halt(NOT_FOUND, "$filename doesn't exists");
    render_file($filename);
  }

 function image_show_jpeg_only()
  {
    $ext = file_extension(params(0));
    $filename = option('public_dir').params(0);
    if(params('size') == 'thumb') $filename .= ".thb";
    $filename .= '.jpg';
  
    if(!file_exists($filename)) halt(NOT_FOUND, "$filename doesn't exists");
    render_file($filename);
  }

?>