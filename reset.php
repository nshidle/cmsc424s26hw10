<?php
require ('db_connect.php')

$bulk = new MongoDB\Driver\Bulkwrite();
$bulk->update(['item' => 'table'] , ['$set' => ['history' => [['when' => '2026-03-20' , 'price' => 1]]]]);
$bulk->update(['item' => 'phone'] , ['$set' => ['history' => [['when' => '2026-03-20' , 'price' => 1]]]]);
$bulk->update(['item' => 'laptop'] , ['$set' => ['history' => [['when' => '2026-03-20' , 'price' => 1]]]]);
$manager->executeBulkWrite("$dbName.bids", $bulk);
echo 'Data has been reset';
?>
