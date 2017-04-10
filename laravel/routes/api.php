<?php

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Lookup;
use ApaiIO\Request\GuzzleRequest;
use GuzzleHttp\Client;

Route::get('/amazon/advertising/lookup', function (\Illuminate\Http\Request $request) {

    preg_match(
        '/(?:dp|o|gp|-)\/(B[0-9]{2}[0-9A-Z]{7}|[0-9]{9}(?:X|[0-9]))/',
        urldecode($request->get('amazon_url')),
        $matches
    );

    $response =
        simplexml_load_string(
            (new ApaiIO(
                (new GenericConfiguration)
                    ->setCountry('co.jp')
                    ->setAccessKey(env('AWS_ACCESS_KEY'))
                    ->setSecretKey(env('AWS_SECRET'))
                    ->setAssociateTag(env('AMAZON_ASSOCIATE_ID'))
                    ->setRequest(new GuzzleRequest(new Client))
            ))->runOperation(
                (new Lookup)->setItemId(str_replace('dp/', '', $matches[0]))
            )
        );

    return [
        'asin' => $response->Items->Item->ASIN->__toString(),
        'title' => $response->Items->Item->ItemAttributes->Title->__toString(),
    ];
})->name('api.amazon.advertising.lookup');