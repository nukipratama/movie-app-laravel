# Movie App Laravel

A Simple Movie App using Laravel Guzzle HTTP Client and https://imdb-api.com/

## API Reference

#### List Movies
```http
GET /api/v1/movies
```
| Parameter | Type | Description |
| :-------- | :------- | :------------------------- |
| `title` | `string` | Optional. Filter results based on similar movie title.|

#### Get Movie Detail
```http
GET /api/v1/movie/{id}
```
| Parameter | Type | Description |

| :-------- | :------- | :------------------------- |

| `id` | `string` | Required. Movie id from List Movies.|

## Installation

Clone the project
```bash
git clone https://github.com/nukipratama/movie-app-laravel
```
Go to the project directory
```bash
cd movie-app-laravel
```
Install dependencies
```bash
composer install
```
Generate Application Key
```bash
php artisan key:generate
```
Run project locally
```bash
php artisan serve
```