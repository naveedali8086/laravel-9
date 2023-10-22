<p align="center"><a href="https://autoklose.com" target="_blank"><img src="https://app.autoklose.com/images/svg/autoklose-logo-white.svg" width="400"></a></p>

## Instructions
The repository for the assignment is public and Github does not allow the creation of private forks for public repositories.

The correct way of creating a private fork by duplicating the repo is documented here.

For this assignment the commands are:

Create a bare clone of the repository.

git clone --bare git@github.com:autoklose/laravel-9.git
Create a new private repository on Github and name it laravel-9.

Mirror-push your bare clone to your new repository.

Replace <your_username> with your actual Github username in the url below.

cd laravel-9.git
git push --mirror git@github.com:<your_username>/laravel-9.git
Remove the temporary local repository you created in step 1.

cd ..
rm -rf laravel-9.git
You can now clone your laravel-9 repository on your machine (in my case in the code folder).

cd ~/code
git clone git@github.com:<your_username>/laravel-9.git

---
## Coding task: 
Send multiple emails asynchronously over an API in Laravel

### Overview

- Create an API that can send multiple emails asynchronously to specific users.
- Store information about the email in Elasticsearch
- Cache information about the email in Redis
- Test the route

 Note: Bonus requirements were also implemented

### Points to be noted before running this sample
1. "composer install" need to be run


2. .env file needs to be added and updated with DB and MAIL related environment variables


3. 'predis' client was used in this demo instead of default 'phpredis'.
   If you intend to use default redis client make sure to comment out 'Redis' alias in config/app.php (otherwise it will conflict with redis clients class)


4. An 'api' guard (that uses 'token' driver) has been added in config/auth.php
   and the token is used as a URI parameter in the request api_token={{your_api_token}}


5. In phpunit tests 'mysql' database has been used


6. Because horizon has been used so following commands needs to be run because horizon related assets and service provider has not been committed

   
       php artisan horizon:install

7. Following artisan commands need to be run:

        php artisan migrate
        php artisan db:seed (creates one user for testing in postman or some other client)
        php artisan horizon
        php artisan queue:work

8. One command 'test' has been added in composer.json to run the test cases

       php artisan test

