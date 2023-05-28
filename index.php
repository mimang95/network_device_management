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
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Network Device Management</span>
            <ul>
                <?php
                    if(isset($_SESSION["useruid"]))
                    {
                ?>
                <li><a href="#"><?php echo $_SESSION["useruid"];?></a></li>
                <li><a href="includes/logout.inc.php" class="header-login-a">LOGOUT</a></li>
            <?php
                    }
                    else
                    {
                ?>
                    <li><a href="#">SIGN UP</a></li>
                    <li><a href="#" class="header-login-a">LOGIN</a></li>
                <?php    
                    }
                ?>
            </ul>
        </nav>
    </header>
    <section class="index-login">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdRepeat" placeholder="Repeat Password">
            <input type="text" name="email" placeholder="E-Mail">
            <br>
            <button type="submit" name="submit">SIGN UP</button>
        </form>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="submit">LOGIN</button>
        </form>
    </section>
    <?php
                    if(isset($_SESSION["useruid"]))
                    {
                ?>
    <form action="includes/submit.inc.php" method="post">
        <select name="device_type" id="device_type">
            <option value="notebook">Notebook</option>
            <option value="PC">PC</option>
            <option value="router">Router</option>
            <option value="switch">Switch</option>
            <option value="iot_device">IoT-Device</option>
            <option value="printer">Printer</option>
        </select><br>
        <input type="text" name="ip_address" placeholder="ip-address"><br>
        <input type="text" name="mac_address" placeholder="mac-Address"><br>
        <input type="text" name="network_address" placeholder="Network-Address"><br>
        <button type="submit" name="submit">SUBMIT</button><br>
    </form>
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
    <form action="./includes/process.inc.php" method="post">
        <label for="filename">Import-Filename:</label>
        <input type="text" name="filename" id="filename" required>
        <button type="submit">CSV-Datei einlesen</button>
    </form>
    <form action="./includes/export.inc.php" method="post">
        <label for="exp_file">Export-Filename:</label>
        <input type="text" name="exp_file">
        <button type="submit" name="export">CSV-Export</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>