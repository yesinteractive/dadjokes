<?php



/* 
 *
 * fsl_encrypt
 *
 * encrypts a string and returns the encrypted string with appended 
 * initialization vector (iv) unique to encrypted string
 *
 * @string (string) String to be encrypted
 * @key (string) OPTIONAL encryption key to use. If not provided default
 *     key specified with option('global_encryption_key', 'setyourkeyhere') config
 * @return (string)
 */
function fsl_encrypt($string, $key = NULL){

  //set key to default key if no key passed to function  
  $encryption_key = (empty($key)) ? option('global_encryption_key') : $key;

  // Generate an initialization vector
  // This *MUST* be available for decryption as well
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

  // Create some data to encrypt
  
  // Encrypt $data using aes-256-cbc cipher with the given encryption key and
  // our initialization vector. The 0 gives us the default options, but can
  // be changed to OPENSSL_RAW_DATA or OPENSSL_ZERO_PADDING
  $encrypted = openssl_encrypt($string, AES_256_CBC, $encryption_key, 0, $iv);

  // If we lose the $iv variable, we can't decrypt this, so:
  // - $encrypted is already base64-encoded from openssl_encrypt
  // - Append a separator that we know won't exist in base64, ":"
  // - And then append a base64-encoded $iv
  $encrypted = $encrypted . ':' . base64_encode($iv);

  return $encrypted;
}

/*
 * fsl_decrypt
 *
 * decrypts a string encrypted with fsl_encrypt function
 * remember to include full string with appended IV and the ':' seperator
 *
 * @string (string) String to be decrypted
 * @key (string) OPTIONAL encryption key to use. If not provided default
 *     key specified with option('global_encryption_key', 'setyourkeyhere') config
 * @return (string)
 */
function fsl_decrypt($string, $key = NULL){

  //set key to default key if no key passed to function  
 $encryption_key = (empty($key)) ? option('global_encryption_key') : $key;

  // To decrypt, separate the encrypted data from the initialization vector ($iv).
  $parts = explode(':', $string);

  // $parts[0] = encrypted data
  // $parts[1] = base-64 encoded initialization vector

  // Don't forget to base64-decode the $iv before feeding it back to
  //openssl_decrypt
  $decrypted = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, base64_decode($parts[1]));
  return $decrypted;
}

/*
 * fsl_session_start
 *
 * decrypts a string encrypted with fsl_encrypt function
 * remember to include full string with appended IV and the ':' seperator
 *
 * @string (string) String to be decrypted
 * @key (string) OPTIONAL encryption key to use. If not provided default
 *     key specified with option('global_encryption_key', 'setyourkeyhere') config
 * @return (string)
 */


/*
 * fsl_session_valid
 *
 * decrypts a string encrypted with fsl_encrypt function
 * remember to include full string with appended IV and the ':' seperator
 *
 * @string (string) String to be decrypted
 * @key (string) OPTIONAL encryption key to use. If not provided default
 *     key specified with option('global_encryption_key', 'setyourkeyhere') config
 * @return (string)
 */

/*
 * fsl_session_kill
 *
 * decrypts a string encrypted with fsl_encrypt function
 * remember to include full string with appended IV and the ':' seperator
 *
 * @string (string) String to be decrypted
 * @key (string) OPTIONAL encryption key to use. If not provided default
 *     key specified with option('global_encryption_key', 'setyourkeyhere') config
 * @return (string)
 */
?>