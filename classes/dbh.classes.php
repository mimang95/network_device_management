<?php
// responsible for interacting with the database
class Dbh {
    // Method to establish a database connection
    public function connect(){
        try {
            $username = "root"; // Username for the database
            $password = ""; // Password for the database
            $dbh = new PDO('mysql:host=localhost;dbname=network_device_management', $username, $password); // Creating a new PDO instance for connecting to the database via an object oriented API
            return $dbh; // Returning the PDO instance
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>"; // Displaying an error message if connection fails
            die(); // Terminating the script
        }
    }

    // Method to insert a network device into the database
    public function insertDevice($device_type, $ip_address, $mac_address, $network_address){
        $stmt = $this->connect()->prepare("INSERT INTO network_device (device_type, ip_address, mac_address, network_address) VALUES(:device_type, :ip_address, :mac_address, :network_address)"); // Preparing a SQL statement for inserting values into the 'network_device' table
        $stmt->bindParam(':device_type', $device_type); // Binding the 'device_type' parameter
        $stmt->bindParam(':ip_address', $ip_address); // Binding the 'ip_address' parameter
        $stmt->bindParam(':mac_address', $mac_address); // Binding the 'mac_address' parameter
        $stmt->bindParam(':network_address', $network_address); // Binding the 'network_address' parameter
        $stmt->execute(); // Executing the SQL statement
    }

    // Method to insert a VLAN into the database
    public function insertVlan($network_address, $subnet_mask, $default_gateway){
        $stmt = $this->connect()->prepare("INSERT INTO vlan (network_address, subnet_mask, default_gateway) VALUES(:network_address, :subnet_mask, :default_gateway)"); // Preparing a SQL statement for inserting values into the 'vlan' table
        $stmt->bindParam(':network_address', $network_address); // Binding the 'network_address' parameter
        $stmt->bindParam(':subnet_mask', $subnet_mask); // Binding the 'subnet_mask' parameter
        $stmt->bindParam(':default_gateway', $default_gateway); // Binding the 'default_gateway' parameter
        $stmt->execute(); // Executing the SQL statement
    }

    // Method to delete a network device from the database
    public function deleteNetworkDevice($device_id){
        $stmt = $this->connect()->prepare("DELETE FROM network_device WHERE device_id = :device_id"); // Preparing a SQL statement for deleting a row from the 'network_device' table based on 'device_id'
        $stmt->bindParam(':device_id', $device_id); // Binding the 'device_id' parameter
        $stmt->execute(); // Executing the SQL statement
    }

    // Method to save data from a CSV file to the database
    public function saveCSVToDatabase($data) {
        $this->connect(); // Establishing a database connection
        
        $stmt = $this->connect()->prepare("INSERT INTO network_device (device_type, ip_address, MAC_address, network_address) VALUES (:device_type, :ip_address, :MAC_address, :network_address)"); // Preparing a SQL statement for inserting values into the 'network_device' table

        foreach ($data as $row) {
            $stmt->bindParam(':device_type', $row[1]); // Binding the 'device_type' parameter from the CSV data row
            $stmt->bindParam(':ip_address', $row[2]); // Binding the 'ip_address' parameter from the CSV data row
            $stmt->bindParam(':MAC_address', $row[3]); // Binding the 'MAC_address' parameter from the CSV data row
            $stmt->bindParam(':network_address', $row[4]); // Binding the 'network_address' parameter from the CSV data row
            $stmt->execute(); // Executing the SQL statement for each row of data in the CSV
        }
    }
}