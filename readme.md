# Dad Jokes Microservice #
![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/0ckh82ned3gipoy2o03m.jpg)

[![Docker Pulls](https://img.shields.io/docker/pulls/yesinteractive/dadjokes)](https://hub.docker.com/r/yesinteractive/dadjokes) 
[![GitHub stars](https://img.shields.io/github/stars/yesinteractive/dad-jokes_microservice?style=social)](https://github.com/yesinteractive/dad-jokes_microservice) 
[![GitHub release](https://img.shields.io/github/release/yesinteractive/dad-jokes_microservice.svg)](https://github.com/yesinteractive/dad-jokes_microservice) 
[![Packagist](https://img.shields.io/packagist/l/fsl/fsl.svg)](https://github.com/yesinteractive/dad-jokes_microservice/blob/master/LICENSE.md)



Just a sample microservice used for testing Kong API Gateway, Kubernetes K8s, Docker, Kuma Service mesh, Istio Service Mesh, etc. as an alternative to httpbin. Feel free to [add your own jokes](https://github.com/yesinteractive/dad-jokes_microservice/blob/master/controllers/jokes.txt) to this repo as well. The service also has a `/echo` endpoint that will return information about the incoming request, in addition to the dad jokes. This is helpful for testing and troubleshooting. 

## Hosted Service / Demo ##

Access [http://dadjokes.online](http://dadjokes.online) to see the service in action.

## Usage ##

**Endpoint URI** : `/`

**Method** : `GET`

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


**Endpoint URI** : `/echo`

**Method** : `GET`

**Parameters** : optional

**Successful Response** : `200 OK`

```json
    "Joke": {
        "Opener": "I burned 2000 calories today",
        "Punchline": "I left my food in the oven for too long.",
        "Processing Time": "0.001223"
    },
    "Request": {
        "Headers": {
            "Host": "dev.yesllc.io",
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

## Installation ##

### Deployment Examples ###

See usage examples for Kubernetes, Kong for Kubernetes Ingress Controller, and docker-compose in the [examples directory folder.](https://github.com/yesinteractive/dad-jokes_microservice/blob/master/examples)

### With Docker ###

Docker image is Alpine 3.11 based running PHP 7.3 on Apache. The containter exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/dad-jokes_microservice/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/dadjokes
```
Typical basic usage:

```
docker run -it yesinteractive/dadjokes
```

Typical usage in Dockerfile:

```
FROM yesinteractive/dadjokes
RUN echo <your commands here>
```


