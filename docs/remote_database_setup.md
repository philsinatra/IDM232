# Remote Database Setup

This document outlines the process of transferring a MySQL database from a local development system to a remote server. The assumed hosting provider is Bluehost.

## Export Local Database

The first step is to export your local database to a file so that it can be easily transferred to your remote server. phpMyAdmin has an export function that will do this for us.

1. Begin by selected the database you want to export.
1. Select the _Export_ tab from the navigation bar.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/local-1.png" width="425">

1. Choose _Custom_ as the export method. This will give you a full list of export options.
    - Under the _Output_ section, you can choose if you want to _Save output to a file_ or _View output as text_ (default). This document explains the process based on saving the output to a file. Switch the selection to _Save output to a file_.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/local-2.png" width="654">

1. Finally, scroll to the bottom and click the _Go_ button. A `.sql` file will be downloaded to your computer. This file contains all of your selected database's tables, records and information and is ready to be copied to your remote server.

## Setup Remote MySQL Database / User

If you review our discussion about connecting to your database locally, you'll recall we setup a configuration file that included the server, database, user, and password we wanted to connect with:

```php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "pjs_idm232";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
```

These values are our defaults for developing on our local machines. We're going to need to connect to our remote server's database, and have a user setup on the remote server for that connection. We can easily set these items up in the Bluehost dashboard.

1. Log into your Bluehost dashboard
1. Under the _Hosting_ tab, selected _databases_ from the sub navigation menu.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-1.png" width="973">

1. First, create a new database. Give the database a descriptive name. Notice there is a prefix listed above the input (blurred in my image for privacy). The final database name will be the prefix you see listed, combined with the name you type in the input. Once you type the database name in, click the _Create Database_ button. After the database is created, click the _Go Back_ button to return to the _databases_ dashboard.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-2.png" width="409">

1. Create a new user to access this database. Again, notice there is a prefix listed above the input (blurred in my image for privacy). The final user name will be the prefix you see listed, combined with the name you type in the input. You'll also input a password. It's recommended you generate a password that is as secure as possible. **Make sure you copy the password** that is generated so you have access to it for the follow up steps.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-3.png" width="571">

1. Once the user is created, the next step is to add the user to the database.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-4.png" width="295">

1. You'll then be asked to define the privileges this user will have on the server. Check the box that gives this user _ALL PRIVILEGES_. Once all privileges are selected, click the _Make Changes_ button.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-5.png" width="516">

## Importing MySQL File

1. Access phpMyAdmin on your remote server through the Bluehost dashboard by going to the _hosting_ page and clicking the _cpanel_ link in the subnavigation.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-6.png" width="156">

1. phpMyAdmin is listed under the _database tools_ section of the _cpanel_ page.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/bh-7.png" width="681">

1. Once phpMyAdmin opens, you should see the database you created listed on the left. Select the database.
1. After selecting the database, click the _Import_ link in the top navigation. You'll be directed to the file import page.
    <img src="http://digm.drexel.edu/crs/IDM232/images/remote_db_setup/import-1.png" width="567">

1. Use the _Choose File_ button to browser to your `.sql` file on your computer. Import this file into your remote phpMyAdmin. Your remote database should now be populated with a copy of your tables, records and data.

## Connect to Remote Database

The connection process will be exactly the same. The only difference is the credentials for your remote database will be different than your local database.

```php
// Local database credentials
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "pjs_idm232";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
```

You'll need to edit your credentials for your file set that will be on your remote server. The easiest way to maintain a single, working configuration file for local development and remote deployment is to use a conditional statement when declaring these variables.

```php
$host = $_SERVER['HTTP_HOST'];
if ($host == 'localhost') {
  // Local database credentials
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "pjs_idm232";
}
else {
  // Remote database credentials
  $dbhost = "localhost";
  $dbuser = "xxxxx_idm232";
  $dbpass = "XXXXXXXXXXXX";
  $dbname = "xxxxx_idm232";
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
  die("Database connection failed: " .
    mysqli_connect_error() .
    " (" . mysqli_connect_errno() . ")"
  );
}
```

The [$_SERVER['HTTP_HOST']](http://php.net/manual/en/reserved.variables.server.php) checks the host of the file being loaded, which locally will be `localhost`. If your file is on a remote server, the host will be yourdomain.com. This configuration setup allows you to maintain a single config file without having to change values when working locally or remotely.

You should now be able to upload your PHP files to your remote server and connect to your database.
