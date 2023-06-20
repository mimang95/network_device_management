Wir verwenden das CSS-framework bootstrap, um uns die Arbeit beim Styling etwas zu erleichtern.
In der Datei network_device_management.sql befindet sich der SQL-Dump, die db.sql enthält nur die sql-Befehle um die Datenbank ohne Daten zu kreieren.
Die verwendeten Klassen befinden sich im classes-Ordner, sonstige Funktionen im includes-Ordner.
Über die UI exportierte Dateien werden je nach Dateityp in csv-files, json-files bzw. xml-files Ordner abgelegt.

Um eine CSV-Datei einzulesen, muss diese im csv-files Ordner liegen und folgende Struktur haben (die selbe Struktur, die die Dateien auch beim Export haben):

device_id,device_type,ip_address,MAC_address,network_address,subnet_mask,default_gateway
428,notebook,192.168.0.5,00-1D-60-4A-8C-CB,192.168.0.0,255.255.255.0,192.168.0.1
