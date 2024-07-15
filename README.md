# PHP REST API

## Description

- small PHP REST API that covers:
  - basic REST API routing and URLs
  - List, show, create, update and delete database records using a RESTful API
  - Best-practice code organisation
  - Controllers and table gateways
  - Relevant HTTP status codes
  - Data validation
  - JSON decoding and encoding

## XAMPP

- [XAMPP](https://www.apachefriends.org/index.html) was used to run our local server. XAMPP is a free and open-source cross-platform web server solution stack package developed by Apache Friends, consisting mainly of the Apache HTTP Server, MySQL database, and interpreters for scripts written in PHP and Perl

### Installation

- download and install XAMPP: You can download [XAMPP](https://www.apachefriends.org/index.html) from here. Follow the installation instructions for your operating system

## Testing with HTTPie

- for testing our API endpoints, we used [HTTPie](https://httpie.io/), a user-friendly command-line HTTP client.

### Installation

- download and install [HTTPie](https://httpie.io/download)
- to install HTTPie on a Linux system, you can use the following command:

```sh
sudo apt install httpie
```

## Database Setup

- we used a `MySQL` database for this project, managed through `phpMyAdmin`. Below is the code to create the database and its properties

### Creating the Database

- first, create the database using the following SQL command:

```sql
CREATE DATABASE product_db;
```

- next, create the table with the following structure:

```sql
CREATE TABLE product (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(128) NOT NULL,
  size INT NOT NULL DEFAULT 0,
  is_available BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (id)
);
```

## Use Cases

### Warning

- :warning: there is a warning in the commented code within `index.php` related to the URI structure :warning:
  - in the examples below, I will show my URI, which does not have to be the same as yours. If it is not, please update the `index.php` file accordingly (just adjust the `$parts[index]` variable)
  - default URI: `localhost/products`
  - my case URI: `localhost/website/api/products`

### GET request

```sh
# request:
http localhost/website/api/products/1

# response
HTTP/1.1 200 OK
Connection: Keep-Alive
Content-Length: 58
Content-Type: application/json; charset=UTF-8
Date: Mon, 15 Jul 2024 09:04:05 GMT
Keep-Alive: timeout=5, max=100
Server: Apache/2.4.58 (Unix) OpenSSL/1.1.1w PHP/8.2.12 mod_perl/2.0.12 Perl/v5.34.1
X-Powered-By: PHP/8.2.12

{
    "id": 1,
    "is_available": false,
    "name": "Product 1",
    "size": 10
}
```

### POST request

```sh
# request:
http post localhost/website/api/products name="new name"

# response:
HTTP/1.1 201 Created
# (...)

{
    "id": "4",
    "message": "Product created"
}
```

### PATCH request

```sh
# request:
http patch localhost/website/api/products/4 size:=6

# response:
HTTP/1.1 200 OK
# (...)

{
    "message": "Product 4 updated",
    "rows": 1
}
```

### DELETE request

```sh
# request:
http delete localhost/website/api/products/4

# response:
HTTP/1.1 200 OK
# (...)

{
    "message": "Product 4 deleted",
    "rows": 1
}
```

## Project

1. Git Clone

- `git clone https://github.com/GeneralSting/php-rest-api-test`

2. Create database and tables

3. Start the Apache web server

4. Try out terminal cases with HTTPie
