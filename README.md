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
For this exercise, I used a cool [stylesheet](https://bootswatch.com/minty/), to make my life easier.

## DEMO
[Here is a little demo](https://ttprivatenew.s3.amazonaws.com/pulse/feel-hippo/attachments/14048262/Laravel+VueJs+ToDo+App.mp4)

### Notes:

I was an absolute noob at Laravel and VueJs, until... 48 hours ago, so I am sure a few things are not very idiomatic. 
I have tried to keep everything as simple as possible:
- app.scss: just a simple grid to arrange the front page, Bootstrap will take care of the rest
- index.blade.php: no props, just three separate components that can be developed further
- app.js: I am a big axios fan, so...
```javascript
Vue.prototype.$http = axios;
```
- api.php: no misteries here, this is a simple project, so I didn't use any controllers, I fixed the Post and Patch methods as:
```javascript
Route::post('tasks/store', function(Request $request) {
        return App\Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);
    });
    
Route::patch('tasks/{id}', function(Request $request, $id) {
    App\Task::findOrFail($id)->update([
        'title' => $request->title,
        'description' => $request->description,
        'status_id' => $request->status_id,
    ]);
});
```
- Task.php: little changes to control the data flow
- ExampleComponent.vue: I hope the methods are self-explanatory
- drag and drop: [I used this amazing tool](https://www.npmjs.com/package/vuedraggable) to make the three lists more dynamic and fun to play with. 

Thank you for your time, I have greatly enjoyed developing my first Laravell/Vue application, and I sincerely hope I'll be given the change to do more :) 
