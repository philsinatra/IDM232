# MAMP Web Start

This document outlines an introduction to the MAMP Web Start Page and phpMyAdmin dashboard.

<!-- TOC -->

## Welcome Page

![](http://digm.drexel.edu/crs/IDM232/presentations/images/mamp-startpage-01.png)

The welcome page includes default server information for logging into MySQL on your local system. Unless you specifically change the username or password, they will both be set to `root` by default. Root users have maximum accessibility to the system.

![](http://digm.drexel.edu/crs/IDM232/presentations/images/mamp-startpage-02.png)

There are also basic PHP examples for setting up connections to our databases. These examples are using the basic `myslq` connect syntax in PHP, where we will be using the newer `mysqli` (i for improved).

## phpMyAdmin

There is a demo available online for you to test working with the phpMyAdmin interface.

- [https://demo.phpmyadmin.net/master-config/](https://demo.phpmyadmin.net/master-config/)

- review phpMyAdmin UI
- create a new database
- create a table

    ```sql
    CREATE TABLE `pjs`.`users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `first_name` VARCHAR(30) NOT NULL , `last_name` VARCHAR(30) NOT NULL , `username` VARCHAR(30) NOT NULL , `password` VARCHAR(40) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
    ```

## CRUD

Once the database and table are established we're ready to begin working with data
