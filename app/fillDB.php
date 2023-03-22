<?php
    require __DIR__ . '/vendor/autoload.php';

    use Elastic\Elasticsearch\ClientBuilder;

    $words_file = fopen("words_alpha.txt","r");

    $client = ClientBuilder::create()
        ->setHosts(["elasticsearch:9200"])
        ->build();



    while(!feof($words_file)) {
        $word = fgets($words_file);
        $params = [
            'index' => 'dictionary',
            'body' => ['word' => $word]
        ];

        $client->index($params);

    }

    echo "Done";