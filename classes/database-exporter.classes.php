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
}

