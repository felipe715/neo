
## Neoway test

### Requirements
- PHP >= 7.2
- Node > 8.0 
- Mongo DB or https://mlab.com/

### Install

- .env with database credentials

Terminal:
- cd /neoway-test 
- npm install
- composer install
- php artisan migrate
- php artisan serve

### Tests
Terminal
- /vendor/bin/phpunit