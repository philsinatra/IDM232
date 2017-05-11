build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 1

### Overview

---

## Hello

| Instructor | Email | Github/Twitter |
| ---------- | ----- | ------ | ------- |
| ![](https://avatars2.githubusercontent.com/u/1465808?v=3&s=460) Phil Sinatra | [ps42@drexel.edu](mailto:ps42@drexel.edu) | @philsinatra |
| ![](https://avatars1.githubusercontent.com/u/1268159?v=3&s=460) Jervis Thompson | [st966rc2@drexel.edu](mailto:st966rc2@drexel.edu) | @jervo |

---

## About This Course

- [Drexel Learn](https://learn.dcollege.net/webapps/login/)
- [Course Repository](https://github.com/philsinatra/IDM232)

^ All course information including syllabus, overview and assignments will be managed through Drexel's Blackboard (BBLearn) system. Let's log in and review the syllabus and course information now.

---

## What is PHP?

- Server-side scripting language
- Not a compiled language
- Designed for use with HTML
- Provides more flexibility than HTML alone

^ We're going to start out by talking about what is PHP? (_click_) PHP is a server side scripting language. When we say _server side_, and its opposite _client side_, we're talking about where the code does the work. When the code runs on a web server, it is server side; when the code runs on the user's computer, it is client side. JavaScript is a popular client side scripting language.

^ (click) PHP is not a compiled language, it can not run on its own. We'll need to have a running web server in order to use PHP. PHP code is executed by the web server exactly as it's written. (click) PHP is designed for use with HTML and can be embedded in our HTML.

^ (click) You can think of PHP as turbo charging your HTML.

---

## The history of PHP

- Version 1: 1994
- Version 2: 1995
- Version 3: 1998
- Version 4: 2000
- Version 5: 2004
- Version 7: 2015

^ A full history is available online.

---

## Why choose PHP?

- Open-source, free software
- Cross platform
- Powerful, robust, and scalable
- Designed for the web
- Can be object-oriented
- Great documentation in many languages

^ There are many reasons to use PHP over other web technologies. (click) PHP is open source and free software. Open source means the source code is available for everyone to study, use or modify. (click) PHP is cross platform, which means it can be put on a Windows, Mac or Linux server and run the same code with no problems or differences. (click) Just because it's open source and free, it doesn't mean it's inferior or not powerful.

^ (click) PHP functions are designed for web usage. (click) It is also fully object oriented since version five. This includes some advanced features you can take advantage of as your skills continue to progress. (click) PHP has great documentation in many languages. If you go to php.net you'll see this.

---

## Installation Overview

- Web server
- PHP
- Database
- Text editor
- Web browser

^ In order to install PHP on your computer you're going to need a few things. (click) First we need a web server to serve up the web files that we are going to look at in our browser. We're going to install that on our local machine. (explain local vs remote server).

^ (click) We're going to need PHP installed. (click) We're going to need a database so we can create PHP applications that connect to that database. That will allow us to be able to store data, and pull data out of the database and display it to the user.

^ (click) We'll need a text editor, and obviously (click) a browser.

---

## Installation Overview

- LAMP
- MAMP
- WAMP
- XAMP

^ Each developer's setup will be slightly different. There are some common combinations of platform, web server and database. The four most common are:

---

$$ LAMP = Linux+Apache+MySQL+PHP $$

$$ MAMP = Macintosh+Apache+MySQL+PHP $$

$$ WAMP = Windows+Apache+MySQL+PHP $$

$$ XAMP = (L|M|W)+Apache+MySQL+PHP $$

^ There are other combinations, but these are the most popular. We'll take a look at getting setup with MAMP and WAMP, if anyone is using Linux we can also look at a LAMP setup. Rather than manually setting up a web server, installing MySQL database and PHP software, we're going to look at some applications that are available to add to your system that include all of these pieces of software, and provide a GUI for managing them.

---

## Mac Installation

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/mamp.png)

[https://www.mamp.info/en/](https://www.mamp.info/en/)

^ For Mac users, that application is going to be MAMP. It is available for download at [https://www.mamp.info/en/](https://www.mamp.info/en/). There is a free version and a pro version. The free version will be fine for this class. If you develop more complicated projects or require multiple web servers to run at the same time, the pro version is worth the upgrade cost.

---

### MAMP

![inline](https://www.mamp.info/en/images/screenshots/en_mamp-start.jpg)

^ This is what the running application looks like. You can turn on the Apache web server and MySQL server by clicking a button, and there are a full list of preferences available for making changes to your setup at any time.

---

### MAMP

![inline](https://www.mamp.info/en/images/screenshots/en_win_mamp-start.jpg)

^ There is a Windows version of this application available, I have never tried it before but it may be worth testing if you are a Windows developer simply because of the ease of use.

---

## Windows Installation

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/wamp.png)

[http://www.wampserver.com/en/](http://www.wampserver.com/en/)

^ For Windows users, you can try the MAMP version for Windows, or you can use WAMPServer, shown here. I have included additional notes about WAMP installation and setup in the `docs` section of the repository.

---

## Root Paths

- MAC:
  - `/Applications/MAMP/htdocs/folder/file.php`
  - `localhost:8888/folder/file.php`
- Windows:
  - `c:\wamp\www\folder/file.php`
  - `localhost/folder/file.php`

^ Depending on your setup you will need to store your files in a specific location, and then access them via the browser through a specific URL. (example of `htdocs` Finder setup and browser navigation).

^ (example of `htdocs` alias)

---

## Embedding PHP Code

```php
<?php       ?>
```

^ This is the opening and closing of a block of PHP code. What this does is essentially tell the Apache server _as you're processing this document, turn on PHP_. Everything that comes after the opening tag is interpreted as PHP code, until the ending tag, at which point we're done with PHP and we can go back to HTML rendering.

---

## Embedding PHP Code

```html
<?php phpinfo(); ?>

<div class="phpinfo">
  <?php
    phpinfo();
  ?>
</div>
```

^ This allows us to embed PHP into the HTML. White space is ignored, so we can use it to our advantage and use line breaks and indentation to make our code legible.

---

## Embedding PHP Code

```php
<?php
  phpinfo();
  echo "Hello World";
  $message = "Winter is coming.";
?>
```

^ Since white space doesn't matter, we need a reliable way to know that each PHP command is finished and we're ready to move on to the next command. Can anyone tell me what PHP is using to separate commands?

^ Every line in PHP is going to end in a semicolon, so get used to it.

---

## Working with PHP

- must use _.php_ file extension
- must serve files from a web server
- must use `<?php` and `?>` tags around all PHP code

^ When you access the PHP module within your document, (_click_) you have to use the .php file extension for your file. If you put PHP code in a .html document, the browser will not render the PHP or execute its functions.

^ (_click_) Your files must be on a web server. You can not open your finder and double click a PHP document and expect it to work.

^ (_click_) All PHP code must be wrapped in PHP tags.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/amazon.png)

^ One of the most powerful aspects of PHP is it's ability to output dynamic text. PHP can grab content from a database and display it so that and HTML page can show different users different content, (think Amazon). We're going to start looking a how we can output dynamic text first by simply outputting a few words. From here, we'll be able to pull things from the database and build more elaborate stuff.

---

## `echo`

```php
<?php echo "Hello World"; ?>
```

^ To start with, we're going to learn probably the most important PHP you'll need to know, the `echo` command. Echo is going to turn whatever we to say, back to the user, like an echo. Think of it like printing to the user's browser.  So here's an example, we have the opening PHP tags, a space and then inside quotes, Hello World, a semicolon and then the closing PHP tag. That will send to the user's browser a embed on the page of _Hello World_ with no quotes. (example)

---

## `echo`

```php
<?php echo "Hello" . " World"; ?>
```

^ Let's try another one, we're going to concatenate two parts together. We have Hello World again, but this time let's put quotes around each word so they are two different quoted strings. The period is going to concatenate them together, that is smash them together dynamically creating one new string that gets echoed back.

---

## `echo`

```php
<?php echo 2 + 3;  // 5 ?>
 ```

^ PHP can work with numbers too, let's perform a simple math example and `echo` the result.

---

## The Operation Trail

^ To better understand how PHP works, we're going to take a look at the request-response cycle, which describes the way that a browser and a web server communicate to process user requests.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_01.png)

^ To start, we have our browser and then we have the web server.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_02.png)

^ Our browser makes a request to the web server. That's when you type in the domain of the site (yourwebsite.com). It sends a request to yourwebsite.com. When we're working in our dev environment, that's going to be local host.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_03.png)

^ On that web server software needs to be there to intercept that request, and we have a HTTP Daemon called _Apache_.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_04.png)

^ Apache  see's the request and says "oh, okay, I'm going to see if I have a file that will help me to respond to that request". It goes to the file system and looks for a file.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_05.png)

^ Let's call that file `hello.php`. Apache grabs that file and then says "I see that it has .php at the end". There may be PHP here that needs process, Apache will do that.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_06.png)

^ So it goes to process the PHP.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_07.png)

^ In doing that, it may need to go back and forth to the database, store information in the database etc. All sorts of things can happen as it goes back and forth. But once it's done processing the PHP, there's one final step...

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_08.png)

^ where it assembles the HTML that's going to be returned and then...

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_09.png)

^ it ships it back to the browser. It's important to have a firm grasp of this cycle right from the start.

---

## Code Comments

```php
// Hello PHP
echo "Hello";
/* I'm so excited for IDM232.
   I love Scripting so much. */
echo "Sure you do";
# Insert more information.
```

^ Just like in HTML and CSS, PHP allows us to write code comments. To be a good developer, it is important to learn about code comments in all programming languages. You want to add comments to your code so that you or someone else coming to look at the code later. Can quickly understand what your code is trying to accomplish, and understand the approach that you took. Comments take additional time to write, but they pay off and save you time later. In PHP, there are a couple of ways we can write comments.

---

### Single Line Comments

```php
<?php
  // single line comment
  echo "hello world.";
?>
```

^ We can make single line comments by simply opening PHP tags, and then putting in // followed by our comment, single line comments are like this.

---

### Single Line Comments

```php
<?php
  // single line comment
  # or like this
  echo "hello world.";
?>
```

^ Or you can use a pound sign, but this is less common. Best practice is to use the two slash method for single line comments.

---

### Double Line Comments

```php
<?php
  /* Multi-Line comments are written
  like this, similar to CSS */
  echo "hello world";
?>
```

^ For comments that span multiple lines, use a slash star format, similar to CSS.

---

### [docBlockr](https://packagecontrol.io/packages/DocBlockr)

```php
<?php
/**
 * [hello_world description]
 * @return [type] [description]
 */
function hello_world() {
  // function content here
}
?>
```

^ There are some plugins for our editor that can really enhance our commenting and save us some time, allowing us to focus on the writing portion.

---

![](https://youtu.be/dgV6c3_VdKk)

^ DocBlockr is available for Sublime Text and Atom, and has support for all of the languages we've been learning over the past few terms. The link to the package home page is in the notes of this presentation: [https://packagecontrol.io/packages/DocBlockr](https://packagecontrol.io/packages/DocBlockr)

---

```php
<?php
/**
 * [hello_world description]
 * @return [type] [description]
 */
function hello_world() {
  // function content here
}
?>
```

^ Comments are super important to writing good code. They can be hard to be disciplined about it. You get caught up in writing the code, and often you forget to leave yourself comments. But once you start programming a lot you'll realize that comments are going to save you a lot of time, not now, but 10 weeks from now. When you come back to the code. You can't remember what you were trying to do or why you chose a certain approach. It's one of those things where investing a little bit of time in the beginning is going to save you lots of time later on. And comments are especially friendly if there's ever someone else who's going to be working with your code, because they don't know what you were thinking. They don't know the reasoning that you went through to arrive at a solution to a certain problem, but your comments can make it clear to them.

---

## For Next Week...
