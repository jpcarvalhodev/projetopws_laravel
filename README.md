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

You can use any HTTP client to interact with the API. Below are some examples of how to use the API:

	•	Create a book:

POST /api/books

{
    "title": "Book Title",
    "author_id": 1,
    "publisher_id": 1,
    "category_id": 1,
    "published_at": "2024-03-03"
}

	•	List all books:

GET /api/books

	•	Get a book by ID:

GET /api/books/{id}

	•	Update a book:

PUT /api/books/{id}

{
    "title": "New Title"
}

	•	Delete a book:

DELETE /api/books/{id}

For more details on available endpoints, refer to the API documentation.

Contribution

Contributions are welcome! Feel free to open an issue or submit a pull request.

License

This project is licensed under the MIT License.