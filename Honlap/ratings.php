<?php

$servername = "devweb2016.cis.strath.ac.uk";
$dbUser = "cs312m";
$dbPass = "xoWooyaidei4";
$db = "cs312m";

$conn = new mysqli($servername, $dbUser, $dbPass, $db);

if($conn->connect_error)
{
    die("Connect Failed.".$conn->connect_error);
}

//
$myfile = fopen("myfile.tsv", "w") or die("Unable to open file!");
$myfile2 = fopen("myfile2.csv", "w") or die("Unable to open file!");

$txt = "id\tvalue\n";
$txt2 = "star,count\n";
//
$tmp = 0;
$sum = 0;
$numrows = 0;
$av = 0;
$stars = 0;
$egyes = 0;
$kettes = 0;
$harmas = 0;
$negyes = 0;
$otos = 0;
        
$sql = "SELECT id,value from Reviews";
$result = $conn->query($sql);
        
if ($result->num_rows > 0){
    $numrows = $result->num_rows;
    while($row = $result->fetch_assoc()){
        $tmp=$row["value"];
        $sum += $row["value"];
        //echo "id:".$row["value"]."<br>";
        //
        $atlag = $sum/$row["id"];
        $txt = "{$txt}{$row["id"]}\t{$atlag}\n";
        
        if ($row["value"] === "1"){//itt lehet hogy string kell
            $egyes += 1;
        }
        if ($row["value"] === "2"){
            $kettes += 1;
        }
        if ($row["value"] === "3"){
            $harmas += 1;
        }
        if ($row["value"] === "4"){
            $negyes += 1;
        }
        if ($row["value"] === "5"){
            $otos += 1;
        }
        //
    }
    $av = round($sum / $numrows, 1);
    $stars = round($av);
    //
    
    $txt2 = "{$txt2}1,{$egyes}\n";
    $txt2 = "{$txt2}2,{$kettes}\n";
    $txt2 = "{$txt2}3,{$harmas}\n";
    $txt2 = "{$txt2}4,{$negyes}\n";
    $txt2 = "{$txt2}5,{$otos}\n";
    
    
    fwrite($myfile, $txt);
    fclose($myfile);
    
    fwrite($myfile2, $txt2);
    fclose($myfile2);
    //
    //echo $av;
}
else {
    echo "0 results";
}
        
      
        
      //return $conn;
?>
        
<!doctype HTML>
<HTML>
    <HEAD>
        
        <title>Ratings</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="myStyle.css" type="text/css" >
        <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
        <script src="js/star-rating.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- -->
        <script src="https://d3js.org/d3.v4.min.js"></script>
        <!-- -->
        <script>
            
            function validateForm() {
                var x = document.forms["starForm"]["staroption"].value;
                if (x === "") {
                    alert("Name must be filled out");
                    return false;
                }
            }
            
        </script>        
    
    </HEAD>
    
    
    
    <BODY>
        <ul class="ul1">
            <li class="li1"><a class="active" href="ratings.php">Home</a></li>
            <li class="li1"><a href="stat1.php">Statisztika1</a></li>
            <li class="li1"><a href="stat2.php">Statisztika2</a></li>
            <li class="li2">by Builderz</a></li>
        </ul>
       
        <div class="div1" class="col-xs-12" id="test">
            <br><br>
            <p>Reméljük, tetszett a játék.</p>
            <hr>
            <p class="p2" id="welcomemsg">Jelenlegi értékelés: </p>
            <?php echo '<p class = "p1">'.$numrows.' db értékelés alapján</p><br>';
            for ($i=0; $i<$stars; $i++)
            {
                echo '<span class="glyphicon glyphicon-star star2" style="color:yellow;font-size:400%"></span>';
            }
            for ($i=0; $i<5-$stars; $i++)
            {
                echo '<span class="glyphicon glyphicon-star star2" style="font-size:400%"></span>';
            }
            echo "<br>".$av."/5";
            ?>
            <br>
            
        </div>   
           
        <div class="div2" class="modal-body" id="reviewScore">
            <p class="p2"> Kérjük értékeld a játékot:</p>
                <form id="starForm" name="starForm" method="post" action="thankyou.php" onsubmit="return validateForm()">
                    <ul style="list-style: none;">
                        <li>
                            <input class="star" id="1" type="radio" value="1" name="staroption">
                            <span class="glyphicon glyphicon-star star" aria-hidden="true"></span>
                        </li>

                        <li>
                            <input class="star" id="2" type="radio" value="2" name="staroption">
                            <?php 
                                for ($i=0;$i<2;$i++)
                                {
                                    echo '<span class="glyphicon glyphicon-star star" aria-hidden="true"></span>';
                                            }
                                ?>
                                
                        </li>

                        <li>
                            <input class="star" id="3" type="radio" value="3" name="staroption">
                            <?php 
                                for ($i=0;$i<3;$i++)
                                {
                                    echo '<span class="glyphicon glyphicon-star star" aria-hidden="true"></span>';
                                }
                            ?>
                        </li>

                        <li>
                            <input class="star" id="4" type="radio" value="4" name="staroption">
                            <?php 
                                for ($i=0;$i<4;$i++)
                                {
                                    echo '<span class="glyphicon glyphicon-star star" aria-hidden="true"></span>';
                                }
                            ?>

                        </li>

                        <li>
                            <input class="star" id="5" type="radio" value="5" name="staroption">
                            <?php 
                                for ($i=0;$i<5;$i++)
                                {
                                    echo '<span class="glyphicon glyphicon-star star" aria-hidden="true"></span>';
                                }
                            ?>
                        </li>
                    </ul>
                            
                    <input type="submit" id="submitReview" value="Értékelem">
                    <p id="reviewResult"></p>
                                 
                </form> 
        </div>
<!--<input id="rating-system" type="number" class="rating" min="1" max="5" step="1">-->
        
    </BODY>
</HTML>






     
