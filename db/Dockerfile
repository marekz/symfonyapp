FROM ubuntu:18.04 
WORKDIR /
EXPOSE 3306
ENV TZ=Europe/Warsaw

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update 
RUN apt-get upgrade -y
RUN apt-get install -y mysql-server mysql-client mysql-common screen tmux vim nano iputils-ping lynx
RUN echo "bind-address = 0.0.0.0" >> /etc/mysql/mysql.conf.d/mysqld.cnf
ADD start.sql /start.sql
RUN chmod +x /start.sql

ENTRYPOINT service mysql start && mysql -uroot < /start.sql && /bin/bash