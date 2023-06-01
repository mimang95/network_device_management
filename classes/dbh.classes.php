<?php

class Dbh {
    public function connect(){
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=network_device_management', $username, $password);
            return $dbh;
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function insertDevice($device_type, $ip_address, $mac_address, $network_address){
        $stmt = $this->connect()->prepare("INSERT INTO network_device (device_type, ip_address, mac_address, network_address) VALUES(:device_type, :ip_address, :mac_address, :network_address)");
        $stmt->bindParam(':device_type', $device_type);
        $stmt->bindParam(':ip_address', $ip_address);
        $stmt->bindParam(':mac_address', $mac_address);
        $stmt->bindParam(':network_address', $network_address);
        $stmt->execute();
    }

    public function insertVlan($network_address, $subnet_mask, $default_gateway){
        $stmt = $this->connect()->prepare("INSERT INTO vlan (network_address, subnet_mask, default_gateway) VALUES(:network_address, :subnet_mask, :default_gateway)");
        $stmt->bindParam(':network_address', $network_address);
        $stmt->bindParam(':subnet_mask', $subnet_mask);
        $stmt->bindParam(':default_gateway', $default_gateway);
        $stmt->execute();
    }

    public function deleteNetworkDevice($device_id){
        $stmt = $this->connect()->prepare("DELETE FROM network_device WHERE device_id = :device_id");
        $stmt->bindParam(':device_id', $device_id);

        $stmt->execute();
    }

    public function saveCSVToDatabase($data) {
        $this->connect();
        
        $stmt = $this->connect()->prepare("INSERT INTO network_device (device_type, ip_address, MAC_address, network_address) VALUES (:device_type, :ip_address, :MAC_address, :network_address)");

        foreach ($data as $row) {
            $stmt->bindParam(':device_type', $row[0]);
            $stmt->bindParam(':ip_address', $row[1]);
            $stmt->bindParam(':MAC_address', $row[2]);
            $stmt->bindParam(':network_address', $row[3]);
            $stmt->execute();
        }
    }
}