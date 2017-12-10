<?php
    
    if (isset($_POST["staroption"])) {
            $staroption = $_POST["staroption"];
            }

    $servername = "devweb2016.cis.strath.ac.uk";
        $dbUser = "cs312m";
        $dbPass = "xoWooyaidei4";
        $db = "cs312m";

        $conn = new mysqli($servername, $dbUser, $dbPass, $db);

        if($conn->connect_error)
        {
            die("Connect Failed.".$conn->connect_error);
        }
        
        
        $sql = "INSERT INTO Reviews (value) VALUES (".$staroption.")";
        $result = $conn->query($sql);
        

    

?>

<!doctype HTML>
<HTML>
    <HEAD>
            <link rel="stylesheet" href="myStyle.css" type="text/css" >
    </HEAD>
    <BODY style="background-color: darkcyan">
        <ul class="ul1">
            <li class="li1"><a class="active" href="ratings.php">Home</a></li>
            <li class="li1"><a href="stat1.php">Statisztika1</a></li>
            <li class="li1"><a href="stat2.php">Statisztika2</a></li>
            <li class="li2">by Builderz</a></li>
        </ul>
        <div> Köszönjük, hogy értékelted a játékot. </div>
        <div>
            <button onclick="location.href='ratings.php'" type="button">Vissza a kezdőlapra</button>
        </div>
    </BODY>
</HTML>