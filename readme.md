# Dad Jokes Microservice #
![Dad Jokes As A Microservice](https://raw.githubusercontent.com/yesinteractive/dad-jokes_microservice/master/public/dadjokes-microservice.png)

[![Docker Pulls](https://img.shields.io/docker/pulls/yesinteractive/dadjokes?style=for-the-badge)](https://hub.docker.com/r/yesinteractive/dadjokes) 
[![GitHub stars](https://img.shields.io/github/stars/yesinteractive/dadjokes?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
[![GitHub release](https://img.shields.io/github/release/yesinteractive/dadjokes?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
![MIT](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)



Just a sample microservice or echo service used for testing API Gateways such as Kong, Kubernetes K8s, Openshift, Docker, 
Service meshes such as Kuma or Istio, etc. as an alternative to httpbin. Feel free 
to [add your own jokes](https://github.com/yesinteractive/dadjokes/blob/master/controllers/jokes.txt) 
to this repo as well. In addition to a dad joke, the service will automatically echo back information about the 
incoming request. This is helpful for testing and troubleshooting. If you wish to not display echo back the request 
data, then just make the request against the `/noecho` endpoint or by configuring the dadjokes service with the noecho environment variable set to true. 

## Hosted Service / Demo ##

Access [http://dadjokes.online](http://dadjokes.online) to see the service in action.

## Usage ##

**Endpoint URI** : `/`

**Method** : `GET` `POST` `PUT` `PATCH` `DELETE`

**Parameters** : optional

**Successful Response** : `200 OK`

```json
    "Joke": {
        "Opener": "I burned 2000 calories today",
        "Punchline": "I left my food in the oven for too long.",
        "Processing Time": "0.001223"
    },
    "RequestEcho": {
        "Headers": {
            "Host": "dadjokes.online",
            "Connection": "keep-alive",
            "X-Forwarded-For": "74.11.135.11",
            "X-Forwarded-Proto": "http",
            "X-Forwarded-Host": "dadjokes.online",
            "X-Forwarded-Port": "80",
            "X-Real-IP": "74.11.135.11",
            "Cache-Control": "max-age=0",
            "Upgrade-Insecure-Requests": "1",
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36",
            "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "Accept-Encoding": "gzip, deflate",
            "Accept-Language": "en-US,en;q=0.9",
            "Cookie": "fsl=eijse8smkrfce80or4frpjnf87"
        },
        "Method": "GET",
        "Origin": "192.11.166.11",
        "URI": "/echo",
        "Arguments": {
            "uri": "/echo"
        },
        "Data": "",
        "URL": "http://dadjokes.online/echo"
    }
}
```

### Deployment Examples ###

To disable the echoing of in the incomfing response, simply add the docker environment variable `DADJOKES_NOECHO=TRUE` to your configuration or simply use the `\noecho` endpoint in
the first level of your request calls. For example:

**Endpoint URI** : `/noecho/abc/efg/`

**Method** : `GET` `POST` `PUT` `PATCH` `DELETE`

**Parameters** : optional

**Successful Response** : `200 OK`

```json
{
  "Jokes": {
    "Opener": "What did the mountain climber name his son?",
    "Punchline": "Cliff",
    "Processing Time": "0.001530"
  }
}
```

## Installation ##

### Deployment Examples ###

See usage examples for Kubernetes, Kong for Kubernetes Ingress Controller, and docker-compose in the [examples directory folder.](https://github.com/yesinteractive/dad-jokes_microservice/blob/master/examples)

### With Docker ###

Docker image is Alpine 3.11 based running PHP 7.3 on Apache. The containter exposes both ports 8100 (HTTP) an 8143 (HTTPS) with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/dad-jokes_microservice/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/dadjokes
```
Typical basic usage (below example exposes dadjokes on host ports 8100 and 8143):

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


