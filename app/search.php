<?php

    require __DIR__ . '/vendor/autoload.php';

    use Elastic\Elasticsearch\ClientBuilder;

    function paresResult($src) {
        $result = array();
        foreach ($src["hits"]["hits"] as $res) {
            $result[] = trim($res["_source"]["word"]);
        }
        return$result;
    }

    $search_string = $_GET["term"];

    $client = ClientBuilder::create()
        ->setHosts(["elasticsearch:9200"])
        ->build();

    $params = [
        'index' => 'dictionary',
        'body' => [
            'size' => 10,
            'query' => [
                'wildcard' => [
                    'word' => [
                        'value' => $search_string."*"
                    ]
                ]
            ]
        ]
    ];



    $result_wild = paresResult($client->search($params)->asArray());

    if (strlen($search_string) > 5) {
        $fuzziness = "2";
    } elseif (strlen($search_string) > 2) {
        $fuzziness = "1";
    } else {
        $fuzziness = "0";
    }


    $params = [
        'index' => 'dictionary',
        'body' => [
            'size' => 10,
            'query' => [
                'fuzzy' => [
                    'word' => [
                        'value' => $search_string,
                        'fuzziness' => $fuzziness
                    ]
                ]
            ]
        ]
    ];

    $result_fuzzy = paresResult($client->search($params)->asArray());

    $total_result = array_slice(array_unique(array_merge($result_wild,$result_fuzzy)),0,12);

    echo json_encode($total_result);
