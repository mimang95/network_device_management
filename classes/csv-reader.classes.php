<?php

class CSVReader {
    private $filename;
    private $delimiter;
    
    public function __construct($filename, $delimiter = ',') {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }
    
    public function read() {
        // Check if the CSV file exists and is readable
        if (!file_exists("../csv-files/".$this->filename) || !is_readable("../csv-files/".$this->filename)) {
            return false;
        }
        
        $rows = [];
        
        // Open the CSV file for reading
        if (($handle = fopen("../csv-files/".$this->filename, 'r')) !== false) {
            $isFirstRow = true; // Variable to track the first row
            
            // Read each row of the CSV file
            while (($data = fgetcsv($handle, 0, $this->delimiter)) !== false) {
                 // Skip the first row
            if ($isFirstRow) {
                $isFirstRow = false;
                continue;
            }
                // Store the row data in an array
                $rows[] = $data;
            }
            
            // Close the CSV file
            fclose($handle);
        }
        
        // Return the array of rows read from the CSV file
        return $rows;
    }
}