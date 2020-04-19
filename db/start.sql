#!/bin/bash

# Start apache
#/usr/sbin/apache2 -D FOREGROUND

CREATE DATABASE IF NOT EXISTS motosoftdb;
GRANT ALL ON motosoftdb.* TO root@'%' IDENTIFIED BY 'root';
