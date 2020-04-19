FROM ubuntu:18.04
EXPOSE 80
ENV TZ=Europe/Warsaw

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update 
RUN apt-get upgrade -y
RUN apt-get install -y libapache2-mod-php7.2 php7.2 php7.2-cli php7.2-gd php7.2-intl php7.2-mbstring php7.2-mysql php7.2-xml php7.2-xsl php7.2-bcmath php7.2-zip php-apcu npm lynx
RUN apt-get install -y mysql-client composer screen tmux vim nano iputils-ping


ENTRYPOINT service apache2 restart && bash
