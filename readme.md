## Dad Jokes Microservice

Just a sample microservice used for testing Kong, Kubernetes, etc.

### With Docker ###

[![](https://images.microbadger.com/badges/image/yesinteractive/dad-jokes_microservice.svg)](https://microbadger.com/images/yesinteractive/dad-jokes_microservice "Get your own image badge on microbadger.com") [![](https://images.microbadger.com/badges/version/yesinteractive/dad-jokes_microservice.svg)](https://microbadger.com/images/yesinteractive/dad-jokes_microservice "Get your own version badge on microbadger.com")

Docker image is Alpine 3.9 based running on Apache. The containter exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/dad-jokes_microservic/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/dad-jokes_microservice
```
Typical basic usage:

```
docker run -it yesinteractive/dad-jokes_microservice
```

Typical usage in Dockerfile:

```
FROM yesinteractive/dad-jokes_microservice
RUN echo <your commands here>
```


