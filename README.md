# Australia
Simple API capable of performing user authentication and all handling (add, edit, delete, view) of books.

## Installation
All commands must be executed at the root of the project, inside PHP server, after cloning.

```
composer install
composer run post-root-package-install
composer run post-create-project-cmd
php artisan breeze:install
npm install
php artisan config:cache
```

> Don't forget to correctly configure your .env file at the root of the project so that the connection to the database, for example, can be successful.

After that, depending on the chosen HTTP server, it will be necessary to enable `a2enmod rewrite`, example: `Apache` - https://www.apache.org.

Access your HTTP server terminal and run the following commands:
```
a2enmod rewrite
service apache2 restart
```

## Migrations
You will need to create the tables in the database for the project to work as expected, so run the following command:

```
$ php artisan migrate

INFO  Running migrations.  
2023_01_14_182743_create_books_table .................................... 599ms DONE
```

## Register
For the `login` to be carried out, it is necessary to register a registered user through the `url`: http://localhost:8080/app/public/register

Will be mandatory:
- `name`
- `email`
- `password`
- `confirm password`

## Login
Route: [`POST`] http://localhost:8080/app/public/api/sanctum/login

Payload:
```
{
    "email": "test@gmail.com",
    "password": "test123"
}
```

Answers:
```
[201] - {
    "token": "6|8jHrCsGN3NNzhQMhoTdc2JAaFW8yq69nOL4gqOQK",
    "user": {
        "id": 1,
        "name": "test",
        "email": "test@gmail.com",
        "email_verified_at": null,
        "created_at": "2023-01-12T17:40:43.000000Z",
        "updated_at": "2023-01-12T17:40:43.000000Z"
    },
    "status": true
}
```

```
[401] - {
    "message": "The provided credentials are incorrect.",
    "status": false
}
```

## How does the created token work?
Once the token has been created correctly, it will be necessary to send it in the requests (listed below) so that the user can be identified and authorized.

In the `header`, the following parameters must go:
```
Authorization:Bearer 4|F1rSGLm471RRA6hMndHhPsTPtyn6KbV0tIQ7ZEGD
Accept:application/json
```
> Remember to prefix `Bearer` before the generated token

-  [`POST`] /app/public/api/sanctum/loggout
-  [`POST`] /app/public/api/books
-  [`PUT`] /app/public/api/books/<integer>
-  [`DELETE`] /app/public/api/books/<integer>
-  [`GET`] /app/public/api/books/<integer>
-  [`GET`] /app/public/api/user

## Loggout
Route: [`POST`]  http://localhost:8080/app/public/api/sanctum/loggout

Answers:
```
[200] - {
    "message": "Logout performed.",
    "status": true
}
```

```
[404] - {
    "message": "User is not logged.",
    "status": false
}
```

## Book: store
Route: [`POST`]  http://localhost:8080/app/public/api/books

Payload:
```
{
    "name": "Wise Soldier",
    "isbn": 123456,
    "value": 112.2
}
```

Answers:
```
[201] - {
    "id": 6,
    "message": "Book saved.",
    "status": true
}
```

```
[500] - {
    "id": false,
    "message": "Error on store the book.",
    "status": false
}
```

```
[500] - {
    "id": null,
    "message": "SQLSTATE[HY000]: General error: 1364 Field 'user_id' doesn't have a default value (SQL: insert into `books` (`name`, `isbn`, `value`, `updated_at`, `created_at`) values (Wise Soldier, 123456, 112.2, 2023-01-15 13:03:02, 2023-01-15 13:03:02))",
    "status": false
}
```

```
[500] - {
    "message": "The name field is required. (and 2 more errors)",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "isbn": [
            "The isbn field is required.",
            "The isbn must be a number."
        ],
        "value": [
            "The value field is required.",
            "The value must be a number."
        ]
    }
}
```

## Book: update
Route: [`PUT`]  http://localhost:8080/app/public/api/books/6

Payload:
```
{
    "name": "Wise Soldier updated",
    "isbn": 123456,
    "value": 112.2
}
```

Answers:
```
[201] - {
    "message": "Book updated.",
    "status": true
}
```

```
[500] - {
    "message": "Error on update the book.",
    "status": false
}
```

```
[404] - {
    "message": "Resource not found.",
    "status": false
}
```

## Book: destroy
Route: [`DELETE`]  http://localhost:8080/app/public/api/books/6

Answers:
```
[200] - {
    "message": "Book destroyed.",
    "status": true
}
```

```
[500] - {
    "id": false,
    "message": "Error on destroy the book.",
    "status": false
}
```

```
[404] - {
    "message": "Resource not found.",
    "status": false
}
```

## Book: get
Route: [`GET`]  http://localhost:8080/app/public/api/books/6

Answers:
```
[200] - {
    "resource": {
        "id": 6,
        "name": "Wise Soldier updated",
        "isbn": 123456,
        "value": 112.2
        "user_id": 1,
        "created_at": "2023-01-14T21:03:12.000000Z",
        "updated_at": "2023-01-14T21:03:22.000000Z"
    },
    "message": "Resource found.",
    "status": true
}
```

```
[500] - {
    "resource": null,
    "message": "Hello, this world is wrong :(",
    "status": false
}
```

```
[404] - {
    "resource": null,
    "message": "Resource not found.",
    "status": false
}
```

## Technologies and Libraries
- [Laravel] - https://laravel.com
- [Laravel Sanctum] - https://laravel.com/docs/9.x/sanctum
- [Laravel Eloquent] - https://laravel.com/docs/9.x/eloquent
- [Laravel Validation] - https://laravel.com/docs/9.x/validation
- [Laravel Testing] - https://laravel.com/docs/9.x/testing
- [Laravel Routing] - https://laravel.com/docs/9.x/routing
- [Laravel Migrations] - https://laravel.com/docs/9.x/migrations
- [Laravel Brezze] - https://laravel.com/docs/9.x/starter-kits#laravel-breeze
- [Laravel Artisan] - https://laravel.com/docs/9.x/artisan
- [NPM] - https://www.npmjs.com
- [Composer] - https://getcomposer.org
- [PHP Stan] - https://phpstan.org

## Unit tests
For more information about the settings, check the `phpunit.xml` file in the root folder.

Execution example in terminal:
```sh
$ php artisan test --testsuite=Unit

PASS  Tests\Unit\ExampleTest
✓ that true is true

PASS  Tests\Unit\BookServiceTest
✓ store should fail

Tests:  2 passed
Time:   0.36s
```

## Static analyzer
```
$ vendor/bin/phpstan analyse app

52/52 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
[OK] No errors
```
