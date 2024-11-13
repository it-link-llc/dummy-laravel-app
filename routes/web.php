<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/v1/transaction', function (Request $request) {
    if (!$request->has('limit')) {
        return response()->json([
            'error' => 'limit parameter is required'
        ], 400);
    }

    $faker = Faker\Factory::create();

    $transactions = [];

    for ($i = 0; $i < $request->limit; $i++) {
        $transactions[] = [
            "date" => $faker->date,
            "amount" => $faker->numberBetween(1000, 20000),
            "currency" => 'USD',
            "recipient_iban" => 'CZ8522591564876203269102',
            "sender_iban" => $faker->iban(),
            "sender_country" => $faker->countryCode(),
            "sender_ip" => $faker->ipv4(),
            "sender_user_agent" => $faker->userAgent(),
            "id" => $faker->uuid()
        ];
    }

    return response()->json([
        'data' => $transactions
    ]);
});
