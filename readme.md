# Dad Jokes Microservice #
![Dad Jokes As A Microservice](https://raw.githubusercontent.com/yesinteractive/dad-jokes_microservice/master/public/dadjokes-microservice.png)

[![Docker Pulls](https://img.shields.io/docker/pulls/yesinteractive/dadjokes?style=for-the-badge)](https://hub.docker.com/r/yesinteractive/dadjokes) 
[![GitHub stars](https://img.shields.io/github/stars/yesinteractive/dadjokes?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
[![GitHub release](https://img.shields.io/github/release/yesinteractive/dadjokes?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
![MIT](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)



Just a sample humurous microservice or echo service used for testing API Gateways such as Kong, Kubernetes K8s, Openshift, Docker, 
Service meshes such as Kuma or Istio, etc. as an alternative to httpbin. Feel free 
to [add your own jokes](https://github.com/yesinteractive/dadjokes/blob/master/controllers/jokes.txt) 
to this repo as well. In addition to a dad joke, the service will optionally echo back information about the 
incoming request. This is helpful for testing and troubleshooting things like API gateways or proxies. See below for instructions on how to
enable echoing per request or by default.

## Hosted Service / Demo ##

Access [http://dadjokes.online](http://dadjokes.online) to see the service in action.

## Usage ##

**Endpoint URI** : `/`

**Method** : `GET` `POST` `PUT` `PATCH` `DELETE`

**Parameters** : optional

**Successful Response** : `200 OK`

```json
{
  "Joke": {
    "Opener": "What did one wall say to the other wall?",
    "Punchline": "I'll meet you at the corner.",
    "Processing Time": "0.000537"
  },
  "DadJokesInfo": {
    "SourceCode": "https://github.com/yesinteractive/dadjokes",
    "Version": "20250315"
  }
}
```

### ENABLING THE ECHO FEATURE ###

To enable the echoing of in the incoming request back into the response, simply add the docker environment variable `DADJOKES_NOECHO=FALSE` to your configuration or simply use the `/echo`  anywhere in
your request calls or as part of a query string. For example:

**Endpoint URI** : `/echo/abc/efg/`

**Method** : `GET` `POST` `PUT` `PATCH` `DELETE`

**Parameters** : optional

**Successful Response** : `200 OK`

```json
{
  "Joke": {
    "Opener": "What do you call a deer with no eyes?",
    "Punchline": "No idea!",
    "Processing Time": "0.000434"
  },
  "RequestEcho": {
    "Headers": {
      "Host": "somehost.com",
      "Connection": "keep-alive",
      "sec-ch-ua": "\"Chromium\";v=\"134\", \"Not:A-Brand\";v=\"24\", \"Google Chrome\";v=\"134\"",
      "sec-ch-ua-mobile": "?0",
      "sec-ch-ua-platform": "\"Windows\"",
      "DNT": "1",
      "Upgrade-Insecure-Requests": "1",
      "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36",
      "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
      "Accept-Encoding": "gzip, deflate, br, zstd",
      "Accept-Language": "en-US,en;q=0.9",
      "Cookie": "mycooking=myvalue;"
    },
    "Method": "GET",
    "Origin": "123.45.67.123",
    "URI": "/echo/abc/efg/",
    "Arguments": {
      "uri": "/echo/abc/efg/"
    },
    "Data": "",
    "URL": "https://somehost.com/echo/abc/efg/"
  },
  "DadJokesInfo": {
    "SourceCode": "https://github.com/yesinteractive/dadjokes",
    "Version": "20250315"
  }
}
```

### BEHIND REVERSE PROXY CONFIGURATION ###

If behind an API gateway or reverse proxy, you may wish to have only the URI of the original request
echoed back and not the URI of the upstream proxy target. To do this you may add the docker environment
variable `DADJOKES_BEHIND_PROXY=TRUE` to your configuration or set the global `behind_proxy`configuration
to true in the `config/fsl_config.php` file.


## Installation ##

### Deployment Examples ###

See usage examples for Kubernetes, Kong for Kubernetes Ingress Controller, and docker-compose in the [examples directory folder.](https://github.com/yesinteractive/dad-jokes_microservice/blob/master/examples)

### With Docker ###

Docker image is Alpine 3.11 based running PHP 7.3 on Apache. The containter exposes both ports 8100 (HTTP) an 8143 (HTTPS) with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/dad-jokes_microservice/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/dadjokes
```
Typical basic usage (below example exposes dadjokes on host ports 8100 and 8143 and enables auto echo of request data):

```
$ docker run -d \
  -p 8100:8100 \
  -p 8143:8143 \
  -e DADJOKES_NOECHO=FALSE \
  yesinteractive/dadjokes
```

Typical usage in Dockerfile:

```
FROM yesinteractive/dadjokes
RUN echo <your commands here>
```


