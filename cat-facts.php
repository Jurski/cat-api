<?php

$url = "https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=5";

try {
    $response = file_get_contents($url);

    if ($response === false) {
        throw new Exception("Network error");
    }

    $catData = json_decode($response);

    if ($catData === null) {
        throw new Exception("Error parsing cat data");
    }

    $factsCounter = 1;

    foreach ($catData as $catFact) {
        if (isset($catFact->text) && preg_match('/\bcat(s)?\b/i', $catFact->text)) {
            echo "$catFact->text" . PHP_EOL;
            $factsCounter++;
        }
    }

    if ($factsCounter === 1) {
        echo "Coudlnt get valid cat facts" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}