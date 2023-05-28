# Fancensus Task

## Description
Small application in Laravel getting daily exchange rate data from [HMRC](http://www.hmrc.gov.uk/softwaredevelopers/rates/exrates-monthly-0122.XML) and storing it in a database. It also provides a user interface with a search form to retrieve exchange rate information.

## Setup
1. Clone the repository: `git clone https://github.com/morulopez/fancensus-task.git`
2. Install dependencies: `composer install`
3. Set up your environment variables in the `.env` file.You must to add `EXCAHNGES_URL_SOURCE=http://www.hmrc.gov.uk/softwaredevelopers/rates/exrates-monthly-0122.XML`.This is used in the cron task for get the data.

4. Generate the application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start the development server: `php artisan serve`

## Usage
Once the application is set up and running, you can perform the following actions:

### Fetching Exchange Rates
To fetch the latest exchange rates and populate the database, run the following command:
```bash
php artisan fetch:exchange-rates
```
This command retrieves the data from HMRC and updates or insert the database with the new rates.

### Searching Exchange Rates
You can search for exchange rates using the search form on the homepage. Enter a country code or country name to retrieve the corresponding exchange rates. The search functionality uses a scope function defined in the `ExchangeRate` model for ease of use.

## Controller and Views
The application includes an `ExchangeRateController` that handles the logic for retrieving exchange rates and performing searches. The `index` method accepts a `Request` object and retrieves the exchange rates accordingly. If a search term is provided, it filters the results based on the country code or country name. Otherwise, it fetches all exchange rates. The retrieved data is then passed to the `exchange-rates` view.

The `exchange-rates` view displays the exchange rates in a user-friendly format. For each exchange rate, it includes the corresponding country flag using the flag image URL from [Flagpedia](https://flagpedia.net).

## Cron Job
To automate the process of fetching exchange rates daily, you can set up a cron job. In the `app/Console/Kernel.php` file, add the following code to the `schedule` method:
```php
$schedule->command('fetch:exchange-rates')->dailyAt('9:00');
```
This code schedules the fetch:exchange-rates command to run daily at 9:00 AM. Make sure your application is running on a live server for the cron job to execute as expected.

By following these instructions, you can set up and use the Fancensus Task application to retrieve and display exchange rate data.