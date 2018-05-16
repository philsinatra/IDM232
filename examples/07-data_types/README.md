# Data Types Demo

## Prep the Data

We could build the JSON file by hand, copying and pasting values from excel into a text document. Or we could use one of many conversion tools that already exist to do the conversion for us.

- **File**: `./data/data.json`

```json
{
  "categories":[
    {
      "question":"Category 1: Acceptable Forms of Identification",
      "answers":[
        "Driver's license",
        "Government identification card",
        "U.S. Armed Forces' identification card",
        "Official passport",
        "Credential that authorizes unescorted access to a security identification display area",
        "Other form of identification found acceptable by the Administrator"
      ]
    },
    {
      "question":"Category 2: Eligibility Requirements (if applicable)",
      "answers":[
        "Meets age requirement",
        "Ability to read, speak, write, and understand English",
        "Medical certificate",
        "Statement of Demonstrated Ability",
        "Logbook endorsements"
      ]
    },
    {
      "question":"Category 3: Knowledge Requirements",
      "answers":[
        "Applicable regulations",
        "Weather considerations",
        "Aircraft performance",
        "Principles of aerodynamics",
        "Aeronautical decision-making, safe operation, and emergency procedures",
        "Specific requirements for the certification/rating sought"
      ]
    },
    {
      "question":"Category 4: Experience",
      "answers":[
        "Training from an authorized instructor",
        "Required minimum training time",
        "Two or more approval documents"
      ]
    }
  ]
}
```

## Initialize Gen Script

- **File**: `./app/gen.php`

Get the contents of the `.json` file. This information is stored in the `$json` variable as a _string_.

```php
$jsonurl = "../data/data.json";
$json = file_get_contents($jsonurl, 0, null, null);

// Check `$json` value
echo $json;
```

## Convert String to PHP Array

We need to be able to manipulate this data more easily. Let's convert the string to an array.

```php
$json_output = json_decode($json);

// Check `$json_output` value
print_r($json_output);

echo "<pre>";
print_r($json_output);
echo "</pre>";
```

## Build Export Prep

Next we'll setup a couple variables we'll need in order to export our static HTML files.

```php
// The directory we will put the generated files.
$dir = "../build/";

// A basic counter
$i = 1;
```

## Prep Includes

Each file we export will share a common `head` and `footer` structure, so we'll use PHP _includes_ for that structure. This structure would have been worked out during our prototyping phase.

### Head Include

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FAA Categories</title>
  <link rel="stylesheet" href="screen.css">
</head>
<body>

  <svg style="display: none">
    <symbol id="arrow_right" viewBox="0 0 32 32">
      <polygon fill="none" points="0 .75 24 .75 24 24.75 0 24.75"/>
      <polygon fill="#FFFFFF" fill-rule="nonzero" points="8.59 17.34 13.17 12.75 8.59 8.16 10 6.75 16 12.75 10 18.75"/>
    </symbol>
    <symbol id="arrow_left" viewBox="0 0 32 32">
      <polygon fill="none" points="0 .5 24 .5 24 24.5 0 24.5"/>
      <polygon fill="#FFFFFF" fill-rule="nonzero" points="15.41 17.09 10.83 12.5 15.41 7.91 14 6.5 8 12.5 14 18.5"/>
    </symbol>
  </svg>

  <div class="wrapper">
    <main role="main">
```

### Footer Include

```html
  <script src="main.js"></script>
</body>
</html>
```

Let's add both of these includes to our gen script as variables so we have access to them when we need them.

```php
$head = "../includes/_head.php";
$footer = "../includes/_footer.php";
```

## Begin the Build

Next we'll begin building the unique content for each page of output. Loop through all the of `categories` in the JSON data, for each single `category` (which is a question), we're going to generate a unique HTML file.

We have an array object that contains all of the information for each question. Our goal is to generate one HTML file for each question in our data. Since we have to step through the data one question at a time, we'll use a loop.

One important difference to note is that we're not working with a standard array. We're working with an object that technically could contain more than just a single array of information.

Because that's the case, our loop syntax needs to be adjusted.

```php
foreach ($json_output->categories as $category) {
```

## Get the Head

We're now inside the loop, focused on generating each HTML file based on the current iteration within the loop. At the start of every HTML file, comes the `<head>` content, which we have available in an _include_.

```php
foreach ($json_output->categories as $category) {
  $output = file_get_contents($head);
```

## Build the Question

Now that we have the `<head>` content in place, we can proceed with building the main content on the page.

```php
$output .= "<h1>{$category->question}</h1>";
$output .= "<ul>";
```

We'll need a second counter, which we'll use inside a second loop in a minute.

```php
$count = 1;
```

## Build the Answers

For each possible "answer", we'll create a `<li>` with an `<a>` the user can click on. All of this structure and CSS has already been worked out during the prototyping phase.

Since there are multiple possible "answers", we will use another loop to cycle through, creating a new list item for each item.

```php
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

Once the loop is finished we have to close the list and other HTML containers we're using for structure.

```php
$output .= "</ul>";
$output .= "</main>";
$output .= "</div>"; // /.wrapper
```

## Page Navigation

Remember that first counter we created. If that primary counter is greater than 1, we're not building the first question page. That means we need a _previous_ button.

```php
if ($i > 1) {
  $previous = $i - 1;
  $output .= "<a href=\"question-{$previous}.html\" class=\"btn_pagenav\" id=\"btn_prev\">";
  $output .= "<svg><use xlink:href=\"#arrow_left\"></use></svg>";
  $output .= "</a>";
}
```

If our primary counter is not equal to the number of total categories, we're not building the last question page. That means we need a _next_ button.

```php
if ($i != count($json_output->categories)) {
  $next = $i + 1;
  $output .= "<a href=\"question-{$next}.html\" class=\"btn_pagenav\" id=\"btn_next\">";
  $output .= "<svg><use xlink:href=\"#arrow_right\"></use></svg>";
  $output .= "</a>";
}
```

## Inline JavaScript

Next we have to add some additional help for our JavaScript, telling our script if there is a next/previous screen. We'll use PHP to add some inline JavaScript to the bottom of each page. JavaScript is going to look for these variables and add eventListeners for page navigation.

```php
$output .= "<script>";
$output .= "let hasPreviousScreen = 0;\r";
$output .= "let hasNextScreen = 0;\r";
if ($i > 1)
  $output .= "hasPreviousScreen = \"question-{$previous}.html\";\r";
if ($i != count($json_output->categories))
  $output .= "hasNextScreen = \"question-{$next}.html\";\r";
$output .= "</script>";
```

## Add Footer Include

Get the footer include file and add it to the end of each page.

```php
$output .= file_get_contents($footer);
```

## Write a new HTML file

```php
  $file = fopen($dir . "question-" . $i . ".html", "w");
  fwrite($file, $output);
  fclose($file);

// Increment our counter, and repeat the loop for the next question in the array.
  $i++;
}

// When the loop is done, echo a message:

echo "Done. Check the {$dir} directory for static HTML files.";
```

## Let's Test It Out

---

## Build Process

Next we need to build the tool that will generate the files we need for this project, and for other instances of games like this. We'll do it with a simple AJAX form.

- **File**: `./build.html`

```html
<form>
  <button type="submit" id="btnSubmit">Build HTML Files</button>
</form>
```

```javascript
/**
 * AJAX function to execute PHP script when submit button is clicked.
 * @type {XMLHttpRequest}
 */
const xhr = new XMLHttpRequest();
const method = 'GET';
const url = 'app/bin/gen.php';

// A variable that finds the submit button in the DOM.
const button = document.getElementById('btnSubmit');
// Event listener for what to do when the submit button is clicked.
button.addEventListener('click', generateFiles, false);
```

Last we write the function to be executed.

```javascript
/**
 * Generate static HTML files by executing the
 * 'app/bin/gen.php' script.
 * This script is specified in the `url` variable above.
 */
const generateFiles = (event) => {
  // Prevent the default event which would be a form submission.
  event.preventDefault();

  // Open the `xhr` request to our `gen.php` script.
  xhr.open(method, url, true);
  // Listen for the `gen.php` script to execute.
  xhr.onreadystatechange = function() {
    // If the script executes successfully:
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Check the browser console.
      console.log(xhr.responseText);
    }
  };
  // Send the request.
  xhr.send();
}
```