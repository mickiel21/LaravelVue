
# Larave Vue Exam

 Laravel 7, Vue 2.5

### Installation
Install the dependencies and devDependencies and start the server.
```sh
$ git clone https://github.com/mickiel21/LaravelVue.git
$ cd [folder_name]      // go to folder of cloned project
$ npm install           // install node dependencies
$ composer install      // install composer dependencies
$ cp .env.example .env  // setup environment file
```
### Branch

1. git checkout feature/frontend (updated branch)

### Database Seeder , Factory and Passport

1. php artisan migrate

2. php artisan db:seed

3. php artisan passport:install

4. php artisan tinker and paste this command for auth user.  
factory('App\Models\User',1)->create() or sign up to manualy add auth user. 




### Dependencies
| Third Party Packages (Development) | Version | - | Third Party Packages | Version
| ------ | ------ | -- | ------ | ------ |
 php | ^7.2.5 | |  admin-lte | 3.0.5
 node | ^14.20.0 | | vue-router | ^3.3.4 |
 npm | ^6.14.17 | |
| axios | ^0.19 | | 
| laravel-mix | ^5.0.1 | | 
| resolve-url-loader | ^2.3.1 | | 
| sass | ^1.20.1 ||
| sass-loader | ^8.0.0 | | 
| node-sass | ^4.13.1 |
| popper.js | ^1.12 |
| style-loader | ^1.1.3 |
| vue | ^2.5.17 |
| vue-template-compiler | ^2.6.10 |
| bootstrap | ^4.0.0 |


### Scripts

| Command | Description | 
| ------ | ------ |
| npm run watch | Compile files Development mode |
| npm run build | Starts a development server locally |
| npm run prod | Minified files for production |
| php artisan serve | Run backend server |
