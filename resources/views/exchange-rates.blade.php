<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Fancensus Task</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <header class="header-app">
            <form action="{{ url('/') }}" method="GET">
                <input type="text" name="search" placeholder="Search by country or country code">
                <button type="submit">Search</button>
            </form>
        </header>
        <main>
            <h1>Exchanges Rates</h1>
            <section class="exchange-rates-list">
                @if(isset($exchangeRates))
                    @if($exchangeRates->isEmpty()) 
                        <h2>NO RESULT FOUNDS...</h2>
                    @endif
                    @foreach ($exchangeRates as $exchangeRate)
                        <div class="exchange-info">
                            <header>
                                <img src="https://flagpedia.net/data/flags/w580/{{strtolower($exchangeRate->country_code)}}.png" alt="{{ $exchangeRate->country_name }}">
                            </header>
                            <div class="about-product">
                                <p>Country: <strong>{{ $exchangeRate->country_name }}</strong></p>
                                <p>Country Code: <strong>{{ $exchangeRate->country_code }}</strong></p>
                                <p>Currency: <strong>{{ $exchangeRate->currency_name }}</strong></p>
                                <p>Currency Code: <strong>{{ $exchangeRate->currency_code }}</strong></p>
                            </div>
                            <footer>
                                <span>Rate New =></span>
                                <span>{{ $exchangeRate->rate_new }}</span>
                            </foooter>
                        </div>
                    @endforeach
                @endif
            </section>
        </main>
    </body>
    <footer>
        jesuslopezprogramador@gmail.com
    </footer>
</html>