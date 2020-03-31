# 08 Ajax Example

## HTML Form

Here's the basic form we'll be using for the example. It only collects one piece of information, 'username'.

```html
<div class="container">
  <form action="includes/process.php" method="post" name="myForm" id="myForm">
    <div>
      <label for="username">User name</label>
      <input type="text" name="username" id="username" placeholder="janesmith" required>
    </div>
    <input type="submit" name="submit" id="btnSubmit" value="Submit">
  </form>
</div>
```

## Initial JavaScript Setup

When the user submits the form, we want to intercept the default functionality with JavaScript. Initially, we'll prevent the default actions, and gather some data.

```javascript
const form = document.getElementById('myForm');
const btnSubmit = document.getElementById('btnSubmit');

const processForm = (event) => {
  console.log('Form submitted');
  console.group('Event Info');
  console.log(event);
  console.log(event.target.parentNode.attributes.action);
  console.log(event.target.parentNode.attributes.action.value);
  console.groupEnd();

  event.preventDefault();
};

btnSubmit.addEventListener('click', processForm);
```

## Validate Form

Since we are preventing the default functionality, our 'required' fields are not working exactly as expected. Even though the browser is telling us the field is required, it is also executing our `processForm` function, which means we need to do some extra validation work.

This example is **extremely** simplistic and meant to only be an example. Your validation code will need to be much more robust.

First, let's add the validation call to our `processForm` function:

```javascript
const processForm = (event) => {
console.log('Form submitted');
  // Validate form
  const validation = validateForm();
  console.log(validation);
```

Next we have to write the function to be executed:

```javascript
const validateForm = () => {
  const inputFields = form.querySelectorAll('input[type="text"]');
  let errors = [];
  console.log(inputFields);

  for (const input of inputFields) {
    if (input.value === '') {
      errors.push(input.name);
    }
  }

  return errors;
};
```

Last - do something based on what is returned from our validation function:

```javascript
const processForm = (event) => {
  console.log('Form submitted');

  // Validate form
  const validation = validateForm();
  console.log(validation);

  if (validation.length !== 0) {
    console.log('Validation Errors');
    return false;
  }
```

## Create HTTP Request

Use JavaScript to collect the data in the form fields, and them make a request to our processing script to do something with that data:

```javascript
let httpRequest;
```

```javascript
const action = event.target.parentNode.attributes.action.value;
const data = new FormData(form);
httpRequest = new XMLHttpRequest();

if (!httpRequest) {
  window.alert('Cannot create an XMLHTTP instance');
  return false;
}

httpRequest.onreadystatechange = alertContents;
httpRequest.open('POST', action, true);
httpRequest.send(data);
```

## Alert Content of Form

Write the function that will be executed when the status of our request changes (aka the form is submitted):

```javascript
const alertContents = () => {
  if (httpRequest.readyState === XMLHttpRequest.DONE) {
   if (httpRequest.status === 200) {
     console.log('Success');
   } else {
     console.log('There was a problem with the request.');
   }
 }
};
```

## Setup Process Include

Initially, let's simply collect the user name data, and `echo` it.

```php
<?php
  $user_name = $_POST["username"];
  echo $user_name;
?>
```

## Catch Process Response

Whatever is echoed in our processing script is returned to our JavaScript file as the `responseText`.

In the event of a communication error (such as the server going down), an exception will be thrown in the onreadystatechange method when accessing the response status. To mitigate this problem, you could wrap your `if`/`then` statement in a `try`/`catch`:

```javascript
const alertContents = () => {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        console.log(httpRequest.responseText);
      } else {
        console.log('There was a problem with the request.');
      }
    }
  } catch (event) {
    console.log(`Caught Exception: ${event.description}`);
  }
};
```

## Catch Process Data Response

Update the processing script to add extra validation that there is a username in the submitted data:

```php
if (isset($_POST["username"])) {
  $user_name = $_POST["username"];
} else {
  $user_name = "No Name";
}

echo $user_name;
```

### Shorthand If Statement

PHP has a shorthand syntax for `if` statements. This syntax will check the value of the initial function, and then assign one of the two following values to the original variable.

```php
$user_name = (isset($_POST["username"])) ? $_POST["username"] : "No Name";
```

## Process Data Array

Let's send back more data than only the username. Just like a return from a function call, we can only `echo` one item to our `responseText`. To work with more than one value, we'll use an array.

An important step here is to use a special function `json_encode`, which will convert this PHP array variable data to a string representation of the supplied value.

```php
$message = "Hello, {$user_name}";
$return = [
  "userName" => $user_name,
  "computedString" => $message
];

echo json_encode($return);
```

Once that data is processed and returned to our JavaScript, we use a special function `JSON.parse`. This will take the string data from our PHP script, and convert it to a JavaScript object.

Then we can use standard dot notation to access any of the object keys and their values.

```javascript
const alertContents = () => {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        const response = JSON.parse(httpRequest.responseText);
        console.log(response);
        console.log(response.computedString);
      } else {
        console.log('There was a problem with the request.');
      }
    }
  } catch (event) {
    console.log(`Caught Exception: ${event.description}`);
  }
};
```