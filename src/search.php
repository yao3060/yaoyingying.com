<?php

use Elasticsearch\ClientBuilder;

error_reporting(E_ALL);
ini_set("display_errors", 1);


require __DIR__  . '/vendor/autoload.php';

// Load the WordPress library.
require_once __DIR__ . '/wp-load.php';

/**@var \Elasticsearch\Client $client */
$client = ClientBuilder::create()
    ->setHosts([
        sprintf('https://elastic:%s@es01:9200', getenv('ELASTIC_PASSWORD')),
    ])
    ->setSSLVerification(__DIR__ . '/es01.crt')
    ->build();

/**@var \wpdb $wpdb */
global $wpdb;

$posts = $wpdb->get_results(
    "
        SELECT *
        FROM $wpdb->posts
        WHERE post_status = 'publish' AND ID < 1376
        ORDER BY ID DESC
        LIMIT 100
    ",
    ARRAY_A
);

$params = ['body' => []];
foreach ($posts as $post) {
    $params['body'][] = [
        'index' => [
            '_index' => 'posts',
            '_id'    => $post['ID']
        ]
    ];

    $params['body'][] = $post;
}

$responses = $client->bulk($params);
echo  '<pre>';
print_r($responses);
