FROM k0st/alpine-apache-php:latest
MAINTAINER YesInteractive- http://yes-interactive.com
RUN wget https://github.com/yesinteractive/fsl/archive/master.zip -P /app && \
unzip master.zip -d /app && \
cp -r /app/fsl-master/. /app && \
rm -rf /app/fsl-master
EXPOSE 80
