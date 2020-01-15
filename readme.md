## Dad Jokes Microservice

Just a sample microservice used for testing Kong, Kubernetes, etc.

### With Docker ###

[![](https://images.microbadger.com/badges/image/yesinteractive/fsl.svg)](https://microbadger.com/images/yesinteractive/fsl "Get your own image badge on microbadger.com") [![](https://images.microbadger.com/badges/version/yesinteractive/fsl.svg)](https://microbadger.com/images/yesinteractive/fsl "Get your own version badge on microbadger.com")

Docker image is Alpine 3.9 based running on Apache. The containter exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/fsl/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/fsl
```
Typical basic usage:

```
docker run -it yesinteractive/fsl
```

Typical usage in Dockerfile:

```
FROM yesinteractive/fsl
RUN echo <your commands here>
```



### With Composer ###

It's recommended that you use [Composer](https://getcomposer.org/) to install FSL. Navigate into your project’s root directory and execute the bash command shown below. This command downloads the FSL Framework and its third-party dependencies into your project’s vendor/ directory.

```bash
$ composer require fsl/fsl 
```
You can also install FSL by referencing it in your project's `composer.json`:

```json
"fsl/fsl":">0.1"
```


This will install FSL and all required dependencies. FSL requires PHP 5.5.0 or newer.

Require the Composer autoloader into your PHP script, and you are ready to start using Slim.

```php
<?php

require 'vendor/autoload.php';

```

### Without Composer ###

If not using Composer, just download the FSL files in your web directory and be sure to include the FSL main library file:

```php
<?php

require 'lib/fsl.php';

```

## Getting Up and Running ##
> Please note that if you are using the FSL Docker image, proceed to step 5.

1. Once files are in place on web server, make sure to have URL rewriting enabled in Apache. 
2. WEB SERVER CONFIGURATION: Verify that the directory FSL is placed in on your webserver has the AllowOverride directive set to `ALL (AllowOverride All)` in the Apache `<Directory>` configuration. If this is not set then the included `.htaccess` file will not be read and routes will not be execute correctly.
3. .HTACCESS CONFIGURATION: Update the RewriteBase directive in the included `.htaccess` file to accomodate your app if it is installed in a web sub directory (not root). If installing FSL in a root web directory, then nothing needs to be changed. If you are installing FSL in a sub directory such as /foo, then make the following change to the .htaccess file: 
```
RewriteBase /foo
```

4. FSL CONFIG FILE: Edit the /config/fsl_config.php file to suit your needs. IMPORTANT: Be sure to set the correct Base URI where FSL is installed. If you are installing FSL in a sub directory on your webserver such as /foo, then make the following change to the /config/fsl_config.php file: 
```
option('base_uri', "/foo"); //set if app is not in web root directory but in a subdirectory
```


