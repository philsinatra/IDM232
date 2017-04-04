build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 2

---

![150%](http://digm.drexel.edu/crs/IDM232/presentations/images/php-html-code.jpg)


^ Our exploration in the PHP programming language is going to begin with an exploration of the different structures or types that we can use while writing PHP. And the first of those that we're going to look at are variables. You're all familiar with variables from other programming. A variable is a symbolic representation of a value. You can think of it as a symbol that refers to something and that's going to make a lot more sense once we actually start using them. But as it's name suggests, it can change over time or vary. It has a variable value because it can point to different values. Now, in PHP, there's some rules about the kinds of names that we can give to variables.

---

### Variable Names

- Start with $
- Followed by letter or underscore
- Can contain letters, numbers, underscores or dashes
- No spaces
- Case-sensitive

^ (_click_) They need to start with a dollar sign, that needs to be (_click_) followed by either letter or an underscore, they can (_click_) contain letters, numbers, underscores or dashes. They (_click_) cannot contain any spaces and they (_click_) are case sensitive. It makes a difference whether we use an upper case letter or a lowercase letter.

---

### Variable Names - Casing

```php
<?php
  $item
  $Item
?>
```

^ So let me give you some examples of some variable names and then we can talk about them. So I could have item, which is just `$item`.  I could also have Item with an uppercase I. These are two different variables, with potentially two different values. You want to be consistent with capitalization. Best practice - avoid starting variable names with a capital letter.

---

### Variable Names - camelCase

```php
<?php  
  $myVariable
?>
```

^ We can also have myVariable with a capital V. That is often referred to as camelCase, because those upper case letters in the middle are like the humps in a camel. So, some developers like that format.

---

### Variable Names

```php
<?php  
  $this_variable
  $this-variable
?>
```

^ Then there's the underscore between words, so this_variable. There's also a dash, this-variable.

---

### Variable Names

```php
<?php  
  $product3
  $_book
  $__bookPage
?>
```

^ You can put numbers in it. So product3, that's perfectly valid to have a third product named that way. You can put underscores in front of it. Remember, the first character has to either be a letter or an underscore, so you could have \_book. You could even have multiple underscores, $\__bookPage. Now, all of these are valid. Any of these will absolutely work. But I want to steer you towards some and away from others.

---

### Best Practices

Avoid:

- hyphenated variable names (`$this-variable`)
- multiple underscores (`$__bookPage`)
- leading underscore (`$_book`)

^ The first one is I think we should not use the (_click_) hyphenated version of this, and the main reason why is that, that hyphen looks like a minus sign, and it looks like we're subtracting this minus variable. And when we start working with variables and we start working with addition and subtraction, that could be confusing for us. So let's avoid confusion and stay away from that.

^ (_click_) The second one is this multiple underscores. Stay away from that as well, because it makes it hard to tell whether you've got one or two underscores. I once worked on a project where another programmer had written their variable names using underscores. And sometimes they had one underscore, sometimes they had two, sometimes they had three, and it had significance to them. There was a reason why they were using one, two, or three, but it was really kind of lost on me as to what the meaning was behind these, and it was hard to read to tell whether it was one or two or three.

^ (_click_) The last one is not quite as evil, but I want to steer you away from it and that is this single underscore at the beginning. The reason it's not evil is that PHP is going to use it itself. And we're going to see that. We're going to see that PHP has some special variables. They're named with this underscore at the beginning, and some developers use this underscore for special cases. They want to denote the fact that a variable has certain access privileges, that certain people can or can't access things by putting that underscore in front of it. Because it has this special meaning both to PHP and to other developers. Let's stay away from it for general use.

---

###[http://php.net/manual/en/reserved.php](http://php.net/manual/en/reserved.php)

^ PHP actually has some words that are reserved, words that you're not allowed to use for different things, and it's a good idea to take a review of this list, and then stay away from those words as much as possible. Sometimes, it's not a problem to use it for a variable name, but it might be a problem to use it in other contexts. It's basically just names with special meaning to PHP that we don't want to use.

---

## Variables

```php
<?php  
  $var1 = 10;

  echo $var1;
?>
```

^ Let's look at an example. The name of our first variable will be `var1` and then we're just going to say it's equal to the number 10. That's it. We've now made that symbolic pointing from the variable to the number 10. Variable 1 now points to 10, and if we talk about variable 1, we're talking about 10. So if we then, in the next line say `echo $var1`, it's going to echo back 10. It doesn't output _var1_, it outputs the value of the variable `$var1`.

---

## Variables

```php
<?php  
  $var1 = "Hello world";

  echo $var1;
?>
```

^ Variables don't only have to point to a number. In this example, the value of `$var1` is a string of text _Hello world_. Variables can point to anything really, they are just a symbolic representation of something larger.

---

## Data Type: Strings

^ Strings are a very common feature of most programming languages. And we've already been using Strings without knowing it. A string is a set of characters. Those characters can be letters, numbers, symbols. And their going to be defined inside of quotation marks, either single quotes or double quotes. In non-programming terms, you can think of a string as being text.

---

### Strings

```php
<?php  
  $var1 = "Hello world";

  echo $var1;
?>
```

^ Let's look at our previous example - "Hello world" is an example of a string. The text is defined inside double quotes.

---

### Strings

```php
<?php  
  $var1 = "<p>Hello world</p>";

  echo $var1;
?>
```

^ It is perfectly valid to put HTML inside of our string variables. When you output the value of the variable, the HTML tags will be included.

---

### Strings

```php
<?php  
  $var1 = "Hello world";
  $var2 = 'Hello world';
?>
```

^ You can use double or single quotes for your strings, best practice is to use double quotes and we'll see why in a bit.

---

### Strings

```php
<?php  
  $greeting = "Hello";
  $target   = "World";
  $phrase   = $greeting . " " . $target;

  echo $phrase; // Hello World
?>
```

^ Here's an example - we start with `$greeting` and assign it's value to be _Hello_. Then we setup the `$target` variable and set it's value to _World_. Next we create a `$phrase` variable, and set its value equal to our `$greeting`, and then using the dot to concatenate multiple values, we add another string, which is simply a space, another dot to concatenate the `$target` value. When we echo the `$phrase` variable, we get _Hello_, a space, and then _World_.

---

### Strings

```php
  $phrase   = $greeting . " " . $target;

  echo "$phrase Again<br>"; // Hello World Again
  echo '$phrase Again<br>'; // $phrase Again
```

^ In this example, inside double quotes I tell it to echo the `$phrase` variable, followed by a space, the word _Again_ and then a break tag. Because of the dollar sign, PHP is going to recognize this as a variable and echo the value of the variable. This however does not work if you use single quotes. This is one of many examples as to why it's better to get in the practice of using double quotes in PHP.

---

## String Functions

^ We've seen the basics of working with strings. Now I want us to take a look at some functions that we can use with strings. We haven't looked at a lot of functions yet. So far we've really just looked at the PHP info function and Echo. Those are really the two main functions that we've seen. So we're going to start diving into the world of functions. And before we do, I just want to remind you that the [php.net](http://php.net) website has some excellent documentation for functions. And it will tell you all of the different functions that are predefined in PHP, it'll tell you how to use them, has good user submitted tips for you, all of that's there. And you can browse through those if you're looking for something, you're not quite sure what it is. Or if you know the name of the function you can just type it into the search bar at the top and it will return the documentation for it directly.

---

## String Functions

```php
<?php
  $first = "The quick brown fox";
  $second = " jumped over the lazy dog.";
?>
```

^ Here I have two strings (explain). We've seen how to assign variables to strings, and we've seen how to concatenate these together using the dot notation. I'm going to show you another way to concatenate quickly, and actually assign and concatenate at the same time.

---

## String Functions

```php
<?php
  $first = "The quick brown fox";
  $second = " jumped over the lazy dog.";

  $third = $first;
?>
```

^ So here we have a third variable, and it's going to be equal to the first.

---

## String Functions

```php
<?php
  $first = "The quick brown fox";
  $second = " jumped over the lazy dog.";

  $third = $first;
  $third .= $second;

  echo $third;

?>
```

^ Then on a new line, it's going to be `$third` is equal to concatenated equal to second. So this says _third_ points to the same thing _first_ does. Then on the next line I'm going to tell _third_ that it should add on the _second_ string value to the end, concatenating it to what's already there using the dot equals notation. It's appending to the end, the values of _first_ and _second_ haven't changed. This is going to be very handy later when we have to build up a string over time, especially with MySQL.

---

## String Functions

```php
Lowercase: <?php echo strtolower($thirds); ?><br>
Uppercase: <?php echo strtoupper($thirds); ?><br>
Uppercase first: <?php echo ucfirst($thirds); ?><br>
Uppercase words: <?php echo ucwords($thirds); ?>
```

^ Let's take a look at some string functions. This HTML includes some PHP tags calling some functions, the first is `stringtolower` which is the name of the function. Functions often take something as an argument, which serves as input into the function, and then they return output to you. So the input in this case is going to be inside the parenthesis, and it's going to be our variable `$thirds`.

---

## String Functions `strtolower($thirds)`

```php
Lowercase: <?php echo strtolower($thirds); ?><br>
```

Lowercase: the quick brown fox jumped over the lazy dog.

---

## String Functions `strtoupper($thirds)`

```php
Uppercase: <?php echo strtoupper($thirds); ?><br>
```

Uppercase: THE QUICK BROWN FOX JUMPED OVER THE LAZY DOG.

---

## String Functions `ucfirst($thirds)`

```php
Uppercase first: <?php echo ucfirst($thirds); ?><br>
```

Uppercase first: The quick brown fox jumped over the lazy dog.

---

## String Functions `ucwords($thirds)`

```php
Uppercase words: <?php echo ucwords($thirds); ?><br>
```

Uppercase words: The Quick Brown Fox Jumped Over The Lazy Dog.

---

## String Functions `strlen`

```php
Length: <?php echo strlen($third); ?>
```

Length: 45

^ Let's look at a couple more - `strlen` is going to tell us the length of the string.

^ When we run this we find out the length of this variable is 45 characters; that's the number of characters and spaces in the string.

---

## String Functions `strstr`

```php
Find: <?php echo strstr($third, "brown"); ?><br>
```

Find: brown fox jumped over the lazy dog.

^  Find uses a function named `strstr`; you're finding a string within a string. So inside `$third` we're going to look for _brown_, and see what it returns.

^ The Find did find the word brown. Notice what it returned to us, it returned everything after the find in the string. So it found _brown_ and the result that was returned was not just the word, but everything that follows as well.

---

## String Functions `str_replace`

```php
Replace by string:
<?php echo str_replace("quick", "super-fast", $third); ?>
```

Replace by string:
The super-fast brown fox jumped...

^ Replace by string is going to replace _quick_ with _super-fast_ inside `$third`. Some of these functions take two arguments, others take three. You can use the php.net site to review all the required arguments for any of the predefined functions available in PHP.

^ In this example, we're searching for a needle in a haystack. The haystack is `$third` and the needle is _quick_.

^ You can see that it put the _super-fast brown fox_ in place of the word _quick_.

---

## String Functions `substr`

```php
<?php
  echo substr($third, 5, 10);
?>
```

uick brown

^ Substring is going to make a sub string of `$third` starting at the 5th position to the tenth position of the string.

---

## String Functions `strpos`

```php
<?php
  echo "Find position: " . strpos($third, "brown");
?>
```

Find position: 10

^ String position is going to tell us the position of _brown_ within the string.

---

## String Functions

^ So these are your first set of functions. This is the way that PHP is going to work. We're going to be able to manipulate all sorts of things by using different functions, and these are the string functions. These are not the only ones. There are a lot more and I don't expect that you will have memorized all of these.

^ You're going to be looking them up for a while, so they become second nature to you. You're going to have to make yourself some notes. Keep yourself a little chart, maybe jot down the ones, you know, that you use most often. So that there is a handy reference or just keep the PHP.net website open, so that you can quickly go and search and look up, how you use each of these. I've been using PHP a long time and I'm still constantly looking up, the usage of these and the order of the arguments and that kind of thing. Now we've explored strings and string functions. We're ready to move on and look at integers.

---

## Numbers: Integers

^ Next we're going to talk about numbers. We'll being by talking about integers (whole numbers). Pretty self explanatory, but we need to know how to work with integers in PHP.

---

## Numbers

```php
<?php
  $var1 = 3;
  $var2 = 4;
?>
```

---

## Numbers

```php
<?php
  $var1 = 3;
  $var2 = 4;
?>

Basic math: <?php echo ((1 + 2 + $var1) * $var2) / 2 - 5 ?>
```

^ This is basic math, remember order of operations.

---

### Please Excuse My Dear Aunt Sally

- parentheses
- exponents
- multiplication
- division
- addition
- subtraction

^ Order of operations

---

## Numbers

```php
  $var1 = 3;
  $var2 = 4;

  Basic math: <?php echo ((1 + 2 + $var1) * $var2) / 2 - 5 ?>
  // 1 + 2 + 3 = 6 * 4 = 24 / 2 = 12 - 5 = 7
  ```

---

## Number Functions

- `abs()`
- `pow()`
- `sqrt()`
- `rand()`

^ Just like strings, PHP has various functions available for working with numbers. I'm not going to go into detail with each of these, you can look up the information about these and all the available functions on php.net. Some examples include (_click_) converting a number to an absolute number, (_click_) raising a number to a specific power, (_click_) determining the square root of a number and (_click_) generating a random number.

---

## Incrementing

```php
$var2 = 4;
$var2 = $var2 + 1;
```

^ Incrementing a number is very common, especially when dealing with loops, which we'll get to next week. If  I want to increase the value of `$var2` by one, I can use basic math and do that. There is nothing wrong with this code.

---

## Incrementing

```php
$var2 = 4;
// $var2 = $var2 + 1;
$var2++;
echo $var2; // 5
```

^ It is common to use this incrementing technique, which actually comes from the world of C code, with a double plus after the variable name. This will increment the value of `$var2` by one.

---

## Decrementing

```php
$var2 = 4;
$var2--;
echo $var2; // 3
```

^ Same thing with decrementing, just use double minus instead of plus.

---

## Numbers: Floating Points

^ Now we've taken a look at integers, I'm going to to take a look at another type of number which are floating point numbers also simply called Floats, for short. You may know them more commonly as decimal numbers. That is numbers that have a decimals in them followed by a number of significant digits 2.75 is an example of a floating point number. Now, it may seem arbitrary to you if you haven't done a lot of programming before that we divide numbers into these two types. Integers and floating point, and the reason why is because computers store integers and floating points in different ways in memory.

---

## Numbers: Floating Points

```php
<?php echo $float = 3.14; ?>
```

^ This is an example of a floating number.

---

## Numbers: Floating Points

```php
<?php echo $float = 3.14; ?>
<?php echo $float + 7; ?>
<?php echo 4/3; ?>
```

^ Floating numbers can interact with integers, and integers can interact with each other to produce floating numbers.

---

## Numbers: Floating Functions

```php
<?php
  echo round($float, 1); // 3.1
  echo ceil($float);
  echo floor($float);
?>
```

^ Here are some examples of PHP functions that work with floats. Again, you can look up the details and all of the available functions on php.net. Rounding will let you define how many decimal points the value should be rounded to. Ceiling and floor are also rounding type functions, ceiling will always round up, floor will always round down.

---

## Is Integer/Float?

```php
$integer = 3;
$float = 3.14;

echo "Is {$integer} integer? " . is_int($integer);
echo "Is {$float} float? " . is_float($float);
```

^ We can check variables to see if they are integers or floats using some built in functions.

---

## Is Numeric

```php
echo "Is {$integer} numeric? " . is_numeric($integer);
echo "Is {$float} numeric? " . is_numeric($float);
```

^ We can also verify if a variable value is numeric in any way. These are all helpful functions to know to verify your variable values as your scripts get more complicated.

---

## Arrays

^ Arrays are a common feature in many programming languages. Arrays are going to be extremely useful for helping us to keep information organized. So, what is an array? An array is an ordered, integer-indexed collection of objects. That's a fancy way of saying that we can take objects, like strings and integers and put them into a group and then keep their position in that group in the same order, so that we can refer to those objects by their positions. We can tell the array, give me back the first object, give me the fifth object, and so on, because the objects are going to be indexed according to what position they hold in the array.

---

## Arrays

```php
<?php
  $numbers = array();
  // PHP 5.4
  $numbers = [];
?>
```

^ I'm going to assign the variable `$numbers` to be an array. You define an array using either of these methods. The second method is available as long as you are running version 5.4 or higher. In this example we've defined an empty array, there are no objects inside the array (yet).

---

## Arrays

```php
<?php
  $numbers = array(4,8,15,16);
?>
```

^ We can put a series of objects in our array and separate them by commas. So I'm adding some numbers. The numbers are going to stay in the order I've put them in, and I can refer to them by position when I want to get them back out.

---

## Arrays

```php
<?php
  $numbers = array(4,8,15,16);
  echo $numbers[1];
?>
```

^ To retrieve something from the array, we're going to use the `echo` command, and we're going to reference the variable `$numbers` because that's what points to our array, and then we're going to use square brackets. Inside those square brackets, we're going to provide the index that we want it to return. In this case it will return whatever is in position 1. What should I expect to see?

---

## Arrays

```php
<?php
  $numbers = array(4,8,15,16);
  echo $numbers[1]; // 8
?>
```

^ The object returned is 8, which we would normally expect to be in the second pocket of our array. This brings up a very important point about arrays.

---

## Arrays

```php
<?php
  $numbers = array(`0`,`1`,`2`);
?>
```

^ Arrays are numbered starting from zero. The first pocket is indexed as zero, second is indexed as 1 and so on. This is how all arrays work, not only in PHP, but in every programming language. It will take some getting used to.

---

## Arrays

```php
<?php
  $numbers = array(4,8,15,16);
  echo $numbers[0]; // 4
?>
```

^ So if we want to extract the item in "pocket 1" we use an index value of zero.

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
?>
```

^ And as I said, an array can contain lots of different types of objects. So, for example, we can have a mixed type object. We'll call it mixed, and inside there, we'll have an array. And in that array, let's put the number 6, the word fox, followed by the word dog, followed by another array. Then in that array we'll put x and y and z. So you see how that works? It doesn't matter what kind of objects we put in there. It can be integers, it can be strings, it can even be other arrays. Any valid type in PHP can go inside an array.

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[2];
?>
```

^ Let's `echo` back one of those values. Let's ask for what's in pocket number two. What should be returned?

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[2]; // dog
?>
```

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[3];
?>
```

^ What are we going to get back if we ask for pocket three?

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[3]; // Array
?>
```

^ PHP will return to us _Array_. It's telling us that the object we are requesting is itself an array.

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[3][1];
?>
```

^ If we want to get a value from this internal array, we'll access pocket three again, and then use a second set of brackets to specify which pocket within the second array we want to access.

---

## Arrays

```php
<?php
  $mixed = array(6, "fox", "dog", array("x", "y", "z"));
  echo $mixed[3][1]; // y
?>
```

^ So in this case we're going into array 1 (`$mixed`)[pocket 3] -> array 2[pocket 1] which is "**y**".

---

## Arrays - Assigning Values

^ Now we're able to pull things out of the array, but we also want to assign values into the array. We don't want to have to redefine the entire array each time.

---

## Arrays - Assigning Values

```php
$mixed[2] = "cat";
$mixed[4] = "mouse";
```

^ We can use an assignment operator to add "cat" to pocket number two of our array. We add "mouse" to pocket four the same way. But wait...

---

## Arrays - Assigning Values

```php
$mixed = array(6, "fox", "dog", array("x", "y", "z"));
$mixed[4] = "mouse";
```

^ Our array doesn't have a fourth pocket. That's okay - it's going to put the item in the fourth position for us. What if we don't know the next available open pocket?

---

## Arrays - Assigning Values

```php
$mixed[] = "horse";
```

^ If you don't know how long an array is and you want to add something to the end, you can leave the assignment value blank. So in this example, "horse" will be added to the fifth position, which is the next available position in the array.

---

## Arrays = Power

```php
$email_001 = "ps42@drexel.edu";
$email_002 = "jht23@drexel.edu";
$email_003 = "jwt26@drexel.edu";
//
$email_addresses = [
  "ps42@drexel.edu","jht23@drexel.edu","jwt26@drexel.edu"
];
```

^ So the power of arrays, is that a set of information can be referenced by a single variable. Imagine if we have one thousand email addresses. We wouldn't want to create one thousand variables for those, instead we can assign all of them to an array, and then use one easy to reference variable to pull up each email address by its index. The other thing that's powerful about arrays is that they keep their information in the same order unless we change it. Whatever we put in the first pocket stays in the first pocket. So, arrays are good for keeping ordered lists.

^ We can sort those 1000 email addresses and then they'll be kept in that order for us by the array. You can imagine how arrays are going to start helping us when we start pulling records and data out of our database. We can retrieve 50 customer records sorted alphabetically by last name and store them in the array. And they'll stay sorted in that array by last name.

---

## Associative Arrays

^ PHP has another type of array, called an associative array. And it's important for us to learn how to use both types, and to understand the difference between them. An associative array is an object-indexed collection of objects and it's very similar to what we saw for the definition of a regular array. But notice that it doesn't say that it's ordered anymore. And instead of being integer-indexed it is object-indexed, that is, they're going to be indexed by a label of some sort.

---

## Array Comparison

- Basic arrays:
  - When order is most important
- Associative
  - When having a reference label is most important

^ If we have 100 customers and we store all of their information in an array, is it more important to order the customers in a specific way, or would we want to be able to ask for the customer's last name, or email address, without having to remember which pocket within the array holds that information?

---

## Associative Arrays

```php
<?php
  $assoc = [];
?>
```

^ So here's an empty array. Until we put something inside the array it doesn't really matter if it's a regular or associative array.

---

## Associative Arrays

```php
<?php
  $assoc = ["first_name" => "Dolores"];
?>
```

^ Here I put _first name_ as a label, that's a string, an object, it's object-indexed. And I point that using an equal sign and the greater than sign, so it looks like an arrow pointing to the next data, which is the value. So the key is _first name_ and the value is _Dolores_. And we can have more than one, key/value pairing.

---

## Associative Arrays

```php
<?php
  $assoc = [
    "first_name" => "Dolores",
    "last_name" => "Abernathy"
  ];
?>
```

^ That is what an associated array looks like. Instead of being indexed by position, it's going to be indexed by the key.

---

## Associative Arrays

```php
<?php
  $assoc = [
    "first_name" => "Dolores",
    "last_name" => "Abernathy"
  ];
  echo $assoc["first_name"]; // Dolores
?>
```

^ So if I wanted to get back the first name, I can `echo` the variable _assoc_, then in square brackets, the value will be the key instead of the position, in this case _first\_name_.

---

## Array Functions

^ There are a lot of functions for working with arrays, and we are going to use them in a lot of different contexts. We'll look at a couple of the common functions, remember you can review all of the available functions and how to use them on php.net.

---

## Array Functions

```php
<?php
  $numbers = array(8,23,15,42,16,4);
?>
```

^ We'll start with an array filled with numbers. One of the things we're going to look at is how we can sort those numbers. Before we do that, let's look at a couple other functions.

---

## Array Functions

```php
<?php $numbers = array(8,23,15,42,16,4); ?>

Count: <?php echo count($numbers); ?>    // 6
Max value: <?php echo max($numbers); ?>  // 42
Min value: <?php echo min($numbers); ?>  // 4
```

^ The `count` function will tell us how many items are in the array. `max` will tell us the maximum value, `min` the minimum value.

---

## Array Functions

```php
<?php $numbers = array(8,23,15,42,16,4); ?>

Sort: <?php sort($numbers); print_r($numbers); ?>
Reverse sort: <?php rsort($numbers); print_r($numbers); ?>
```

^ We can also sort those values, using `sort` and `rsort`. I'm also using a new function here `print_r` which is a debugging tool that will allow us to see the values of an array in the browser (example).

---

## Array Functions

```php
<?php $numbers = array(8,23,15,42,16,4); ?>

Sort: <?php sort($numbers); print_r($numbers); ?>
Implode: <?php echo $num_string = implode(" * ", $numbers); ?>
// 42 * 23 * 16 * 15 * 8 * 4
```

^ Another handy function is how we can turn an array into a string. We can combine values together to get a string using `implode`. The first argument is what the separator is between each of those elements. So here, I've said that it's a space, asterisk and a space. The `$num_string` variable isn't an array anymore, it's a string.

---

## Array Functions

```php
<?php $numbers = array(8,23,15,42,16,4); ?>

Sort: <?php sort($numbers); print_r($numbers); ?>
Implode: <?php echo $num_string = implode(" * ", $numbers); ?>
Explode: <?php print_r(explode(" * ", $num_string)); ?>
```

^ The opposite of `implode` is `explode`, which is going to take a string like `$num_string` and every time it finds this first parameter string (" * "), it's going to use it as a divider between values. So every time is sees a space and then an asterisk space, it's going to split the string into a new object in the array.

---

## Array Functions

```php
<?php $numbers = array(8,23,15,42,16,4); ?>
```

15 in array? 

```php
<?php echo in_array(15, $numbers); // returns T/F
```

19 in array? 

```php
<?php echo in_array(19, $numbers); // returns T/F
```

15 in array? 1
19 in array?

^ `in_array` allows us to find out if a value is in an array. It returns a true or false, if true, the function returns a **1**, if false then nothing is returned.

---

## [php.net/manual/en/ref.array.php](http://php.net/manual/en/ref.array.php)

---

## Booleans

^  A Boolean is a programming type that can either be true or false. That's it, one of those two values. And true is not the string true or even the number one. It's just simply the value true. Booleans are very useful in programming because we can use them when performing tests. For example, we used the `in_array` function to test whether an integer was inside of an array. The result was that the test was a Boolean, true if the integer was present, false if it was not. Let's start by creating ourselves a new workspace for this.

---

## Booleans

```php
$result1 = true;
$result2 = false;

echo $result1; // 1
echo $result2; //
```

^ A boolean is simply the value true or false; notice there are no quotes around that. It's not a string. We are assigning a boolean to a variable, just like we do anything else. and we can echo those values back just like any other variables. A value of _true_ will return a 1, a value of false will output nothing, **not a zero**.

---

## Booleans

```php
$result1 = true;
$result2 = false;

result2 is boolean? <?php echo is_bool($result2); ?>
// result2 is boolean? 1
```

^ The `is_bool` function will help us find out if something is a boolean. In this case, it's going to return true, represented as a 1 since `$result2` is a boolean.

---

## Booleans

```php
if (something is TRUE)
  do this
otherwise
  do that
```

^ Being able to check if something is true or false is going to be incredibly helpful when we get into writing conditional statements, i.e. if something is true do this, otherwise do that.

---

## Constants

^ Everything we've covered today has focused on variables. It's fitting that we end with constants, which is the opposite of a variable. A variable can change or vary, a constant can't change. It remains constantly set at the same value. Constants are going to be recognizable on PHP because they're always written in all capital letters and there's no dollar sign in front of them. They're also going to differ from variables in another way. The only way to set a value for constant is to use a function. The define function. You can't just use the equal sign to assign a value, like you can with variable.

---

## Constants

```php
<?php  
  $max_width = 980;
?>
```

^ Let's say we had a max width equals 980. That would be a variable set at the integer 980.

---

## Constants

```php
<?php  
  $max_width = 980;
  MAX_WIDTH = 980; // !! Does not work
?>
```

^ But if it was a constant, max width would not have a dollar sign in front of it and would be in all capital letters. This doesn't work with constants.

---

## Constants

```php
<?php  
  $max_width = 980;
  define("MAX_WIDTH", 980);
  echo MAX_WIDTH;
?>
```

^ We have to use a special function to define a constant, the `define` function. Then we're going to provide the name of the constant, in quotes, and then the second argument will be the value we want to set it to. We have to use quotes when defining the constant so we can tell PHP the string we want to use for the name of the constant.

---

## Constants

```php
<?php  
  $max_width = 980;
  define("MAX_WIDTH", 980);

  MAX_WIDTH = MAX_WIDTH + 1; // Doesn't work
  MAX_WIDTH++; // Doesn't work
?>
```

^ With constants, you can not change the value. Once PHP has executed your scripts, the values are locked down.

---

## For Next Week...
