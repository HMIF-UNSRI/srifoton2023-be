# Sriwijaya Exhibition 2023 Backend

A web-based competition and seminar registration platform at the Sriwijaya Exhibition with a [Laravel 10](https://laravel.com/docs/10.x) backend.

## Requirements

1. Install php 8.1 - 8.2
2. Install composer
3. Install MySQL

## How to run

Clone the repository

    git clone https://github.com/HMIF-UNSRI/srifoton2023-be.git

Switch to the repo folder

    cd srifoton2023-be

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:secret

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Create symbolic link

    php artisan storage:link

Generate api documentation with scribe

    php artisan scribe:generate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000 and you can access the api documentation at http://localhost:8000/docs
