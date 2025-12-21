<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

$config = include('config.php');

$action = $_GET['action'] ?? 'read';

try {
    switch ($action) {
        case 'read':
            $filename = $_GET['file'] ?? $config['csv_filename'];
            
            if (!file_exists($filename)) {
                throw new Exception("CSV file not found");
            }
            
            if (!is_readable($filename)) {
                throw new Exception("CSV file is not readable");
            }
            
            $file = fopen($filename, "r");
            
            if ($file === false) {
                throw new Exception("Could not open CSV file");
            }
            
            $csvData = [];
            $rowCount = 0;
            $maxRows = $config['max_rows'];
            
            while (!feof($file) && ($maxRows === 0 || $rowCount < $maxRows)) {
                $data = fgetcsv($file, 0, $config['csv_delimiter'], $config['csv_enclosure'], $config['csv_escape']);
                
                if ($data && count(array_filter($data)) > 0) {
                    $csvData[] = $data;
                    $rowCount++;
                }
            }
            
            fclose($file);
            echo json_encode($csvData);
            break;
            
        case 'upload':
            if (!isset($_FILES['csvfile'])) {
                throw new Exception("No file uploaded");
            }
            
            $file = $_FILES['csvfile'];
            
            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("File upload error: " . $file['error']);
            }
            
            if (!str_ends_with($file['name'], '.csv')) {
                throw new Exception("Only CSV files are allowed");
            }
            
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $targetFile = $uploadDir . basename($file['name']);
            
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                echo json_encode([
                    'success' => true,
                    'filename' => $file['name'],
                    'path' => $targetFile
                ]);
            } else {
                throw new Exception("Failed to move uploaded file");
            }
            break;
            
        case 'save':
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['filename']) || !isset($data['content'])) {
                throw new Exception("Missing filename or content");
            }
            
            $filename = 'uploads/' . basename($data['filename']);
            $csvContent = '';
            
            foreach ($data['content'] as $row) {
                $escapedRow = array_map(function($cell) {
                    if (strpos($cell, ',') !== false || strpos($cell, '"') !== false || strpos($cell, "\n") !== false) {
                        return '"' . str_replace('"', '""', $cell) . '"';
                    }
                    return $cell;
                }, $row);
                $csvContent .= implode(',', $escapedRow) . "\n";
            }
            
            if (file_put_contents($filename, $csvContent)) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception("Failed to save file");
            }
            break;
            
        default:
            throw new Exception("Invalid action");
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
