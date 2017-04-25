build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 4
### Building Web Pages with PHP

^ Now that we have our PHP fundamentals, we're ready to start building webpages with PHP.

---

![inline](http://digm.drexel.edu/crs/IDM232/presentations/images/operation_trail-step_09.png)

^ Think back for a moment to the diagram that we saw, with the request response cycle, that shows requests starting at the browser, going to the web server, the web server processes our PHP and returns an HTML page back to the browser. That cycle, that request response cycle begins with a browser request. Nothing happens on the web server unless the user sends in some information to us. And there are only three ways that we can get data from users on the web.

---

## Links and URLs

- URLs / Links
- Forms
- Cookies

^ (_click_) There's URL's and links. (_click_) There's forms, web forms that you fill out with information and click submit, and then there's (_click_) cookies. Those are browser cookies that are stored on the browser. And each one of these corresponds to an HTTP method.

---

## Links and URLs

| Type | Method |
|:----:|:------:|
| URLs / Links | GET |
| Forms | POST |
| Cookies | COOKIE |

^ The first is Get, the second is Post and the last is Cookie. So, URLs and Links are Get requests, a form is a Post request. And Cookie, well, it's not really a cookie request, but it's the way that we access the cookie information that piggybacks on each request. So, these are the three main things that we're going to be looking at. Now, every web language has a different way to interact with these three types of user data. We'll start by looking at URLs and links. (_examples/week4/links/page1.php_)

---

## Using GET values

```html
<a href="somepage.php?page=2">
```

^ We being by learning how to send a value from one page to the next by using the URL query parameters. The query parameters are the part of the URL that comes after the question mark. This is typically were you send additional parameters that the page needs. The format is always the name of the parameter, an equals sign and then the value of the parameter. Often these parameters modify the behavior of the code used to generate the returned HTML. For example, somepage.php?page=2 would process the same PHP code but the content return would probably be modified. It would do something like return a second page of search results.

---

## Using GET values

```html
<a href="somepage.php?category=7&page=3">
```

^ And you can send more than one query parameter in the URL by using an ampersand between each one of these parameters.

---

## Using GET values

```html
http://google.com/search?q=php
```

^ You can search all over the web and find examples where these query parameters are being used. In PHP, whenever a page request is made, PHP is going to automatically take all of those query parameters that were sent with the URL and put them into an associative array where we can access them.

---

## Using GET values

- Super global variable
  - "Super global" for short
  - Always available in all scopes
  - Assigned by PHP before processing page code

^ That array is what is called a (_click_) Super global variable. We've talked about global variables before and we saw how we needed to call global on them to bring them into the local scope. Well super global's are always available in all scopes and PHP set's them for us before the page even starts processing. There are about nine super globals altogether. And we'll be looking at several of them later in this class. But right now we're only concerned with the super global that relates to the variables passed to the page via those URL parameters. And that one is called **GET**.

---

## Using GET values

```php
$_GET
```

^ And that makes sense, because GET is the HTTP method that relates to URLs and links. And the way that we access it is with dollar sign, underscore and then all capitals GET. That's the name of the super global where the query parameters are put by PHP. Notice the underscore that's in the beginning. That's how all super globals are going to be named. This is why when we discussed naming your variables I recommended not starting your variable names with underscores; it will help these super globals really stand out. Let's see how we access these now. (return to _examples/week4/links/page1.php_ and _page2.php_)

---

## Encoding GET values

^ So we've already made our site more dynamic by allowing values to be passed between pages in these URL query parameters. This raises an important issue though. Can a user send any value in that URL? Remember IDM221 when I made such a big deal about naming your files properly, not using special characters etc. This is where that becomes really important. There are some characters we have to watch out for. We have to talk about the characters we're allowed to use in our URLs.

---

### Safe Characters

- letters
- numbers
- underscores
- dashes

---

## Encoding GET values

- !
- #
- $
- %
- &
- '

^ There are reserved characters that are going to cause problems because they have special meanings in URLs. Here's a list of reserved characters that we have problems with if we include them in a URL.

---

## Encoding GET values

- (
- )
- *
- +
- ,
- /

---

## Encoding GET values

- :
- ;
- =
- ?
- @
- [
- ]

---

## ! # $ % & ' ( ) * + , / : ; = ? @ [ ]

^ You can see there are quite a few. When we're constructing URLs, we must encode these characters so they don't interfere with the function of the URL.

---

![full](http://digm.drexel.edu/crs/IDM232/presentations/images/character_encoding_table.png)

^ Encoding a reserved character means converting that character to a percent sign followed by a pair of hexadecimal digits. Hexadecimal just means that in addition to zero to nine, we can use the letters A through F as if they were digits, too. So, what we'll need to do is be able to convert each of these characters into its hexadecimal form, put it in a URL. And then we'll decode it by converting it back once the page is received.

---

## Encoding GET values

```php
urlencode($string);
```

^ PHP lets us perform the URL encoding by using a function called `urlencode`, and its argument is the string that you want to encode.

---

### `urlencode`

- Letters, numbers, underscores and dashes are unchanged
- Reserved characters become % + 2-digit hexadecimal
- Spaces become "+"

^ So, `urlencode` is going to take (_click_) letters, number, underscores and dashes and let them pass through completely unchanged. (_click_) But those reserve characters, that we just saw, are going to become their hexadecimal equivalent. That percent sign, follow by two digit hexadecimal digit number. (_click_) And spaces are going to become plus signs. Remember that, because that's going to be important in a minute. We'll talk about that. Let's try using it. (_examples/week4/urlencode/encode1.php_ | _encode2.php_)

---

### `urlencode`

^ We successfully used `urlencode` to encode these characters and spaces, and then PHP decoded that information for us when we loaded our page. We didn't have to decode the information ourselves, PHP automatically does it for us. There is a function `urlencode` that works exactly like you would expect that you can use if you ever need to, but most times you won't. Note that all of this is for `GET` requests ONLY. Later when we work with `POST` and `COOKIE` we won't need to do any of this encoding. This is because those values are in the URL string.

---

## Encoding GET values

^ So, now that we know about URL encoding, there's another type of encoding that we need to talk about called raw URL encoding and it's important to understand and to know the differences.

---

### `urlencode`

- Letters, numbers, underscores and dashes are unchanged
- Reserved characters become % + 2-digit hexadecimal
- Spaces become "+"

^ So, if we take a look at what we had for `urlencode`, (_click_) we saw that letters, numbers, underscores, and dashes are unchanged. (_click_) It converts the reserved characters and (_click_) spaces become plus.

---

### `rawurlencode`

- Letters, numbers, underscores and dashes are unchanged
- Reserved characters become % + 2-digit hexadecimal
- Spaces become "%20"

^ With `rawurlencode`, (_click_) letters, numbers, underscore and dash are unchanged. (_click_) The reserved characters get converted but, here's the big difference. (_click_) Spaces become percent 20. They get encoded into a two-digit hexadecimal also instead of using the plus. It may seem like a minor point, but it does make some big differences. It's easy for us to try it. (_examples/week4/urlencode/encode1.php_)

---

## `urlencode` vs. `rawurlencode`

- `rawurlencode` the path
  - Path is the part before the "?"
  - Spaces must be encoded as %20
- `urlencode` the query string
  - Query string is the part after the "?"
  - Spaces are better encoded as "+"

^ So, now that we understand the difference. One send pluses, one sends percent 20. You're probably wondering, when should you use each one? Well, here's my guideline for you.

^ (_click_) You're going to want to use `rawurlencode` on the path, that's the portion that comes before the question mark. So, everything comes before that, if there's anything dynamic in there that you're generating, like the page name. That is all going to be done with raw URL encoding, because the spaces must be encoded as %20 for the final system to be able to find that file. For Apache to be able to locate the PHP page you're looking for, it needs it as %20.

^ (_click_) But, you want to use `urlencode` on the query string. That's everything that comes after question mark. That's because spaces are better encoded as plus. (_examples/week4/urlencode/encode3.php_)

---

## Encoding HTML

^ So, we're using PHP to encode values for use in the url string. And that's because there's certain characters that have special meaning when they're used in the url. There's another place where we have to watch out for reserved characters, to make sure we don't end up with unintended consequences. And that's in the HTML.

---

## Encoding HTML

```html
<div>
  <h1>Reserved Characters</h1>
  <p>We have to watch out for
    characters with special
    meaning to HTML.</p>
</div>
```

^ Here's a sample block of HTML. Now, there are reserved characters in HTML that have special meaning. Most notably, the less than and greater than signs that surround the HTML tags. These characters indicate to HTML that everything inside here is an instruction for the HTML. This is something that the HTML should follow, and use for formatting. But this information is not output to the end user.

^ We want to take care that we don't output strings with characters that have special meaning to HTML, or we'll break the HTML or break our text. Imagine, for example, that in our paragraph of text there, we had a literal less than sign that we wanted to output to the screen. As HTML is reading it, it's going to come across that less than sign and think that that's the beginning of a tag. And it will interpret everything after that as being part of a tag until it gets to a closing greater than sign. So you can see how it would break it.

---

# [fit] < > & "

^ There are 4 characters that are reserved characters in HTML. They're the less than sign, the greater than sign, the ampersand, and the double quote. Mostly it's going to be the less than and greater than sign that we're most concerned with. But we're going to go ahead and take care of all four of these. So that they don't cause problems for us. Now the way that we'll do that is we're going to encode them. It's the same strategy that we used with the URL string. But it's completely different. Different set of characters, different encoding. But the idea is the same. We're rendering them harmless. When we encode them for HTML we're going to do the encoding differently.

---

### Reserved Characters in HTML

    <   &lt;
    >   &gt;
    &   &amp;
    "   &quot;

^ Remember these?

---

## Encoding HTML

- `htmlspecialchars()`
- `htmlentities()`

^ We can encode HTML using two functions of PHP. (_click_) The first one we'll look at is HTML special chars short for characters. (_click_) And the other one is HTML entities.

---

## Encoding HTML

```html
<a href="#">
  <Click> & Learn More
</a>

<!--
& Learn More
-->
```

^ HTML is not going to render the "Click" because it thinks we're trying to code a tag.

---

## Encoding HTML - `htmlspecialchars`

```php
$linktext = "<Click> & Learn More";

<a href="#">
  <?php echo htmlspecialchars($linktext); ?>
</a>

// <Click> & Learn More
```

^ So let's move our display text into a PHP variable. Then when we build our link, we're going to echo our variable, but we're using the `htmlspecialchars` function to encode our HTML. The output text will display as expected now.

---

## Encode HTML - `htmlentities`

^ Lets talk about HTML entities. It works just like HTML special chars does, but the difference is that all characters that have an equivalent HTML entity are translated into those entities. HTML special chars just does those four. But there's a lot of HTML character entities, bullets in dashes, trademark symbols, copyright symbols, foreign currency symbols, accident characters. All of those have HTML entities.

---

## Encode HTML - `htmlentities`

```php
$text = "™©®è";
echo htmlentities($text);
```

^ `htmlentities` does more, it does all of the characters, not just the four that `htmlspecialchars` does.

---

## So What?

^ Let's look at how all this fits together.

---

## Encoding

```php
$url_page = "php/created/page/url.php";
$param1   = "This is a string with < >";
$param2   = "&#?*$[]+ are bad characters";
$linktext = "<Click> & learn more";
```

^ First we setup all of the details for our URL, the parameters we're going to pass and the text we're going to display.

---

## Encoding

```php
$url = "http://localhost/";
$url .= rawurlencode($url_page);
$url .= "?" . "param1=" . urlencode($param1);
$url .= "&" . "param2=" . urlencode($param2);
```

^ We use `rawurlencode` on the page URL. and then each of the parameter values are run through `urlencode`. At this point our `$url` variable is safe to use as a URL. But it's not necessarily safe to use for the HTML.

---

## Encoding

```php
<a href="<?php echo htmlspecialchars($url); ?>">
  <?php echo htmlspecialchars($linktext); ?>
</a>
```

^ We also need to use `htmlspecialchars` to make sure we can display our HTML text that may include special characters. Now our URL and our HTML are safe to use as a link (_examples/week4/encode-full.php_).

---

## Including are Requiring Files

^ Let's change gears.

^ One of the most useful features in PHP is the ability to include code from other files into a PHP page. It may not be obvious why that's so great, but it's an important feature because it's going to help us to stay organized and to not repeat ourselves. For example, if you define a function for one page of your site and then you need that same function again on another page. It's much better to be able to access the same function from both places, exact same code. Instead of copying and pasting the code into the second page so you can use it again. A copy is going to mean that if we find a bug or make an improvement to the function. Then we have to remember to update the code in more than one place, and that leads to bugs and code that's hard to maintain.

---

## `include()`

^ What works better is to have a file that contains a function and then we'll include that file in both PHP pages that need it. Even better, we can have a file dedicated to functions of a certain type and put all our functions in one, easy to locate, easy to include, place. And we can do that, by using PHP's `include` function. (_week4/includes/NOTES.md_)

---

## What to `include()`

- Functions
- Layout sections
- Reusable HTML/PHP code

^ I would say that the good things to include would be (_click_) functions, because then we can define them once and only once, and they can be broken up by type. We could have our form functions, and our database functions, our general functions, right? We could have several different files of functions.

^ We could have (_click_) layout sections of the page, the header, the footer, maybe there's a side bar that has navigation elements on. That's common to all pages, that could also be included. (_click_) Reusable bits of html PHP code, this could be banner ads, page analytics. It could be little snippets of HTML/PHP, like maybe you're going to display a bunch of images. All those images are going to have titles underneath them that are all formatted a certain way. Well you could to use that throughout your site, over and over and over again.

---

## `require()`

^ In addition to include, there are three variations on it that are important for us to look at. The first is require. Require does exactly the same thing as include, but it raises a fatal page error if the file can't be found. It says, "look it really is required". This page will not be able to go forward if you can't get this file, so require it. Include doesn't do that. Include will try to load the file, but if it can't find it, well it'll just keep on going anyway. Now it might cause an error later on the page if we try and call a function or something that isn't defined. But include itself won't throw the error, require will.

---

## `include_once()`

^ Another variation is `include_once`. Include once keeps an array of paths to the files that it has already included. So as it includes a file, it just adds that file path to an array. And then if we asked to include it again, it will ignore it, because it sees that it has already included it before. This is great to use with functions, because we can't define functions more than once without getting an error.

---

## `require_once()`

^ And then of course there's the combination of those which is `require_once`. The same idea, but we're requiring it, instead of just including it.

---

## Redirect

^ Well, let's say that the user goes to a log in page, they submit their log in information on a web form, gets sent to a PHP page for processing. If they succeed in logging in, we want to send them to one page. If they fail, we want to send them to another page. That's where redirection comes in, being able to send them to another page. A page that's different from the one that they requested, or even the one that the form submitted to.

^ I'm sure you've seen this in e-commerce. You submit your order, and then after a brief pause, you suddenly are redirected to another page. Your browser suddenly ends up with a different URL at the end, that says something about your receipt, has your order number or something like that in it. When that happens, you've been redirected.

---

## Redirect

```php
<?php
  // Redirect to a new page
  header("Location: path_to_file");
  exit;
?>
```

^ To redirect to a new page, we change the `header` information, which is part of an array of information that is included when the server returns our page to the browser. There's a lot of technical information related the page headers that we are not going to get into, but the most important part to remember is that the header change must happen at the absolute beginning of your file, before even any white space has rendered. So this PHP code is at the top of our page before any other content, even white space, is added to our page.

---

## Redirect

```php
function redirect_to($new_location) {
  header("Location: {$new_location}");
  exit;
}

redirect_to("basic.html");
```

^  Instead of trying to remember the syntax here I find it really helpful to wrap all of this up into a function. So, let's create a function for ourselves. We'll call it `redirect_to`, and it's going to take as an argument new location. Now we can save this in our _functions.php_ file and have access to it throughout our entire project, and we don't have to remember the header syntax every time we want to use it.

---

## Redirect

```php
$logged_in = $_GET['logged_in'];

if ($logged_in == 1) {
  redirect_to("basic.html");
} else {
  redirect_to("http://google.com");
}
```

^ So let's just use this in some PHP. Let's say that we're going to a value for logged in, and that's going to be equal to get, and then our parameter will be `logged_in`. So the value of `$_GET['logged_in']` is what will become our `$logged_in` variable, and then let's do a simple if statement. If `$logged_in` is equal to 1, then we'll do one thing, otherwise, we'll redirect somewhere else.

^ If they are logged in, we're going to let them see basic.html. If they are not logged in, let's redirect them to somewhere else like google.com

^ (_week4/redirect/redirect.php_)

^ redirect.php?logged_in=1

^ redirect.php?logged_in=0

---

## Building Forms

^ Now that we know how to build web pages to use dynamic data we're ready to look at how to build pages that has forms for submitting form data.

---

## Data Input

| Type | Method |
|:----:|:------:|
| URLs / Links | GET |
| Forms | POST |
| Cookies | COOKIE |

^ This represents the second way that we can get data back from a user. They can either click a link, or type a URL, which is basically the same thing. Or they can submit a web form to us. You remember that URL and links are GET requests, and submitting a form is going to be a POST request. With GET request we saw that PHP automatically took all of the query parameters and put them into an associated array assigned to the super global GET. PHP is going to do the exact same thing for us with POST request by using the super global POST.

---

## `$_POST`

^ That's the dollar sign, underscore followed by capitals POST. All the values posted in the form data will be in that associative array, ready for us to access, just like we did with the links. So, if a form has a first name input field, then we'll be able to ask the POST super global for the key that matches the input field name. When we submit forms, there's generally going to be two pages, one page which has the web form on it, ready to be filled out. And then, a second page that does the processing of the form. Let's trying building an example. (_examples/week4/forms/form.php_)

---

## Single-page Form Processing

- All logic related to the form is in one file
- Redisplay the form on errors
  - Return error messages
  - Populate fields with previous values

^ We don't have to have two pages for the process either. In some cases you may want to have a single page that contains both the form and the form processing; essentially we'll have a form that submits to itself. One of the benefits is that all of the logic related to the form is in one file (_click_). It also makes it easy to redisplay the form if there are errors (_click_). So let's say we had a login form, if there are errors logging in we can easily return those error messages, and repopulate the form with the values the user previously entered. (_examples/week4/forms/form\_single-01.php_)

---

## Validating Form Values

^ When we accept data from users especially from web forms, we almost never want to just accept any old data that they send. In fact, it's to our benefit as developers to assume that users are sending us the worst kinds of data possible, that may be even trying to hack our site and do us harm. Checking the submitted data carefully is the road to having robust and secure code. So we need to spend some time thinking about requirements for our data and learning how to enforce those requirements. I promise you're going to spend significant time on this for every project that you do, so it's worth investing the time in learning how to do it and to avoid the pitfalls. Imposing data requirements is called validating our data, and you'll hear me refer to the process as validations or passing or failing our validations. If data passes validations, it means that data was acceptable and we can use it. If it fails validations, that means there was a problem and we need to reject it. And most often that means going back to the user to ask them to make revisions and submit it again.

---

## Common Validations

- Presence
- String length
- Type
- Inclusion in a set
- Uniqueness
- Format

^ The simplest and most common requirement for a form field is that the user submits some value that the form field can not be left blank. (_click_) We call this validating the presence making sure that something was present in the field. Now we can have other requirements too. For example, (_click_) we could check for the number of characters that they submitted to make sure that something is either longer than a certain number of characters, shorter than the certain number, maybe between a certain range where that is exactly a certain number of characters. (_click_) We can validate the type, make sure that they've sent us a string or an integer or a float, if that's what we're expecting. (_click_) We can validate that it's included in a set from a select set of choices. So, if we'd ask someone to choose whether they're male or female, the answer we get back, we would expect to be either male or female. And if it's not one of those two choices, we want to reject it.

^ (_click_) Once we start working with databases, we'll start wanting to check whether things are unique or not. This especially comes into play with something like a username. Everyone needs to pick a unique username, so we need to take the value they've given us for their preferred username and then check the database to see whether or not that is a valid, unique username. (_click_) And the last common one would be format. And that's just checking that an email has the at symbol in it, that currency has a dollar sign at the beginning. For dates and times they might need to end with a.m. or p.m. Any kind of format for the format that something should be submitted to us in, we can also check for.

---

## Common Validations

^ These are general types of validations, but really there is no limit to the number and types of validations you will need, and every project is different. Let's look at some examples.

---

### Presence

```php
if (!isset($value)) {
  echo "Validation failed!";
}
```

^ We can use `isset` to check if a variable has been set with a value. In this case `$value` has not been set and so validation fails.

---

### Presence

```php
$value = "";
if (!isset($value)) {
  echo "Validation failed!";
}
```

^ Does this pass or fail validation?

^ Technically `$value` is set to an empty string, so the variable is set and has a value. But we wouldn't want this to pass validation.

---

### Presence

```php
$value = "";
if (!isset($value) || empty($value)) {
  echo "Validation failed!";
}
```

^ We can use `empty` to check if the value of a variable is set but empty, and in this case our validation check will make sure the variable is set and is not empty.

---

### String Length

```php
$value = "";
$min   = 3;
if (strlen($value) < $min) {
  echo "Validation failed!";
}
```

^ With string length, we could have a minimum or maximum requirement. Let's say that we have another `$value` variable here, and for now, let's say that the value is empty again. Now we want to see the string length, so we'll use the `strlen` function with our `$value` variable.

^ And that's going to return an integer for how large it is. Is it less than the minimum? And if it is, then the validations failed.

---

### String Length

```php
$value = "abcdefg";
$max   = 6;
if (strlen($value) > $max) {
  echo "Validation failed!";
}
```

^ Same example here except we're checking if the variable is greater than our maximum allowance. Does our `$value` pass or fail validation?

---

### Type

```php
$value = "";
if (!is_string($value)) {
  echo "Validation failed!";
}
```

^ Our type example is very similar, in this case we're going to check if the type of the value is a string. If it's not a string, validation fails.

---

### Type

```php
$value = "1";
if (!is_string($value)) {
  echo "Validation failed!";
}
```

^ Does this pass or fail?

---

### Type

```php
$value = 1;
if (!is_string($value)) {
  echo "Validation failed!";
}
```

^ Does this pass or fail?

---

### Inclusion in a set

```php
$value = "1";
$set = array("1", "2", "3" "4");
if (!in_array($value, $set)) {
 echo "Validation failed!";
}
```

^ For inclusion within a set, we have a value and then we have an array and we're going to check if our `$value` appears anywhere within that array. So we can use the `in_array` function, we'll actually check if our value is NOT in the array, and if it's not our validation will fail.

 ---

### Format

```php
if (preg_match("/PHP/", "PHP is fun.")) {
  echo "A match was found.";
} else {
  echo "A match was not found."
}

// A match was found.
```

^ Now, for format, I want to teach you a new function. It's a little bit of a high-level function, but it's very useful. And it's `preg_match`. And what we're doing is we're applying a regular expression to see if something matches. So here's the format. We provide a regular expression and the subject we want to match, and it returns true whether it matches or not. So in this example I'm going to match whether "PHP" is inside "PHP is fun". And it will either say match was found or match was not found. You have to supply the expression you're searching for inside the slashes.

 ---

### Format

```php
if (preg_match("/PHPx/", "PHP is fun.")) {
 echo "A match was found.";
} else {
 echo "A match was not found."
}

// A match was not found.
```

^ Same example as before but now we're searching for "PHPx", which will not be found.

---

### Format

```php
$value = "nobody@nowhere.com";
if (!preg_match("/@/", $value)) {
  echo "Validation failed!";
}
```

^ So a real simple example, we'll take a value _nobody@nowhere.com_ and check to see if there's an @ symbol included.

---

## Displaying Validation Errors

^ Now that we understand the basics of validation, we need to talk about how we can display the errors back to the user better than what we've been doing so far. When someone submits the form we want to find out all of the errors and then return a list of what needs to be fixed. If the user makes a mistake in the firstname field, we don't want to say "go back and fix first name", and they do but then there's an error in lastname and we ping pong back and forth. That's a bad user experience.

---

## Displaying Validation Errors

```php
$errors = array();
```

^ The way we're going to handle this is with an array. We can put all of our errors in the array and let them accumulate and then at the end we can decide what to do with them.

---

## Displaying Validation Errors

```php
$errors = array();

$username = "";
if (!isset($username) || $username === "") {
  $errors[] = "Username can't be blank";
}
```

^ So here we'll say if the `$username` isn't set or is equal to blank, we'll add a new item to our array stating the username can't be blank.

---

## Displaying Validation Errors

```php
$errors = array();

$username = "";
if (!isset($username) || $username === "") {
  $errors['username'] = "Username can't be blank";
}
```

^ We can take it one step further by making our `$errors` array an associative array, and assign a key. So here we add the key `username` and then assign the value to that key "Username can't be blank". This will help when we have a lot of things being checked in the validation process since we'll know what each error message is tied to based on the key.

---

## Displaying Validation Errors

```php
if (!empty($errors)) {
  echo "<div class=\"errors\">";
  echo "Please fix the following errors:";
  echo "<ul>";
  foreach ($errors as $key => $error) {
    echo "<li>{$error}</li>";
  }
  echo "</ul></div>";
}
```

^ So once we have all of our errors stored in our array, what do we do with them? We can redirect the user, or we can display a list of the error messages, prompting the user to fix the issues.

---

    Please fix the following errors:

      - Value can't be blank

^ So here's an example of the output we would see.

---

## Displaying Validation Errors

```php
function form_errors($errors=array()) {
  $output = "";
  if (!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach ($errors as $key => $error) {
      $output .= "<li>{$error}</li>";
    }
    $output .= "</ul></div>";
  }
  return $output;
}
```

^ This could be turned into a function as well so that we can reuse it whenever we need to. We use a variable `$output` to build out our string including all of the error messages, and then we return that string.

---

## Displaying Validation Errors

```php
echo form_errors($errors);
```

^ We include the function in our functions file and then call it with an `echo` command, passing in our `$errors` array information, and the user will see a list of all the validation errors we've collected that they need to address before the form can successfully be submitted. You can go even further and setup specific checks for each key value and display a message next to the input field in the form. Customization on how/where feedback is provided is totally up to you. You can also write custom functions for the types of validation you need to do for your forms, which will be different in almost every case.

---

## For Next Week...
