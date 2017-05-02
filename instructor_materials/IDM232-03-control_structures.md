build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 3
### Control Structures: Logical Expressions

---

## If Statements

^ This week we're going to be looking at how we can start to control the flow of our code. To have our code make choices about what should happen based on certain conditions. And we're going to do that by using logical expressions. The most common of all types of logical expression, is the if statement,.

---

## If Statements

```php
if (expression)
  statement
```

^ This is the basic format of an if statement in PHP. We've got if followed by in parentheses an expression. And that expression is going to evaluate to either true or false. It's going to have a Boolean result. So if the expression is true, then the statement that follows it will be executed.

^ If it evaluates to false, then the statement will not be executed. And the code will skip past it and keep on evaluating down the rest of the PHP after it.

---

## If Statements

```php
if ($a > $b)
  echo "a is larger than b";
```

^ So for example, if we have if a is greater than b, then echo back a is larger than b. So if the expression a is greater than b evaluates to true, then we'll get something echoed. If it's not true, then the echo line will never execute. PHP will just ignore it and move right on past it. Now, this format that I'm showing you here works if the statement portion that's going to be executed is just a single line.

---

## If Statements

```php
if ($a > $b) {
  echo "a is larger than b";
}
```

^ If you have more than one line of code that you want to execute for the statement portion, then you'll want to use curly braces around that statement. This makes it clear that everything inside the braces should be executed if the expression evaluates to true.

^ It's required for multi line statements but it's also considered a best practice to add them around single line statements too. It's clearer and I also think it's easier to develop using one style and just to stick with it. So always use curly braces. Notice also that I've indented the statement portion. PHP doesn't care about the indentation. Remember whitespace doesn't matter to PHP. But indentation is going to help us a lot because it's going to improve code readability. It's also going to help me to make sure that for every open and curly brace, that I have a matching closing curly brace. And we start nesting these inside of each other, it can sometimes to be hard to tell, and easy to lose track of them.

---

## If Statements

```php
<?php
  $a = 4;
  $b = 3;

  if ($a > $b) {
    echo "a is larger than b";
  }
?>
```

^ Simple enough, we write our expression using curly brackets and indentation (some best practices), and when we test we see our echoed message.

---

## If Statements

```php
<?php
// Only welcome new users
$new_user = true;
if ($new_user) {
  echo "<h1>Welcome!</h1>";
  echo "<p>Glad you could join us.</p>";
}
```

^ How about something a bit less experimental. We determine whether someone is a new user or not, in this case I'm going to say that it's true. If it's true, we're going to display this welcome message.

---

## If Statements

```php
if ($a > $b) {
  echo "a is larger than b";
}

if ($b > $a) {
  echo "b is larger than a";
}
```

^ Let's look at our first example again. What if we want to account for instances where `$b` was the larger value. We could setup a series of statements to check all of our cases. But there's a better way to do it than this.

---

## Else / ElseIf Statement

^ Let's build on that by talking about `else` and `else if`. That is the ability to have an alternative that gets executed if something is not true.

---

## Else / ElseIf Statement

```php
if ($a > $b) {
  echo "a is larger than b";
}
else {
  echo "a is not larger than b";
}
```

^ Let's take a look. So, if we have if a is greater than b, we want to echo a is larger than b. We can use else immediately after it to say if that's not true, then the alternative version, should be to echo this section of code. This statement, echo a is not larger than b. So one of these two things will be true. We've basically divided the path into two and said, if this is true, do the first statement, else do the second statement.

^ Once that first test passes and its statement is executed, the rest of the options below that are skipped over. It jumps to the very end of this whole statement down to the very final curly quote, and that's where it picks up and keeps executing. So if a is greater than b, echo a is larger than b, and then, jump down to that final curly quote and proceed from there. It doesn't continue checking for additional options. Once it finds one, it's done. It's done with this whole, entire statement.

---

## Else / ElseIf Statement

```php
if ($a > $b) {
  echo "a is larger than b";
}
elseif ($a < $b) {
  echo "a is smaller than b";
}
```

^ Now, in addition to just else, we also have else if, and that lets us string multiple conditions together. So we could say, if a is greater than b, then echo a is larger than b, else if a is less than b, echo a is smaller than b. Notice before I said not larger, because there's a possibility that the two are equal. So now I can say else if do another test. So if the first one matches, then do the first statement. If the second one matches, they'll do the second statement. If a and b are equal, well then neither one of these are going to execute. Right? Neither one of its conditions were met, so we'll just keep going from there.

---

## Else / ElseIf Statement

```php
if ($a > $b) {
  echo "a is larger than b";
} elseif ($a < $b) {
  echo "a is smaller than b";
} else {
  echo "a is equal to b";
}
```

^ And of course, we can combine all three of these together, so that if a is greater than b we echo a is larger than be, if as is less than b we echo a is smaller than b, or the final catch-all, is the possibility that a is equal to b. It's not greater than, it's not less than, it must be equal to. So when we only have two, else is the alternative version, but if we have multiple ones, then else is sort of the default. It's the final thing, if none of these other conditions matched up above, this is the final result that you ought to do.

---

## Comparison and Logical Operators

^ I want us to talk about the expression part of that, the part that evaluates to true to false. And I want us to enhance our ability to work with that to generate some more complex expressions. And to do that, we're going to have to learn about comparison and logical operators. In the previous example, we said if A is greater than B, or if A is less than B. Less than and greater than are comparison operators. But there are a number of other ones that we can use as well.

---

## Comparison Operators

- equal: `==`
- identical: `===`
- compare: `> < >= <= <>`
- not equal: `!=`
- not identical: `!==`


^ One of the most important ones, is equal. Are two things equal? Compare them. Is A equal to B? It's made up of two equal signs. When we're testing if something is equal, we use it by using two equal signs. So, when we have one equal sign, we're doing assignment. We're assigning a value to something. When we have two of them, we're comparing the two. It's important to keep the two straight. One is for assignment, two is for comparison.

^ We also have another version, which is three. Together which if for identical. Now, what's the difference between equal and identical? Well, there are some things that are considered equal because they're roughly equal. For example, the number 1, 2, 3 is considered equal to the string. One, two, three. Because if we convert the types, then they are considered equal but they are not considered identical.

^ Identical, they have to be of the same type as well. So, it just goes a little bit further in the check to make sure that they are absolutely 100% the same. Most times, you're going to find yourself just using equal though, with two of them. There's also comparison, we saw the greater than, less than. There is a greater than or equal to, or less than or equal to. Or there's it either less than or greater than. And of course, if we're going to do not equal to, we can also just simply say not equal using exclamation point equal. That exclamation point is going to mean not in PHP. We're going to see that again later on.

^ And then, of course, we also have not identical, which would be not followed by two equals signs.

---

## Logical Operators

- and: `&&`
- or: `||`
- not: `!`

^ We also can combine several of these together by using some logical operators. So, for example, for and we can use two ampersands together.

^ What we're saying here is if A is greater than B, and if C is greater than D. They're testing two different things and combining them with this &. Both parts of it have to be true. If this is true and this is true, then the whole expression evaluates to true. We also have or that's made of these two upright bars, often called Pipes. Take a second to figure out where that is on your keyboard. It's typically right above the Return key. And this would be a logical or. So, if a is greater than b, or if c is greater than d. And then, of course, as we talked about, there's not. So, something is just not true, we can negate the expression just by putting the exclamation point in front of it.

---

## Comparison and Logical Operators

```php
$a = 4;
$b = 3;
$c = 1;
$d = 20;

if (($a > $b) && ($c > $d)) {
  echo "a is larger than b AND ";
  echo "c is larger than d";
}
```

^ Setup the variables, and then the expression. If a is greater than b, notice that I'm using parentheses around it to group it together, and if c greater than d. So, if both of those conditions are met, this and this, then this entire expression will evaluate to true. Because both parts have been met. So, both trues together mean that the whole thing is true. If either one is false, well then it's not a true statement. It's not true that both a is greater than b and c is greater than d. So, it evaluates to false.

---

## Comparison and Logical Operators

```php
$a = 4;
$b = 3;
$c = 1;
$d = 20;

if (($a > $b) || ($c > $d)) {
  echo "a is larger than b OR ";
  echo "c is larger than d";
}
```

^ If we switch the operator to the OR comparison this will evaluate to true.

---

## Comparison and Logical Operators

```php
if (!isset($e)) {
  $e = 200;
}
echo $e;
```

^ Here's a more real life example. Here is an _if_ statement that uses the _not_ operator (the exclamation point). I'm going to tap into another PHP function, `isset` which will check if a variable is set or not. So in this example, we're checking to see if variable `$e` is not set, in which case, we'll set the value to 200. The we `echo` the value of `$e`.

---

## Comparison and Logical Operators

```php
$quantity = 0;

if (empty($quantity) && !is_numeric($quantity)) {
  echo "You must enter a value";
}
```

^ Here's another example. Let's say we have a form coming in. First we check the value coming in using a PHP function `empty` which will allow the value coming in to be zero, which otherwise might be interpreted as _false_. Next we check to make sure the value is a number. If both conditions are met, then the `echo` will **not** be executed.

---

## Comparison and Logical Operators

```php
$quantity = "";

if (empty($quantity) && !is_numeric($quantity)) {
  echo "You must enter a value";
}
```

^ Here's the same example, but now the value coming in is an empty string. This will cause the second portion of our expression to be true, which will cause the `echo` statement to be executed.

---

## Switch Statements

^ Next we're going to be looking at a different kind of logical expression called Switch Statements. Switch statements are similar to if statements. In that they control the flow through our application. But they're going to have a different syntax, some different rules to follow. And a couple of special gotchas that we want to make sure that we watch out for.

---

## Switch Statements

```php
switch (value) {
  case test_value1:
    statement;
  case test_value2:
    statement;
  default:
    statement;
}
```

^ First, let's look at the basic syntax. We're going to use the function name, `switch`, followed by an argument. And that argument's going to be a value. This is the value that we're going to be testing through each of a series of test cases. So then in our curly braces we're going to list off those test cases.

---
## Switch Statements

```php
switch (value) {
  case test_value1:
    statement;
  case test_value2:
    statement;
  default:
    statement;
}
```

^ And each one is going to start with case, and then a test value to that we're going to test against value to see if their equal. And then a colon, and then a statement or series of statements that we want to execute. Then following that will be the next case that we want to test. So we'll test whether the values equal to test value two and if it is then we'll execute those statements. And then finally we have the option to provide a default case. If it doesn't match any of the above cases we're going to execute the statements that are defined by default. So, notice that we're dropping down each one of those cases, doing a test on each line.

---

## Switch Statements

```php
switch (value) {
  case test_value1:
    statement;
  case test_value2:
    statement;
  default:
    statement;
}
```

^ It's very similar if we've written if, else if, and else. The big difference here is that we're testing equality. We're testing to see, is the value equal to test value 1, no? Okay, move down to the next one. Is value equal to test value 2? That's a very simple comparison of equality. There's no greater than or less than or anything like that. And usually, we're not working with Booleans. Because a boolean is either true or false, so there's really not a lot of test cases. Where you would see it more is it you had something like a string that could be many different things.

---

## Switch Statements

```php
switch ($contact) {
  case "email":
    statement;
  case "phone":
    statement;
  default:
    statement;
}
```

^ For example let's say that our customers had told us that the way that they wanted to be contacted. And they might have said that they wanted to be contacted by email or by phone or by some other message. Text message, Skype, something else, so we could have a switch statement that then executed a set of statements. Based on the way that they told us they wanted us to contact them. Now I only provided two case statements here and a default, but you can have as many cases as you need. You could just keep adding different cases each time. Now most times you're probably going to want if else statements.

---

## Switch Statements

```php
switch ($contact) {
  case "email":
    statement;
  case "phone":
    statement;
  default:
    statement;
}
```

^ You are going to use those way more often than switch statements. The switch statements are going to be very useful when you do have this kind of compact logic. Where you really are just saying, all right I want to test a value and that value can be ten different things. So I'm going to list off the ten different things that could happen if that value is each of those ten cases. And I'm going to provide code for those. The parallel structure can be a little bit easier to read, and to work with. Okay, now that we know the syntax and the basic idea, let's try some out.

---

## Switch Statements

```php
$a = 3;

switch ($a) {
  case 0:
    echo "a equals 0";
  case 1:
    echo "a equals 1";        
  case 2:
    echo "a equals 2";
  case 3:
    echo "a equals 3";          
}
```

^ Alright, so to start with, let's just give ourselves a variable. We'll call it a, and we're going to make a equal to 3. And then, let's do a switch statement. Switch and then send the variable `$a` as the argument to switch. So we're going to be testing variable a. And in the case where it is 0, then we're going to echo a equals 0, will be our tag at the end, and semicolon after that. (_example_)

---

## Switch Statements

```php
$a = 3;

switch ($a) {
  case 0:
    echo "a equals 0"; break;
  case 1:
    echo "a equals 1"; break;
  case 2:
    echo "a equals 2"; break;
  case 3:
    echo "a equals 3"; break;
}
```

^ You'll see that it comes back and it executes the first one and every case that comes after it. It's an important point about the way that switch statements work. They do the statement that matches. And then they continue to match every one that comes below it. Well that's probably not what we wanted. So if you don't want that behavior, then you've got to provide a break statement. (_example_)

---

## Switch Statements

```php
$year = 2013;
switch (($year - 4) % 12) {
  case 0: $zodiac = "Rat";      break;
  case 1: $zodiac = "Ox";       break;
  case 2: $zodiac = "Tiger";    break;
  case 3: $zodiac = "Rabbit";   break;
  case 4: $zodiac = "Dragon";   break;
  case 5: $zodiac = "Snake";    break;
  case 6: $zodiac = "Horse";    break;
  case 7: $zodiac = "Goat";     break;
  case 8: $zodiac = "Monkey";   break;
  case 9: $zodiac = "Rooster";  break;
  case 10: $zodiac = "Dog";     break;
  case 11: $zodiac = "Pig";     break;
}
echo "{$year} is the year of the {$zodiac}";
```

^ This example is going to output the Chinese zodiac, the year that it is in the Chinese zodiac. So to do that, we're going to do a little bit of a calculation. We're going to take the year, we're going to use 2013, and I'm going to subtract four from it. Then I'm finding the remainder once we divide it by 12. So after we divide it by 12 evenly, how many are left over? So that end result is going to be a single value. So even though I've got a calculation in here, it's a single value that comes through in the end, and that's what I'm testing.

---

## Switch Statements

```php
$year = 2013;
switch (($year - 4) % 12) {
  case 0: $zodiac = "Rat";      break;
  case 1: $zodiac = "Ox";       break;
  case 2: $zodiac = "Tiger";    break;
  case 3: $zodiac = "Rabbit";   break;
  case 4: $zodiac = "Dragon";   break;
  case 5: $zodiac = "Snake";    break;
  case 6: $zodiac = "Horse";    break;
  case 7: $zodiac = "Goat";     break;
  case 8: $zodiac = "Monkey";   break;
  case 9: $zodiac = "Rooster";  break;
  case 10: $zodiac = "Dog";     break;
  case 11: $zodiac = "Pig";     break;
}
echo "{$year} is the year of the {$zodiac}";
```

^ So whatever that value is, whatever that remainder is it will check. If it's 0, then we are in the first year of the 12 year cycle, so it is the Year of the Rat. If it's a one, well then we know we're in the next year and the year is the Ox and so on. What I want to show you here, though, is that white space doesn't matter. Do you see the difference here? Up here, we had each one of these on a separate line. Case 1 echo break, case 2 and so on. Here I've got them all one after another, very compact, very easy to read.

---

## Switch Statements

```php
$user_type = "customer";

switch ($user_type) {
  case "student":
    echo "Welcome!";
    break;
  case "press":
    echo "Hello!";
    break;
  case "customer":
    echo "Hello!";
    break;
  case "admin":
    echo "Hello!";
    break;
}
```

^ What if you want to execute the same commands for multiple user types?

---

## Switch Statements

```php
$user_type = "customer";

switch ($user_type) {
  case "student":
    echo "Welcome!";
    break;
  case "press":
  case "customer":
  case "admin":
    echo "Hello!";
    break;
}
```

^ You can load up multiple cases, and since there is no `break`, if any of these cases are true, the same `echo` command will be executed.

---

## Control Structures: Loops

^ Next we're going to be looking at the other main type of control structure, loops. Loops allow us to write code that will execute more than once, without having to write out all of that code over and over again. The code executes once and then it loops back to the start to execute again. And each time the code executes, it doesn't necessarily do the exact same thing. The values of variables may be changed each time it goes through the loop. So that logical expressions inside the loop do different things.

^ And of course, a critical feature of any loop is knowing when to stop looping. We're going to take a look at three types of loops.

---

## While Loops

```php
while (expression) {
  statement;
}
```

^ While loops, for loops, and foreach loops. We're going to begin with while loops. I think these are the simplest. The syntax is simply while followed by an expression, that's the argument to it and then a statement. The statement is the loop, the thing we're going to do over and over again, while the expression evaluates to true.

^ So what happens is it says, while expression is equal to true. Do this block of code. Start at the top and do all of these statements and when you get to the bottom, come back to the top again and reevaluate the expression. Is it still true? If it is, go through and do all the statements again until you get to the last curly brace.

---

## While Loops

```php
while ($count <= 10) {
  echo $count;
  $count++;
}
```

^ So let's say that we have while, the variable count is less than or equal to 10. So as long as that's true, as long as count is less than or equal to 10, we're going to echo the count and then add 1 to it.

^ Then we'll go back to the top, and we'll check again, is count less than or equal to 10. And if it is less than or equal to 10, it will echo the count and then add 1 to the count and go back to the top again. When count is equal to 11, it's no longer less than or equal to 10.

---

## While Loops

```php
while ($count <= 10) {
  echo $count;

}
```

^ Without the variable being updated on each pass, it'll just keep going and you'll just keep outputting the same value over and over and over again. But we have to have some relationship between what's happening inside the loop and the condition that's above it. Something has to eventually change so that now the behavior of the loop will be triggered and we won't just be going infinitely through it.

---

## While Loops

```php
$count = 0;
while ($count <= 10) {
  echo $count . ", ";
  $count++; // increment by 1
}

// 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
```

^ Let's do the example that we just had. Let's do count equals zero, and then while and then our expression. And then while count is less than or equal to 10. And then inside our curly braces, what do we want to do each time? So until count gets to 10 we're going to echo count, I'm going to go ahead and put a comma after it.

---

## While Loops

```php
$count = 0;
while ($count <= 10) {
  echo $count . ", ";
  $count++; // increment by 1
}

echo "Count: {$count}";
// Count: 11
```

^ Once the loop is done, the rest of our PHP script executes, so we can see the value of `$count` once the loop is complete is now 11.

---

## While Loops

```php
$count = 0;
while ($count <= 10) {
  if ($count == 5) {
    echo "FIVE";
  } else {
    echo $count . ", ";
  }
  $count++; // increment by 1
}

// 0, 1, 2, 3, 4, FIVE, 6, 7, 8, 9, 10
```

^ We can do anything we like inside the loop. Here I'll add a conditional statement and output something different if our variable is equal to five.

---

## While Loops

```php
$number = 0;
while ($number <= 20) {
  echo "<p>{$number}: ";

  if ($number % 2) echo "is odd";
  else echo "is even";

  echo "</p>";
  $number++;
}
```

^ Here's another example that combines a while loop and if conditional statement. The _modulo_ operator (the percentage sign) determines i whether a number divides evenly by another number or not, by returning the remainder. So, it returns the remainder once you divide. In this example, it will tell us how many are left over if we divide by two, so even numbers will not have a remainder, odd numbers will. The if statement will echo different text depending on the result.

---

## For Loops

^ For loops are similar to While Loops. They repeat a section of code until a condition is met. The syntax used is very different. Why have both? For Loops are the most classic kind of loop that there is, and they're used in many other programming languages. Let's take a look at the syntax.

---

## For Loops

```php
for (expr1; expr2; expr3) {
  statement
}
```

^ It looks very similar at first, except for the expression part. Instead of having one expression, we're going to have three separated by semicolons. And each one is going to perform a different function. Expression 1, is going to be executed the first time only, it's like an initializing statement before the loop starts. Expression 2 is the test expression that's going to be checked at the start of each loop.

---

## For Loops

```php
for (expr1; expr2; expr3) {
  statement
}
```

^ Just like the expression we had in the While Loop, Expression 3 is going to be executed at the end of every loop. Right after the loop finishes, right before it goes back and evaluates expression 2 again.

---

## For Loops

```php
for (initial; test; each) {
  statement
}
```

^ Perhaps a better way to think about it is as _initial_, _test_ and _each_. There's the initial value, there's a test that it's going to perform each time, and then each time through the last thing that it's going to do is execute that each statement.

---

## For Loops

```php
$count = 0;
while ($count <= 10) {
  echo $count . ", ";
  $count++;
}
```

^ So here's our While Loop again. Let's accomplish the same thing with a For Loop.

---

## For Loops

```php
for ($count = 0; )
```

^ We're going to have our initializing statement, which will be the first argument. Just like in the While Loop, we're going to initialize the `$count` variable to have a value of zero.

---

## For Loops

```php
for ($count = 0; $count <= 10; )
```

^ After the first argument we have a semicolon, then we have a second statement that is going to be the test each time through. Is `$count` less than or equal to 10?

---

## For Loops

```php
for ($count = 0; $count <= 10; $count++)
```

^ The last argument will be the expression of what we do each time through. In this case, we're going to be incrementing the value of `$count` each time we step through the loop.

---

## For Loops

```php
for ($count = 0; $count <= 10; $count++) {
  echo $count . ", ";
}
```

^ Once the arguments are setup we fill in what we're going to define the business that's happening each time we go through the loop, in this case we'll just `echo` the value of `$count`;

---

## For Loops

```php
for ($count = 0; $count <= 10; $count++) {
  if ($count % 2 == 0 )
    echo "{$count} is even.<br>";
  else
    echo "{$count} is odd.<br>";
}
```

^ Here's our second example, testing for odd/even, done as a For Loop. Both loop styles do the same thing, it's just a different syntax. It's a matter of preference and situation.

---

## Foreach Loops

^ Foreach loops are a little different from the previous two types of loops. Foreach loops are going to take an array and loop through each item of the array until it gets to the end. If you think back, while loops and for loops know whether to quit or to keep looping by testing if a condition has been met. Foreach loops, on the other hand, are going to know whether to quit or whether there are items left in the array to loop over. The end of the array is what ends the looping.

---

## Foreach Loops

^ Imagine that I have a classroom with 20 kids in it. And I have to put name tags on all of them. Now, I could just go around the room. And I could put a name tag on each kid and keep track of the numbers as I went. And knowing that there are 20 kids, when I had gotten to the number 20, I'd know I was done. Or, since I know that I have a finite set, I could just line them all up, start at the beginning and move down the line. And when I got to the end of the line, I would know I was done. I wouldn't have to keep track of the count as I was going. I mean, I could count. I could certainly know that I was on the fourth kid, but I wouldn't have to. I could just start at the first kid, go to the second kid, and then the third kid, until I got to the end of the line. That's how a foreach loop works.

---

## Foreach Loops

```php
foreach ($array as $value)
  statement;
```

^ The syntax is a bit different. We have `foreach`, all one word with no spaces and then in parentheses a special statement. The first thing we're going to provide is the array that we're looping through. This doesn't have to be _array_, it's a placeholder for your array variable, whatever it's called. Next we have a special keyword `as` and then we have another variable called `$value`. Value also can be named something else.

---

## Foreach Loops

```php
foreach ($array as $value)
  statement;
```

^ What it's doing though is each time it goes through the loop each item in the array is going to be assigned to this variable value. So in this example, `$array` is a value that is assigned before the `foreach` statement, `$value` is something that we're creating right now for use only inside the loop. Each time it goes through the loop we have access to that variable, and that variable is a reference to the item in the array that we're currently working with.

---

## Foreach Loops

```php
$ages = [4, 8, 15, 16, 23, 42];

foreach ($ages as $age) {
  echo "Age: {$age}<br>";
}
```

^ To make this make more sense, let's look at an example. Here we have an array filled with numbers, and I'm assigning those numbers to the variable `$ages`. Next I have my foreach loop, and it's going to take that array, and temporarily assign each of the values to the variable `$age`. Each time we go through the loop we have access to one of the values in the `$ages` array, and that value is assigned to the variable `$age`.

---

## Review Loops (so far)

---

## While Loop

```php
$ages = [4, 8, 15, 16, 23, 42];
$i = 0;
while ($i < count($ages)) {
  echo "Age: {$ages[$i]}<br>";
  $i++;
}
```

---

## For Loop

```php
$ages = [4, 8, 15, 16, 23, 42];

for ($i = 0; $i < count($ages); $i++) {
  echo "Age: {$ages[$i]}<br>";
}
```

---

## Foreach Loop

```php
$ages = [4, 8, 15, 16, 23, 42];

foreach ($ages as $age) {
  echo "Age: {$age}<br>";
}
```

---

## Foreach Loops - Associative Arrays

```php
foreach ($array as $key => $value) {
  statement;
}
```

^ Back to Foreach loops. This format is simple and powerful. It works with regular arrays, but also associative arrays. Remember when we discusses associative arrays, we saw how they have a _key_ and a _value_. We just have to modify our syntax to make associative arrays work with foreach. The structure is the same, but we're going to have two variables that we're going to assign, one for the _key_ and one for the _value_.

---

## Foreach Loops - Associative Arrays

```php
$person = [
  "first_name" => "Homer",
  "last_name" => "Simpson",
  "address" => "742 Evergreen Terrace",
  "city" => "Springfield"
];
```

^ They don't have to be called _key_ and _value_ either, but the important part is that we have two variables and in between them is the equals greater sign. So let's start an example, first we'll setup our array.

---

## Foreach Loops - Associative Arrays

```php
$person = [
  "first_name" => "Homer",
  ...

foreach ($person as $attribute => $data) {
```

^ Now let's build our foreach loop. For each entry in the array `$person`, extract the data, storing the _key_ inside variable `$attribute` and the _value_ of that _key_ in the variable `$data`. So the first time through, the _key_ is "first\_name", and the _value_ is "Homer".

---

## Foreach Loops - Associative Arrays

```php
$person = [
  "first_name" => "Homer",
  "last_name" => "Simpson",
  ...

foreach ($person as $attribute => $data) {
```

^ The second time through, the _key_ is "last\_name" and the _value_ is "Simpson".

---

## Foreach Loops - Associative Arrays

```php
foreach ($person as $attribute => $data) {
  echo "{$attribute}: {$data}<br>";
  // first_name: Homer
  // last_name: Simpson
  // etc.
}
```

^ So if we build our loop body, we can `echo` the _key_ and the _value_ as part of a string, and show all the information stored in an array. This is a good example of what your data can look like when coming from a database. We can enhance this further and clean up the data so that it reads a bit nicer for our users.

---

## Foreach Loops - Associative Arrays

```php
foreach ($person as $attribute => $data) {
  $attr_nice = ucwords(str_replace("_", " ", $attribute));
  echo "{$attr_nice}: {$data}<br>";
  // First Name: Homer
  // Last Name: Simpson
  // etc.
}
```

^ We can use `ucwords` to uppercase the first letter of each word in the string, and we can replace the underscores with spaces.

---

## Foreach Loops - Associative Arrays

```php
$prices = [
  "Brand New Computer" => 2000,
  "1 month of music" => 10,
  "Learning PHP" => NULL
];

foreach ($prices as $item => $price) {
```

^ I'm going to give you another example before we move on. Let's say we have another associative array that looks like this. So our keys are _Brand New Computer_, _1 month of music_ and _Learning PHP_. And the values are _2000_, _10_ and _null_. I've assigned this data to `$prices`. For each item in `$prices` I'm going to assign those to the variable `$item`, because each of these are items. Each of these prices is going to be assigned to the variable `$price`.

---

## Foreach Loops - Associative Arrays

```php
$prices = [
  "Brand New Computer" => 2000,
  "1 month of music" => 10,
  "Learning PHP" => NULL
];

foreach ($prices as $item => $price) {
  echo "{$item}: ";
  if (is_int($price)) echo "$" . $price;
  else echo "priceless";
  echo "<br>";
}
```

^ As I iterate through each of these, I'm going to have a conditional statement that's going to check to see whether or not price is an integer, which will be true for the first two by not the last one.

---

## Continue / Break

^ Now that we've looked at different types of loops, we are going to learn how to use the functions `Continue` and `Break` to get more utility and flexibility from these loops.

---

## Continue

^ We'll start with Continue. Continue is used inside a loop to skip the rest of the current iteration and to go immediately to the conditional valuation that starts the next iteration. As an example, think of a Hollywood casting director, shouting in the middle of an audition, "okay that's enough, next!". It's like saying, enough with this one, let's move on to the next one.

---

## Continue

```php
for ($count = 0; $count <= 10; $count++) {
  echo $count . ", ";
}
```

^ That's what continue allows us to do. And it makes our code more efficient. Here's the same basic loop we looked at before, just counting numbers and echoing them out.

---

## Continue

```php
for ($count = 0; $count <= 10; $count++) {
  if ($count == 5) {
    continue;
  }
  echo $count . ", ";
  // 1, 2, 3, 4, 6, 7, 8, 9, 10
}
```

^ In our previous example, we setup a conditional where if the current count was equal to five, we echoed something different. Instead this time I'm going to have it just do `continue`. When `$count` equals 5, the `if` conditional is met, and the `continue` function is executed. This basically tells PHP to immediate loop, which increments the `$count` to 6 and continues.

---

## Break

^ We used `break` when we covered the `switch` statement, which allowed us to break out of a `case` within the statement. The `break` in a loop will similarly "break" us out of the loop, effectively ending execution of the loop. Go back to our Hollywood director example, this would be like the director watching a few auditions and then saying "You've got the job, the rest of the auditions are cancelled".

---

## Break

```php
for ($count = 0; $count <= 10; $count++) {
  if ($count == 5) {
    break;
  }
  echo $count . ", ";
  // 1, 2, 3, 4,
}
```

^ We can look at our previous example, and change `continue` to `break` within our `if` statement.

---

> speaking of breaks...

---

## Functions

^ A function is code that preforms a specific task, which is then packaged up into a single unit that can then be called upon whenever that task is needed. An example of a function that we've already seen and used would be in array. Any time we want PHP to whether an element is in an array we can call the in array function. We provide the function data to work with in the form of arguments. And the function returns output to us at the end. These are common feature functions, providing them input and getting back output. Up until now, we've been looking at the built-in functions that PHP provides, but we aren't limited to just these functions.

---

## Functions Syntax

```php
function name
```

^ We can define our own functions, so we'll start by learning the syntax that's used to define them. You define a function first by saying, _function_, then a space. And then you want to give his function a name, much like the variable names we assign. The rules are similar, we can have letters, numbers, underscores and dashes. You can not have spaces and function names must start with a letter or an underscore. Function names are case insensitive.

---

## Functions Syntax

```php
function name($arg1, $arg2) {
```

^ Then we have parentheses with our arguments list. These are the arguments that the function is going to accept; in this example `$arg1` and `$arg2` separated by a comma between them. Both are variable names so they include the dollar sign, and we can have as many as you need.

---

## Functions Syntax

```php
function name($arg1, $arg2) {
  statement;
}
```

^ Then we have our curly braces and the meat of the function. The code of the function is wrapped in the braces, and is now reusable, able to be called from a lot of different places.

---

## Functions

```php
function say_hello() {
  echo "Hello World!<br>";
}
```

^ Let's look at an example. We start with the keyword _function_, followed by the name of the function. The name of this function is _say\_hello_. We put empty parentheses so it's clear that this is where the arguments would go, in this case, our function does not have any arguments. Then curly braces and then whatever code we want packaged up, whatever we want to happen in this function. In this example we're just going to have it echo "Hello World!".

---

## Functions

```php
<?php say_hello(); ?>

// Hello World!
```

^ Defining a function makes it available to us, but it will not actually output anything else we specifically call the function.

---

## Function Arguments

```php
function say_something($word) {
  echo "Hello {$word}<br>";
}

say_something('Cowboy!')

// Hello Cowboy!
```

^ Let's try this with an argument. We'll define a new function `say_somthing` and include a variable placeholder for a single argument `$word`. We can now access that argument within our function, so here I'm going to `echo` the value of `$word` as part of the string. Arguments give us flexibility to reuse code and have it do something slightly different based on input that we pass in.

---

## Function Arguments

```php
say_something('Cowboy!')
// Hello Cowboy!
say_something('Princess!');
// Hello Princess!
```

---

## Functions

- define at the root of document
- can not be redefined

---

## Function Arguments

```php
function say_hello($word) {
  echo "Hello {$word}!";
}

$name = "John Doe";
say_hello($name);
```

^ You can pass in data directly, or you can pass existing variables into the function. Here we have `$name` being passed to our `say_hello` function. Note that the variable `$name` is passed to the function as an argument, and is stored in the `$word` argument variable.

---

## Function Arguments

```php
str_replace("quick", "super-fast", $third);

function str_replace($find, $replace, $target) {

}
```

^ Think about some of the examples of functions we've already looked at. For example `str_replace` allows us to find some text in a string and replace it with some other text. There is a function built into PHP that accepts three arguments and performs this replacement for us, as long as the arguments are supplied in the correct order.

---

## Function Arguments

```php
function better_hello($greeting, $target, $punct) {
  echo $greeting . " " . $target . $punct . "<br>";
}

$name = "John Doe";
better_hello("Hello", $name, "!");
// Hello John Doe!
better_hello("Greetings", $name, "!!!");
// Greetings John Doe!!!
```

^ Here we're creating a better greeting function, where we have flexible parameters for the greeting we want to use, who is going to be greeted and what type of punctuation we want to include at the end of the greeting.

---

## Returning Values From A Function

^ All of our functions, so far, have been using echo to send output to the user's screen. But more often than not, we don't want that behavior. Usually, we'd like to get a result back from the function, and then decide what to do with that result ourselves. We might end up deciding to echo it to the screen, but we might instead take that value and continue to use it to do more processing. If it outputs from inside the function, then we lose that flexibility. It's better to get back a value. And for that, we need to understand, how to return values from a function.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
}

add(3,4);
```

^ Here's a simple function that takes two arguments, value 1 and value 2. The function adds them together and assigns them to a sum. Notice that in this example we're not echoing anything inside the function like we did in previous examples. So if we were to run this function, nothing would be output to the browser window.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
  echo $sum;
}

add(3,4);
```

^ If we add an `echo` to the function it would output a value, but that's not as flexible.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
}

add(3,4);
echo $sum; // ERROR!
```

^ We could try echoing the value of `$sum` after the function has been called, but we'll get an error because `$sum` is part of the `add` function and is only available while working inside the function.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
  return $sum;
}

add(3,4);
```

^ We need to get the `$sum` value out of the function. So we can use the `return` command to return the value of `$sum` to us outside of the function.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
  return $sum;
}

$result = add(3,4);
```

^ And we have to catch that value, so in this example we'll use the variable `$result`, which we'll set to equal the sum of 3 and 4.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
  return $sum;
}

$result = add(3,4);
echo $result; // 7
```

^ Now we can `echo` this to the screen.

---

## Returning Values From A Function

```php
function add($val1, $val2) {
  $sum = $val1 + $val2;
  return $sum;
}

$result = add(3,4);
$result = add(5, $result);
echo $result; // 12
```

^ But we don't have to `echo` if we don't want, we can do more operations. The best practice when working with functions is to always have a `return`. This will give you maximum flexibility. The `return` also exits us from a function immediately, similar to `break`. Even if we put a `return` inside a loop or switch statement, it will still end the function and immediately exit.

---

## Returning Values From A Function

```php
function better_hello($greeting, $target, $punct) {
  echo $greeting . " " . $target . $punct . "<br>";
}

$name = "John Doe";
better_hello("Hello", $name, "!");
```

^ If we go back to our `better_hello` function, we can optimize this using a `return` to avoid having an `echo` in the function.

---

## Returning Values From A Function

```php
function better_hello($greeting, $target, $punct) {
  return $greeting . " " . $target . $punct . "<br>";
}

$name = "John Doe";
echo better_hello("Hello", $name, "!");
```

^ So the function now will return the string, and we can then `echo` the returned value, or concatenate it into a longer string, or basically do whatever additional processing we want.

---

## Multiple Return Values

^ A function can only return a single value. So what if we need to return more than one value? Let's make an example.

---

## Multiple Return Values

```php
function add_subt($val1, $val2) {
  $add  = $val1 + $val2;
  $subt = $val1 - $val2;
  return $add;
}
```

^ This function is called _add_ _subt_ which is short for subtraction. So it's going to add and subtract two values, value 1 and value 2. We know how to use `return` and how to return `$add`, but how can we also return `$subt`?

---

## Multiple Return Values

```php
function add_subt($val1, $val2) {
  $add  = $val1 + $val2;
  $subt = $val1 - $val2;
  return $add;
}

$result = add_subt(10,5);
echo $result; // 15
```

^ Nothing new, that will return the value of the `$add` variable.

---

## Multiple Return Values

```php
function add_subt($val1, $val2) {
  $add  = $val1 + $val2;
  $subt = $val1 - $val2;
  return $add, $subt;
}

$result = add_subt(10,5);
echo $result; // ERROR! unexpected comma
```

^ What if we try a comma in our return, so return `$add` comma `$subt`? We get a parse error that states unexpected comma. So that doesn't work. Functions only allow us to return on thing. So let's think, is there a PHP entity that will hold more than one entity?

---

## Multiple Return Values

```php
function add_subt($val1, $val2) {
  $add  = $val1 + $val2;
  $subt = $val1 - $val2;
  return array($add, $subt);
}

$result_array = add_subt(10,5); // an array
echo "Add: " . $result_array[0] . "<br>Subtract: " . $result_array[1];
// Add: 15
// Subtract: 5
```

^ Arrays to the rescue. We can return an array instead. So we're returning a single entity, the array, which contains multiple entities, in this example `$add` and `$subt`. So here I've changed the `return` in the function to an array, and I've changed the variable name that catches the `return` to `$result_array`. I also don't want to just `echo` the value anymore. I've updated the `echo` statement so that it says _Add_, then from the `$result_array` we access the data in slot zero. Then we concatenate with a break tag, and then _Subtract_ and the data in slot one of the array.

^ So using arrays we can `return` as much data as needed from our functions. And we can even do better.

---

## Multiple Return Values

```php
function add_subt($val1, $val2) {
  $add  = $val1 + $val2;
  $subt = $val1 - $val2;
  return array($add, $subt);
}

list($add_result, $subt_result) = add_subt(20,7);
echo "Add: " . $add_result . "<br>Subtract: " . $subt_result;
```

^ There is a function available to us called `list`. So this time, instead of `$result_array`, we're just going to say `list` and then in parentheses, provide the variables that we want to use. I'll call one add result and one subt result. So this will take the values from the returned array and assign them to add result and subt result. Then I can use those instead of the index value of an array. It takes all those elements that we package up into an array to get out of the function and immediately breaks them back down, unpacked and assigned to variables that have good, common sense names that are easy to identify and work with.

---

## Scope and Global Variables

^ We've seen how the variable names inside the function and outside the function are unrelated, and we wrote a function to do addition. The variable's sum was only available inside the function. We couldn't use echo outside the function to retrieve that value, we had to use a return value instead. Having this division between the variables inside a function and outside a function, is known as variable scope. A variable isn't accessible all the time. It's only accessible within it's context. A variable created inside a function, is by default only accessible In the function we say that the function is the variable's scope.

^ In PHP there are two main scopes. There is the Global Scope and there is the Local Scope. Let's take a look at them so we can see the difference.

---

## Scope and Global Variables

```php
<?php
$bar = "outside"; // global scope
?>
```

^ So to start our example, let's assign a variable to `$bar` equal to "outside". This is going to be in the _global scope_.

---

## Scope and Global Variables

```php
<?php
$bar = "outside"; // global scope

function foo() {
  $bar = "inside"; // local scope
}
?>
```

^ Now let's write a function, called `foo` and inside that function that's once again set `$bar`, this time equal to "inside". That's is going to be _local scope_.

---

## Scope and Global Variables

```php
<?php
$bar = "outside"; // global scope

function foo() {
  $bar = "inside"; // local scope
}

echo "1: " . $bar . "<br>";
foo();
echo "2: " . $bar . "<br>";
?>
```

^ Next we're going to `echo` one, and concatenate that with the value of `$bar`. Then we'll call the `foo` function, and echo `$bar` again. (run in browser)

---

## Scope and Global Variables

```php
<?php
$bar = "outside"; // global scope

function foo() {
  $bar = "inside"; // local scope
}

echo "1: " . $bar . "<br>";
foo();
echo "2: " . $bar . "<br>";
?>
```

^ They both returned "outside". (highlight `$bar` inside function) This had no effect. We did not set `$bar` equal to "inside", and that's because (highlight global `$bar`) this `$bar` is not the same as (highlight local `$bar`) this `$bar`. Even though they have the same name, they have difference _scope_. So they are actually different variables as far as PHP is concerned. There is a way around this; there is a way to bring in the `$bar` that's outside and use it inside the function.

---

## Scope and Global Variables

```php
<?php
$bar = "outside"; // global scope

function foo() {
  global $bar;
  $bar = "inside"; // local scope
}

echo "1: " . $bar . "<br>"; // outside
foo();
echo "2: " . $bar . "<br>"; // inside
?>
```

^ The way we do that is by using the keyword `global`, followed by `$bar`. This example is declaring `$bar` as `global`. So we set `$bar` equal to "outside", then we call the `foo` function. Inside the `foo` function we access the `global` variable `$bar`, and set the value of that `global` variable equal to "inside". Then when we do our second `echo`, we're back in the `global` scope, accessing the `global` variable `$bar`, which is now equal to "inside".

---

## Setting Default Argument Values

^ We've already learned that the arguments when you call a function must match the arguments that were used to define the function. If you define it with three arguments, then you need to provide three arguments as input. However, there is a way around that, by setting default argument values.

---

## Setting Default Argument Values

```php
function paint($color) {
  return "The color of the room is {$color}.<br>";
}

echo paint("blue");
// The color of the room is blue.
```

^ Here's a simple function called _paint_. This function is going to accept one argument `$color`. The work this function is going to do is we're going to return a string. We know how to call that function.

---

## Setting Default Argument Values

```php
function paint($color) {
  return "The color of the room is {$color}.<br>";
}

echo paint();
// ERROR! Missing argument for paint()
```

^ If we were to take "blue" away, we get an error telling us we're missing an argument for the function `paint`. We didn't pass anything in, so it won't work. But if we use a default argument we can avoid this error.

---

## Setting Default Argument Values

```php
function paint($color="red") {
  return "The color of the room is {$color}.<br>";
}

echo paint();
```

^ The way we do that is to include an assignment right after the argument (highlight function with argument and assignment _red_). So if we call our function `paint` and we do not provide an argument in our call, the function will use the default assigned value (in this case "red").

---

## Setting Default Argument Values

```php
function paint($room="office", $color="red") {
  return "The color of the {$room} is {$color}.<br>";
}

echo paint("bedroom", "blue");
echo paint("bedroom");
echo paint("blue");
```

^ We can have more than one. Let's say we're going to have the room and color. So we add a second argument `$room` and assign a default value of "office". We separate the arguments with a comma. So to call our function we should be passing two arguments. What will our output be for each of these cases?

---

## For Next Week...
