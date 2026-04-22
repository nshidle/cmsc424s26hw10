<?php
require ('db_connect.php');

$item = $_POST['item'];
$newBid = $_POST['new_bid'];
$date = date("Y-m-d");

$queryMongo = new MongoDB\Driver\Query(['item' => $item]);
$result = $manager->executeQuery("$dbName.bids", $queryMongo);

foreach ($result as $document) {
    $highestBid = 0;
    
    foreach ($document->history as $bid) {
        if ($bid->price > $highestBid) {
            $highestBid = $bid->price;
        }
    }

    if ($newBid > $highestBid) {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(['item' => $item], ['$push' => ['history' => ['when' => $date, 'price' => $newBid]]]);
        $manager->executeBulkWrite("$dbName.bids", $bulk);
        echo "Thank you";
    } else {
        echo "Insufficient bid";
    }
}


?>