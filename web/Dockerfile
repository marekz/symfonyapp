FROM ubuntu:18.04
EXPOSE 80
ENV TZ=Europe/Warsaw

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update 
RUN apt-get upgrade -y
RUN apt-get install -y libapache2-mod-php7.2 php7.2 php7.2-cli php7.2-gd php7.2-intl php7.2-mbstring php7.2-mysql php7.2-xml php7.2-xsl php7.2-bcmath php7.2-zip php-apcu npm lynx
RUN apt-get install -y mysql-client composer screen tmux vim nano iputils-ping

ADD _serverConfig/motosoft.conf /etc/apache2/sites-available/
RUN ln -snf /etc/apache2/sites-available/motosoft.conf /etc/apache2/sites-enabled/motosoft.conf
RUN ln -snf /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load 
ADD start.sh /start.sh
RUN chmod +x /start.sh

CMD /usr/bin/php /var/www/html/bin/console doctrine:migration:migrate -q
CMD /usr/bin/php /var/www/html/bin/console doctrine:fixtures:load -q

ENTRYPOINT /start.sh && service apache2 restart && bash
