FROM mysql:8
RUN echo "default_authentication_plugin=mysql_native_password" >> /etc/mysql/my.cnf