<?php
    session_start();
    include('classes/dbh.classes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
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
    <table>
        <?php
        $table = new Dbh();
        $query = 
        "SELECT device_id, device_type, ip_address, MAC_address, network_device.network_address, subnet_mask, default_gateway 
        FROM network_device 
        INNER JOIN vlan 
        ON network_device.network_address = vlan.network_address;";
        $data = $table->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($data)){
            echo "<table>";
            echo "<tr><th>Device ID</th><th>Device Type</th>";
            
            if(isset($_SESSION["useruid"]))
            {
                echo "<th>IP-Address</th><th>MAC-Address</th><th>Network-Address</th><th>Subnetmask</th><th>Default Gateway</th>";
            }
            echo "</tr>";
                foreach ($data as $row) {
                echo "<tr><td>".$row["device_id"]."</td><td>".$row["device_type"]."</td>";
                if(isset($_SESSION["useruid"]))
                {echo "<td>".$row["ip_address"]."</td><td>".$row["MAC_address"]."</td><td>".$row["network_address"]."</td><td>".$row["subnet_mask"]."</td><td>". $row["default_gateway"]."</td>";}
            }
            echo "</tr></table>";
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
</body>
</html>