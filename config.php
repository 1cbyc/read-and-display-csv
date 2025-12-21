<?php
/**
 * Configuration File for CSV Reader
 * 
 * Customize these settings according to your needs
 */

return [
    // CSV File Settings
    'csv_filename' => 'data.csv',
    'csv_delimiter' => ',',
    'csv_enclosure' => '"',
    'csv_escape' => '\\',
    
    // Security Settings
    'enable_cors' => false,
    'allowed_origins' => ['*'],
    
    // Error Handling
    'display_errors' => false, // Set to true for development
    'log_errors' => true,
    'error_log_file' => 'errors.log',
    
    // Performance Settings
    'max_rows' => 10000, // Maximum rows to read (0 = unlimited)
    'cache_enabled' => false,
    'cache_duration' => 300, // seconds
    
    // Feature Flags
    'enable_upload' => false, // Future feature
    'enable_editing' => false, // Future feature
    'enable_deletion' => false, // Future feature
];
