<?php
require '../classes/dbh.classes.php';
class DatabaseExporter extends Dbh
{
    public function exportToCSV($csvFile)
    {
        try {
            $pdo = $this->connect();

            // SQL-Abfrage zum Abrufen der Daten
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // CSV-Datei erstellen und Daten schreiben
            $file = fopen($csvFile, 'w');

            // Spaltenüberschriften schreiben
            $header = array_keys($data[0]);
            fputcsv($file, $header);

            // Daten schreiben
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

            // SQL-Abfrage zum Abrufen der Daten
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // JSON-Datei erstellen und Daten schreiben
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

            // SQL-Abfrage zum Abrufen der Daten
            $sql = "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
            FROM network_device 
            INNER JOIN vlan 
            ON network_device.network_address = vlan.network_address;";

            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // XML-Datei erstellen und Daten schreiben
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

