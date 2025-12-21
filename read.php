<?php
// Set header to return JSON
header('Content-Type: application/json');

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    $filename = "data.csv";
    
    // Check if file exists
    if (!file_exists($filename)) {
        throw new Exception("CSV file not found");
    }
    
    // Check if file is readable
    if (!is_readable($filename)) {
        throw new Exception("CSV file is not readable");
    }
    
    $file = fopen($filename, "r");
    
    if ($file === false) {
        throw new Exception("Could not open CSV file");
    }
    
    $csvData = [];
    
    // Read all rows from CSV
    while (!feof($file)) {
        $data = fgetcsv($file);
        
        // Skip empty rows
        if ($data && count(array_filter($data)) > 0) {
            $csvData[] = $data;
        }
    }
    
    fclose($file);
    
    // Return JSON encoded data
    echo json_encode($csvData);
    
} catch (Exception $e) {
    // Return error as JSON
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
?>
