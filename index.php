<?php
    session_start();
    include('classes/dbh.classes.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="#">Network Device Management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <?php
      if (isset($_SESSION["useruid"])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo $_SESSION["useruid"];?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="includes/logout.inc.php">LOGOUT</a>
        </li>
        <?php
      } else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">SIGN UP</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" class="header-login-a">LOGIN</a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>
</nav>
    </header>
    <div class="row">
    <div class="col-md-6">
        <div class="card text-center">
            <h3 class="card-title">Sign Up</h3>
            <form action="includes/signup.inc.php" method="post">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input class="form-control mb-2 card-input" type="text" name="uid" placeholder="Username">
                    <input class="form-control mb-2 card-input" type="password" name="pwd" placeholder="Password">
                    <input class="form-control mb-2 card-input" type="password" name="pwdRepeat" placeholder="Repeat Password">
                    <input class="form-control mb-2 card-input" type="text" name="email" placeholder="E-Mail">
                    <button class="btn btn-primary" type="submit" name="submit">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center">
            <h3 class="card-title">Login</h3>
            <form action="includes/login.inc.php" method="post">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input class="form-control mb-2 card-input" type="text" name="uid" placeholder="Username">
                    <input class="form-control mb-2 card-input" type="password" name="pwd" placeholder="Password">
                    <button class="btn btn-primary" type="submit" name="submit">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</div><br>
    <?php
        if(isset($_SESSION["useruid"]))
        {
    ?>
    <div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add network device</h3>
                <form action="includes/submit-network-device.inc.php" method="post">
                    <div class="mb-3">
                        <label for="device_type" class="form-label">Device Type</label>
                        <select class="form-select" name="device_type" id="device_type">
                            <option value="notebook">Notebook</option>
                            <option value="PC">PC</option>
                            <option value="router">Router</option>
                            <option value="switch">Switch</option>
                            <option value="iot_device">IoT-Device</option>
                            <option value="printer">Printer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ip_address" class="form-label">IP Address</label>
                        <input class="form-control" type="text" name="ip_address" placeholder="IP Address">
                    </div>
                    <div class="mb-3">
                        <label for="mac_address" class="form-label">MAC Address</label>
                        <input class="form-control" type="text" name="mac_address" placeholder="MAC Address">
                    </div>
                    <div class="mb-3">
                        <label for="network_address" class="form-label">Network Address</label>
                        <input class="form-control" type="text" name="network_address" placeholder="Network Address">
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add VLAN</h3>
                <form action="includes/submit-vlan.inc.php" method="post">
                    <div class="mb-3">
                        <label for="network_address" class="form-label">Network Address</label>
                        <input class="form-control" type="text" name="network_address" placeholder="Network Address">
                    </div>
                    <div class="mb-3">
                        <label for="subnet_mask" class="form-label">Subnet Mask</label>
                        <input class="form-control" type="text" name="subnet_mask" placeholder="Subnet Mask">
                    </div>
                    <div class="mb-3">
                        <label for="default_gateway" class="form-label">Default Gateway</label>
                        <input class="form-control" type="text" name="default_gateway" placeholder="Default Gateway">
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
    <?php
        }       
    ?>
        <?php
        $table = new Dbh();
        $query = 
        "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
        FROM network_device 
        INNER JOIN vlan 
        ON network_device.network_address = vlan.network_address;";
        $data = $table->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($data)){
            echo "<table class='table table-hover table-striped table-bordered'>";
            echo "<thead><tr><th scope='col'>Device ID</th><th scope='col'>Device Type</th>";
            
            if(isset($_SESSION["useruid"]))
            {
                echo "<th scope='col'>IP-Address</th><th scope='col'>MAC-Address</th><th scope='col'>Network-Address</th><th scope='col'>Subnetmask</th><th scope='col'>Default Gateway</th>";
            }
            echo "</tr></thead>";
            echo "<tbody>";
                foreach ($data as $row) {
                echo "<tr><td>".$row["device_id"]."</td><td>".$row["device_type"]."</td>";
                if(isset($_SESSION["useruid"]))
                {echo "<td>".$row["ip_address"]."</td><td>".$row["MAC_address"]."</td><td>".$row["network_address"]."</td><td>".$row["subnet_mask"]."</td><td>". $row["default_gateway"]."</td>";}
            }
            echo "</tr></tbody></table>";
        } else {
            echo "Keine Daten gefunden.";
        }
        ?>
    </table>
    <div class="card">
  <div class="card-body">
    <form action="./includes/process.inc.php" method="post">
      <div class="form-group">
      <h5 class="text-center">Import-Filename:</h5>
        <input class="form-control" type="text" name="filename" id="filename" required>
      </div>

      <div class="text-center">
        <button class="btn btn-primary" type="submit">CSV-Datei einlesen</button>
      </div>
    </form>
  </div>
</div>
    <?php
        if(isset($_SESSION["useruid"]))
            {
        ?>
    <div class="card">
  <div class="card-body">
    <form method="post">
      <div class="form-group">
      <h5 class="text-center">Export-Filename:</h5>
        <input class="form-control" type="text" name="exp_file">
      </div>

      <div class="text-center">
        <button class="btn btn-primary mx-2" type="submit" formaction="./includes/export-csv.inc.php" name="export-csv">CSV-Export</button>
        <button class="btn btn-primary mx-2" type="submit" formaction="./includes/export-json.inc.php" name="export-json">JSON-Export</button>
        <button class="btn btn-primary mx-2" type="submit" formaction="./includes/export-xml.inc.php" name="export-xml">XML-Export</button>
      </div>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <form action="./includes/delete_record.inc.php" method="post">
      <div class="form-group">
      <h5 class="text-center">Delete Network Device:</h5>
        <input class="form-control" type="text" name="device_id">
      </div>

      <div class="text-center">
        <button class="btn btn-primary" type="submit" name="submit">Delete Network Device</button>
      </div>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <form action="./includes/delete_user.inc.php" method="post">
      <div class="form-group">
      <h5 class="text-center">Delete User:</h5>
        <input class="form-control" type="text" name="delete_user">
      </div>

      <div class="text-center">
        <button class="btn btn-primary" type="submit" name="submit">Delete User</button>
      </div>
    </form>
  </div>
</div>
    <?php
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>