<?php session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <link rel="stylesheet" type="text/css" href="gamescreenCSS.css">
<style>
    div.sign
    {
        background-image: url("./pricetag.png");
        padding: 25px;
        margin-bottom: 50px;
        position: relative;
        width: 150px;
        font-family: "Chalkboard";
        font-size: 1.5em;
        margin-left: auto;
        margin-right: auto;
    }

    .animalKeepSell
    {
        location: absolute;
        top: 50px;

    }

    #goldM
    {
        font-family: "American Typewriter";
        color: gold;
    }

    h3
    {
        font-family: "American Typewriter";
    }
</style>
    <script>
    </script>
</head>

<body>
<?php
$servername="localhost";
$username = "kly5";
$password="912703004";
$dbname= "kly5";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failure".$conn->connect_error);
}


$sql = "SELECT sellprice FROM eggs WHERE eggtype = '$_SESSION[chosenegg]'";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        //echo $row["sellprice"];
        $eggsellprice = $row["sellprice"];
        //echo $eggsellprice;
        $_SESSION["gold"] += $eggsellprice;
    }
}

$modifygold = "UPDATE userinfo SET gold = '$_SESSION[gold]' WHERE username = '$_SESSION[username]'";
$result = $conn->query($modifygold);

$temp = $_SESSION["chosenegg"];
$animaltype= rtrim($temp,"Egg");

?>

<div class="panel">
    <h1 id="message">You have sold your <?php echo $animaltype?>!</h1>
    <h3>You have received <?php echo $eggsellprice?> gold!</h3>
    <h3 id="goldM">Your Gold: <?php echo $_SESSION["gold"];?> </h3>
    <img src="<?php echo $animaltype?>.png" class="animalKeepSell">
    <a href="navigationmenuwithSWL.php">
        <div class="sign">Main Menu</div>
    </a>
</div>
</body>
