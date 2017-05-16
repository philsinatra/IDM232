build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 7
### Reading and Writing Files and Data Types

---

[.build-lists: false]

## A New Job

- client will provide:
  - topics
  - answers
  - basically: the data

^ Our client has a new project request. They want to create a web based game application that mimics Family Feud. They're going to use this app to reinforce training topics that students have already studied in a classroom setting. The client will provide the topics and the answers that are revealed for each topic.

---

[.build-lists: false]

## A New Job

- developers will provide:
  - web app files

^ We (the developers) have to take the information, build it into a functional web application, and provide the files back to the client so they can run the game in their training environment. Should be simple right? So where do we begin?

---

## How Should We Begin?

^ (Have students suggest a workflow to begin the project. Possibilities include: wireframes, style tiles, client interviews etc.)

---

## Compile and Ask Questions

- how will the data be provided?
- what OS is running in the classroom?
- what browser will be used?
- what resolution will the project be running?
- where will the files be hosted? (locally? web server?)
- any security/firewall issues?
- what else?

^ Even before we sketch/wireframe, we need more details. We should interview the client and get more information about the project. What are some questions we should ask?

---

## Some Answers

- Microsoft XLSX
- Windows OS
- Google Chrome
- 1920 x 1080
- local web server
- no firewall
- no PHP/MySQL installed
- will need more games over time

^ So we've conducted our interview and now we have some answers.

---

## Project Planning

- UI design
  - sketch/wireframe
  - style tiles
  - prototype
- Data structure & development?

^ (_click_) So the UI design portion of this is set - we can go off and work on sketches, wireframes, style tiles and being building the front end in the browser. But what about the back end? (_click_) Dealing with the data? The files are going to run on a web server, but we will not have PHP or MySQL available in the production environment.

^ Can we still use PHP to build this project? Can we use MySQL? Should we use something else?

---

## Project Planning

- PHP: YES
- MySQL: maybe

^ I can tell you in this example, (_click_) we definitely can still use PHP, and we (_click_) may even use MySQL. Can anyone tell me how? Let's examine the data from the client. (_examples/week7/data.xlsx_)

---

## Dealing With Data

1. hand code HTML pages
1. convert xlsx data to MySQL format
1. convert xlsx data to some other format

^ We have xlsx data, which isn't going to translate directly to our app interface. But from excel, we have a lot of options for exporting the content in different formats. So what are our options in dealing with this data?

^ (_click through list and discuss_)

^ Even if we convert the data to MySQL or some other format, we know we can't run PHP on the client's server. But perhaps we can use PHP and MySQL to develop the files that we deliver to the client. We're going to use PHP on our servers to develop the file set that the client can run on their server.

---

## Dealing With Data

- MySQL
- CSV
- XML
- JSON
- Javascript Array

^ (_click_) MySQL is a database, with structured tables. It is a solid option for a web application, but in this case we know the final production environment doesn't have support for MySQL, so this format is not ideal. (_click_) CSV, or comma separated values is a simplified list of our excel data, which is somewhat modular and can be used to convert our data into other formats. It's not ideal for direct use on the web. Then there's (_click_) XML, or the newer (_click_) JSON; maybe even a simple (_click_) Javascript array would work?

---

### XML - eXtensible Markup Language

```xml
<?xml version="1.0" encoding="UTF-8"?>
<note>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don't forget me this weekend!</body>
</note>
```

^ XML plays an important role in many different IT systems. XML is often used for distributing data over the Internet. It is important (for all types of software developers!) to have a good understanding of XML.

---

### JSON

- Data is in name/value pairs
- Data is separated by commas
- Curly braces hold objects
- Square brackets hold arrays

^ The JSON syntax is a subset of the JavaScript syntax.

---

### JSON

```json
{
  "categories":[
    {
      "question":"Category 1: Acceptable Forms of Identification",
      "answers":[
        "Driver's license",
        "Government identification card",
        "U.S. Armed Forces' identification card"
      ]
    }
  ]
}
```

^ Here's an example of the JSON syntax, composed of any number of objects and arrays filled with information. This is a lightweight, versatile way to transfer and manipulate data. Perhaps we can leverage this data type for this project?

---

## XLSX to JSON?

- XLSX to CSV
- CSV to JSON
- [converter](http://shancarter.github.io/mr-data-converter/)

^ So we could build the JSON file by hand, copying and pasting values from excel into a text document. Or we could use one of many conversion tools that already exist to do the conversion for us.

---

## Build It

- PHP reads JSON
- Loops through JSON
- Exports static HTML files

^ Here's our basic to do list for our development process:

---

### PHP Reads JSON

```php
$json_source = "data.json";
$json = file_get_contents($json_source, 0, null, null);
```

[file\_get\_contents](http://php.net/manual/en/function.file-get-contents.php)

^ PHP has many built in functions. We can't possible cover them all in ten weeks. It's important to always think critically when you have a problem and see if there's a function that can assist. If not, then you build your own function. In this case, PHP has a function `file_get_contents` that reads the entire contents of a file into a string. So basically, the variable `$json` now contains all the information in the JSON file.

---

### PHP Reads JSON

```php
$json_source = "data.json";
$json = file_get_contents($json_source, 0, null, null);
$json_output = json_decode($json);
```

[json_decode](http://php.net/manual/en/function.json-decode.php)

^ Next, we take advantage of the `json_decode` function, which takes a JSON encoded string and converts it into a PHP variable. We now have all of the JSON data stored in a PHP variable that we can traverse and manipulate as needed.

---

### Output HTML Files

```php
$dir = "build/";
```

^ Next, let's decide where we're going to put our files for the client. We'll create a folder called _build_ where all of the HTML files will end up. This is where we will "build" the clients files.

---

### Output HTML Files

```php
if (!file_exists($dir))
  mkdir($dir, 0755, true);
```

[mkdir](http://php.net/manual/en/function.mkdir.php)

^ The `mkdir` function attempts to create the directory specified by pathname. So if this folder doesn't exist, we're going to create it. All the parameters listed there are outlined on php.net.

---

### Output HTML Files

```json
{
  "categories":[
    {
      "question":"Category 1: Acceptable Forms of Identification",
      "answers":[
        "Driver's license",
        "Government identification card",
        "U.S. Armed Forces' identification card"
      ]
    }
  ]
}
```

^ A quick review of our JSON data, here's the top of the file. The actual file could have as many entries as necessary. Each could have as many possible answers, not always exactly only three.

---

### Output HTML Files

```php
foreach ($json_output->categories as $category) {
```

^ Next, we're going to loop through all of the _categories_ in the JSON data.

---

### Output HTML Files

#### JSON

```json
"question":"Category 1: Acceptable Forms of Identification",
```

#### PHP

```php
foreach ($json_output->categories as $category) {
  $output = "<h1>{$category->question}</h1>";
```

^ We start to put together the content for our static HTML file. In our `h1` element at the top of the page, we're going to extract and display the "question" text from our JSON data.

---

### Output HTML Files

```json
"answers":[
  "Driver's license",
  "Government identification card",
  "U.S. Armed Forces' identification card"
]
```

^ Let's review the JSON data again. After the _question_, we have an array called _answers_ that can contain any number of possible answers. Remember on Family Feud not every topic had the same number of possible answers on the board.

---

### Output HTML Files

```php
foreach ($json_output->categories as $category) {
  $output = "<h1>{$category->question}</h1>";
  $output .= "<ul>";
  foreach ($category->answers as $answer) {
    $output .= "<li>{$answer}</li>";
  }
  $output .= "</ul>";
```

^ Within our loop, for each category, we then loop through all the possible answers associated with the current category. We'll write all of those values into an unordered list.

---

### Output HTML Files

```html
<h1>Category 1: Acceptable Forms of Identification</h1>
<ul>
  <li>Driver's license</li>
  <li>Government identification card</li>
  <li>U.S. Armed Forces' identification card</li>
</ul>
```

---

### Output HTML Files

```php
$file = fopen($dir . "question-" . $i . ".html", "w");
fwrite($file, $output);
fclose($file);
```

- [fopen](http://php.net/manual/en/function.fopen.php)
- [fwrite](http://php.net/manual/en/function.fwrite.php)
- [fclose](http://php.net/manual/en/function.fclose.php)

^ Now we have the output for one of the questions with all of the available options. Before we loop through to the next category, we need to create an HTML file with this structure and data.

^ (_click_) `fopen` opens file or URL.

^ (_click_) `fwrite` writes the contents of string to the file stream pointed to by handle.

^ (_click_) `fclose` closes the file.

---

### Output HTML Files

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <title>Categories Game</title>
  <link rel="stylesheet" href="screen.css">
</head>
<body>
```

^ Before we write the files - we have to make sure we're actually generating valid HTML. We're going to need to style the pages, and add javascript for functionality enhancements. What we deliver to the client has to look like it was actually coded by hand from scratch, be total valid and progressively enhanced. PHP and JSON are just tools we're using to automate the process. So we're going to need a valid HTML document, starting with our normal page head.

---

### Output HTML Files

```php
$head = 'includes/_head.php';
$output = file_get_contents($head);
```

- [file\_get\_contents](http://php.net/manual/en/function.file-get-contents.php)

^ So we can store our partial, _head_ content in a file. When we're building a PHP application, we can _include_ partials into our code using the `include` and `require` functions. In this case, we want to do something similar, but we actually want to take the contents of our _head_ partial and add them to our final HTML output. We can use the `file\_get\_contents` function to do just that.

---

### Review Example

    bin/
      gen.php
    build/
      screen.css
      index.html
      question-1.html
      question-2.html
      scripts.js
    data
      data.json
    includes
      _head.php
      _footer.php

^ Let's look at the full example code and the final product. Here's how our files are going to be organized. `gen.php` is the main script. It's going to read in the _head_ and _footer_ includes, and the JSON data. It's then going to create each of the _question_ HTML files. The CSS and Javascript is sourced and compiled elsewhere.

---

### `gen.php`

```php
<?php
  $head        = '../includes/_head.php';
  $footer      = '../includes/_footer.php';

  $jsonurl     = '../data/data.json';
  $json        = file_get_contents($jsonurl, 0, null, null);
  $json_output = json_decode($json);
```

^ We define the paths to the _head_ and _footer_ includes so we have them ready. We also load the JSON data and decode it into a PHP variable so it's ready for us to traverse.

---

### `gen.php` Prep Output

```php
$i = 1;
$dir = "../build/";
```

^ We setup a counter variable `$i`, and define where our HTML files will be output to.

---

### `gen.php` Begin Loop

```php
foreach ($json_output->categories as $category) {
  $output = file_get_contents($head);

  $output .= "<h1>{$category->question}</h1>";
  $output .= "<ul>";
```

^ Next we begin looping through the JSON data to build each HTML file. We are going to start each HTML file with our _head_ include, followed by a heading that displays the question, and then we open an unordered list, which will hold the answers.

---

### `gen.php` Answers Loop

```php
$count = 1;
foreach ($category->answers as $answer) {
  $output .= "<li>";
  $output .= "<a href=\"#q_{$count}\" class=\"btn_option\">";
  $output .= "<span class=\"q_num\">{$count}</span>";
  $output .= "<span class=\"q_answer\">{$answer}</span>";
  $output .= "</a>";
  $output .= "</li>";
  $count++;
}
```

^ Next we loop through all of the answers associated with a single question, and build out our list items.

---

### `gen.php` End Loop

```php
$output .= "</ul>";
$output .= "</main>";
$output .= "</div>"; // /.wrapper
```

^ After the list items are added to our output, we can close the unordered list, and then the main containers holding our content.

---

### `gen.php` Navigation - Previous

```php
if ($i > 1) {
  $previous = $i - 1;
  $output .= "<a href=\"question-{$previous}.html\" ";
  $output .= "class=\"btn_pagenav\" id=\"btn_prev\">";
  $output .= "<svg><use xlink:href=\"#arrow_left\"></use></svg>";
  $output .= "</a>";
}
```

^ If we're building any page other than the first page, we'll need to include a _previous_ button in our navigation. This example is going to use an SVG icon in our link.

---

### `gen.php` Navigation - Next

```php
if ($i != count($json_output->categories)) {
  $next = $i + 1;
  $output .= "<a href=\"question-{$next}.html\" ";
  $output .= "class=\"btn_pagenav\" id=\"btn_next\">";
  $output .= "<svg><use xlink:href=\"#arrow_right\"></use></svg>";
  $output .= "</a>";
}
```

^ And if we're on any screen other than the last question, we'll also need a _next_ button.

---

### `gen.php` Scripts

```php
$output .= "<script>";
$output .= "var has_previous_screen = 0;\r";
$output .= "var has_next_screen = 0;\r";
```

^ We're also going to use PHP to write some Javascript on our page, to help with figuring out if we're on the first or last screen during the export process. So here, we're prepping some Javascript global variables.

---

### `gen.php` Scripts

```php
if ($i > 1)
  $output .= "has_previous_screen = \"question-{$previous}.html\";\r";
```

^ Once again, if we're on any screen other than the first, we need a previous button. So we'll dynamically setup the Javascript variable to hold the previous screen number for our link.

---

### `gen.php` Scripts

```php
if ($i != count($json_output->categories))
  $output .= "has_next_screen = \"question-{$next}.html\";\r";
```

^ Same thing for our next screen variable.

---

### `gen.php` Footer

```php
$output .= "</script>";

$output .= file_get_contents($footer);
```

^ Close the script tag and add the contents of our _footer_ include.

---

### `gen.sh` Write the Files

```php
  $file = fopen($dir . "question-" . $i . ".html", "w");
  fwrite($file, $output);
  fclose($file);

  $i++;
}
```

^ Write each file, and increment our counter before the loop goes to the next item and repeats. This will generate our HTML files in the _build_ folder for us.

---

## How Do We Run It?

- navigate to `gen.php` in browser
- build a form and submit
- build a form and submit with ajax
- run via command line

^ So now we have our script, how can we run it so it does our heavy lifting?

---

### In the Browser

- simple
- refresh the page to refresh the output

^ Navigating to the page in the browser is (_click_) simple, requires less work. Every time we want to regenerate the files, we just have to refresh the page. Simple, (_click_) but not elegant. Okay for a dev environment, but we wouldn't want to keep the process this rudimentary beyond our own desktop.

---

### Build A Form

- somewhat simple
- click button to reload
- requires two redirects

^ We could build a form that when submitted, moves to the `gen.php` script, executes it and then returns us to our form page. (_click_) It's not to complicated, but still not very (_click_) elegant since there would be (_click_) two page reloads to complete the process.

---

### Build A Form With AJAX

- moderately complicated
- click button to rebuild
- elegant

^ AJAX stands for Asynchronous JavaScript and XML. In a nutshell, it is the use of the XMLHttpRequest object to communicate with server-side scripts. It can send as well as receive information in a variety of formats, including JSON, XML, HTML, and even text files. AJAX’s most appealing characteristic is its "asynchronous" nature which means it can communicate with the server, exchange data, and update the page all without having to refresh the browser.

^ (_click_) A setup like this will take a bit of extra work. (_click_) It will eliminate the multiple page redirects, (_click_) basically becoming a more elegant user experience.

---

### Command Line

- simple
- not very elegant
- requires PHP and shell access

^ (_click_) Running the script from the command line would be simple, but much like some of the earlier options it would (_click_) not be as elegant, and would (_click_) require shell access which may not be possible outside of your local machine.

---

## AJAX Example

### Add `build` File

    build.html
    app/

### HTML Form

```html
<form>
  <button type="submit" id="btnSubmit">Build HTML Files</button>
</form>
```

---

## AJAX Example

```javascript
var xhr = new XMLHttpRequest(),
    method = 'GET',
    url = 'app/bin/gen.php';
```

^ With AJAX you can setup an HTTP request that targets our `gen.php` script. So basically we want to push a button and run the script on the server, without having to refresh the page we're on. We want the script to run in the background, asynchronously, and report back to us when done. Here we're setting up the global variables we'll need. We do all of this with Javascript and PHP.

---

## AJAX Request

```javascript
var button = document.getElementById('btnSubmit');
button.addEventListener('click', generateFiles, false);
```

^ Our button event listener, calling a function `generateFiles`.

---

## AJAX Request

```javascript
function generateFiles(event) {
  event.preventDefault();
  xhr.open(method, url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send();
}
```

^ 1. Prevent the default action (submitting the form via HTML)

^ 2. Open the request to our `gen.php` script

^ 3. Listen for when that request state changes, which basically means listen for when the script is done.

^ 4. If everything went well, log the response to our console.

^ 5. We're all set -> send the request aka execute the script.

---

## Live Demo

^ (_examples/week7/build.html_) in a browser running through MAMP server.

---

## Why Build It This Way?

^ So why did we build this project with the JSON format instead of using MySQL?

---

[.build-lists: false]

## Some Answers

- Microsoft XLSX
- Windows OS
- Google Chrome
- 1920 x 1080
- local web server
- no firewall
- no PHP/MySQL installed
- will need more games over time

^ Go back to the information we got from the client when we conducted our interview.

---

## For Next Week...
