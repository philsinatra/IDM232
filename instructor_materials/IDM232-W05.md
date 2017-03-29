build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 5
### MySQL Basics

---

## MySQL Introduction

^ We've learned enough PHP by now that we can build dynamic websites. You can build a pretty good website using only these tools. You can even have features like user log ins. But as your site complexity increases, you are going to reach the limits of what you can do with just PHP alone. And quickly, you'll discover that adding a database makes a lot of sense.

---

## MySQL Introduction

- Read and write data
- Stores more data
- Better organized data
- Faster access to data
- Easier to manipulate
- Relate data to other data

^ (_click_) A database is going to allow you to both read and write data. Mostly with PHP so far, we have been reading data that we had coded ahead of time. Writing data can be done with just PHP alone, but the process is more complicated than it is to just set up a database. (_click_) Databases also let you store more data, keep it (_click_) better-organized, they're (_click_) faster to access the data. And it's much (_click_) easier to manipulate the data, especially if we want to manipulate a lot of data all at the same time. And perhaps most importantly, (_click_) databases allow us to relate data to other data. That's why we often refer to them as relational databases. It's an important aspect, the fact that we have relationships, and we can work with our data in complex ways.

---

## MySQL

- Open source, free
- Easy to use
- Popular
- Good Introduction to database concepts

^ The database that we'll be using is going to be MySQL. (_click_) MySQL is open source and free just like PHP. (_click_) You can use other databases with PHP, almost any database you want. You just have to change the way that you connect to the database. But we're going to be using MySQL because it's easy to use. (_click_) It's very popular and you're going to find lot's of support for it out there if you run into problems. (_click_) And it also provides a good introduction to many common database concepts that you're going to find in any database that you use.

---

![fill](http://digm.drexel.edu/crs/IDM232/presentations/images/spreadsheet.png)

^ If you've never worked with a database before chances are that you have worked with a spreadsheet like Microsoft Excel. And you've seen people put data in there, that's not just numbers that they're adding up. They will put columns like first name and last name and so on. A database is similar to this in that it has columns and rows that are populated with data.

^ A spreadsheet page is what we would call a database table. And you can have multiple tables in the same way many spreadsheets often lets you have different worksheets that you can switch between. The spreadsheet columns are the table columns and those are what define what data will be stored. For example first name, last name, city and so on. The rows are individual records. So if I have a database table that has 20 customers in it, then I have 20 rows. Each row has data in each of the columns.

---

## MySQL

- Databases are not spreadsheets
  - Can define and travers relationships between tables
  - Issue commands to interact with database
- Spreadsheets are optimized for working with numbers
- Databases are optimized for working with data

^ Now, while this can be a useful analogy, (_click_) databases are not spreadsheets. A database can define and traverse relationships between tables. That's that relational aspect again. It's very powerful. Spreadsheets don't give you that. The other big difference is that, when working with databases, we're going to be issuing commands in order to interact with the database. With the spreadsheet, we have it all laid out in front of us in a visual medium where we can see all of those tables and columns and rows. Databases, we're not going to have that. We're going to be working with subsets of the data all the time. And we can ask it to show us some of that information. But we're going to be issuing commands to pull back bits of the data or issuing commands to manipulate parts of the data. And perhaps, it goes without saying, (_click_) that spreadsheets are optimized for adding numbers, that's what they do best. (_click_) Databases are optimized for working with data and that's what they do best.

---

## Common Database Terms

- Database
  - Set of tables
  - 1 database = 1 application
  - Access permissions are granted at database level

^ Let's review some of the common database terms that we're going to be using. So that you'll recognize them when I use them and make sure we're all on the same page about their meaning. The first, is just (_click_) database. We can have several databases running in MySQL at the same time. A database is a set of tables. And each database will contain its own set of tables. We'll typically have one database for one application. So we build our web application. It's going to connect to one and only one database. And access permissions to our data are typically granted at the database level.

---

## Common Database Terms

- Table
  - Set of columns and rows
  - Represents a single concept (a noun)
  - Examples: products, customers, orders
  - Relationships between tables

^ Next, (_click_) we have our table. A database is a set of tables, so a table is going to be a set of rows and columns, just like we saw when we used the spreadsheet metaphor. Now, each table is going to contain one type of information. That type is a single building block of our web application. And it's going to be a plural noun. So for example products, customers, orders, countries, students, books, transactions, those are good examples of nouns that would be in our application.

^ And notice that they're all plural because our table is going to be a container holding many of these things. And the nouns don't have to be concrete, they can represent more abstract ideas like favorites, or settings. And where with our database they don't interrelate, our tables very much will interrelate. We're going to want to create relationships between our tables.

---

## Common Database Terms

- Column
  - Set of data of a single simple type
  - Examples: first\_name, last\_name, email, password
  - Columns have types: strings, integers, etc.

^ (_click_) Next we have column. A column is a set of data of a single simple type. We saw that in the spreadsheet example. So we have first name, last name, email password, and columns have types so we have certain kinds of data that goes in certain kinds of columns. So strings go into the strings columns, integers go into the integers column and so on.

---

## Common Database Terms

- Row
  - Single record of data
  - Example: "Phil", "Sinatra", "ps42@drexel.edu", "secret"

^ (_click_) We also have rows, that's a single record of data. So for example, I might have a row that's Phil, Sinatra, ps42@drexel.edu and secret that corresponds to column types that list in the example bar.

---

## Common Database Terms

- Field
  - Intersection of a column and a row
  - Example: first_name: "Phil"

^ (_click_) And then last of all, we have a field. And a field is the intersection of a column and a row. So for example, in the first name column, in the field for the user Phil, I have the data, Phil. So the field is actually the intersection between the two. Now, field is often used interchangeably with column. And you'll very often hear me flip the two around. Don't let that throw you but technically speaking a field is an intersection between a row and a column.

---

## Common Database Terms

- Index
  - Data structure on a table to increase loop up speed
  - Like the index at the back of a book
- Foreign key
  - Table column whose values reference rows in another table
  - The foundation of relational databases

^ The next important term to know about is (_click_) index. Index is going to be a data structure on a table that is going to increase the speed of look ups in that table. It's part of what makes data bases really suited to work with data is the fact we have something like this that can speed up our access. It works a lot like the index at the back of a book. You thumb to the index, you look up the reference that you're looking for, it tells you what page, and go directly to that page. Indexes work the same way. And then we have this idea of a (_click_) foreign key. And that's going to be a table column whose values are going to reference the rows that are in another table. So this is where we're going to create our relationships. This is how we'll create relational databases is by using foreign keys. We'll get to this a little more when we talk about creating relational tables. I wanted to at least introduce the term to you here.

---

## CRUD

- Create
- Read
- Update
- Delete

^ And then last of all, I want us to make sure that we understand what CRUD means. CRUD is an acronym that stands for the four most basic operations that we do with databases.

^ So we have (_click_) create, (_click_) read, (_click_) update, and (_click_) delete. And together, these are the four most basic operations that we perform with databases. We will create new rows in our database tables, we'll read back data, we'll update the data, and we'll delete data from it. So if you hear me say, we're going to take care of the CRUD now, what I mean is that we're going to write the PHP code that is going to allow us to perform these four basic operations. Then we're going to learn how to do all four of those but first we need to go to MySQL and create our database.

---

## Creating a Database

^ Before we can get started working with data, we have to create the database and the database structure. There are a few ways we can do this.

---

![fit](http://digm.drexel.edu/crs/IDM232/presentations/images/mysql-login.png)

^ Option 1 is to use the command line. We can log in with our system terminal to our mysql installation, and from there, create databases, tables, columns etc. We can go through the CRUD process and manage everything for our databases this way. It's probably the best way to manage the databases because of the level of control you get, but we don't have enough time to learn how to use the command line in this class. This is another example as to why learning how to use the terminal is really a benefit to you as a developer. GIT, MySql, workflow - everything can be done from the command line with supreme control. If you want to be a top level developer, you'll want to spend time learning how to use the command line.

---

## MAMP

![inline](https://www.mamp.info/en/images/screenshots/en_mamp-start.jpg)

^ Remember MAMP/WAMP? It's time to fire that app up. MAMP is an acronym for Mac, Apache (our server), MySql, PHP. It's a single app that packages all of these components together for us. We've been working with Apache and PHP, now we're going to add the MySql component. We're going to open the app, turn the servers on and click the "Open Web Start Page".

---

![fit](http://digm.drexel.edu/crs/IDM232/presentations/images/mamp-startpage-01.png)

^ The welcome page includes default server information for logging into MySQL on your local system. Unless you specifically change the username or password, they will both be set to `root` by default. Root users have maximum accessibility to the system.

---

![fit](http://digm.drexel.edu/crs/IDM232/presentations/images/mamp-startpage-02.png)

^ There are also basic PHP examples for setting up connections to our databases. These examples are using the basic `myslq` connect syntax in PHP, where we will be using the newer `mysqli` (i for improved).

---

## phpMyAdmin

^ In the top toolbar under the "Tools" tab, there is a link to _phpMyAdmin_. (demo: - [https://demo.phpmyadmin.net/master-config/](https://demo.phpmyadmin.net/master-config/))

^ review phpMyAdmin UI

^ create a new database

---

## CRUD

- Create
- Read
- Update
- Delete

^ Once the database and table are established we're ready to begin working with data. You'll remember that I told you CRUD was an acronym. It stands for Create, Read, Update, and Delete and those are the four main operations that we perform on databases.

---

### Create

```sql
CREATE TABLE `db_name`.`table_name` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(30) NOT NULL ,
  `last_name` VARCHAR(30) NOT NULL ,
  `username` VARCHAR(30) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
```

^ create a table

^ review data types [http://www.w3schools.com/sql/sql_datatypes.asp](http://www.w3schools.com/sql/sql_datatypes.asp)

---

## SQL Insert (Create)

```sql
INSERT INTO `table_name` (column1, column2, column3)
VALUES (value1, value2, value3);
```

^ First let's look at how we do a create, and we do that with the SQL `INSERT` statement.

^ We `INSERT INTO`, then the table name. Then we provide a list of the columns inside parenthesis with commas between each value. We don't have to list every column in the table, only the ones we want to insert into. Next we supply the values, also in parenthesis separated by commas. We have to supply the same number of values as we did column names, and we have to put the values in the correct order, so in this case _value1_ should be inserting into _column1_ and so on. That's all there is to an insert statement.

---

## SQL Select (Read)

```sql
SELECT *
FROM `table_name`
WHERE column1 = 'some text'
ORDER BY column1 ASC;
```

^ Reading data from the database is the most common of the CRUD functions. We'll do this the most often.

^ This is a typical syntax for a select statement. First we say _SELECT_ some records from the database. Telling the app to select from the database is the same as saying "read" from the database. Then an asterisk, which means bring back all columns.

---

## SQL Select (Read)

```sql
SELECT `first_name`, `last_name`
FROM `table_name`
WHERE `first_name` = 'Phil'
ORDER BY `last_name` ASC;
```

^ We could also specify only certain columns to be read. So in this example we are asking to read only the information in the `first_name` and `last_name` columns of the database.

---

## SQL Select (Read)

```sql
SELECT *
FROM `table_name`
WHERE column1 = 'some text'
ORDER BY column1 ASC;
```

^ Back to our first example, so we've selected everything; then we have to tell the application which table we want to read, so in this case we are selected everything from the table `table_name`.

^ In the third line we specify our search criteria, so we are saying select everything in the table where `column1` has a value equal to 'some text'. So our application will read everything from all the records where `column1`'s value is equal to 'some text'.

---

## SQL Select (Read)

```sql
SELECT *
FROM `table_name`
WHERE column1 = 'some text'
ORDER BY column1 ASC;
```

^ And then in the last line we're specifying the order. So we are ordering the results based on `column1` in an ascending order, which means alphabetically from A to Z.

---

## SQL Select (Read)

```sql
SELECT *
FROM `table_name`
WHERE column1 = 'some text'
ORDER BY column1 DESC;
```

^ We could do the opposite which would be descending order. There's a ton of options on our select statement that we could use to define exactly what content we want to read from the database, and how we want to display it.

---

## SQL Select (Read)

```sql
SELECT `first_name`, `last_name`
FROM `table_name`
WHERE `first_name` = 'Phil'
ORDER BY `last_name` ASC;
```

^ So let's go back to our other read example. Here we break this down and it says - read from the database and select all the information in the `first_name` and `last_name` columns in table `table_name` where the `first_name` value is equal to Phil, and sort those results alphabetically based on the `last_name` values.

---

## SQL Update

```sql
UPDATE `table_name`
SET column1 = 'some text'
WHERE id = 1;
```

^ Okay, so let's look at an update. This means that there's already data in the database. We have a row for a record. Let's say it's a customer and we want to update their address. Well, we do that using the `UPDATE` statement. `UPDATE` table `SET` column1 equal to 'some text'. That's it, set that column, whatever it is, equal to some text. And if we had more of those, then we'd just put a comma followed by additional ones that we wanted to set. So each one would just be a key value pair with the equals sign in between, and then `WHERE` id equals 1.

^ If we don't include the `WHERE` portion of the statement, we're not telling the application which record we want to update. In this case, we're targeting the record that has an `id` of 1. Which this, we would update all of the records, so everyone would have the same address.

---

## SQL Delete

```sql
DELETE FROM `table_name`
WHERE id = 1;
```

^ And then, last of all, we have DELETE. So this is an SQL DELETE statement. We say DELETE FROM table where id equals 1, or id equals 37.

^ It's going to delete that row from the database. Now, we don't have to use `id` as the specifier. We could say, `DELETE FROM table WHERE` first name equals Kevin, then all rows where `first_name` is equal to Kevin would be deleted. They all get deleted at the same time, it can be very powerful but most often we're going to just be deleting a single row, we're going to identify it by it's unique id.

---

## Populate the Database

^ Let's add some data to our table in phpMyAdmin.

---

## Using PHP To Access MySQL

- `mysql`
- `mysqli`
- `PDO`

^ Now that we've learned the basic commands of MySQL, we're ready to learn how to use PHP to issue those commands. PHP offers three different ways to connect to MySQL. Database API is the technical term for each of these connection options. So, let's review these three Database APIs so that we can decide which one we're going to use. (_click_) The first one is going to be just called MySQL. If the original MySQL API for PHP. The second one is (_click_) MySQL I. The i stands for improved. It just has some improvements over MySQL. It's very, very similar. And the third option is (_click_) PDO. Which stands for PHP Data Objects.

^ Now, all three of these are extremely similar. And once you learn how to use one, you can easily switch to another. The differences are kind of like the differences between driving different brands of cars. If you're driving a Honda when you're used to driving a Toyota. The controls for the windshield wipers and the headlights may be in different places. But overall, the concepts are the same. And with just a few minutes, you can make the switch.

---

### Database APIs

- `mysql` is the original, soon to be depreciated
- `PDO` is robust - works with other types of databases
- `mysqli` is our path!

^ You can review a comparison chart of all the differences and similarities between these methods online, in the interest of time I'll fast forward and tell you we're going to be learning `mysqli` which is robust, well documented and the path of least resistance for us to connect to our database and perform our CRUD functions.

---

## PHP Database Interaction in Five Steps

1. Create a database connection
1. Perform database query
1. Use returned data (if any)
1. Release returned data
1. Close database connection

^ There are five basic steps for database interaction in PHP. (_click_) First we create a database connection. That's a bit like picking up the telephone to call somebody.

^ Then, once we've got the database on the line, (_click_) we're ready to start issuing commands to our database. So we perform our queries, those can be Select statements, they can be Insert statements, they can be Delete, all but MySQL that we just learned.

^ If we're doing a Select then it would, might return data to us. (_click_) And we would use that return data. We could add there output it to the screen. To the browsers. So the user could see it. Or you might store it in an array. Or in a variable. Do something with it. The whole point of querying the database is to get back the data. And then we want to do something with that data.

^ Once we're done, (_click_) then we can release the returned data. That's essentially telling PHP look, I'm done with this now, you can free up the memory that was used to hold that query. So you brought back a thousand records to me. I got what I needed, now you can free up those thousand records.

^ It's always a good idea to do. And then last, (_click_) is close the database connection. That's a bit like hanging up the phone. We're all done at that point.

---

### Step 1: Create a database connection

```php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "pjs_idm232";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
```

^ Here's the syntax for connection to a database using `mysqli` in PHP. The key line is the connection line, which uses `mysqli_connect` to connect to our database, and then each of these parameters must be provided. The first thing is the host that we're using. So, if that could be either IP address, it might be a domain, Google.com, yourwebsite.com etc.

^ Next we've got our user name. So, that's going to be the user that we connect to the database with. The default for local development is the root user who has full privileges. We could also create a new mysql user specifically for each project, which is actually ideal. When we move our database to our remote server we'll be doing that. Next is the password that you would use, so root is the default, again if we setup a different user there would be a unique password. The name that we gave our database is the last thing.

---

### Step 1: Create a database connection

```php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "pjs_idm232";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
```

^ So at this point if we run our page it will make a connection to the database. Next we need to check and see whether that connection was successful.

---

### Step 1: Create a database connection

```php
if (mysqli_connect_errno()) {
  die("Database connection failed: " .
    mysqli_connect_error() .
    " (" . mysqli_connect_errno() . ")"
  );
}
```

^ The way to do that is to use `mysqli_connect_errorno` and error to find out. So here is an example of how you can do that. If `mysqli_connect_errno`, or if there is an error number, then we know that there was a problem. And at that point, we can say, well, the database connection failed. This checks for any error that occurred in the last transaction. If there's an error sitting there, at this point, we know that it's from whatever we just did.

^ And then die. That's a new bit of PHP, but it basically says just give up. It's like saying exit or break. Basically just says forget all other PHP, and completely and totally, fatally quit. So it gets out of there. And it's going to die with this message, database connection failed, and then I'm going to display the actual error using the error version. So `mysqli_connect`, and then error and then in parenthesis after it, I'll put the error number. Just so that we see that as well. So that's the message that it will die with. I'm just concatenating those strings together. So that'll then tell us did it succeed or not.

---

### Step 5: Close database connection

```php
mysqli_close($connection);
```

^ So we don't forget, the next thing we'll do is actually the last step. All the way at the bottom of our page we'll close the database connection. So with these commands we're making a connection to our database, and closing that connection. Next is the important part - we need to retrieve content from our database.

---

### Retrieving data from MySQL

- `mysqli_query()`
- `mysqli_fetch_row()`
- `mysqli_free_result()`

^ We need to be able to issue queries from MySQL and then work with data that it brings back to us. To do that, we're going to learn three new functions. They're MySQL API functions. (_click_) They're `mysqli_query`, which is, of course, what we'll use to do our querying. Then if we get results back, (_click_) we'll use `mysqli_fetch_row`. To work with those results, and then as we listed as one of our key steps, (_click_) we want to free the result at the end. To tell PHP that it's okay to flush that memory and not try to hold onto those results any longer. That will free up some memory for us.

---

### Step 2: Perform Database Query

```php
$query = "SELECT * FROM subjects";
```

^ We know how to write MySQL. Let's just start by creating ourselves `$query` equals, select all from subjects. This should return a list of all columns from all subjects that we have in the database.

^ Now, my advice is to always define your query as a separate variable like this. It's really handy. Because then if you want to try to debug it later, it's very easy to just echo that query to the browser. If you're constructing something very complex, you could just say echo query. Find out what you were trying to send to MySQL that had some problems. Now, we've defined this string and set it to the variable but we haven't sent it to MySQL.

---

### Step 2: Perform Database Query

```php
$query = "SELECT * FROM subjects";
mysqli_query($connection, $query);
```

^ So, let's do that now using `mysqli_query`. And then, we need to tell it two things. We need to tell it the connection to use, so that's my connection variable and then we supply our query statement.

---

### Step 2: Perform Database Query

```php
$query = "SELECT * FROM subjects";
$result = mysqli_query($connection, $query);
```

^ Now, we want to catch the results that come back from query so we'll do that by setting `$result`; and result is going to be special. It's not just going to be an array that comes back to us, it's going to be a special kind of object called a _resource_. And a resource of database rows that we're going to need to then access.

---

### Step 2: Perform Database Query

```php
$query = "SELECT * FROM subjects";
$result = mysqli_query($connection, $query);
if (!$result) {
  die("Database query failed.");
}
```

^ Before we do that though, let's first test to see if the query succeeded or not. We can do that by saying if there was not a result then we know we had a problem. We can just do our die again. Die database query failed. Now, failure is not the same thing as not getting any rows back.

^ Okay, so now, we have back our results. So, our subjects are stored in our `$result` variable, in a resource set that we can then work with.

---

### Step 3: Use Returned Data (if any)

```php
<body>
  <?php
    while($row = mysqli_fetch_row($result)) {
      var_dump($row);
      echo "<hr>";
    }
  ?>
</body>
```

^ We jump down into our document body because now we're going to be outputting our content in our HTML. And we're going to use a while loop to loop through all the rows that were returned to us from the database. So at first we'll use the `var_dump` function to just dump out all of the data returned for each row.

^ The tricky part you want to pay attention to is the while statement.

---

#### While Statement

```php
while($row = mysqli_fetch_row($result)) {
```

^ While something is true, in this case, while $row equals `mysql_fetch_row` from our `$result`. So, what this does is says "go get the first row from that result set, and assign it to the `$row` variable".

---

### Step 3: Use Returned Data (if any)

```php
<body>
  <?php
    while($row = mysqli_fetch_row($result)) {
      var_dump($row);
      echo "<hr>";
    }
  ?>
</body>
```

^ While you're able to bring something back from the results, keep looping through the results, each time assigning the row data to the `$row` variable, dumping out the information, and then continuing until there are no more results. When there are no more results, the loop ends and we continue to the rest of our page.

---

#### Increment Array Pointer

```php
$i = 0;
while ($i < 10) {
  // do something
  $i++;
}
```

^ Usually when we work with loops we have to increment a value each time the loop executes so PHP knows when to stop. With `mysqli_fetch_row`, we don't have to do that though.

---

#### Increment Array Pointer

```php
while ($row = mysql_fetch_row($result)) {
  // do something
}
```

^ We're not dealing with a standard array, we're dealing with a MySQL result set. The `mysqli_fetch_row()` function automatically updates the array pointer for us each time through, so every time we pull a row we move the array pointer down the set to the next one, and when we get to the end the loop will exit.

---

### Step 4: Release Returned Data

```php
mysqli_free_result($result);
```

^ Once we're done working with the data, we can release it using `mysql_free_result` and passing in our `$result` as the parameter. This will release that data and free up memory for us.

---

## Example Time

^ Let's build an example and see these functions in action. (_examples/week5/databases.php_)

---

## Working With Retrieved Data

- `mysqli_fetch_row`
  - Results are in a standard array
  - Keys are integers

^ We've learned how to connect to MySQL using PHP and how to access the results that it returns. Next we're going to look a little closer at some of the options we have for working with those results sets. There are four ways to retrieve data from the query result, and the first of these we've already seen, it's (_click_) `mysqli_fetch_row`. And it brings back a row of data and assigns it to a standard array. The keys for each one of those columns are going to be integers. So if we want to get the menu name, we ask for what's in column one. That's the index position in the array one.

---

## Working With Retrieved Data

- `mysqli_fetch_assoc`
  - Results are in an associative array
  - Keys are column names

^ We have another option though. We can use (_click_) `mysqli_fetch_assoc` in its place, use it exactly the same way. The only difference is that the results are going to be returned in an associative array. That's nice because now the keys are going to be the column names. If we want to get menu name for our subject, well then we ask for the key menu name. It's nice and easy, it is a touch slower, because it does have to make an extra query to MySQL to find out the column names. So it can use them when it's constructing that associative array. But you won't notice a speed difference.

---

## Working With Retrieved Data

- `mysqli_fetch_array`
  - Results in either or both types of arrays
  - `MYSQL_NUM`, `MYSQL_ASSOC`, `MYSQL_BOTH`

^ Then we have a third option, which is (_click_) `mysqli_fetch_array`. Again, used in exactly the same way, but this time, the results are returned in either a standard array, or an associative array, or both. Which is essentially an associative array that indexes it both by integers and by the column names. Now by default, it's going to do both, that's configurable. The last argument that you pass in can be a constant that will tell it either to return a number index, an associative array with the column index or both. By default it's going to do both, which is going to make your data set and your memory a lot larger.

^ The fourth option is for an object oriented approach, which is a more advanced technique that we're not going to be covering in this class.

^ Let's look at examples of these techniques (_examples/week5/databases\_retrieval.php_)

---

## Creating Records With PHP

^ We have learned how to read data from the database. The process for creating updating and deleting records is going to be very similar with a few key differences. The most important difference is just that when we do a select, we're expecting to get back rows of data as a result. Either that or an empty set with no rows. But still we're expecting a resource result to come back to us that we then parse through. With insert, update, and delete, we're not expecting to get any data back. We're just affecting a change on the database either inserting a row, deleting a row or updating a record in place. So it just returns true or false to us for whether it succeeded or whether it failed.

^ (_exercises/week5/databases\_insert.php_)

---

## Updating and Deleting Records With PHP

^ Updating and dealing records from PHP is going to be very similar to the insert process that we just saw in the last example. However there are two important differences, let's take a look.

^ (_examples/week5/databases\_update.php_)

^ (_examples/week5/databases\_delete.php_)

---

## SQL injections

^ My SQL has a very definite syntax. Once we start constructing SQL queries using dynamic data from variables, then we also have to be careful that the values we use don't break MySQL syntax.

---

## SQL injections

```sql
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('About', 1, 1)"
```

^ For example, the single quote is an important part of an insert statement because it goes around all string values. So for example if we had insert into subjects, we have the column names values and then _about_ and that goes in single quotes.

---

## SQL injections

```sql
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('{$menu_name}', '{$position}', '{$visible}')"
```

^ Now let's imagine that we've written that so that it takes a dynamic value. Where we're going to now insert menu name and menu name is going to be a variable.

---

## SQL injections

```sql
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('{$menu_name}', '{$position}', '{$visible}')"

$menu_name = "Today's Trivia";
```

^ Well what if our menu name is Today's Trivia? What if that's the string that we want to drop in there? Insert into subjects, menu name position visible, the values Today's Trivia. Do you see the problem with that?

---

## SQL injections

```sql
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('{$menu_name}', '{$position}', '{$visible}')"

$menu_name = "Today's Trivia";

"INSERT INTO subjects (menu_name, position, visible)
VALUES ('Today's Trivia', 1, 1)"
```

^ We're closing our single quotes without meaning to. The result of this is that MySQL thinks that the string that we're sending is "today," and that's it, and we have broken the rest of it. Everything else after that will be seen as being garbage and we'll get an error back.

---

## SQL injections

^ Now, this is an innocent example, but sometimes the values that come in are not ours. URL strings, form data and cookies are often coming in from the public at large. And therefore they're completely out of our control as developers. And not everyone who comes to our website has our best interests in mind. If we use those values exactly as they come in we could be in for a world of hurt. Let me show you an example.

---

## SQL injections

DO NOT DO THIS!

```sql
$menu_name = "'); DROP TABLE subjects; '";
```

^ Let's say that we have menu name and it's equal to that single quote at the beginning followed by some SQL that someone else would like us to run. Followed by another single quote at the end which they may have to modify it slightly so that it doesn't raise an error and it actually does execute. But you can see the result here.

---

## SQL injections

DO NOT DO THIS!

```sql
$menu_name = "'); DROP TABLE subjects; '";
```

^ They're basically taking what was a simple insert statement and turning it into dropping our entire table of subjects. And they can do other things, too. They can actually have it export all of our users and their passwords. This process is called _SQL injection_. The user sends a carefully crafted URL string, or a form field value, and it injects their SQL into ours. SQL injection is the single easiest way for someone to hack your website and steal your data.

---

## Escaping strings for MySQL

^ The solution, is going to be that we need to escape the string. That is, to transform it so that any problem characters that are in it are rendered harmless, just like we did with the URL and HTML file names earlier.

---

## Escaping strings for MySQL

^ The biggest problem comes from having a single quote in the data that you want to include in your SQL. The way to solve that is to escape the single quote, that is to tell MySQL this is not the single quote that ends the string, this is just part of the string.

---

## Escaping strings for MySQL

- Backslash before single-quote
- `$menu_name = "Today\'s Trivia"`

^ And the way we escape it, give it that special meaning to MySQL, is that so we put a (_click_) back slash before single quotes. So for example, if we had "today's trivia", we just simply put a (_click_) back slash in front of the single quote and then it'll be fine. MySQL will look at it, and when it gets to that backslash it will say oh, the next character has special behavior. This is not the ending single quote, this is just a single quote and then it will keep going from there until it gets to the real ending single quote.

---

## Escaping strings for MySQL

- `mysqli_real_escape_string($db, $string)`

^ Now, it's not very practical for us to always put in backslashes by hand, which is what we would be doing here. Instead, what we need is a function that will do that for us. We need some way that we can just tell it whatever the data is, whether it's data that came in from a form, whether it was pulled from a database, we want to run our function on it to escape all the values that might be in there. (_click_) That function is called _mysqli real escape string_. It's really easy to use. Let's take a look.

---

## Escaping strings for MySQL

```php
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('{$menu_name}', '{$position}', '{$visible}')"

$menu_name = "Today's Trivia";

"INSERT INTO subjects (menu_name, position, visible)
VALUES ('Today's Trivia', 1, 1)"
```

^ Review our insert code from a previous example.

---

## Escaping strings for MySQL

```php
"INSERT INTO subjects (menu_name, position, visible)
VALUES ('{$menu_name}', '{$position}', '{$visible}')"
```

^ Right now we're just dropping whatever comes from our form directly into our values.

---

## Escaping strings for MySQL

```php
$menu_name = "Today's Trivia";
```

^ If we try to drop in this menu name, we're going to have a problem because of the single quote. We could escape it by hand, but that's not useful because if the information is coming from a form we won't know what the user is typing in the input. Instead we have to use a function.

---

## Escaping strings for MySQL

```php
$menu_name = mysqli_real_escape_string($connection, $menu_name);
```

^ So we have to leave whatever comes from the form post along, but before we insert the information into the database, we will use our function to escape the values. The MySQLi Real Escape String function takes two arguments, first is the connection to the database, and then the second is going to be the old value that we want to escape. That's all there is to it. It's designed for strings so we only have to escape string values, not integers.

---

## What should you escape?

- every string going into the database!
- trust nothing

---

## For next week...
