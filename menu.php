<?php
require ('db_connect.php');

try {
    $queryMongo = new MongoDB\Driver\Query([], []);
    
    $result = $manager->executeQuery("$dbName.bids", $queryMongo);

    echo 
    '<form action="bidSheet.php" method="POST">
    Choose an item to bid on: 
    <select name="item">';
    
    foreach ($result as $document) {
        echo '<option value="' . $document->item . '">' . $document->item . '</option>';
    }
    
    echo 
    '</select>
    <input type="submit" value="Submit">
    </form>';

} catch (Exception $e) {
    echo "Could not connect\n";
}
?>