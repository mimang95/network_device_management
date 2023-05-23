<?php

class CSVReader {
    private $filename;
    private $delimiter;
    
    public function __construct($filename, $delimiter = ',') {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }
    
    public function read() {
        if (!file_exists("../".$this->filename) || !is_readable("../".$this->filename)) {
            return false;
        }
        
        $rows = [];
        
        if (($handle = fopen("../".$this->filename, 'r')) !== false) {
            while (($data = fgetcsv($handle, 0, $this->delimiter)) !== false) {
                $rows[] = $data;
            }
            
            fclose($handle);
        }
        
        return $rows;
    }
}