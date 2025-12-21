<?php
/**
 * CSV Reader API
 * 
 * This script reads a CSV file and returns its contents as JSON.
 * It's designed to be called via AJAX from the frontend.
 * 
 * @return JSON array of CSV data or error message
 */

// Set header to return JSON
header('Content-Type: application/json');

// CORS headers (uncomment if needed for cross-origin requests)
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET');

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    // CSV file to read
    $filename = "data.csv";
    
    // Check if file exists
    if (!file_exists($filename)) {
        throw new Exception("CSV file not found");
    }
    
    // Check if file is readable
    if (!is_readable($filename)) {
        throw new Exception("CSV file is not readable");
    }
    
    // Open the CSV file for reading
    $file = fopen($filename, "r");
    
    if ($file === false) {
        throw new Exception("Could not open CSV file");
    }
    
    // Initialize array to store CSV data
    $csvData = [];
    
    // Read all rows from CSV
    while (!feof($file)) {
        // Read one line from CSV
        $data = fgetcsv($file);
        
        // Skip empty rows (filter out rows with only empty values)
        if ($data && count(array_filter($data)) > 0) {
            $csvData[] = $data;
        }
    }
    
    // Close the file handle
    fclose($file);
    
    // Return JSON encoded data
    echo json_encode($csvData);
    
} catch (Exception $e) {
    // Return error as JSON with 500 status code
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
?>
