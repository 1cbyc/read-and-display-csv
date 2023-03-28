<?php
$file = fopen("data.csv", "r");
while (!feof($file)) {
    $data = fgetcsv($file);
    if ($data) {
        foreach ($data as $value) {
            echo $value . " ";
        }
        echo "<br>";
    }
}
fclose($file);
?>
