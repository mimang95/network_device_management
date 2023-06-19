<?php
require '../classes/dbh.classes.php';
class DatabaseExporter extends Dbh
{
    public function exportToCSV($csvFile)
    {
        try {
            $pdo = $this->connect();

            // SQL-Request to fetch all data
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Create CSV-file and write data.
            $file = fopen($csvFile, 'w');

            // write column names
            $header = array_keys($data[0]);
            fputcsv($file, $header);

            // write data
            foreach ($data as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
            header("location: ../index.php");
            exit();
        } catch (PDOException $e) {
            die('Fehler beim Exportieren der Daten: ' . $e->getMessage());
        }
    }

    public function exportToJSON($jsonFile)
    {
        try {
            $pdo = $this->connect();

            // SQL-Request to fetch all data
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Create JSON-File and write data.
            $json = json_encode($data, JSON_PRETTY_PRINT);

            file_put_contents($jsonFile, $json);

            header("location: ../index.php");
            exit();
        } catch (PDOException $e) {
            die('Fehler beim Exportieren der Daten: ' . $e->getMessage());
        }
    }

    public function exportToXML($xmlFile)
    {
        try {
            $pdo = $this->connect();

            // SQL-Request to fetch all data
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Create XML-file and write data.
            $xml = new SimpleXMLElement('<data/>');

            foreach ($data as $row) {
                $item = $xml->addChild('item');
                foreach ($row as $key => $value) {
                    $item->addChild($key, $value);
                }
            }

            $xml->asXML($xmlFile);

            header("location: ../index.php");
            exit();
        } catch (PDOException $e) {
            die('Fehler beim Exportieren der Daten: ' . $e->getMessage());
        }
    }
}

