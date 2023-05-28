<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class FetchExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for get dialy exchanges rates data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get All data via http
        $response = Http::get(env('EXCAHNGES_URL_SOURCE'));

        if ($response->successful()) {

            $xmlData = $response->body();

            // Parse XML data
            $xml = simplexml_load_string($xmlData);
            $exchangeRates = ExchangeRate::all();

            foreach ($xml->exchangeRate as $exchangeRate) {
                $countryCode = $exchangeRate->countryCode;
                $rateNew = $exchangeRate->rateNew;

                /**
                    I use updateOrCreate function, if rate_new change, data will update. 
                    If there aren't data in database already this function insert the data
                **/

                ExchangeRate::updateOrCreate(
                    ['country_code' => $countryCode],
                    [
                        'rate_new' => $rateNew,
                        'country_name' => $exchangeRate->countryName,
                        'currency_name' => $exchangeRate->currencyName,
                        'currency_code' => $exchangeRate->currencyCode,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
            $this->info('Exchange rates updated successfully.');
            return 1;
        }

        $this->error('Failed to retrieve exchange rates.');
        return 1;
        
    }
}
