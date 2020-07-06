# WolfTask

WolfTask is a to-do list application that was written by David Turner and built for the ECE department Web Programmer position.

## Installation

WolfTask is a Laravel 7 application. To install the application in a production environment, follow the steps below:

```bash
# first clone the application and do the typical laravel setup steps
git clone https://github.com/jarredsaids/To-Do
composer install
cp .env.example .env
php artisan key:generate

# configure .env with appropriate database values and run migration, seeders
php artisan migrate
php artisan db:seed

# generate front-end assets
npm install
npm run production

# node_modules should NOT be deployed to a production environment

```

WolfTask uses Socialite, Google Login for authentication, so a client id and secret are required. Generate these by creating a Web Application OAuth client at the Google Developers Console.
- https://console.developers.google.com/apis/credentials/oauthclient

Whether you are setting the project up locally or on a production server, remember to include the Redirect URI.
- For production, use `http://app.url.here.com/login/google/callback`
- For local dev, you can use `http://localhost/login/google/callback`

Once this is done, you can store client id and secret in your `.env`


## Usage

Users can create tasks, associate tasks with multiple priorities, edit an existing task, toggle completion of a task, and delete tasks. Authentication is supported by Google, so users must have a Google account to log in.

## Screenshots

![](https://i.imgur.com/539WRwL.png) 


![](https://i.imgur.com/HtkWkir.png)

## License
[MIT](https://choosealicense.com/licenses/mit/)
