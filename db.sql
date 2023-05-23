CREATE TABLE users (
    users_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    users_uid TINYTEXT not null,
    users_pwd LONGTEXT not null,
    users_email TINYTEXT not null
    );

CREATE TABLE VLAN (
  network_address VARCHAR(45) PRIMARY KEY,
  subnet_mask VARCHAR(45),
  default_gateway VARCHAR(45)
);

CREATE TABLE network_device (
  device_id INT,
  device_type VARCHAR(45),
  ip_address VARCHAR(45),
  MAC_address VARCHAR(45),
  network_address VARCHAR(45),
  PRIMARY KEY (device_id),
  FOREIGN KEY (network_address) REFERENCES VLAN(network_address)
);