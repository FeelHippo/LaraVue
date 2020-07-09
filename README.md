AVIRATO FULL-STACK CHALLENGE
=====================

Thank you for having me!

I am pleased to have, at last, the opportunity to stick my fingers into **Laravel**, **MySQL** and **Vue** ... and **SCSS**.

Once you have done your code challenge send us your github repository link to [empleo@avirato.com](mailto:empleo@avirato.com) with *Full-Stack Challenge* as subject.

## Configuration

In this project you only have to configure the environment variables to connect to your own [MySQL server](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/).

### Git good practices:
The repository was "mirrored", as opposed to a regular "clone":
[Importing a Git repository using the command line](https://docs.github.com/en/github/importing-your-projects-to-github/importing-a-git-repository-using-the-command-line)

### Install all the dependencies 
I had to install Composer, as I am new to PHP
[Install Composer and PHP on Windows 10](https://devanswers.co/install-composer-php-windows-10/)

```
composer install // You can't run .bat files in Git Bash, had to run it from Command Prompt
npm install

```

Once all the dependencies are ready, modify the *.env* and configure your database credentials.
In order to migrate and seed the database with some random data run this command.

```
php artisan migrate:fresh --seed
```
### First time using Laravel, so had to update php.ini with:
```javascript
extension=mysqli
extension=php_pdo_mysql.dll
```
### Connect to the localhost server and create a new DB, from MySQL Bash
```javascript
\connect root@localhost
CREATE DATABASE laravel;
```
Run the development server and compile front-end assets with the following commands.

```
php artisan serve
npm run hot
```
The app is now running on `http://localhost:8000`.

### SCSS:
For this exercise, I used a cool [stylesheet](https://bootswatch.com/sketchy/), to make my life easier.


### First exercise
We have a list of 15 tasks and we need to represent them as in a TodoApp. You are free to use any way to organize your components, styles, etc. You have to use `Vue` but you are free to use any kind of styles or UI Library. This project is ready to work with ES6/ES7 so feel free to use the last characteristics of JavaScript in your code.

The minimum structure has to be:

```
----------------------------------------
|                 HEADER               |
----------------------------------------
|                                      |
|   STATUS 1     STATUS 2    STATUS 3  |
|   --------     --------    --------  |
|  |  TASK  |   |  TASK  |  |  TASK |  |
|   --------     --------    --------  |
|                                      |
|   --------     --------    --------  |
|  |  TASK  |   |  TASK  |  |  TASK  | |
|   --------     --------    --------  |
|                                      |
----------------------------------------
|                 FOOTER               |
----------------------------------------
```

Each task should have its *title* and *description*. They need to be grouped by status in columns in order, and this columns may be draggables to reorder them.

### Second Exercise
We need to update, create and delete tasks. You will need to implement back and front functionality in order to achieve this goal.

We need to be able to:

* Delete an existing task
* Adding a new task
* Update data from task (title, description, status)
* Reorder columns content and the columns themselves

We will appreciate some of this extra functionalities:

* Change task status and reorder columns with drag&drop
* Be able to create new tasks without popups
* Be able to add new status dinamically

## Pieces of advice

We will love to receive your code, even if you are not interested in working with us!. We will like your app if:

* You follow clean coding practices
* You use git properly
* You think about the UX a little bit

Let us know if you have any question or feedback.

Hope to see your code soon!
