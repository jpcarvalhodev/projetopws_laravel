Library Management API in PHP/Laravel

This repository contains an API developed in PHP using the Laravel framework for library management. This API provides functionalities to manage books, genres, loans and students, allowing librarians and users to interact with the system efficiently and intuitively.

Features

	•	CRUD operations for books
	•	CRUD operations for genres
	•	CRUD operations for loans
	•	CRUD operations for students

Prerequisites

	•	PHP >= 7.4
	•	Composer

Installation

	1.	Clone this repository:

git clone https://github.com/jpcarvalho23/projetopws-laravel.git

	2.	Install Composer dependencies:

composer install

	3.	Copy the .env.example file to .env and configure the database:

cp .env.example .env

	4.	Run the database migrations:

php artisan migrate

	5.	Start the development server:

php artisan serve

Usage

You can use any HTTP client to interact with the API.

Contribution

Contributions are welcome! Feel free to open an issue!

License

This project is licensed under the MIT License.