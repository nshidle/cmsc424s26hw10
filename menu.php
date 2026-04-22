<?php
require ('db_connect.php');

try {
    $query = new MongoDB\Driver\Query([], []);
    
    $mongodb = $manager->executeQuery("$dbName.bids", $query);

    echo 
    '<form action="bidSheet.php" method="POST">
    Choose an item to bid on: 
    <select name="item_name">';
    
    foreach ($mongodb as $document) {
        echo '<option value="' . $document->item . '">' . $document->item . '</option>';
    }
    
    echo 
    '</select>
    <input type="submit" value="Submit">
    </form>';

} catch (Exception $e) {
    echo "Could not connect:\n";
}
?>