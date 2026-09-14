FROM alpine:latest

RUN apk add bash
RUN apk add nginx
RUN apk add php85 php85-fpm php85-curl php85-mbstring php85-xml php85-zip php85-pdo php85-pdo_mysql php85-simplexml php85-dom php85-pecl-amqp php85-pecl-redis php85-ctype php85-tokenizer php85-xmlwriter
RUN apk add powershell
RUN apk add composer
RUN apk add yarn
EXPOSE 80
COPY docker/demo.sh /demo.sh
COPY docker/demo.nginx.conf /etc/nginx/http.d/default.conf
COPY ../.. /app
RUN pwsh -Command "cd /app; . ./script.ps1; Build-Project"
RUN chmod +x /demo.sh
CMD ["/demo.sh"]
