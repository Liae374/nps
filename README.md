# Net Promoter Score 

This project have been mostly created for learning purpose.

The main goal of this project is to create a complete web application allowing a company, organization or group to easily measuring their NPS. 
This application is wrote with Laravel, and actually works with SQLite. It contains a web application and an API. They both work with the same database. 

## Technologies

- Laravel 8.x
- php 7.3 
- Bootstrap 5.0
- SQLite 3

## What is NPS?

NPS stands for Net Promoter Score which is a metric used in customer experience programs. NPS measures the loyalty of customers to a company. NPS scores are measured with a single question survey and reported with a number from -100 to +100, a higher score is desirable.

NPS is often held up as the gold standard customer experience metric. First developed in 2003 by Bain and Company, it's now used by millions of businesses to measure and track how they're perceived by their customers. 

Respondents give a rating between 0 and 10, and, depending on their response, customers fall into one of 3 categories to establish an NPS score:
- Promoters (0-6)
- Passives (7-8)
- Detractors (9-10)

## How does it work?


## Features


## Setup

### Direct installation

From your command line:
```bash
git clone https://github.com/Liae374/nps-app
cd nps-app 
composer install
touch database/database.sqlite
cp .env.example .env
php artisan migrate:refresh --seed
php artisan key:generate
php artisan serve
```

### Installation step by step

Clone this repository:
```bash
git clone https://github.com/Liae374/nps-app
```

Go to the repository:
```bash
cd nps-app 
```

Install dependencies:
```bash
composer install
```

Create the SQLite database:
```bash
touch database/database.sqlite
```

Copy the .env file:
```bash
cp .env.example .env
```

Create tables in the database:
```bash
php artisan migrate:refresh --seed
```

Generate the application key:
```bash
php artisan key:generate
```

Start the application:
```bash
php artisan serve
```
