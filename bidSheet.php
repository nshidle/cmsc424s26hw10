<?php
require ('db_connect.php');

$selectedItem = $_POST['item'];
$queryMongo = new MongoDB\Driver\Query(['item' => $selectedItem]);
$result = $manager->executeQuery("$dbName.bids", $queryMongo);

foreach ($result as $document) {
    $history = $document->history; 
    $highestBid = 0;

    foreach ($history as $bidPrice) {
        if ($bidPrice->price > $highestBid) {
            $highestBid = $bidPrice->price;
        }
    }

    echo "You are bidding on a **$selectedItem** <br>";
    echo "The current bid is **$highestBid** <br>";

    echo 
    '<form action="bid.php" method="POST">
        Your bid: <input type="number" name="new_bid" required><br>
        <input type="hidden" name="item_name" value="' . $selectedItem . '">
        <input type="submit" value="Submit">
    </form>';
}
?>