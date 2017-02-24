# WAMP

[http://www.wampserver.com/en/](http://www.wampserver.com/en/)

## Installation

1. Double click on the downloaded file and just follow the instructions. Everything is automatic. The WampServer package is delivered with the latest releases of Apache, MySQL and PHP.
1. Once WampServer is installed, you can manually add additional Apache, Php or MySql (only VC9, VC10 and VC11 compiled) versions. Explanations will be provided on the forum.
1. Each release of Apache, MySQL and PHP has its own settings and its own files (datas for MySQL).

## Usage

- The _www_ directory will be automatically created (usually `c:\wamp\www`)
- Create a subdirectory in _www_ and put your PHP files inside.
- Click on the _localhost_ link in the WampSever menu or open your internet browser and go to the URL: `http://localhost`

## Notes

You'll remember that Wamp is an abbreviation. Which stands for Windows, Apache, MySQL, and PHP. And together that's what we refer to as the stack that we'll be running, the stack of technology that we'll be using. And Windows of course, we already have. So what we're really downloading is the A, M, and the P. The Apache, MySQL, and PHP as part of the WampServer package. And you can download the installer for that package from the WampServer website, which is [http://wampserver.com/en/](http://wampserver.com/en/).

That final en is there for the English language version of the site. If you don't put that then by default you're on the French language version. They may redesign this website from time to time, don't let that throw you. What we want to find are the download links, the download area. And right now, there's several different packages here that we can choose for downloading. That's referring to the architecture of your computer's processor. If you don't know which one you have, then you can go to your Control Panel and you can go to System and Security, and under System, it will tell you.

It says System Type and here it say 64 bit operating system x64 base processor. So my version of windows is 64 bit and my processor is 64 bits. So it's okay for me to choose 64 bit version which is actually a faster version. So you want to pick the one that's compatible for you. Now out of those I still have a few more choices. This on is PHP 5.3 that's an older version. This one's 5.4 that's the current version as I'm recording this. 5.5 is just about to come out. And then this one over here, it doesn't say it up here but it's PHP 5.4 still the difference is that it's a newer version of Apache. It's Apache 2.4 instead of Apache 2.2.

You won't notice a difference between the two versions of Apache, but as a general principle, always pick the latest version. The latest and greatest of all these parts and components. So that's what I'm going to pick here. Now once I click it, it comes up and asks me a few more things. And then I have a like that says you can download it directly and that will start the actual download. Now I'm not going to click that link because I've already downloaded it. You want to locate that in the place wherever your browser downloads it, and then you'll Double click on the installer to launch it. We'll get some security warnings that we have to accept, and then it comes up with the install wizard which shows us the versions it's going to install here. We click Next.

We need to read and accept the license agreement. And then it says where do you want to install WampServer? Now, unless you know you need it somewhere else, go ahead and let it just install it in the default, which is `c://wamp`. So that's the root of the C drive in the directory called Wamp. That's a good place for it. Now, here I can add some icons. I'm going to choose the quick launch icon. I'm not going to choose the create a desktop icon. And then it says, okay, are you okay with these? Are you ready to install? And we click Install. And it takes off. It starts installing all of the files that it needs. And then once it's done extracting all the files, it'll come up and say please choose your default browser.

This is the browser that WAMP will open up for you when you ask it to show you certain pages. So we want to tell it what our default choice is. By default, that'll be Explorer, that's what it offers down here, and instead, I'm going to switch it to Firefox, local host Program files, an then here's Firefox. I'll pick Firefox and click Open, and then we'll finish the installation. Firewall has blocked some features. So do we want to allow Apache to communicate to these other networks? Private networks, yes.

Public networks, no. Let's go ahead and just say private networks for now. We're going to be developing locally, so it's going to be okay. And let's say, allow access. And then for your server name, leave it as said as Local Host. That's what we call by default the local version of Apache that's running. Now, if you have an SMTP server and you'd like your local development to be able to send mail using the mail function, you would configure that here. We're not going to be using the mail function and I don't have an SMTP server set up. So, I'm just going to click next and leave the defaults in there for now. That's okay.

And then we're at the end. So, that's great. We're all done and I'm going to leave this box checked that, says launch WampServer now and I'll click Finish and that's what it'll do. It'll launch it for us. We'll approve the security alert again. And now you'll notice that there's this little item down here in the corner, that's for the WAMP control menu. Now if you don't see it, it may be hiding under here. You can customize that and make sure that it shows all the time. Show icons in notifications, and now it will stay there all the time. And when I click on it, it gives me the WAMP server menu, the choices that WAMP server does.

Now if it's green, that means that it is successfully online. That it is working if it's orange it tried to go online and it failed. Something blocked it. If it's red that means turned off line and you need to start or stop the different services here. You can test to make sure that it is in fact working by going to local host. And that will open up the default browser that we just told Wamp about. And it will give us this information. If you see this page, then it means that it was able to connect to Apache and to bring up this default information.

![](http://digm.drexel.edu/crs/IDM232/presentations/images/wampserver-screenshot-01.png)

And there's some other good links here. One of these is PHP info. If we click on that, we now know that PHP is working as well. So we know that Apache's working. And we know that PHP is working, because we're able to see all this information about PHP on the PHP info page. It's a good way to check and make sure if it's green, you can see Apache, and you can see PHP, then you know you're probably in good shape on the WAMP side.
