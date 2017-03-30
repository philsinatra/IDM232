build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 8
### Regulate Page Access

---

## User Authentication

^ To being this process, we will learn to restrict access to a portion of our application, so that only users who log in with a valid user name and password can have access to those pages. We call this process, User Authentication. User authentication, and the related topics of encryption and security are not exactly beginner topics, there's a lot to learn there. The password protected areas have become so common that you're almost guaranteed to need one in every site you build, even if you're a beginner. And it's important to add your user authentication correctly, because mistakes in this area can be especially costly. We'll start by getting an overview of the process.

---

![fit](https://media.giphy.com/media/3oEduXeT0j1Bl5uWHK/giphy.gif)

^ And to do that I want to begin with an analogy that I think will help you to understand it. Imagine that you are going to be purchasing tickets to a concert or an event. You go and you pick up the tickets. You wait in line, they let you in. They even stamp your hand at that point, letting you know that you have been allowed into the concert. You have either a wrist band or hand stamp or something like that. At that point, you can actually come and go into the event. You can move around the different rooms. And all the time, they'll know that you've given your ticket and you're allowed to be there, because you either have this hand stamp or the wristband.

---

### Ticket Analogy

- Admin creates a user in the database
  - Purchase tickets for a concert
- User logs in via a login form
  - Wait in line to pick up tickets
- Application authenticates user
  - Presenting ID and tickets
  - Get hand stamped and enter

^ Well, it works the same way here with our pages. (_click_) The Admin is going to create a user in the database. That's like purchasing tickets for a concert. At that point we have the ability to attend, even though we haven't attended yet. (_click_) Then when the user comes to the site, they log in via a login form, that's like waiting in line to pick up your tickets. (_click_) When the application authenticates the user. That is, takes that username and password and sees, are they valid, that's like presenting your identification, getting your tickets and then getting a hand stamp so that you can then enter. And you can then go where you want inside the event.

---

### Ticket Analogy

- User requests additional password protected pages
  - Show hand stamp, avoid line, re-enter
- User logs out
  - Wash away hand stamp

^ When the user requests additional password protected pages, well, that's like showing your handstamp. (_click_) You can avoid the line, you can simply just re-enter, because we know that you have that stamp, we know that you're allowed to be there. (_click_) And last of all, when a user logs out, that's like washing away the handstamp. It essentially says at that point, you're no longer allowed to be in the event, you need a new ticket to get back in. You need to start the process over again.

---

## A Technical View

- Admin creates a user in the database
  - Password is encrypted before user is stored
- User logs in via a login form
- Application authenticates user
  - Search for username in database
  - If username found: encrypt form password and compare

^ I think that analogy can be helpful to hold the concept in your head. But, let's talk about it from a more technical point of view. (_click_) The Admin is going to create a user in the database. The password that they select for that user is going to be encrypted before the user is stored. So we're not going to store the text of the password as plain text, we're going to need to encrypt it first. (_click_) Then when the user logs in via the form, the (_click_) application is going to authenticate them. It's going to do that by searching for the user name in the database and if that user's found, it can encrypt the password they sent in the login form and compare it with the encrypted version that's stored in the database.

---

## A Technical View

### If password matches:

- set a variable in the session to the user ID
- redirect to a post-login page

^ And if they encrypt the same, and we get the same results, we'll know we'll have a match. If the password matches, (_click_) it's going to set a variable in the session to the user ID. That's like getting the hand stamp. (_click_) And then it's going to redirect to a post log in page.

---

## A Technical View

- User requests additional password protected pages
  - Cookies and session data are available
- Application checks the session data for the user ID
  - If present: returns the requests page
  - If absent: redirects to the login form

^ (_click_) Then, when user requests additional password protected pages, that cookie and session data are going to be available with each request. Cookies and session data are how we recognize a user from page to page. So we'll check that session data, (_click_) and we'll look for the user ID. Remember, that's just like the hand stamp, so we're looking to see if that hand stamp is there. And if it is there, we'll know that they're allowed to see the requested page. If it's not there, we'll redirect them to the login form and say sorry, you need to log in; you're not authenticated.

---

## A Technical View

- User logs out
  - Set user ID stored in session variable to `NULL`

^ And then of course, last of all, when the user logs out, we'll just set the user ID that's stored in the session variable to NULL. (_click_) It's essentially like erasing their hand stamp. At that point, they're no longer authorized to see these password protected pages.

^ So, now that we have an overview of the process, we're ready to actually start coding. And the first thing we need to do is create CRUD for our admins, so that those admin users can create other admin users, and assign usernames and passwords to them.

---

## Admin CRUD

^ Let's review the CRUD process by adding support for a _users_ table.

---

## Create the Database

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40),
  `hashed_password` varchar(80)
);
```

^ Use PHPMyAdmin to create a table to hold all the user information. Here are the fields I'm going to use for this example. The `id` field will be the primary key, and then I have a field for the _username_ and for the _hashed\_password_ (which we'll cover in a few minutes). You could include any other fields you want like name, email address etc.

---

## Build HTML Form

```html
<div class="form-group">
  <label for="username">User Name</label>
  <input type="text" name="username" id="username" value="">
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" value="">
</div>
```

^ Next we setup a form in our admin area that we'll use to add or edit a user.

---

## Add A User

```php
$query = "INSERT INTO users (";
$query .= " username, hashed_password";
$query .= ") VALUES (";
$query .= " '{$username}', '{$password}'";
$query .= ")";
```

^ When the form is submitted, go through the normal procedure to validate and clean the content that was sent, and once it's ready, insert the new user into the database.

---

![fit](https://media.giphy.com/media/3orifbG1XLyW8UHCA8/giphy.gif)

^ Before we add this username and password to our database - what's the problem? What do we need to do first?

^ We **CAN NOT** store passwords in plain text. That would be irresponsible and a huge security risk for our users.

---

## Encrypting Passwords

^ Next we're going to look at encrypting passwords. Hashing is the term for the process of taking a string of data and apply a mathematical function to it to produce a unique string of output. Which is known as a hash. We'll be applying an algorithm to a password, to generate an encrypted string. Knowing an encrypting hash won't give away the password and the original password can't be reverse engineered even with lots of computing power.

^ And the hash that it generates for each password will be unique, so that it can only be recreated by using the same password with the same hashing algorithm. In short, the only way to have a password match will be to know the original password and that's what we want.

---

## Encrypting Passwords

- **NEVER** store passwords in plain text
- Use 1 way encryption

^ (_click_) For a multitude a reasons, **never** store passwords in plain text!

^ (_click_) We're going to be using a one-way encryption technique, which means it will not be possible for anyone to get the original password from the encrypted string. So we're going to take the user's password, encrypt it, and then store it in the database. Then when the user comes to log in, we'll take the password they provide, encrypt it, and compare it to the value in the database.

---

## Hashing Algorithms

- MD5
- SHA1
- SHA2 (SHA-256, SHA-512)
- Whirlpool, Tiger, AES
- Blowfish

^ There are dozens of different hashing algorithms available. Not all are suitable for dealing with passwords. Here are a few popular and respected choices we have MD5, SHA-1, SHA-2, Whirlpool, Tiger, AES and Blowfish. Now MD5 used to be a good choice and lots of people used it, but it's not recommended anymore.

^ MD5 was popular for a long time, but there are claims their's a flaw in the encryption and so it's not recommended for use. SHA1 and SHA2 are both solid, rumor has it government agencies are moving towards SHA-2 as a minimum level of security encryption. All of these, other than MDS are decent options now a days. We're going to use SHA1.

---

## SHA1 Hashing

```php
$password = "secret";
```

^ So to begin with, let's have our password equal to a string that we can see. We'll just make it _secret_.

---

## SHA1 Hashing

```php
$password = "secret";
$hashed_password = sha1($password);
```

^ Next we setup a second variable called `$hashed_password`. The value of that variable is equal to the result of running our `$password` variable through the `sha1` hashing function.

---

## SHA1 Hashing

```php
$password = "secret";
$hashed_password = sha1($password);
echo $hashed_password;

// e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4
```

^ When we echo that value back, we get a 40 character, hashed password that _one way_ encrypted, meaning there is no technique to reverse engineer this value back to our plain text password _secret_.

---

## (back to) Add A User

```php
$password = $_POST['password'];
$hashed_password = sha1($password);
```

^ So we want to store the encrypted password in the database. Which means before we add the user, we take the password from the form, and convert it to the hashed version.

---

## Double Check

```php
$query = "SELECT id FROM users WHERE";
$query .= " username = '{$username}'";
```

^ If you want to be extra efficient (and you should be), before you insert the new user, you should check the existing entries to see if a user with the same username already exists, so you don't get a duplicate entry.

^ If this query comes back with a result that shows the username is already being used, you should not add the new user. Instead, display a message explaining the situation.

---

## Add A User

```php
$query = "INSERT INTO users (";
$query .= " username, hashed_password";
$query .= ") VALUES (";
$query .= " '{$username}', '{$hashed_password}'";
$query .= ")";
```

^ Now we can add the user and the hashed password to our database. The plain text version does not exist anywhere where it can be access by a hacker.

---

## A Login Form

```html
<h1>Login</h1>
<div class="form-group">
  <label for="username">User Name</label>
  <input type="text" name="username" id="username" value="">
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" value="">
</div>
```

^ Now we build a login form for our front end, where user's have to fill in their username and password before being allowed to access the rest of the site content. We're checking users in at the door, making sure they have their ticket to get in.

---

## Check That Ticket

```php
$username = $_POST['username'];
$password = $_POST['password'];
$hashed_password = sha1($password);
```

^ When the user submits the form, we compare the info they're submitting to what's in the database. But we have to remember to encrypt the password they're giving us prior to checking the database.

---

## Check That Ticket

```php
$query = "SELECT * FROM users WHERE";
$query .= " username = '{$username}'";
$query .= " AND password = '{$password}'";
$query .= " LIMIT 1";
```

^ Now here we're expecting the user to have filled out the form correctly, which means there should be one match in the database. If this query comes back true, the user has a valid ticket into the show, or is allowed to access the site.

^ If this query fails, the user's info does not match the database, their ticket is no good.

---

## Hand Stamp

```php
$_SESSION
```

^ Once the user is in, we need to stamp their hand so we don't have to check their ticket every time they move from one page to another. We can use a _session_ variable for this. A _session_ variable is a variable that is persistent for the user's entire session in the browser. So once it's set, it's good until the user's session ends.

^ A session is a way to store information (in variables) to be used across multiple pages. Unlike a cookie, the information is not stored on the users computer.

---

## Start a Session

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head> ...
```

^ At the top of our pages, we need to start our session. Since this code is going to be at the top of all of our pages, you may want to use an _include_ so it's easy to manage. The `start_session()` function must be the very first thing in your document, before any HTML tags.

---


## Check That Ticket

```php
$query = "SELECT * FROM users WHERE";
$query .= " username = '{$username}'";
$query .= " AND password = '{$password}'";
$query .= " LIMIT 1";
```

^ So we go back to our query that checks the user's credentials. Since we have a successful query that has returned one entry from out database, we can use this entry's `id` or `key` value as our session variable (our hand stamp).

---

## Set `$_SESSION` Variable

```php
$_SESSION['user'] = $user_id;
```

^ You can take the query results, and loop through to extract the `id` value. (I'm not showing this step since it's something we've already covered in detail.) Once you have the `id` value stored in a variable, you create a _session_ variable and store the user's `id`.

^ The _session_ variable will now be accessible across all the pages of the site.

---

## Check the `$_SESSION` Variable

```php
if (isset($_SESSION['user'])) {
  // logged in
} else {
  // not logged in
}
```

^ Now on all the pages that are password protected, you can check for the _session_ variable and determine if the user has access to the page (has the user's hand been stamped?).

---

## Logged In

```php
if (isset($_SESSION['user'])) {
  // logged in
}
```

^ If the user is logged in, they have access to the page.

---

## Not Logged In

```php
else {
  // not logged in
  redirect_to('login.php');
}
```

^ If the user is not logged in, they should not have access. Typically at this point we would redirect the user to the login page, and possible display a message asking them to log in.

---

## Logout

```php
<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();
```

^ If you include a log out button on your site, you can explicitly unset the session variables and end the current session. This will effectively force the user to log in again before being allow to access page content again. It's like forcing the user to present a new ticket to the show.

---

## For Next Week...
