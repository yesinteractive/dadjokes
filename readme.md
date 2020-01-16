## Dad Jokes Microservice

Just a sample microservice used for testing Kong API Gateway, Kubernetes K8s, Kuma Service mesh, Istio Service Mesh, etc.

### With Docker ###


[![GitHub release](https://img.shields.io/github/release/yesinteractive/dad-jokes_microservice.svg)](https://github.com/yesinteractive/dad-jokes_microservice) 
![Packagist](https://img.shields.io/packagist/l/fsl/fsl.svg) ![PHP from Packagist](https://img.shields.io/packagist/php-v/fsl/fsl.svg)

Docker image is Alpine 3.9 based running on Apache. The containter exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/dad-jokes_microservic/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
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


