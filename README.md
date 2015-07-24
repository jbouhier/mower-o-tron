# Mower-o-tron

![](http://i.imgur.com/5icdezF.jpg)

### What's this ?
It's an application test I've done for a company. The goal is to implement the  
specification from `subject.pdf` in any object oriented programming language.  


### Subject
    open subject.pdf

### Use
    cd mower-o-tron
    php App.php test_file

That's it.

### Want to contribute ?
Add your new PHP class files in `app/Mower/<dir_name>/<ClassFile>.php`  
If you haven't already, go and install [Composer](https://getcomposer.org/download/ "Download Composer") right meow.  
To update the class autoloader, from mower-o-tron directory run the command:  

	composer dump-autoload -o       

Why would you need to to that ? It will generate a file like its' name imply will  
'auto-load' (see App.php line 8) the new class files you created so that you don't  
have to use require_once() in App.php every single time your extend this program.  
You're now free to code as you like with 'namespace' and 'use' for your shiny classes.  

Have fun.  

### Need help with composer ?
Open up a console and enter `composer` to see and extend list of options.  
To see a specifict command enter `composer <specific_command> --help`

### This project was made with
- PHP 5.6.11
- Composer
- PhpStorm

