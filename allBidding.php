<?php
require ('db_connect.php')
try {
    $queryMongo = new MongoDB\Driver\Query([], []);
    
    $result = $manager->executeQuery("$dbName.bids", $queryMongo);
    foreach ($result as $document) {
      echo '<p>' . $document->item . '</p>';
      echo '<table>';
      echo '<tr>
          <th>Date</th>
          <th>Price</th>
        </tr>';
      foreach ($document->history as $entry){
         echo '<tr>';
         echo "<td>" . $entry->when . "</td>";
         echo "<td>" . $entry->price . "</td>";
         echo '</tr>';
        
          }
        echo '</table>';
    }
} catch (Exception $e) {
    echo "Could not connect\n";
?>
