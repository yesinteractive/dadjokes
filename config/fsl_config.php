<?php

//Config file

function configure()
{
  option('env', ENV_DEVELOPMENT);
  option('base_uri', "/gitprojects/limonade/"); //set if app is not in web root directory but in a subdirectory
  //option('session', true); // enable
  option('session', 'yellowlemons'); // enable with a specific session name
  
  //##############################################
  //encryption configuration
  
  //reccommend a random key to use, for example openssl_random_pseudo_bytes(32) will generate a good one
  option('global_encryption_key', 'setyourkeyhere'); // used in fsl_encrypt and fsl_decrypt
  
  //##############################################
  //fsl configurations
  
  option('fsl_session_length', 300); // session timeout in seconds, default is 300 seconds or 5 minutes. PHP default is typically 24 minute
  
 
 

  
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

?>
