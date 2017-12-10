<?php

use App\Enquiry;
use Faker\Generator as Faker;

$factory->define(Enquiry::class, function (Faker $faker) {
    return [
        'full_name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'phone_number' => '07355352536',
        'heard_about' => 'Facebook',
        'postcode' => 'FI8 6TR',
        'total_cost' => '£372.88',
        'job_type' => 'Valuation',
        'job_value' => '£200,000 - £299,999',
        'job_age' => 'Post 1945'
    ];
});
